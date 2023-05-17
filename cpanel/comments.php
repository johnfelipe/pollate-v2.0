<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-bubbles icons"></i> Comments</h3>
			<p><a href="#">Cpanel</a> / Comments</p>
		</div>
			<div class="pl-col-6 text-right">
				<a href="#" class="pl-buttons bg-9 pl-comments-reject" data-multi="true"><i class="fas fa-times"></i> Reject</a>
				<a href="#" class="pl-buttons bg-2 pl-comments-approve" data-multi="true"><i class="fas fa-check"></i> Approve</a>
				<a href="#" class="pl-buttons bg-0 pl-comments-trash" data-multi="true"><i class="fas fa-trash"></i> Trash</a>
			</div>
	</div>
</div>

<table class="table">
		<thead class="thead-default">
				<tr>
						<th><input type="checkbox" name="check_all" value="1"></th>
						<th class="text-left">Comments</th>
						<th>&nbsp;</th>
				</tr>
		</thead>
	  <tbody>
				<?php
				$sql = db_select([
						"table"  => "comments AS c",
						"column" => "c.id, c.author, c.date, c.content, c.question, c.moderat, u.username, u.sex, u.photo",
						"join"   => "users AS u ON(u.id = c.author)",
						"where"   => "c.trash = 0",
						"order"  => "ORDER BY c.date DESC LIMIT {$startpoint}, {$limit}"
				]);
				while($rs = $sql->fetch_assoc()):
				?>
		    <tr id="pt-obj-<?=$rs['id']?>"<?=($rs['moderat']==1?' class="bg-banned"':'')?>>
			      <th scope="row"><input type="checkbox" name="pl-check[]" value="<?=$rs['id']?>"></th>
			      <td width="100%" class="text-left">
							<div class="media">
								<div class="media-left">
									<div class="pl-thumb">
										<img src="<?=$rs['photo']?>" alt="" onerror="this.src='<?=fh_thumbERROR('user', $rs['sex'])?>'">
									</div>
								</div>
								<div class="media-body">
									<h3><?=fh_user($rs['author'])?> Commented on <a href="<?=path?>/questions.php?id=<?=fh_seoURL($rs['question'], 'questions', db_get('questions', 'question', $rs['question']))?>"><?=db_get('questions', 'question', $rs['question'])?></a> at <?=date('d M, Y', $rs['date'])?></h3>
									<p>
										<?=$rs['content']?>
									</p>
								</div>
							</div>
						</td>
			      <td>
								<a href="#" class="pl-options"><i class="icon-options icons"></i></a>
								<ul class="dropdown">
                  	<li><a href="#" class="pl-comments-trash" rel="<?=$rs['id']?>"><i class="icon-trash icons"></i> Move to trash</a></li>
                </ul>
			      </td>
		    </tr>
				<?php endwhile;?>
	  </tbody>
</table>

<?=pl_pagination("comments", $limit, "?type={$type}&");?>
