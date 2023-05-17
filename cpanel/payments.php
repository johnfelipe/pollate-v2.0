<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-wallet icons"></i> Payments</h3>
			<p><a href="#">Cpanel</a> / Payments</p>
		</div>
		<div class="pl-col-6 text-right"></div>
	</div>
</div>

<table class="table">
	  <thead class="thead-default">
		    <tr>
		      <th class="text-left">User</th>
					<th scope="col">status</th>
					<th scope="col">plan</th>
					<th scope="col">amount</th>
					<th scope="col">date</th>
					<th scope="col">txn</th>
		    </tr>
	  </thead>
	  <tbody>
				<?php
				$sql = db_select([
						"table" => "payments",
						'order' => 'ORDER BY id DESC LIMIT '.$startpoint.' , '.$limit
				]);
				while($rs = $sql->fetch_assoc()):
				?>
		    <tr id="pt-obj-<?=$rs['id']?>">
					<th scope="row" class="text-left">
						<a href="#"><?=fh_user($rs['author'])?></a>
					</th>
					<td class="text-center">
						<?=$rs['status']?>
					</td>
					<td class="text-center">
						<span class="badge bg-p<?=$rs['plan']?> <?=( $rs['plan']=='1' ? 'p1' : ( $rs['plan']=='2' ? 'p2' : ( $rs['plan']=='3' ? 'p3' : '')))?>">
							Plan#<?=$rs['plan']?>
						</span>
					</td>
					<td class="text-center">$<?=$rs['price']?></td>
					<td class="text-center"><?=fh_ago($rs['date'])?></td>
					<td class="text-center"><?=$rs['txn_id']?></td>
				</tr>
				<?php endwhile;?>
	  </tbody>
</table>

<?php
$sql->close();
echo pl_pagination('payments', $limit, "?type={$type}&");
?>
