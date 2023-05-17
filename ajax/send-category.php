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

		$pg_title    = sc_sec($_POST['pg_title']);
		$pg_sort     = (int)($_POST['pg_sort']);
		$pg_id       = (int)($_POST['id']);
		$pg_icon     = sc_sec($_POST['pg_icon']);
		$pg_bg       = sc_sec($_POST['pg_bg']);
		$pg_keywords = sc_array(explode(',',$_POST['pg_keywords']));

		if(empty($pg_title) || empty($pg_icon) || empty($pg_bg) || count($pg_keywords) < 3){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['register']['alert']['required'])
				];
		} else {
				$pg_bg = str_replace("#","",$pg_bg);
				$data = [
					'title'    => "'{$pg_title}'",
					'sort'     => "'{$pg_sort}'",
					'icon'     => "'{$pg_icon}'",
					'keywords' => "'".serialize($pg_keywords)."'",
					'bg'       => "'{$pg_bg}'"
				];
				if($pg_id){
						db_update('categories', $data, $pg_id);
				} else {
						db_insert( 'categories', $data );
				}

				$alert = [
						'type'  =>'success',
						'alert' => fh_alerts('Category has sended successfully.', 'success')
				];
		}

		echo json_encode($alert);
	}
}
