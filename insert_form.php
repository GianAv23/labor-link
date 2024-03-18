<?php
session_start();
if (isset($_POST['submit'])) {
    require_once 'open_connection.php';

    // $idKontak = $_POST['idKontak'];
    $nama_kontak = strval($_POST['nama_kontak']);
    $nama_perusahaan = $_POST['nama_perusahaan'];
    $no_telp = $_POST['no_telp'];
    $email = $_POST['email'];

    // Upload foto
    $target_dir = "file_upload/"; // Folder tempat menyimpan foto
    $target_file = $target_dir . basename($_FILES["upload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["upload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }
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
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    }

    // Simpan path foto ke database jika upload sukses
    if ($uploadOk == 1) {

        $foto_path = $target_file;
        $query = "INSERT INTO list_kontak (nama_kontak, nama_perusahaan, no_telp, email, foto_path, idUSER) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->execute([$nama_kontak, $nama_perusahaan, $no_telp, $email, $foto_path, $_SESSION['id']]);

        // $stmt->execute([$nama_kontak, $nama_perusahaan, $no_telp, $email, $foto_path, $_POST['inigua']]);

        
        if ($stmt->rowCount() > 0) {
            header("Location: http://localhost/labor_link/index.php");
            exit();
        } else {
            echo "Gagal menyimpan data.";
        }
    }

    $stmt = null;
    $connection = null;
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
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
    <title>Insert Proses PHP</title>
    <style>
    body {
        font-family: 'Figtree', sans-serif;
        background-color: #f5f5f5;
    }
    </style>
</head>

<body>
    <div class="w-screen h-screen p-16 bg-bgColor">

        <!-- ELLIIPSE START -->
        <!-- <img class="absolute z-0 top-0 left-0 w-screen h-full" src="assets/blurellipse.svg" alt=""> -->
        <!-- ELLIIPSE END -->

        <div class="container-lg flex flex-col z-10">

            <!-- LOGO START -->
            <div class="bg-textColor/30 rounded-lg w-28 h-8 flex items-center justify-center mb-4">
                <span class="text-white font-bold">
                    Labor<span class="text-textColor2">Link</span>
                </span>


            </div>
            <!-- LOGO END -->


            <!-- HEADER START -->
            <div class="mb-4">
                <span class="text-cardData font-bold text-2xl">Add New Contact</span>
            </div>
            <!-- HEADER END -->


            <form class="flex flex-col gap-6" method="post" enctype="multipart/form-data">
                <!-- NAMA KONTAK START -->
                <div class="">
                    <div>
                        <label class="text-cardData font-medium" for="nama_kontak">
                            Nama Kontak
                        </label>
                    </div>
                    <div>
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-slate-500"
                            id="nama_kontak" type="text" name="nama_kontak">
                    </div>
                </div>
                <!-- NAMA KONTAK END -->

                <!-- NAMA PERUSAHAAN START -->
                <div class="">
                    <div>
                        <label class=" text-cardData font-medium" for="nama_perusahaan">
                            Nama Perusahaan
                        </label>
                    </div>
                    <div>
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-slate-500"
                            id="nama_perusahaan" type="text" name="nama_perusahaan">
                    </div>
                </div>
                <!-- NAMA PERUSAHAAN END -->

                <!-- NO TELP START -->
                <div class="">
                    <div>
                        <label class=" text-cardData font-medium" for="prodi">
                            No. Telp
                        </label>
                    </div>
                    <div>
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-slate-500"
                            id="no_telp" type="text" name="no_telp">
                    </div>
                </div>
                <!-- NO TELP END -->

                <!-- EMAIL START -->
                <div class="">
                    <div>
                        <label class=" text-cardData font-medium" for="email">
                            Email
                        </label>
                    </div>
                    <div>
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-slate-500"
                            id="email" type="text" name="email">
                    </div>
                </div>
                <!-- EMAIL END -->

                <!-- UPLOAD START -->
                <div class="mb-4 gap-2 flex flex-col">
                    <label for="upload" class="text-cardData font-medium">Upload</label>
                    <div>

                        <input type="file" class="w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-slate-200 file:text-slate-900
                    hover:file:bg-violet-100
                    " id="upload" name="upload">

                    </div>
                </div>
                <!-- UPLOAD END -->

                <!-- BUTTON START -->
                <div class="">

                    <button
                        class="w-full shadow bg-blue-500 hover:bg-blue-900 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-lg"
                        type="submit" name="submit">
                        Submit
                    </button>

                </div>

                <!-- BUTTON END -->
        </div>
    </div>

    </form>


    <?php
    // require 'dbphp.php';
    // if (isset($_POST['submit'])) {
    //     require_once 'open_connection.php';

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

    //     // Check if image file is a actual image or fake image
    //     if (isset($_POST["submit"])) {
    //         $check = getimagesize($_FILES["upload"]["tmp_name"]);
    //         if ($check !== false) {
    //             $uploadOk = 1;
    //         } else {
    //             echo "File bukan gambar.";
    //             $uploadOk = 0;
    //         }
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
    //         } else {
    //             echo "Maaf, terjadi kesalahan saat mengunggah file.";
    //         }
    //     }

    //     // Simpan path foto ke database jika upload sukses
    //     if ($uploadOk == 1) {

    //         $foto_path = $target_file;
    //         $query = "INSERT INTO list_kontak (nama_kontak, nama_perusahaan, no_telp, email, foto_path, idUSER) VALUES (?, ?, ?, ?, ?, ?)";
    //         $stmt = $connection->prepare($query);
    //         $stmt->execute([$nama_kontak, $nama_perusahaan, $no_telp, $email, $foto_path, $_SESSION['id']]);
    //         // $stmt->execute([$nama_kontak, $nama_perusahaan, $no_telp, $email, $foto_path, $_POST['inigua']]);


    //     }

    //     $stmt = null;
    //     $connection = null;
    // }
    ?>



    </div>
</body>

</html>