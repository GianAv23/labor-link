 <?php
    if (isset($_GET['edit_proses'])) {
        require_once 'open_connection.php';
        $nim = $_GET['nim'];
        $nama = $_GET['nama'];
        $prodi = $_GET['prodi'];

        $query = "SELECT * FROM mahasiswa WHERE nim = $nim";
        $result = $connection->prepare($query);
        $mahasiswa = $result->execute([$nama, $prodi, $nim]);
        $mahasiswa = $result->fetch(PDO::FETCH_ASSOC);
    } else if (isset($_POST['nim'])) {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $prodi = $_POST['prodi'];

        $query = "UPDATE mahasiswa SET nama = ?, prodi = ? WHERE nim = $nim";
        $result = $connection->prepare($query);
        $mahasiswa = $result->execute([$nama, $prodi, $nim]);

        // Redirect back to index.php after update
        header('Location: http://localhost/app_w6/index.php');
        exit();
    }
    ?>


 <?php
    $row = [];

    require_once 'open_connection.php';

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $query_select = "SELECT * FROM mahasiswa WHERE id = ?";

        $stmt = $connection->prepare($query_select);
        $data = [$id];
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // } else if (isset($_POST['nim'])) {
        //     $nim = $_POST['nim'];
        //     $nama = $_POST['nama'];
        //     $prodi = $_POST['prodi'];

        //     $query_update = "UPDATE mahasiswa SET nama = ?, prodi = ? FROM mahasiswa WHERE nim = ?";
        //     $result = $connection->prepare($query_update);
        //     $result->execute([$nim, $nama, $prodi]);
        //     // $stmt = $result->fetch(PDO::FETCH_ASSOC);


        //     // Redirect back to index.php after update
        //     header('Location: http://localhost/app_w6/index.php');
        //     exit();
    }
    ?>

 NIM: <?= $row['nim'] ?><br />
 Nama: <?= $row['nama'] ?><br />
 Prodi: <?= $row['prodi'] ?>

 <?php
    if (isset($_POST['delete_nim'])) {
        require_once 'open_connection.php';

        $nim_to_delete = $_POST['delete_nim'];

        // Ambil ID dari nim yang akan dihapus
        $query_get_id = "SELECT id FROM mahasiswa WHERE nim = ?";
        $stmt_get_id = $connection->prepare($query_get_id);
        $stmt_get_id->execute([$nim_to_delete]);
        $id_to_delete = $stmt_get_id->fetchColumn();

        // Hapus data mahasiswa dengan nim tertentu
        $query_delete = "DELETE FROM mahasiswa WHERE nim = ?";
        $stmt_delete = $connection->prepare($query_delete);
        $stmt_delete->execute([$nim_to_delete]);

        // Perbarui ID secara bertahap
        $query_update = "UPDATE mahasiswa SET id = id - 1 WHERE id > ?";
        $stmt_update = $connection->prepare($query_update);
        $stmt_update->execute([$id_to_delete]);

        header('Location: http://localhost/app_w6/index.php');
        exit();
    }


    
            <!-- NAMA START -->
            <!-- <div class="row mb-3">
                <label for="nama" class=""><strong>Nama</strong></label>
                <div>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $mahasiswa['nama'] ?>">
 </div>
 </div> -->
 <!-- NAMA END -->
 <!-- PRODI START -->
 <!-- <div class="row mb-3">
                <label for="prodi" class=""><strong>Prodi</strong></label>
                <div>
                    <input type="text" class="form-control" id="prodi" name="prodi" value="<?= $mahasiswa['prodi'] ?>">
                </div>
            </div> -->
 <!-- PRODI END -->



 <!-- BUTTON START -->
 <!-- <div class="d-grid gap-2 mt-4 shadow">
                <button class="btn btn-primary" type="submit" name="submit">
                    Submit
                </button>
            </div> -->
 <!-- BUTTON END -->

 <div class="flex justify-start gap-8 mb-10">
     <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
     <div class=" bg-black w-48 h-28 content-center rounded-xl p-3 shadow-sm">
         <!-- <span class="text-slate-900"><?= $row['nim'] ?></span><br> -->
         <span class="text-white"> <?= $row['nama'] ?></span><br>
         <span class="text-white"> <?= $row['prodi'] ?></span>
     </div>
     <?php } ?>
 </div>