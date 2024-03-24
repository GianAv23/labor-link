<?php
require 'dbphp.php';

$error_message = '';

if (isset($_POST["signup"])) {
    $name = $_POST["name"];
    $passw1 = $_POST["passw1"];
    $passw2 = $_POST["passw2"];
    $recaptcha_response = $_POST['g-recaptcha-response'];

    if ($passw1 === $passw2 && $name !== "" && $passw1 !== "" && $passw2 !== "") {
        if (validate_recaptcha($recaptcha_response)) {
            $cek = create_NEWUSER($name, $passw1);
            if ($cek === "gagal") {
                $error_message = "Failed to create user. Please try again.";
            } else {
                header("Location: login.php");
                exit;
            }
        } else {
            $error_message = "reCAPTCHA verification failed. Please try again.";
        }
    } else {
        $error_message = "All fields must be completed and passwords must match";
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
    <title>Sign Up | LaborLink</title>
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

            <div class="w-screen min-h-screen flex flex-col justify-center py-8 px-10 md:px-32 lg:px-60 xl:px-80">

                <!-- HEADER START -->
                <div class="flex flex-col gap-2 justify-center items-center mb-8">
                    <!-- LOGO START -->
                    <div class="bg-textColor/30 rounded-lg w-28 h-8 flex items-center justify-center">
                        <span class="text-white font-bold">
                            Labor<span class="text-textColor2">Link</span>
                        </span>
                    </div>
                    <!-- LOGO END -->

                    <span class="text-cardData font-bold text-2xl">Register Account</span>

                </div>
                <!-- HEADER END -->

                <!-- ERROR MESSAGE START -->
                <?php if (!empty($error_message)) : ?>
                <div id="error-message" class="flex p-3 justify-center bg-textColor2/30 rounded-lg">
                    <span class="text-textColor2 font-medium text-sm flex text-center"><?= $error_message ?></span>
                </div>
                <?php endif; ?>
                <!-- ERROR MESSAGE END -->


                <form class="z-10 flex flex-col gap-6 mt-8" method="post">
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

                    <!-- <label for="a">Masukkan Username :</label>
            <input type="text" name="name" id="a" />
            <br /> -->

                    <!-- PASSWORD START -->
                    <div class="flex flex-col gap-1">
                        <div>
                            <label class="text-cardData font-semibold" for="p1">
                                Password
                            </label>
                        </div>
                        <!-- 
                        <div>

                            <input type="password" name="passw1" id="p1" placeholder="Enter your password"
                                class="rounded-xl w-full bg-textColor/80 py-3 px-4 text-cardData border border-textColor2/60">
                        </div> -->

                        <div class="relative">
                            <input type="password" name="passw1" id="p1" placeholder="Enter your password"
                                class="rounded-xl w-full bg-textColor/80 py-3 px-4 text-cardData border border-textColor2/60">
                            <input type="checkbox" id="showPassword"
                                class="absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer">
                            <label for="showPassword"
                                class="absolute top-1/2 right-10 transform -translate-y-1/2 text-sm text-textColor2 cursor-pointer">Show
                                password</label>
                        </div>


                        <div>
                            <span class="text-cardData font-medium text-xs">Min 8 Characters</span>
                        </div>
                        <!-- <label for="a">Masukkan Username :</label>
                <input type="text" name="name" id="a" /> -->
                        <!-- <label for="p1">Password :</label>
                <input type="password" name="passw1" id="p1">
                <br /> -->
                    </div>
                    <!-- PASSWORD END -->

                    <!-- PASSWORD CONFIRM START -->
                    <div class="flex flex-col gap-1">
                        <div>
                            <label class="text-cardData font-semibold" for="p2">
                                Password Confirm
                            </label>
                        </div>

                        <!-- <div>

                            <input type="password" name="passw2" id="p2" placeholder="Enter your password"
                                class="rounded-xl w-full bg-textColor/80 py-3 px-4 text-cardData border border-textColor2/60">
                        </div> -->

                        <div class="relative">
                            <input type="password" name="passw2" id="p2" placeholder="Enter your password"
                                class="rounded-xl w-full bg-textColor/80 py-3 px-4 text-cardData border border-textColor2/60">
                            <input type="checkbox" id="showPasswordConfirm"
                                class="absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer">
                            <label for="showPasswordConfirm"
                                class="absolute top-1/2 right-10 transform -translate-y-1/2 text-sm text-textColor2 cursor-pointer">Show
                                password</label>
                        </div>
                        <!-- <label for="a">Masukkan Username :</label>
                <input type="text" name="name" id="a" /> -->
                        <!-- <label for="p1">Password :</label>
                <input type="password" name="passw1" id="p1">
                <br /> -->
                    </div>
                    <!-- PASSWORD CONFIRM END -->

                    <!-- CAPTCHA START -->
                    <div class="g-recaptcha flex justify-center items-center"
                        data-sitekey="6LeQr6IpAAAAAFwL29Ssdz2thuqBv4-r8EWIEi11">
                    </div>
                    <!-- CAPTCHA END -->

                    <div class="mt-6">
                        <button type="submit" name="signup" class="bg-textColor2 w-full py-2 rounded-full"><span
                                class="text-textColor font-bold">Sign Up</span>
                        </button>
                    </div>

                    <div class="flex justify-center">
                        <span class="text-cardData font-medium text-sm">Already have an accout? <a
                                class="text-textColor2 font-bold" href="login.php">Log in</a></span>
                    </div>


                    <!-- <label for="p2">Password confirm :</label>
            <input type="password" name="passw2" id="p2">
            <br /> -->
                    <!-- <button type="submit" name="signup">Sign Up</button> -->
                </form>
            </div>

            <script>
            const showPasswordConfirm = document.getElementById('showPasswordConfirm');
            const passwordFieldConfirm = document.getElementById('p2');

            const showPassword = document.getElementById('showPassword');
            const passwordField = document.getElementById('p1');

            showPassword.addEventListener('change', function() {
                if (this.checked) {
                    passwordField.type = 'text';
                } else {
                    passwordField.type = 'password';
                }
            });

            showPasswordConfirm.addEventListener('change', function() {
                if (this.checked) {
                    passwordFieldConfirm.type = 'text';
                } else {
                    passwordFieldConfirm.type = 'password';
                }
            });
            </script>
</body>

</html>