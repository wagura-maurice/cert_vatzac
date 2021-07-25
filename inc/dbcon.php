<?php

session_start();

$servername = "localhost";
$username   = "root";
$password   = "Rtcv39$$";
$dbname     = "cert_vatzac";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connection->connect_errno) {
    echo "Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error;
}

$connection->set_charset("utf8");

include('functions.php');
$userClass = new userClass($connection);

define('APPNAME', 'e-County');
define('SITEURL', 'http://localhost/cert_vatzac');
define('AUTHOR', 'Dennis Vatzac');

$hDate       = (new DateTime (date('Y-m-d H:i:s'))) -> format('M, dS Y');

?>