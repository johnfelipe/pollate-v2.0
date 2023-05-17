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

if(us_level):
$disable = (us_credits*site_credit_value < site_credit_reach ? 'disabled' : '');
# Main Page
?>
<div class="pl-main pl-body-voters">
		<div class="pl-box">
				<h3 class="pl-tile">
					<?=$lang['payout']['title']?>
				</h3>
				<h3 class="pl-tile2">
					<?=str_replace("{cc}", "<b>".us_credits." ".$lang['payout']['points']."</b>", $lang['payout']['stitle'])?>
					 = <b>$<?=us_credits*site_credit_value?> USD</b>
				</h3>
				<form class="pl-form p-3" id="send-credits">
					<label>
						<?=$lang['payout']['credits']?> <b class="red">*</b>
						<input type="number" name="points" placeholder="<?=$lang['payout']['cp']?>" value="<?=us_credits?>"<?=$disable?>>
					</label>
					<label>
						<?=$lang['payout']['email']?> <b class="red">*</b>
						<input type="text" name="email" placeholder="<?=$lang['payout']['ep']?>" value="<?=us_email?>"<?=$disable?>>
					</label>
					<p>
						<i class="fas fa-question-circle"></i>
						<?=str_replace("{cc}", "<b>$".site_credit_reach." USD</b>", $lang['payout']['need'])?>
					</p>
					<hr/>
					<button type="submit" class="pl-buttons bg-0"<?=$disable?>><?=$lang['payout']['btn']?> <i class="fas fa-arrow-circle-right"></i></button>
				</form>
				<table class="table">
					<thead>
						<th><?=$lang['payout']['credits']?></th>
						<th><?=$lang['payout']['price']?></th>
						<th><?=$lang['payout']['status']?></th>
						<th><?=$lang['payout']['created']?></th>
					</thead>
						<?php
						$sql = db_select([
								'table'  => 'payout',
								'where'  => 'author = "'.us_id.'"',
								'order'  => 'ORDER BY id DESC LIMIT '.$startpoint.' , '.$limit
						]);
						if($sql->num_rows):
						while($rs = $sql->fetch_assoc()):
						?>
						<tr>
							<td><?=$rs['credits']?></td>
							<td>$<?=$rs['price']?></td>
							<td><span class="text-white badge bg-p<?=($rs['status'] ? '1' : '2')?>"><?=($rs['status'] ? 'Success' : 'Waiting')?></span></td>
							<td><?=fh_ago($rs['created_at'])?></td>
						</tr>
						<?php
						endwhile;
						else:
						?>
						<tr><td class="pl-not-found"><?=$lang['alerts']['no-data']?></td></tr>
						<?php
						endif;
						$sql->close();
						?>
				</table>
		</div>
		<?=pl_pagination("payout WHERE author = '".ud_id."'", $limit, path."/credits.php?");?>
</div><!-- End Main -->

<?php
endif;

# Footer Page
include __DIR__.'/footer.php';
