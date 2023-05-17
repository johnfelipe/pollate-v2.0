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
	if(us_level){

		$pg_email  = sc_sec($_POST['email']);
		$pg_points = (int)($_POST['points']);

		if(empty($pg_points) || empty($pg_email)){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['register']['alert']['required'])
				];
		} elseif($pg_points > us_credits || ($pg_points*site_credit_value) < site_credit_reach){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['alerts']['wrong'])
				];
		} else {
				$data = [
					'credits'    => "'{$pg_points}'",
					'price'      => "'".$pg_points*site_credit_value."'",
					'email'      => "'{$pg_email}'",
					'author'     => "'".us_id."'",
					'created_at' => "'".time."'"
				];

				db_insert( 'payout', $data );

				# User Credits
				db_update("users", ["credits" => "credits-".$pg_points.""], us_id);

				$alert = [
						'type'  =>'success',
						'alert' => fh_alerts('Payout sended successfully.', 'success')
				];
		}

		echo json_encode($alert);
	}
}
