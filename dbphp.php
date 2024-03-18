<?php
session_start();
$dsn = "mysql:host=localhost;dbname=labor_link";
$kunci = new PDO($dsn, "root", "");


function cek_USER_and_PASS($name, $pass)
{
    global $kunci;
    $name = strval($name);
    $pass = strval($pass);
    $sql_LOGIN = "SELECT * FROM data_user";
    $list_User = $kunci->query($sql_LOGIN);
    $enpass = password_hash($pass, PASSWORD_BCRYPT);
    while ($data_db = $list_User->fetch(PDO::FETCH_ASSOC)) {
        if ($data_db['user_name'] == $name && password_verify($pass, $data_db['user_password'])) {
            $_SESSION["id"] = $data_db['idUSER'];
            return true;
        }
    }
    return false;
}


function cek_USERNAME($name)
{
    $name = strval($name);
    if ($name === "") {
        return false;
    }
    global $kunci;
    $sql_CHECKUSERNAME = "SELECT user_name FROM data_user WHERE user_name = '$name'";
    $result_query = $kunci->query($sql_CHECKUSERNAME);
    $result_name = $result_query->fetch(PDO::FETCH_ASSOC);
    if ($result_name["user_name"] == $name) {
        return true;
    }
    return false;
}


function update_NEW_PASSWORD($newPASS, $nameUser)
{
    global $kunci;
    $newPASS = strval($newPASS);
    if(strlen($newPASS) < 8){
        return "gagal";//ini pesan error isi aja sendiri
    }
    $nameUser = strval($nameUser);
    $newENCRYP_PASS = password_hash($newPASS, PASSWORD_BCRYPT);
    $sql_CHANGE_PASS = "UPDATE data_user SET user_password = '$newENCRYP_PASS' WHERE user_name = '$nameUser'";
    $result_query = $kunci->query($sql_CHANGE_PASS);
    return "berhasil";
}


function create_NEWUSER($name, $pass)
{
    global $kunci;
    $name = strval($name);
    $pass = strval($pass);
    if(strlen($pass) < 8){
        return "gagal"; // isi sendiri buat signup error message password
    }
    $sql_MAXID = "SELECT MAX(idUSER) FROM data_user";
    $maxID = $kunci->query($sql_MAXID);
    $numID = $maxID->fetch(PDO::FETCH_ASSOC);
    $newID = intval($numID["MAX(idUSER)"]) + 1;
    $newENCRYP_PASS = password_hash($pass, PASSWORD_BCRYPT);
    $sql_CREATEUSER = "INSERT INTO data_user VALUES ( '$newID' , '$name' , '$newENCRYP_PASS' )";
    $kunci->query($sql_CREATEUSER);
    return "berhasil";
}


function list_ALL_CONTACT($id)
{
    global $kunci;
    $id = intval($id);
    $sql_LISTCONTACT = "SELECT * FROM list_kontak WHERE idUSER = $id ORDER BY book_mark DESC";
    $allOfList = [];
    $querLIST = $kunci->query($sql_LISTCONTACT);
    while ($row = $querLIST->fetch(PDO::FETCH_ASSOC)) {
        $allOfList[] = $row;
    }
    return $allOfList;
}


function bookMARK_USER($idBookMark)
{
    global $kunci;
    $idBookMark = intval($idBookMark);
    $sql_BOOKMARK = "UPDATE list_kontak
    SET list_kontak.book_mark =
    (CASE
    WHEN list_kontak.book_mark = true THEN false
    ELSE true
    END)
    WHERE list_kontak.idKontak = $idBookMark";
    $allOfList = [];
    $querLIST = $kunci->query($sql_BOOKMARK);
    while ($row = $querLIST->fetch(PDO::FETCH_ASSOC)) {
        $allOfList[] = $row;
    }
    return $allOfList;
}

function ambil_nama_user($id)
{
    $id = intval($id);
    global $kunci;
    $query = "SELECT user_name FROM data_user WHERE idUSER = $id";
    $result_query = $kunci->query($query);
    $name = $result_query->fetch(PDO::FETCH_ASSOC);
    if ($name !== "") {
        return $name["user_name"];
    } else {
        return "";
    }
}

function list_RECENTLY($id){
    global $kunci;
    $id = intval($id);
    $sql_RECENTLYADD = "SELECT * FROM list_kontak WHERE idUSER = $id ORDER BY idKontak DESC";
    $allOfList = [];
    $querLIST = $kunci->query($sql_RECENTLYADD);
    while( $row = $querLIST->fetch(PDO::FETCH_ASSOC) ){
        $allOfList[] = $row;
    }
    return $allOfList;
}