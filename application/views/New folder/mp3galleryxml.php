<?php header("Content-type: application/xml"); 
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<mp3gallery>';
$this->load->helper('directory');
$map = directory_map(get_include_path()."assets/mp3gallery/content/albums", 0);
$x = 0;
echo "<albums>";
foreach($map as $album=>$files){
    if(substr_count($album,'_x_')==0){
      echo '<album id="'.$x.'">';
      echo "\t".'<author><![CDATA[<]]></author>';
      echo "<image>content/albums/".$album."/cover.png</image>";
      echo "<tracks>";
      $i = 0;
      foreach($files as $key=>$file){
        if(substr_count($file,".mp3")>0){
            $filename = str_replace(".mp3","",$file);
            echo "<item id='".$i."'>";
            echo "<title><![CDATA[".$filename."]]></title>";
            echo "<song>content/albums/".$album."/".$file."</song>";
            echo "</item>";
        }
        $i++;
      }
      echo "</tracks>";
      echo "</album>";
      $x++;
    }
  
}

echo "</albums>";
?>
</mp3gallery>