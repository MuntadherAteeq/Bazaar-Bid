<?php

/**
 *
 */
require_once 'config.php';
$path;
class sliderModel {
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

	public function upload() {

		$target_dir = "assets/";
		$target_file = $target_dir . basename($_FILES["file"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if (isset($_POST["submit"])) {
			$check = getimagesize($_FILES["file"]["tmp_name"]);
			if ($check !== false) {
				echo "<script type='text/javascript'>alert('File is an image - " . $check["mime"] . ".')</script>";
				$uploadOk = 1;
			} else {
				echo "<script type='text/javascript'>alert('File is not an image.')</script>";
				$uploadOk = 0;
			}
		}   
		
		// Check file size
		if ($_FILES["file"]["size"] > 500000) {
			echo "<script type='text/javascript'>alert('Sorry, your file is too large.')</script>";
			$uploadOk = 0;
		}
			// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "<script type='text/javascript'>alert('Sorry, your file was not uploaded.')</script>";
			echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
			// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				echo "<script type='text/javascript'>alert('The file " . basename($_FILES["file"]["name"]) . " has been uploaded.')</script>";
				return $target_file;
			} else {
				echo "<script type='text/javascript'>alert('Sorry, there was an error uploading your file.')</script>";
			}
		}

	}

	
	public function submitadd($adt, $des, $price, $cat, $img, $btime,$uid) {
		$this->openDB();
		$stmt = $this->conn->prepare("INSERT INTO product(title, descri, price, cid, image, btime, uid) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssiissi", $adt, $des, $price, $cat, $img, $btime,$uid);
	
		if ($stmt->execute()) {
			echo "add uploaded successfully";
		} else {
			echo "<script type='text/javascript'>alert('uploaded unsuccessfully')</script>";
		}
	
		$stmt->close(); // Close the statement
		$this->closeDB();

	}

}
?>
