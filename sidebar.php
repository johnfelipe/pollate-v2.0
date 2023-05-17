
<?php if(!in_array(page, ["plans"])): ?>
<div class="pl-sidebar">
		<?php if($sidebar['ads']): ?>
		<?php if(fh_planAccess('ads')): ?>
    <div class="pl-widget">
        <div class="pl-content pt-sidebar-ads">
					<!-- ADS HERE -->
					<?=ads_1?>
					<!-- END ADS HERE -->
				</div>
    </div><!-- End ADS Widget -->
		<?php endif; ?>
		<?php endif; ?>
		<?php if($sidebar['questions']): ?>
    <div class="pl-widget">
        <h3 class="pl-title">
					<?php if($lang['lang'] == 'tr'): ?>
	          <b class="badge">
							<span class="questions-filter-link"><?=$lang['sidebar']['questions']['day']?></span>
		          <ul class="dropdown">
		            <li><a href="#" class="pl-sidebar-questions day"><?=$lang['sidebar']['questions']['day']?></a></li>
		            <li><a href="#" class="pl-sidebar-questions month"><?=$lang['sidebar']['questions']['month']?></a></li>
		            <li><a href="#" class="pl-sidebar-questions year"><?=$lang['sidebar']['questions']['year']?></a></li>
		          </ul>
						</b>
						<?=$lang['sidebar']['questions']['title']?>
					<?php else: ?>
					<?=$lang['sidebar']['questions']['title']?>
          <b class="badge">
						<span class="questions-filter-link"><?=$lang['sidebar']['questions']['day']?></span>
	          <ul class="dropdown">
	            <li><a href="#" class="pl-sidebar-questions day"><?=$lang['sidebar']['questions']['day']?></a></li>
	            <li><a href="#" class="pl-sidebar-questions month"><?=$lang['sidebar']['questions']['month']?></a></li>
	            <li><a href="#" class="pl-sidebar-questions year"><?=$lang['sidebar']['questions']['year']?></a></li>
	          </ul>
					</b>
				<?php endif; ?>
        </h3>
        <div class="pl-content">
            <ul class="pl-polls">
								<?php
								$sql = db_select([
										'table'  => 'comments AS c',
										'join'   => 'questions AS q ON(q.id = c.question)',
										'column' => 'q.id',
										'where'  => "q.trash = 0 && q.moderat = 0 && c.date >= '".( time - 3600*24 )."'",
										'order'  => 'GROUP BY q.id ORDER BY COUNT(c.id) DESC LIMIT 5'
								]);
								if($sql->num_rows):
								while($rs = $sql->fetch_assoc()):
									echo fh_sidebarQuestions($rs['id']);
								endwhile;
								else:
								?>
								<div class="pl-not-found"><?=$lang['alerts']['no-data']?></div>
								<?php
								endif;
								$sql->close();
								?>
            </ul>
        </div>
    </div><!-- End Questions Widget -->
		<?php endif; ?>
		<?php if($sidebar['categories']): ?>
    <div class="pl-widget">
        <h3 class="pl-title"><?=$lang['sidebar']['categories']?></h3>
        <div class="pl-content">
            <ul class="categories">
                <?php
                $sql = db_select([
                    'table'  => 'categories',
										'column' => 'id, bg, icon, title',
										'where'  => 'trash = 0',
                    'order'  => 'ORDER BY questions DESC LIMIT 5'
                ]);
                if($sql->num_rows):
                while($rs = $sql->fetch_assoc()):
                ?>
                <li>
                    <a href="<?=path?>/index.php?type=categories&amp;id=<?=fh_seoURL($rs['id'], 'categories', $rs['title'])?>">
                        <span style="background: #<?=$rs['bg']?>"><i class="<?=$rs['icon']?>"></i></span>
                        <h5><?=$rs['title']?></h5>
                    </a>
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
    </div><!-- End Categories Widget -->
		<?php endif; ?>
		<?php if($sidebar['social']): ?>
    <div class="pl-widget">
        <h3 class="pl-title"><?=$lang['sidebar']['social']?></h3>
        <div class="pl-content">
            <iframe src="https://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F<?=facebook_box?>&amp;width=300&amp;height=400&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;show_border=false&amp;header=false" scrolling="no" frameborder="0" allowTransparency="true" ></iframe>
        </div>
    </div><!-- End Social Box Widget -->
		<?php endif; ?>
		<?php if($sidebar['people']): ?>
    <div class="pl-widget">
        <h3 class="pl-title"><?=$lang['sidebar']['follow']['title']?></h3>
        <div class="pl-content">
            <ul class="pl-users owl-carousel">
                <?php
                $sql = db_select([
                    'table'  => 'users',
										'column' => 'id, username, sex, photo, statistics, description',
										'where'  => 'trash = 0 && moderat = 0',
                    'order'  => 'ORDER BY RAND() DESC LIMIT 5'
                ]);
                if($sql->num_rows):
                while($rs = $sql->fetch_assoc()):
                ?>
                <li>
                    <img src="<?=$rs['photo']?>" alt="<?=$rs['username']?>" onerror="this.src='<?=fh_thumbERROR('user', $rs['sex'])?>'">
                    <h3><?=fh_user($rs['id'])?></h3>
                    <p><?=($rs['description']?$rs['description']:$lang['sidebar']['follow']['desc'])?></p>
                    <div class="pl-details">
                        <span><i class="fas fa-thumbs-up"></i><b><?=db_unserialize([$rs['statistics'], 'votes'])?></b><br /> <?=$lang['sidebar']['follow']['votes']?></span>
                        <span><i class="fas fa-tasks"></i><b><?=db_unserialize([$rs['statistics'], 'questions'])?></b><br /> <?=$lang['sidebar']['follow']['questions']?></span>
                        <span><i class="fas fa-users"></i><b><?=db_unserialize([$rs['statistics'], 'followers'])?></b><br /> <?=$lang['sidebar']['follow']['followers']?></span>
                        <span><i class="fas fa-tags"></i><b><?=db_unserialize([$rs['statistics'], 'tags'])?></b><br /> <?=$lang['sidebar']['follow']['tagged']?></span>
                    </div>
										<?php $count_fls = db_rows("followers WHERE user = '{$rs['id']}' && author = '".us_id."'");?>
										<a href="javascript:void(0)" rel="<?=$rs['id']?>" class="pl-user-<?=($count_fls?'un':'')?>follow-list pl-buttons bg-<?=($count_fls?'9':'0')?> pl-sidebar-fl">
											<i class="icon-user-<?=($count_fls?'un':'')?>follow icons"></i> <?=($count_fls?$lang['members']['unfollow']:$lang['members']['follow'])?>
										</a>
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
    </div><!-- End Follow Widget -->
		<?php endif; ?>
		<?php if($sidebar['ads']): ?>
		<?php if(fh_planAccess('ads')): ?>
    <div class="pl-widget">
        <div class="pl-content pt-sidebar-ads">
					<!-- ADS HERE -->
					<?=ads_2?>
					<!-- END ADS HERE -->
				</div>
    </div><!-- End ADS Widget -->
		<?php endif; ?>
		<?php endif; ?>

</div><!-- End Sidebar -->
<?php endif; ?>
