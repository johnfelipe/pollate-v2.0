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
include __DIR__.'/head.php';

# Main Page
?>
<div class="pl-main pl-body-questions">
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
		if(fh_planAccess('iframe', $rs['author'])):
    ?>
    <div class="pl-question<?=($rs['polltype'] ? ($rs['polltype'] == 3 ? ' pl-question-pics' : ' pl-question-bool' ) : null )?><?=(!$rs['thumbnail'] ? ' pl-nothumb' : null )?>">
			<div class="pl-question-cnt">
				<div class="pl-content">
            <div class="pl-options">
              <div><a title="<?=$rs['title']?>"><i class="<?=$rs['icon']?>" title="<?=$rs['title']?>" style="background-color: #<?=$rs['bg']?>"></i></a></div>
								<div></div>
            </div>
            <h3 class="pl-title"><a href="<?=path?>/questions.php?id=<?=fh_seoURL($rs['id'], 'questions', $rs['question'])?>"><?=$rs['question']?></a></h3>
            <?php if($rs['polltype'] != 3 && $rs['thumbnail']): ?>
        <div class="pl-cover"><img src="<?=path?>/<?=$rs['thumbnail']?>" alt="<?=$rs['question']?>" onerror="this.src='<?=transparent?>'" /></div><!-- End Cover -->
      	<?php endif; ?>
            <div class="pl-author<?=(db_get('users', 'level', $rs['author'])==6?' pl-admin':'')?>">
                <div class="pl-thumb">
                    <img src="<?=db_get('users', 'photo', $rs['author'])?>" alt="<?=fh_user($rs['author'], false)?>" onerror="this.src='<?=fh_thumbERROR('user', db_get('users', 'sex', $rs['author']))?>'">
                </div>
								<?php if(db_get('users', 'level', $rs['author'])==6): ?>
								<i class="icon-support icons pl-admin-badge" title="<?=$lang['admin']?>"></i>
								<?php else: ?>
									<?php if(db_get('users', 'verified', $rs['author'])==1): ?>
									<i class="icon-check icons pl-verified" title="<?=$lang['verified']?>"></i>
									<?php endif; ?>
								<?php endif; ?>
                <?=str_replace('{user}', fh_user($rs['author']), $lang['questions']['by'])?> | <?=fh_ago($rs['date'])?>
            </div>
            <div class="pl-answers<?=(fh_voted($rs['id']) ? ' pl-answers-checked' : '')?> pl-iframed">
                <?=fh_answers_labels($rs['id'], $rs['polltype'])?>
            </div>
						<?php if($rs['end_date'] && time > $rs['end_date']): ?>
						<div>
							<p class="pl-warning">
								<i class="icon-exclamation icons"></i>
								<span><?=$lang['questions']['alert']['expired']?> <em><?=fh_ago($rs['end_date'])?></em>!</span>
							</p>
						</div>
						<?php endif; ?>
        </div><!-- End Content -->

			</div>

    </div><!-- End Question -->

    <?php
	  else:
			echo '<div class="pl-main pl-box p-2">'. fh_alerts($lang['alerts']['plan']).'</div>';
		endif;
    else:
    ?>
    <div class="pl-not-found"><?=$lang['alerts']['no-data']?></div>
    <?php
    endif;
    $sql->close();
    ?>
</div><!-- End Main -->

<div class="pl-iframe">
    <div class="pl-logo">
        <a href="<?=path?>"><img src="<?=path?>/images/logo.png" alt="Pollate - Sor,Öğren,Eğlen,Kazan."></a>
    </div>
    <div class="pl-titlee"><b><?=db_unserialize([$rs['statistics'], 'votes'])?></b> <?=$lang['questions']['votes']?>.</div>
</div>

<!-- jQuery Libraries -->
<?php
# Header Page
include __DIR__.'/scripts.php';
?>
</body>
</html>
