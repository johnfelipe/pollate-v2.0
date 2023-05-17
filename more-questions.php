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
#	¤  Last Update: 26/02/2020                   ¤   #
#	¤                                            ¤   #
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
# -------------------------------------------------#

include __DIR__.'/config.php';

# Header Page
include __DIR__.'/header.php';

if(!db_rows("users WHERE id = '{$id}'")){
	echo fh_alerts($lang['alerts']['wrong']);
	$sidebar = false;
	include __DIR__.'/footer.php';
	exit;
}

if(fh_seoURLCheck(db_get("users", "username", $id)) != $title){
	echo fh_alerts($lang['alerts']['wrong']);
	$sidebar = false;
	include __DIR__.'/footer.php';
	exit;
}

# Main Page
?>
<div class="pl-main">

		<div class="pl-box pl-body-voters">
				<h3 class="pl-tile">
					<?=$lang['members']['questions']?>
					<small><?=db_unserialize([db_get('users', 'statistics', $id), 'questions'])?></small>
				</h3>
				<h3 class="pl-tile2">
					<?=$lang['members']['pg-follow']?> <b><?=db_get('users', 'username', $id)?></b>
				</h3>
		<?php
		$sql = db_select([
				'table'  => 'questions',
				'column' => 'id, question, thumbnail, date, statistics',
				'where'  => 'author = "'.$id.'" && trash = 0 && moderat = 0',
				'order'  => 'ORDER BY id DESC LIMIT '.$startpoint.' , '.$limit
		]);
		if($sql->num_rows):
		while($rs = $sql->fetch_assoc()):
		?>
		<div class="pl-questions">
				<div class="media">
						<?php if($rs['thumbnail']): ?>
						<div class="media-left">
								<div class="pl-thumb">
										<img src="<?=path?>/<?=$rs['thumbnail']?>" alt="<?=$rs['question']?>" onerror="this.src='<?=transparent?>'">
								</div>
						</div>
						<?php endif; ?>
						<div class="media-body">
								<div class="pl-dtable">
										<div class="pl-vmiddle">
												<h3 class="pl-title"><a href="<?=path?>/questions.php?id=<?=fh_seoURL($rs['id'], 'question', $rs['question'])?>"><?=db_output($rs['question'])?></a></h3>
												<div class="pl-details">
													<i class="icon-calendar icons"></i> <?=fh_ago($rs['date'])?>
													<i class="icon-bubbles icons"></i> <?=db_unserialize([$rs['statistics'], 'comments'])?> <?=$lang['questions']['replies']?>
													<i class="icon-star icons"></i> <?=db_unserialize([$rs['statistics'], 'votes'])?> <?=$lang['questions']['votes']?>
													<i class="icon-people icons"></i> <span class="pl-show-tags"><?=db_unserialize([$rs['statistics'], 'tags'])?></span> <?=$lang['questions']['tags']?>
												</div>
										</div>
								</div>
								<div class="pl-options">
										<a href="#" class="pl-user-options"><i class="icon-options-vertical icons"></i></a>
										<ul class="dropdown">
												<?php $count_tags = db_rows("tags WHERE question = '{$rs['id']}' && author = '".us_id."'");?>
												<li>
													<a href="javascript:void(0)" rel="<?=$rs['id']?>" class="pl-question-<?=($count_tags?'un':'')?>follow-list">
														<i class="icon-user-<?=($count_tags?'un':'')?>follow icons"></i> <?=($count_tags?$lang['questions']['unfollow']:$lang['questions']['follow'])?>
													</a>
												</li>
												<li>
													<a href="#" data-toggle="modal" data-target="#report-modal" rel="<?=$rs['id']?>">
														<i class="icon-flag icons"></i> <?=$lang['questions']['report']?>
													</a>
												</li>
												<?php if(us_level == 6 || us_id == db_get('questions', 'author', $rs['id'])): ?>
												<li><a href="<?=path?>/ask.php?id=<?=fh_seoURL($rs['id'], 'ask', $rs['question'])?>"><i class="icon-pencil icons"></i> <?=$lang['questions']['edit']?></a></li>
												<?php if(us_level == 6): ?>
												<li><a href="javascript:void(0)" rel="<?=$rs['id']?>" class="pl-question-trash"><i class="icon-trash icons"></i> <?=$lang['questions']['delete']?></a></li>
												<?php endif; ?>
												<?php endif; ?>
										</ul>
								</div>
						</div>
				</div>
		</div>
		<?php
		endwhile;
		else:
		?>
		<div class="pl-not-found"><?=$lang['alerts']['no-data']?></div>
		<?php
		endif;
		$sql->close();
		?>
		</div>
		<?php
		echo pl_pagination('questions WHERE author = "'.$id.'" && trash = 0 && moderat = 0', $limit,path.'/more-questions.php?id='.$id.'&title='.$title.'&');
		?>
</div><!-- End Main -->

<?php
$sidebar = [
	'access'     => true,
	'ads'        => true,
	'questions'  => false,
	'categories' => false,
	'social'     => true,
	'people'     => true
];

# Footer Page
include __DIR__.'/footer.php';
