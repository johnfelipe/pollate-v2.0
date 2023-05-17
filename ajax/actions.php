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

		$id        = isset($_POST['id']) ? (int)($_POST['id']) : 0;
		$multi     = isset($_POST['multi']) && $_POST['multi'] == 'true' ? true : false;
		$multi_ids = isset($_POST['multi_ids']) ? sc_array($_POST['multi_ids'], 'int') : [];

		switch($type){
			#--------------------------------#
			#--+ Question Follow           --#
			#--------------------------------#
			case 'question-follow':
				if(!db_rows("questions WHERE id = '{$id}'")){
					$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['alerts']['wrong'], 'danger', false)
					];
				} elseif(db_rows("tags WHERE question = '{$id}' AND author = '".us_id."'")){
					$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['questions']['alert']['fl-already'], 'danger', false)
					];
				} elseif(db_get('questions', 'author', $id) == us_id){
					$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['questions']['alert']['fl-own'], 'danger', false)
					];
				} else {
					db_insert( 'tags', [
						'question' => "'{$id}'",
						'author'   => "'".us_id."'",
						'date'     => "'".time."'"
					]);

					# Question Statistics
					fh_statistics_update('questions', 'tags', $id);

					# User Statistics
					fh_statistics_update('users', 'tags', us_id, true, us_statistics);

					# Set Notifications
					fh_notificationSET($id, 'tag');

					$alert = [
							'type'  =>'success',
							'alert' => fh_alerts($lang['questions']['alert']['fl-success'], 'success', false)
					];
				}
			break;
			#--------------------------------#
			#--+ Question Unfollow         --#
			#--------------------------------#
			case 'question-unfollow':
				if(!db_rows("tags WHERE question = '{$id}' AND author = '".us_id."'")){
					$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['alerts']['wrong'], 'danger', false)
					];
				} else {
					db_delete('tags', $id, "question", "AND author = '".us_id."'");

					# Question Statistics
					fh_statistics_update('questions', 'tags', $id, false);

					# User Statistics
					fh_statistics_update('users', 'tags', us_id, false, us_statistics);

					# DELETE Notifications
					fh_notificationDEL($id, 'tag');

					$alert = [
						'type'  =>'success',
						'alert' => fh_alerts($lang['questions']['alert']['fl-delete'], 'success', false)
					];
				}
			break;
			#--------------------------------#
			#--+ Question Trash            --#
			#--------------------------------#
			case 'question-trash':
				if(us_level == 6){
					if(!db_rows("questions WHERE id = '{$id}'")){
						$alert = [
							'type'  =>'danger',
							'alert' => fh_alerts($lang['alerts']['wrong'], 'danger', false)
						];
					} else {
						db_trash( 'questions', $id);
						db_trash( 'votes', $id, 'question');
						db_trash( 'answers', $id, 'question');

						$alert = [
							'type'  =>'success',
							'alert' => fh_alerts($lang['questions']['alert']['trash'], 'success', false)
						];
					}
				} else {
					$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['alerts']['wrong'], 'danger', false)
					];
				}
			break;
			#--------------------------------#
			#--+ Member Follow             --#
			#--------------------------------#
			case 'member-follow':
				if(!db_rows("users WHERE id = '{$id}'")){
					$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['alerts']['wrong'], 'danger', false)
					];
				} elseif(db_rows("followers WHERE user = '{$id}' AND author = '".us_id."'")){
					$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['members']['alert']['fl-already'], 'danger', false)
					];
				} elseif($id == us_id){
					$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['members']['alert']['fl-own'], 'danger', false)
					];
				} else {
					db_insert( 'followers', [
						'user'   => "'{$id}'",
						'author' => "'".us_id."'",
						'date'   => "'".time."'"
					]);

					# Question Statistics
					fh_statistics_update('users', 'followers', $id);

					# User Statistics
					fh_statistics_update('users', 'following', us_id, true, us_statistics);

					# Set Notifications
					fh_notificationSET($id, 'follow');

					$alert = [
						'type'  =>'success',
						'alert' => fh_alerts($lang['members']['alert']['fl-success'], 'success', false)
					];
				}
			break;
			#--------------------------------#
			#--+ Member Unfollow           --#
			#--------------------------------#
			case 'member-unfollow':
				if(!db_rows("followers WHERE user = '{$id}' AND author = '".us_id."'")){
					$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['alerts']['wrong'], 'danger', false)
					];
				} else {
					db_delete('followers', $id, "user", "AND author = '".us_id."'");

					# Question Statistics
					fh_statistics_update('users', 'followers', $id, false);

					# User Statistics
					fh_statistics_update('users', 'following', us_id, false, us_statistics);

					# DELETE Notifications
					fh_notificationDEL($id, 'follow');

					$alert = [
							'type'  =>'success',
							'alert' => fh_alerts($lang['members']['alert']['fl-delete'], 'success', false)
					];
				}
			break;
			#--------------------------------#
			#--+ Notification Read         --#
			#--------------------------------#
			case 'notification-read':
				if(db_get('notifications', 'user', $id) == us_id && db_get('notifications', 'status', $id) == 0){
					db_update('notifications', ['status'=>'1'], $id);
					$alert = [
						'type'  =>'success'
					];
				} else {
					$alert = [
						'type'  =>'danger'
					];
				}
			break;
			#--------------------------------#
			#--+ Notifications Read All    --#
			#--------------------------------#
			case 'read-all-noty':
				db_update('notifications', ['status'=>'1'], us_id, 'user');
				$alert = [
					'type'  =>'success',
				];
			break;
			#--------------------------------#
			#--+ Categories Trash          --#
			#--------------------------------#
			case 'category-trash':
				$alert = fh_cp_trash('categories', 'category');
			break;
			#--------------------------------#
			#--+ Pages Trash               --#
			#--------------------------------#
			case 'page-trash':
				$alert = fh_cp_trash('pages', 'page');
			break;


			#--------------------------------#
			#--+ Questions Trash           --#
			#--------------------------------#
			case 'questions-trash':
				$alert = fh_cp_trash('questions', 'question');
			break;
			#--------------------------------#
			#--+ Questions Reject          --#
			#--------------------------------#
			case 'questions-reject':
				$alert = fh_cp_update('questions', 'rejected', ['moderat' => '1']);
			break;
			#--------------------------------#
			#--+ Questions Approve         --#
			#--------------------------------#
			case 'questions-approve':
				$alert = fh_cp_update('questions', 'approved', ['moderat' => '0']);
			break;


			#--------------------------------#
			#--+ Subscribers Trash           --#
			#--------------------------------#
			case 'subscribers-trash':
				$alert = fh_cp_trash('subscribers', 'subscriber');
			break;


			#--------------------------------#
			#--+ Lang Trash           --#
			#--------------------------------#
			case 'payout-approved':
				$alert = fh_cp_update('payout', 'approved', ['status' => '1', 'accepted_at' => "'".time."'"]);
			break;


			#--------------------------------#
			#--+ Lang Trash           --#
			#--------------------------------#
			case 'lang-trash':
				$alert = fh_cp_trash('lang', 'language');
			break;


			#--------------------------------#
			#--+ Comments Trash           --#
			#--------------------------------#
			case 'comments-trash':
				$alert = fh_cp_trash('comments', 'comment');
			break;
			#--------------------------------#
			#--+ Comments Reject          --#
			#--------------------------------#
			case 'comments-reject':
				$alert = fh_cp_update('comments', 'rejected', ['moderat' => '1']);
			break;
			#--------------------------------#
			#--+ Comments Approve         --#
			#--------------------------------#
			case 'comments-approve':
				$alert = fh_cp_update('comments', 'approved', ['moderat' => '0']);
			break;


			#--------------------------------#
			#--+ Members Trash           --#
			#--------------------------------#
			case 'members-trash':
				$alert = fh_cp_trash('users');
			break;
			#--------------------------------#
			#--+ Members Reject          --#
			#--------------------------------#
			case 'members-reject':
				$alert = fh_cp_update('users', 'rejected', ['moderat' => '1']);
			break;
			#--------------------------------#
			#--+ Members Approve         --#
			#--------------------------------#
			case 'members-approve':
				$alert = fh_cp_update('users', 'approved', ['moderat' => '0']);
			break;
			#--------------------------------#
			#--+ Members Ban         --#
			#--------------------------------#
			case 'members-ban':
				$alert = fh_cp_update('users', 'baned', ['moderat' => '1']);
			break;
			#--------------------------------#
			#--+ Members Unban         --#
			#--------------------------------#
			case 'members-unban':
				$alert = fh_cp_update('users', 'unbaned', ['moderat' => '0']);
			break;
			#--------------------------------#
			#--+ Members Verified         --#
			#--------------------------------#
			case 'members-verified':
				$alert = fh_cp_update('users', 'verified', ['verified' => '1']);
			break;
			#--------------------------------#
			#--+ Members Unverified         --#
			#--------------------------------#
			case 'members-unverified':
				$alert = fh_cp_update('users', 'unverified', ['verified' => '0']);
			break;
			#--------------------------------#
			#--+ Members Admin         --#
			#--------------------------------#
			case 'members-admin':
				$alert = fh_cp_update('users', 'make as admin', ['level' => '6']);
			break;
			#--------------------------------#
			#--+ Members User         --#
			#--------------------------------#
			case 'members-user':
				$alert = fh_cp_update('users', 'make as user', ['level' => '1']);
			break;


			#--------------------------------#
			#--+ Question Trash            --#
			#--------------------------------#
			case '[question]-[trash]':
			break;
		}

		echo json_encode($alert);
	}
}
