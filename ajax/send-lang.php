<?php
# -------------------------------------------------#
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
#	¤                                            ¤   #
#	¤         Pollogo - Poll script 1.0          ¤   #
#	¤--------------------------------------------¤   #
#	¤              By Khalid Puerto              ¤   #
#	¤--------------------------------------------¤   #
#	¤                                            ¤   #
#	¤  Facebook : fb.com/prof.puertokhalid       ¤   #
#	¤  Instagram : instagram.com/khalidpuerto    ¤   #
#	¤  Site : http://www.puertokhalid.com        ¤   #
#	¤                                            ¤   #
#	¤--------------------------------------------¤   #
#	¤                                            ¤   #
#	¤  Last Update: 21/04/2020                   ¤   #
#	¤                                            ¤   #
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
# -------------------------------------------------#

function _ff($langs){
	$str = rtrim(sc_sec($langs));
	$str = preg_replace('/(\r\n|\r|\n)+/', '', $str);
	$str = preg_replace('/\n/', '', $str);
	$str = preg_replace('/\\\\{2,}/', '',$str);
	$str = preg_replace('/n$/', '',$str);
	return $str;
}

function fh_lang($read, $txt = false){
	if($txt){
		$file = __DIR__.'/../includes/lang/translator/'.$txt.'.txt';
		$read = file_get_contents($file);
		$read = file($file);
	}

	$lang = [];
	include __DIR__.'/../includes/lang/en.php';

	$langs = [];
	$i = 0;
	foreach ($lang as $key => $value) {
		if(is_array($value)){
			foreach ($value as $k => $v) {
				if(is_array($v)){
					foreach ($v as $kk => $vv) {
						if(is_array($vv)){
							foreach ($vv as $kkk => $vvv) {
								$langs[$key][$k][$kk][$kkk] = _ff($read[$i]);
								$i++;
							}
						} else {
							$langs[$key][$k][$kk] = _ff($read[$i]);
						}
						$i++;
					}
				} else {
					$langs[$key][$k] = _ff($read[$i]);
				}
				$i++;
			}
		} else {
			$langs[$key] = _ff($read[$i]);
		}
		$i++;
	}

	return $langs;

}



if($_SERVER['REQUEST_METHOD'] === 'POST'){
	if(us_level == 6){

		$fullname  = sc_sec($_POST['fullname']);
		$shortname = sc_sec($_POST['shortname']);
		$default   = isset($_POST['default']) ? 1 : 0;
		$pg_id     = isset($_POST['id']) ? (int)($_POST['id']) : 0;
		$langs     = fh_lang($_POST['lang']);

		if(empty($fullname) || empty($shortname)){
			$alert = [
				'type'  =>'danger',
				'alert' => fh_alerts($lang['register']['alert']['required'])
			];
		} else {
			$data = [
				'fullname'     => "'{$fullname}'",
				'shortname'    => "'{$shortname}'",
				'flag'         => "'{$shortname}'",
				'lang_default' => "'{$default}'",
				'updated_at'   => "'".time."'",
				'content'      => "'".base64_encode(serialize($langs))."'"
			];

			if($default == 1){
				$db->query("UPDATE ".prefix."lang SET lang_default = 0");
			}

			if($pg_id){
				db_update('lang', $data, $pg_id);
			} else {
				$data['created_at'] = "'".time."'";
				db_insert("lang", $data);
			}


			$alert = [
				'type'  =>'success',
				'alert' => fh_alerts('Lang has sended successfully.', 'success')
			];
		}

		echo json_encode($alert);


	}
}
