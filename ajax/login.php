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
#	¤  Last Update: 26/02/2020                   ¤   #
#	¤                                            ¤   #
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
# -------------------------------------------------#

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	if(!us_level){
    $data_name = sc_sec($_POST['login_name']);
    $data_pass = sc_sec($_POST['login_pass']);
    $data_type = (isset($_POST['login_type']) && $_POST['login_type'] == 1) ? (int)($_POST['login_type']) : 0;

		if(empty($data_name) || empty($data_pass)){
        $alert = [
            'type'  =>'danger',
            'alert' => fh_alerts($lang['login']['alert']['required'])
        ];
		} else {
			   if(db_rows('users WHERE username = "'.$data_name.'" || email = "'.$data_name.'"')){
            $sql = db_select([
                'table'  => 'users',
                'column' => 'id, password, moderat',
                'where'  => '(username = "'.$data_name.'" || email = "'.$data_name.'") && password = "'.sc_pass($data_pass).'"'
            ]);
            if($sql->num_rows){
                $rs = $sql->fetch_assoc();
								if($rs['moderat'] == 0){ // moderat [0=>'active', 1=>'ban', 2=>'need email acivation']
	                if($data_type){
	                  setcookie('login', $rs['id'], time + 31536000);
	                } else {
	                  $_SESSION['login']  = $rs['id'];
	                }

	                $alert = [
	                    'type'  =>'success',
	                    'alert' => fh_alerts($lang['login']['alert']['success'], 'success')
	                ];
								} elseif($rs['moderat'] == 2){
									$alert = [
	                    'type'  =>'danger',
	                    'alert' => fh_alerts($lang['login']['alert']['activation'], 'warning')
	                ];
								} elseif($rs['moderat'] == 3){
									$alert = [
	                    'type'  =>'danger',
	                    'alert' => fh_alerts($lang['login']['alert']['approve'], 'warning')
	                ];
								} else {
									$alert = [
	                    'type'  =>'success',
	                    'alert' => fh_alerts($lang['login']['alert']['moderat'], 'warning')
	                ];
								}
            } else {
                $alert = [
                    'type'  =>'danger',
                    'alert' => fh_alerts($lang['login']['alert']['error'])
                ];
            }
        } else {
            $alert = [
                'type'  =>'danger',
                'alert' => fh_alerts($lang['login']['alert']['error'])
            ];
        }
		}

    echo json_encode($alert);
	}
}
