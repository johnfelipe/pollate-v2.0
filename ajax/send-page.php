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
		$pg_footer   = (isset($_POST['footer']) ? 1 : 0);
		$pg_content  = sc_sec($_POST['pg_content'], true);
		$pg_keywords = sc_array(explode(',',$_POST['pg_keywords']));

		if(empty($pg_title) || empty($pg_content) || count($pg_keywords) < 3){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['register']['alert']['required'])
				];
		} else {
				$data = [
					'title'      => "'{$pg_title}'",
					'sort'       => "'{$pg_sort}'",
					'footer'     => "'{$pg_footer}'",
					'content'    => "'{$pg_content}'",
					'keywords'   => "'".serialize($pg_keywords)."'",
					'lastupdate' => "'".time."'"
				];
				if($pg_id){
						db_update('pages', $data, $pg_id);
				} else {
						$data['date'] = "'".time."'";
						db_insert( 'pages', $data );
				}

				$alert = [
						'type'  =>'success',
						'alert' => fh_alerts('Page has sended successfully.', 'success')
				];
	}

	echo json_encode($alert);
	}
}
