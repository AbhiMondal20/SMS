<?php
include('header.php');

$id = $_GET['id'];
$addmission_id = $_GET['addmission_id'];
$sql = "SELECT student.id AS id, student.stu_id AS stu_id, student.batch_id AS batch_id, student.name AS name, student.mobile AS mobile, student.status AS status, student.f_name AS f_name, student.m_name AS m_name, student.img AS img, student.age AS age, student.gender AS gender, student.mobile AS mobile, student.email AS email, student.po AS po, student.ps AS ps, student.vill AS vill, student.state AS state, student.gender AS gender, student.dist AS dist, student.pin AS pin, student.address AS address, student.m_mobile AS m_mobile, student.f_mobile AS f_mobile, batches.batches_name AS batches_name FROM student INNER JOIN batches ON student.batch_id = batches.id WHERE student.id = '$id' AND student.stu_id = '$addmission_id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$sno = 0;
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $stu_id = $row['stu_id'];
    $batch = $row['batch_id'];
    $batches_name = $row['batches_name'];
    $name = $row['name'];
    $mobile = $row['mobile'];
    $status = $row['status'];
    $f_name = $row['f_name'];
    $m_name = $row['m_name'];
    $age = $row['age'];
    $img = $row['img'];
    $ps = $row['ps'];
    $po = $row['po'];
    $f_mobile = $row['f_mobile'];
    $m_mobile = $row['m_mobile'];
    $email = $row['email'];
    $mobile = $row['mobile'];
    $gender = $row['gender'];
    $pin = $row['pin'];
    $state = $row['state'];
    $address = $row['address'];
    $dist = $row['dist'];
    $vill = $row['vill'];
}

?>
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page-title flex-wrap">
                            <div class="input-group search-area mb-md-0 mb-3">
                                <input type="text" class="form-control" placeholder="Search here...">
                                <span class="input-group-text"><a href="javascript:void(0)">
                                        <svg width="15" height="15" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.5605 15.4395L13.7527 11.6317C14.5395 10.446 15 9.02625 15 7.5C15 3.3645 11.6355 0 7.5 0C3.3645 0 0 3.3645 0 7.5C0 11.6355 3.3645 15 7.5 15C9.02625 15 10.446 14.5395 11.6317 13.7527L15.4395 17.5605C16.0245 18.1462 16.9755 18.1462 17.5605 17.5605C18.1462 16.9747 18.1462 16.0252 17.5605 15.4395V15.4395ZM2.25 7.5C2.25 4.605 4.605 2.25 7.5 2.25C10.395 2.25 12.75 4.605 12.75 7.5C12.75 10.395 10.395 12.75 7.5 12.75C4.605 12.75 2.25 10.395 2.25 7.5V7.5Z"
                                                fill="#01A3FF" />
                                        </svg>
                                    </a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card h-auto">
                    <div class="card-header p-0">
                        <div class="user-bg w-100">
                            <div class="user-svg">
                                <svg width="264" height="109" viewBox="0 0 264 109" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="0.0107422" y="0.6521" width="263.592" height="275.13" rx="20"
                                        fill="#FCC43E"></rect>
                                </svg>
                            </div>
                            <div class="user-svg-1">
                                <svg width="264" height="59" viewBox="0 0 264 59" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect y="0.564056" width="263.592" height="275.13" rx="20" fill="#FB7D5B"></rect>
                                </svg>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="user">
                                <div class="user-media">
                                    <?php
                                    if ($img == null) {
                                        echo '<img src="images/avatar/9.jpg" alt="" class="avatar avatar-xxl">';
                                    } else {
                                        echo '<img src=' . $img . ' alt="" class="avatar avatar-xxl">';
                                    }
                                    ?>
                                </div>
                                <div>
                                    <h2 class="mb-0">
                                        <?php echo $name; ?>
                                    </h2>
                                    <p class="text-primary font-w600">Student</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xl-3 col-xxl-6 col-sm-6">
                                <ul class="student-details">
                                    <li class="me-2">
                                        <a class="icon-box bg-secondary">
                                            <img src="images/profile.svg" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <span>Parents:</span>
                                        <h5 class="mb-0">
                                            <?php echo $f_name; ?>
                                        </h5>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-sm-6">

                                <ul class="student-details">
                                    <li class="me-2">
                                        <a class="icon-box bg-secondary">
                                            <img src="images/svg/location.svg" alt="">
                                        </a>
                                    </li>
                                    <li><span>Address:</span>
                                        <h5 class="mb-0">
                                            <?php echo $vill; ?>,
                                            <?php echo $po; ?>,
                                            <?php echo $ps; ?>,
                                            <?php echo $dist; ?>,
                                            <?php echo $pin; ?>
                                        </h5>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-sm-6">
                                <ul class="student-details">
                                    <li class="me-2">
                                        <a class="icon-box bg-secondary">
                                            <img src="images/svg/phone.svg" alt="">
                                        </a>
                                    </li>
                                    <li><span>Phone:</span>
                                        <h5 class="mb-0">
                                            <?php echo $mobile; ?>
                                        </h5>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-sm-6">
                                <ul class="student-details">
                                    <li class="me-2">
                                        <a class="icon-box bg-secondary">
                                            <img src="images/svg/email.svg" alt="">
                                        </a>
                                    </li>
                                    <li><span>Email:</span>
                                        <h5 class="mb-0">
                                            <?php echo $email; ?>
                                        </h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form class="dropzone" enctype="matlipart form-data" method="POST">
            <div class="fallback">
                <input name="file" type="file" multiple>
            </div>
            <center>
                <button type="submit" class="btn btn-primary" name="save">SAVE</button>
            </center>
        </form>
    </div>
    <!--**********************************
                Footer start
        ***********************************-->
