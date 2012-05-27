<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>T[admin]Tism</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php
    $this->combine->css('bootstrap.css');
    $this->combine->css('bootstrap-responsive.css');
    $this->combine->css('docs.css');
    echo $this->combine->build('css');
    echo link_tag('/assets/images/tarantismico.png', 'shortcut icon', 'image/ico');

   $meta = array(
        array('name' => 'description', 'content' => 'Turning Mind Into Matter'),
        array('name' => 'keywords', 'content' => 'electronics,programming,open source'),
        array('name' => 'robots', 'content' => 'no-cache'),
        array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
        array('name' => 'author', 'content' => 'interr0bang llc')
   );

    echo meta($meta);
    $this->combine->css('custom-theme/jquery-ui-1.8.16.custom.css');
    $this->combine->css('themes/libnotify.css');
    echo $this->combine->build('css');
    ?>
    <style> body { padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */  } </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="/assets/js/jquery-ui-1.8.16.custom.min.js"></script>
    <?php if(isset($player)){ ?>
    <script type="text/javascript" src="http://www.tarantism.us/assets/js/swfobject.js"></script>	
    <script type="text/javascript">
	var swfPath = "http://www.tarantism.us/assets/swf/player.swf";
	var stageW = 560;
	var stageH = 300;
	var attributes = {};
          attributes.id = 'FlashComponent';
          attributes.name = attributes.id;
    	var params = {};
	  params.bgcolor = "#333333";
	  params.allowfullscreen = "true";
	  params.allowScriptAccess = "always";			
	var flashvars = {};	
	  flashvars.componentWidth = stageW;
	  flashvars.componentHeight = stageH;							
  	  flashvars.pathToFiles = "http://www.tarantism.us/assets/mp3gallery/";
	  flashvars.xmlPath = "http://www.tarantism.us/assets/xml/settings.xml";
	  flashvars.contentXMLPath = "http://www.tarantism.us/albums/privatexml";
	swfobject.embedSWF(swfPath, attributes.id, stageW, stageH, "9.0.124", "js/expressInstall.swf", flashvars, params, attributes);
    </script>
    <?php } ?>
    <!--[if lt IE 9]> <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
    <?php //$this->load->view('mixpanel'); ?>		 
  </head>
  <body>
<?php
$active = "class='active' ";
if(!$this->uri->segment(2)){
  $uri = 'home';
} else {
  $uri = $this->uri->segment(2);
}
?>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">T[admin]Tism</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li <?php if($uri=="home") echo $active;?>><a href="http://www.tarantism.us/albums">Home</a></li>
	      <?php if (empty($this->ezauth->user)) { ?>
              <li <?php if($uri=="login") echo $active;?>><a href="http://www.tarantism.us/albums/login">Login</a></li>
	      <?php
	        } else {
		  if($this->ezauth->user->access_keys->tarantism == "admin"){
		     echo '<li ';
		     if($uri=="admin") echo $active;
		     echo '><a href="http://www.tarantism.us/albums/admin">IEB</a></li>';
		 }
	            echo '<li ';
		     if($uri=="edit") echo $active;
		     echo '><a href="http://www.tarantism.us/albums/edit">Music</a></li>';

	      ?>
	      
	      <li <?php if($uri=="player") echo $active;?>><a href="http://www.tarantism.us/albums/player">Player</a></li>
	      <li <?php if($this->uri->segment(1)=="bookmarks") echo $active;?>><a href="http://www.tarantism.us/bookmarks">Bookmarks</a></li> 
	      <li><a href="http://www.tarantism.us/albums/logout">Logout</a></li>
	      <?php } ?>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
  