<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
    $con = new mysqli("localhost", "", "", "bazaar");

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare and execute the SQL query
    $sql = "SELECT email, password FROM admin WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the email and password match
    $isValid = false;
    while ($row = $result->fetch_assoc()) {
        if ($row['email'] === $username && $row['password'] === $password) {
            $isValid = true;
            break;
        }
    }

    if ($isValid) {
        $_SESSION['email'] = $username;
        $_SESSION['password'] = $password;
        header('Location: dashboard.php');
        exit();
    } else {
        echo "<script>alert('Invalid Email and Password');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
}
?>