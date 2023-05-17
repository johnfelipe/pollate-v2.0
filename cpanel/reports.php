<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-ban icons"></i> Reports</h3>
			<p><a href="#">Cpanel</a> / Reports</p>
		</div>
	</div>
</div>

<div class="pl-cpanel-comments">
<table class="table">
	  <thead class="thead-default">
		    <tr>
			      <th><input type="checkbox" name="check_all" value="1"></th>
			      <th class="text-left">Reports</th>
			      <th>&nbsp;</th>
		    </tr>
	  </thead>
	  <tbody>
				<?php
				$sql = db_select([
						"table"  => "reports AS c",
						"column" => "c.id, c.author, c.date, c.title, c.content, c.tid, c.type, c.reply, c.rauthor, c.rdate, c.trash, u.username, u.sex, u.photo",
						"join"   => "users AS u ON(u.id = c.author)",
						"order"  => "ORDER BY c.date DESC LIMIT {$startpoint}, {$limit}"
				]);
				while($rs = $sql->fetch_assoc()):
					switch($rs['type']){
						case 'question':
							$r_table  = 'questions';
							$r_column = 'question';
							$r_url    = '/questions.php?id=';
							$r_url    = path.'/questions.php?id='.fh_seoURL($rs['tid'], 'questions', db_get('questions', 'question', $rs['tid']));
						break;
					}
				?>
				<tr id="pt-obj-<?=$rs['id']?>">
			      <th scope="row"><input type="checkbox" name="pl-check[]" value="<?=$rs['id']?>"></th>
			      <td width="100%" class="text-left">
							<div class="media">
								<div class="media-left">
									<div class="pl-thumb">
										<img src="<?=$rs['photo']?>" alt="" onerror="this.src='<?=fh_thumbERROR('user', $rs['sex'])?>'">
									</div>
								</div>
								<div class="media-body">
									<h3><?=fh_user($rs['author'])?> Reported about <?=$rs['type']?>: <a href="<?=$r_url?>"><?=db_get($r_table, $r_column, $rs['tid'])?></a> at <?=date('d M, Y', $rs['date'])?></h3>
									<p>
										<span><i class="icons icon-pin"></i> <?=$lang['report']['select']['values'][$rs['title']]?></span>
										<i class="icons icon-bubble"></i> <?=($rs['content']?$rs['content']:'--')?>
										<?php if($rs['rauthor']): ?>
										<i class="icons icon-share-alt"></i> Reply: <?=$rs['reply']?> by <?=fh_user($rs['rauthor'])?> at <?=fh_ago($rs['rdate'])?>
										<?php endif;?>
									</p>
								</div>
							</div>
						</td>
		    </tr>
				<?php endwhile;?>
	  </tbody>
</table>
</div>
<?=pl_pagination("reports", $limit, "?type={$type}&");?>

<?php include(realpath(__DIR__ . '/..').'/partials/report-reply.php'); ?>
