<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>1337 C4LC, by Interr0bang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="http://www.tarantism.us/assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="http://www.tarantism.us/assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="http://www.tarantism.us/assets/images/favicon.ico">
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
          <a class="brand" href="#">Base Calcu13373r</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <!--<li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li> //-->
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

<!-- Login Form -->
<?=$this->validation->error_string; ?>
<?=(!empty($error_string)) ? '<p>'.$error_string.'</p>' : ''?>
<?php
$user_info = $this->ezauth->fetch_userinfo();
if(!empty($this->validation->username)){
$user = $this->validation->username;
} elseif(count($user_info)>0){
$user = $user_info['username']; 
}
$attributes = array('class' => 'clearfix'); 
?>
<?=form_open('index.php/albums/'.$this->uri->segment(2).'/'.$this->uri->segment(3));?>
<?=form_hidden('redirect_url', 'last_url')?>
<h1>Member Login</h1>
<label class="grey" for="log">Username:</label>
<input class="field" type="text" name="username" id="username" value="<?php echo $user; ?>" size="23" />
<label class="grey" for="pwd">Password:</label>
<input class="field" type="password" name="password" id="password" size="23" />
<label>
<input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Remember me
</label>
<div class="clear"></div>
        <input type="submit" name="submit" value="Login" class="bt_login" />
        <?=anchor('index.php/albums/forgotpw', 'Lost Your Password?')?> | <?=anchor('index.php/albums/register', 'Enroll')?>
</form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="http://www.tarantism.us/assets/js/bootstrap-transition.js"></script>
    <script src="http://www.tarantism.us/assets/js/bootstrap-alert.js"></script>
    <script src="http://www.tarantism.us/assets/js/bootstrap-modal.js"></script>
    <script src="http://www.tarantism.us/assets/js/bootstrap-dropdown.js"></script>
    <script src="http://www.tarantism.us/assets/js/bootstrap-scrollspy.js"></script>
    <script src="http://www.tarantism.us/assets/js/bootstrap-tab.js"></script>
    <script src="http://www.tarantism.us/assets/js/bootstrap-tooltip.js"></script>
    <script src="http://www.tarantism.us/assets/js/bootstrap-popover.js"></script>
    <script src="http://www.tarantism.us/assets/js/bootstrap-button.js"></script>
    <script src="http://www.tarantism.us/assets/js/bootstrap-collapse.js"></script>
    <script src="http://www.tarantism.us/assets/js/bootstrap-carousel.js"></script>
    <script src="http://www.tarantism.us/assets/js/bootstrap-typeahead.js"></script>
  </body>
</html>
