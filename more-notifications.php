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

$limit = $page*8;
$limito = $limit+8;

$page = $page+1;

$sql = db_select([
	'table'  => 'notifications AS n',
	'join'   => 'users AS u ON(n.author = u.id)',
	'column' => 'u.id, u.photo, u.username, u.sex, n.status, n.nid, n.ntype, n.date, n.id AS nt',
	'where'  => 'n.user = "'.us_id.'"',
	'order'  => "ORDER BY n.id DESC LIMIT {$limit}, $limito"
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
	?>
	<li class="pl-more"><a href="<?=path?>/more-notifications.php?page=<?=$page?>" class="jscroll-next"><?=$lang['header']['noty']['more']?></a></li>
	<?php
endif;
