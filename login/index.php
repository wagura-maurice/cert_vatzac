<?php

include '../inc/dbcon.php';

if ($userClass->loggedIn() == true) { $userClass->Redirect($userClass->Router()); }

if (isset($_POST['doLogin'])) {
    $username = $userClass->CleanEntries($_POST['username']);
    $password = md5($_POST['password']);
    
    $userClass->Redirect($userClass->Login($username, $password));
}

?>
<!DOCTYPE html>
<html lang="en" style="overflow: visible;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


<title><?= APPNAME; ?> - Login</title> 
<meta content="Official Digital payments platform that enables Kenyan citizens , residents and visitors access and pay for government services online." name="description">
<meta content="<?= APPNAME; ?>" name="author">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- bootstrap -->
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../css/doc.min.css" rel="stylesheet" type="text/css">

<!-- custom -->
<link href="../css/styles.css" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body class="single-signon-login">
<header>
<div class="container header-nav">
<a href="../register" class="btn btn-default btn-ecitizen navbar-btn navbar-right" type="button">Sign
Up</a>
<a href="../" class="ecitizen-logo">
<img src="../images/ecitizen-logo.png">
</a>
</div>
</header>
<div class="notification-zone">
</div>
<!--main-->
<div id="main">

<div class="">
<div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-3">
<form method="POST" accept-charset="UTF-8" class="default-form" data-role="form">
<div class="form-section text-center">
<img class="mb0 mt10" src="../images/republic.png" data-pin-nopin="true">

<h3 class="mb0 mt0">One Login</h3>
<p class="mt0 mb0">All County Services</p>
</div>
<div class="form-section pb10">
<?php
if(isset($_GET['login'])) {
	switch ($_GET['login']) {
		case 'invalid':
		echo "<div class=\"alert alert-danger\">Invalid Username / Password Combination, please try again.</div>";
		break;
	}
}
?>
<div class="form-group mt20 ">
<label for="username">Username</label>
<input class="form-control mb10" placeholder="Username" name="username" type="text" id="username">
</div>
<div class="form-group mb5 ">
<label for="password">Password</label>
<input class="form-control mb10" placeholder="******" name="password" type="password" id="password">
</div>
<!-- <a href="../forgot-password">Forgot your password?</a> -->
</div>
<div class="form-submit-section">
<button class="btn btn-lg btn-success btn-block" type="submit" name="doLogin" id="doLogin">Login</button>
</div>
</form>

</div>
</div>

</div>
<!--/main-->

<div class="clearfix"></div>
<div id="acclaim" class="ecitizen">
<div class="container-fluid container-max-width">
<div class="row">
<div class="col-sm-12 text-center">
<ul>
<li><a href="../register">Create an account</a></li>
</ul>
<hr class="mb5 mt5" style="border-bottom:1px solid;">
</div>
<div class="col-sm-12 text-center">
<p class="small">© <?= date('Y') . " " . APPNAME; ?> / Design by <a href="<?= SITEURL; ?>"><?= AUTHOR; ?></a></p>
</div>
</div>
</div>
</div>
<!-- script references -->
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>