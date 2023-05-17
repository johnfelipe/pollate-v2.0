<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(!us_level){
				$reg_token  = sc_sec($_POST['token']);
				$reg_t      = sc_sec($_POST['t']);
				$reg_pass   = sc_sec($_POST['reg_pass']);
				$reg_repass = sc_sec($_POST['reg_repass']);

				$reg_email   = db_get('users', 'email', $reg_t, 'md5(email)');
				$token_email = db_get('resets', 'email', $reg_token, 'token');

				if(!$reg_email || $reg_email != $token_email){
					$alert = [
							'type'  =>'danger',
							'alert' => fh_alerts("something wrong...")
					];
				} elseif(empty($reg_pass) || empty($reg_repass)){
						$alert = [
								'type'  =>'danger',
								'alert' => fh_alerts($lang['register']['alert']['required'])
						];
				} elseif(strlen($reg_pass) < 6 || strlen($reg_pass) > 12){
						$alert = [
								'type'  =>'danger',
								'alert' => fh_alerts($lang['register']['alert']['limited_pass'])
						];
				} elseif($reg_pass != $reg_repass){
						$alert = [
								'type'  =>'danger',
								'alert' => fh_alerts($lang['register']['alert']['repass'])
						];
				} else {

					db_update( 'resets', ['status' => '1'], $reg_token, 'token' );
					db_update( 'users', ['password' => "'".sc_pass($reg_pass)."'"], $reg_email, 'email' );

					$alert = [
							'type'  =>'success',
							'alert' => fh_alerts('tokensent', 'success')
					];


				}

				echo json_encode($alert);
		}
}
