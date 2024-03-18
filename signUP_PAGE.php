<?php
require 'dbphp.php';
if (isset($_POST["name"]) && isset($_POST["passw1"]) && isset($_POST["passw2"]) && isset($_POST["signup"])) {
    if ($_POST["passw1"] === $_POST["passw2"] && $_POST["name"] !== ""  && $_POST["passw1"] !== "" && $_POST["passw2"] !== "") {
        $cek = create_NEWUSER($_POST["name"], $_POST["passw1"]);
        if($cek === "gagal"){
            header("Location: signUP_PAGE.php");
            EXIT;
        }else{
            header("Location: login.php");
            exit;
        }
    } else {
        header("Location: signUP_PAGE.php");
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
        <label for="a">Masukkan Username :</label>
        <input type="text" name="name" id="a" />
        <br />
        <label for="p1">Password :</label>
        <input type="password" name="passw1" id="p1">
        <br />
        <label for="p2">Password confirm :</label>
        <input type="password" name="passw2" id="p2">
        <br />
        <button type="submit" name="signup">Sign Up</button>
    </form>
</body>

</html>