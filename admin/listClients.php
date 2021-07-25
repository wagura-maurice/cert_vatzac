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

// $userClass->listUsers("Client");

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
<span class="active">Clients List</span>
</li>
</ul>
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-dark">
<i class="icon-settings font-dark"></i>
<span class="caption-subject bold uppercase">Clients List</span>
</div>
<div class="tools"> </div>
</div>
<div class="portlet-body">
<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>
<tr>
<th>#</th>
<th>Full Name</th>
<th>Email</th>
<th>Phone</th>
<th>Join Date</th>
</tr>
</thead>
<tbody>
<?php $userClass->listUsers("Client"); ?>
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