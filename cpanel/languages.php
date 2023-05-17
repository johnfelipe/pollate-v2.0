<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-globe-alt icons"></i> Languages</h3>
			<p><a href="<?=path?>/cpanel.php">Cpanel</a> / Languages</p>
		</div>
			<div class="pl-col-6 text-right">
				<a href="#" class="pl-buttons bg-0 pl-lang-trash" data-multi="true"><i class="fas fa-trash"></i> Trash</a>
				<a href="<?=path?>/cpanel.php?type=newlang" class="pl-buttons bg-1"><i class="fas fa-plus"></i> New Language</a>
			</div>
	</div>
</div>

<table class="table" id="customPersistTables">
	  <thead class="thead-default">
		    <tr>
			      <th><input type="checkbox" name="check_all" value="1"></th>
			      <th class="text-left">Language</th>
			      <th>DEFAULT</th>
			      <th>Created</th>
			      <th>Last Update</th>
			      <th>&nbsp;</th>
		    </tr>
	  </thead>
	  <tbody>
				<?php
				$sql = db_select([
						"table" => "lang",
						"where" => "trash = 0",
						"order" => "ORDER BY sort ASC"
				]);
				if($sql->num_rows):
				while($rs = $sql->fetch_assoc()):
				?>
		    <tr id="pt-obj-<?=$rs['id']?>" class="drag">
			      <th scope="row"><input type="checkbox" name="pl-check[]" value="<?=$rs['id']?>"></th>
			      <td width="45%" class="text-left">
							<a href="#"><span class="flag-icon flag-icon-<?=db_output($rs['shortname'])?> mr-2"></span><?=db_output($rs['fullname'])?></a>
						</td>
			      <td width="15%" class="text-center"><?=($rs['lang_default']?'<b class="badge badge-success">Yes</b>':'<b class="badge badge-danger">No</b>')?></td>
			      <td width="15%" class="text-center"><?=date('d M, Y', $rs['created_at'])?></td>
			      <td width="15%" class="text-center"><?=fh_ago($rs['updated_at'])?></td>
			      <td>
								<a href="#" class="pl-options"><i class="icon-options icons"></i></a>
								<ul class="dropdown">
									<?php if($rs['trash']==0): ?>
									<li>
										<a href="javascript: void(0)" rel="<?=$rs['id']?>" class="pl-lang-trash">
											<i class="icon-trash icons"></i> Move to trash</a>
										</a>
									</li>
									<?php endif; ?>
                	<li><a href="<?=path?>/cpanel.php?type=newlang&amp;id=<?=$rs['id']?>"><i class="icon-pencil icons"></i> Edit Language</a></li>
                </ul>
			      </td>
		    </tr>
				<?php endwhile;?>
				<?php else:?>
					<tr><td colspan="5"><center>no page found!</center></td></tr>
				<?php endif;?>
	  </tbody>
</table>
