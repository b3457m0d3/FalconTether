<?php if (!defined('APPLICATION')) exit(); ?>
<div class="Box GuestBox">
	<h4><?php echo T('Howdy, Stranger!'); ?></h4>
	<p><?php echo T('It looks like you&#039;re new here. If you want to get involved, click one of these buttons!'); ?></p>
	<div class="LoginMethods"><?php $this->FireEvent('BeforeSignInButton'); ?></div>
	
	<?php
	if (strcasecmp(C('Garden.Registration.Method'), 'Connect') != 0) {
		echo '<div class="P">';

		echo Anchor(T('Sign In'), SignInUrl($this->_Sender->SelfUrl), 'Button btn-primary');
		$Url = RegisterUrl($this->_Sender->SelfUrl);
		if(!empty($Url))
			echo ' '.Anchor(T('Apply for Membership'), $Url, 'Button ApplyButton btn-info');

		echo '</div>';
	}
	?>
	<?php $this->FireEvent('AfterSignInButton'); ?>
</div>