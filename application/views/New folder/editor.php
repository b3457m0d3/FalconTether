<?php

function delete_folder($tmp_path){
  if(!is_writeable($tmp_path) && is_dir($tmp_path)){chmod($tmp_path,0777);}
    $handle = opendir($tmp_path);
  while($tmp=readdir($handle)){
    if($tmp!='..' && $tmp!='.' && $tmp!=''){
         if(is_writeable($tmp_path."/".$tmp) && is_file($tmp_path."/".$tmp)){
                 unlink($tmp_path."/".$tmp);
         }elseif(!is_writeable($tmp_path."/".$tmp) && is_file($tmp_path."/".$tmp)){
             chmod($tmp_path."/".$tmp,0666);
             unlink($tmp_path."/".$tmp);
         }
        
         if(is_writeable($tmp_path."/".$tmp) && is_dir($tmp_path."/".$tmp)){
                delete_folder($tmp_path."/".$tmp);
         }elseif(!is_writeable($tmp_path."/".$tmp) && is_dir($tmp_path."/".$tmp)){
                chmod($tmp_path."/".$tmp,0777);
                delete_folder($tmp_path."/".$tmp);
         }
    }
  }
  closedir($handle);
  rmdir($tmp_path);
  if(!is_dir($tmp_path)){return true;}
  else{return false;}
}
  $albumDir = get_include_path()."/assets/mp3gallery/content/albums/";
  include("login/top.php");
  $title = $this->input->post('title');
  $artist = $this->input->post('artist');
  if($title !== FALSE && $artist !== FALSE){
    $data = array('id'=>'','userid' => $this->ezauth->user->id,'title' => $title,'artist'=>$artist);
    if($this->db->insert('albums', $data)){
      if(mkdir($albumDir.$title, 0777)){
        echo "<h2 style='color:#3de50f'>Added</h2>";
        echo "<a href='http://www.tarantism.us/albums/upload/".$title."'>Upload Files</a>";
      }
    }
  }
  $delete = $this->input->post('id');
  if($delete !== FALSE){
    $query = $this->db->get_where('albums', array('id' => $delete));
    foreach($query->result() as $row){
    if($row->userid == $this->ezauth->user->id){
      if(delete_folder($albumDir.$row->title)){
        if($this->db->delete('albums', array('id' => $delete))){
          echo "<h2 style='color:#e5280f'>".$row->title." Deleted</h2>";
        }
      }
    } else {
      echo "<h2 style='color:#e5280f'>Can't delete another users album!</h2>";
    }
    }    
  }
if(!is_null($artist_name)){
  if($this->ezauth->user->access_keys->tarantism == "admin"){
  echo "<a href='http://www.tarantism.us/albums/edit'>&laquo; Artists</a>";
  } 
  echo "<h2>".ucfirst($artist_name)." - Albums</h2>";
} else {
  echo "<h2>Music</h2>";
}
?>
  
      
      <blockquote>
        * add "_x_" to the album name to set it as private.<br>
        * if you don't upload a "cover.png" then the album won't show up in the player.
      </blockquote>
      <form action="edit" method="post">
        Album:<input type="text" name="title" id="title"/>
        <?php
          if(!is_null($artist_name)){
            echo '<input type="hidden" name="artist" id="artist" value="'.$artist_name.'"/>';
          } else {
              echo 'Artist:<input type="text" name="artist" id="artist"/>';
            
          }
        ?>
        <input type="submit" value="Add"/>
      </form>
      <ul style="list-style: none">
      <?php
      if(!is_null($artist_name)){
        $query = $this->db->get_where('albums',array("artist"=>$artist_name));
        foreach ($query->result() as $row){
          echo "<li>";
          $title = $row->title;
          echo "<h4>";
          if(substr_count($title,"_x_")>0){
           $title = str_replace("_x_","",$row->title);
           echo "[Private]";
          }
          echo $title." - ".$row->artist."</h4>";
          echo "<img src='http://www.tarantism.us/assets/mp3gallery/content/albums/".$row->title."/cover.png' width='150px' height='150px'/> ";
          echo "<a href='http://www.tarantism.us/albums/upload/".$row->title."'>Upload Files</a>";
          echo "<form action='edit' method='post'><input type='hidden' name='id' value='".$row->id."'/><input type='submit' value='Delete ".$row->title."'></form></li>";
        }
      } else {
        $this->db->select("artist")->distinct();
        if($this->ezauth->user->access_keys->tarantism !== "admin"){
        $query = $this->db->get_where('albums',array('userid'=>$this->ezauth->user->id));
        } else {
        $query = $this->db->get('albums');
        }
        foreach ($query->result() as $row){
          echo "<li><a href='http://www.tarantism.us/albums/edit/".$row->artist."'>";
          echo "<h4>".$row->artist."</h4></a></li>";
        }
      }
        
        
      ?>
      </ul>
<?php include("login/bottom.php"); ?>
    