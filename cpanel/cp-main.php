<!DOCTYPE html>
<html lang="">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
		<title>Cpanel - Pollate</title>

    <!-- Google Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,900%7CGentium+Basic:400italic&subset=latin,latin">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,700">

		<!-- Font Awseome -->
		<link rel="stylesheet" href="<?=path?>/css/assets/all.min.css" />
		<link rel="stylesheet" href="<?=path?>/css/assets/simple-line-icons.css">

    <!-- JQuery Libraries -->
		<link rel="stylesheet" href="<?=path?>/css/assets/bootstrap-tagsinput.css">

		<?php if($type == 'newcategory'): ?>
		<link rel="stylesheet" href="<?=path?>/css/spectrum.css" />
			<link rel="stylesheet" href="<?=path?>/css/fontawesome-iconpicker.min.css" />
		<link rel="stylesheet" href="">
		<?php endif; ?>

		<link rel="stylesheet" href="<?=path?>/css/jquery-jvectormap-2.0.1.css">

    <!-- Stylesheets -->
		<link rel="stylesheet" href="<?=path?>/css/assets/animate.css" />
    <link rel="stylesheet" href="<?=path?>/css/flag-icon.min.css">
		<!-- Bootstrap v4.4.1 -->
		<link rel="stylesheet" href="<?=path?>/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?=path?>/css/style.css">
    <link rel="stylesheet" href="<?=path?>/css/cpanel.css">

</head>
<body<?=(page?' class="pl-cpanel-'.($type?$type:'dashboard').'"':'')?>>

<div class="pl-cpanel-wrapper">
		<div class="pl-cpanel-sidebar">
			<div class="pl-cpanel-logo">
				<img src="<?=path?>/images/pollate-transparent-red.png" alt="<?=site_title?>">
				<p>Pollate Dashboard</p>
			</div>
				<ul class="pl-cpanel-navigation">
						<li<?=(!$type?' class="pl-selected"':'')?>><a href="<?=path?>/cpanel.php"><i class="icon-grid icons"></i> Dashboard</a></li>
						<li<?=($type=='plans'?' class="pl-selected"':'')?>><a href="<?=path?>/cpanel.php?type=plans"><i class="icon-paypal icons"></i> Plans</a></li>
						<li<?=($type=='payments'?' class="pl-selected"':'')?>><a href="<?=path?>/cpanel.php?type=payments"><i class="icon-wallet icons"></i> Payments</a></li>
						<li<?=($type=='credits'?' class="pl-selected"':'')?>><a href="<?=path?>/cpanel.php?type=credits"><i class="icon-magnet icons"></i> Credits<?php if(db_count("payout WHERE status = 0")): ?><small><?=db_count("payout WHERE status = 0")?></small><?php endif; ?></a></li>
						<li<?=($type=='pages'||$type=='newpage'?' class="pl-selected"':'')?>><a href="<?=path?>/cpanel.php?type=pages"><i class="icon-docs icons"></i> Static Pages</a></li>
						<li<?=($type=='members'?' class="pl-selected"':'')?>>
								<a href="<?=path?>/cpanel.php?type=members"><i class="icon-people icons"></i> Members</a>
								<i class="icon-arrow-down icons pl-side-drop"></i>
								<ul class="dropdown">
										<li><a href="<?=path?>/cpanel.php?type=members&amp;request=banned"><i class="icon-ban icons"></i> Banned users <b class="pl-count"><?=db_count("users WHERE moderat = 1")?></b></a></li>
										<li><a href="<?=path?>/cpanel.php?type=members&amp;request=suspended"><i class="icon-close icons"></i> Suspended users <b class="pl-count">0</b></a></li>
										<li><a href="<?=path?>/cpanel.php?type=members&amp;request=moderators"><i class="icon-ghost icons"></i> Moderators <b class="pl-count"><?=db_count("users WHERE level = 6")?></b></a></li>
										<li><a href="<?=path?>/cpanel.php?type=members&amp;request=verified"><i class="icon-check icons"></i> Verified accounts <b class="pl-count"><?=db_count("users WHERE verified = 1")?></b></a></li>
								</ul>
						</li>
						<li<?=($type=='questions'?' class="pl-selected"':'')?>><a href="<?=path?>/cpanel.php?type=questions"><i class="icon-question icons"></i> Questions</a></li>
						<li<?=($type=='categories'?' class="pl-selected"':'')?>><a href="<?=path?>/cpanel.php?type=categories"><i class="icon-organization icons"></i> Categories</a></li>
						<li<?=($type=='comments'?' class="pl-selected"':'')?>><a href="<?=path?>/cpanel.php?type=comments"><i class="icon-bubbles icons"></i> Comments</a></li>
						<li<?=($type=='reports'?' class="pl-selected"':'')?>><a href="<?=path?>/cpanel.php?type=reports"><i class="icon-ban icons"></i> Reports<?php if(db_count("reports WHERE status = 0")): ?><small><?=db_count("reports WHERE status = 0")?></small><?php endif; ?></a></li>
						<li<?=($type=='subscribers'?' class="pl-selected"':'')?>><a href="<?=path?>/cpanel.php?type=subscribers"><i class="icon-support icons"></i> Subscribers</a></li>
						<li<?=($type=='languages'?' class="pl-selected"':'')?>><a href="<?=path?>/cpanel.php?type=languages"><i class="icon-globe-alt icons"></i> Languages</a></li>
						<li<?=($type=='setting'?' class="pl-selected"':'')?>><a href="<?=path?>/cpanel.php?type=setting"><i class="icon-settings icons"></i> Settings</a></li>
				</ul>
		</div>
		<div class="pl-cpanel-navbar">
				<div class="pl-row">
						<div class="pl-col-9">
							<div class="pl-group-inp">
								<label>
									<i class="fas fa-search"></i>
									<input type="text" class="search" placeholder="do you want to search for something?">
								</label>
							</div>
							<div class="pl-search-result"></div>
						</div>
						<div class="pl-col-3 text-right">
						</div>

				</div>
		</div>
		<div class="pl-cpanel-main">
		<?php
		switch($type){
			case 'credits'     : include __DIR__.'/credits.php'; break;
			case 'plans'       : include __DIR__.'/plans.php'; break;
			case 'categories'  : include __DIR__.'/categories.php'; break;
			case 'payments'    : include __DIR__.'/payments.php'; break;
			case 'comments'    : include __DIR__.'/comments.php'; break;
			case 'dashboard'   : include __DIR__.'/dashboard.php'; break;
			case 'editprofile' : include __DIR__.'/editprofile.php'; break;
			case 'members'     : include __DIR__.'/members.php'; break;
			case 'messages'    : include __DIR__.'/messages.php'; break;
			case 'newcategory' : include __DIR__.'/newcategory.php'; break;
			case 'newpage'     : include __DIR__.'/newpage.php'; break;
			case 'pages'       : include __DIR__.'/pages.php'; break;
			case 'questions'   : include __DIR__.'/questions.php'; break;
			case 'reports'     : include __DIR__.'/reports.php'; break;
			case 'setting'     : include __DIR__.'/setting.php'; break;
			case 'subscribers' : include __DIR__.'/subscribers.php'; break;
			case 'statistics'  : include __DIR__.'/statistics.php'; break;
			case 'languages'   : include __DIR__.'/languages.php'; break;
			case 'newlang'     : include __DIR__.'/newlang.php'; break;
			default            : include __DIR__.'/dashboard.php';
		}
		?>
		</div>
