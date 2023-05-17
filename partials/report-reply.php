<div class="modal fade" id="report-modal" tabindex="-1" role="dialog" aria-labelledby="myReportModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form class="pl-form">
				<div class="modal-header">
					<button type="button" class="close pl-buttons" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myReportModal">Reply for report number #<span class="pl-number"></span></h4>
				</div>
				<div class="modal-body">
					<div class="pl-group-inp">
						<label>
							Reply:
							<textarea name="report_more" placeholder="Write your reply here"></textarea>
							<input type="hidden" name="report_id" value="" />
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
