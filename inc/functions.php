<?php

/**
 * User Class - user class for cert_vatzac project.
 * PHP Version 5
 * @package User Class
 * @author Dennis 
 * @link https://www.waguramaurice.cf
 * @copyright 2017 Wagura Maurice
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

class userClass {

	private $_db;

	public function __construct($connection) {
	// parent::__construct();

		$this->_db = $connection;
	}

	public function Login($username,$password) {

		$Query  = "SELECT `id`, `occp` FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
		$Result = $this->_db->query($Query);

		if ($Result->num_rows != 1) {
			return "".SITEURL."/login?login=invalid";
		} else {
		// Authenticated, set session variables
			$user = $Result->fetch_array();

			$_SESSION['userID']    = $user['id'];
			$_SESSION['occp']      = $user['occp'];
			return $this->Router();
		}
	}

	public function loggedIn() {

		if (isset($_SESSION['userID'])) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function Router() {

		$occp = $this->Insession('occp');

		if ($occp == "Client") {
			return "".SITEURL."/dashboard";
		} elseif ($occp == "Administrator") {
			return "".SITEURL."/admin";
		}
	}

	public function Controller($value) {

		$occp = $this->Insession('occp');

		if ($occp == $value) {
			return TRUE;
		} elseif ($occp !== $value) {
			return FALSE;
		}
	}

	public function Insession($value) {

		$userID = $_SESSION['userID'];

		$Query  = "SELECT `$value` FROM `users` WHERE `id` = '$userID'";
		$Result = $this->_db->query($Query);
		$Row    = $Result->fetch_assoc();

		$scopeItem = $Row[$value];

		return $scopeItem;
	}

	public function Logout() {

		$_SESSION = array();

		if(isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-150000, '/');
		}

		session_unset();
		session_destroy();
	}

	public function insertBusiness($fData, $business) {
        // retrieve the keys of the array so as to determine the columns 
    	$fields = array_keys($fData);
    	// build the query
    	$sql = "INSERT INTO `business`(`".implode('`, `', $fields)."`) VALUES ('".implode("', '", $fData)."')";

    	if ($this->_db->query($sql) === TRUE) {
    		return "?type=$business&action=Success";
    	} else {
    		return "?type=$business&action=Failed";
    	}
    }

	public function Business($value) {

		$variable  = [];

		$Query     = "SELECT `$value` FROM `business` WHERE `$value` != ''";
		$Result    = $this->_db->query($Query);
		while($Row = $Result->fetch_assoc()) {
			$variable[] = $Row[$value];
		}

		return $variable;
	}

	public function clientPermit($value) {
		// Get number of permits for current client ONLY!!
		$Query  = "SELECT COUNT(`id`) AS `COUNT` FROM `permit` WHERE `username` = '$value'";
		$Result = $this->_db->query($Query);
		$Row    = $Result->fetch_assoc();
		return $Row['COUNT'];
	}

	public function pApproval($value, $mathSYM) {
		// Get number of approved || unapproved permits for current client ONLY!!
		$Query  = "SELECT COUNT(`id`) AS `COUNT` FROM `permit` WHERE `username` = '$value' AND `status` $mathSYM 'Yes'";
		$Result = $this->_db->query($Query);
		$Row    = $Result->fetch_assoc();
		return $Row['COUNT'];
	}

	public function clientPermits($value) {
		// Loop through all current clients permits the print to table
		$Query     = "SELECT * FROM `permit` WHERE `username` = '$value' ORDER BY `id` DESC";
		$Result    = $this->_db->query($Query);
		$totalRecs = $Result->num_rows;

		if($totalRecs == 0) {
			echo "No Data To Display";
		} else {
			$k=1;
			while($Row = $Result->fetch_assoc()) {

				$Date   = new DateTime ($Row['requestDate']);
				$rDate  = $Date -> format ('dS M Y');
				$Status = $Row['status'];

				if ($Status == 'Yes') {
					$StatusSTMT =  "<a href=\"pdf.php?id=" . $Row['id'] . "\" target=\"_blank\"><button type=\"button\" class=\"btn green\">YES</button></a>";
				} elseif ($Status == 'No') {
					$StatusSTMT =  "<button type=\"button\" class=\"btn red\">NO</button>";
				} elseif ($Status == 'Pending') {
					$StatusSTMT =  "<button type=\"button\" class=\"btn blue\">Pending</button>";
				}

				echo "
				<tr align=\"center\">
				<td>" . $Row['id'] . " </td>
				<td>" . ucwords($Row['name']) . " </td>
				<td>" . ucwords($Row['username']) . " </td>
				<td>" . ucwords($Row['sector']) . " </td>
				<td>" . ucwords($Row['category']) . " </td>
				<td>" . ucwords($rDate) . " </td>
				<td>" . $StatusSTMT . " </td>
				</tr>";
			}
		}
	}

	public function checkPermits() {
		// Loop through all current clients permits the print to table
		$Query     = "SELECT * FROM `permit` ORDER BY `id` DESC";
		$Result    = $this->_db->query($Query);
		$totalRecs = $Result->num_rows;

		if($totalRecs == 0) {
			echo "No Data To Display";
		} else {
			$k=1;
			while($Row = $Result->fetch_assoc()) {

				$Date   = new DateTime ($Row['requestDate']);
				$rDate  = $Date -> format ('dS M Y');
				$Status = $Row['status'];

				if ($Status == 'Yes') {
					$StatusSTMT = "<a href=\"pdf.php?id=" . $Row['id'] . "\" target=\"_blank\"><button type=\"button\" class=\"btn green\">YES</button></a>";
				} elseif ($Status == 'No') {
					$StatusSTMT = "<button type=\"button\" class=\"btn red\">NO</button>";
				} elseif ($Status == 'Pending') {
					$StatusSTMT = "<a href=\"inc/updatetask.php?task=permit&id=" . $Row['id'] . "&status=Yes&page=" . $this->currentURL() . "\"><button type=\"button\" class=\"btn green\">YES</button></a><a href=\"inc/updatetask.php?task=permit&id=" . $Row['id'] . "&status=No&page=" . $this->currentURL() . "\"><button type=\"button\" class=\"btn red\">NO</button></a>";
				}

				echo "
				<tr align=\"center\">
				<td>" . $Row['id'] . " </td>
				<td>" . ucwords($Row['name']) . " </td>
				<td>" . ucwords($Row['username']) . " </td>
				<td>" . ucwords($Row['sector']) . " </td>
				<td>" . ucwords($Row['category']) . " </td>
				<td>" . ucwords($rDate) . " </td>
				<td>" . $StatusSTMT . " </td>
				</tr>";
			}
		}
	}

	public function listUsers($value) {

		$Query  = "SELECT * FROM `users` WHERE `occp` = '". $value ."' ORDER BY `id` DESC";
		$Result = $this->_db->query($Query);

		$totalRecs = $Result->num_rows;

		if($totalRecs == 0) {
			echo "No Data To Display";
		} else {
			$k = 1;
			while($Row    = $Result->fetch_assoc()) {
				$Date     = new DateTime ($Row['joinDate']);
				$joinDate = $Date -> format ('dS M Y');
				echo "
				<tr align=\"center\">
				<td>" . $Row['id'] . "</td>
				<td>" . ucwords($Row['fname'] . " " . $Row['lname']) . "</td>
				<td>" . $Row['email'] . "</td>
				<td>" . $Row['phone'] . "</td>
				<td>" . ucwords($joinDate) . "</td>
				";
			}
		}
	}

	public function Insert($tName, $fData) {
        // retrieve the keys of the array so as to determine the columns 
    	$fields = array_keys($fData);
    	// build the query
    	$sql = "INSERT INTO `". $tName ."`(`".implode('`, `', $fields)."`) VALUES ('".implode("', '", $fData)."')";

    	if ($this->_db->query($sql) === TRUE) {
    		return "?action=Success";
    	} else {
    		return "?action=Failed";
    	}
    }

    public function updateProfile($tName, $fData, $fID, $attribute, $pwd) {
        // check for optional where clause
    	$whereSQL = " WHERE `username` = '". $this->Insession('username') ."'";
    	// start the actual SQL statement
    	$sql  = "UPDATE `" . $tName . "` SET";
    	// loop and build the column
    	$sets = [];
    	foreach($fData as $column => $value) {
    		$sets [] = "`". $column . "` = '". $value . "'";
    	}

    	$sql .= implode(', ' , $sets );
    	// append the where statement
    	$sql .= $whereSQL;

    	// run and return the query result
    	if ($this->_db->query($sql) === TRUE) {
    		if ($pwd === TRUE) {
    			return "".SITEURL."/logout";
    		} elseif($pwd === FALSE) {
    			return "?". $fID ."=Success". $attribute;
    		}
    	} else {
    		return "?". $fID ."=Failed". $attribute;
    	}
    }

	public function CleanEntries($entry) {

		$entry = trim($entry); // trim white space
		$entry = strtolower($entry); // convert all alphabetic characters to lowercase
		$entry = addslashes($entry); // escape by adding slashes on all special characters
		$entry = htmlspecialchars($entry); // escape any HTML entities or characters

		return $entry; // return a cleaned entry.
	}

	public function Redirect($url) {
		header("Location: {$url}");
	}

	public function currentURL() {

		$Current_URL = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segment     = explode('/', $Current_URL);
		$cPage       = $segment[3];
		return $cPage;
	}

	public function Tittle() {

		$cPage = $this->currentURL();
		$occp  = $_SESSION['occp'];

		if ($occp == "Client") {
			if ($cPage == "index.php") {
				return "DashBoard | " . APPNAME;
			} else if ($cPage == "request.php") {
				return "Request Permits | " . APPNAME;
			} else if ($cPage == "check.php") {
				return "Check Permits | " . APPNAME;
			} else if ($cPage == "profile.php") {
				return "Client Profile | " . APPNAME;
			} else {
				return "DashBoard | " . APPNAME;
			}
		} elseif ($occp == "Administrator") {
			if ($cPage == "index.php") {
				return "Admin | " . APPNAME;
			} else if ($cPage == "addBusiness.php") {
				return "Add Business | " . APPNAME;
			} else if ($cPage == "listBusiness.php") {
				return "List Business | " . APPNAME;
			} else if ($cPage == "listClients.php") {
				return "List Clients | " . APPNAME;
			} else if ($cPage == "listPermits.php") {
				return "List Permits | " . APPNAME;
			} else if ($cPage == "profile.php") {
				return "Admin Profile | " . APPNAME;
			} else {
				return "Admin | " . APPNAME;
			}
		}
	}

}

?>