</div>

<!-- jQuery Libraries -->
<script src="<?=path?>/js/jquery-3.4.1.min.js"></script>
<script src="<?=path?>/js/popper.min.js"></script>
<script src="<?=path?>/js/bootstrap.min.js"></script>
<script src="<?=path?>/js/assets/owl.carousel.min.js"></script>
<script src="<?=path?>/js/assets/jquery.livequery.js"></script>
<script src="<?=path?>/js/assets/bootstrap-tagsinput.js"></script>
<script src="<?=path?>/js/assets/jquery.noty.packaged.js"></script>
<script src="<?=path?>/js/search.js"></script>

<?php if($type == 'newcategory'): ?>
<script src="<?=path?>/js/fontawesome-iconpicker.min.js"></script>
<script src="<?=path?>/js/spectrum.js"></script>
<?php endif; ?>


<link rel="stylesheet" href="<?=path?>/js/minified/themes/default.min.css" />
<script src="<?=path?>/js/minified/sceditor.min.js"></script>
<script src="<?=path?>/js/minified/formats/bbcode.js"></script>
<script src="<?=path?>/js/minified/icons/material.js"></script>

<script src="<?=path?>/js/jquery.tablednd.js"></script>
<script src="<?=path?>/js/Chart.min.js"></script>
<script src="<?=path?>/js/html2pdf.bundle.min.js"></script>


<script src="<?=path?>/js/jquery-jvectormap-2.0.1.min.js"></script>
<script src="<?=path?>/js/jquery-jvectormap-world-mill-en.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
		$("#customPersistTable").tableDnD({
        onDragClass: "myDragClass",
        onDrop: function(table, row) {
					var rows = table.tBodies[0].rows;
					var arr = [];

            for (var i=0; i<rows.length; i++) {
							arr.push(rows[i].id.replace("pt-obj-",""));
            }

						$.post(path+"/ajax.php?request=sort-page", {sort: arr}, function(puerto){
						});
        }
    });

		$('.pt-title').on("click", function(){
			var th = $(this);
			if(th.hasClass('active')){
				th.removeClass("active");
				th.next(".pt-box").removeClass("open");
				th.find('span').html('<i class="fas fa-plus-circle"></i>');
			} else {
				th.addClass("active");
				th.next(".pt-box").addClass("open");
				th.find('span').html('<i class="fas fa-minus-circle"></i>');
			}
			return false;

		});
	});
</script>
<script>
	var path    = '<?=path?>';
	var actions = '<?=(us_level ? 1 : 0)?>';
	var lang    = <?=json_encode($lang)?>;
</script>


<script src="<?=path?>/js/custom.js"></script>
<script src="<?=path?>/js/cpanel.js"></script>


</body>
</html>
