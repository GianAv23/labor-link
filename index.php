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
                    textPerusahaan: "#D9D9D9",
                },
            }
        }
    }
    </script>

    <title>LaborLink</title>
</head>

<body>
    <div
        class="relative bg-bgColor h-screen w-screen pt-8 px-16 flex flex-col justify-start items-center overflow-hidden">

        <!-- ELLIIPSE START -->
        <img class="absolute z-0 top-0 left-0 w-screen" src="assets/blurellipse.svg" alt="">
        <!-- ELLIIPSE END -->

        <div class="container-fluid flex flex-col z-10">

            <!-- NAVBAR START -->
            <div
                class="relative bg-slate-500/30 px-2 flex rounded-full justify-between items-center w-[300px] h-12 mb-4 shadow-lg md:w-full">

                <!-- LOG OUT BUTTON START -->
                <div class="gap-3 absolute max-h-0 right-0 top-14" id="subModal" style="display:none ;">

                    <div class="modalProfile bg-cardData/80 backdrop-blur-sm rounded-xl p-3 items-center">
                        <form class="flex flex-col gap-2" method="post">
                            <div>
                                <span class="font-bold text-textColor text-lg"><?= $name ?></span>
                            </div>
                            <button class="bg-bgColor/80 rounded-full border-2 border-cardData/50 px-3 py-2"
                                type="submit" name="logout"><span class="text-cardData font-semibold text-sm">Log
                                    Out</span></button>
                        </form>
                    </div>
                </div>
                <!-- LOG OUT BUTTON END -->

                <div class="pl-2">
                    <span class="text-white font-bold">
                        Labor<span class="text-textColor2">Link</span>
                    </span>
                </div>


                <div class="py-1 px-5 border-2 border-white rounded-full cursor-pointer" onclick="toogleModal()">
                    <div>
                        <span class=" text-white font-medium" ">Hi, <span
                                class=" font-bold"><?= $name ?></span></span>
                    </div>
                </div>

            </div>
            <!-- NAVBAR END -->

            <!-- HEADER START -->
            <div class="mb-10">


                <div class="mb-4">
                    <span class=" text-white font-semibold">Recently Added</span>
                </div>

                <div class="flex flex-row">

                    <a class="bg-cardData/15 rounded-full px-6 py-3 text-white font-bold text-3xl items-center border-dashed border-2 mr-2 flex hover:bg-textColor"
                        href="insert_form.php">
                        <img class="h-6 w-6" src="assets/add_contact.svg" alt=""></a>



                    <div class="flex flex-row gap-2 overflow-x-scroll w-[210px] rounded-full md:w-[500px]">
                        <?php
                        foreach ($kontak_terbaru as $data) : ?>
                        <div
                            class="bg-cardData w-48 h-14 items-center px-2 rounded-full shadow-sm flex flex-row shrink-0">
                            <div class="rounded-full w-11 h-11 bg-cover bg-center mr-3"
                                style="background-image:url(<?= $data['foto_path'] ?>);">
                            </div>
                            <div class="flex flex-col gap-0">
                                <span
                                    class="flex justify-center bg-textPerusahaan/50 px-2 text-textColor/70 text-xs font-semibold rounded-full"><?= $data['nama_perusahaan'] ?></span>
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
            class="bg-bgCardColor/10 backdrop-blur-3xl w-screen h-screen border-2 border-none border-t-cardData border-r-cardData border-l-cardData rounded-t-3xl flex flex-col items-center pt-5 z-10 md:w-[600px] lg:w-[800px] lg:rounded-t-3xl border-gradient">

            <!-- SEARCH START -->
            <div class="mb-6">

                <input
                    class="text-cardData bg-bgColor/50 w-64 font-medium rounded-full px-3 py-1 border-2 border-textColor2/30"
                    id="live_search" autocomplete="off" type="text" placeholder="Search...">
            </div>
            <!-- SEARCH END -->

            <div id="result_not_found" style="display: none;"><span class="text-cardData font-semibold">Result not
                    found</span></div>

            <div
                class="flex flex-col flex-grow gap-4 overflow-y-scroll h-96 w-80 rounded-3xl mb-4 md:w-96 lg:h-96 lg:gap-6 lg:flex-grow md:flex-grow">
                <?php
                foreach ($data_kontak as $data) : ?>

                <div class=" bg-slate-50 h-48 w-full p-3 rounded-3xl flex flex-col shrink-0">

                    <div class="flex flex-row justify-between mr-2">
                        <!-- PROFILE PICTURE & NAME START -->
                        <div class="flex flex-row">
                            <div class="rounded-full w-14 h-14 bg-cover bg-center mr-2"
                                style="background-image:url(<?= $data['foto_path'] ?>);">
                            </div>

                            <div class="flex flex-col">
                                <span
                                    class="flex justify-center bg-textPerusahaan/50 px-2 text-textColor/70 text-base font-semibold rounded-full"><?= $data['nama_perusahaan'] ?></span>
                                <span id="name"
                                    class="font-bold text-textColor text-lg"><?= $data['nama_kontak'] ?></span>
                            </div>
                        </div>
                        <!-- PROFILE PICTURE & NAME END -->

                        <!-- BOOKMARK BUTTON -->
                        <div class="flex items-center justify-end">
                            <form action="" method="post">
                                <button class="bookmark-btn" type="submit" name="submit"
                                    value="<?= $data['idKontak'] ?>">
                                    <?php if ($data['book_mark'] == true) : ?>
                                    <img class="w-6 h-6" src="assets/bookmark-solid.svg" alt="Bookmarked">
                                    <?php else : ?>
                                    <img class="w-6 h-6" src="assets/bookmark-regular.svg" alt="Bookmark">
                                    <?php endif; ?>
                                </button>
                            </form>
                        </div>
                        <!-- BOOKMARK BUTTON -->




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
                                    class="w-36 h-8 bg-cardData rounded-full px-3 border-2 border-dashed border-textColor/50 flex flex-row items-center justify-center gap-2 hover:bg-cardData/5 md:w-44"
                                    type="submit">

                                    <img class="w-4 h-4" src="assets/deleteBtn.svg" alt="">
                                    <span class="text-textColor font-semibold">Delete</span></button>
                            </form>
                        </div>

                        <div>
                            <form method="post" action="edit_proses.php">
                                <!-- <input type="hidden" name="id" value="<?= $row['id'] ?>"> -->
                                <button
                                    class="w-36 h-8 bg-editBtn rounded-full px-3 text-white font-semibold flex flex-row items-center justify-center gap-2 hover:bg-editBtn/90 md:w-44"
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

    <script src="search_JS.js"></script>

    <script>
    let subModal = document.getElementById("subModal");

    function toogleModal() {
        if (subModal.style.display === "none") {
            subModal.style.display = "block";
        } else {
            subModal.style.display = "none";
        }
    }
    </script>

</body>

</html>