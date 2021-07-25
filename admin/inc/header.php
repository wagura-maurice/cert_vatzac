<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8" />
<title><?= $userClass->Tittle() . " : : " . $hDate; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="Preview page of Metronic Admin Theme #4 for buttons extension demos" name="description" />
<meta content="" name="author" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
<link href="assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
<link href="assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" />
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
<div class="page-header navbar navbar-fixed-top">
<div class="page-header-inner ">
<div class="page-logo">
<a href="index.php">
<img src="assets/layouts/layout4/img/logo.png" alt="<?= APPNAME; ?>" class="logo-default" /> </a>
<div class="menu-toggler sidebar-toggler">
</div>
</div>
<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
<div class="page-top">
<div class="top-menu">
<ul class="nav navbar-nav pull-right">
<li class="dropdown dropdown-user dropdown-dark">
<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
<span class="username username-hide-on-mobile"> <?= ucwords($username); ?> </span>
<img alt="<?= ucwords($username); ?>" class="img-circle" src="../uploads/avatar/<?= ucwords($userClass->Insession('avatar')); ?>" /> </a>
<ul class="dropdown-menu dropdown-menu-default">
<li>
<a href="profile.php">
<i class="icon-user"></i> My Profile </a>
</li>
<li class="divider"> </li>
<li>
<a href="<?= SITEURL; ?>/logout">
<i class="icon-key"></i> Log Out </a>
</li>
</ul>
</li>
</ul>
</div>
</div>
</div>
</div>
<div class="clearfix"> </div>
<div class="page-container">
<div class="page-sidebar-wrapper">
<div class="page-sidebar navbar-collapse collapse">
<ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
<li class="nav-item start ">
<a href="javascript:;" class="nav-link nav-toggle">
<i class="icon-home"></i>
<span class="title">Dashboard</span>
<span class="arrow"></span>
</a>
<ul class="sub-menu">
<li class="nav-item start ">
<a href="index.php" class="nav-link ">
<span class="title">Home</span>
</a>
</li>
<li class="nav-item start ">
<a href="listClients.php" class="nav-link ">
<span class="title">List Clients</span>
</a>
</li>
<li class="nav-item start ">
<a href="listPermits.php" class="nav-link ">
<span class="title">List Permits</span>
</a>
</li>
<li class="nav-item start ">
<a href="addBusiness.php?type=sector" class="nav-link ">
<span class="title">Add Business Sector's</span>
</a>
</li>
<li class="nav-item start ">
<a href="listBusiness.php?type=sector" class="nav-link ">
<span class="title">List Business Sector's</span>
</a>
</li>
<li class="nav-item start ">
<a href="addBusiness.php?type=category" class="nav-link ">
<span class="title">Add Business Category's</span>
</a>
</li>
<li class="nav-item start ">
<a href="listBusiness.php?type=category" class="nav-link ">
<span class="title">List Business Category's</span>
</a>
</li>
</ul>
</li>
</ul>
</div>
</div>