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

include __DIR__.'/config.php';

# Header Page
include __DIR__.'/header.php';
?>

<div class="pt-plans">
<div class="row">
	<?php
	$sql = db_select([
			"table" => "plans",
			"where" => "id!=1"
	]);
	while($value = $sql->fetch_assoc()):
	?>
		<div class="col">
			<div class="pt-plan">
				<h5><?=$value['name']?></h5>
				<h6><span>$</span><b><?=$value['price']?></b></h6>
				<p><?=$lang['plans']['month']?></p>

				<!-- PayPal payment form for displaying the buy button -->
				<form action="<?php echo PAYPAL_URL; ?>" method="post">
					<!-- Identify your business so that you can collect the payments. -->
					<input type="hidden" name="business" value="<?=PAYPAL_ID?>">

					<!-- Specify a Buy Now button. -->
					<input type="hidden" name="cmd" value="_xclick-subscriptions">

					<!-- Specify details about the item that buyers will purchase. -->
					<input type="hidden" name="item_name" value="<?=$value['plan']?>">
					<input type="hidden" name="item_number" value="Plan#<?=$value['id']-1?>">
					<input type="hidden" name="currency_code" value="<?=PAYPAL_CURRENCY?>">
					<input type="hidden" name="a3" value="<?=$value['price']?>">
					<input type="hidden" name="p3" value="1">
					<input type="hidden" name="t3" value="M">
					<!-- Custom variable user ID -->
    			<input type="hidden" name="custom" value="<?=us_id?>">

					<!-- Specify URLs -->
					<input type="hidden" name="return" value="<?=PAYPAL_RETURN_URL?>">
					<input type="hidden" name="cancel_return" value="<?=PAYPAL_CANCEL_URL?>">

					<!-- Display the payment button. -->
					<button type="sublit" name="submit" class="btn btn-danger <?=($value['id']!=1?'ch' :'')?>">
						<span><?=$lang['plans']['btn']?></span>
					</button>
				</form>
				<ul>
					<?php
					$value['specifics'] = [
						[$value['desc1'], 'green', '1'], [$value['desc2'], '', '1'], [$value['desc3'], '', $value['iframe']],
						[$value['desc4'], '', $value['gender']], [$value['desc5'], '', $value['age']], [$value['desc6'], '', $value['location']],
						[$value['desc7'], '', $value['export']], [$value['desc8'], '', $value['support']], [$value['desc9'], '', $value['ads']]
					];
					foreach ($value['specifics'] as $v):
						?>
						<li<?=($v[1] == 'green' ?' class="alert-success"' :'')?>>
							<span><i class="fas fa-<?=($v[2]=='1'?'check' :'times')?>"></i></span> <?=$v[0]?>
						</li>
						<?php
					endforeach;
					?>
				</ul>
			</div>
		</div>
		<?php
	endwhile;
	?>
</div>
</div>

<?php
include __DIR__."/footer.php";
?>
