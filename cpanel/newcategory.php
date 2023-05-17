<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-note icons"></i> <?=($id?'Edit':'Create New')?> Category</h3>
			<p><a href="<?=path?>/cpanel.php">Cpanel</a> / <a href="<?=path?>/cpanel.php?type=categories">Categories</a> / <?=($id?'Edit':'New')?> category</p>
		</div>
			<div class="pl-col-6 text-right">
				<a href="<?=path?>/cpanel.php?type=categories" class="pl-buttons bg-9"><i class="fas fa-arrow-left"></i> Back</a>
				<a href="#" class="pl-buttons bg-0"><i class="fas fa-floppy"></i> Save as draft</a>
			</div>
	</div>
</div>
<?php
$rs = null;
if($id){
		$rs = db_rs(db_select([
				"table" => "categories",
				"where" => "id = '{$id}' && trash = 0"
		]));
}
?>
<div class="pl-cpanel-box">
		<form class="pl-form" id="pl-send-category">
				<label>Category Name <b class="red">*</b>
						<input type="text" name="pg_title" placeholder="type the category name" value="<?=($rs['title']?db_output($rs['title']):null)?>">
				</label>

				<label>Category Keywords <b class="red">*</b>
						<input type="text" name="pg_keywords" data-role="tagsinput" id="tagsinput" placeholder="type the category keywords" value="<?=($rs['keywords']?implode(',',unserialize($rs['keywords'])):null)?>">
				</label>
				<p>
						<i class="fas fa-question-circle"></i> This field must have atleast 3 keywords.<br>
						<i class="fas fa-question-circle"></i> You have to separate keywords with comma.
				</p>

				<label>Category Sort
						<input type="text" name="pg_sort" placeholder="type the category sort" value="<?=($rs['sort']?db_output($rs['sort']):null)?>">
				</label>

				<label>Category Bg Color <b class="red">*</b><br />
						<input type="text" name="pg_bg" id="colorpicker-popup" placeholder="type the category bg color" value="<?=($rs['bg']?db_output($rs['bg']):null)?>">
						<input type="hidden" name="pg_bg_v" value="<?=($rs['bg']?db_output($rs['bg']):null)?>">
				</label>

				<label>Category Icon <b class="red">*</b>
						<input type="text" name="pg_icon" class="my" placeholder="type the category icon" value="<?=($rs['icon']?db_output($rs['icon']):null)?>">
				</label>

				<hr>
				<button type="submit" class="pl-buttons bg-0">Submit</button>
				<input type="hidden" name="id" value="<?=$id?>">
		</form>
</div>
