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

include __DIR__.'/config.php';

# Header Page
include __DIR__.'/header.php';

# Main Page
if(!us_level):
?>
<div class="pl-main">
	<div class="pl-signup" id="pl-signup">
		<h4 class="pl-page-head">
			<?=$lang['register']['title']?>
			<i class="fas fa-key"></i>
		</h4>
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
		<form class="pl-form">
			<label>
				<?=$lang['register']['username']['label']?> <b class="red">*</b>
				<input type="text" name="reg_name" placeholder="<?=$lang['register']['username']['place']?>">
			</label>
			<p>
				<i class="fas fa-question-circle"></i> <?=$lang['register']['username']['p']?><br>
				<i class="fas fa-question-circle"></i> <?=$lang['register']['username']['w']?>
			</p>
			<div class="pl-row">
				<div class="pl-col-6">
					<label>
						<?=$lang['register']['password']['label']?> <b class="red">*</b>
						<input type="password" name="reg_pass" placeholder="<?=$lang['register']['password']['place']?>">
					</label>
					<p><i class="fas fa-question-circle"></i> <?=$lang['register']['password']['p']?></p>
				</div>
				<div class="pl-col-6">
					<label>
						<?=$lang['register']['re-password']['label']?> <b class="red">*</b>
						<input type="password" name="reg_repass" placeholder="<?=$lang['register']['re-password']['place']?>">
					</label>
					<p><i class="fas fa-question-circle"></i> <?=$lang['register']['re-password']['p']?></p>
				</div>
			</div>
			<label>
				<?=$lang['register']['email']['label']?> <b class="red">*</b>
				<input type="text" name="reg_email" placeholder="<?=$lang['register']['email']['place']?>">
			</label>
			<p><i class="fas fa-question-circle"></i> <?=$lang['register']['email']['p']?></p>

			<div class="pl-row">
				<div class="pl-col-4">
					<label><?=$lang['register']['birth']['label']?> <b class="red">*</b></label>
					<div class="pl-birthdate">
						<input type="text" name="reg_birth[]" maxlength="2" size="2" placeholder="DD" /> /
						<input type="text" name="reg_birth[]" maxlength="2" size="2" placeholder="MM" /> /
						<input type="text" name="reg_birth[]" maxlength="4" size="4" placeholder="YYYY" />
					</div>
				</div>
				<div class="pl-col-4">
					<label><?=$lang['register']['address']['country']?> <b class="red">*</b></label>
					<?=fh_regAdress(0)?>
				</div>
				<div class="pl-col-4">
						<label><?=$lang['register']['gender']['label']?> <b class="red">*</b></label>
						<div class="pl-select">
								<select name="reg_sex">
										<option value="1"><?=$lang['register']['gender']['male']?></option>
										<option value="2"><?=$lang['register']['gender']['female']?></option>
								</select>
						</div>
				</div>
			</div>
			<hr/>
			<button type="submit" class="pl-buttons bg-0"><?=$lang['register']['button']?> <i class="fas fa-arrow-circle-right"></i></button>
		</form>
	</div>
</div><!-- End Main -->
<?php
else:
	echo fh_alerts($lang['alerts']['permission']);
	$sidebar = false;
endif;
# Footer Page
include __DIR__.'/footer.php';
