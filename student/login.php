<?php
session_start();
include('../db_conn.php');
$wrongMes = "";
$userNot = "";
if (isset($_GET['phone'])) {
    $phone = trim($_GET['phone']);

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.authkey.io/request?authkey=d709fa68ad963375&mobile='.$phone.'&
    country_code=+91&sms=Hello%2C%20your%20OTP%20is%201234&sender=SENDERID",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
    echo $response;
    }
}

?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <!-- All Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Abhitechbot">
    <meta name="robots" content="">
    <meta name="keywords"
        content="school, school admin, education, academy, admin dashboard, college, college management, education management, institute, school management, school management system, student management, teacher management, university, university management">
    <meta name="description"
        content="Discover Akademi - the ultimate admin dashboard and Bootstrap 5 template. Specially designed for professionals, and for business. Akademi provides advanced features and an easy-to-use interface for creating a top-quality website with School and Education Dashboard">
    <meta property="og:title" content="Akademi : School and Education Management System">
    <meta property="og:description"
        content="Akademi - the ultimate admin dashboard and Bootstrap 5 template. Specially designed for professionals, and for business. Akademi provides advanced features and an easy-to-use interface for creating a top-quality website with School and Education Dashboard">
    <meta property="og:image" content="social-image.html">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Page Title Here -->
    <title>Akademi : School and Education Management System</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="admin/images/favicon.png">
    <link href="../admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <link href="../admin/css/style.css" rel="stylesheet">
    <!-- fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- Sweet alert -->
    <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">

</head>

<body class="body  h-100">
    <div class="authincation d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="login-aside text-center  d-flex flex-column flex-row-auto">
            <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                <div class="text-center mb-lg-4 mb-2 pt-5 logo">
                    <img src="../admin/images/logo-white.png" alt="">
                </div>
                <h3 class="mb-2 text-white">Welcome back!</h3>
                <p class="mb-4">Your partner in educational success!</p>
            </div>
            <div class="aside-image position-relative" style="background-image:url(admin/images/background/pic-2.png);">
                <img class="img1 move-1" src="../admin/images/background/pic3.png" alt="">
                <img class="img2 move-2" src="../admin/images/background/pic4.png" alt="">
                <img class="img3 move-3" src="../admin/images/background/pic5.png" alt="">
            </div>
        </div>
        <div
            class="container flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
            <div class="d-flex justify-content-center h-100 align-items-center">
                <div class="authincation-content style-2">
                    <div class="row no-gutters">
                        <div class="col-xl-12 tab-content">
                            <div id="sign-up" class="auth-form tab-pane fade show active  form-validation">
                                <form method="GET" class="needs-validation" novalidate>
                                    <div class="text-center mb-4">
                                        <h3 class="text-center mb-2 text-black">Log In</h3>
                                    </div>
                                    <span class="d-block mb-4 ">Welcome back, please login to your account.</span>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1"
                                            class="form-label mb-2 fs-13 label-color font-w500"></label>
                                        <input type="tel" maxlength="10" minlength="10" class="form-control" id="exampleFormControlInput1" placeholder="Enter Registered Mobile Number"
                                            name="phone" required="">
                                    </div>
                                    <?php echo $userNot; ?>
                                    <?php echo $wrongMes; ?>
                                    <button type="submit" name="login" class="btn btn-block btn-primary">Send OTP</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Password View button -->
    <script>
        const passwordInput = document.getElementById('exampleFormControlInput2');
        const eyeIcon = document.getElementById('eye-icon');
        const togglePasswordButton = document.getElementById('togglePassword');

        togglePasswordButton.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            if (type === 'password') {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });
    </script>
    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="admin/vendor/global/global.min.js"></script>
    <script src="admin/js/custom.min.js"></script>
    <script src="admin/js/dlabnav-init.js"></script>

</body>

</html>