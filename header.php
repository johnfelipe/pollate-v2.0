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

# Header Page
include __DIR__.'/head.php';

if(us_level && !us_password):
?>
<div class="bg-6 pl-header-info">
	<div class="pl-container"><i class="icons icon-info"></i> <span><?=$lang['header']['notice']?></span></div>
</div>
<?php endif; ?>

<div class="pl-header">
	<div class="pl-container">
		<div class="pl-topbar">
			<div class="pl-logo">
				<a href="<?=path?>"><img src="<?=path?>/images/logo.png" alt="<?=site_title?>"></a>
			</div><!-- End Logo -->

			<div class="pl-details">
				<ul class="pl-details-list">
					<li class="pl-serach">
						<div class="pl-group-inp">
							<i class="fas fa-search"></i>
							<input type="text" class="search" placeholder="<?=$lang['header']['search']?>">
						</div>
						<div class="pl-search-result"></div>
					</li><!-- End Search -->

					<?php if(us_level): ?>
						<li class="pl-ask">
							<a href="<?=path?>/ask.php" class="pl-buttons bg-3"><span><i class="fas fa-plus"></i> <strong><?=$lang['header']['ask']?></strong></span></a>
						</li>
						<li>
							<div class="pl-user-details">
								<img src="<?=us_photo?>" alt="<?=us_username?>" onerror="this.src='<?=fh_thumbERROR('user', us_sex)?>'">
								<span class="show-user-details"><strong><?=fh_textCut(us_username, 15)?></strong> <i class="fas fa-caret-down"></i></span>
								<ul class="dropdown">
									<li>
										<a href="<?=path?>/profile.php?id=<?=fh_seoURL(us_id, 'profile', us_username)?>">
											<i class="icon-user icons"></i> <?=$lang['header']['profile']?>
											<?php if(us_plan): ?>
											<span class="badge bg-p<?=us_plan?>">Plan#<?=us_plan?></span>
											<?php endif; ?>
										</a>
									</li>
									<li>
										<a href="<?=path?>/more-questions.php?id=<?=fh_seoURL(us_id, 'more-questions', us_username)?>"><i class="icon-question icons"></i> <?=$lang['header']['questions']?></a>
									</li>

									<?php if(us_level == 6): ?>
									<li>
										<a href="<?=path?>/cpanel.php" target="_blank"><i class="icon-settings icons"></i> <?=$lang['header']['cp']?></a>
									</li>
									<?php endif; ?>

									<li>
										<a href="#" data-toggle="modal" data-target="#password-modal"><i class="icon-key icons"></i> <?=$lang['header']['password']?></a>
									</li>
									<li>
										<a href="<?=path?>/details.php"><i class="icon-note icons"></i> <?=$lang['header']['details']?></a>
									</li>
									<li>
										<a href="<?=path?>/credits.php"><i class="icon-wallet icons"></i> (<?=us_credits?>) <?=$lang['header']['credits']?></a>
									</li>
									<li>
										<a href="#" class="logout"><i class="icon-logout icons"></i> <?=$lang['header']['logout']?></a>
									</li>
								</ul>
							</div>
						</li><!-- End User Details -->

						<li class="pl-notifications">
							<span class="pl-notifications-show">
								<i class="icon-bell icons"></i>
								<small><?=db_count("notifications WHERE user = '".us_id."' && status = 0")?></small>
							</span>
							<ul class="dropdown">
								<li class="pl-title"><?=$lang['header']['noty']['title']?> <span class="pl-read-all-noty"><?=$lang['header']['noty']['read']?></span></li>
								<div class="jscroll">
									<?php
									$sql = db_select([
										'table'  => 'notifications AS n',
										'join'   => 'users AS u ON(n.author = u.id)',
										'column' => 'u.id, u.photo, u.username, u.sex, n.status, n.nid, n.ntype, n.date, n.id AS nt',
										'where'  => 'n.user = "'.us_id.'"',
										'order'  => 'ORDER BY n.id DESC LIMIT 8'
									]);
									if($sql->num_rows):
										while($rs = $sql->fetch_assoc()):
										?>
										<li data-notid="<?=$rs['nt']?>" data-noturl="<?=fh_notificationUrlGET(($rs['ntype']=='follow'?$rs['id']:$rs['nid']), $rs['ntype'])?>"<?=(!$rs['status']?' class="bg-unread"':'')?>>
											<div class="media">
												<div class="media-left">
													<div class="pl-thumb">
														<img src="<?=$rs['photo']?>" alt="<?=$rs['username']?>" onerror="this.src='<?=fh_thumbERROR('user', $rs['sex'])?>'">
													</div>
												</div>
												<div class="media-body">
													<?=fh_user($rs['id'])?> <?=fh_notificationGET($rs['nid'], $rs['ntype'])?>
													<p><i class="icon-clock icons"></i> <?=fh_ago($rs['date'])?></p>
												</div>
											</div>
										</li>
										<?php
										endwhile;
										if(db_count("notifications WHERE user = '".us_id."'") > 6):
										?>
										<li class="pl-more"><a href="<?=path?>/more-notifications.php?page=1" class="jscroll-next"><?=$lang['header']['noty']['more']?></a></li>
										<?php
										endif;
									else:
										?>
										<li class="pl-not-found"><?=$lang['alerts']['no-data']?></li>
										<?php
									endif;
									$sql->close();
									?>
								</div>
							</ul>
						</li><!-- End Notifications -->
					<?php else: ?>
						<li class="pl-sign-in">
							<a href="#" class="pl-buttons bg-1" data-toggle="modal" data-target="#sign-modal"><span><i class="fas fa-key"></i> <?=$lang['header']['in']?></span></a>
						</li>
						<li class="pl-sign-up">
							<a href="<?=path?>/sign-up.php" class="pl-buttons bg-3"><span><i class="fas fa-user"></i> <?=$lang['header']['up']?></span></a>
						</li>
					<?php endif; ?>
					<?php if (site_plan): ?>
					<li class="pl-notifications">
						<span class="pl-plans-show">
							<a href="<?=path?>/plans.php"><i class="icon-paypal icons"></i></a>
						</span>
					</li>
				<?php endif; ?>
				</ul>
			</div><!-- End Details -->
		</div><!-- End Topbar -->

		<div class="pl-navbar">
			<span class="pl-mobile-menu"><i class="icons icon-menu"></i></span>
			<ul class="pl-menu">
				<li<?=(page=='index'&&!$type?' class="selected"':'')?>>
					<a href="<?=path?>/index.php"><i class="icon-home icons"></i> <?=$lang['header']['menu']['home']?></a>
				</li>
				<li<?=(page=='index'&&$type=='fresh'?' class="selected"':'')?>>
					<a href="<?=path?>/index.php?type=fresh"><i class="icon-clock icons"></i> <?=$lang['header']['menu']['fresh']?></a>
				</li>
				<li<?=(page=='index'&&$type=='popular'?' class="selected"':'')?>>
					<a href="<?=path?>/index.php?type=popular"><i class="icon-trophy icons"></i> <?=$lang['header']['menu']['popular']?></a>
				</li>
				<li<?=(page=='members'?' class="selected"':'')?>>
					<a href="<?=path?>/members.php"><i class="icon-people icons"></i> <?=$lang['header']['menu']['members']?></a>
				</li>

				<li<?=(page=='index'&&$type=='categories'?' class="selected"':'')?>>
					<a href="#" class="cats-links"><i class="icon-organization icons"></i> <?=$lang['header']['menu']['categories']?></a>
					<ul class="dropdown">
					<?php
					$sql = db_select([
						'table'  => 'categories',
						'column' => 'id, bg, icon, title',
						'where'  => 'trash = 0',
						'order'  => 'ORDER BY sort DESC'
					]);
					if($sql->num_rows):
						while($rs = $sql->fetch_assoc()):
						?>
						<li>
							<a href="<?=path?>/index.php?type=categories&amp;id=<?=fh_seoURL($rs['id'], 'categories', $rs['title'])?>">
								<span style="background: #<?=$rs['bg']?>"><i class="<?=$rs['icon']?>"></i></span>
								<?=$rs['title']?>
							</a>
						</li>
						<?php
						endwhile;
					else:
						?>
						<li class="pl-not-found"><?=$lang['alerts']['no-data']?></li>
						<?php
					endif;
					$sql->close();
					?>
					</ul>
				</li><!-- End Categories -->
				<li<?=(page=='index'&&$type=='followed'?' class="selected"':'')?>>
					<a href="<?=path?>/index.php?type=followed"><i class="icon-star icons"></i> <?=$lang['header']['menu']['followed']?></a>
				</li>
			</ul>
			<?php if(db_rows("lang WHERE trash = 0")): ?>
			<div class="pl-lang">
				<span class="pt-show-lang"><span class="flag-icon flag-icon-<?=$rs_ln['shortname']?>"></span></span>
				<ul class="dropdown">
				<?php
				$sql = $db->query("SELECT * FROM ".prefix."lang WHERE trash = 0 && id != '{$rs_ln['id']}'");
				if($sql->num_rows):
					while($rs = $sql->fetch_assoc()):
				?>
				<li>
				<a href="#" rel="<?=$rs['id']?>" title="<?=$rs['fullname']?>">
					<span class="flag-icon flag-icon-<?=$rs['shortname']?>"></span>
				</a>
				</li>
				<?php
					endwhile;
				endif;
				$sql->close();
				?>
				</ul>
			</div>
			<?php endif; ?>
		</div><!-- End Topbar -->
	</div><!-- End Container -->
</div><!-- End Header -->

<div class="pl-page">
	<div class="pl-container">
