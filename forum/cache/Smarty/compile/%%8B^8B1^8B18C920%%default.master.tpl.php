<?php /* Smarty version 2.6.25, created on 2012-04-30 05:02:43
         compiled from /home/bo0m3r/public_html/adipa.mobi/forum/applications/dashboard/views/default.master.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'asset', '/home/bo0m3r/public_html/adipa.mobi/forum/applications/dashboard/views/default.master.tpl', 4, false),array('function', 'logo', '/home/bo0m3r/public_html/adipa.mobi/forum/applications/dashboard/views/default.master.tpl', 31, false),array('function', 'link', '/home/bo0m3r/public_html/adipa.mobi/forum/applications/dashboard/views/default.master.tpl', 34, false),array('function', 'custom_menu', '/home/bo0m3r/public_html/adipa.mobi/forum/applications/dashboard/views/default.master.tpl', 36, false),array('function', 'searchbox', '/home/bo0m3r/public_html/adipa.mobi/forum/applications/dashboard/views/default.master.tpl', 115, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
<head>
	<?php echo smarty_function_asset(array('name' => 'Head'), $this);?>

	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Javascript
 	================================================== -->
	
	<script type="text/javascript" src="/forum/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/forum/js/classes.js"></script>
	<script type="text/javascript" src="/forum/js/cookie.plugin.js"></script>
	<script type="text/javascript" src="/forum/js/main.js"></script>
	<script type="text/javascript" src="/forum/design/prettify/prettify.js"></script> 
	
</head>
<body id="<?php echo $this->_tpl_vars['BodyID']; ?>
" class="<?php echo $this->_tpl_vars['BodyClass']; ?>
" onload="prettyPrint()">

	<!-- Navbar
 	================================================== -->

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</a>
				<a class="brand" href="http://www.adipa.mobi/members"><?php echo smarty_function_logo(array(), $this);?>
</a>
				<div class="nav-collapse">
					<ul class="nav">
						<li class="DiscussionsLink"><a href="<?php echo smarty_function_link(array('path' => "/discussions"), $this);?>
"><i class="icon-comments"></i> Discussions</a></li>
						<li class="ActivityLink"><a href="<?php echo smarty_function_link(array('path' => "/activity"), $this);?>
"><i class="icon-time"></i> Activity</a></li>
						<?php echo smarty_function_custom_menu(array(), $this);?>

					</ul>
					
					<ul class="nav pull-right">
						<?php if ($this->_tpl_vars['User']['SignedIn']): ?>						
						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle signOut" data-toggle="dropdown"><i class="icon-user"></i> <?php echo $this->_tpl_vars['User']['Name']; ?>

							<?php if ($this->_tpl_vars['User']['CountNotifications']): ?> <span><?php echo $this->_tpl_vars['User']['CountNotifications']; ?>
</span><?php endif; ?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li class="nav-header">Welcome!</li>
								<li>
									<a href="<?php echo smarty_function_link(array('path' => 'profile'), $this);?>
">Profile
									<?php if ($this->_tpl_vars['User']['CountNotifications']): ?> <span><?php echo $this->_tpl_vars['User']['CountNotifications']; ?>
</span><?php endif; ?></a>
								</li>
								<li>
									<a href="<?php echo smarty_function_link(array('path' => "messages/inbox"), $this);?>
">Inbox
									<?php if ($this->_tpl_vars['User']['CountUnreadConversations']): ?> <span><?php echo $this->_tpl_vars['User']['CountUnreadConversations']; ?>
</span><?php endif; ?></a>
								</li>
								<?php if (CheckPermission ( 'Garden.Settings.Manage' )): ?>
									<li><a href="<?php echo smarty_function_link(array('path' => "dashboard/settings"), $this);?>
">Dashboard</a></li>
								<?php endif; ?>
								<li class="divider"></li>
								<li>
									<?php echo smarty_function_link(array('path' => 'signinout'), $this);?>

								</li>
							</ul>
						</li>
						<?php endif; ?>
						<?php if (! $this->_tpl_vars['User']['SignedIn']): ?>						
						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle signIn" data-toggle="dropdown">Have an account? 
								<i class="icon-signin"></i> <b>Sign in</b> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu login-dropdown">
								<div class="MainForm">
									<form id="Form_User_SignIn" class="form-horizontal" method="post" action="/forum/entry/signin">
										<fieldset>
											<input type="hidden" id="Form_hpt" name="Form/hpt" value="" style="display: none;">
  											<label class="UsernameLabel">
  												<span>Username or email</span>
												<input type="text" id="Form_Email" name="Form/Email" value="" class="InputBox">
											</label>
												<label class="PasswordLabel">
												<span>Password</span>
												<input type="password" id="Form_Password" name="Form/Password" value="" class="InputBox Password">
											</label>
										</fieldset>
											<fieldset class="RememberMe">
											<label for="SignInRememberMe" class="CheckBoxLabel chechkbox">
												<input type="checkbox" id="SignInRememberMe" name="Form/RememberMe" value="1" checked="checked">
												<input type="hidden" name="Checkboxes[]" value="RememberMe">
												<span>Remember me</span>
											</label>
											<input type="submit" id="Form_SignIn" name="Form/Sign_In" value="Sign In" class="btn btn-primary">
										</fieldset>
										<p class="CreateAccount">
											<a href="/forum/entry/signin">Forgot password?</a>
											<a href="/forum/entry/register?Target=%2F">Don't have an account?</a>
										</p>
									</form>
								</div>
							</ul>
						</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>		

	<!-- Container
 	================================================== -->

	<div class="container-fluid">
	
		<div class="row-fluid">
			<div class="span4">
				<div class="Box BoxSearch"><?php echo smarty_function_searchbox(array(), $this);?>
</div>
				<?php echo smarty_function_asset(array('name' => 'Panel'), $this);?>

				<div class="credits well">
					Powered by <a target="_blank" href="http://vanillaforums.org"><b>Vanilla.</b></a>
					Made with <a target="_blank" href="http://getbootstrap.com"><b>Bootstrap.</b></a>
				</div>
			</div>
			<div class="span8">
				<?php echo smarty_function_asset(array('name' => 'Content'), $this);?>

			</div>
		</div>
		
		<?php echo smarty_function_asset(array('name' => 'Foot'), $this);?>

		
	</div>
	
</body>
</html>