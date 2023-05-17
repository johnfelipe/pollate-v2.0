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
	if(us_level == 6){

		$pg_title         = sc_sec($_POST['pg_title']);
		$pg_description   = sc_sec($_POST['pg_description']);
		$pg_keywords      = sc_array(explode(',',$_POST['pg_keywords']));
		$pg_question      = (int)($_POST['pg_question']);
		$pg_comment       = (int)($_POST['pg_comment']);
		$pg_register      = (int)($_POST['pg_register']);
		$voting_form      = (int)($_POST['voting_form']);
		$credits_question = (int)($_POST['credits_question']);
		$credits_vote     = (int)($_POST['credits_vote']);
		$credits_comment  = (int)($_POST['credits_comment']);
		$credits_register = (int)($_POST['credits_register']);
		$facebook_box     = sc_sec($_POST['facebook_box']);
		$ads_1            = $db->real_escape_string($_POST['ads_1']);
		$ads_2            = $db->real_escape_string($_POST['ads_2']);
		$ads_3            = $db->real_escape_string($_POST['ads_3']);
		$ads_4            = $db->real_escape_string($_POST['ads_4']);
		$ads_5            = $db->real_escape_string($_POST['ads_5']);
		$notreply         = sc_sec($_POST['notreply']);
		$email_verification_msg = sc_sec($_POST['email_verification_msg']);
		$fotget_password_msg    = sc_sec($_POST['fotget_password_msg']);
		$home_questions       = (int)($_POST['home_questions']);
		$login_facebook       = (int)($_POST['login_facebook']);
		$login_twitter        = (int)($_POST['login_twitter']);
		$login_google         = (int)($_POST['login_google']);
		$site_paypal_live     = (int)($_POST['site_paypal_live']);
		$site_plan            = (int)($_POST['site_plan']);
		$login_fbAppId        = sc_sec($_POST['login_fbAppId']);
		$login_fbAppSecret    = sc_sec($_POST['login_fbAppSecret']);
		$login_fbAppVersion   = sc_sec($_POST['login_fbAppVersion']);
		$login_twConKey       = sc_sec($_POST['login_twConKey']);
		$login_twConSecret    = sc_sec($_POST['login_twConSecret']);
		$login_ggClientId     = sc_sec($_POST['login_ggClientId']);
		$login_ggClientSecret = sc_sec($_POST['login_ggClientSecret']);
		$site_paypal_id       = sc_sec($_POST['site_paypal_id']);
		$site_paypal_currency = sc_sec($_POST['site_paypal_currency']);
		$site_credit_value = sc_sec($_POST['site_credit_value']);
		$site_credit_reach = sc_sec($_POST['site_credit_reach']);


		if(empty($pg_title) || empty($pg_description) || count($pg_keywords) < 3){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['register']['alert']['required'])
				];
		} else {
				db_update_global('site_title', $pg_title);
				db_update_global('site_description', $pg_description);
				db_update_global('site_keywords', implode(',', $pg_keywords));
				db_update_global('site_letters', $pg_question); // Questions
				db_update_global('site_comments', $pg_comment);
				db_update_global('site_register', $pg_register);
				db_update_global('voting_form', $voting_form);
				db_update_global('credits_question', $credits_question);
				db_update_global('credits_vote', $credits_vote);
				db_update_global('credits_comment', $credits_comment);
				db_update_global('credits_register', $credits_register);
				db_update_global('facebook_box', $facebook_box);
				db_update_global('ads_1', $ads_1);
				db_update_global('ads_2', $ads_2);
				db_update_global('ads_3', $ads_3);
				db_update_global('ads_4', $ads_4);
				db_update_global('ads_5', $ads_5);
				db_update_global('notreply', $notreply);
				db_update_global('home_questions', $home_questions);
				db_update_global('email_verification_msg', $email_verification_msg);
				db_update_global('fotget_password_msg', $fotget_password_msg);
				db_update_global('login_facebook', $login_facebook);
				db_update_global('login_twitter', $login_twitter);
				db_update_global('login_google', $login_google);
				db_update_global('site_paypal_live', $site_paypal_live);
				db_update_global('site_plan', $site_plan);
				db_update_global('login_fbAppId', $login_fbAppId);
				db_update_global('login_fbAppSecret', $login_fbAppSecret);
				db_update_global('login_fbAppVersion', $login_fbAppVersion);
				db_update_global('login_twConKey', $login_twConKey);
				db_update_global('login_twConSecret', $login_twConSecret);
				db_update_global('login_ggClientId', $login_ggClientId);
				db_update_global('login_ggClientSecret', $login_ggClientSecret);
				db_update_global('site_paypal_id', $site_paypal_id);
				db_update_global('site_paypal_currency', $site_paypal_currency);
				db_update_global('site_credit_value', $site_credit_value);
				db_update_global('site_credit_reach', $site_credit_reach);

				$alert = [
						'type'  =>'success',
						'alert' => fh_alerts('Setting has sent successfully.', 'success')
				];
		}
		echo json_encode($alert);
	}
}
