<!DOCTYPE html>
<html lang="">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
		<title>Login - Pollate</title>

    <!-- Google Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,900%7CGentium+Basic:400italic&subset=latin,latin">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,700">

    <!-- Icons Fonts -->
		<link rel="stylesheet" href="<?=path?>/css/assets/simple-line-icons.css">

    <!-- Stylesheets -->
		<link rel="stylesheet" href="<?=path?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=path?>/css/style.css">

</head>
<body class="pl-cpanel-login">
	<div id="sign-modal" class="modal-content">
		<form>
			<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Login</h4>
			</div>
			<div class="modal-body">
				<div class="pl-group-inp">
						<label>
								<i class="icon-user icons"></i>
								<input type="text" name="login_name" placeholder="type your username or email">
						</label>
				</div>
				<div class="pl-group-inp">
						<label>
								<i class="icon-key icons"></i>
								<input type="password" name="login_pass" placeholder="type your password">
						</label>
				</div>
				<hr class="d-none"/>
			</div>
			<div class="modal-footer">
					<button type="submit" class="pl-buttons bg-0">Sign In</button>
			</div>
		</form>
	</div>
	<div class="pl-copyright">
    <div class="pl-container">
        Copyright © 2020 <a href="#">Pollate</a>. All Rights Reserved.<br>
        Programming and design by <a href="http://puertokhalid.com" target="_blanc">Puerto Khalid</a>.
    </div><!-- End Container -->
</div>

<!-- jQuery Libraries -->
<script src="<?=path?>/js/jquery-3.4.1.min.js"></script>
<script src="<?=path?>/js/assets/jquery.livequery.js"></script>
<script>
	var path    = '<?=path?>';
	var actions = '<?=(us_level ? 1 : 0)?>';
	var lang    = <?=json_encode($lang)?>;
</script>
<script src="<?=path?>/js/custom.js"></script>

</body>
</html>
