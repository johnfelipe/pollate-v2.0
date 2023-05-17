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
			$field_pass    = sc_sec($_POST['ch_pass']);
			$field_newpass = sc_sec($_POST['ch_newpass']);
			$field_repass  = sc_sec($_POST['ch_repass']);

			if((us_password && empty($field_pass)) || empty($field_newpass) || empty($field_repass)){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['password']['alert']['required'])
				];
			} elseif(us_password && sc_pass($field_pass) != us_password){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['password']['alert']['old'])
				];
			} elseif(strlen($field_newpass) < 6 || strlen($field_newpass) > 12){
					$alert = [
							'type'  =>'danger',
							'alert' => fh_alerts($lang['register']['alert']['limited_pass'])
					];
			} elseif($field_newpass != $field_repass){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['password']['alert']['match'])
				];
			} else {
				db_update("users", ['password'=>"'".sc_pass($field_newpass)."'"], us_id);
				$alert = [
						'type'  =>'success',
						'alert' => fh_alerts($lang['password']['alert']['success'], 'success')
				];
			}
			echo json_encode($alert);
		}
}
