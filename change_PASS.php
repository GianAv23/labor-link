<?php
require 'dbphp.php';
if (isset($_POST["name"]) && isset($_POST["newpass"]) && isset($_POST["confirpass"]) && isset($_POST["submit"])) {
    if (cek_USERNAME($_POST["name"])) {
        $cek = update_NEW_PASSWORD($_POST["newpass"], $_POST["name"]);
        if($cek === "gagal"){
            header("Location: change_PASS.php");
            exit;
        }else{
            header("Location: login.php");
            exit;
        }
    } else {
        header("Location: change_PASS.php");
        exit;
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
    <div class="w-screen h-screen p-16 bg-bgColor z-10">

        <!-- HEADER START -->
        <div class="flex flex-col gap-2 justify-center items-center mb-12">
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

        <form class="flex flex-col gap-6" method="post">
            <!-- USERNAME START -->
            <div class="flex flex-col gap-1">
                <div>
                    <label class="text-cardData font-semibold" for="a">
                        Username
                    </label>
                </div>

                <div>

                    <input type="text" name="name" id="a" placeholder="Enter your username"
                        class="rounded-lg w-full bg-textColor/50 py-3 px-4 text-cardData">
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
                        Password
                    </label>
                </div>

                <div>

                    <input type="password" name="passw" id="p" placeholder="Enter your password"
                        class="rounded-lg w-full bg-textColor/50 py-3 px-4 text-cardData">
                </div>
                <!-- <label for="a">Masukkan Username :</label>
                <input type="text" name="name" id="a" /> -->
            </div>
            <!-- PASSWORD END -->

            <!-- <label for="p">New Password :</label>
            <input type="password" name="newpass" id="p">
            <br /> -->


            <!-- PASSWORD START -->
            <div class="flex flex-col gap-1">
                <div>
                    <label class="text-cardData font-semibold" for="p2">
                        Confirm New Password
                    </label>
                </div>

                <div>

                    <input type="password" name="confirpass" id="p2" placeholder="Enter your password"
                        class="rounded-lg w-full bg-textColor/50 py-3 px-4 text-cardData">
                </div>


                <!-- <label for="a">Masukkan Username :</label>
                <input type="text" name="name" id="a" /> -->
            </div>
            <!-- PASSWORD END -->

            <!-- <label for="p2">Confirm New Password :</label>
            <input type="password" name="confirpass" id="p2">
            <br /> -->

            <div class="mt-6">
                <button type="submit" name="submit" class="bg-textColor2 w-full py-2 rounded-full"><span
                        class="text-textColor font-bold">Change Password</span>
                </button>
            </div>



            <!-- <button type="submit" name="submit">Change Password</button>
            <br /> -->
        </form>
    </div>
</body>

</html>