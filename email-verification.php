<?php
/*=======================================================/
	| Craeted By: Khalid puerto
	| URL: www.puertokhalid.com
	| Facebook: www.facebook.com/prof.puertokhalid
	| Instagram: www.instagram.com/khalidpuerto
	| Whatsapp: +212 654 211 360
 /======================================================*/

include __DIR__."/config.php";
include __DIR__."/header.php";
?>

<div class="pl-main">
		<?php
			$sql = $db->query("SELECT * FROM ".prefix."users WHERE moderat = 2 && token = '".sc_sec($_GET['token'])."' LIMIT 1");
			if($sql->num_rows){
				$rs = $sql->fetch_assoc();
				if(sha1($rs['email']) == sc_sec($_GET['t'])){
					db_update("users", ["moderat"=>"'0'"], sc_sec($_GET['token']), 'token');
					echo fh_alerts("All right, you can login now.", "success", path.'/index.php');
				} else {
					echo fh_alerts($lang['alerts']['wrong'], 'danger', path.'/index.php');
				}
			} else {
				echo fh_alerts($lang['alerts']['wrong'], 'danger', path.'/index.php');
			}
		?>
</div>
<?php
include __DIR__."/footer.php";
?>
