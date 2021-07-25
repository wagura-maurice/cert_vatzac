<?php
include('../inc/dbcon.php');

if ($userClass->loggedIn() == true) {
	if ($userClass->Controller('Administrator') == false) {
		$userClass->Redirect("".SITEURL."/logout");
	} else {
		$username = $userClass->Insession('username');
	}
} else {
    $userClass->Redirect("".SITEURL."/login");
}

// Get number of number of curret clients
$pQuery    = "SELECT COUNT(`id`) AS `pNO` FROM `users` WHERE `occp` = 'Client'";
$pResult   = $connection -> query($pQuery);
$pRow      = $pResult -> fetch_assoc();
$cUsers  = $pRow['pNO'];

// Get number of unapproved permits for all clients
$UpQuery    = "SELECT COUNT(`id`) AS `UpNO` FROM `permit` WHERE `status` != 'Yes'";
$UpResult   = $connection -> query($UpQuery);
$UpRow      = $UpResult -> fetch_assoc();
$unApprovedPermits  = $UpRow['UpNO'];

// Get number of approved permits for all clients
$ApQuery    = "SELECT COUNT(`id`) AS `ApNO` FROM `permit` WHERE `status` = 'Yes'";
$ApResult   = $connection -> query($ApQuery);
$ApRow      = $ApResult -> fetch_assoc();
$ApprovedPermits  = $ApRow['ApNO'];

include('inc/header.php');
?>

<div class="page-content-wrapper">
<div class="page-content">
<div class="page-head">
<div class="page-title">
<h1><?= ucwords($_SESSION['occp']); ?> Dashboard
<small>statistics, charts, recent events and reports</small>
</h1>
</div>
<!-- END PAGE TITLE -->
<!-- BEGIN PAGE TOOLBAR -->
<div class="page-toolbar">
</div>
</div>
<ul class="page-breadcrumb breadcrumb">
<li>
<a href="index.php">Home</a>
<i class="fa fa-circle"></i>
</li>
<li>
<span class="active">Dashboard</span>
</li>
</ul>
<div class="row">
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<a class="dashboard-stat dashboard-stat-v2 blue" href="listClients.php">
<div class="visual">
<i class="fa fa-comments"></i>
</div>
<div class="details">
<div class="number"> +
<span data-counter="counterup" data-value="<?= number_format($cUsers); ?>">0</span>
</div>
<div class="desc"> No of Clients </div>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<a class="dashboard-stat dashboard-stat-v2 red" href="listPermits.php">
<div class="visual">
<i class="fa fa-bar-chart-o"></i>
</div>
<div class="details">
<div class="number"> +
<span data-counter="counterup" data-value="<?= number_format($ApprovedPermits); ?>">0</span>
</div>
<div class="desc"> Approved Permits </div>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<a class="dashboard-stat dashboard-stat-v2 green" href="listPermits.php">
<div class="visual">
<i class="fa fa-shopping-cart"></i>
</div>
<div class="details">
<div class="number"> +
<span data-counter="counterup" data-value="<?= number_format($unApprovedPermits); ?>">0</span>
</div>
<div class="desc"> Un Approved Permits </div>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<a class="dashboard-stat dashboard-stat-v2 purple" href="#">
<div class="visual">
<i class="fa fa-globe"></i>
</div>
<div class="details">
<div class="number">
<span data-counter="counterup" data-value="<?= $hDate; ?>">0</span>
</div>
<div class="desc"> Today's Date </div>
</div>
</a>
</div>
</div>
<div class="clearfix"></div>
<div class="row">
<div class="col-lg-12 col-xs-12 col-sm-12">
<!-- BEGIN PORTLET-->
<!-- <div class="portlet light bordered">
<div class="portlet-title">
<div class="caption">
<i class="icon-bar-chart font-dark hide"></i>
<span class="caption-subject font-dark bold uppercase">Statistics : </span>
<a href="stats.php?id=Chairman" target="_blank">Chairman</a> | <a href="stats.php?id=Secretary" target="_blank">Secretary</a> | <a href="stats.php?id=Sports" target="_blank">Sports</a>
<div id="container" class="col-lg-12 col-xs-12 col-sm-12" style="min-width: 950px; height: 420px; margin: 0 auto"></div>
</div>
</div>
</div> -->

</div>
</div>
</div>
</div>

<?php include('inc/footer.php'); ?>