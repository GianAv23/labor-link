<?php
require 'dbphp.php';
$kontak_terbaru = list_RECENTLY($_SESSION["id"]);
$data_kontak = list_ALL_CONTACT($_SESSION["id"]);
$name = ambil_nama_user($_SESSION["id"]);
$idUser = $_SESSION["id"];

if (isset($_POST["submit"])) {
    $data_kontak = bookMARK_USER($_POST["submit"]);
    header("Location: index.php");
    exit;
}

 if(isset($_POST['logout'])) {
            require_once 'logout.php';
            header("Location: login.php");

            exit;
}

if(!isset($_SESSION['id'])){
    header("Location: login.php");

    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    bgColor: "#0D1529",
                    bgCardColor: "#C1C1C1",
                    cardData: "#EEEEEE",
                    editBtn: "#161E31",
                    textColor: "#173856",
                    textColor2: "#7DD8F5",
                },
            }
        }
    }
    </script>

    <title>Labor Link🚀</title>
</head>

<body>
    <div class="bg-bgColor h-screen w-screen pt-8 px-16 flex flex-col justify-start items-center overflow-hidden">

        <!-- ELLIIPSE START -->
        <img class="absolute z-0 top-0 left-0 w-screen h-full" src="assets/blurellipse.svg" alt="">
        <!-- ELLIIPSE END -->

        <div class="container-lg flex flex-col z-10">

            <!-- NAVBAR START -->
            <div
                class="bg-slate-500/30 px-2 flex rounded-full justify-between items-center w-[300px] h-12 mb-6 shadow-lg md:w-[500px]">
                <div class="pl-2">
                    <span class="text-white font-bold">
                        Labor<span class="text-textColor2">Link</span>
                    </span>
                </div>


                <div class="py-1 px-2 border-2 border-white rounded-full">
                    <div>
                        <span class="text-white">Hi, <?= $name ?></span>
                    </div>
                </div>
            </div>
            <!-- NAVBAR END -->

            <!-- HEADER START -->
            <div class="mb-12">

                <div>
                    <form method="post">
                        <button class="bg-red-400 text-white font-semibold px-2 items-center rounded-full" type="submit"
                            name="logout">Log Out</button>
                    </form>

                </div>
                <div class="mb-4">
                    <span class=" text-white font-semibold">Recently Added</span>
                </div>

                <div class="flex flex-row">

                    <!-- <form action="insert_form.php" method="">
                        <button
                            class="bg-cardData/15 rounded-full px-6 text-white font-bold text-3xl items-center border-dashed border-2 mr-2"
                            type="submit" name="inigua">
                            <img class="h-6 w-6" src="assets/add_contact.svg" alt=""></button>

                    </form> -->

                    <a class="bg-cardData/15 rounded-full px-6 py-3 text-white font-bold text-3xl items-center border-dashed border-2 mr-2 flex"
                        href="insert_form.php">
                        <img class="h-6 w-6" src="assets/add_contact.svg" alt=""></a>



                    <div class="flex flex-row gap-2 overflow-x-scroll w-[210px] rounded-full md:w-[500px]">
                        <?php
                        // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                        foreach ($kontak_terbaru as $data) : ?>
                        <div
                            class="bg-cardData w-48 h-14 items-center px-2 rounded-full shadow-sm flex flex-row shrink-0">
                            <div class="rounded-full w-11 h-11 bg-cover bg-center mr-3"
                                style="background-image:url(<?= $data['foto_path'] ?>);">
                            </div>
                            <div class="flex flex-col gap-0">
                                <span
                                    class="text-textColor text-xs font-semibold"><?= $data['nama_perusahaan'] ?></span>
                                <span class="text-textColor text-sm font-bold"> <?= $data['nama_kontak'] ?></span>
                                <!-- <span class="text-white"> <?= $data['prodi'] ?></span> -->
                            </div>
                        </div>
                        <?php endforeach; ?>


                    </div>
                </div>
            </div>
        </div>

        <!-- DATA START -->
        <div
            class="bg-bgCardColor/5 w-screen h-screen border-2 border-editBtn border-t-cardData border-r-cardData border-l-cardData rounded-t-3xl flex flex-col items-center pt-5 z-10">

            <!-- SEARCH START -->
            <div class="mb-5">

                <input
                    class="text-cardData bg-bgColor/50 w-64 font-medium rounded-full px-3 py-1 border-2 border-textColor2/30"
                    id="search" type="text" placeholder="Search...">
            </div>
            <!-- SEARCH END -->


            <div class="flex flex-col gap-4 overflow-y-scroll h-64 w-80 rounded-3xl">
                <?php
                //$stmt->execute();
                // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                foreach ($data_kontak as $data) : ?>

                <div class="bg-slate-50 h-48 w-80 p-3 rounded-3xl flex flex-col shrink-0">

                    <div class="flex flex-row justify-between mr-2">
                        <!-- PROFILE PICTURE & NAME START -->
                        <div class="flex flex-row">
                            <div class="rounded-full w-14 h-14 bg-cover bg-center mr-2"
                                style="background-image:url(<?= $data['foto_path'] ?>);">
                            </div>

                            <div class="flex flex-col">
                                <span
                                    class="font-semibold text-textColor text-md"><?= $data['nama_perusahaan'] ?></span>
                                <span id="name"
                                    class="font-bold text-textColor text-lg"><?= $data['nama_kontak'] ?></span>
                            </div>
                        </div>

                        <!-- PROFILE PICTURE & NAME START -->
                        <div class="flex items-center justify-end">
                            <form action="" method="post">
                                <button class="" type="submit" name="submit"
                                    value="<?= $data['idKontak'] ?>">bookmark</button>
                            </form>

                            <!-- <img src="assets/bookmark-regular.svg" class="w-5" alt=""> -->
                        </div>


                    </div>

                    <div class="flex flex-col mt-4">
                        <span><?= $data['no_telp'] ?></span>
                        <span><?= $data['email'] ?></span>
                    </div>

                    <div class="flex flex-row mt-4 justify-between">
                        <div>
                            <form method="post" action="delete_proses.php">
                                <input type="hidden" name="id" value="<?= $data['idKontak'] ?>">
                                <button
                                    class="w-36 h-8 bg-cardData rounded-full px-3 border-2 border-dashed border-textColor/50 flex flex-row items-center justify-center gap-2"
                                    type="submit">

                                    <img class="w-4 h-4" src="assets/deleteBtn.svg" alt="">
                                    <span class="text-textColor font-semibold">Delete</span></button>
                            </form>
                        </div>

                        <div>
                            <form method="post" action="edit_proses.php">
                                <!-- <input type="hidden" name="id" value="<?= $row['id'] ?>"> -->
                                <button
                                    class="w-36 h-8 bg-editBtn rounded-full px-3 text-white font-semibold flex flex-row items-center justify-center gap-2"
                                    type="submit" name="iniupdate" value="<?= $data['idKontak'] ?>">

                                    <img class="w-4 h-4" src="assets/editBtn.svg" alt="">

                                    <span class="text-white font-semibold">Edit</span></button>
                            </form>
                        </div>


                    </div>
                </div>

                <?php endforeach; ?>
            </div>

        </div>
        <!-- DATA END -->
    </div>




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


    <script src="script.js"></script>
    <script src="dataTables.js"></script>
    <script src="dataTablesTailwind.js"></script>
    <script src="search_JS.js"></script>
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

</body>

</html>