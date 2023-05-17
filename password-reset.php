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

if(db_get('resets', 'date', $token, 'token') < (time-3600*24) || db_get('resets', 'status', $token, 'token') != 0){
	echo fh_alerts('This token is expired!');
	$sidebar = false;
	include __DIR__.'/footer.php';
	exit;
}

# Main Page
if(!us_level):
?>
<div class="pl-main">
    <div class="pl-signup">
				<h4 class="pl-page-head">
						Reset new password
						<i class="fas fa-key"></i>
				</h4>
        <form class="pl-form" id="password-reset">
            <div class="pl-row">
                <div class="pl-col-6">
                    <label>
                        New Password: <b class="red">*</b>
                        <input type="password" name="reg_pass" placeholder="type your password">
                    </label>
										<p><i class="fas fa-question-circle"></i> Password is Must be at least 6 characters.</p>
                </div>
                <div class="pl-col-6">
                    <label>
                        Re-Password: <b class="red">*</b>
                        <input type="password" name="reg_repass" placeholder="type your re-password">
                    </label>
										<p><i class="fas fa-question-circle"></i> Re-password is Must match with the password.</p>
                </div>
            </div>
						<hr/>
						<input type="hidden" name="token" value="<?=$token?>">
						<input type="hidden" name="t" value="<?=$t?>">
						<button type="submit" class="pl-buttons bg-0">Submit <i class="fas fa-arrow-circle-right"></i></button>
        </form>
    </div>
</div><!-- End Main -->
<?php
$sidebar['questions']  = false;
$sidebar['categories'] = false;
$sidebar['people']     = false;
else:
	echo fh_alerts('You have no permission for accessing to this page!');
	$sidebar = false;
endif;
# Footer Page
include __DIR__.'/footer.php';
