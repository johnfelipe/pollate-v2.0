<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-tag icons"></i> Categories</h3>
			<p><a href="#">Cpanel</a> / Categories</p>
		</div>
		<div class="pl-col-6 text-right">
			<a href="#" class="pl-buttons bg-0 pl-category-trash" data-multi="true"><i class="fas fa-trash"></i> Trash</a>
			<a href="<?=path?>/cpanel.php?type=newcategory" class="pl-buttons bg-1"><i class="fas fa-plus"></i> New Category</a>
		</div>
	</div>
</div>

<table class="table">
	  <thead class="thead-default">
		    <tr>
			      <th><input type="checkbox" name="check_all" value="1"></th>
			      <th class="text-left">Category title</th>
			      <th>&nbsp;</th>
		    </tr>
	  </thead>
	  <tbody>
				<?php
				$sql = db_select([
						"table" => "categories",
						"where" => "trash = 0",
						'order' => 'ORDER BY sort DESC LIMIT '.$startpoint.' , '.$limit
				]);
				while($rs = $sql->fetch_assoc()):
				?>
		    <tr id="pt-obj-<?=$rs['id']?>">
			      <th scope="row"><input type="checkbox" name="pl-check[]" value="<?=$rs['id']?>"></th>
			      <td width="100%" class="text-left">
								<div class="media">
										<div class="media-left">
											<div class="pl-thumb" style="background: #<?=$rs['bg']?>"><i class="<?=$rs['icon']?>"></i></div>
										</div>
										<div class="media-body">
												<h3 class="pl-title"><a href="<?=path?>/index.php?type=categories&amp;id=<?=fh_seoURL($rs['id'], 'categories', $rs['title'])?>"><?=$rs['title']?></a></h3>
												<small>Questions: <?=$rs['questions']?></small>
										</div>
								</div>
						</td>
			      <td width="15%" class="text-left">
								<a href="" class="pl-options"><i class="icon-options icons"></i></a>
								<ul class="dropdown">
										<?php if($rs['trash']==0): ?>
										<li>
											<a href="javascript: void(0)" rel="<?=$rs['id']?>" class="pl-category-trash">
												<i class="icon-trash icons"></i> Move to trash</a>
											</a>
										</li>
										<?php endif; ?>
                  	<li><a href="<?=path?>/cpanel.php?type=newcategory&amp;id=<?=$rs['id']?>"><i class="icon-pencil icons"></i> Edit Category</a></li>
                </ul>
			      </td>
		    </tr>
				<?php endwhile;?>
	  </tbody>
</table>

<?php
$sql->close();
echo pl_pagination('categories', $limit, "?type={$type}&");
?>
