<?php
require 'dbphp.php';

$error_message = '';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $passw = $_POST["passw"];

    if (empty($name) || empty($passw)) {
        $error_message = "Username and password are required";
    } else {
        if (cek_USER_and_PASS($name, $passw)) {
            header("Location: index.php");
            exit;
        } else {
            $error_message = "Invalid username or password";
        }
    }
}

?>