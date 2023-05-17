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

# Main Page
$poll_sql   = "questions AS q";
$poll_order = "q.id";
$poll_wh    = "q.trash = 0 && q.moderat = 0";
$pagi       = path."/index.php?";
switch($type){
	case "fresh":
		$poll_wh .= " && q.date > '".(time - 3600*24)."'";
		$pagi     .= "type=fresh&";
	break;
	case "popular":
		$poll_order = "q.votes";
		$pagi       .= "type=popular&";
	break;
	case "categories":
		$poll_wh .= " && q.category = '{$id}'";
		$pagi    .= "type=categories&amp;id=".fh_seoURL($id, 'categories', db_get('categories','title',$id))."&";
	break;
	case "followed":
		$poll_sql = "tags AS t LEFT JOIN ".prefix."questions AS q ON(t.question =q.id)";
		$poll_wh .= " && t.author = '".us_id."'";
		$pagi     .= "type=followed&";
}
?>
<div class="pl-main">
	<?php
  $sql = db_select([
    'table'  => $poll_sql,
    'join'   => 'categories AS c ON(q.category=c.id)',
    'column' => 'q.question, q.id, q.statistics, q.author, q.date, q.polltype, q.pinned, q.thumbnail, q.category, q.end_date, c.icon, c.bg, c.title',
    'where' => "q.pinned = 1",
    'order'  => 'ORDER BY '.$poll_order.' DESC LIMIT 2'
  ]);
  if($sql->num_rows):
  while($rs = $sql->fetch_assoc()):
		$share_url  = path."/questions.php?id=".fh_seoURL($rs['id'], 'questions', $rs['question']);
		fh_questionDetails($rs);

	    $comments = db_select([
	        'table'  => 'comments AS c',
	        'join'   => 'users AS u ON(c.author=u.id)',
	        'column' => 'c.question, c.id, c.votes, c.author, c.date, c.content, u.photo, u.sex',
	        'where'  => 'c.question = "'.$rs['id'].'" && c.moderat = 0 && c.trash = 0',
	        'order'  => 'GROUP BY c.id ORDER BY c.id DESC LIMIT 1'
	    ]);
	    ?>
			<div class="pl-comments<?php if( $comments->num_rows ): ?> open<?php endif; ?>">
					<?php if( db_rows("comments WHERE question = '{$rs['id']}'") > 1 ): ?>
					<div class="pl-more">
							<a href="#" id="pl-more-<?=db_get("comments","id",$rs['id'],"question", "ORDER BY id DESC LIMIT 1")?>" rel="<?=$rs['id']?>"><?=$lang['questions']['more-comments']?></a>
							<span class="pull-right"><small>1</small>/<?=db_unserialize([$rs['statistics'], 'comments'])?></span>
					</div>
					<?php endif; ?>
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
    <?php
    endwhile;
    endif;
    $sql->close();
    ?>

	<!-- End Pinned -->

	<?php if(fh_planAccess('ads')): ?>
	<div class="pl-widget">
			<?=ads_3?>
	</div><!-- End ADS Widget -->
	<?php endif; ?>

  <?php
  $sql = db_select([
    'table'  => $poll_sql,
    'join'   => 'categories AS c ON(q.category=c.id)',
    'column' => 'q.question, q.id, q.statistics, q.author, q.date, q.polltype, q.thumbnail, q.category, q.end_date, c.icon, c.bg, c.title',
    'where' => $poll_wh,
    'order'  => 'ORDER BY '.$poll_order.' DESC LIMIT '.$startpoint.' , '.$limit
  ]);
  if($sql->num_rows):
		$i = 0;
  while($rs = $sql->fetch_assoc()):
		$share_url  = path."/questions.php?id=".fh_seoURL($rs['id'], 'questions', $rs['question']);
		fh_questionDetails($rs);
		$i++;
    ?>



			<?php
	    $comments = db_select([
	        'table'  => 'comments AS c',
	        'join'   => 'users AS u ON(c.author=u.id)',
	        'column' => 'c.question, c.id, c.votes, c.author, c.date, c.content, u.photo, u.sex',
	        'where'  => 'c.question = "'.$rs['id'].'" && c.moderat = 0 && c.trash = 0',
	        'order'  => 'GROUP BY c.id ORDER BY c.id DESC LIMIT 1'
	    ]);
	    ?>
			<div class="pl-comments<?php if( $comments->num_rows ): ?> open<?php endif; ?>">
					<?php if( db_rows("comments WHERE question = '{$rs['id']}'") > 1 ): ?>
					<div class="pl-more">
							<a href="#" id="pl-more-<?=db_get("comments","id",$rs['id'],"question", "ORDER BY id DESC LIMIT 1")?>" rel="<?=$rs['id']?>"><?=$lang['questions']['more-comments']?></a>
							<span class="pull-right"><small>1</small>/<?=db_unserialize([$rs['statistics'], 'comments'])?></span>
					</div>
					<?php endif; ?>
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
		<?php if($i==1): ?>
		<?php if(fh_planAccess('ads')): ?>
		<div class="pl-widget">
				<?=ads_4?>
		</div><!-- End ADS Widget -->
		<?php endif; ?>
		<?php endif; ?>
		<?php if($i==3): ?>
		<?php if(fh_planAccess('ads')): ?>
		<div class="pl-widget">
				<?=ads_5?>
		</div><!-- End ADS Widget -->
		<?php endif; ?>
		<?php endif; ?>
    <?php
    endwhile;
    else:
    ?>
    <div class="pl-not-found pl-box"><?=$lang['alerts']['no-data']?></div>
    <?php
    endif;
    $sql->close();
    echo pl_pagination($poll_sql.' WHERE '.$poll_wh, $limit, $pagi);
    ?>
</div><!-- End Main -->

<?php
# Footer Page
include __DIR__.'/footer.php';
