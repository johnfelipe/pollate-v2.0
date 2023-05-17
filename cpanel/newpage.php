<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-note icons"></i> <?=($id?'Edit':'Create New')?> Page</h3>
			<p><a href="<?=path?>/cpanel.php">Cpanel</a> / <a href="<?=path?>/cpanel.php?type=pages">Static Pages</a> / <?=($id?'Edit':'New')?> Page</p>
		</div>
			<div class="pl-col-6 text-right">
				<a href="<?=path?>/cpanel.php?type=pages" class="pl-buttons bg-9"><i class="fas fa-arrow-left"></i> Back</a>
			</div>
	</div>
</div>
<?php
$rs = null;
if($id){
		$rs = db_rs(db_select([
				"table" => "pages",
				"where" => "id = '{$id}' && trash = 0"
		]));
}
?>
<div class="pl-cpanel-box">
		<form class="pl-form" id="pl-send-page">
				<label>Page Name <b class="red">*</b>
						<input type="text" name="pg_title" placeholder="type the page name" value="<?=($rs['title']?db_output($rs['title']):null)?>">
				</label>

				<label>Page Keywords <b class="red">*</b>
						<input type="text" name="pg_keywords" data-role="tagsinput" id="tagsinput" placeholder="type the page keywords" value="<?=($rs['keywords']?implode(',',unserialize($rs['keywords'])):null)?>">
				</label>
				<p>
						<i class="fas fa-question-circle"></i> This field must have atleast 3 keywords.<br>
						<i class="fas fa-question-circle"></i> You have to separate keywords with comma.
				</p>

				<label>Page Sort
						<input type="text" name="pg_sort" placeholder="type the page sort" value="<?=($rs['sort']?db_output($rs['sort']):null)?>">
				</label>
				<div class="mb-3">
					<input class="tgl tgl-flat" id="cb4" type="checkbox" name="footer"<?=($rs?($rs['footer']==1?'checked':''):'')?>/>
					<label class="tgl-btn float-left mr-3" for="cb4"></label>
					<label>Don't show in Footer</label>
				</div>


				<textarea name="pg_content" class="wysibb-editor" id="wysibb-editor"><?=($rs['content']?db_output($rs['content']):null)?></textarea>
				<hr>
				<button type="submit" class="pl-buttons bg-0">Submit</button>
				<input type="hidden" name="id" value="<?=$id?>">
		</form>
</div>
