<?php
# -------------------------------------------------#
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
#	¤                                            ¤   #
#	¤         Pollogo - Poll script 1.0          ¤   #
#	¤--------------------------------------------¤   #
#	¤              By Khalid Puerto              ¤   #
#	¤--------------------------------------------¤   #
#	¤                                            ¤   #
#	¤  Facebook : fb.com/prof.puertokhalid       ¤   #
#	¤  Instagram : instagram.com/khalidpuerto    ¤   #
#	¤  Site : http://www.puertokhalid.com        ¤   #
#	¤                                            ¤   #
#	¤--------------------------------------------¤   #
#	¤                                            ¤   #
#	¤  Last Update: 21/04/2020                   ¤   #
#	¤                                            ¤   #
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
# -------------------------------------------------#

if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(!us_level){
				$reg_email   = sc_sec($_POST['reset_email']);

				if(empty($reg_email)){
						$alert = [
								'type'  =>'danger',
								'alert' => fh_alerts($lang['forget']['alert']['required'])
						];
				} elseif(!db_rows("users WHERE email = '".$reg_email."' || username = '".$reg_email."'")){
						$alert = [
								'type'  =>'danger',
								'alert' => fh_alerts($lang['forget']['alert']['email'])
						];
				} else {

					$token     = bin2hex(openssl_random_pseudo_bytes(16));
					$reset_url = path."/password-reset.php?action=reset&token=".$token."&t=".md5($reg_email);

					$to      = $reg_email;
					$name    = db_get('users', 'username', $reg_email, 'email');
					$from    = notreply;
					$subject = "Pollate: Password Reset";
					$body    = "";
					$html    = fh_resset_p(fh_bbcode(fotget_password_msg), $reset_url, [$name, $to]);
					$mail    = new Mail($to, $from, $subject, $body, $html);

					if (  $mail->send() ) {

						$data = [
							'email' => "'{$reg_email}'",
							'token' => "'{$token}'",
							'date'  => "'".time."'",
							'ip'    => "'".ip."'"
						];
						db_insert( 'resets', $data );

						$alert = [
							'type'  =>'success',
							'alert' => fh_alerts($lang['forget']['alert']['success'], 'success')
						];
					} else {
							$alert = [
								'type'  =>'danger',
								'alert' => fh_alerts($lang['forget']['alert']['error'], 'danger')
							];
					}


				}

				echo json_encode($alert);
		}
}
