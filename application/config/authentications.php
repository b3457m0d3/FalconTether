<?php
//class Login extends CI_Controller
class authentications extends controller {

	function authenticatewith( $provider )
	{
		GLOBAL $hybridauth_config;

		try{
			$hybridauth = new Hybrid_Auth( $hybridauth_config );
			$adapter = $hybridauth->authenticate( $provider );
			$user_profile = $adapter->getUserProfile();
			$user = $this->loadModel( "user" );
			$authentication_info = $user->find_by_provider_uid( $provider, $user_profile->identifier );
			if( $authentication_info ){
				$_SESSION["user"] = $authentication_info["user_id"]; 
				$this->redirect( "users/profile" );
			} else {
			
				$provider_uid  = $user_profile->identifier;
				$email         = $user_profile->email;
				$first_name    = $user_profile->firstName;
				$last_name     = $user_profile->lastName;
				$display_name  = $user_profile->displayName;
				$website_url   = $user_profile->webSiteURL;
				$profile_url   = $user_profile->profileURL;
				$photo         = $user_profile->photoURL;
				$password      = rand( );
				$check_user = $user->checkUser($display_name);
				if($check_user){
					$new_user_id = $user->create( $provider, $provider_uid, $email, $password, $display_name, $photo, $first_name, $last_name, $profile_url, $website_url );
					if(!$new_user_id)
					  die('That Email and/or Username is already in use.  Use the browsers Back button to change them.');
					else {
					  $_SESSION["user"] = $new_user_id;
					  $this->redirect( "users/profile" );
					}
				}
			}
		}
		catch( Exception $e ){
			// Display the recived error
			switch( $e->getCode() ){ 
				case 0 : $error = "Unspecified error."; break;
				case 1 : $error = "Hybriauth configuration error."; break;
				case 2 : $error = "Provider not properly configured."; break;
				case 3 : $error = "Unknown or disabled provider."; break;
				case 4 : $error = "Missing provider application credentials."; break;
				case 5 : $error = "Authentification failed. The user has canceled the authentication or the provider refused the connection."; break;
				case 6 : $error = "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again."; 
					     $adapter->logout(); 
					     break;
				case 7 : $error = "User not connected to the provider."; 
					     $adapter->logout(); 
					     break;
			} 

			// well, basically your should not display this to the end user, just give him a hint and move on..
			$error .= "<br /><br /><b>Original error message:</b> " . $e->getMessage(); 
			$error .= "<hr /><pre>Trace:<br />" . $e->getTraceAsString() . "</pre>"; 

			// load error view
			$data = array( "error" => $error ); 
			$this->loadView( "pages/error", $data );
		}
	}
}
