 *{
 font-size: Figtree;
 }

 div.overflow-x-scroll {
 scrollbar-width: none;
 }

 div.overflow-y-scroll {
 scrollbar-width: none;
 }

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

 <!-- <script>
        // Fungsi untuk menyimpan status bookmark ke dalam localStorage
        function setBookmarkStatus(rowId, status) {
            localStorage.setItem(rowId, status);
        }

        // Fungsi untuk mendapatkan status bookmark dari localStorage
        function getBookmarkStatus(rowId) {
            return localStorage.getItem(rowId);
        }

        // Fungsi untuk mengubah tampilan ikon bookmark dan mengatur urutan baris
        function toggleBookmark(id) {
            var regular = document.getElementById('bookmark-regular-' + id);
            var solid = document.getElementById('bookmark-solid-' + id);
            var row = document.getElementById('row-' + id);

            // Toggle display property
            regular.style.display = regular.style.display === 'none' ? 'inline' : 'none';
            solid.style.display = solid.style.display === 'none' ? 'inline' : 'none';

            // Simpan atau hapus status bookmark dari localStorage
            if (regular.style.display === 'none') {
                setBookmarkStatus('row-' + id, 'bookmarked');
                // Pindahkan baris ke atas
                row.parentNode.insertBefore(row.parentNode.firstChild);
            } else {
                setBookmarkStatus('row-' + id, 'unbookmarked');
            }
        }

        // Fungsi untuk memeriksa status bookmark saat halaman dimuat
        window.onload = function() {
            for (var i = 1; i <= totalRows; i++) {
                var status = getBookmarkStatus('row-' + i);
                if (status === 'bookmarked') {
                    // Pindahkan baris ke atas
                    var row = document.getElementById('row-' + i);
                    row.parentNode.insertBefore(row, row.parentNode.firstChild);
                }
            }
        }
    </script> -->

 <!-- HEADER END -->

 <!-- <h1 class="font-bold text-2xl mb-5 text-center">TEKKOM MANAGER</h1> -->

 <!-- <div class="bg-slate-200 p-5 rounded-2xl">
                <table id="example" class="display" style="width:100%">
                    <button
                        class="flex flex-wrap border rounded-lg bg-slate-200 py-2 px-3 mb-4 shadow-lg place-items-center"
                        onclick="window.location.href = 'insert_form.php';">
                        <span>Add Mahasiswa</span>
                    </button>

                    <thead>
                        <tr>
                            <th class="rounded-l-lg">NIM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th class="rounded-r-lg">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once 'open_connection.php';

                        $query = "SELECT * FROM mahasiswa";

                        $stmt = $connection->query($query);

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr id="row-<?= $row['id'] ?>">
                            <td class="rounded-l-lg"><?= $row['nim'] ?></td>
                            <td class="flex flex-row gap-3">
                                <img src="<?= $row['foto_path'] ?>" class="rounded-full w-7 h-7 bg-cover" alt="">

                                <?= $row['nama'] ?>

                            </td>
                            <td><?= $row['prodi'] ?></td>
                            <td class="rounded-r-lg flex flex-row gap-10">
                                <form method="post" action="delete_proses.php">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit">Delete</button>
                                </form>



                                <a href="edit_proses.php?id=<?= $row['id'] ?>">Edit</a>



                                <img id="bookmark-regular-<?= $row['id'] ?>" src="assets/bookmark-regular.svg"
                                    class="w-5" onclick="toggleBookmark(<?= $row['id'] ?>)">


                                <img id="bookmark-solid-<?= $row['id'] ?>" src="assets/bookmark-solid.svg" class="w-5"
                                    style="display: none;" onclick="toggleBookmark(<?= $row['id'] ?>)">
                            </td>
                        </tr>
                        <?php
                        }
                        $connection = null;
                        ?>
                    </tbody>
                </table>
            </div> -->


 <!-- <script src="script.js"></script> -->
 <!-- <script src="dataTables.js"></script> -->
 <!-- <script src="dataTablesTailwind.js"></script> -->
 <!-- <script src="search_JS.js"></script> -->


 // if (isset($_POST["submit"])) {
 // $check = getimagesize($_FILES["upload"]["tmp_name"]);
 // if ($check !== false) {
 // $uploadOk = 1;
 // } else {
 // echo "File bukan gambar.";
 // $uploadOk = 0;
 // }
 // }