
<?=$this->validation->error_string; ?>
<?=(!empty($error_string)) ? '<p>'.$error_string.'</p>' : ''?>

<?=form_open('/members/'.$this->uri->segment(2).'/'.$this->uri->segment(3));?>

<?=form_hidden('redirect_url', 'last_url')?>

<? $cookie_info = $this->ezauth->fetch_userinfo(); ?>
<p>
Username:<br />
<input type="text" name="username" value="<?php echo (!empty($this->validation->username)) ? $this->validation->username : (!empty($cookie_info)) ? $cookie_info : ''; ?>" />
</p>

<p>
Password:<br />
<input type="password" name="password" />
</p>

<p>
<input type="submit" value="Login" />
</p>

</form>

