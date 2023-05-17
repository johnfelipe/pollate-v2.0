<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-note icons"></i> Setting</h3>
			<p><a href="<?=path?>/cpanel.php">Cpanel</a> / Setting</p>
		</div>
			<div class="pl-col-6 text-right">
			</div>
	</div>
</div>
<?php

?>
<div class="pl-cpanel-box">
		<form class="pl-form" id="pl-send-setting">
				<label>Site title <b class="red">*</b>
						<input type="text" name="pg_title" placeholder="type the site title" value="<?=site_title?>">
				</label>

				<label>Site Keywords <b class="red">*</b>
						<input type="text" name="pg_keywords" data-role="tagsinput" id="tagsinput" placeholder="type the site keywords" value="<?=site_keywords?>">
				</label>
				<p>
						<i class="fas fa-question-circle"></i> This field must have atleast 3 keywords.<br>
						<i class="fas fa-question-circle"></i> You have to separate keywords with comma.
				</p>

				<label>Site Description
						<textarea name="pg_description"><?=site_description?></textarea>
				</label>

				<h3 class="cp-form-title">Features need approvel</h3>
				<div class="pl-row">
					<div class="pl-col-3"><b>Questions</b></div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="qs-0" type="radio" name="pg_question" value="0"<?=(site_letters == 0 ? ' checked':'')?>>
				      <label for="qs-0">No</label>
					  </div>
					</div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="qs-1" type="radio" name="pg_question" value="1"<?=(site_letters == 1 ? ' checked':'')?>>
				      <label for="qs-1">Yes</label>
					  </div>
					</div>
				</div>
				<br clear="both"/>
				<div class="pl-row">
					<div class="pl-col-3"><b>Comments</b></div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="cm-0" type="radio" name="pg_comment" value="0"<?=(site_comments == 0 ? ' checked':'')?>>
				      <label for="cm-0">No</label>
					  </div>
					</div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="cm-1" type="radio" name="pg_comment" value="1"<?=(site_comments == 1 ? ' checked':'')?>>
				      <label for="cm-1">Yes</label>
					  </div>
					</div>
				</div>
				<br clear="both"/>
				<div class="pl-row">
					<div class="pl-col-3"><b>Registration</b></div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="rg-0" type="radio" name="pg_register" value="0"<?=(site_register == 0 ? ' checked':'')?>>
				      <label for="rg-0">No</label>
					  </div>
					</div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="rg-1" type="radio" name="pg_register" value="1"<?=(site_register == 1 ? ' checked':'')?>>
				      <label for="rg-1">Yes</label>
					  </div>
					</div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="rg-2" type="radio" name="pg_register" value="2"<?=(site_register == 2 ? ' checked':'')?>>
				      <label for="rg-2">By email confirmation</label>
					  </div>
					</div>
				</div>
				<br clear="both"/>
				<div class="pl-row">
					<div class="pl-col-3"><b>Vesitors voting form</b></div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="rg-v0" type="radio" name="voting_form" value="0"<?=(voting_form == 0 ? ' checked':'')?>>
				      <label for="rg-v0">Enable</label>
					  </div>
					</div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="rg-v1" type="radio" name="voting_form" value="1"<?=(voting_form == 1 ? ' checked':'')?>>
				      <label for="rg-v1">Disable</label>
					  </div>
					</div>
				</div>
				<br clear="both"/>
				<div class="pl-row">
					<div class="pl-col-3"><b>Plans</b></div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="rg-sp0" type="radio" name="site_plan" value="1"<?=(site_plan == 1 ? ' checked':'')?>>
				      <label for="rg-sp0">Enable</label>
					  </div>
					</div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="rg-sp1" type="radio" name="site_plan" value="0"<?=(site_plan == 0 ? ' checked':'')?>>
				      <label for="rg-sp1">Disable</label>
					  </div>
					</div>
				</div>

				<br clear="both"/>
				<h3 class="cp-form-title">Credits</h3>
				<div class="pl-row">
					<div class="pl-col-3"><b>Question</b></div>
					<div class="pl-col-3"><input type="number" name="credits_question" value="<?=credits_question?>"></div>
				</div>
				<div class="pl-row">
					<div class="pl-col-3"><b>Comment</b></div>
					<div class="pl-col-3"><input type="number" name="credits_comment" value="<?=credits_comment?>"></div>
				</div>
				<div class="pl-row">
					<div class="pl-col-3"><b>Vote</b></div>
					<div class="pl-col-3"><input type="number" name="credits_vote" value="<?=credits_vote?>"></div>
				</div>
				<div class="pl-row">
					<div class="pl-col-3"><b>Sign up</b></div>
					<div class="pl-col-3"><input type="number" name="credits_register" value="<?=credits_register?>"></div>
				</div>
				<div class="pl-row">
					<div class="pl-col-3"><b>Credit Value</b></div>
					<div class="pl-col-3"><input type="text" name="site_credit_value" value="<?=site_credit_value?>"><p>1 credit point = $<?=site_credit_value?></p></div>
				</div>

				<div class="pl-row">
					<div class="pl-col-3"><b>How much for withdrawn</b></div>
					<div class="pl-col-3"><input type="number" name="site_credit_reach" value="<?=site_credit_reach?>"><p>Users need to reach to $<?=site_credit_reach?> for making request</p></div>
				</div>


				<br clear="both"/>
				<h3 class="cp-form-title">Other</h3>
				<label>Facebook Box
						<input type="text" name="facebook_box" placeholder="Facebook Page Username" value="<?=facebook_box?>">
				</label>
				<label>Do not reply email
						<input type="text" name="notreply" placeholder="donotreply Email" value="<?=notreply?>">
				</label>
				<label>Questions in home
						<input type="number" name="home_questions" placeholder="5" value="<?=home_questions?>">
				</label>
				<label>Sidebar Adsense Code
						<textarea name="ads_1" placeholder="Sidebar Ads Number"><?=ads_1?></textarea>
				</label>
				<label>Sidebar Adsense Code 2
						<textarea name="ads_2" placeholder="Sidebar Ads Number"><?=ads_2?></textarea>
				</label>
				<label>Adsense Code Before First Poll
						<textarea name="ads_3" placeholder="Sidebar Ads Number"><?=ads_3?></textarea>
				</label>
				<label>Adsense Code After First Poll
						<textarea name="ads_4" placeholder="Sidebar Ads Number"><?=ads_4?></textarea>
				</label>
				<label>Adsense Code After Third Poll
						<textarea name="ads_5" placeholder="Sidebar Ads Number"><?=ads_5?></textarea>
				</label>

				<br clear="both"/>
				<h3 class="cp-form-title">Social media login</h3>
				<div class="pl-row">
					<div class="pl-col-3"><b>Facebook login</b></div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="rg-lf0" type="radio" name="login_facebook" value="0"<?=(login_facebook == 0 ? ' checked':'')?>>
				      <label for="rg-lf0">Disable</label>
					  </div>
					</div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="rg-lf1" type="radio" name="login_facebook" value="1"<?=(login_facebook == 1 ? ' checked':'')?>>
				      <label for="rg-lf1">Enable</label>
					  </div>
					</div>
				</div>
				<br clear="both"/>
				<label>Facebook app id
						<input type="text" name="login_fbAppId" placeholder="Facebook App Id" value="<?=login_fbAppId?>">
				</label>
				<label>Facebook app secret
						<input type="text" name="login_fbAppSecret" placeholder="Facebook App Secret" value="<?=login_fbAppSecret?>">
				</label>
				<label>Facebook app version
						<input type="text" name="login_fbAppVersion" placeholder="Facebook App Version" value="<?=login_fbAppVersion?>">
				</label>
				<label>Redirect Url
						<input type="text" value="<?=path?>/login-facebook-rd.php" disabled>
				</label>

				<br clear="both"/>
				<br clear="both"/>
				<div class="pl-row">
					<div class="pl-col-3"><b>Twitter login</b></div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="rg-lt0" type="radio" name="login_twitter" value="0"<?=(login_twitter == 0 ? ' checked':'')?>>
				      <label for="rg-lt0">Disable</label>
					  </div>
					</div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="rg-lt1" type="radio" name="login_twitter" value="1"<?=(login_twitter == 1 ? ' checked':'')?>>
				      <label for="rg-lt1">Enable</label>
					  </div>
					</div>
				</div>
				<br clear="both"/>
				<label>Twitter app key
						<input type="text" name="login_twConKey" placeholder="Twitter App Key" value="<?=login_twConKey?>">
				</label>
				<label>Twitter app secret
						<input type="text" name="login_twConSecret" placeholder="Twitter App Secret" value="<?=login_twConSecret?>">
				</label>
				<label>Redirect Url
						<input type="text" value="<?=path?>/login-twitter.php" disabled>
				</label>

				<br clear="both"/>
				<br clear="both"/>
				<div class="pl-row">
					<div class="pl-col-3"><b>Google login</b></div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="rg-lg0" type="radio" name="login_google" value="0"<?=(login_google == 0 ? ' checked':'')?>>
				      <label for="rg-lg0">Disable</label>
					  </div>
					</div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="rg-lg1" type="radio" name="login_google" value="1"<?=(login_google == 1 ? ' checked':'')?>>
				      <label for="rg-lg1">Enable</label>
					  </div>
					</div>
				</div>
				<br clear="both"/>
				<label>Google client id
						<input type="text" name="login_ggClientId" placeholder="Google client id" value="<?=login_ggClientId?>">
				</label>
				<label>Google client secret
						<input type="text" name="login_ggClientSecret" placeholder="Google client Secret" value="<?=login_ggClientSecret?>">
				</label>
				<label>Redirect Url
						<input type="text" value="<?=path?>/login-google.php" disabled>
				</label>

				<br clear="both"/>
				<h3 class="cp-form-title">Paypal</h3>
				<div class="pl-row">
					<div class="pl-col-3"><b>Paypal Status</b></div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="rg-pp0" type="radio" name="site_paypal_live" value="0"<?=(site_paypal_live == 0 ? ' checked':'')?>>
				      <label for="rg-pp0">Test</label>
					  </div>
					</div>
					<div class="pl-col-3">
						<div class="pl-radio">
						  <input id="rg-pp1" type="radio" name="site_paypal_live" value="1"<?=(site_paypal_live == 1 ? ' checked':'')?>>
				      <label for="rg-pp1">Live</label>
					  </div>
					</div>
				</div>
				<br clear="both"/>
				<label>Paypal business email
						<input type="text" name="site_paypal_id" placeholder="Paypal business email" value="<?=site_paypal_id?>">
				</label>
				<label>Paypal currency
						<input type="text" name="site_paypal_currency" placeholder="Paypal currency" value="<?=site_paypal_currency?>">
				</label>



				<br clear="both"/>
				<h3 class="cp-form-title">Forget password message</h3>
				<textarea name="fotget_password_msg" class="wysibb-editor" id="wysibb-editor"><?=(fotget_password_msg?db_output(fotget_password_msg):'')?></textarea>
				<p>
					Variables: {name} -> For Username | {email} -> User email | {button bg=#HEX}title{/button} -> For button
				</p>
				<div class="p-3">
					<?=(fotget_password_msg?fh_resset_p(fh_bbcode(fotget_password_msg)):'')?>
				</div>

				<br clear="both"/>
				<h3 class="cp-form-title">User email validation message</h3>
				<textarea name="email_verification_msg" class="wysibb-editor"  id="wysibb-editor1"><?=(email_verification_msg?db_output(email_verification_msg):'')?></textarea>
				<p>
					Variables: {name} -> For Username | {email} -> User email | {button bg=#HEX}title{/button} -> For button
				</p>
				<div class="p-3">
					<?=(email_verification_msg?fh_resset_p(fh_bbcode(email_verification_msg)):'')?>
				</div>
				<br clear="both"/>
				<hr>
				<button type="submit" class="pl-buttons bg-0">Submit</button>
				<input type="hidden" name="id" value="<?=$id?>">
		</form>
</div>
