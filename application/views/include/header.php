<!DOCTYPE html PUBLIC>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="keywords" content="">
   <meta name="author" content="">
    <link href="http://www.falcontether.cc/assets/images/ftico.png" rel="shortcut icon" type="image/ico" /><meta name="description" content="" />

   <title>Falcon Tether - CodeIgniter, Twitter's BootStrap, Vanilla, HybridAuth, Paypal And A Whole Lot More!</title>
     
        <?php 
if(isset($theme)){
?>
        <link href='/assets/css/themes/bootstrap.<?php echo $theme; ?>.css' rel="stylesheet">
        <?php } else { ?>
         <link href='/assets/css/bootstrap.min.css' rel="stylesheet">
        <?php } ?>
   <link href="/assets/css/style2.css" rel="stylesheet">

   <link href="/assets/css/prettify.css" rel="stylesheet">
   <link href="/assets/css/custom.css" rel="stylesheet">
       <link href="/assets/fonts/impact-label/stylesheet.css" rel="stylesheet">
        <link href="/assets/fonts/college/stylesheet.css" rel="stylesheet">


    <style>
    .impactlabelsmall {font: 13px 'ImpactLabelRegular', Arial, sans-serif;line-height: 13px;padding:0px;margin:0px;}
     .impactlabel, h1 {font: 27px 'ImpactLabelRegular', Arial, sans-serif;}
    a,input,p,h2 {font: 18px/27px 'CollegeRegular', Arial, sans-serif;}

    .brand {height:20px;}
    </style>

        <?php if(isset($upload)){ ?>
    <link rel="stylesheet" href="http://www.tarantism.us/assets/css/upstyle.css">
<!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
<link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css">
<link rel="stylesheet" href="http://www.tarantism.us/assets/css/jquery.fileupload-ui.css">
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<?php }
if(isset($markitup)){ ?>
<!-- markItUp! skin -->
<link rel="stylesheet" type="text/css" href="/assets/js/markitup/skins/markitup/style.css" />
<!--  markItUp! toolbar skin -->
<link rel="stylesheet" type="text/css" href="/assets/js/markitup/sets/default/style.css" /> 
    <? } ?>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
   <script src="/assets/js/bootstrap.js"></script>
    <script src="/assets/js/bootstrap-alert.js"></script>
    <script src="/assets/js/bootstrap-modal.js"></script>
    <script src="/assets/js/bootstrap-dropdown.js"></script>
    <script src="/assets/js/bootstrap-scrollspy.js"></script>
    <script src="/assets/js/bootstrap-tab.js"></script>
    <script src="/assets/js/bootstrap-tooltip.js"></script>
    <script src="/assets/js/bootstrap-popover.js"></script>
    <script src="/assets/js/bootstrap-button.js"></script>
    <script src="/assets/js/bootstrap-collapse.js"></script>
    <script src="/assets/js/bootstrap-carousel.js"></script>
    <script src="/assets/js/bootstrap-typeahead.js"></script>
    <?php if(isset($productslider)){ ?>
    <link rel="stylesheet" type="text/css" href="/assets/css/productslider.css" /> 

    <script src="/assets/js/slides.min.jquery.js"></script>
	<script>
		$(function(){
			$('#products').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				effect: 'slide, fade',
				crossfade: true,
				slideSpeed: 350,
				fadeSpeed: 500,
				generateNextPrev: true,
				generatePagination: false
			});
		});
	</script>
    <? } ?>
    <script type="text/javascript" src="/assets/js/swfobject.js"></script>	
		<?php if(isset($player)){ ?>
                <script type="text/javascript">
			var swfPath = "/assets/swf/player.swf";			
			var stageW = 560;//560//"100%"; // minimum is 450
			var stageH = 300;//400;//"100%"; // minimum is 260
			
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
			
			flashvars.pathToFiles = "/";
			flashvars.xmlPath = "assets/xml/settings.xml";
			flashvars.contentXMLPath = "members/privatexml";
    			swfobject.embedSWF(swfPath, attributes.id, stageW, stageH, "9.0.124", "js/expressInstall.swf", flashvars, params, attributes);
		</script>
    
    <?php
    }
    if(isset($upload)){ ?>
    <script src="/assets/js/processing.min.js"></script>
    <?php } ?>
    <?php if(isset($countdown)) $this->load->view('countdown_head'); ?>
