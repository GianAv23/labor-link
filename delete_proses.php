<?php
if (isset($_POST['id'])) {
    require_once 'open_connection.php';

    $id = $_POST['id'];

    // Menghapus data dengan id tertentu
    $query_delete = "DELETE FROM list_kontak WHERE idKontak = ?";
    $stmt_delete = $connection->prepare($query_delete);
    $stmt_delete->execute([$id]);

    // Redirect ke halaman utama setelah penghapusan selesai
    header('Location: http://localhost/labor_link/index.php');
    exit();
}
