<?php if (!defined('APPLICATION')) exit(); ?>
<div class="Entry">
	<?php
	$TermsOfServiceUrl = Gdn::Config('Garden.TermsOfService', '#');
	$TermsOfServiceText = sprintf(T('I agree to the <a id="TermsOfService" class="Popup" target="terms" href="%s">terms of service</a>'), Url($TermsOfServiceUrl));
	
	// Make sure to force this form to post to the correct place in case the view is
	// rendered within another view (ie. /dashboard/entry/index/):
	echo $this->Form->Open(array('Action' => Url('/entry/register'), 'id' => 'Form_User_Register', 'class' => 'form-horizontal'));
	echo $this->Form->Errors();
	?>
	<fieldset>
		<legend><?php echo T("Apply for Membership") ?></legend>
		<div class="control-group">
			<?php
				echo $this->Form->Label('Email', 'Email', array('class' => 'control-label'));
				echo '<div class="controls">';
					echo $this->Form->TextBox('Email');
					echo '<p id="EmailUnavailable" class="Incorrect help-block" style="display: none; color: red;">'.T('Email Unavailable').'</p>';
				echo '</div>';
			?>
		</div>
		<div class="control-group">
			<?php
				echo $this->Form->Label('Username', 'Name', array('class' => 'control-label'));
				echo '<div class="controls">';
					echo $this->Form->TextBox('Name');
					echo '<p id="NameUnavailable" class="Incorrect help-block" style="display: none; color: red;">'.T('Name Unavailable').'</p>';
				echo '</div>';
			?>
		</div>
		<div class="control-group">
			<?php
				echo $this->Form->Label('Password', 'Password', array('class' => 'control-label'));
				echo '<div class="controls">';
					echo $this->Form->Input('Password', 'password');
				echo '</div>';
			?>
		</div>
		<div class="control-group">
			<?php
				echo $this->Form->Label('Confirm Password', 'PasswordMatch', array('class' => 'control-label'));
				echo '<div class="controls">';
					echo $this->Form->Input('PasswordMatch', 'password');
					//echo '<p id="PasswordsDontMatch" class="Incorrect help-block" style="display: none; color: red;">'.T("Passwords don't match").'</p>';
				echo '</div>';
			?>
		</div>
	</fieldset>
	<fieldset>
		<div class="control-group">
			<?php
				echo $this->Form->Label('Gender', 'Gender', array('class' => 'control-label'));
				echo '<div class="controls">';
					echo $this->Form->RadioList('Gender', $this->GenderOptions, array('default' => 'm'));
				echo '</div>';
			?>
		</div>
	</fieldset>
	<fieldset>
		<div class="control-group">
			<?php
				echo '<div class="controls">';
					echo $this->Form->CheckBox('TermsOfService', $TermsOfServiceText, array('value' => '1'));
					echo $this->Form->CheckBox('RememberMe', T('Remember me on this computer'), array('value' => '1'));
				echo '</div>'
			?>
		</div>
	</fieldset>
	<div class="form-actions">
		<?php echo $this->Form->Button('Sign Up', array('class' => 'btn btn-info')); ?>
	</div>
	<?php echo $this->Form->Close(); ?>
</div>