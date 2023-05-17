<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-globe-alt icons"></i> Languages</h3>
			<p><a href="<?=path?>/cpanel.php">Cpanel</a> / <a href="<?=path?>/cpanel.php?type=languages">Languages</a> / New Language</p>
		</div>
			<div class="pl-col-6 text-right">
			</div>
	</div>
</div>


<?php

$lang = [];
include __DIR__.'/../includes/lang/en.php';

if($id){

	$sql= $db->query("select * from ".prefix."lang where id = '{$id}'");
	$rs = $sql->fetch_assoc();

	$lang = unserialize(base64_decode($rs['content']));
} else {

}

function get_text(){
	global $lang;
	$ret = '';
	$i = 0;
	foreach ($lang as $key => $value) {
		$ret .= '<h6 class="pt-title">'.$key.'<span class="float-right"><i class="fas fa-plus-circle"></i></span></h6>';
		$ret .= '<div class="pt-box">';
		if(is_array($value)){
			foreach ($value as $k => $v) {
				if(is_array($v)){
					foreach ($v as $kk => $vv) {
						if(is_array($vv)){
							foreach ($vv as $kkk => $vvv) {
								$ret .= '<label>'.$k.' -> '.$kk.' -> '.$kkk.'</label><input type="text" name="lang['.$i.']" value="'.sc_sec($vvv).'" placeholder="'.sc_sec($vvv).'"/>';
								$i++;
							}
						} else {
							$ret .= '<label>'.$k.' -> '.$kk.'</label><input type="text" name="lang['.$i.']" value="'.sc_sec($vv).'" placeholder="'.sc_sec($vv).'"/>';
						}
						$i++;
					}
				} else {
					$ret .= '<label>'.$k.'</label><input type="text" name="lang['.$i.']" value="'.sc_sec($v).'" placeholder="'.sc_sec($v).'"/>';
				}
				$i++;
			}
		} else {
			$ret .= '<input type="text" name="lang['.$i.']" value="'.sc_sec($value).'" placeholder="'.sc_sec($value).'"/>';
		}
		$ret .= '</div>';
		$i++;
	}
	return $ret;
}
?>
<div class="pl-cpanel-box">
		<form class="pl-form" id="pl-send-lang">
				<label>Language title <b class="red">*</b>
						<input type="text" name="fullname" placeholder="English" value="<?=($rs?$rs['fullname']:'')?>">
				</label>
				<label>Language short title <b class="red">*</b>
						<input type="text" name="shortname" placeholder="en" value="<?=($rs?$rs['shortname']:'')?>">
				</label>
				<div class="mb-3">
					<input class="tgl tgl-flat" id="cb4" type="checkbox" name="default"<?=($rs?($rs['lang_default']==1?'checked':''):'')?>/>
					<label class="tgl-btn float-left mr-3" for="cb4"></label>
					<label>Default Lang</label>
				</div>

				<label>Site Description
						<div class="pt-textarea"><?=get_text()?></div>
				</label>

				<hr>
				<button type="submit" class="pl-buttons bg-0">Submit</button>
				<input type="hidden" name="id" value="<?=$id?>">
		</form>
</div>
