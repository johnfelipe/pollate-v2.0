<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-question icons"></i> Questions</h3>
			<p><a href="#">Cpanel</a> / Questions</p>
		</div>
			<div class="pl-col-6 text-right">
				<a href="#" class="pl-buttons bg-9 pl-questions-reject" data-multi="true"><i class="fas fa-times"></i> Reject</a>
				<a href="#" class="pl-buttons bg-2 pl-questions-approve" data-multi="true"><i class="fas fa-check"></i> Approve</a>
				<a href="#" class="pl-buttons bg-0 pl-questions-trash" data-multi="true"><i class="fas fa-trash"></i> Trash</a>
			</div>
	</div>
</div>

<table class="table">
	  <thead class="thead-default">
		    <tr>
			      <th><input type="checkbox" name="check_all" value="1"></th>
			      <th class="text-left">Question</th>
			      <th>Type</th>
			      <th>Updated</th>
			      <th>Ending date</th>
			      <th>&nbsp;</th>
		    </tr>
	  </thead>
	  <tbody>
				<?php
				$sql = db_select([
						"table" => "questions",
						"where" => "trash = 0",
						'order' => 'ORDER BY id DESC LIMIT '.$startpoint.' , '.$limit
				]);
				while($rs = $sql->fetch_assoc()):
				?>
		    <tr id="pt-obj-<?=$rs['id']?>"<?=($rs['moderat']==1?' class="bg-banned"':'')?>>
			      <th scope="row"><input type="checkbox" name="pl-check[]" value="<?=$rs['id']?>"></th>
			      <td width="60%" class="text-left">
								<div class="media">
										<div class="media-left">
											<div class="pl-thumb"><img src="<?=$rs['thumbnail']?>" alt="<?=$rs['question']?>" onerror="this.src='<?=fh_thumbERROR('thumb')?>'"></div>
										</div>
										<div class="media-body">
												<h3 class="pl-title"><a href="<?=path?>/questions.php?id=<?=fh_seoURL($rs['id'], 'questions', $rs['question'])?>"><?=$rs['question']?></a></h3>
												<small>
														<?=(db_unserialize([$rs['address'], 1])?db_unserialize([$rs['address'], 1]):'--')?>
														<?=(db_unserialize([$rs['address'], 2])?' - '.db_unserialize([$rs['address'], 2]):'--')?> -->
														<i class="icon-user icons"></i> <?=fh_user($rs['author'])?>
														<i class="icon-clock icons"></i> <?=fh_ago($rs['date'])?>
														<i class="icon-tag icons"></i> <?=db_get('categories', 'title', $rs['category'])?>
												</small>

												<span tabindex="0" class="pl-chart" data-content="<?=fh_cp_question_statistics($rs['statistics'])?>"><i class="icon-chart icons"></i></span>
										</div>
								</div>
						</td>
			      <td width="5%" class="text-center">
								<?php
								switch($rs['polltype']){
										case 1: echo 'Normal'; break;
										case 2: echo 'Yes/No'; break;
										case 3: echo 'Images'; break;
										default: echo '--';
								}
								?>
						</td>
						<td width="15%" class="text-center nobr"><?=($rs['updated_at']?fh_ago($rs['updated_at']):'--')?></td>
			      <td width="15%" class="text-center nobr"><?=($rs['end_date']?date("d/m/Y h:i", $rs['end_date']):'--')?></td>
			      <td width="15%" class="text-left">
								<a href="" class="pl-options"><i class="icon-options icons"></i></a>
								<ul class="dropdown">
										<?php if($rs['trash']==0): ?>
										<li>
											<a href="javascript: void(0)" rel="<?=$rs['id']?>" class="pl-questions-trash">
												<i class="icon-trash icons"></i> Move to trash</a>
											</a>
										</li>
										<?php endif; ?>
                  	<li><a href="<?=path?>/ask.php?id=<?=fh_seoURL($rs['id'], 'ask', $rs['question'])?>"><i class="icon-pencil icons"></i> Edit Details</a></li>
                  	<li><a href="<?=path?>/cpanel.php?type=statistics&amp;id=<?=$rs['id']?>"><i class="icon-chart icons"></i> Statistics</a></li>
                </ul>
			      </td>
		    </tr>
				<?php endwhile;?>
	  </tbody>
</table>

<?php
$sql->close();
echo pl_pagination('users', $limit, "?type={$type}&");
?>
