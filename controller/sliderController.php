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
		$cat;
		$slidermodalobj = new sliderModel();
		$p = $slidermodalobj -> upload();
		$name = $_SESSION['user'];
		$conn = new mysqli("localhost", "root", "", "bazaar");
		$sql = "SELECT * FROM user WHERE Email = '$name'";
		$result = $conn -> query($sql);
		$userId = mysqli_fetch_array($result)[0];
		$slidermodalobj -> submitadd($_POST['Title'], $_POST['Description'], $_POST['price'], $_POST['Category'], $p, $_POST['name'], $_POST['email'], $_POST['number'], $_POST['btime'],$userId);
		$this->redirect('index.php');
	}

}
?>