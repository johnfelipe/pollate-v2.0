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

include __DIR__.'/config.php';

# Header Page
include __DIR__.'/header.php';

if(!db_rows("questions WHERE id = '{$id}'")){
	echo fh_alerts($lang['alerts']['wrong']);
	$sidebar = false;
	include __DIR__.'/footer.php';
	exit;
}

if(fh_seoURLCheck(db_get("questions", "question", $id)) != $title){
	echo fh_alerts($lang['alerts']['wrong']);
	$sidebar = false;
	include __DIR__.'/footer.php';
	exit;
}

# Main Page
?>
<div class="pl-main">
    <?php
    $sql = db_select([
        'table'  => 'questions AS q',
        'join'   => 'categories AS c ON(q.category=c.id)',
        'column' => 'q.question, q.id, q.statistics, q.author, q.date, q.polltype, q.thumbnail, q.end_date, q.category, c.icon, c.bg, c.title',
        'where'  => 'q.id = "'.$id.'" && q.moderat = 0 && q.trash = 0'
    ]);
    if($sql->num_rows):
    $rs = $sql->fetch_assoc();
		$share_url  = path."/questions.php?id=".fh_seoURL($rs['id'], 'questions', $rs['question']);
		fh_questionDetails($rs);
    ?>


			<?php if(db_count("votes WHERE question = '{$id}' AND author != 0")): ?>
			<div class="pl-voters">
					<div class="pl-dtable">
							<div class="pl-vmiddle"><h3 class="pl-title"><?=$lang['questions']['pg-voters']?></h3></div>
					</div>
					<ul>
							<?php
							$voters = db_select([
									'table'  => 'votes AS f',
									'join'   => 'users AS u ON(f.author = u.id)',
									'column' => 'u.id, u.photo, u.username, u.sex',
									'where'  => 'f.question = "'.$id.'" AND f.author != 0 && u.moderat = 0 && u.trash = 0',
									'order'  => 'ORDER BY f.id DESC LIMIT 6'
							]);
							if($voters->num_rows):
							while($rs_voters = $voters->fetch_assoc()):
							?>
							<li>
									<a href="<?=path?>/profile.php?id=<?=fh_seoURL($rs_voters['id'], 'profile', $rs_voters['username'])?>"><img src="<?=$rs_voters['photo']?>" alt="<?=$rs_voters['username']?>" onerror="this.src='<?=fh_thumbERROR('user', $rs_voters['sex'])?>'" /></a>
							</li>
							<?php
							endwhile;
							else:
							?>
							<li class="pl-not-found"><?=$lang['alerts']['no-data']?></li>
							<?php
							endif;
							$voters->close();
							?>
					</ul>
					<div class="pl-dtable">
							<div class="pl-vmiddle"><a href="<?=path?>/voters.php?id=<?=fh_seoURL($id, 'questions', $rs['question'])?>" class="pl-buttons bg-8"><i class="icon-plus icons"></i> <?=$lang['questions']['pg-all']?></a></div>
					</div>
			</div>
			<?php endif; ?>

			<?php
	    $comments = db_select([
	        'table'  => 'comments AS c',
	        'join'   => 'users AS u ON(c.author=u.id)',
	        'column' => 'c.question, c.id, c.votes, c.author, c.date, c.content, u.photo, u.sex',
	        'where'  => 'c.question = "'.$rs['id'].'" && c.moderat = 0 && c.trash = 0',
	        'order'  => 'GROUP BY c.id ORDER BY c.id DESC'
	    ]);
	    ?>
			<div class="pl-comments open">
					<?php while($cmtrs = $comments->fetch_assoc()): ?>
					<?php $last_comment = $cmtrs['id']; ?>
					<div class="media pl-comment">
							<div class="media-left">
									<div class="pl-thumb">
											<img src="<?=$cmtrs['photo']?>" alt="<?=fh_user($cmtrs['author'], false)?>" onerror="this.src='<?=fh_thumbERROR('user', $cmtrs['sex'])?>'" />
									</div>
							</div>
							<div class="media-body">
									<div class="pl-title"><?=str_replace('{user}', fh_user($cmtrs['author']), $lang['questions']['by'])?> <span><?=fh_ago($cmtrs['date'])?></span></div>
									<div class="pl-cmt-content"><?=db_output($cmtrs['content'], true, true)?></div>
							</div>
					</div>
					<?php endwhile; ?>
					<?php if(us_level): ?>
					<div class="pl-comment-form">
						<div class="pl-thumb">
								<img src="<?=us_photo?>" alt="<?=fh_user(us_id, false)?>" onerror="this.src='<?=fh_thumbERROR('user', us_sex)?>'" />
						</div>
						<form class="pl-form pl-write-comment">
								<textarea name="content" placeholder="<?=$lang['questions']['place-comment']?>"></textarea>
								<hr>
								<button type="submit" class="pl-buttons bg-7 pull-right"><?=$lang['questions']['send-comment']?></button>
								<button class="pl-buttons bg-9 pull-right cancel"><?=$lang['questions']['cancel']?></button>
								<input type="hidden" name="poll_id" value="<?=$rs['id']?>">
						</form>
					</div>
					<?php else: ?>
					<div class="pl-nouser">
							<?=str_replace(['{signin}', '{signup}'], ['<b><a href="#" data-toggle="modal" data-target="#sign-modal">'.$lang['header']['in'].'</a></b>', '<b><a href="'.path.'/sign-up.php">'.$lang['header']['up'].'</a></b>'], $lang['questions']['nouser'])?>
					</div>
					<?php endif; ?>
			</div>
			<?php
	    $comments->close();
	    ?>
    </div><!-- End Question -->

		<?php if(db_count("tags WHERE question = '{$id}'")): ?>
		<div class="pl-box">
				<div class="pl-voters">
						<div class="pl-dtable">
								<div class="pl-vmiddle"><h3 class="pl-title"><?=$lang['questions']['pg-tages']?></h3></div>
						</div>
						<ul>
								<?php
								$voters = db_select([
										'table'  => 'tags AS f',
										'join'   => 'users AS u ON(f.author = u.id)',
										'column' => 'u.id, u.photo, u.username, u.sex',
										'where'  => 'f.question = "'.$id.'" && u.moderat = 0 && u.trash = 0',
										'order'  => 'ORDER BY f.id DESC LIMIT 6'
								]);
								if($voters->num_rows):
								while($rs_voters = $voters->fetch_assoc()):
								?>
								<li>
										<a href="<?=path?>/profile.php?id=<?=fh_seoURL($rs_voters['id'], 'profile', $rs_voters['username'])?>"><img src="<?=$rs_voters['photo']?>" alt="<?=$rs_voters['username']?>" onerror="this.src='<?=fh_thumbERROR('user', $rs_voters['sex'])?>'" /></a>
								</li>
								<?php
								endwhile;
								else:
								?>
								<li class="pl-not-found"><?=$lang['alerts']['no-data']?></li>
								<?php
								endif;
								$voters->close();
								?>
						</ul>
						<div class="pl-dtable">
								<div class="pl-vmiddle"><a href="<?=path?>/tags.php?id=<?=fh_seoURL($id, 'questions', $rs['question'])?>" class="pl-buttons bg-8"><i class="icon-plus icons"></i> <?=$lang['questions']['pg-all']?></a></div>
						</div>
				</div>
		</div>
		<?php endif; ?>
    <?php
    else:
    ?>
    <div class="pl-not-found"><?=$lang['alerts']['no-data']?></div>
    <?php
    endif;
    $sql->close();
    ?>
</div><!-- End Main -->

<?php
# Footer Page
include __DIR__.'/footer.php';
