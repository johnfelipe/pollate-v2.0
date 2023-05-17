<div class="modal fade" id="sign-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<button type="button" class="close pl-buttons" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><?=$lang['login']['title']?></h4>
				</div>
				<div class="modal-body">
					<?php if(login_facebook || login_twitter || login_google): ?>
					<div class="pl-social-login">
						<?php if(login_facebook): ?>
						<a href="<?=$facebookLoginUrl?>" class="pl-buttons bg-facebook"><i class="fab fa-facebook"></i> <?=$lang['register']['facebook']?></a>
						<?php endif; ?>
						<?php if(login_twitter): ?>
						<a href="<?=$twitterLoginUrl?>" class="pl-buttons bg-twitter"><i class="fab fa-twitter"></i> <?=$lang['register']['twitter']?></a>
						<?php endif; ?>
						<?php if(login_google): ?>
						<a href="<?=$googleLoginUrl?>" class="pl-buttons bg-google"><i class="fab fa-google-plus"></i> <?=$lang['register']['google']?></a>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<div class="pl-group-inp">
						<label>
							<i class="fas fa-user"></i>
							<input type="text" name="login_name" placeholder="<?=$lang['login']['username']?>">
						</label>
					</div>
					<div class="pl-group-inp">
						<label>
							<i class="fas fa-key"></i>
							<input type="password" name="login_pass" placeholder="<?=$lang['login']['password']?>">
						</label>
					</div>
					<hr class="d-none"/>
				</div>
				<div class="modal-footer">
					<div class="pull-left">
						<input type="checkbox" name="login_type" value="1">
						<span><?=$lang['login']['keep']?></span> |
						<a href="#" class="forget-modal"><?=$lang['login']['forget']?></a>
					</div>
					<button type="submit" class="pl-buttons bg-0 float-right"><?=$lang['login']['button']?></button>
				</div>
			</form>
		</div>
	</div>
</div>
