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

if(!db_rows("pages WHERE id = '{$id}'")){
	echo fh_alerts($lang['alerts']['wrong']);
	$sidebar = false;
	include __DIR__.'/footer.php';
	exit;
}

if(fh_seoURLCheck(db_get("pages", "title", $id)) != $title){
	echo fh_alerts($lang['alerts']['wrong']);
	$sidebar = false;
	include __DIR__.'/footer.php';
	exit;
}

# Main Page
?>
<div class="pl-main">
    <?php
    $page_rs = db_rs(db_select([
        'table'  => 'pages',
        'where'  => 'id = "'.$id.'" && trash = 0'
    ]));
    if($page_rs):
    ?>
		<h3 class="pl-title"><?=db_output($page_rs['title'])?></h3>
		<div class="pl-content pl-bbcodes">
			<?=db_output($page_rs['content'], false, true)?>
		</div>
    <?php
    else:
    ?>
    <div class="pl-not-found"><?=$lang['alerts']['no-data']?></div>
    <?php endif; ?>
</div><!-- End Main -->

<?php
$sidebar = [
	'access'     => true,
	'ads'        => true,
	'questions'  => false,
	'categories' => false,
	'social'     => true,
	'people'     => true
];

# Footer Page
include __DIR__.'/footer.php';
