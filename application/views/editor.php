<?php

  $projectDir = get_include_path()."/assets/projects/";
  $this->load->helper('directory');
  $title = $this->input->post('title');
  $description = $this->input->post('description');
  $projDesc = $this->input->post('projDesc');
  $tagline = $this->input->post('tagline');
  $tagline_edit = $this->input->post('tagline_edit');
  $id = $this->input->post('id');
  $youtube = $this->input->post('youtube');
  if($title !== FALSE && $tagline !== FALSE && $description !== FALSE){
    $data = array(
        'id'=>'',
        'title' => str_replace(' ','-',$title),
        'tagline' => $tagline,
        'description' => $description
    );
    if($this->db->insert('products',$data)){
      if(mkdir($projectDir.$title, 0777)){
        if(mkdir($projectDir.$title."/images/", 0777)){
        echo "<h2 style='color:#3de50f' class='fadeOut'>Project Added</h2>";
        echo "<a href='/members/upload/".$title."'><img src='/assets/images/file.jpeg' border='0' /> Upload Files</a>";
        }
      }
    }
  }
  if($projDesc !== FALSE && $tagline_edit !== FALSE && $id !== FALSE){
    $data = array(
        'tagline'=>$tagline_edit,
        'description'=>$projDesc
    );
    $this->db->where(array('id'=>$id));
    if($this->db->update('products',$data)){
      echo "<h2 style='color:#3de50f' class='fadeOut'>Update Successful</h2>";
    } else {
      echo "<h2 style='color:#3de50f' class='fadeOut'>FAIL!</h2>";
    }
  }
  if($youtube !== FALSE && $id !== FALSE){
    $data = array(
        'video'=>$youtube
    );
    $this->db->where(array('id'=>$id));
    if($this->db->update('products',$data)){
      echo "<h2 style='color:#3de50f' class='fadeOut'>Video Added</h2>";
    } else {
      echo "<h2 style='color:#3de50f' class='fadeOut'>FAIL!</h2>";
    }
  }
    $delete = $this->input->post('delete');
    if($delete !== FALSE){
      $query = $this->db->get_where('products', array('id' => $delete));
      foreach($query->result() as $row){
        if(delete_folder($projectDir.$row->title)){
          if($this->db->delete('products', array('id' => $delete))){
            echo "<h2 style='color:#e5280f' class='fadeOut'>".$row->title." Deleted</h2>";
          }
        }
      }    
    }
    echo "<div class='container'>";
    ?>
    <div class="hero-unit">
        <h1>Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a id="newProject" class="btn btn-success btn-large">Add A New Project &raquo;</a></p>
      </div>

      <div id="addProject" style="display: none;">
      <form action="/members/projects" class="form-inline well" method="post">
       <input type="text" valign="bottom" name="title" style="height:50px;" placeholder="Title"/>
       <input type="text" valign="bottom" name="tagline" style="height:50px;" placeholder="TagLine"/>
 
       <button type="submit" class="btn btn-info">Create</button>
      </form>
  </div>
      <ul style="list-style: none">
      <?php
      $project_name = null;
      if(is_null($project_name)){
        $query = $this->db->get('products');
        foreach ($query->result() as $row){
          echo "<li>";
          $title = $row->title;
          
          $tagline = $row->tagline;
          
          $description = $row->description;
          $video = $row->video;
          echo "<h4>";
          if(substr_count($title,"_x_")>0){
           $title = str_replace("_x_","",$row->title);
           echo "[Private]";
          }
          echo $title." - ".$tagline."</h4>";
          ?>
          <table border="0" width="100%">
          <tr>
          <td width="30%">
           

  <!--<a id="edittoggle">Edit Project Summary</a><div id="projDesc" style="display: none;">-->
          <?php
          
          echo "<a class='btn btn-primary' href='/members/upload/".$row->title."'>Upload Files</a>";
          
          echo "<form action='/members/projects' method='post'><br/><br/>";
          echo "<input type='hidden' name='id' value='".$row->id."'/>";
          echo "<input type='text' name='youtube' id='youtube' style='height:50px;' value='".$video."' placeholder='Youtube URL'/>";
          echo "<input type='submit' value='Add Video'></form></li>";
          ?>
          <form action="/members/projects" method="post">
          <?php echo "<input type='hidden' name='id' value='".$row->id."'/>"; ?>

        Tagline:<input type="text" name="tagline_edit" id="tagline_edit" style="height:40px;" value="<?=$row->tagline?>"/><br/>
       
    <br/>
    Description:
    <textarea class="markitup" name="projDesc" cols="30" rows="20"><?=$description?></textarea>
  </div>
   <br/><br/>
        <button type="submit" class="btn btn-success" style="float:right;margin-right: 35px;">Save Changes</button>
      </form>
      <?php
          
          echo "<form action='/members/projects' method='post'>";
          echo "<input type='hidden' name='delete' value='".$row->id."'/>";
          echo "<button type='submit' class='btn btn-danger delete'>Delete ";
          echo $row->title."</button></li>";
          ?>
          </td>
          <td>
          <?php
          $dir = get_include_path()."/assets/projects/".$title."/images";
          $files = directory_map($dir);
          $percent = 20;
          $images = 0;
          $tasks = array('title'=>TRUE,'tagline'=>TRUE,'description'=>FALSE,'featured'=>FALSE,'sch'=>FALSE,'brd'=>FALSE,'gtoe5'=>FALSE,'gtoe10'=>FALSE,'video'=>FALSE,'public'=>FALSE);
          if($description != ''){ $percent = $percent+10; $tasks['description'] = TRUE;}
          if(count($files)>0){
          foreach($files as $id=>$file){
            $filename = explode('.',$file);
            if(in_array('featured',$filename)){
              $percent += 10; $tasks['featured'] = TRUE;
              $feat = $file;
            } else {
              if(in_array('jpg',$filename)) $images++;
              if(in_array('png',$filename)) $images++;
              if(in_array('gif',$filename)) $images++;
            }
            if(in_array('sch',$filename)){ $tasks['sch'] = TRUE; $percent += 10; }
            if(in_array('brd',$filename)){ $tasks['brd'] = TRUE; $percent += 10; }
          }
          }
          if($row->video !== ''){ $percent += 10; $tasks['video'] = TRUE; }
          if($images>=5){ $percent += 10; $tasks['gtoe5'] = TRUE; }
          if($images>=10){ $percent += 10; $tasks['gtoe10'] = TRUE; }
          $true = "<img height='16px' width='16px' src='/assets/images/ok.png' />";
          $false = "<img height='16px' width='16px' src='/assets/images/incomplete.png' />";
          echo "<img src='/assets/projects/".$row->title."/images/".$feat."' width='400px' height='200px'/> ";
          echo "<h3>".$percent."% Complete.</h3>";
          ?>
          
          <div class="progress">
              <div class="bar" style="width: <?php echo $percent; ?>%;"></div>
            </div><br/>
            
          
            <span style="padding-bottom:5px"><?php echo $true; ?>Title</span>
            <span style="padding-bottom:5px"><?php echo $true; ?>Tagline</span>
            <span style="padding-bottom:5px"><?php echo ($tasks['description'])?$true:$false; ?>Description</span>
            <span style="padding-bottom:5px"><?php echo ($tasks['featured'])?$true:$false; ?>Featured Image</span>
            <span style="padding-bottom:5px"><?php echo ($tasks['gtoe5'])?$true:$false; ?>5 Photos</span>
            <span style="padding-bottom:5px"><?php echo ($tasks['gtoe10'])?$true:$false; ?>10 Photos</span>
            <span style="padding-bottom:5px"><?php echo ($tasks['video'])?$true:$false; ?>Video</span>
            <span style="padding-bottom:5px"><?php echo ($tasks['sch'])?$true:$false; ?>Schematic</span>
            <span style="padding-bottom:5px"><?php echo ($tasks['brd'])?$true:$false; ?>Board</span>
            <span style="padding-bottom:5px"><?php echo ($tasks['public'])?$true:$false; ?>Published</span>
          
          </td>
          </tr>
          </table>
          <hr>
          </li>
          <?php
        }
      } else {
        $query = $this->db->get('products');
        
        foreach ($query->result() as $row){
          echo "<li><a href='/members/projects/";
          echo "'>";
          echo "<h4></h4></a></li>";
        }
      }
        
        
      ?>
      </ul>
      
      