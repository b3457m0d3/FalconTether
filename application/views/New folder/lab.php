<?php
header("Content-type:txt/javascript");
echo "(function(){"
LAB_opts(array('AlwaysPreserveOrder:true','BasePath:'.site_url($this->assets->dir['js']).'});'));
$n = count($load);
for($i=0;$i<=$n;$i++){
     if($i == 0) LAB_script($load[$i],'first');
     else LAB_script($load[$i]);
}
LAB_wait($fn);
echo "})();";
?>
