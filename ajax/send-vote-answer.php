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
	$as_id = (int) $_POST['id'];
	$as_question = db_get("answers", "question", $as_id);

	$reg_email   = (us_email) ? us_email : sc_sec($_POST['reg_email']);
	$reg_sex     = (in_array($_POST['reg_sex'], [1, 2])) ? (int)$_POST['reg_sex'] : 0;
	$reg_birth   = is_array($_POST['reg_birth']) ? sc_array($_POST['reg_birth'], 'int') : [];
	$reg_city    = sc_sec($_POST['reg_address']);



	if(empty($reg_email) || !$reg_sex || count($reg_birth) != 3 || !$reg_city){
			$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts($lang['register']['alert']['required'])
			];
	} elseif(!check_email($reg_email)){
			$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts($lang['register']['alert']['check_email'])
			];
	} elseif(!us_email && db_rows("users WHERE email = '".$reg_email."'")){
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
		if(!isset($_COOKIE['votingInfo'])){
			$reg_address = [$reg_city, '--', '--'];
			$data = [
				'email'    => "'{$reg_email}'",
				"sex"      => "'{$reg_sex}'",
				"address"  => "'".serialize($reg_address)."'",
				"birth"    => "'".serialize($reg_birth)."'"
			];

			if(us_level){
				db_update( 'users', $data, us_id );
			} else {
				setcookie("votingInfo[email]", $reg_email, time()+(3600*24*365));
				setcookie("votingInfo[sex]", $reg_sex, time()+(3600*24*365));
				setcookie("votingInfo[address][country]", $reg_address[0], time()+(3600*24*365));
				setcookie("votingInfo[address][city]", $reg_address[1], time()+(3600*24*365));
				setcookie("votingInfo[address][town]", $reg_address[2], time()+(3600*24*365));
				setcookie("votingInfo[birth][day]", $reg_birth[0], time()+(3600*24*365));
				setcookie("votingInfo[birth][month]", $reg_birth[1], time()+(3600*24*365));
				setcookie("votingInfo[birth][year]", $reg_birth[2], time()+(3600*24*365));
			}

			$end_date = db_get('questions', 'end_date', $as_question);
			if(!db_rows("answers WHERE id = '{$as_id}'")){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['alerts']['wrong'])
				];
			} elseif(fh_voted($as_question)){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['vote']['alert']['already'])
				];
			} elseif($end_date && $end_date < time){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['vote']['alert']['expired'])
				];
			} else {

				$vt_email   = (us_email) ? us_email     : $reg_email;
				$vt_sex     = (us_sex) ? us_sex         : $reg_sex;
				$vt_address = (us_address) ? us_address : serialize($reg_address);
				$vt_birth   = (us_birth) ? us_birth     : serialize($reg_birth);

				$question_auth = db_get("questions", "author", $as_question);
				if(!fh_planAccess('vote', $question_auth)){
					$alert = [
							'type'  =>'danger',
							'alert' => fh_alerts($lang['alerts']['planvote'], 'danger', false)
					];
					echo json_encode($alert);
					exit;
				}

				$que_country = db_unserialize([$vt_address, 1]);
				$que_country = $que_country ? $que_country : get_country;

				$que_city = db_unserialize([$vt_address, 0]);
				$que_city = $que_city ? $que_city : get_city;

				$data = [
					'email'    => "'{$vt_email}'",
					'sex'      => "'{$vt_sex}'",
					'address'  => "'{$vt_address}'",
					'birth'    => "'{$vt_birth}'",
					'age'      => "'".fh_birth_age($vt_birth)."'",
					'country'  => "'".$que_country."'",
					'city'     => "'".$que_city."'",
					'answer'   => "'{$as_id}'",
					'question' => "'{$as_question}'",
					'user'     => "'{$question_auth}'",
					'date'     => "'".time."'",
					'device'  => "'".get_device."'",
					'os'      => "'".get_os."'",
					'browser' => "'".get_browser."'",
					'state'   => "'".get_state."'",
					'ip'      => "'".fh_ip()."'"
				];

				db_insert('votes', $data);
				setcookie( "answer_{$as_id}" , $as_id, time()+3600*24*30*6 );
				setcookie( "question_{$as_question}" , $as_question, time()+3600*24*30*6 );

				# Question Statistics
				$qs_statistics    = db_get('questions', 'statistics', $as_question);
				$qs_tags          = db_unserialize([$qs_statistics, 'votes']);
				$qs_statistics_up = db_serialize_update([$qs_statistics, 'votes', $qs_tags+1]);

				db_update("questions", ["statistics" => "'".$qs_statistics_up."'", "votes" => "votes+1"], $as_question);

				# User Statistics
				if(us_level){
					$us_statistics    = us_statistics;
					$us_tags          = db_unserialize([$us_statistics, 'votes']);
					$us_statistics_up = db_serialize_update([$us_statistics, 'votes', $us_tags+1]);

					db_update("users", ["statistics" => "'".$us_statistics_up."'"], us_id);
					db_update("users", ["credits" => "credits+".fh_creditSET('vote').""], us_id);
				}

				# Set Notification
				if(us_level)
					fh_notificationSET($as_question, 'vote');

				# Set Credits

				# Subscribe
				if($vt_email && !db_count("subscribers WHERE email = '{$vt_email}'"))
					db_insert( 'subscribers', ['email' => "'{$vt_email}'", 'date' => "'".time."'"] );

				$alert = [
					'type'  => 'success',
					'id'    => $as_id,
					'alert' => fh_alerts($lang['vote']['alert']['success'], 'success')
				];

				# Answers %
				$sql = db_select([
					'table' => 'answers',
					'where' => "question = '{$as_question}'"
				]);
				while($rs=$sql->fetch_assoc()){
					$alert['percentage'][$rs['id']] = fh_percentage($rs['id'], $as_question)."%";
				}
				$sql->close();
			}

		} else {
			$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts($lang['vote']['alert']['already'])
			];
		}

	}

	echo json_encode($alert);
}
