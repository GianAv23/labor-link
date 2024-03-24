<?php
if (isset($_POST['id'])) {
    require_once 'open_connection.php';

    $id = $_POST['id'];

    $query_delete = "DELETE FROM list_kontak WHERE idKontak = ?";
    $stmt_delete = $connection->prepare($query_delete);
    $stmt_delete->execute([$id]);

    header('Location: http://localhost/labor-link/index.php');
    exit();
}