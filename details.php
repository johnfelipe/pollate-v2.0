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
if(us_level):
	$db_rs = '';
	if($id){
		if(us_level == 6){
			$db_rs = db_rs(db_select([
				'table' => 'users',
				'where' => "id = '{$id}' && trash = 0"
			]));
		} else {
			echo fh_alerts($lang['alerts']['permission']);
			$sidebar = false;
			include __DIR__.'/footer.php';
			exit;
		}
	}
?>
<div class="pl-main">
  <div class="pl-signup">
				<h4 class="pl-page-head">
						<?=$lang['details']['title']?> <?=$id?'<small>('.fh_user($id).')</small>':''?>
						<i class="icon-note icons"></i>
				</h4>
				<div class="pl-social-login">
						<input id="images" name="images[]" type="file" multiple>
				</div>
				<form class="pl-form" id="send-details">
						<div class="pl-row">
								<div class="pl-col-6">
										<label>
												<?=$lang['details']['first']['label']?> <b class="red">*</b>
												<input type="text" name="reg_firstname" value="<?=($db_rs?$db_rs['firstname']:us_firstname)?>" placeholder="<?=$lang['details']['first']['place']?>">
										</label>
								</div>
								<div class="pl-col-6">
										<label>
												<?=$lang['details']['last']['label']?> <b class="red">*</b>
												<input type="text" name="reg_lastname" value="<?=($db_rs?$db_rs['lastname']:us_lastname)?>" placeholder="<?=$lang['details']['last']['place']?>">
										</label>
								</div>
						</div>
            <label>
                <?=$lang['register']['username']['label']?> <b class="red">*</b>
                <input type="text" name="reg_name" value="<?=($db_rs?$db_rs['username']:us_username)?>" placeholder="<?=$lang['register']['username']['place']?>">
            </label>
						<p>
							<i class="fas fa-question-circle"></i> <?=$lang['register']['username']['p']?><br>
							<i class="fas fa-question-circle"></i> <?=$lang['register']['username']['w']?>
						</p>
            <label>
                <?=$lang['register']['email']['label']?> <b class="red">*</b>
                <input type="text" name="reg_email" value="<?=($db_rs?$db_rs['email']:us_email)?>" placeholder="<?=$lang['register']['email']['place']?>">
            </label>
						<p><i class="fas fa-question-circle"></i> <?=$lang['register']['email']['p']?></p>

						<div class="pl-row">
							<div class="pl-col-4">
								<label><?=$lang['register']['birth']['label']?> <b class="red">*</b></label>
								<div class="pl-birthdate">
									<input type="text" name="reg_birth[]" value="<?=($db_rs?db_unserialize([$db_rs['birth'], 0]):db_unserialize([us_birth, 0]))?>" maxlength="2" size="2" placeholder="DD" /> /
									<input type="text" name="reg_birth[]" value="<?=($db_rs?db_unserialize([$db_rs['birth'], 1]):db_unserialize([us_birth, 1]))?>" maxlength="2" size="2" placeholder="MM" /> /
									<input type="text" name="reg_birth[]" value="<?=($db_rs?db_unserialize([$db_rs['birth'], 2]):db_unserialize([us_birth, 2]))?>" maxlength="4" size="4" placeholder="YYYY" />
								</div>
							</div>
							<div class="pl-col-4">
								<label><?=$lang['register']['address']['country']?> <b class="red">*</b></label>
								<?=fh_regAdress(($db_rs?db_unserialize([$db_rs['address'], 0]):db_unserialize([us_address, 0])))?>
							</div>
							<div class="pl-col-4">
									<label><?=$lang['register']['gender']['label']?> <b class="red">*</b></label>
									<div class="pl-select">
										<select name="reg_sex">
												<option value="1"<?=($db_rs?($db_rs['sex']==1?' selected':''):(us_sex==1?' selected':''))?>><?=$lang['register']['gender']['male']?></option>
												<option value="2"<?=($db_rs?($db_rs['sex']==2?' selected':''):(us_sex==2?' selected':''))?>><?=$lang['register']['gender']['female']?></option>
										</select>
									</div>
							</div>
						</div>

            <label class="pl-small-desk">
                <?=$lang['details']['desc']['label']?> <small>120</small>
								<textarea name="reg_desc" placeholder="<?=$lang['details']['desc']['place']?>"><?=($db_rs?$db_rs['description']:us_description)?></textarea>
            </label>
						<label>
                <?=$lang['details']['photo']['label']?>
								<div class="pl-select">
										<select name="reg_photo" class="disabled pl-select-append" disabled>
											<option value=""><?=$lang['details']['photo']['place']?></option>
										</select>
								</div>
            </label>
						<label>
                <?=$lang['details']['cover']['label']?>
								<div class="pl-select">
										<select name="reg_cover" class="disabled pl-select-append" disabled>
											<option value=""><?=$lang['details']['cover']['place']?></option>
										</select>
								</div>
            </label>
						<label><?=$lang['details']['socials']?></label>
						<div class="pl-group-inp">
                <i class="icon-social-facebook icons bg-facebook"></i>
                <input type="text" name="reg_facebook" value="<?=($db_rs?(db_unserialize([$db_rs['socials'], 'facebook'])?db_unserialize([$db_rs['socials'], 'facebook']):''):(db_unserialize([us_socials, 'facebook'])?db_unserialize([us_socials, 'facebook']):''))?>" placeholder="https://facebook.com/{username}">
            </div>
						<div class="pl-group-inp">
                <i class="icon-social-twitter icons bg-twitter"></i>
                <input type="text" name="reg_twitter" value="<?=($db_rs?(db_unserialize([$db_rs['socials'], 'twitter'])?db_unserialize([$db_rs['socials'], 'twitter']):''):(db_unserialize([us_socials, 'twitter'])?db_unserialize([us_socials, 'twitter']):''))?>" placeholder="https://twitter.com/{username}">
            </div>
						<div class="pl-group-inp">
                <i class="icon-social-youtube icons bg-youtube"></i>
                <input type="text" name="reg_youtube" value="<?=($db_rs?(db_unserialize([$db_rs['socials'], 'youtube'])?db_unserialize([$db_rs['socials'], 'youtube']):''):(db_unserialize([us_socials, 'youtube'])?db_unserialize([us_socials, 'youtube']):''))?>" placeholder="https://youtube.com/{username}">
            </div>
						<div class="pl-group-inp">
                <i class="icon-social-google icons bg-google"></i>
                <input type="text" name="reg_google" value="<?=($db_rs?(db_unserialize([$db_rs['socials'], 'google'])?db_unserialize([$db_rs['socials'], 'google']):''):(db_unserialize([us_socials, 'google'])?db_unserialize([us_socials, 'google']):''))?>" placeholder="https://plus.google.com/{username}">
            </div>
						<div class="pl-group-inp">
                <i class="icon-social-instagram icons bg-instagram"></i>
                <input type="text" name="reg_instagram" value="<?=($db_rs?(db_unserialize([$db_rs['socials'], 'instagram'])?db_unserialize([$db_rs['socials'], 'instagram']):''):(db_unserialize([us_socials, 'instagram'])?db_unserialize([us_socials, 'instagram']):''))?>" placeholder="https://instagram.com/{username}">
            </div>
						<hr/>
						<button type="submit" class="pl-buttons bg-0"><?=$lang['details']['button']?> <i class="fas fa-arrow-circle-right"></i></button>
						<?php if($id): ?>
						<input type="hidden" name="id" value="<?=$id?>">
						<?php endif; ?>
        </form>
    </div>
</div><!-- End Main -->
<?php
$sidebar = [
	'access'     => true,
	'ads'        => true,
	'questions'  => false,
	'categories' => false,
	'social'     => true,
	'people'     => true
];
else:
	echo fh_alerts($lang['alerts']['permission']);
	$sidebar = false;
endif;
# Footer Page
include __DIR__.'/footer.php';
