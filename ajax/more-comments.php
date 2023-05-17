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

$poll_id  = (int)($_POST['poll_id']);
$last_id  = (int)($_POST['last_id']);
$com_id   = (int)($_POST['com_id']);
$push_arr = isset($_POST['push_arr']) ? implode(',',sc_array($_POST['push_arr'], 'int')) : "";
$condition_arr = !empty($push_arr) ? "AND id NOT IN ({$push_arr})" : "";
$alert = ['html'=>''];

$sql = $db->query("SELECT * FROM ".prefix."comments WHERE id < '{$last_id}' AND question = '{$poll_id}' {$condition_arr} ORDER BY id DESC LIMIT 1");
if($sql->num_rows){
	while($rs=$sql->fetch_assoc()){
		$last_comment = $rs['id'];
		$alert['html']  = '
			<div class="media pl-comment instant_comment" id="c'.$poll_id.db_get("comments","id",$rs['author'],"author","and question='{$poll_id}' ORDER BY id DESC LIMIT 1").'">
					<div class="media-left">
							<div class="pl-thumb">
									<img src="'.db_get('users', 'photo', $rs['author']).'" alt="'.fh_user($rs['author'], false).'" onerror="this.src=\''.fh_thumbERROR('user', db_get('users', 'sex', $rs['author'])).'\'" />
							</div>
					</div>
					<div class="media-body">
							<div class="pl-title">By '.fh_user($rs['author']).' <span>'.fh_ago($rs['date']).'</span></div>
							<div class="pl-cmt-content">'.db_output($rs['content'], true, true).'</div>
							<!--<div class="pl-votes">
									<span><i class="fas fa-thumbs-up"></i> 22</span>
									<span><i class="fas fa-thumbs-down"></i> 3</span>
							</div>-->
					</div>
			</div>';
	}
	$alert['url'] = '<a href="#" id="pl-more-'.$last_comment.'" rel="'.$poll_id.'">View more comments</a>
		<span class="pull-right"><small>'.($com_id+1).'</small>/'.db_unserialize([db_get("questions","statistics",$poll_id), 'comments']).'</span>';
	$alert['type']  = 'success';
}
echo json_encode($alert);
