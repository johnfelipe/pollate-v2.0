<?php
$breadcrumb = '';
$where      = '';
switch($request){
	case 'banned':
		$breadcrumb = ' / Banned users';
		$where      = '&& moderat = 1';
	break;
	case 'moderators':
		$breadcrumb = ' / Moderators';
		$where      = '&& level = 6';
	break;
	case 'verified':
		$breadcrumb = ' / Verified accounts';
		$where      = '&& verified = 1';
	break;
	case 'suspended':
		$breadcrumb = ' / Suspended users';
		$where      = '&& moderat = 2';
	break;
}
?>

<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-people icons"></i> Members</h3>
			<p><a href="#">Cpanel</a> / Members<?=$breadcrumb?></p>
		</div>
			<div class="pl-col-6 text-right">
				<a href="#" class="pl-buttons bg-9 pl-members-reject" data-multi="true"><i class="fas fa-times"></i> Reject</a>
				<a href="#" class="pl-buttons bg-2 pl-members-approve" data-multi="true"><i class="fas fa-check"></i> Approve</a>
				<a href="#" class="pl-buttons bg-0 pl-members-trash" data-multi="true"><i class="fas fa-trash"></i> Trash</a>
			</div>
	</div>
</div>

<table class="table">
	  <thead class="thead-default">
		    <tr>
			      <th><input type="checkbox" name="check_all" value="1"></th>
			      <th class="text-left">User Name</th>
			      <th>Request</th>
			      <th>Gender</th>
			      <th>Created</th>
			      <th>Birth date</th>
			      <th>&nbsp;</th>
		    </tr>
	  </thead>
	  <tbody>
				<?php
				$sql = db_select([
						"table" => "users",
						"where" => "trash = 0 {$where}",
						'order' => 'ORDER BY id DESC LIMIT '.$startpoint.' , '.$limit
				]);
				while($rs = $sql->fetch_assoc()):
				?>
		    <tr id="pt-obj-<?=$rs['id']?>"<?=($rs['moderat']==1?' class="bg-banned"':'')?>>
			      <th scope="row"><input type="checkbox" name="pl-check[]" value="<?=$rs['id']?>"></th>
			      <td width="60%" class="text-left">
								<div class="media">
										<div class="media-left">
											<div class="pl-thumb"><img src="<?=$rs['photo']?>" alt="<?=$rs['username']?>" onerror="this.src='<?=fh_thumbERROR('user', $rs['sex'])?>'"></div>
											<?php if($rs['verified']==1): ?>
											<i class="icon-check icons pl-verified" title="Verified acount"></i>
											<?php endif; ?>
										</div>
										<div class="media-body">
												<h3 class="pl-title"><?=fh_user($rs['id'])?></h3>
												<small>
														<span class="flag-icon flag-icon-<?=(db_unserialize([$rs['address'], 0])?strtolower(db_unserialize([$rs['address'], 0])):'non')?>" title="<?=(db_unserialize([$rs['address'], 0])?$countries[db_unserialize([$rs['address'], 0])]:'No Country')?>"></span>
														<?=(db_unserialize([$rs['address'], 1])?db_unserialize([$rs['address'], 1]):'--')?>
														<?=(db_unserialize([$rs['address'], 2])?' - '.db_unserialize([$rs['address'], 2]):'--')?>
												</small>

												<span tabindex="0" class="pl-chart" data-content="<?=fh_cp_members_statistics($rs['statistics'])?>"><i class="icon-chart icons"></i></span>
										</div>
								</div>
						</td>
			      <td width="5%" class="text-center">
								<?php
								switch($rs['social_name']){
										case 'facebook': echo '<span class="clr-fb">Facebook</span>'; break;
										case 'twitter': echo '<span class="clr-tw">Twitter</span>'; break;
										case 'google': echo '<span class="clr-gp">Google+</span>'; break;
										default: echo 'Regular';
								}
								?>
						</td>
			      <td width="5%" class="text-center"><?=fh_sex($rs['sex'])?></td>
			      <td width="15%" class="text-center"><?=fh_ago($rs['date'])?></td>
			      <td width="15%" class="text-center"><?=fh_birth($rs['birth'])?></td>
			      <td width="15%" class="text-left">
								<a href="" class="pl-options"><i class="icon-options icons"></i></a>
								<ul class="dropdown">
										<?php if($rs['trash']==0): ?>
										<li>
											<a href="javascript: void(0)" rel="<?=$rs['id']?>" class="pl-members-trash">
												<i class="fas fa-trash"></i> Move to trash</a>
											</a>
										</li>
										<?php endif; ?>
                  	<li><a href="<?=path?>/details.php?id=<?=$rs['id']?>"><i class="fas fa-pencil-alt"></i> Edit Details</a></li>
										<li>
											<?php if($rs['moderat']==1): ?>
											<a href="javascript: void(0)" rel="<?=$rs['id']?>" class="pl-member-unban">
												<i class="fas fa-check-circle"></i> Unban user
											</a>
											<?php else: ?>
											<a href="javascript: void(0)" rel="<?=$rs['id']?>" class="pl-member-ban">
												<i class="fas fa-ban"></i> Ban user
											</a>
											<?php endif; ?>
										</li>
                  	<li><a href="#"><i class="fas fa-envelope"></i> Send email</a></li>
                  	<li>
											<?php if($rs['verified']==1): ?>
											<a href="javascript: void(0)" rel="<?=$rs['id']?>" class="pl-member-unverified">
												<i class="fas fa-times"></i> Unverified account
											</a>
											<?php else: ?>
											<a href="javascript: void(0)" rel="<?=$rs['id']?>" class="pl-member-verified">
												<i class="fas fa-check"></i> Verified account
											</a>
											<?php endif; ?>
										</li>
                  	<li>
											<?php if($rs['level']==1): ?>
											<a href="javascript: void(0)" rel="<?=$rs['id']?>" class="pl-member-admin">
												<i class="icons icon-badge"></i> as admin
											</a>
											<?php else: ?>
											<a href="javascript: void(0)" rel="<?=$rs['id']?>" class="pl-member-user">
												<i class="icons icon-anchor"></i> as user
											</a>
											<?php endif; ?>
										</li>
                </ul>
			      </td>
		    </tr>
				<?php endwhile;?>
	  </tbody>
</table>

<?php
$sql->close();
echo pl_pagination("users WHERE trash = 0 {$where}", $limit, "?type={$type}&");
?>
