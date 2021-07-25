<?php

include '../inc/dbcon.php';

if ($userClass->loggedIn() == true) { $userClass->Redirect($userClass->Router()); }

if (isset($_POST['registration'])) {
	// var_dump($_POST);
	$username = $userClass->CleanEntries($_POST['username']);
	$fname    = $userClass->CleanEntries($_POST['first_name']);
	$lname    = $userClass->CleanEntries($_POST['last_name']);
	$email    = $userClass->CleanEntries($_POST['email']);
	$phone    = $userClass->CleanEntries($_POST['phone']);
	$password = md5($_POST['password']);

    $imgFile   = $_FILES['avatarImg']['name'];
	$tmpDIR    = $_FILES['avatarImg']['tmp_name'];
	$imgSize   = $_FILES['avatarImg']['size'];
	$uploadDIR = '../uploads/avatar/';
	$imgExt    = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
	$validExt  = array('jpeg', 'jpg', 'png');
	$avatarImg = rand(10000,1000000)."-".$username.".jpg";
	if(in_array($imgExt, $validExt)) {   
		if($imgSize < 5000000) {
			move_uploaded_file($tmpDIR,$uploadDIR.$avatarImg);
		} else {
			die($userClass->Redirect("?action=ImageError"));
		}
	} else {
		die($userClass->Redirect("?action=ImageError"));
	}

	// SQL Execution Of Post Data.
	$sql = "INSERT INTO `users`(`username`, `fname`, `lname`, `email`, `phone`, `avatar`, `password`) VALUES ('$username', '$fname', '$lname', '$email', '$phone', '$avatarImg', '$password')";
	// SQL Execution Status Check.
	if ($connection->query($sql) === TRUE) {
		$userClass->Redirect("?action=Success");
	} else {
		$userClass->Redirect("?action=Failed");
	}
}

?>
<!-- saved from url=(0057)https://accounts./register-step-1?t=citizen -->
<html lang="en" style="overflow: visible;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body class="single-signon-register">
<header>
<div class="container header-nav">
<a href="<?= SITEURL; ?>/login" class="btn btn-default btn-ecitizen navbar-btn navbar-right" type="button">Sign
In</a>
<a href="<?= SITEURL; ?>" class="ecitizen-logo">
<img src="../images/ecitizen-logo.png">
</a>
</div>
</header>
<body>
bg.jpg</body>

<title><?= APPNAME; ?> - Register</title>
<meta content="Official Digital payments platform that enables Kenyan citizens , residents and visitors access and pay for government services online." name="description">
<meta content="<?= APPNAME; ?>" name="<?= AUTHOR; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- bootstrap -->
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../css/doc.min.css" rel="stylesheet" type="text/css">

<!-- custom -->
<link href="../css/styles.css" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<div class="notification-zone">
</div>
<div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-3  col-sm-offset-2 col-xs-offset-0">
<div class="default-form default-form-null">
<div class="form-section text-center">
<div class="big-quote quote-default">
<h3 class="mb0 m0">Create Account</h3>
<p class="mt0">For business registration</p>
</div>
</div>
<!--Register top-content-->
<form method="POST" accept-charset="UTF-8" class="mb0" autocomplete="off" enctype="multipart/form-data">
<?php
if(isset($_GET['action'])){
switch ($_GET['action']) {
case 'Success':
echo "<div class=\"alert alert-success content-center\"><label>Registered Successfully</label></div>";
break;
case 'Failed':
echo "<div class=\"alert alert-danger content-center\"><label>An Unexpected Error Occurred While Registering, Try Again</label></div>";
break;
case 'ImageError':
echo "<div class=\"alert alert-warning content-center\"><label>Image File Not A Valid Extension Or Above The 5Mb Size Limit, Try Again</label></div>";
break;
}
}
?>
<div class="form-section">
<div class="form-group text-left mb1">
<label for="username">Enter Username</label>
<input class="form-control" placeholder="Username" name="username" type="text" id="username" required>
</div>
<div class="form-group text-left mb2">
<label for="first_name">Enter First Name</label>
<input class="form-control" placeholder="First Name" name="first_name" type="text" id="first_name" required>
</div>
<div class="form-group text-left mb3">
<label for="last_name">Enter Last Name</label>
<input class="form-control" placeholder="Last Name" name="last_name" type="text" id="last_name" required>
</div>
<div class="form-group text-left mb4">
<label for="email">Enter Email</label>
<input class="form-control" placeholder="Email Address" name="email" type="text" id="email" required>
</div>
<div class="form-group text-left mb5">
<label for="phone">Enter Phone Number</label>
<input class="form-control" placeholder="Phone Number" name="phone" type="text" id="phone" required>
</div>
<div class="form-group text-left mb6">
<label for="avatarImg">Profile Avatar</label>
<input class="form-control" name="avatarImg" type="file" id="avatarImg" required>
</div>
<div class="form-group text-left mb7">
<label for="password">Enter Password</label>
<input class="form-control" placeholder="Password" name="password" type="password" id="password" required>
</div>
</div>
<div class="form-submit-section">
<button class="btn btn-lg btn-success btn-block" type="submit" name="registration" id="registration">Register </button>
</div>
</form>
</div>
</div>
<div class="clearfix"></div>
<!--main-->
<div id="acclaim">
<div class="container-fluid container-max-width">
<div class="row">
<div class="col-sm-12 text-center">
<ul>
<li><a href="../login">Already have an account? Sign in</a></li>
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