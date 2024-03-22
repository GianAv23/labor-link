<?php
require 'dbphp.php';

$error_message = '';

if (isset($_POST["signup"])) {
    $name = $_POST["name"];
    $passw1 = $_POST["passw1"];
    $passw2 = $_POST["passw2"];

    if ($passw1 === $passw2 && $name !== "" && $passw1 !== "" && $passw2 !== "") {
        $cek = create_NEWUSER($name, $passw1);
        if ($cek === "gagal") {
            $error_message = "Failed to create user. Please try again.";
        } else {
            header("Location: login.php");
            exit;
        }
    } else {
        $error_message = "Invalid input. Please check your username and passwords.";
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
    <div class="w-screen min-h-screen bg-bgColor">


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


            <form class="flex flex-col gap-6 mt-8" method="post">
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

                    <div>

                        <input type="password" name="passw1" id="p1" placeholder="Enter your password"
                            class="rounded-lg w-full bg-textColor/50 py-3 px-4 text-cardData">
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

                    <div>

                        <input type="password" name="passw2" id="p2" placeholder="Enter your password"
                            class="rounded-lg w-full bg-textColor/50 py-3 px-4 text-cardData">
                    </div>
                    <!-- <label for="a">Masukkan Username :</label>
                <input type="text" name="name" id="a" /> -->
                    <!-- <label for="p1">Password :</label>
                <input type="password" name="passw1" id="p1">
                <br /> -->
                </div>
                <!-- PASSWORD CONFIRM END -->

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
</body>

</html>