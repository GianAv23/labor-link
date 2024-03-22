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
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Contact | LaborLink</title>
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
</head>

<body>
    <div class="w-screen min-h-screen p-16 bg-bgColor">

        <!-- HEADER START -->
        <div class="flex flex-col gap-2 justify-center items-center mb-8">
            <!-- LOGO START -->
            <div class="bg-textColor/30 rounded-lg w-28 h-8 flex items-center justify-center">
                <span class="text-white font-bold">
                    Labor<span class="text-textColor2">Link</span>
                </span>
            </div>
            <!-- LOGO END -->
            <span class="text-cardData font-bold text-3xl">Edit Contact</span>
        </div>
        <!-- HEADER END -->

        <form class="flex flex-col gap-4" method="post" enctype="multipart/form-data">

            <div>
                <input type="hidden" name="id" value="<?= $userkontak['idKontak'] ?>">
            </div>

            <!-- NAMA KONTAK START -->
            <div class="flex flex-col gap-1">
                <div>
                    <label class="text-cardData font-semibold" for="nim">
                        Nama Kontak
                    </label>
                </div>

                <div>
                    <input class="rounded-lg w-full bg-textColor/50 py-3 px-4 text-cardData" id="nama_kontak"
                        type="text" name="nama_kontak" value="<?= $userkontak['nama_kontak'] ?>">
                </div>
            </div>
            <!-- NAMA KONTAK END -->


            <!-- NAMA PERUSAHAAN START -->
            <div class="flex flex-col gap-1">
                <div>
                    <label class="text-cardData font-semibold" for="nama">
                        Nama Perusahaan
                    </label>
                </div>
                <div>
                    <input class="rounded-lg w-full bg-textColor/50 py-3 px-4 text-cardData" id="nama_perusahaan"
                        type="text" name="nama_perusahaan" value="<?= $userkontak['nama_perusahaan'] ?>">
                </div>
            </div>
            <!-- NAMA PERUSAHAAN END -->

            <!-- NO TELP START -->
            <div class="flex flex-col gap-1">
                <div>
                    <label class=" text-cardData font-semibold" for="no_telp">
                        No. Telp
                    </label>
                </div>
                <div>
                    <input class="rounded-lg w-full bg-textColor/50 py-3 px-4 text-cardData" id="no_telp" type="text"
                        name="no_telp" value="<?= $userkontak['no_telp'] ?>">
                </div>
            </div>
            <!-- NO TELP END -->

            <!-- EMAIL START -->
            <div class="">
                <div>
                    <label class=" text-cardData font-semibold" for="email">
                        Email
                    </label>
                </div>
                <div>
                    <input class="rounded-lg w-full bg-textColor/50 py-3 px-4 text-cardData" id="email" type="text"
                        name="email" value="<?= $userkontak['email'] ?>">
                </div>
            </div>
            <!-- EMAIL END -->

            <!-- UPLOAD START -->
            <div class="mb-8 gap-4 flex flex-col">
                <label for="upload" class=" text-cardData font-semibold">Upload</label>
                <div class="bg-cover bg-center rounded-full border-2 border-cardData/50 border-dashed"
                    style="background-image: url('<?= $userkontak['foto_path'] ?>'); width: 100px; height: 100px;">
                </div>
                <div>
                    <input type="file" class="w-full text-sm text-slate-500 
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-textColor2 file:text-slate-900
                    hover:file:bg-textColor hover:file:text-cardData
                    " id="upload" name="upload" value="<?= $userkontak['foto_path'] ?>">
                    <!-- </form> -->
                </div>
            </div>
            <!-- UPLOAD END -->

            <!-- BUTTON START -->
            <div class="flex flex-row gap-2">

                <a href="index.php"
                    class="w-full shadow bg-textColor2/20 border-dashed border-2 border-cardData py-2 px-4 rounded-full text-center block">
                    <span class="text-cardData font-bold">Cancel</span>
                </a>




                <button class="w-full shadow bg-textColor2 py-2 px-4 rounded-full" type="submit" name="submit">
                    <span class="text-textColor font-bold">Submit</span>
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