<?php

session_start();
$isAuth = checkSession() || checkPost();

function checkSession(){
    if (isset($_SESSION["username"]) && isset($_SESSION["password"])){
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $con = new mysqli("localhost", "root", "", "bazaar");
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        $sql = "SELECT username, password FROM admin WHERE username = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        while ($row = $result->fetch_assoc()) {
            if ($row['username'] === $username && $row['password'] === $password) {
                $stmt->close();
                $con->close();
                return true;
            }
        }
        $stmt->close();
        $con->close();
    }
    return false;
}

function checkPost(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $con = new mysqli("localhost", "root", "", "bazaar");
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
    
        $sql = "SELECT username, password FROM admin WHERE username = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        while ($row = $result->fetch_assoc()) {
            if ($row['username'] === $username && $row['password'] === $password) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                $stmt->close();
                $con->close();
                return true;
            }
        }
        $stmt->close();
        $con->close();
    }
    return false;
}

if ($isAuth) {
    ?> 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../view/css/bootstrap.min.css" rel="stylesheet">
<script src="../view/js/jquery.min.js"></script>
<script src="../view/js/bootstrap.min.js"></script>
<style>
    table, th, td {
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-style: italic;
        border: 2px solid black;
        padding: 5px;
    }
</style>
</head>

<body>
<div align="center">
  <a href="index.php"><h1 class="style2" style="font-family:Georgia, 'Times New Roman', Times, serif">Administrator</h1></a>
  <p>&nbsp;</p>
  
<div class="col-sm-12 controls" style="margin-top: 10px;">
    <form action="logout.php" method="post">
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>
  <form id="form1" name="form1" method="post" action="">
    <table class="table table-striped table-bordered table-hover table-condensed" style="width: 50%">
      <tr>
        <th><div>Delete Product: </div></th>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th>
          <input type="text" class="form-control" name="pid" placeholder="Enter product ID" />
        </th>
        <td><input class="form-control" name="dltpr" type="submit" id="dltpr" value="Delete Product" /></td>
      </tr>
      <tr>
        <th><div>Delete User: </div></th>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th><div>
          <input type="text" class="form-control" name="uid" placeholder="Enter user ID" />
        </div></th>
        <td><input class="form-control" name="dltuser" type="submit" id="dltuser" value="Delete User" /></td>
      </tr>
      <tr>
        <th><div>Bidding time for Product </div></th>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th><div>
          <label>Product ID:&nbsp; &nbsp; 
          <input type="text" class="form-control" name="prid" placeholder="Enter product ID" style="width: 215px" />
          </label>
          <label>Date &amp; Time:
            <input type="text" class="form-control" name="bidtime" placeholder="YYYY-MM-DD hh:mm:ss" style="width: 305px" />
           </label>
        </div></th>
        <td><input class="form-control" name="btime" type="submit" id="btime" value="Update Time" /></td>
      </tr>
    </table>
  </form>
  <hr>
</div>
<div style="width: 100%">
<?php

$conn = new mysqli("localhost", "root", "", "bazaar");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//------------------delete product----------------------

if (isset($_POST['dltpr'])) {
    echo '<div style="width:49%; float:left;"><h2>Product Table</h2>';
    $id = $_POST['pid'];

    // Delete all bids associated with the product
    $sql = "DELETE FROM bid WHERE pid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Delete the product
    $sql = "DELETE FROM product WHERE pid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    $sql = "SELECT pid, title, price, btime FROM product ORDER BY pid";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '
        <table class="table table-striped table-bordered table-hover table-condensed" align="center" style="width:50%">
        <tr class="info">
        <th>ID</th>
        <th>Title</th>
        <th>Price</th>
        <th>Bidtime</th>
        </tr>';

        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
                <td>" . $row["pid"] . "</td><td>" . $row["title"] . "</td><td>" . $row["price"] . "</td><td>" . $row["btime"] . "</td>
            </tr>";
        }

        echo "</table></div>";
    } else {
        echo "0 results";
    }
    $stmt->close();
}

//--------------------delete user----------------------

