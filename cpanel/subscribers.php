<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-support icons"></i> Subscribers</h3>
			<p><a href="#">Cpanel</a> / Subscribers</p>
		</div>
			<div class="pl-col-6 text-right">
				<a href="#" class="pl-buttons bg-0 pl-subscribers-trash" data-multi="true"><i class="fas fa-trash"></i> Trash</a>
				<a href="<?=path?>/subscribers-dw-xls.php" class="pl-buttons bg-1"><i class="fas fa-floppy"></i> Download List</a>
			</div>
	</div>
</div>

<table class="table">
	  <thead class="thead-default">
		    <tr>
			      <th><input type="checkbox" name="check_all" value="1"></th>
			      <th class="text-left">Subscribers</th>
			      <th>&nbsp;</th>
		    </tr>
	  </thead>
	  <tbody>
				<?php
				$sql = db_select([
						"table" => "subscribers",
						"where" => "trash = 0",
						'order' => 'ORDER BY id DESC LIMIT '.$startpoint.' , '.$limit
				]);
				while($rs = $sql->fetch_assoc()):
				?>
		    <tr id="pt-obj-<?=$rs['id']?>">
			      <th scope="row"><input type="checkbox" name="pl-check[]" value="<?=$rs['id']?>"></th>
			      <td width="100%" class="text-left">
								<h3 class="pl-title"><a><?=$rs['email']?></a></h3>
								<small><?=fh_ago($rs['date'])?></small>
						</td>
			      <td width="15%" class="text-left">
								<a href="" class="pl-options"><i class="icon-options icons"></i></a>
								<ul class="dropdown">
										<?php if($rs['trash']==0): ?>
										<li>
											<a href="javascript: void(0)" class="pl-subscribers-trash" rel="<?=$rs['id']?>">
												<i class="icon-trash icons"></i> Move to trash</a>
											</a>
										</li>
										<?php endif; ?>
                </ul>
			      </td>
		    </tr>
				<?php endwhile;?>
	  </tbody>
</table>

<?php
$sql->close();
echo pl_pagination('subscribers', $limit, "?type={$type}&");
?>
