<?php
session_start();
require_once('db_conn.php');
$wrongMes = "";
$userNot = "";
if (isset($_POST['login'])) {
    $user_email = trim($_POST['user_email']);
    $password = trim($_POST['password']);

    // Prepared statement to prevent SQL injection
    $sql = "SELECT * FROM user WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user_email, $user_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['email'] = $row['email'];
            $role = $row['role'];
            if ($role == 'admin') {
                $_SESSION['role'] = 'admin';
                header("Location: admin/");
                exit;
            } elseif ($role == 'teacher') {
                $_SESSION['role'] = 'teacher';
                header("Location: teacher/");
                exit;
            }
        } else {
            // echo '<script>alert("Wrong Password");</script>';
            $wrongMes = '<div class="alert alert-danger alert-dismissible fade show">
<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
<strong>Error!</strong> Wrong Password.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
<i class="fa-solid fa-xmark"></i>
</button>
</div>';
        }
    } else {
        // echo '<script>alert("User Not Found");</script>';
        $userNot = '<div class="alert alert-danger alert-dismissible fade show">
        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
        <strong>Error!</strong> User Not Found.
        <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert" aria-label="btn-close">
        <i class="fa-solid fa-xmark"></i>
        </button>
        </div>';
    }
}

// If already logged in, redirect
if (isset($_SESSION['login'])) {
    header("Location: admin/");
    exit;
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
    <link href="admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <link href="admin/css/style.css" rel="stylesheet">
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
                    <img src="admin/images/logo-white.png" alt="">
                </div>
                <h3 class="mb-2 text-white">Welcome back!</h3>
                <p class="mb-4">Your partner in educational success!</p>
            </div>
            <div class="aside-image position-relative" style="background-image:url(admin/images/background/pic-2.png);">
                <img class="img1 move-1" src="admin/images/background/pic3.png" alt="">
                <img class="img2 move-2" src="admin/images/background/pic4.png" alt="">
                <img class="img3 move-3" src="admin/images/background/pic5.png" alt="">
            </div>
        </div>
        <div
            class="container flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
            <div class="d-flex justify-content-center h-100 align-items-center">
                <div class="authincation-content style-2">
                    <div class="row no-gutters">
                        <div class="col-xl-12 tab-content">
                            <div id="sign-up" class="auth-form tab-pane fade show active  form-validation">
                                <form method="POST" class="needs-validation" novalidate>
                                    <div class="text-center mb-4">
                                        <h3 class="text-center mb-2 text-black">Sign In</h3>
                                        <span>Your Social Campaigns</span>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-xl-6 col-6">
                                            <a href="https://www.google.com/"
                                                class="btn btn-outline-light d-block social-bx">
                                                <svg width="16" height="16" viewBox="0 0 28 28" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M27.9851 14.2618C27.9851 13.1146 27.8899 12.2775 27.6837 11.4094H14.2788V16.5871H22.1472C21.9886 17.8738 21.132 19.8116 19.2283 21.1137L19.2016 21.287L23.44 24.4956L23.7336 24.5242C26.4304 22.0904 27.9851 18.5093 27.9851 14.2618Z"
                                                        fill="#4285F4" />
                                                    <path
                                                        d="M14.279 27.904C18.1338 27.904 21.37 26.6637 23.7338 24.5245L19.2285 21.114C18.0228 21.9356 16.4047 22.5092 14.279 22.5092C10.5034 22.5092 7.29894 20.0754 6.15663 16.7114L5.9892 16.7253L1.58205 20.0583L1.52441 20.2149C3.87224 24.7725 8.69486 27.904 14.279 27.904Z"
                                                        fill="#34A853" />
                                                    <path
                                                        d="M6.15656 16.7113C5.85516 15.8432 5.68072 14.913 5.68072 13.9519C5.68072 12.9907 5.85516 12.0606 6.14071 11.1925L6.13272 11.0076L1.67035 7.62109L1.52435 7.68896C0.556704 9.58024 0.00146484 11.7041 0.00146484 13.9519C0.00146484 16.1997 0.556704 18.3234 1.52435 20.2147L6.15656 16.7113Z"
                                                        fill="#FBBC05" />
                                                    <path
                                                        d="M14.279 5.3947C16.9599 5.3947 18.7683 6.52635 19.7995 7.47204L23.8289 3.6275C21.3542 1.37969 18.1338 0 14.279 0C8.69485 0 3.87223 3.1314 1.52441 7.68899L6.14077 11.1925C7.29893 7.82856 10.5034 5.3947 14.279 5.3947Z"
                                                        fill="#EB4335" />
                                                </svg>
                                                <span class="ms-1 font-w600 label-color">Sign in with Google</span></a>
                                        </div>
                                        <div class="col-xl-6 col-6">
                                            <a href="https://www.apple.com/"
                                                class="btn btn-outline-light d-block social-bx">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 456.008 560.035">
                                                    <path
                                                        d="M380.844 297.529c.787 84.752 74.349 112.955 75.164 113.314-.622 1.988-11.754 40.191-38.756 79.652-23.343 34.117-47.568 68.107-85.731 68.811-37.499.691-49.557-22.236-92.429-22.236-42.859 0-56.256 21.533-91.753 22.928-36.837 1.395-64.889-36.891-88.424-70.883-48.093-69.53-84.846-196.475-35.496-282.165 24.516-42.554 68.328-69.501 115.882-70.192 36.173-.69 70.315 24.336 92.429 24.336 22.1 0 63.59-30.096 107.208-25.676 18.26.76 69.517 7.376 102.429 55.552-2.652 1.644-61.159 35.704-60.523 106.559M310.369 89.418C329.926 65.745 343.089 32.79 339.498 0 311.308 1.133 277.22 18.785 257 42.445c-18.121 20.952-33.991 54.487-29.709 86.628 31.421 2.431 63.52-15.967 83.078-39.655" />
                                                </svg>
                                                <span class="ms-1 font-w600 label-color">Sign in with Apple</span></a>
                                        </div>
                                    </div>
                                    <div class="sepertor">
                                        <span class="d-block mb-4 fs-13">Or with email</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1"
                                            class="form-label mb-2 fs-13 label-color font-w500">Username OR Email
                                            address</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="user_email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1"
                                            class="form-label mb-2 fs-13 label-color font-w500">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="exampleFormControlInput2"
                                                required name="password">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="fas fa-eye" id="eye-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="text-primary float-end mb-4">Forgot Password
                                        ?</a>
                                    <?php echo $userNot; ?>
                                    <?php echo $wrongMes; ?>
                                    <button type="submit" name="login" class="btn btn-block btn-primary">Sign
                                        In</button>
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