elseif (isset($_POST['dltuser'])) {
    echo '<div style="width=49%; float:left;"><h2>User Table</h2>';
    $id = $_POST['uid'];

    // Delete all bids associated with the user's products
    $sql = "DELETE FROM bid WHERE pid IN (SELECT pid FROM product WHERE uid=?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    // Delete all products of the user
    $sql = "DELETE FROM product WHERE uid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    // Delete the user
    $sql = "DELETE FROM user WHERE uid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $sql = "SELECT uid, Email, password FROM user ORDER BY uid";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '
        <table class="table table-striped table-bordered table-hover table-condensed" align="center" style="width:50%">
        <tr class="info">
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>    
        </tr>';

        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
                <td>" . $row["uid"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["password"] . "</td>
            </tr>";
        }

        echo "</table></div>";
    } else {
        echo "0 results";
    }
    $stmt->close();
}

//-----------------------update bid time------------------------

elseif (isset($_POST['btime'])) {
    echo '<div style="width:49%; float:left;"><h2>Product Table</h2>';
    $id = $_POST['prid'];
    $btime = $_POST['bidtime'];    
    
    $sql = "UPDATE product SET btime=? WHERE pid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $btime, $id);
    $stmt->execute();
    
    $sql = "SELECT pid, title, price, btime FROM product ORDER BY pid";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '
        <table class="table table-striped table-bordered table-hover table-condensed" align="center" style="width:50%">
        <tr class="info">
        <th>ID</th>
        <th>Title</th>
        <th>Price</th>
        <th>Bidtime</th>
        </tr>';

        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
                <td>" . $row["pid"] . "</td><td>" . $row["title"] . "</td><td>" . $row["price"] . "</td><td>" . $row["btime"] . "</td>
            </tr>";
        }

        echo "</table></div>";
    } else {
        echo "0 results";
    }
    $stmt->close();
}

else {
    //--------------------------product---------------------------
    
    echo '<div style="width:49%; float:left;"><h2>Product Table</h2>';
    $sql = "SELECT pid, title, price, btime FROM product ORDER BY pid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '
        <table class="table table-striped table-bordered table-hover table-condensed" align="center" style="width:50%">
        <tr class="info">
        <th>ID</th>
        <th>Title</th>
        <th>Price</th>
        <th>Bidtime</th>
        </tr>';

        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
                <td>" . $row["pid"] . "</td><td>" . $row["title"] . "</td><td>" . $row["price"] . "</td><td>" . $row["btime"] . "</td>
            </tr>";
        }

        echo "</table></div>";
    } else {
        echo "0 results";
    }
    
    //------------------user----------------------------
    
    echo '<div style="width:49%; float:left;"><h2>User Table</h2>';
    $sql = "SELECT uid, Email, password FROM user ORDER BY uid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '
        <table class="table table-striped table-bordered table-hover table-condensed" align="center" style="width:50%">
        <tr class="info">
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        </tr>';

        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
                <td>" . $row["uid"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["password"] . "</td>
            </tr>";
        }

        echo "</table></div>";
    } else {
        echo "0 results";
    }
}
$conn->close();
?>
</div>
</body>
</html>
<?php
} else {
    ?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bazaar-Bid</title>
  <meta name="description" content="Source code generated using layoutit.com">
  <meta name="author" content="LayoutIt!">
  <link rel="icon" type="image/x-icon" href="assets/logo.svg">
  <style type="text/css">
    body {
      overflow-x: hidden;
    }
  </style>
  <link href="../view/css/bootstrap.min.css" rel="stylesheet">
  <link href="../view/css/style.css" rel="stylesheet">
  <script src="../view/js/jquery.min.js"></script>
  <script src="../view/js/bootstrap.min.js"></script>
  <script src="../view/js/scripts.js"></script>
</head>

<body>
  <div class="container"
    style="height: 100vh; width:100vw; overflow:hidden; background: url('../assets/banner.png') no-repeat center;background-size: cover;">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
      <div class="panel panel-info">
        <div class="panel-heading">
          <div class="panel-title">Sign In</div>
        </div>
        <div style="padding-top:30px" class="panel-body">
          <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
          <form action="./" method="post" id="loginform" class="form-horizontal" role="form">
            <div style="margin-bottom: 25px" class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input id="login-username" type="text" class="form-control" name="username" value=""
                placeholder="username or email" required>
            </div>
            <div style="margin-bottom: 25px" class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="login-password" type="password" class="form-control" name="password" placeholder="password" required>
            </div>
            <div style="margin-top:10px" class="form-group">
              <div class="col-sm-12 controls">
                <button type="submit" class="btn btn-success">Login</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php
}
?>