</div>
</div>
<!-- Show images in realtime -->
<script>
    $(document).ready(function (e) {
        $('#10th_admit').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#show10th_admit').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#10th_marksheet').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#show10th_marksheet').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#12th_admit').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#show12th_admit').attr('src', e.target.result);

            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#12th_marksheet').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#show12th_marksheet').attr('src', e.target.result);

            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#12th_pass_certificate').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#show12th_pass_certificate').attr('src', e.target.result);

            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#cast_certificate').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showcast_certificate').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#transfer_certificate').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showtransfer_certificate').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#cast_certificate').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showcast_certificate').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#birth_certificate').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showbirth_certificate').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#character_certificate').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showcharacter_certificate').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#leaving_certificate').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showleaving_certificate').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#migration_certificate').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showmigration_certificate').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#physical_disability_certificate').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showphysical_disability_certificate').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#category_certificate').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showcategory_certificate').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#aadhar').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showaadhar').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#voter_card').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showvoter_card').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function (e) {
        $('#pan_card').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showpan_card').attr('src', e.target.result);
                $('#showpan_card').show();
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

<script>
    const fileInputTen = document.getElementById('10th_admit');
    fileInputTen.addEventListener('change', () => {
        const allowedExtensions = /\.(png|webp)$/i;
        const maxSizeMB = 2;
        if (fileInputTen.files.length > 0) {
            const fileSizeMB = fileInputTen.files[0].size / (1024 * 1024);
            const fileNameTenAdmit = fileInputTen.value;
            if (!allowedExtensions.test(fileNameTenAdmit)) {
                swal({
                    title: 'Invalid!',
                    text: 'Invalid file format. Only WEBP and PNG files are allowed.',
                    icon: 'error',
                    button: 'Ok',
                });
                fileInputTen.value = '';
                return false;
            } else if (fileSizeMB > maxSizeMB) {
                swal({
                    title: 'Invalid!',
                    text: 'Images size exceeds the maximum allowed size of 2 MB.',
                    icon: 'error',
                    button: 'Ok',
                });
                fileInputTen.value = '';
                return false;
            }
        }
    });

    // 10th_marksheet script 
    const fileInput = document.getElementById('10th_marksheet');
    fileInput.addEventListener('change', () => {
        const allowedExtensions = /(\.png|\.webp)$/i;
        const maxSizeMB = 2;
        const fileSizeMB = fileInput.files[0].size / (1024 * 1024);
        const fileName = fileInput.value;
        if (!allowedExtensions.exec(fileName)) {
            swal({
                title: 'Invalid!',
                text: 'Invalid file format. Only WEBP and PNG files are allowed.',
                icon: 'error',
                button: 'Ok',
            });
            fileInput.value = '';
            return false;
        } else if (fileSizeMB > maxSizeMB) {
            swal({
                title: 'Invalid!',
                text: 'Images size exceeds the maximum allowed size of 2 MB.',
                icon: 'error',
                button: 'Ok',
            });
            fileInput.value = '';
            return false;
        }
    });


</script>

<?php
// Update Code
if (isset($_POST['save'])) {
    $modified_id = 1;
    $modified_date = date('Y-m-d H:i:s');


    // 10th Admit
    $tmp_dir = './upload/';
    $ten_admit_img_loc = $_FILES['10th_admit']['tmp_name'];
    $ten_admit_img_name = $_FILES['10th_admit']['name'];
    $ten_admit_thambname = uniqid();
    $ten_admit_img_ext = pathinfo($ten_admit_img_name, PATHINFO_EXTENSION);
    $ten_admit_img_size = $_FILES['10th_admit']['size'] / (1024 * 1024);
    $ten_admit_img_dir = $tmp_dir . $ten_admit_thambname . "." . $ten_admit_img_ext;
    move_uploaded_file($ten_admit_img_loc, $ten_admit_img_dir);
    $ten_admit_img_upload = 'upload/' . $ten_admit_thambname . "." . $ten_admit_img_ext;
    if ($ten_admit_img_size > 5) {
        echo "<script>alert('image size is greater than 5 MB')</script>";
        exit();
    }


    // 10th Marksheet
    $tmp_dir = './upload/';
    $ten_marksheet_img_loc = $_FILES['10th_marksheet']['tmp_name'];
    $ten_marksheet_img_name = $_FILES['10th_marksheet']['name'];
    $ten_marksheet_thambname = uniqid();
    $ten_marksheet_img_ext = pathinfo($ten_marksheet_img_name, PATHINFO_EXTENSION);
    $ten_marksheet_img_size = $_FILES['10th_marksheet']['size'] / (1024 * 1024);
    $ten_marksheet_img_dir = $tmp_dir . $ten_marksheet_thambname . "." . $ten_marksheet_img_ext;
    move_uploaded_file($ten_marksheet_img_loc, $ten_marksheet_img_dir);
    $ten_marksheet_img_upload = 'upload/' . $ten_marksheet_thambname . "." . $ten_marksheet_img_ext;
    if ($ten_marksheet_img_size > 5) {
        echo "<script>alert('image size is greater than 5 MB')</script>";
        exit();
    }


    $sqlUpdate = "UPDATE `student_upload_document` SET `student_id`= ?, `stu_id`= ?, `10th_admit`= ?,`10th_marksheet`= ?,`12th_admit`= ?,`12th_marksheet`= ?, `12th_pass_cert`= ?,`cast_cert`= ?,`transfer_cert`= ?,`birth_cert`= ?, `character_cert`= ?,`leaving_cert`= ?,`migration_cert`= ?, `phy_dis_cert`= ?,`category_cert`= ?,`aadhar`= ?,`voter`= ?,`pan`= ?, `added_by`= ? WHERE student_id = ? AND stu_id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("sis", $id, $stu_id, $ten_admit_img_upload, $ten_marksheet_img_upload);
    if ($stmtUpdate->execute()) {
        echo '<script>
                swal("Success!", "", "success");
                setTimeout(function(){
                    window.location.href =  "student";
                }, 1000);
            </script>';
        exit;
    } else {
        echo '<script>
                swal("Error!", "Error updating data.", "error");
            </script>';
    }
}

?>
<?php
include('footer.php');
?>