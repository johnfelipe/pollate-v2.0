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
#	¤  Last Update: 26/02/2020                   ¤   #
#	¤                                            ¤   #
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
# -------------------------------------------------#

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	if(!us_level){
		$reg_name    = isset($_POST['reg_name']) ? sc_sec($_POST['reg_name']) : '';
		$reg_pass    = isset($_POST['reg_pass']) ? sc_sec($_POST['reg_pass']) : '';
		$reg_repass  = isset($_POST['reg_repass']) ? sc_sec($_POST['reg_repass']) : '';
		$reg_email   = isset($_POST['reg_email']) ? sc_sec($_POST['reg_email']) : '';
		$reg_sex     = (in_array($_POST['reg_sex'], [1, 2])) ? (int)$_POST['reg_sex'] : 0;
		$reg_birth   = isset($_POST['reg_birth']) ? sc_array($_POST['reg_birth'], 'int') : '';
		$reg_address = isset($_POST['reg_address']) && array_key_exists($_POST['reg_address'], $countries) ? sc_sec($_POST['reg_address']) : '';
		$reg_city    = isset($_POST['reg_city']) ? (int)($_POST['reg_city']) : '--';

		if(empty($reg_name) || empty($reg_pass) || empty($reg_repass) || empty($reg_email) || !$reg_sex || count($reg_birth) != 3 || !$reg_address){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['register']['alert']['required'].$reg_address)
				];
		} elseif(!preg_match('/^[\p{L}\' -]+$/u',$reg_name)){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['register']['alert']['char_username'])
				];
		} elseif(strlen($reg_name) < 3 || strlen($reg_name) > 15){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['register']['alert']['limited_username'])
				];
		} elseif(db_rows("users WHERE username = '".$reg_name."'")){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['register']['alert']['exist_username'])
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
		} elseif(!check_email($reg_email)){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['register']['alert']['check_email'])
				];
		} elseif(db_rows("users WHERE email = '".$reg_email."'")){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['register']['alert']['exist_email'])
				];
		} elseif(!fh_check_date($reg_birth[0], 'day') || !fh_check_date($reg_birth[1], 'month') || !fh_check_date($reg_birth[2], 'year')){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['register']['alert']['birth'])
				];
		} else {
			# moderat | for making sign up by email or need approval
			$reg_address = [$reg_address, $reg_city, '--'];
			$data = [
				'username'   => "'{$reg_name}'",
				'email'      => "'{$reg_email}'",
				'password'   => "'".sc_pass($reg_pass)."'",
				'date'       => "'".time."'",
				'level'      => "'1'",
				'sex'        => "'{$reg_sex}'",
				'address'    => "'".serialize($reg_address)."'",
				'birth'      => "'".serialize($reg_birth)."'",
				'statistics' => "'".serialize(['votes'=>0,'tags'=>0,'comments'=>0,'followers'=>0,'following'=>0,'questions'=>0])."'",
				'credits'    => "'".fh_creditSET('sign-up')."'"
			];

			if(site_register==0){ // moderat(0) -> active
				$alert = [
						'type'  =>'success',
						'alert' => fh_alerts($lang['register']['alert']['success'], 'success')
				];
			} elseif(site_register==2){ // moderat(2) -> email activation

				$token     = bin2hex(openssl_random_pseudo_bytes(16));
				$reset_url = path."/email-verification.php?action=reset&token=".$token."&t=".sha1($reg_email);

				$to      = $reg_email;
				$from    = notreply;
				$subject = "Pollate: Email Verification";
				$body    = "";
				$html    = fh_resset_p(fh_bbcode(email_verification_msg), $reset_url, [$reg_name, $to]);
				$mail    = new Mail($to, $from, $subject, $body, $html);

				if (  $mail->send() ) {
					$alert = [
							'type'  =>'success',
							'alert' => fh_alerts($lang['register']['alert']['success2'], 'success')
					];
				} else {
					$alert = [
							'type'  =>'success',
							'alert' => fh_alerts($lang['register']['alert']['success1'], 'success')
					];
				}

				$data['token'] = "'{$token}'";
				$data['moderat'] = "'2'";
			} else {
				$alert = [
						'type'  =>'success',
						'alert' => fh_alerts($lang['register']['alert']['success1'], 'success')
				];
				$data['moderat'] = "'3'";
			}

			db_insert( 'users', $data );

			# Subscribe
			if($reg_email && !db_count("subscribers WHERE email = '{$reg_email}'"))
				db_insert( 'subscribers', ['email' => "'{$reg_email}'", 'date' => "'".time."'"] );


		}

		echo json_encode($alert);
	}
}
