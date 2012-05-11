<?php
$config["assets_folder"] = "assets";
$config["assets_path"] = $_SERVER['DOCUMENT_ROOT']."/".$config["assets_folder"];
$config["default_level"] = "public";

// set asset types and folders
$config["asset_types"] = array(
    "flv"		=>	"flash",
    "swf"		=>	"flash",
    "jpg"		=>	"images",
    "png"		=>	"images",
    "gif"		=>	"images",
    "js"		=>	"js",
    "css"		=>	"css",
    "xml"               =>      "xml"
);
?>