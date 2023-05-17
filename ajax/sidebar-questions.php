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
	$type = (in_array($type, ['day','month', 'year'])) ? $type : 0;
	if($type){
		$timer = ($type == 'year' ? time - 3600*24*365 : ($type == 'month' ? time - 3600*24*30 : time - 3600*24));
		$sql = $db->query("SELECT q.id FROM ".prefix."comments AS c LEFT JOIN ".prefix."questions AS q ON(q.id = c.question) WHERE q.trash = 0 && q.moderat = 0 &&  c.date >= '".( $timer )."' GROUP BY q.id ORDER BY COUNT(c.id) DESC LIMIT 5");
		if($sql->num_rows):
		while($rs = $sql->fetch_assoc()):
			echo fh_sidebarQuestions($rs['id']);
		endwhile;
		else:
		?>
		<div class="pl-not-found"><?=$lang['alerts']['no-data']?></div>
		<?php
		endif;
		$sql->close();
	}
}
