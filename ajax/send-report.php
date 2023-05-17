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
			$field_id    = (int)$_POST['report_id'];
			$field_title = (int)$_POST['report_title'];
			$field_more  = sc_sec($_POST['report_more']);
			$field_type  = sc_sec($_POST['report_type']);

			if(!in_array($field_title, [1,2,3])){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['report']['alert']['required'])
				];
			} elseif(!in_array($field_type, ['question','user', 'comment'])){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['report']['alert']['error'])
				];
			} else {
				$field_table = '';
				switch($field_type){
					case 'question':
						$field_table = 'questions';
						break;
				}

				if($field_table){
					if(db_rows($field_table." WHERE id = '{$field_id}'")){
						$data = array(
							'title'   => "'{$field_title}'",
							'tid'     => "'{$field_id}'",
							'type'    => "'{$field_type}'",
							'content' => "'{$field_more}'",
							'author'  => "'".us_id."'",
							'date'    => "'".time."'"
						);

						db_insert('reports', $data);

						$alert = [
								'type'  =>'success',
								'alert' => fh_alerts($lang['report']['alert']['success'], 'success')
						];
					} else {
						$alert = [
								'type'  =>'danger',
								'alert' => fh_alerts($lang['report']['alert']['error'])
						];
					}
				} else {
					$alert = [
							'type'  =>'danger',
							'alert' => fh_alerts($lang['report']['alert']['error'])
					];
				}
			}
			echo json_encode($alert);
		}
}
