<?=$this->validation->error_string?>

<?=form_open('/members/'.$this->uri->segment(2).'/'.$this->uri->segment(3));?>

<p>First Name:<br />
<?=form_input('first_name', $this->validation->first_name,'class="txt"')?>
</p>

<p>Last Name:<br />
<?=form_input('last_name', $this->validation->last_name,'class="txt"')?>
</p>

<p>E-mail:<br />
<?=form_input('email', $this->validation->email,'class="txt"')?>
</p>

<p>Username:<br />
<?=form_input('username', $this->validation->username,'class="txt"')?>
</p>

<p>Password:<br />
<?=form_input('password', $this->validation->password,'class="txt"')?>
</p>

<p>Confirm Password:<br />
<?=form_input('password2', $this->validation->password2,'class="txt"')?>
</p>

<p>
<input type="checkbox" name="verify" value="accept" <?=$this->validation->set_checkbox('verify', 'accept')?>/> Use e-mail address verification?
</p>

<p>
<input type="submit" value="Register" />
</p>

</form>

