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
	$reg_email   = sc_sec($_POST['email']);
	if(!check_email($reg_email)){
			$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts($lang['register']['alert']['check_email'], 'danger', false)
			];
	} else {
		# Subscribe
		if($reg_email && !db_count("subscribers WHERE email = '{$reg_email}'")){
			db_insert( 'subscribers', ['email' => "'{$reg_email}'", 'date' => "'".time."'"] );
			$alert = [
					'type'  =>'success',
					'alert' => fh_alerts('Subscribe successfully', 'success', false)
			];
		} else {
			$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts('already subscribe', 'danger', false)
			];
		}
	}
	echo json_encode($alert);
}
