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

if(!fh_planAccess('ask')){
	echo '<div class="pl-main pl-box p-2">'. fh_alerts($lang['alerts']['plan']).'</div>';
	include __DIR__.'/footer.php';
	exit;
}

# Main Page
if(us_level):
	$db_rs = '';
	if($id){
		if(us_level == 6 || db_get('questions', 'author', $id) == us_id){
			$db_rs = db_rs(db_select([
				'table' => 'questions',
				'where' => "id = '{$id}' && trash = 0 && moderat = 0"
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
						<?=($db_rs?$lang['ask']['edit_title']:$lang['ask']['ask_title'])?>
						<i class="icon-plus icons"></i>
				</h4>
				<div class="pl-social-login">
						<input id="images" name="images[]" type="file" multiple>
				</div>
        <form class="pl-form" id="send-question">
            <label>
                <?=$lang['ask']['question']['label']?> <b class="red">*</b>
                <input type="text" name="qs_question" value="<?=($db_rs?$db_rs['question']:'')?>" placeholder="<?=$lang['ask']['question']['place']?>">
            </label>
						<p>
								<i class="fas fa-question-circle"></i> <?=$lang['ask']['question']['p']?>
						</p>

						<div class="pl-row">
							<div class="pl-col-6">
								<div class="mb-3">
									<input class="tgl tgl-flat" id="cb3" type="checkbox" name="qs_multiple"<?=($db_rs?($db_rs['multiple']==1?'checked':''):'')?>/>
							    <label class="tgl-btn float-left mr-3" for="cb3"></label>
									<label><?=$lang['ask']['multiple']?></label>
								</div>
							</div>
							<?php if(us_level == 6): ?>
							<div class="pl-col-6">
								<div class="mb-3">
									<input class="tgl tgl-flat" id="cb4" type="checkbox" name="qs_pinned"<?=($db_rs?($db_rs['pinned']==1?'checked':''):'')?>/>
							    <label class="tgl-btn float-left mr-3" for="cb4"></label>
									<label><?=$lang['ask']['pinned']?></label>
								</div>
							</div>
							<?php endif; ?>
						</div>



            <label>
                <?=$lang['ask']['type']['label']?> <b class="red">*</b>
            </label>
						<div class="pl-row pl-question-type">
							<div class="pl-col-4">
								<div class="pl-radio">
									<input id="qs_type_1" <?=($db_rs?($db_rs['polltype']==1?'checked':'disabled'):'')?> type="radio" name="qs_type" value="1">
									<label for="qs_type_1"><?=$lang['ask']['type']['normal']['label']?></label>
								</div>
							</div>
							<div class="pl-col-4">
								<div class="pl-radio">
									<input id="qs_type_2" <?=($db_rs?($db_rs['polltype']==2?'checked':'disabled'):'')?> type="radio" name="qs_type" value="2">
									<label for="qs_type_2"><?=$lang['ask']['type']['yesno']['label']?></label>
								</div>
							</div>
							<div class="pl-col-4">
								<div class="pl-radio">
									<input id="qs_type_3" <?=($db_rs?($db_rs['polltype']==3?'checked':'disabled'):'')?> type="radio" name="qs_type" value="3">
									<label for="qs_type_3"><?=$lang['ask']['type']['images']['label']?></label>
								</div>
							</div>
						</div>
						<?php if($db_rs): ?>
						<p></p>
						<?php if($db_rs['polltype'] == 1): ?>
						<label class="pl-answer-label"><?=$lang['ask']['type']['answers']?> <small class="pl-add-answer">(<?=$lang['ask']['type']['add']?>)</small> <b class="red">*</b>
							<?php $sql = db_select([
								'table' => 'answers',
								'where' => 'question = '.$id
							]); ?>
							<?php while($rs=$sql->fetch_assoc()): ?>
							<input type="text" name="qs_answers[]" value="<?=$rs['answer']?>" placeholder="<?=$lang['ask']['type']['place']?>">
							<input type="hidden" name="qs_answers_id[]" value="<?=$rs['id']?>">
							<?php endwhile; ?>
							<?php $sql->close();?>
						</label>
						<?php elseif($db_rs['polltype'] == 3): ?>
							<div class="pl-row">
								<div class="pl-col-8">
									<label class="pl-answer-label">
										<?=$lang['ask']['type']['answers']?> <small class="pl-add-answer-image">(<?=$lang['ask']['type']['add']?>)</small> <b class="red">*</b>
									</label>
								</div>
								<div class="pl-col-4">
									<label class="pl-answer-label"><?=$lang['ask']['type']['images']['place']?> <b class="red">*</b></label>
								</div>
							</div>
							<?php $sql = db_select([
								'table' => 'answers',
								'where' => 'question = '.$id
							]); ?>
							<?php while($rs=$sql->fetch_assoc()): ?>
							<div class="pl-answer-inp">
								<div class="pl-row">
									<div class="pl-col-8">
										<label class="pl-answer-label">
											<input type="text" name="qs_answers[]" value="<?=$rs['answer']?>" placeholder="<?=$lang['ask']['type']['place']?>">
											<input type="hidden" name="qs_answers_id[]" value="<?=$rs['id']?>">
										</label>
									</div>
									<div class="pl-col-4">
										<label class="pl-answer-label">
											<div class="pl-select">
												<select name="qs_answers_images[]" class="pl-select-append">
													<option value=""><?=$lang['ask']['type']['images']['select']?></option>
													<option value="<?=$rs['thumbnail']?>" selected><?=$rs['thumbnail']?></option>
												</select>
											</div>
										</label>
									</div>
								</div>
							</div>
							<?php endwhile; ?>
							<?php $sql->close();?>
						<?php endif; ?>
						<?php endif; ?>
						<div id="poll-type-append"></div>
						<p></p>
            <div class="pl-row">
                <div class="pl-col-6">
                    <label>
                        <?=$lang['ask']['category']['label']?> <b class="red">*</b>
												<div class="pl-select">
														<select name="qs_category">
																<option value=""><?=$lang['ask']['category']['place']?></option>
																<?php $sql = $db->query("SELECT * FROM ".prefix."categories ORDER BY sort DESC"); ?>
																<?php while($rs=$sql->fetch_assoc()): ?>
																<option value="<?=$rs["id"]?>" <?=($db_rs?($db_rs['category']==$rs['id']?'selected':''):'')?>><?=$rs["title"]?></option>
																<?php endwhile; ?>
																<?php $sql->close();?>
														</select>
												</div>
                    </label>
										<p></p>
                </div>
                <div class="pl-col-6">
                    <label>
                        <?=$lang['ask']['end']['label']?>
												<input type="text" name="qs_end" value="<?=($db_rs?($db_rs['end_date']?date('m/d/Y H:i', $db_rs['end_date']):''):'')?>" data-timepicker="true" data-language="en" data-time-format="hh:ii aa" id="datepicker" class="datepicker-here" placeholder="<?=$lang['ask']['end']['place']?>">
                    </label>
                </div>
            </div>
						<label>
                <?=$lang['ask']['thumb']['label']?>
								<div class="pl-select">
										<select name="qs_thumb" class="disabled pl-select-append" disabled>
											<option value=""><?=$lang['ask']['thumb']['place']?></option>
										</select>
								</div>
            </label>
						<p>
								<i class="fas fa-question-circle"></i> <?=$lang['ask']['thumb']['p']?>
						</p>
            <hr/>
						<input type="hidden" name="id" value="<?=$id?>" />
						<button type="submit" class="pl-buttons bg-0"><?=$lang['ask']['button']?> <i class="fas fa-arrow-circle-right"></i></button>
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
