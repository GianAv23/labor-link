<?php
require 'dbphp.php';

$error_message = '';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $passw = $_POST["passw"];

    if (empty($name) || empty($passw)) {
        $error_message = "Username and password are required.";
    } else {
        if (cek_USER_and_PASS($name, $passw)) {
            header("Location: index.php");
            exit;
        } else {
            $error_message = "Invalid username or password";
        }
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
    <title>Log In | LaborLink</title>
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

        <!-- ELLIIPSE START -->
        <!-- <img class="absolute top-0 left-0 w-screen h-full z-0" src="assets/blurellipse.svg" alt=""> -->
        <!-- ELLIIPSE END -->


        <!-- HEADER START -->
        <div class="flex flex-col gap-2 justify-center items-center mb-8">
            <!-- LOGO START -->
            <div class="bg-textColor/30 rounded-lg w-28 h-8 flex items-center justify-center">
                <span class="text-white font-bold">
                    Labor<span class="text-textColor2">Link</span>
                </span>
            </div>
            <!-- LOGO END -->
            <span class="text-cardData font-bold text-3xl">Login Account</span>
        </div>
        <!-- HEADER END -->

        <!-- ERROR MESSAGE START -->
        <?php if (!empty($error_message)) : ?>
        <div id="error-message" class="flex p-3 justify-center bg-textColor2/30 rounded-lg">
            <span class="text-textColor2 font-medium text-sm flex text-center"><?= $error_message ?></span>
        </div>
        <?php endif; ?>
        <!-- ERROR MESSAGE END -->


        <!-- FORM START -->
        <form class="flex flex-col gap-6 mt-8" method="post">

            <!-- USERNAME START -->
            <div class=" flex flex-col gap-1">
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

                <a href="change_PASS.php" class="flex justify-end"><span
                        class="text-textColor2 font-medium text-sm mt-1">Lupa
                        Password</span></a>


                <!-- <label for="a">Masukkan Username :</label>
                <input type="text" name="name" id="a" /> -->
            </div>
            <!-- PASSWORD END -->

            <div class="mt-6">
                <button type="submit" name="submit" class="bg-textColor2 w-full py-2 rounded-full"><span
                        class="text-textColor font-bold">Log
                        In</span>
                </button>
            </div>

            <div class="flex justify-center">
                <span class="text-cardData font-medium text-sm">Don’t have an account? <a
                        class="text-textColor2 font-bold" href="signUP_PAGE.php">Sign
                        Up</a></span>
            </div>

            <!-- <br />
            <label for="p">Password :</label>
            <input type="password" name="passw" id="p">
            <br />


            <button type="submit" name="submit">Login</button>
            <br /> -->
        </form>
        <!-- FORM END -->



    </div>

    <script>
    function validateForm() {
        var username = document.getElementById('a').value;
        var password = document.getElementById('p').value;

        if (!username || !password) {
            document.getElementById('error-message').style.display = 'block';
            window.scrollTo(0, 0);
            return false;
        }
        return true;
    }
    </script>
</body>

</html>