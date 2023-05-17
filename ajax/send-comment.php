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
		$poll_id = (int)($_POST['poll_id']);
		$content = sc_sec($_POST['content'], true);

		if( !db_rows("questions WHERE id = '{$poll_id}'") || empty($content) ){
				$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['questions']['alert']['all'])
				];
		} else {

			$data = array(
				'content'  => "'{$content}'",
				'author'   => "'".us_id."'",
				'question' => "'{$poll_id}'",
				'date'     => "'".time."'"
			);

			if(site_comments)
				$data['moderat'] = "'1'";

			db_insert("comments", $data);

			# Question Statistics
			fh_statistics_update('questions', 'comments', $poll_id);

			# User Statistics
			fh_statistics_update('users', 'comments', us_id, true, us_statistics);

			# Set Notification
			fh_notificationSET($poll_id, 'comment');

			# Set Credits
			db_update("users", ["credits" => "credits+".fh_creditSET('comment').""], us_id);

			$alert = [
					'type'  =>'success'
			];

			$alert['html']  = '
				<div class="media pl-comment instant_comment" id="c'.$poll_id.db_get("comments","id",us_id,"author","and question='{$poll_id}' ORDER BY id DESC LIMIT 1").'">
						<div class="media-left">
								<div class="pl-thumb">
										<img src="'.us_photo.'" alt="'.us_username.'" onerror="this.src=\''.transparent.'\'" />
								</div>
						</div>
						<div class="media-body">
								<div class="pl-title">'.$lang['questions']['by'].' '.fh_user(us_id).' <span>'.$lang['questions']['now'].'</span></div>
								<div class="pl-cmt-content">'.db_break($content).'</div>
								<!--<div class="pl-votes">
										<span><i class="fas fa-thumbs-up"></i> 22</span>
										<span><i class="fas fa-thumbs-down"></i> 3</span>
								</div>-->
						</div>
				</div>';
		}
		echo json_encode($alert);
	}
}
