<?php
session_start();

$error_message = '';

if (isset($_POST['submit'])) {
    require_once 'open_connection.php';
    $nama_kontak = strval($_POST['nama_kontak']);
    $nama_perusahaan = strval($_POST['nama_perusahaan']);
    $no_telp = strval($_POST['no_telp']);
    $email = strval($_POST['email']);

    $target_dir = "file_upload/"; 
    $target_file = $target_dir . basename($_FILES["upload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if(empty($nama_kontak) || empty($nama_perusahaan) || empty($no_telp) || empty($email) || empty($target_file)){
    $error_message = "All fields must be completed";
    $uploadOk = 0;
}

    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "svg" && $imageFileType != "gif"
    ) {
        $error_message = "Please upload files in JPG, PNG, JPEG, SVG, or GIF format";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $error_message = "Upload error & all fields must be completed";

    } else {
        if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
            echo "Foto " . htmlspecialchars(basename($_FILES["upload"]["name"])) . " berhasil diunggah.";
        } else {
            $error_message = "Error uploading, try again";
        }
    }

    if ($uploadOk == 1) {

        $foto_path = $target_file;
        $query = "INSERT INTO list_kontak (nama_kontak, nama_perusahaan, no_telp, email, foto_path, idUSER) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->execute([$nama_kontak, $nama_perusahaan, $no_telp, $email, $foto_path, $_SESSION['id']]);

        if ($stmt->rowCount() > 0) {
            header("Location: http://localhost/labor-link/index.php");
            exit();
        } else {
            $error_message = "Gagal menyimpan data";
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
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Add Contact | LaborLink</title>
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
    <div class="w-screen min-h-screen">

        <div class="absolute bg-bgColor/95">

            <!-- ELLIIPSE START -->
            <img class="absolute z-0 top-0 left-0 w-screen h-screen" src="assets/blurellipse.svg" alt="">
            <!-- ELLIIPSE END -->

            <div class="w-screen min-h-screen flex flex-col justify-center py-10 px-8">
                <!-- HEADER START -->
                <div class="z-10 flex flex-col gap-2 justify-center items-center mb-8">
                    <!-- LOGO START -->
                    <div class="bg-textColor/30 rounded-lg w-28 h-8 flex items-center justify-center">
                        <span class="text-white font-bold">
                            Labor<span class="text-textColor2">Link</span>
                        </span>
                    </div>
                    <!-- LOGO END -->
                    <span class="text-cardData font-bold text-3xl">Add Contact</span>
                </div>
                <!-- HEADER END -->

                <form class="z-10 flex flex-col gap-6 mt-8 md:px-44 lg:px-64 xl:px-80" method="post"
                    enctype="multipart/form-data">

                    <!-- ERROR MESSAGE START -->
                    <?php if (!empty($error_message)) : ?>
                    <div id="error-message" class="flex p-3 justify-center bg-textColor2/30 rounded-lg">
                        <span class="text-textColor2 font-medium text-sm flex text-center"><?= $error_message ?></span>
                    </div>
                    <?php endif; ?>
                    <!-- ERROR MESSAGE END -->

                    <!-- NAMA KONTAK START -->
                    <div class="flex flex-col gap-1">
                        <div>
                            <label class="text-cardData font-semibold" for="nama_kontak">
                                Nama Kontak
                            </label>
                        </div>
                        <div>
                            <input
                                class="rounded-xl w-full bg-textColor/80 py-3 px-4 text-cardData border border-textColor2/60"
                                id="nama_kontak" type="text" name="nama_kontak">
                        </div>
                    </div>
                    <!-- NAMA KONTAK END -->

                    <!-- NAMA PERUSAHAAN START -->
                    <div class="">
                        <div>
                            <label class=" text-cardData font-semibold" for="nama_perusahaan">
                                Nama Perusahaan
                            </label>
                        </div>
                        <div>
                            <input
                                class="rounded-xl w-full bg-textColor/80 py-3 px-4 text-cardData border border-textColor2/60"
                                id="nama_perusahaan" type="text" name="nama_perusahaan">
                        </div>
                    </div>
                    <!-- NAMA PERUSAHAAN END -->

                    <!-- NO TELP START -->
                    <div class="">
                        <div>
                            <label class=" text-cardData font-semibold" for="prodi">
                                No. Telp
                            </label>
                        </div>
                        <div>
                            <input
                                class="rounded-xl w-full bg-textColor/80 py-3 px-4 text-cardData border border-textColor2/60"
                                id="no_telp" type="text" name="no_telp">
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
                            <input
                                class="rounded-xl w-full bg-textColor/80 py-3 px-4 text-cardData border border-textColor2/60"
                                id="email" type="text" name="email">
                        </div>
                    </div>
                    <!-- EMAIL END -->

                    <!-- UPLOAD START -->
                    <div class="mb-4 gap-2 flex flex-col">
                        <label for="upload" class="text-cardData font-semibold">Upload</label>
                        <div>

                            <input type="file" class="w-full text-sm text-slate-500 
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-textColor2 file:text-slate-900
                    hover:file:bg-textColor hover:file:text-cardData
                    " id="upload" name="upload">

                        </div>
                    </div>
                    <!-- UPLOAD END -->

                    <!-- BUTTON START -->
                    <div class="flex flex-row gap-6">

                        <a href="index.php"
                            class="w-full shadow bg-textColor2/20 border-dashed border-2 border-cardData py-2 px-4 rounded-full text-center blockqq hover:bg-textColor/80">
                            <span class="text-cardData font-bold">Cancel</span>
                        </a>

                        <button
                            class="w-full shadow bg-textColor2 py-2 px-4 rounded-full font-bold hover:bg-textColor2/40 hover:text-textColor2"
                            type="submit" name="submit">
                            <span>Submit</span>
                        </button>

                    </div>

                    <!-- BUTTON END -->
            </div>

            </form>



        </div>
</body>

</html>