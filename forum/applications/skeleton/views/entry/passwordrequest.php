<?php if (!defined('APPLICATION')) exit(); ?>		
<div class="Entry">
	<?php
	// Make sure to force this form to post to the correct place in case the view is
	// rendered within another view (ie. /dashboard/entry/index/):
	echo $this->Form->Open(array('Action' => Url('/entry/passwordrequest'), 'id' => 'Form_User_Password', 'class' => 'form-horizontal'));
	echo $this->Form->Errors(); ?>
	<fieldset>
		<legend><?php echo T('Forgot your password?'); ?></legend>
		<br>
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