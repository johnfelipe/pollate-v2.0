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
	if(us_level){
		$reg_id        = isset($_POST['id'])? (int) $_POST['id'] : 0;
		$reg_name      = isset($_POST['reg_name']) ? sc_sec($_POST['reg_name']) : 0;
		$reg_firstname = isset($_POST['reg_firstname']) ? sc_sec($_POST['reg_firstname']) : 0;
		$reg_lastname  = isset($_POST['reg_lastname']) ? sc_sec($_POST['reg_lastname']) : 0;
		$reg_email     = isset($_POST['reg_email']) ? sc_sec($_POST['reg_email']) : 0;
		$reg_sex       = (in_array($_POST['reg_sex'], [1, 2])) ? (int)$_POST['reg_sex'] : 0;
		$reg_birth     = sc_array($_POST['reg_birth'], 'int');
		$reg_address   = isset($_POST['reg_address']) && array_key_exists($_POST['reg_address'], $countries) ? sc_sec($_POST['reg_address']) : '';
		$reg_city      = isset($_POST['reg_city']) ? (int)($_POST['reg_city']) : '--';
		$reg_desc      = isset($_POST['reg_desc']) ? sc_sec($_POST['reg_desc']) : 0;
		$reg_photo     = isset($_POST['reg_photo']) ? sc_sec($_POST['reg_photo']) : '';
		$reg_cover     = isset($_POST['reg_photo']) ? sc_sec($_POST['reg_cover']) : '';
		$reg_facebook  = isset($_POST['reg_facebook']) ? sc_sec($_POST['reg_facebook']) : 0;
		$reg_twitter   = isset($_POST['reg_twitter']) ? sc_sec($_POST['reg_twitter']) : 0;
		$reg_google    = isset($_POST['reg_google']) ? sc_sec($_POST['reg_google']) : 0;
		$reg_instagram = isset($_POST['reg_instagram']) ? sc_sec($_POST['reg_instagram']) : 0;
		$reg_youtube   = isset($_POST['reg_youtube']) ? sc_sec($_POST['reg_youtube']) : 0;

		$email_address = ($reg_id) ? db_get('users', 'email', $reg_id) : us_email;
		$user_name = ($reg_id) ? db_get('users', 'username', $reg_id) : us_username;
		$user_id = ($reg_id && us_level == 6) ? $reg_id : us_id;

		if($reg_id && us_level != 6){
			$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts($lang['alerts']['permission'])
			];
		} elseif(empty($reg_name) || (empty($reg_firstname) && us_level != 6) || (empty($reg_lastname) && us_level != 6) || empty($reg_email) || !$reg_sex || count($reg_birth) != 3 || !$reg_address){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['details']['alert']['required'])
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
		} elseif($user_name != $reg_name && db_rows("users WHERE username = '".$reg_name."'")){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['register']['alert']['exist_username'])
				];
		} elseif(!check_email($reg_email)){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['register']['alert']['check_email'])
				];
		} elseif($email_address != $reg_email && db_rows("users WHERE email = '".$reg_email."'")){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['register']['alert']['exist_email'])
				];
		} elseif(!fh_check_date($reg_birth[0], 'day') || !fh_check_date($reg_birth[1], 'month') || !fh_check_date($reg_birth[2], 'year')){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['register']['alert']['birth'])
				];
		} elseif(strlen($reg_desc) > 50){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['details']['alert']['desc'])
				];
		} else {

			# Move Images
			$photo_rename = ($reg_id) ? db_get('users', 'photo', $reg_id) : us_photo;
			$cover_rename = ($reg_id) ? db_get('users', 'cover', $reg_id) : us_cover;
			if($reg_cover || $reg_photo){
				newImgFolder('uploads/users/'.sc_folderName(us_username));
				if($reg_cover){
					if (file_exists($reg_cover)) {
						$cover_rename = 'uploads/users/'.sc_folderName(us_username).str_replace('uploads-temp', '', $reg_cover);
					  rename($reg_cover, $cover_rename);
						$cover_rename = path."/{$cover_rename}";
					}
				}

				if($reg_photo){
					if (file_exists($reg_photo)) {
						$photo_rename = 'uploads/users/'.sc_folderName(us_username).str_replace('uploads-temp', '', $reg_photo);
					  rename($reg_photo, $photo_rename);
						$photo_rename = path."/{$photo_rename}";
					}
				}
			}

			$reg_address = [$reg_address, $reg_city, '--'];

			$data = [
				'username'    => "'{$reg_name}'",
				'email'       => "'{$reg_email}'",
				'firstname'   => "'{$reg_firstname}'",
				'lastname'    => "'{$reg_lastname}'",
				'sex'         => "'{$reg_sex}'",
				'description' => "'{$reg_desc}'",
				'cover'       => "'{$cover_rename}'",
				'photo'       => "'{$photo_rename}'",
				'socials'     => "'".serialize(['facebook' => "{$reg_facebook}",'twitter' => "{$reg_twitter}",'google' => "{$reg_google}",'youtube' => "{$reg_youtube}",'instagram' => "{$reg_instagram}"])."'",
				'address'     => "'".serialize($reg_address)."'",
				'updated_at'  => "'".time."'",
				'birth'       => "'".serialize($reg_birth)."'"
			];
			db_update('users', $data, $user_id);

			# Subscribe
			if($reg_email && !db_count("subscribers WHERE email = '{$reg_email}'"))
				db_insert( 'subscribers', ['email' => "'{$reg_email}'", 'date' => "'".time."'"] );

			$alert = [
					'type'  =>'success',
					'alert' => fh_alerts($lang['details']['alert']['success'], 'success')
			];
		}

		echo json_encode($alert);
	}
}
