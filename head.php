<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/Product" lang="<?=$lang['lang']?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<title><?=fh_site_title()?></title>
	<meta name="description" content="<?=site_description?>" />
	<meta name="keywords" content="<?=site_keywords?>" />
	<meta name="author" content="<?=(page=='questions'?fh_user(db_get('questions', 'author', $id), false):site_author)?>" />

	<!-- Schema.org markup for Google+ -->
	<meta itemprop="name" content="<?=fh_site_title()?>">
	<meta itemprop="description" content="<?=site_description?>">
	<meta itemprop="image" content="<?=fh_site_thumb()?>">

	<!-- Twitter Card data -->
	<meta name="twitter:card" content="product">
	<meta name="twitter:site" content="<?=(page=='questions'?fh_user(db_get('questions', 'author', $id), false):site_author)?>">
	<meta name="twitter:title" content="<?=fh_site_title()?>">
	<meta name="twitter:description" content="<?=site_description?>">
	<meta name="twitter:creator" content="<?=(page=='questions'?fh_user(db_get('questions', 'author', $id), false):site_author)?>">
	<meta name="twitter:image" content="<?=fh_site_thumb()?>">

	<!-- Open Graph data -->
	<meta property="og:title" content="<?=fh_site_title()?>" />
	<meta property="og:type" content="polls" />
	<meta property="og:url" content="<?=sc_sec((isset($_SERVER['HTTPS']) ? 'https' : 'http')."://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}")?>" />
	<meta property="og:image" content="<?=fh_site_thumb()?>" />
	<meta property="og:description" content="<?=site_description?>" />
	<meta property="og:site_name" content="<?=fh_site_title()?>" />

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?=path?>/images/favicon/favicon.ico" type="image/x-icon" />

	<!-- Google Fonts -->
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,900%7CGentium+Basic:400italic&subset=latin,latin">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,700">

	<!-- Font Awseome -->
	<link rel="stylesheet" href="<?=path?>/css/assets/simple-line-icons.css">
	<link rel="stylesheet" href="<?=path?>/css/assets/all.min.css" />

	<!-- JQuery Libraries -->
	<link rel="stylesheet" href="<?=path?>/css/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="<?=path?>/css/bootstrap.min.css">

	<?php if(in_array(page, ['ask', 'details'])): ?>
	<?php if(page == 'ask'): ?>
	<link rel="stylesheet" href="<?=path?>/css/datepicker.min.css">
	<?php endif; ?>
	<link href="<?=path?>/js/assets/file_upload/fileinput.css" media="all" rel="stylesheet" type="text/css" />
	<?php endif; ?>
	<link href="<?=path?>/css/assets/animate.css" rel="stylesheet" type="text/css" />
	<link href="<?=path?>/css/flag-icon.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=path?>/css/scroll.css" rel="stylesheet" type="text/css" />

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?=path?>/css/style.css">
	<?php if($lang['rtl'] == 1): ?>
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=El+Messiri">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Harmattan">
	<link rel="stylesheet" href="<?=path?>/css/rtl.css">
	<?php endif; ?>

</head>
<body<?=(page?' class="pl-body-'.page.'"':'')?>>
