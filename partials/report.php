<div class="modal fade" id="report-modal" tabindex="-1" role="dialog" aria-labelledby="myReportModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form class="pl-form">
				<div class="modal-header">
					<button type="button" class="close pl-buttons" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myReportModal"><?=$lang['report']['title']?></h4>
				</div>
				<div class="modal-body">
					<div class="pl-group-inp">
						<label>
							<?=$lang['report']['select']['label']?> <b class="red">*</b>
							<div class="pl-select">
								<select name="report_title">
									<?php foreach($lang['report']['select']['values'] AS $key => $val): ?>
									<option value="<?=$key?>"><?=$val?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</label>
					</div>
					<div class="pl-group-inp">
						<label>
							<?=$lang['report']['textarea']['label']?>
							<textarea name="report_more" placeholder="<?=$lang['report']['textarea']['place']?>"></textarea>
							<input type="hidden" name="report_id" value="" />
							<input type="hidden" name="report_type" value="question" />
						</label>
					</div>
					<hr class="d-none"/>
				</div>
				<div class="modal-footer">
					<button type="submit" class="pl-buttons bg-0"><?=$lang['report']['button']?></button>
					<button class="pl-buttons bg-9" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><?=$lang['close']?></button>
				</div>
			</form>
		</div>
	</div>
</div>
