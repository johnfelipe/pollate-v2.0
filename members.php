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
<div class="pl-main">
		<div class="pl-box">
		<?php
		$sql = db_select([
				'table'  => 'users',
				'column' => 'id, photo, username, date, statistics, sex',
				'where'  => 'moderat = 0 && trash = 0',
				'order'  => 'ORDER BY id DESC LIMIT '.$startpoint.' , '.$limit
		]);
		if($sql->num_rows):
		while($rs = $sql->fetch_assoc()):
		?>
		<div class="pl-user">
				<div class="media">
						<div class="media-left">
								<div class="pl-thumb">
										<img src="<?=$rs['photo']?>" alt="<?=$rs['username']?>" onerror="this.src='<?=fh_thumbERROR('user', $rs['sex'])?>'">
								</div>
						</div>
						<div class="media-body">
								<div class="pl-dtable">
										<div class="pl-vmiddle">
												<h3 class="pl-title"><?=fh_user($rs['id'])?></h3>
												<div class="pl-details">
													<i class="icon-calendar icons"></i> <?=fh_ago($rs['date'])?>
													<i class="icon-people icons"></i>
													<span class="pl-show-followers"><?=db_unserialize([$rs['statistics'], 'followers'])?></span> <?=$lang['members']['followers']?>
													<i class="icon-question icons"></i> <?=db_unserialize([$rs['statistics'], 'questions'])?> <?=$lang['members']['questions']?>
													<i class="icon-star icons"></i> <?=db_unserialize([$rs['statistics'], 'votes'])?> <?=$lang['members']['votes']?>
												</div>
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
    echo pl_pagination('users WHERE moderat = 0 && trash = 0', $limit, path."/members.php?");
    ?>
		</div>
</div><!-- End Main -->

<?php
# Footer Page
include __DIR__.'/footer.php';
