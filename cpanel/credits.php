<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-magnet icons"></i> Credits</h3>
			<p><a href="#">Cpanel</a> / Credits</p>
		</div>
		<div class="pl-col-6 text-right">
			<a href="#" class="pl-buttons bg-2 pl-payout-approve" data-multi="true"><i class="fas fa-check"></i> Approve</a>
		</div>
	</div>
</div>

<table class="table">
	  <thead class="thead-default">
		    <tr>
		      <th><input type="checkbox" name="check_all" value="1"></th>
		      <th class="text-left">User</th>
					<th scope="col">email</th>
					<th scope="col">status</th>
					<th scope="col">Points</th>
					<th scope="col">amount</th>
					<th scope="col">date</th>
		    </tr>
	  </thead>
	  <tbody>
				<?php
				$sql = db_select([
						"table" => "payout",
						'order' => 'ORDER BY id DESC LIMIT '.$startpoint.' , '.$limit
				]);
				while($rs = $sql->fetch_assoc()):
				?>
	    <tr id="pt-obj-<?=$rs['id']?>">
				<th scope="row"><input type="checkbox" name="pl-check[]" value="<?=$rs['id']?>"></th>
				<td class="text-left">
						<a href="#"><?=fh_user($rs['author'])?></a>
				</td>

				<td class="text-center"><?=$rs['email']?></td>
				<td class="text-white text-center">
					<span class="badge bg-<?=( !$rs['status'] ? 'p2' : 'p1' )?>">
						<?=( !$rs['status'] ? 'waiting' : 'success' )?>
					</span>
				</td>
				<td class="text-center">
					<?=$rs['credits']?>
				</td>
				<td class="text-center">$<?=$rs['price']?></td>
				<td class="text-center"><?=fh_ago($rs['created_at'])?></td>
			</tr>
				<?php endwhile;?>
	  </tbody>
</table>

<?php
$sql->close();
echo pl_pagination('payments', $limit, "?type={$type}&");
?>
