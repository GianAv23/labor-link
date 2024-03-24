<?php
require 'dbphp.php';

$error_message = '';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $passw = $_POST["passw"];
    $recaptcha_response = $_POST['g-recaptcha-response'];

    if (empty($name) || empty($passw)) {
        $error_message = "Username and password are required";
    } elseif (!validate_recaptcha($recaptcha_response)) {
        $error_message = "reCAPTHCA verification failed, please try again.";
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
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
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
    <div class="w-screen min-h-screen ">

        <img class="absolute w-screen h-full object-cover" src="assets/bgForm.png" alt="">

        <div class="absolute bg-bgColor/95">

            <!-- ELLIIPSE START -->
            <img class="absolute z-0 top-0 left-0 w-screen h-screen" src="assets/blurellipse.svg" alt="">
            <!-- ELLIIPSE END -->

            <div class="w-screen min-h-screen flex flex-col justify-center py-2 px-10 md:px-32 lg:px-60 xl:px-96">

                <!-- HEADER START -->
                <div class="z-10 flex flex-col gap-2 mb-8 items-center">
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

                <!-- FORM START -->
                <form class="z-10 flex flex-col gap-6 mt-8" method="post">

                    <!-- ERROR MESSAGE START -->
                    <?php if (!empty($error_message)) : ?>
                    <div id="error-message" class="flex p-3 justify-center bg-textColor2/30 rounded-lg">
                        <span class="text-textColor2 font-medium text-sm flex text-center"><?= $error_message ?></span>
                    </div>
                    <?php endif; ?>
                    <!-- ERROR MESSAGE END -->

                    <!-- USERNAME START -->
                    <div class=" flex flex-col gap-1">
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

                    <!-- PASSWORD START -->
                    <div class="flex flex-col gap-1">
                        <div>
                            <label class="text-cardData font-semibold" for="p">
                                Password
                            </label>
                        </div>

                        <!-- <div>
                            <input type="password" name="passw" id="p" placeholder="Enter your password"
                                class="rounded-xl w-full bg-textColor/80 py-3 px-4 text-cardData border border-textColor2/60">
                        </div> -->

                        <div class="relative">
                            <input type="password" name="passw" id="p" placeholder="Enter your password"
                                class="rounded-xl w-full bg-textColor/80 py-3 px-4 text-cardData border border-textColor2/60">
                            <input type="checkbox" id="showPassword"
                                class="absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer">
                            <label for="showPassword"
                                class="absolute top-1/2 right-10 transform -translate-y-1/2 text-sm text-textColor2 cursor-pointer xs:">Show
                                password</label>
                        </div>


                        <a href="change_PASS.php" class="flex justify-end"><span
                                class="text-textColor2 font-medium text-sm mt-1">Lupa
                                Password</span></a>


                        <!-- <label for="a">Masukkan Username :</label>
                <input type="text" name="name" id="a" /> -->
                    </div>
                    <!-- PASSWORD END -->


                    <!-- CAPTCHA START -->
                    <div class="g-recaptcha flex justify-center items-center"
                        data-sitekey="6LeQr6IpAAAAAFwL29Ssdz2thuqBv4-r8EWIEi11">
                    </div>
                    <!-- CAPTCHA END -->

                    <!-- BUTTON START -->
                    <div class="mt-2">
                        <button type="submit" name="submit"
                            class="bg-textColor2 w-full py-2 rounded-full font-bold hover:bg-textColor2/40 hover:text-textColor2"><span>Log
                                In</span>
                        </button>
                    </div>

                    <div class="flex justify-center">
                        <span class="text-cardData font-medium text-sm">Don’t have an account? <a
                                class="text-textColor2 font-bold" href="signUP_PAGE.php">Sign
                                Up</a></span>
                    </div>

                    <!-- BUTTON END -->

                    <!-- <br />
            <label for="p">Password :</label>
            <input type="password" name="passw" id="p">
            <br />


            <button type="submit" name="submit">Login</button>
            <br /> -->
                </form>
                <!-- FORM END -->

            </div>

        </div>
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

    const showPassword = document.getElementById('showPassword');
    const passwordField = document.getElementById('p');

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