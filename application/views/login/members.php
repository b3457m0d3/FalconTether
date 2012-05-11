<?php
$query = $this->db->get('ez_users');
	foreach($query->result() as $row){
          
          echo "<div class='member'>";
          echo "<span class='user'>";
          echo "<a href='/members/profile/".$row->id."'>".$row->username."</a></span>";
          if($row->id == $this->ezauth->user->id || $this->ezauth->user->access_keys->tarantism=='admin'){
            echo "<form action='/members/edit/' method='post'>";
            echo "<input type='hidden' name='id' value='".$row->id."'/>";
            echo "<input type='submit' name='action' value='Delete'/>";
            echo "<input type='submit' name='action' value='Edit'/>";
            echo "</form>";
          }
          
          echo "</div>";
	}
?>