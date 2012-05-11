<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
<head>
	{asset name='Head'}
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Javascript
 	================================================== -->
	
	<script type="text/javascript" src="/forum/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/forum/js/classes.js"></script>
	<script type="text/javascript" src="/forum/js/cookie.plugin.js"></script>
	<script type="text/javascript" src="/forum/js/main.js"></script>
	<script type="text/javascript" src="/forum/design/prettify/prettify.js"></script> 
	
</head>
<body id="{$BodyID}" class="{$BodyClass}" onload="prettyPrint()">

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
				<a class="brand" href="{link path="/"}">{logo}</a>
				<div class="nav-collapse">
					<ul class="nav">
						<li class="DiscussionsLink"><a href="{link path="/discussions"}"><i class="icon-comments"></i> Discussions</a></li>
						<li class="ActivityLink"><a href="{link path="/activity"}"><i class="icon-time"></i> Activity</a></li>
						{custom_menu}
					</ul>
					
					<ul class="nav pull-right">
						{if $User.SignedIn}						
						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle signOut" data-toggle="dropdown"><i class="icon-user"></i> {$User.Name}
							{if $User.CountNotifications} <span>{$User.CountNotifications}</span>{/if} <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li class="nav-header">Welcome!</li>
								<li>
									<a href="{link path="profile"}">Profile
									{if $User.CountNotifications} <span>{$User.CountNotifications}</span>{/if}</a>
								</li>
								<li>
									<a href="{link path="messages/inbox"}">Inbox
									{if $User.CountUnreadConversations} <span>{$User.CountUnreadConversations}</span>{/if}</a>
								</li>
								{if CheckPermission('Garden.Settings.Manage')}
									<li><a href="{link path="dashboard/settings"}">Dashboard</a></li>
								{/if}
								<li class="divider"></li>
								<li>
									{link path="signinout"}
								</li>
							</ul>
						</li>
						{/if}
						{if !$User.SignedIn}						
						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle signIn" data-toggle="dropdown">Have an account? 
								<i class="icon-signin"></i> <b>Sign in</b> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu login-dropdown">
								<div class="MainForm">
									<form id="Form_User_SignIn" class="form-horizontal" method="post" action="/entry/signin">
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
											<a href="/entry/signin">Forgot password?</a>
											<a href="/entry/register?Target=%2F">Don't have an account?</a>
										</p>
									</form>
								</div>
							</ul>
						</li>
						{/if}
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
				<div class="Box BoxSearch">{searchbox}</div>
				{asset name="Panel"}
				<div class="credits well">
					Powered by <a target="_blank" href="http://vanillaforums.org"><b>Vanilla.</b></a>
					Made with <a target="_blank" href="http://getbootstrap.com"><b>Bootstrap.</b></a>
					<br>
					Theme built by <a href="https://github.com/kasperisager"><b>Kasper Kronborg Isager</b></a>
					<!-- Feel free to delete my name from the list, but please keep both the Vanilla and Bootstrap notices -->
				</div>
			</div>
			<div class="span8">
				{asset name="Content"}
			</div>
		</div>
		
		{asset name="Foot"}
		
	</div>
	
</body>
</html>
