<?php
session_start();
require_once 'open_connection.php';
$userkontak;
if (isset($_POST['iniupdate'])) {

    $id = $_POST['iniupdate'];

    $query_select = "SELECT * FROM list_kontak WHERE idKontak = ?";
    $stmt = $connection->prepare($query_select);
    $stmt->execute([$id]);
    global $userkontak;
    $userkontak = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['submit'])) {
    // global $userkontak;
    $idKontak = $_POST['id'];
    $nama_kontak = $_POST['nama_kontak'];
    $nama_perusahaan = $_POST['nama_perusahaan'];
    $no_telp = $_POST['no_telp'];
    $email = $_POST['email'];

    // Upload foto
    $target_dir = "file_upload/"; // Folder tempat menyimpan foto
    $target_file = $target_dir . basename($_FILES["upload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file was uploaded successfully
    if ($_FILES["upload"]["error"] == UPLOAD_ERR_OK) {
        // Check if file is an actual image
        $check = getimagesize($_FILES["upload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "svg"
        && $imageFileType != "gif"
    ) {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Maaf, file tidak terunggah.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
            echo "Foto " . htmlspecialchars(basename($_FILES["upload"]["name"])) . " berhasil diunggah.";


            // Simpan path foto ke database jika upload sukses
            $foto_path = $target_file;
            $query =
                "UPDATE list_kontak SET nama_kontak = ?, nama_perusahaan = ?, no_telp = ?, email = ?, foto_path = ? WHERE idKontak = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$nama_kontak, $nama_perusahaan, $no_telp, $email, $foto_path, $idKontak]);

            if ($stmt->rowCount() > 0) {
                header('Location: index.php');
                exit();
            } else {
                echo "Gagal menyimpan data.";
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <title>Edit Proses PHP</title>
    <style>
    body {
        font-family: 'Figtree', sans-serif;
        background-color: #f5f5f5;
    }
    </style>
</head>

<body>
    <div class="w-screen h-screen p-20">
        <form class="flex flex-col gap-6" method="post" enctype="multipart/form-data">

            <div>
                <input type="hidden" name="id" value="<?= $userkontak['idKontak'] ?>">
            </div>

            <!-- NAMA KONTAK START -->
            <div class="">
                <div>
                    <label class=" text-slate-900 font-bold" for="nim">
                        Nama Kontak
                    </label>
                </div>
                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-slate-500"
                        id="nama_kontak" type="text" name="nama_kontak" value="<?= $userkontak['nama_kontak'] ?>">
                </div>
            </div>
            <!-- NAMA KONTAK END -->


            <!-- NAMA PERUSAHAAN START -->
            <div class="">
                <div>
                    <label class=" text-slate-900 font-bold" for="nama">
                        Nama Perusahaan
                    </label>
                </div>
                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-slate-500"
                        id="nama_perusahaan" type="text" name="nama_perusahaan"
                        value="<?= $userkontak['nama_perusahaan'] ?>">
                </div>
            </div>
            <!-- NAMA PERUSAHAAN END -->



            <!-- NO TELP START -->
            <div class="">
                <div>
                    <label class=" text-slate-900 font-bold" for="prodi">
                        No. Telp
                    </label>
                </div>
                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-slate-500"
                        id="no_telp" type="text" name="no_telp" value="<?= $userkontak['no_telp'] ?>">
                </div>
            </div>
            <!-- NO TELP END -->

            <!-- EMAIL START -->
            <div class="">
                <div>
                    <label class=" text-slate-900 font-bold" for="prodi">
                        Email
                    </label>
                </div>
                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-slate-500"
                        id="email" type="text" name="email" value="<?= $userkontak['email'] ?>">
                </div>
            </div>
            <!-- EMAIL END -->

            <!-- UPLOAD START -->
            <div class="mb-8 gap-2 flex flex-col">
                <label for="upload" class="font-bold">Upload</label>
                <div>

                    <input type="file" class="w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-slate-200 file:text-slate-900
                    hover:file:bg-violet-100
                    " id="upload" name="upload" value="<?= $userkontak['foto_path'] ?>">
                    <!-- </form> -->
                </div>
            </div>
            <!-- UPLOAD END -->

            <!-- BUTTON START -->
            <div class="">

                <button
                    class="w-full shadow bg-blue-500 hover:bg-blue-900 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                    type="submit" name="submit">
                    Submit
                </button>

            </div>

            <!-- BUTTON END -->
        </form>
        <?php
        // if (isset($_POST['submit'])) {
        //     // $idKontak = $_POST['idKontak'];
        //     $nama_kontak = $_POST['nama_kontak'];
        //     $nama_perusahaan = $_POST['nama_perusahaan'];
        //     $no_telp = $_POST['no_telp'];
        //     $email = $_POST['email'];

        //     // Upload foto
        //     $target_dir = "file_upload/"; // Folder tempat menyimpan foto
        //     $target_file = $target_dir . basename($_FILES["upload"]["name"]);
        //     $uploadOk = 1;
        //     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        //     // Check if file was uploaded successfully
        //     if ($_FILES["upload"]["error"] == UPLOAD_ERR_OK) {
        //         // Check if file is an actual image
        //         $check = getimagesize($_FILES["upload"]["tmp_name"]);
        //         if ($check !== false) {
        //             $uploadOk = 1;
        //         } else {
        //             echo "File bukan gambar.";
        //             $uploadOk = 0;
        //         }
        //     } else {
        //         echo "Maaf, terjadi kesalahan saat mengunggah file.";
        //         $uploadOk = 0;
        //     }

        //     // Allow certain file formats
        //     if (
        //         $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "svg"
        //         && $imageFileType != "gif"
        //     ) {
        //         echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        //         $uploadOk = 0;
        //     }

        //     // Check if $uploadOk is set to 0 by an error
        //     if ($uploadOk == 0) {
        //         echo "Maaf, file tidak terunggah.";
        //         // if everything is ok, try to upload file
        //     } else {
        //         if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
        //             echo "Foto " . htmlspecialchars(basename($_FILES["upload"]["name"])) . " berhasil diunggah.";


        //             // Simpan path foto ke database jika upload sukses
        //             $foto_path = $target_file;
        //             $query =
        //                 "UPDATE list_kontak SET nama_kontak = ?, nama_perusahaan = ?, no_telp = ?, email = ?, foto_path = ? WHERE idKontak = ?";
        //             $stmt = $connection->prepare($query);
        //             $stmt->execute([$nama_kontak, $nama_perusahaan, $no_telp, $email, $foto_path]);

        //             if ($stmt->rowCount() > 0) {
        //                 header('Location: index.php');
        //                 exit();
        //             } else {
        //                 echo "Gagal menyimpan data.";
        //             }
        //         } else {
        //             echo "Maaf, terjadi kesalahan saat mengunggah file.";
        //         }
        //     }
        // }
        ?>


    </div>
</body>

</html>