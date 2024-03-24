<?php
require 'dbphp.php';

$error_message = '';

if (isset($_POST["name"]) && isset($_POST["newpass"]) && isset($_POST["confirpass"]) && isset($_POST["submit"])) {
    if (cek_USERNAME($_POST["name"])) {
        $cek = update_NEW_PASSWORD($_POST["newpass"], $_POST["name"]);
        if($cek === "gagal"){
            $error_message = "Failed to update password. Please try again.";
            // exit;
        }else{
            header("Location: login.php");
            exit;
        }
    } else {
        $error_message = "Username not found. Please check your username.";
        // exit;
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Change Pass | LaborLink</title>
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

        <img class="absolute w-screen h-full object-cover" src="assets/bgForm.png" alt="">

        <div class="absolute bg-bgColor/95">

            <!-- ELLIIPSE START -->
            <img class="absolute z-0 top-0 left-0 w-screen h-screen" src="assets/blurellipse.svg" alt="">
            <!-- ELLIIPSE END -->


            <div class="w-screen min-h-screen flex flex-col justify-center py-10 px-8">
                <!-- HEADER START -->
                <div class="flex flex-col gap-2 justify-center items-center mb-8">
                    <!-- LOGO START -->
                    <div class="bg-textColor/30 rounded-lg w-28 h-8 flex items-center justify-center">
                        <span class="text-white font-bold">
                            Labor<span class="text-textColor2">Link</span>
                        </span>
                    </div>
                    <!-- LOGO END -->

                    <span class="text-cardData font-bold text-3xl">Forgot Password</span>

                </div>
                <!-- HEADER END -->

                <form class="z-10 flex flex-col gap-6 md:px-44 lg:px-64 xl:px-80" method="post">

                    <!-- ERROR MESSAGE START -->
                    <?php if (!empty($error_message)) : ?>
                    <div id="error-message" class="flex p-3 justify-center bg-textColor2/30 rounded-lg">
                        <span class="text-textColor2 font-medium text-sm flex text-center"><?= $error_message ?></span>
                    </div>
                    <?php endif; ?>
                    <!-- ERROR MESSAGE END -->


                    <!-- USERNAME START -->
                    <div class="flex flex-col gap-1">
                        <div>
                            <label class="text-cardData font-semibold" for="a">
                                Username
                            </label>
                        </div>

                        <div>

                            <input type="text" name="name" id="a" placeholder="Enter your username"
                                class="rounded-xl w-full bg-textColor/80 py-3 px-4 text-cardData border border-textColor2/60">
                        </div>


                        <!-- <label for="a">Masukkan Username :</label>
                <input type="text" name="name" id="a" /> -->
                    </div>
                    <!-- USERNAME END -->

                    <!-- <label for="a">Konfirmasi Username :</label>
            <input type="text" name="name" id="a" />
            <br /> -->

                    <!-- PASSWORD START -->
                    <div class="flex flex-col gap-1">
                        <div>
                            <label class="text-cardData font-semibold" for="p">
                                New Password
                            </label>
                        </div>

                        <div>

                            <input type="password" name="newpass" id="p" placeholder="Enter new your password"
                                class="rounded-xl w-full bg-textColor/80 py-3 px-4 text-cardData border border-textColor2/60">
                        </div>

                        <div>
                            <span class="text-cardData font-medium text-xs">Min 8 Characters</span>
                        </div>

                    </div>
                    <!-- PASSWORD END -->

                    <!-- <label for="p">New Password :</label>
            <input type="password" name="newpass" id="p">
            <br /> -->


                    <!-- PASSWORD START -->
                    <div class="flex flex-col gap-1">
                        <div>
                            <label class="text-cardData font-semibold" for="p2">
                                New Password
                            </label>
                        </div>
                        <div class="relative">
                            <input type="password" name="newpass" id="p2" placeholder="Enter your password"
                                class="rounded-xl w-full bg-textColor/80 py-3 px-4 text-cardData border border-textColor2/60">
                            <input type="checkbox" id="showPassword"
                                class="absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer">
                            <label for="showPassword"
                                class="absolute top-1/2 right-10 transform -translate-y-1/2 text-sm text-textColor2 cursor-pointer">Show
                                password</label>
                        </div>
                    </div>
                    <!-- PASSWORD END -->


                    <!-- <label for="p2">Confirm New Password :</label>
            <input type="password" name="confirpass" id="p2">
            <br /> -->

                    <div class="mt-6">
                        <button type="submit" name="submit"
                            class="bg-textColor2 w-full py-2 rounded-full text-textColor font-bold hover:bg-textColor2/40 hover:text-textColor2"><span>Change
                                Password</span>
                        </button>
                    </div>



                    <!-- <button type=" submit" name="submit">Change Password</button>
                        <br /> -->
                </form>
            </div>
        </div>
    </div>
    <script>
    const showPassword = document.getElementById('showPassword');
    const passwordField = document.getElementById('p2');

    showPassword.addEventListener('change', function() {
        if (this.checked) {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    });
    </script>

</body>

</html>