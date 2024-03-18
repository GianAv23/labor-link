<?php
require 'dbphp.php';
if (isset($_POST["name"]) && isset($_POST["newpass"]) && isset($_POST["confirpass"]) && isset($_POST["submit"])) {
    if (cek_USERNAME($_POST["name"])) {
        $cek = update_NEW_PASSWORD($_POST["newpass"], $_POST["name"]);
        if($cek === "gagal"){
            header("Location: change_PASS.php");
            exit;
        }else{
            header("Location: login.php");
            exit;
        }
    } else {
        header("Location: change_PASS.php");
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
        <label for="a">Konfirmasi Username :</label>
        <input type="text" name="name" id="a" />
        <br />
        <label for="p">New Password :</label>
        <input type="password" name="newpass" id="p">
        <br />
        <label for="p2">Confirm New Password :</label>
        <input type="password" name="confirpass" id="p2">
        <br />
        <button type="submit" name="submit">Change Password</button>
        <br />
    </form>
</body>

</html>