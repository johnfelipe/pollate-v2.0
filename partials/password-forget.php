<div class="modal fade" id="forget-modal" tabindex="-1" role="dialog" aria-labelledby="myForgetModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<button type="button" class="close pl-buttons" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myForgetModal"><?=$lang['forget']['title']?></h4>
				</div>
				<div class="modal-body">
					<div class="media">
						<div class="media-body">
							<div class="pl-group-inp">
								<label>
									<i class="icon-user icons"></i>
									<input type="text" name="reset_email" placeholder="<?=$lang['forget']['email']?>">
								</label>
							</div>
						</div>
						<div class="media-right">
							<button type="submit" class="pl-buttons bg-0"><i class="icon-key icons"></i> <?=$lang['forget']['button']?></button>
						</div>
					</div>
					<hr class="d-none"/>
				</div>
			</form>
		</div>
	</div>
</div>
