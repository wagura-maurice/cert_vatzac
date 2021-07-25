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

include('inc/header.php');
?>

<div class="page-content-wrapper">
<div class="page-content">
<ul class="page-breadcrumb breadcrumb">
<li>
<a href="index.php">Home</a>
<i class="fa fa-circle"></i>
</li>
<li>
<span class="active">Permits List</span>
</li>
</ul>
<?php
if(isset($_GET['action'])) {
	switch ($_GET['action']) {
		case 'Success':
		echo "<div class=\"alert alert-success content-center\"><label>Updated Successfully</label></div>";
		break;
		case 'Failed':
		echo "<div class=\"alert alert-danger content-center\"><label>An Unexpected Error Occurred While Updating, please try again.</label></div>";
		break;
	}
}
?>
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-dark">
<i class="icon-settings font-dark"></i>
<span class="caption-subject bold uppercase">Permits List</span>
</div>
<div class="tools"> </div>
</div>
<div class="portlet-body">
<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>
<tr>
<th>#</th>
<th>Business Name</th>
<th>Owner</th>
<th>Sector</th>
<th>Category</th>
<th>Request Date</th>
<th>Approved</th>
</tr>
</thead>
<tbody>
<?php $userClass->checkPermits(); ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include('inc/footer.php'); ?>