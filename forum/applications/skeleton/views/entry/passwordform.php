<?php if (!defined('APPLICATION')) exit(); ?>
<div>
	<?php
	// Make sure to force this form to post to the correct place in case the view is
	// rendered within another view (ie. /dashboard/entry/index/):
	echo $this->Form->Open(array('Action' => $this->Data('FormUrl', Url('/entry/signin')), 'id' => 'Form_User_SignIn', 'class' => 'form-horizontal'));
	?>
	<fieldset>
		<legend><?php echo T('Sign in to your Vanilla account'); ?></legend>
		<div class="control-group">
			<?php		
				echo $this->Form->Label('Username or email', 'Email', array('class' => 'control-label'));
				echo '<div class="controls">';
					echo $this->Form->TextBox('Email');
				echo '</div>';
			?>
		</div>
		<div class="control-group">
			<?php
				echo $this->Form->Label('Password', 'Password', array('class' => 'control-label'));
				echo '<div class="controls">';
					echo $this->Form->Input('Password', 'password', array('class' => 'InputBox Password'));
				echo '</div>';
			?>
		</div>
		<div class="control-group">
			<?php
				echo $this->Form->Label('Remember me', 'RememberMe', array('class' => 'control-label'));
				echo '<div class="controls"><div class="checkbox">';
					echo $this->Form->CheckBox('RememberMe', T('Keep me signed in'), array('value' => '1', 'id' => 'SignInRememberMe'));
				echo '</div></div>';
			?>
		</div>
		<?php
		// Render the buttons to select other methods of signing in.
		if (count($Methods) > 0) {
			echo '<div class="Methods">';

			foreach ($Methods as $Key => $Method) {
				$CssClass = 'Method Method_'.$Key;
				echo '<div class="'.$CssClass.'">',
					$Method['SignInHtml'],
					'</div>';
				}

			echo '</div>';
		}
		?>
		<div class="form-actions">
			<?php echo $this->Form->Button('Sign In', array('class' => 'btn btn-primary')); ?>
			<?php
				$Target = $this->Target();
				if ($Target != '')
					$Target = '?Target='.urlencode($Target);

				printf(T("Don't have an account? %s"), Anchor(T('Create One.'), '/entry/register'.$Target));
			?>
		</div>
		<?php if (strcasecmp(C('Garden.Registration.Method'), 'Connect') != 0): ?>
	</fieldset>
	<?php endif; ?>
	<?php
	echo $this->Form->Close();
	echo $this->Form->Open(array('Action' => Url('/entry/passwordrequest'), 'id' => 'Form_User_Password', 'class' => 'form-horizontal'));
	?>
	<fieldset>
		<p><h3><?php echo T('Forgot your password?'); ?></h3></p>
		<p><?php echo T('If you have forgotten your password, enter your email address or username in the field below. You will then receive an email with details on how to reset your password.'); ?></p><br>
		<div class="control-group">
			<?php
				echo $this->Form->Label('Username or email', 'Email', array('class' => 'control-label'));
				echo '<div class="controls">';
					echo $this->Form->TextBox('Email');
				echo '</div>';
			?>
		</div>
		<div class="form-actions">
			<?php
				echo $this->Form->Button('Request a new password', array('class' => 'btn'));
			?>
		</div>
	</fieldset>
	<?php echo $this->Form->Close(); ?>
</div>