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

$Query  = "SELECT `id`, `$business` FROM `business` WHERE `$business` != '' ORDER BY `id` DESC";
$Result = $connection->query($Query);

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
<span class="active">Business <?= ucwords($business); ?>'s List</span>
</li>
<li>
<i class="fa fa-circle"></i>
<a href="addBusiness.php?type=<?= ucwords($business); ?>">New Business <?= ucwords($business); ?>'s</a>
</li>
</ul>
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-dark">
<i class="icon-settings font-dark"></i>
<span class="caption-subject bold uppercase">Business <?= ucwords($business); ?>'s List</span>
</div>
<div class="tools"> </div>
</div>
<div class="portlet-body">
<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>
<tr>
<th>#</th>
<th>Business <?= ucwords($business); ?>'s</th>

</tr>
</thead>
<tbody>
<?php
$totalRecs    = $Result->num_rows;
if($totalRecs == 0) {
	echo "No DataTables To Display";
} else {

$k=1;
while($Row = $Result->fetch_assoc()) {
$bizID     = $Row['id'];
$bizName   = $Row[$business];
?>
<tr align="center">
<td><?= $bizID; ?></td>
<td><?= ucwords($bizName . " Business " . $business); ?></td>
</tr>
<?php $k++; } } ?>
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