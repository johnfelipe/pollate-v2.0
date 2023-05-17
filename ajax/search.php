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

if($_SERVER['REQUEST_METHOD'] === 'GET'){

	$q = sc_sec($_GET['query']);
	$sql = db_select([
		"table" => "questions",
		"where" => "question like '%$q%' && trash = 0",
		"order" => "ORDER BY id DESC LIMIT 5"
	]);
	if($sql->num_rows):
		?><ul><?php
		while($rs = $sql->fetch_assoc()):
			?>
			<li>
				<a href="<?=path?>/questions.php?id=<?=fh_seoURL($rs['id'], 'questions', $rs['question'])?>"><?=$rs['question']?></a>
				<div class="pl-search-details">
					<i class="icon-user icons"></i> <?=fh_user($rs['author'])?>
					<i class="icon-clock icons"></i> <?=fh_ago($rs['date'])?>
				</div>
			</li>
			<?php
		endwhile;
		?></ul><?php
	else:
		?>
		<ul><li class="pl-not-found"><?=$lang['alerts']['no-data']?></li></ul>
		<?php
	endif;

}
