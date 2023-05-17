<div class="modal fade" id="password-modal" tabindex="-1" role="dialog" aria-labelledby="myPasswordModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form class="pl-form">
				<div class="modal-header">
					<button type="button" class="close pl-buttons" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myPasswordModal"><?=$lang['password']['title']?></h4>
				</div>
				<div class="modal-body">
					<?php if(us_password): ?>
						<label>
							<?=$lang['password']['current']['label']?> <i class="red">*</i>
							<input type="password" name="ch_pass" placeholder="<?=$lang['password']['current']['place']?>">
						</label>
					<?php endif; ?>
						<label>
							<?=$lang['password']['new']['label']?> <i class="red">*</i>
							<input type="password" name="ch_newpass" placeholder="<?=$lang['password']['new']['place']?>">
						</label>
						<label>
							<?=$lang['password']['renew']['label']?> <i class="red">*</i>
							<input type="password" name="ch_repass" placeholder="<?=$lang['password']['renew']['place']?>">
						</label>
					<button type="submit" class="pl-buttons bg-0"><i class="icon-key icons"></i> <?=$lang['password']['button']?></button>
					<hr class="d-none"/>
				</div>
			</form>
		</div>
	</div>
</div>
