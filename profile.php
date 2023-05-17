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
		<?php
		$profile_rs = db_rs(db_select([
				'table'  => 'users',
				'column' => 'id, username, photo, cover, statistics, sex, socials, verified',
				'where'  => 'id = "'.$id.'" && trash = 0 && moderat = 0'
		]));
		if($profile_rs):
		?>
		<?php if($profile_rs['cover']): ?>
		<style>
		.pl-body-profile .pl-cover:before { background-image: url(<?=$profile_rs['cover']?>); }
		</style>
		<?php endif; ?>
		<div class="pl-box">
				<div class="pl-cover">
						<div class="pl-content">
								<div class="media">
										<div class="media-left">
												<div class="pl-thumb"><img src="<?=$profile_rs['photo']?>" alt="<?=$profile_rs['username']?>" onerror="this.src='<?=fh_thumbERROR('user', $profile_rs['sex'])?>'"></div>
										</div>
										<div class="media-body">
												<div class="pl-dtable">
													<div class="pl-vmiddle">
															<h3 class="pl-name"><?=$profile_rs['username']?></h3>
													</div>
												</div>
												<div class="pl-options">
														<?php $rs_socials = ($profile_rs['socials']) ? unserialize($profile_rs['socials']) : []; ?>
														<?php if(count(array_filter($rs_socials))): ?>
														<div class="pl-social">
																<?php if(db_unserialize([$profile_rs['socials'], 'twitter'])): ?>
																<a href="https://twitter.com/<?=db_unserialize([$profile_rs['socials'], 'twitter'])?>" target="_blank" class="bg-twitter"><i class="icon-social-twitter icons"></i></a>
																<?php endif; ?>
																<?php if(db_unserialize([$profile_rs['socials'], 'facebook'])): ?>
																<a href="https://facebook.com/<?=db_unserialize([$profile_rs['socials'], 'facebook'])?>" target="_blank" class="bg-facebook"><i class="icon-social-facebook icons"></i></a>
																<?php endif; ?>
																<?php if(db_unserialize([$profile_rs['socials'], 'instagram'])): ?>
																<a href="https://instagram.com/<?=db_unserialize([$profile_rs['socials'], 'instagram'])?>" target="_blank" class="bg-instagram"><i class="icon-social-instagram icons"></i></a>
																<?php endif; ?>
																<?php if(db_unserialize([$profile_rs['socials'], 'google'])): ?>
																<a href="https://plus.google.com/<?=db_unserialize([$profile_rs['socials'], 'google'])?>" target="_blank" class="bg-google"><i class="icon-social-google icons"></i></a>
																<?php endif; ?>
																<?php if(db_unserialize([$profile_rs['socials'], 'youtube'])): ?>
																<a href="https://youtube.com/<?=db_unserialize([$profile_rs['socials'], 'youtube'])?>" target="_blank" class="bg-youtube"><i class="icon-social-youtube icons"></i></a>
																<?php endif; ?>
														</div>
														<?php endif; ?>
														<?php $count_flr = db_rows("followers WHERE user = '{$profile_rs['id']}' && author = '".us_id."'");?>
														<a href="javascript:void(0)" rel="<?=$profile_rs['id']?>" class="pl-user-<?=($count_flr?'un':'')?>follow-list pl-buttons bg-<?=($count_flr?'9':'1')?> pl-profile-fl"><i class="icon-user-<?=($count_flr?'un':'')?>follow icons"></i> <?=($count_flr?$lang['members']['unfollow']:$lang['members']['follow'])?></a>
												</div>
										</div>
								</div>

								<?php if($profile_rs['verified']==1): ?>
								<i class="icon-check icons" title="<?=$lang['verified']?>"></i>
								<?php endif; ?>
						</div>
				</div>
				<div class="pl-counts">
						<div class="pl-count">
								<b>
									<i class="icon-people icons"></i>
									<span class="pl-show-followers"><?=db_unserialize([$profile_rs['statistics'], 'followers'])?></span>
								</b> <?=$lang['members']['followers']?>
						</div>
						<div class="pl-count">
								<b><i class="icon-cup icons"></i><?=db_unserialize([$profile_rs['statistics'], 'following'])?></b> <?=$lang['members']['following']?>
						</div>
						<div class="pl-count">
								<b><i class="icon-star icons"></i><?=db_unserialize([$profile_rs['statistics'], 'votes'])?></b> <?=$lang['members']['votes']?>
						</div>
						<div class="pl-count">
								<b><i class="icon-question icons"></i><?=db_unserialize([$profile_rs['statistics'], 'questions'])?></b> <?=$lang['members']['questions']?>
						</div>
						<div class="pl-count">
								<b><i class="icon-bubbles icons"></i><?=db_unserialize([$profile_rs['statistics'], 'comments'])?></b> <?=$lang['members']['comments']?>
						</div>
						<div class="pl-count">
								<b><i class="icon-tag icons"></i><?=db_unserialize([$profile_rs['statistics'], 'tags'])?></b> <?=$lang['members']['tags']?>
						</div>
				</div>
		</div>
		<?php
		$sql = db_select([
				'table'  => 'followers AS f',
				'join'   => 'users AS u ON(f.author = u.id)',
				'column' => 'u.id, u.photo, u.username, u.sex',
				'where'  => 'f.user = "'.$id.'" && u.moderat = 0 && u.trash = 0',
				'order'  => 'ORDER BY f.id DESC LIMIT 6'
		]);
		if($sql->num_rows):
		?>
		<div class="pl-box">
				<div class="pl-followers">
						<div class="pl-dtable">
								<div class="pl-vmiddle"><h3 class="pl-title"><?=$lang['members']['pr-followers']?></h3></div>
						</div>
						<ul>
								<?php
								while($rs = $sql->fetch_assoc()):
								?>
								<li>
										<a href="<?=path?>/profile.php?id=<?=fh_seoURL($rs['id'], 'profile', $rs['username'])?>"><img src="<?=$rs['photo']?>" alt="<?=$rs['username']?>" title="<?=$rs['username']?>" onerror="this.src='<?=fh_thumbERROR('user', $rs['sex'])?>'" /></a>
								</li>
								<?php
						    endwhile;
						    ?>
						</ul>
						<div class="pl-dtable">
								<div class="pl-vmiddle"><a href="<?=path?>/followers.php?id=<?=fh_seoURL($id, 'followers', $title)?>&amp;type=er" class="pl-buttons bg-8"><i class="icon-plus icons"></i> <?=$lang['members']['pr-more-flr']?></a></div>
						</div>
				</div>
		</div>
		<?php
		endif;
		$sql->close();
		?>
		<?php
		$sql = db_select([
				'table'  => 'followers AS f',
				'join'   => 'users AS u ON(f.user = u.id)',
				'column' => 'u.id, u.photo, u.username, u.sex',
				'where'  => 'f.author = "'.$id.'" && u.moderat = 0 && u.trash = 0',
				'order'  => 'ORDER BY f.id DESC LIMIT 6'
		]);
		if($sql->num_rows):
		?>
		<div class="pl-box">
				<div class="pl-followers">
						<div class="pl-dtable">
								<div class="pl-vmiddle"><h3 class="pl-title"><?=$lang['members']['pr-following']?></h3></div>
						</div>
						<ul>
								<?php
								while($rs = $sql->fetch_assoc()):
								?>
								<li>
										<a href="<?=path?>/profile.php?id=<?=fh_seoURL($rs['id'], 'profile', $rs['username'])?>"><img src="<?=$rs['photo']?>" alt="<?=$rs['username']?>" title="<?=$rs['username']?>" onerror="this.src='<?=fh_thumbERROR('user', $rs['sex'])?>'" /></a>
								</li>
								<?php
						    endwhile;
						    ?>
						</ul>
						<div class="pl-dtable">
								<div class="pl-vmiddle"><a href="<?=path?>/followers.php?id=<?=fh_seoURL($id, 'following', $title)?>&amp;type=ing" class="pl-buttons bg-8"><i class="icon-plus icons"></i> <?=$lang['members']['pr-more-fln']?></a></div>
						</div>
				</div>
		</div>
		<?php
		endif;
		$sql->close();
		?>
		<div class="pl-box">
		<?php
		$sql = db_select([
				'table'  => 'questions',
				'column' => 'id, question, thumbnail, date, statistics',
				'where'  => 'author = "'.$id.'" && trash = 0 && moderat = 0',
				'order'  => 'ORDER BY id DESC LIMIT 6'
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
												<li><a href="#" data-toggle="modal" data-target="#report-modal" rel="<?=$rs['id']?>"><i class="icon-flag icons"></i> <?=$lang['questions']['report']?></a></li>
										</ul>
								</div>
						</div>
				</div>
		</div>
		<?php
		endwhile;
		?>
		<div class="pt-more-r">
			<a href="<?=path?>/more-questions.php?id=<?=fh_seoURL($id, 'more-questions', $title)?>" title="View more results"><i class="icon-options icons"></i></a>
		</div>
		<?php
		else:
		?>
		<div class="pl-not-found"><?=$lang['alerts']['no-data']?></div>
		<?php
		endif;
		$sql->close();
		?>
		</div>
		<?php
    else:
    ?>
    <div class="pl-not-found"><?=$lang['alerts']['no-data']?></div>
    <?php endif; ?>
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
