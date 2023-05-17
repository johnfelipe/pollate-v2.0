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

include __DIR__ .'/config.php';
include __DIR__ .'/header.php';
echo '<div class="pl-main">';
if(!empty($_GET['item_number']) && !empty($_GET['tx']) && !empty($_GET['amt']) && !empty($_GET['cc']) && !empty($_GET['st'])){
		$referrer = isset($_SERVER['HTTP_REFERER']) ? sc_sec($_SERVER['HTTP_REFERER']) : '';
		$referrer_arr = isset($referrer) ? explode('.',str_replace('www.','', $referrer)) : [];
		// Check if the results comes from Paypal or sendbox
		if(in_array($referrer_arr[0], ['https://sandbox', 'https://paypal'])){
			$item_number    = sc_sec($_GET['item_number']);
	    $txn_id         = sc_sec($_GET['tx']);
	    $payment_gross  = sc_sec($_GET['amt']);
	    $currency_code  = sc_sec($_GET['cc']);
	    $payment_status = sc_sec($_GET['st']);
	    $puser_id       = sc_sec($_GET['cm']);
			if(db_get("plans", "price", str_replace('Plan#','',$item_number)+1) == $payment_gross){
				if(!db_rows("payments WHERE date > '".(time() - 3600*24*15)."' && author = '{$puser_id}'")){
					$data = [
						"plan"     => "'".str_replace('Plan#','',$item_number)."'",
						"txn_id"   => "'{$txn_id}'",
						"price"    => "'{$payment_gross}'",
						"currency" => "'{$currency_code}'",
						"status"   => "'{$payment_status}'",
						"date"     => "'".time()."'",
						"author"   => "'{$puser_id}'"
					];
					db_insert("payments", $data);
					db_update("users", [
						"plan"        => "'".str_replace('Plan#','',$item_number)."'",
						"txn_id"      => "'{$txn_id}'",
						"lastpayment" => "'".time()."'"
					], $puser_id);
					echo fh_alerts($lang['plans']['alert']['success'], 'success', path.'/index.php');
				} else {
					echo fh_alerts($lang['plans']['alert']['warning'], 'warning', path.'/index.php');
				}

			} else {
				echo fh_alerts($lang['alerts']['wrong'], 'danger', path.'/index.php');
			}
		} else {
			echo fh_alerts($lang['alerts']['wrong'], 'danger', path.'/index.php');
		}
} else {
	echo '<meta http-equiv="refresh" content="0;url='.path.'">';
}
echo "</div>";
include __DIR__ .'/footer.php';
?>
