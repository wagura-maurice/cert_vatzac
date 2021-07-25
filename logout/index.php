<?php
include('../inc/dbcon.php'); // just for the session
$userClass->Logout();
$userClass->Redirect("".SITEURL."");
?>