<?php

/**
 *
 */
require_once 'config.php';
class singupModel {
	private $conn;
	private $conset;
	function __construct() {
		$this -> conset = new config();
	}

	public function openDB() {
		$this -> conn = new mysqli($this -> conset -> servername, $this -> conset -> username, $this -> conset -> password, $this -> conset -> dbname);
		if ($this -> conn -> connect_error) {
			die("Connection failed: " . $this -> conn -> connect_error);
			}
			}

	public function closeDB() {
		$this -> conn -> close();
	}

	public function singup($email, $fname, $lname, $mno, $pass) {

		// validate email 
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "<script type='text/javascript'>alert('Invalid Email')</script>";
			// redirect to home page
			return false;
	   }

		$ccn = mysqli_connect("localhost","root","","bazaar")or die("connecton error");
		mysqli_select_db($ccn,"bazaar")or die("selection error");
			
		$sql = "SELECT * FROM user WHERE Email= '$email'";
		$rs = mysqli_query($ccn,$sql) or die("query error");
			

		$sig = 0;

		if (strlen($pass) < 8 || strlen($pass) > 20) {
			echo "<script type='text/javascript'>alert('Password must be 8 to 20 characters long')</script>";
			// die("Password must be 8 to 20 characters long");
			// redirect to home page
			$homeUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/';
			echo "<script type='text/javascript'>window.location.href = '$homeUrl';</script>";
			exit();

		}

		while ($row = mysqli_fetch_array($rs)) {
				if ($email == $row["Email"])
				$sig = 1;
		}
		


		if($sig==0){
			$sqll = "INSERT INTO user (Email, FirstName, LastName, Mob, password) VALUES ('$email', '$fname', '$lname', '$mno', '$pass')";
			$rs = mysqli_query($ccn,$sqll) or die("Insertion error");		
			$homeUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/';
			echo "<script type='text/javascript'>alert('Successfull Signup , Please Login To continue ');window.location.href = '$homeUrl';</script>";
        	echo "window.location.href = '$homeUrl'";
			
		}else {
			echo "<script type='text/javascript'>alert('Already Exist!')</script>";
			
		}					

	}

	public function login($email, $pass) {
		$this -> openDB();
		
		$stmt = $this -> conn -> prepare("SELECT * FROM user WHERE Email=? AND password=?");

		$stmt -> bind_param("ss", $email, $pass);
		if ($stmt -> execute()) {
			$res = $stmt -> get_result();
			$this -> closeDB();
			return $res -> fetch_object();

		} else {
			return FALSE;
		}
	}

	public function logout() {

		session_start();
		session_destroy();
	}

}
?>