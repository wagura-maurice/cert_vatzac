<?php
include('../../inc/dbcon.php');

if ($userClass->loggedIn() == true) {
	if ($userClass->Controller('Administrator') == false) {
		$userClass->Redirect("".SITEURL."/logout");
	} else {
		$username = $userClass->Insession('username');
	}
} else {
    $userClass->Redirect("".SITEURL."/login");
}

if (isset($_GET['task']) && isset($_GET['id']) && isset($_GET['status']) && isset($_GET['page'])) {
	$DBT    = $_GET['task'];
	$id     = $_GET['id'];
	$status = $_GET['status'];
	$page   = $_GET['page'];

	$sql    = "UPDATE `$DBT` SET `status`='$status' WHERE `id`='$id'";
	// SQL Execution Status Check.
	if ($connection->query($sql) === TRUE) {
		$userClass->Redirect("../$page?action=Success");
	} else {
		$userClass->Redirect("../$page?action=Failed");
	}

} else {
	$userClass->Redirect("../index.php");
}

?>