<?php if(isset($upload)){ ?>
<script src="/assets/js/vendor/jquery.ui.widget.js"></script>
<script src="http://blueimp.github.com/JavaScript-Templates/tmpl.min.js"></script>
<script src="http://blueimp.github.com/JavaScript-Load-Image/load-image.min.js"></script>
<script src="http://blueimp.github.com/JavaScript-Canvas-to-Blob/canvas-to-blob.min.js"></script>
<script src="http://blueimp.github.com/Bootstrap-Image-Gallery/js/bootstrap-image-gallery.min.js"></script>
<script src="/assets/js/jquery.iframe-transport.js"></script>
<script src="/assets/js/jquery.fileupload.js"></script>
<script src="/assets/js/jquery.fileupload-ip.js"></script>
<script src="/assets/js/jquery.fileupload-ui.js"></script>
<script src="/assets/js/locale.js"></script>
<script src="/assets/js/main.js"></script>
<!--[if gte IE 8]><script src="http://www.tarantism.us/assets/js/cors/jquery.xdr-transport.js"></script><![endif]-->
<? } ?>
   <script src="/assets/js/prettify.js"></script>

<?php if (!empty($this->ezauth->user)){
    $content = "<img src='".$this->ezauth->user->photo."' border='0' height='64px' width='64px'/><br/>";
    $content .= "<div class='btn-group'><a class='btn' href='/members/profile'>Profile</a><a class='btn' href='/members/logout'>Log Out</a></div>";
?>

   <script type="text/javascript">
    $(document).ready(function(){
        $('#user').popover({trigger:'focus',placement:'bottom',title:'<?php echo $this->ezauth->user->username; ?>',content:'<?php echo addslashes($content); ?>'});
    });
   </script>
<?php } ?>

</head>

<body>
    
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand impactlabelsmall" href="#"><img src="/assets/images/falcontether.png" width="48px" height="24px" border="0"/>Falcon Tether</a>
        <?php if (empty($this->ezauth->user)){ ?>
        <div class="right">
                <form class="form-inline" action="/members/login" method="post" style="padding:0px;margin:-5px 0 0px 0px;background:#292929;">
                <input type="text" class="input-small" style="height:20px;" name="username" placeholder="User">
                    <input type="password" class="input-small" style="height:20px;" name="password" placeholder="Pass">
                <button type="submit" class="btn btn-info btn-mini">Login</button>
                <span style="position:relative;top:8px;">
                <a href="http://ieb.cc/?route=authentications/authenticatewith/google"><img src="http://ieb.cc/images/google.png" height="24px" width="24px" border="0"/></a> 
                <a href="http://ieb.cc/?route=authentications/authenticatewith/yahoo"><img src="http://ieb.cc/images/yahoo.png" height="24px" width="24px" border="0"/></a> 
                <a href="http://ieb.cc/?route=authentications/authenticatewith/facebook"><img src="http://ieb.cc/images/facebook.png" height="24px" width="24px" border="0"/>
                <a href="http://ieb.cc/?route=authentications/authenticatewith/twitter"><img src="http://ieb.cc/images/twitter.png" height="24px" width="24px" border="0"/></a>  
                <a href="http://ieb.cc/?route=authentications/authenticatewith/linkedin"><img src="http://ieb.cc/images/linkedin.png" height="24px" width="24px" border="0"/></a>
                <a href="http://ieb.cc/?route=authentications/authenticatewith/lastfm"><img src="http://ieb.cc/images/lastfm.png" height="24px" width="24px" border="0"/></a>
                </span>
                </form>
                

        </div>
        <?php } else { ?>
        <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" id="user" href="#">
              <i class="icon-user"></i> <?php echo $this->ezauth->user->username; ?>
            </a>
          
          </div>
        <?php } ?>
        <div class="nav-collapse">
          <ul class="nav">
            <?php $active = ' class="active"'; ?>
            <li<?php if($this->uri->segment(1) == "members" && !$this->uri->segment(2)) echo $active; ?>><a href="/members">Home</a></li>
            <li><a href="/blog">Blog</a></li>
            <li><a href="/forum">Community</a></li>
            <li>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="6KCB2CGAQPP8Q">
                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>


            </li>
            <?php if (!empty($this->ezauth->user)){ ?>
            <li<?php if($this->uri->segment(2) == "project") echo $active; ?>><a href="/members/project">Editor</a></li>
            <li<?php if($this->uri->segment(2) == "content") echo $active; ?>><a href="/members/content">Content</a></li>
            <li<?php if($this->uri->segment(2) == "countdown") echo $active; ?>><a href="/members/countdown">Countdown</a></li>
            <?php<li //if($this->uri->segment(2) == "upload") echo $active; ><a href="/members/upload">Upload</a></li>?>
            <li<?php if($this->uri->segment(2) == "player") echo $active; ?>><a href="/members/player">Player</a></li>
            <?php } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
    