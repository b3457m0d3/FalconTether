<? include('top.php'); ?>

<h3>Functions</h3>

<ul style="padding-left: 30px;">
<li><?=anchor('members/register', 'Create an Account')?></li>
<li><?=anchor('/members/login', 'Login')?></li>
<li><?=anchor('/members/changepw', 'Change Account Password')?></li>
<li><?=anchor('/members/logout', 'Logout')?></li>
</ul>

<h3>Account Recovery Functions</h3>

<ol style="padding-left: 30px;">
<li><?=anchor('/members/forgotpw1', 'Send a reset code to your e-mail address')?></li>
<li>Send a temporary password to your e-mail address (link provided by e-mail from function above)</li>
</ol>

<p>
Current user information in EzAuth session:
</p>

<pre>
<? if (!empty($this->ezauth->user)) { print_r($this->ezauth->user); } else { print 'Nothing!'; }?>
</pre>



<? include('bottom.php'); ?>