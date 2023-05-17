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

# Main Page
?>
<div class="pl-main pl-body-voters">
		<div class="pl-box">
				<h3 class="pl-tile">
					<?=$lang['questions']['pg-tages']?>
					<small><?=db_unserialize([db_get('questions', 'statistics', $id), 'tags'])?></small>
				</h3>
				<h3 class="pl-tile2">
					<?=$lang['questions']['pg-votes-q']?> <b><?=db_get('questions', 'question', $id)?></b>
				</h3>
				<ul class="pl-voters">
						<?php
						$sql = db_select([
								'table'  => 'tags AS t',
								'join'   => 'users AS u ON(t.author = u.id)',
								'column' => 'u.id, u.photo, u.username, u.statistics, u.sex, t.date',
								'where'  => 't.question = "'.$id.'" && u.moderat = 0 && u.trash = 0',
								'order'  => 'ORDER BY t.id DESC LIMIT '.$startpoint.' , '.$limit
						]);
						if($sql->num_rows):
						while($rs = $sql->fetch_assoc()):
						?>
						<li>
								<div class="media">
										<div class="media-left">
												<div class="pl-thumb">
														<img src="<?=$rs['photo']?>" alt="<?=$rs['username']?>" onerror="this.src='<?=fh_thumbERROR('user', $rs['sex'])?>'" />
												</div>
										</div>
										<div class="media-body">
												<h3 class="pl-title"><?=fh_user($rs['id'], true, true, 22)?></h3>
												<span><?=fh_ago($rs['date'])?></span>
										</div>
								</div>
								<div class="pl-options">
										<a href="#" class="pl-user-options"><i class="icon-options-vertical icons"></i></a>
										<ul class="dropdown">
												<?php $count_tags = db_rows("followers WHERE user = '{$rs['id']}' && author = '".us_id."'");?>
												<li>
													<a href="javascript:void(0)" rel="<?=$rs['id']?>" class="pl-user-<?=($count_tags?'un':'')?>follow-list">
														<i class="icon-user-<?=($count_tags?'un':'')?>follow icons"></i> <?=($count_tags?$lang['members']['unfollow']:$lang['members']['follow'])?>
													</a>
												</li>
												<li><a href="<?=path?>/more-questions.php?id=<?=fh_seoURL($rs['id'], 'more-questions', $rs['username'])?>"><i class="icon-question icons"></i> <?=$lang['members']['more-questions']?></a></li>
												<li>
													<a href="<?=path?>/followers.php?id=<?=fh_seoURL($rs['id'], 'follower', $rs['username'])?>&amp;type=er">
														<i class="icon-people icons"></i>
														<?=db_unserialize([$rs['statistics'], 'followers'])?> <?=$lang['members']['followers']?>
													</a>
												</li>
												<li><a href="<?=path?>/followers.php?id=<?=fh_seoURL($rs['id'], 'following', $rs['username'])?>&amp;type=ing"><i class="icon-paper-plane icons"></i> <?=db_unserialize([$rs['statistics'], 'following'])?> <?=$lang['members']['following']?></a></li>
										</ul>
								</div>
						</li>
						<?php
						endwhile;
						else:
						?>
						<li class="pl-not-found"><?=$lang['alerts']['no-data']?></li>
						<?php
						endif;
						$sql->close();
						?>
				</ul>
		</div>
		<?=pl_pagination("tags WHERE question = '{$id}'", $limit, path."/tags.php?id={$id}&title={$title}&");?>
</div><!-- End Main -->

<?php
# Footer Page
include __DIR__.'/footer.php';
