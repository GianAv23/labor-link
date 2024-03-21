<?php
require 'dbphp.php';
if (isset($_POST["name"]) && isset($_POST["submit"]) && isset($_POST["passw"])) {
    if (cek_USER_and_PASS($_POST["name"], $_POST["passw"])) {
        header("Location: index.php");
        exit;
    } else {
        header("Location: login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <label for="a">Masukkan Usernameee :</label>
        <input type="text" name="name" id="a" />
        <br />
        <label for="p">Password :</label>
        <input type="password" name="passw" id="p">
        <br />
        <button type="submit" name="submit">Login</button>
        <br />
    </form>
    <a href="signUP_PAGE.php">Sign Up</a>
    <a href="change_PASS.php">Lupa Password</a>
</body>

</html>