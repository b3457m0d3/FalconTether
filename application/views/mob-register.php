<?php
	echo '<div id="content">';
	  echo '<div id="content_cen">';
	    echo '<div id="content_sup" class="head_pad">';
	      echo '<div id="welcom_pan">';
	        echo '<h2><span>AdipA</span> Mob Interactive</h2>';
	      echo '</div>';
	      echo '<div class="lftWrap">';
	        echo '<h3><span>Enroll</span> Here</h3>';
     
	$data = array();
		$rules = array(
			'username'=>'trim|required|min_length[5]|max_length[30]',
			'email'=>'trim|required|valid_email',
			'password'=>'required|matches[password2]',  'password2'=>'required',
			'first_name'=>'trim', 'last_name'=>'trim'
		);
		$fields = array(
			'username'   => 'Username',
			'email'	     => 'E-mail address',
			'password'   =>	'Password',
			'password2'  =>	'Password Confirmation',
			'first_name' =>	'First Name',
			'last_name'  =>	'Last Name'
		);
		$this->validation->set_rules($rules);
		$this->validation->set_fields($fields);
		if ($this->validation->run()) {
			$inp = array(
				'ez_users' => array(
					'username'   =>	$this->input->post('username'),	
					'first_name' =>	$this->input->post('first_name'),	
					'last_name'  =>	$this->input->post('last_name'),	
					'email'	     =>	$this->input->post('email')			
				),
				'ez_access_keys' => array(			
					'tarantism'	 =>	'user',
				),
				'password'  =>	$this->input->post('password')
			);
			
			$verify_yesno = ($this->input->post('verify')) ? true : false;
			$user_reg = $this->ezauth->register($inp, $verify_yesno);	
			if ($user_reg['reg_ok'] == 'yes' && $verify_yesno == true) {
				$v_code = $user_reg['code'];

				$message = '<p>To gain access, you must verify your e-mail
				address by clicking the link below or copying it and pasting it into your browser.</p><p>
				{unwrap}
				<a href="http://www.adipa.mobi/members/verify/'.$v_code.'" 
				title="Verify your e-mail address">http://www.adipa.mobi/members/verify/'.$v_code.'
				{/unwrap}</a></p>';
				
				$this->_send_mail($inp['ez_users']['email'], 'Verify your e-mail address!', $message);
			}
			if ($user_reg['reg_ok'] == 'yes') {
				$user = $inp['ezusers'];
				$un = $user['username'];
				$folder = get_include_path()."assets/users/".$un."/";
				if(mkdir($folder, 0777)){
					if(mkdir($folder."main/", 0777)){
						redirect('/mob/reg_ok');
					}
				}
			} else {
				$data['disp_error'] = 'Error:<br />' . $user_reg['error'];
			}
		}
		$this->load->view('login/register_view', $data);
     
		echo '</div></div></div></div>';
                ?>