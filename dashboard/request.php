<?php
include('../inc/dbcon.php');

if ($userClass->loggedIn() == true) {
	if ($userClass->Controller('Client') == false) {
		$userClass->Redirect("".SITEURL."/logout");
	} else {
		$username = $userClass->Insession('username');
	}
} else {
    $userClass->Redirect("".SITEURL."/login");
}

if (isset($_POST['requestPermit'])) {

    $sector   = $userClass->CleanEntries($_POST['bizsector']);
    $category = $userClass->CleanEntries($_POST['bizcategory']);
    $name     = $userClass->CleanEntries($_POST['bizname']);
    $estDate  = $userClass->CleanEntries($_POST['estDate']);
    // submision strings
    $fData = ['username' => $username, 'sector' => $sector, 'category' => $category , 'name' => $name, 'estDate' => $estDate];
    // insert function
    $userClass->Redirect($userClass->Insert("permit", $fData));
}

include('inc/header.php');
?>

<div class="page-content-wrapper">
<div class="page-content">
<div class="page-head">
<div class="page-title">
<h1>Permit Request Form</h1>
</div>
</div>
<ul class="page-breadcrumb breadcrumb">
<li>
<a href="index.php">Home</a>
<i class="fa fa-circle"></i>
</li>
<li>
<span class="active">Permits Form</span>
</li>
<li>
<i class="fa fa-circle"></i>
<a href="check.php">List Permits</a>
</li>
</ul>
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-green-haze">
<i class="icon-settings font-green-haze"></i>
<span class="caption-subject bold uppercase"> Request Permit</span>
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
		echo "<div class=\"alert alert-success content-center\"><label>Permit Request Submitted Successfully</label></div></div>";
		break;
		case 'Failed':
		echo "<div class=\"alert alert-danger content-center\"><label>An Unexpected Error Occurred While Submitting your Permit request, please try again</label></div></div>";
		break;
	}
}
?>
<div class="form-body">
<div class="form-group form-md-line-input">
<label class="col-md-2 control-label">Business Sector</label>
<div class="col-md-10">
<select class="form-control" name="bizsector" id="bizsector" required>
<option disabled selected>Select Business Sector</option>
<?php
foreach ($userClass->Business('sector') as $keyS => $valueS) {
	echo "<option value=\"$valueS\">" . ucwords($valueS) . " Business</option>";
}
?>
</select>
<div class="form-control-focus"> </div>
</div>
</div>
<div class="form-group form-md-line-input">
<label class="col-md-2 control-label">Business Category</label>
<div class="col-md-10">
<select class="form-control" name="bizcategory" id="bizcategory" required>
<option disabled selected>Select Business Category</option>
<?php
foreach ($userClass->Business('category') as $keyC => $valueC) {
	echo "<option value=\"$valueC\">" . ucwords($valueC) . " Business</option>";
}
?>
</select>
<div class="form-control-focus"> </div>
</div>
</div>
<div class="form-group form-md-line-input">
<label class="col-md-2 control-label">Business Name</label>
<div class="col-md-10">
<input type="text" name="bizname" id="bizname" class="form-control" placeholder="Enter Business Name" required>
<div class="form-control-focus"> </div>
</div>
</div>

<div class="form-group form-md-line-input">
<label class="col-md-2 control-label">Date Of Establishment</label>
<div class="col-md-10">
<div class="input-icon">
<i class="fa fa-calendar"></i>
<input class="form-control form-control-inline input-medium date-picker" size="16" type="text" name="estDate" id="estDate" data-date="2012/10/11" data-date-format="yyyy/mm/dd" required placeholder="Establishment Date of Bussiness" />
</div>
<span class="help-block"> Select date </span>
</div>
</div>
<div class="form-actions">
<div class="row">
<div class="col-md-offset-2 col-md-10">
<button type="button" class="btn default">Cancel</button>
<button type="submit" name="requestPermit" id="requestPermit" class="btn blue">Submit Request</button>
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