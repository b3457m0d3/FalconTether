<?
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // HTTP/1.1
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache"); // HTTP/1.0
		
		
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Ad[m]i[n]pA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="/assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons 
    <link rel="shortcut icon" href="http://www.tarantism.us/assets/images/tarantismico.png">-->
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
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
          <a class="brand" href="#">Ad[m]i[n]pA</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="/members">Home</a></li>
	      <?php if (empty($this->ezauth->user)) { ?>
              <li><a href="/members/login">Login</a></li>
	      <?php
	        } else {
		  
	            echo '<li><a href="/members/roster">Members</a></li>';
		  
		  
	      ?>
	       
	      <li><a href="/members">Link</a></li> 
	      <li><a href="/members/logout">Logout</a></li>
	      <?php } ?>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

<? //if there is a message from add_entry function, display message, otherwise display nothing ('') ?>
<?=(!empty($disp_message)) ? '<p>'.$disp_message.'</p>' : ''?>

<? //if there is an error message from add_entry function, display message, otherwise display nothing ('') ?>
<?=(!empty($disp_error)) ? '<p>'.$disp_error.'</p>' : ''?>