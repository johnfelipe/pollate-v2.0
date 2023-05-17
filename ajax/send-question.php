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
		$qs_id         = isset($_POST['id'])? (int) $_POST['id'] : '';
		$qs_question   = sc_sec($_POST['qs_question']);
		$qs_category   = (int) $_POST['qs_category'];
		$qs_thumbnail  = isset($_POST['qs_thumb']) ? sc_sec($_POST['qs_thumb']) : '';
		$qs_end_date   = !empty($_POST['qs_end']) ? strtotime(sc_sec($_POST['qs_end'])) : 0;
		$qs_polltype   = isset($_POST['qs_type']) ? (int) $_POST['qs_type'] : 0;
		$qs_answers    = isset($_POST['qs_answers']) ? sc_array($_POST['qs_answers']) : '';
		$qs_answers_i  = isset($_POST['qs_answers_images']) ? sc_array($_POST['qs_answers_images']) : '';
		$qs_answers_id = isset($_POST['qs_answers_id']) ? sc_array($_POST['qs_answers_id'], 'int') : '';

		$qs_multiple = isset($_POST['qs_multiple']) ? 1 : 0;
		$qs_pinned   = isset($_POST['qs_pinned']) && us_level == 6 ? 1 : 0;

		if(!fh_planAccess('ask')){
			$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts($lang['alerts']['plan'])
			];
			echo json_encode($alert);
			exit;
		}

		if(empty($qs_question) || !$qs_category || !$qs_polltype){
			$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts($lang['ask']['alert']['required'])
			];
		} else {
			if($qs_polltype == 1){
				$qs_answers_count = count($qs_answers);
				if($qs_answers_count > 8){
					$alert = [
							'type'  =>'danger',
							'alert' => fh_alerts($lang['ask']['alert']['more'])
					];
				} elseif($qs_answers_count < 2){
					$alert = [
							'type'  =>'danger',
							'alert' => fh_alerts($lang['ask']['alert']['less'])
					];
				} else {
					$alert = fh_sendQuestion();
				}
			} elseif($qs_polltype == 3){
				$qs_answers_count   = count($qs_answers);
				$qs_answers_count_i = count($qs_answers_i);
				if($qs_answers_count > 9){
					$alert = [
							'type'  =>'danger',
							'alert' => fh_alerts($lang['ask']['alert']['more'])
					];
				} elseif($qs_answers_count < 2){
					$alert = [
							'type'  =>'danger',
							'alert' => fh_alerts($lang['ask']['alert']['less'])
					];
				} elseif($qs_answers_count_i < $qs_answers_count){
					$alert = [
							'type'  =>'danger',
							'alert' => fh_alerts($lang['ask']['alert']['images'])
					];
				} else {
					$alert = fh_sendQuestion();
				}
			} else {
				$qs_answers = [$lang['ask']['type']['yesno']['yes'], $lang['ask']['type']['yesno']['no']];
				$alert = fh_sendQuestion();

			}
		}

		echo json_encode($alert);
	}
}
