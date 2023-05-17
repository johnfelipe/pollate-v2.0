<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-paypal icons"></i> Plans</h3>
			<p><a href="#">Cpanel</a> / Plans</p>
		</div>
	</div>
</div>

<div class="pl-cpanel-box">
		<form class="pl-form" id="pl-send-plans">
			<div class="row">

				<?php
				$sql = db_select([
						"table" => "plans"
				]);
				while($rs = $sql->fetch_assoc()):
				?>
		    <div class="col-6">
					<div class="pl-cpanel-box mb-3">
					<?php foreach ($rs as $key => $value): ?>
						<?php if(!in_array($key, ['id', 'created_at', 'iframe', 'gender', 'age', 'location', 'export', 'support', 'ads'])): ?>
						<label> <?php if(in_array($key, ['poll_month', 'votes_month'])): ?><?=$key?> <?php endif;?>
							<input type="text" name="<?=$key?>[<?=$rs['id']?>]" placeholder="plan <?=$key?>" value="<?=$value?>">
						</label>
						<?php endif;?>
						<?php if(in_array($key, ['iframe', 'gender', 'age', 'location', 'export', 'support', 'ads'])): ?>
							<div class="mb-3">
								<input class="tgl tgl-flat" id="<?=$key.$rs['id']?>" type="checkbox" name="<?=$key?>[<?=$rs['id']?>]"<?=($value==1?'checked':'')?>/>
								<label class="tgl-btn float-left mr-3" for="<?=$key.$rs['id']?>"></label>
								<label><?=$key?></label>
							</div>

						<?php endif;?>
					<?php endforeach;?>
		    </div>
		    </div>
				<?php endwhile;?>
			</div>
			<button type="submit" class="pl-buttons bg-0">Submit</button>
	  </form>
</div>

<?php
$sql->close();
?>
