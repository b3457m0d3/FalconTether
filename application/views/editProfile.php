<form action="/members/edit" method="post">
<?php
echo "<input type='hidden' name='id' value='".$id."'/>";
$query = $this->db->get_where('userinfo',array('userid'=>$id));
    foreach($query->result() as $row){
      echo "<input type='text' name='gamertag' id='gamertag' value='".$row->gamertag."'/>";
      echo "<input type='submit' value='Update'/>";
    }
?>
</form>