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

if (isset($_GET['type']) && !empty($_GET['type'])) {
	$business = $_GET['type'];
} else {
	$userClass->Redirect("".SITEURL."/admin");
}

if (isset($_POST['addBusiness'])) {

    $bizType = $userClass->CleanEntries($_POST['bizType']);
    // submision strings
    $fData = ["". $business . "" => $bizType];
    // insert function
    $userClass->Redirect($userClass->insertBusiness($fData, $business));
}

include('inc/header.php');
?>

<div class="page-content-wrapper">
<div class="page-content">
<div class="page-head">
<div class="page-title">
<h1>Business <?= ucwords($business); ?>'s Form</h1>
</div>
</div>
<ul class="page-breadcrumb breadcrumb">
<li>
<a href="index.php">Home</a>
<i class="fa fa-circle"></i>
</li>
<li>
<span class="active">Add Business <?= ucwords($business); ?>'s</span>
</li>
<li>
<i class="fa fa-circle"></i>
<a href="listBusiness.php?type=<?= ucwords($business); ?>">List Business <?= ucwords($business); ?>'s</a>
</li>
</ul>
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-green-haze">
<i class="icon-settings font-green-haze"></i>
<span class="caption-subject bold uppercase"> Add Business <?= ucwords($business); ?>'s</span>
</div>
<div class="actions">
<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
</div>
</div>
<div class="portlet-body form">
<form method="POST" role="form" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
<?php
if(isset($_GET['action'])) {
	switch ($_GET['action']) {
		case 'Success':
		echo "<div class=\"alert alert-success content-center\"><label>Business " . ucwords($business) ." Updated Successfully</label></div></div>";
		break;
		case 'Failed':
		echo "<div class=\"alert alert-danger content-center\"><label>An Unexpected Error Occurred While Updating your Business " . ucwords($business) .", please try again</label></div></div>";
		break;
	}
}
?>
<div class="form-body">
<div class="form-group form-md-line-input">
<label class="col-md-2 control-label">Business <?= ucwords($business); ?></label>
<div class="col-md-10">
<input type="text" name="bizType" id="bizType" class="form-control" placeholder="Enter New Business <?= ucwords($business); ?>" required>
<div class="form-control-focus"> </div>
</div>
</div>
<div class="form-actions">
<div class="row">
<div class="col-md-offset-2 col-md-10">
<button type="button" class="btn default">Cancel</button>
<button type="submit" name="addBusiness" id="addBusiness" class="btn blue">Add Business</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include('inc/footer.php'); ?>