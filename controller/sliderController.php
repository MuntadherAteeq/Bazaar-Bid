<?php
@session_start();
require_once 'model/sliderModel.php';
/**
 *
 */
class sliderController {

	function __construct() {

	}

	public function redirect($location) {
		header('Location: ' . $location);
	}

	public function handleRequest() {
		if (isset($_POST['submit'])) {
			$this -> addProducts();

		}
	}

	public function addProducts() {
		$slidermodalobj = new sliderModel();
		$p = $slidermodalobj -> upload();
		$name = $_SESSION['user'];
		$conn = new mysqli("localhost", "root", "", "bazaar");
		$sql = "SELECT * FROM user WHERE Email = '$name'";
		$result = $conn -> query($sql);
		$dataArray = mysqli_fetch_array($result);
		$userId = $dataArray[0];
		$email = $dataArray[1];
		$FName = $dataArray[2];
		$LName = $dataArray[4];
		$mobile = $dataArray[5];
		$slidermodalobj -> submitadd($_POST['Title'], $_POST['Description'], $_POST['price'], $_POST['Category'], $p, $FName." ".$LName, $email, $mobile, $_POST['btime'],$userId);
		$this->redirect('index.php');
	}


}
?>