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
	$as_iframed = isset($_POST['iframed']) ? (int) $_POST['iframed'] : '';
	$as_question = db_get("answers", "question", $as_id);
	$end_date = db_get('questions', 'end_date', $as_question);
	// ! email, sex, address, birth
	$as_coockie = isset($_COOKIE['votingInfo']) ? $_COOKIE['votingInfo'] : [];
	$ck_fileds  = (us_level) ?
			[us_email, us_sex, us_address, us_birth] :
			(empty($as_coockie) ? [] : [$as_coockie['email'], $as_coockie['sex'], $as_coockie['address'], $as_coockie['birth']]);
	if((empty($ck_fileds) || count(array_filter($ck_fileds)) < 4) && !$as_iframed && voting_form){
		if($end_date && $end_date < time){
			$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts($lang['vote']['alert']['expired'], 'danger', false)
			];
		} else {
			$md_html = '
			<div class="modal fade" id="myVoteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			        <h4 class="modal-title" id="myModalLabel">'.$lang['vote']['step'].'</h4>
			      </div>
			      <div class="modal-body">
			        <form class="pl-form">'.(!us_email ? '
								<label>
										'.$lang['register']['email']['label'].' <b class="red">*</b>
										<input type="text" name="reg_email" value="'.us_email.'" placeholder="'.$lang['register']['email']['place'].'">
								</label>
								<p><i class="fas fa-question-circle"></i> '.$lang['register']['email']['p'].'</p>' : '').'
								<div class="pl-row">
									<div class="pl-col-4">
										<label>'.$lang['register']['birth']['label'].' <b class="red">*</b></label>
										<div class="pl-birthdate">
									    <input type="text" name="reg_birth[]" maxlength="2" size="2" placeholder="DD" /> /
									    <input type="text" name="reg_birth[]" maxlength="2" size="2" placeholder="MM" /> /
									    <input type="text" name="reg_birth[]" maxlength="4" size="4" placeholder="YYYY" />
										</div>
									</div>
									<div class="pl-col-4">
										<label>'.$lang['register']['address']['country'].' <b class="red">*</b></label>
										'.fh_regAdress(0).'
									</div>
									<div class="pl-col-4">
											<label>'.$lang['register']['gender']['label'].' <b class="red">*</b></label>
											<div class="pl-select">
													<select name="reg_sex">
															<option value="1">'.$lang['register']['gender']['male'].'</option>
															<option value="2">'.$lang['register']['gender']['female'].'</option>
													</select>
											</div>
									</div>
								</div>
								<hr/>
								<button type="submit" class="pl-buttons bg-0">'.$lang['register']['button'].' <i class="fas fa-arrow-circle-right i-right"></i></button>
								<button type="button" class="pl-buttons bg-9" data-dismiss="modal">'.$lang['close'].' <i class="fas fa-times-circle i-right"></i></button>
								<input type="hidden" name="id" value="'.$as_id.'" />
							</form>
			      </div>
			    </div>
			  </div>
			</div>';

			$alert = [
					'type'  =>'danger',
					'alert' => $md_html,
					'html'  => true
			];
		}
	} else {

		if(!db_rows("answers WHERE id = '{$as_id}'")){
			$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts($lang['alerts']['wrong'], 'danger', false)
			];
		} elseif(fh_voted($as_question) && !db_get("questions", "multiple", $as_question)){
			$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts($lang['vote']['alert']['already'], 'danger', false)
			];
		} elseif($end_date && $end_date < time){
			$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts($lang['vote']['alert']['expired'], 'danger', false)
			];
		} else {

			$vt_email   = (us_email) ? us_email     : $as_coockie['email'];
			$vt_sex     = (us_sex) ? (int)(us_sex)         : (int)($as_coockie['sex']);
			$vt_address = (us_address) ? us_address : serialize(sc_array($as_coockie['address']));
			$vt_birth   = (us_birth) ? us_birth     : serialize(sc_array($as_coockie['birth']));

            if($as_iframed){
                $vt_email   = (us_email) ? us_email     : '';
                $vt_sex     = (us_sex) ? us_sex         : '';
                $vt_address = (us_address) ? us_address : '';
                $vt_birth   = (us_birth) ? us_birth     : '';
            }


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
				'author'   => "'".us_id."'",
				'user'     => "'{$question_auth}'",
				'date'     => "'".time."'",
				'device'  => "'".get_device."'",
				'os'      => "'".get_os."'",
				'browser' => "'".get_browser."'",
				'state'   => "'".get_state."'",
				'ip'       => "'".fh_ip()."'"
			];

			db_insert('votes', $data);
			setcookie( "answer_{$as_id}" , $as_id, time()+3600*24*30*6 );
			if(!db_rows("votes WHERE question = '{$as_question}'"))
				setcookie( "question_{$as_question}" , $as_question, time()+3600*24*30*6 );

			# Question Statistics
			$qs_statistics    = db_get('questions', 'statistics', $as_question);
			$qs_tags          = db_unserialize([$qs_statistics, 'votes']);
			$qs_statistics_up = db_serialize_update([$qs_statistics, 'votes', $qs_tags+1]);

			db_update("questions", ["statistics" => "'".$qs_statistics_up."'", "votes" => "votes+1"], $as_question);

			# User Statistics
			$us_statistics    = us_statistics;
			$us_tags          = db_unserialize([$us_statistics, 'votes']);
			$us_statistics_up = db_serialize_update([$us_statistics, 'votes', $us_tags+1]);

			db_update("users", ["statistics" => "'".$us_statistics_up."'"], us_id);

			# Set Notification
			if(us_level)
				fh_notificationSET($as_question, 'vote');

			# Set Credits
			db_update("users", ["credits" => "credits+".fh_creditSET('vote').""], us_id);

			$alert = [
				'type'  => 'success',
				'alert' => fh_alerts($lang['vote']['alert']['success'], 'success', false)
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
	}

	echo json_encode($alert);
}
