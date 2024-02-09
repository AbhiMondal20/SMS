<?php
session_start();
if(isset($_SESSION['login']) && $_SESSION['login'] == true) {   
    // $user_email = $_SESSION['user_email'];
}
else{
    echo "<script>location.href='../login';</script>";
}

include('header.php');

$id = $_GET['id'];
$addmission_id = $_GET['addmission_id'];

$sql = "SELECT 
            student.id AS id, 
            student.stu_id AS stu_id, 
            student.batch_id AS batch_id, 
            student.name AS name, 
            student.mobile AS mobile, 
            student.status AS status, 
            student.f_name AS f_name, 
            student.m_name AS m_name, 
            student.img AS img, 
            student.age AS age, 
            student.gender AS gender, 
            student.mobile AS mobile, 
            student.email AS email, 
            student.po AS po, 
            student.ps AS ps, 
            student.vill AS vill, 
            student.state AS state, 
            student.gender AS gender, 
            student.dist AS dist, 
            student.pin AS pin, 
            student.address AS address, 
            student.m_mobile AS m_mobile, 
            student.f_mobile AS f_mobile, 
            stu_doc.10th_admit AS admit_10th, 
            stu_doc.10th_marksheet AS marksheet_10th, 
            stu_doc.12th_admit AS admit_12th, 
            stu_doc.12th_marksheet AS marksheet_12th, 
            stu_doc.12th_pass_cert AS pass_cert_12th, 
            stu_doc.cast_cert AS cast_cert, 
            stu_doc.transfer_cert AS transfer_cert, 
            stu_doc.birth_cert AS birth_cert, 
            stu_doc.character_cert AS character_cert, 
            stu_doc.leaving_cert AS leaving_cert, 
            stu_doc.migration_cert AS migration_cert, 
            stu_doc.phy_dis_cert AS phy_dis_cert, 
            stu_doc.category_cert AS category_cert, 
            stu_doc.aadhar AS aadhar, 
            stu_doc.voter AS voter, 
            stu_doc.pan AS pan 
        FROM 
            student 
        LEFT JOIN 
            student_upload_document AS stu_doc 
        ON 
            student.stu_id = stu_doc.stu_id 
        WHERE 
            student.id = '$id' 
        AND 
            student.stu_id = '$addmission_id'";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$sno = 0;
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $stu_id = $row['stu_id'];
    $batch = $row['batch_id'];
    $name = $row['name'];
    $mobile = $row['mobile'];
    $status = $row['status'];
    $f_name = $row['f_name'];
    $m_name = $row['m_name'];
    $age = $row['age'];
    $img = $row['img'];
    $ps = $row['ps'];
    $po = $row['po'];
    $email = $row['email'];
    $mobile = $row['mobile'];
    $pin = $row['pin'];
    $state = $row['state'];
    $address = $row['address'];
    $dist = $row['dist'];
    $vill = $row['vill'];

    $tenth_admit = $row['admit_10th'];
    $tenmarksheet = $row['marksheet_10th'];
    $twelve_admit = $row['admit_12th'];
    $twelve_marksheet = $row['marksheet_12th'];
    $twelve_pass = $row['pass_cert_12th'];
    $cast_cert = $row['cast_cert'];
    $transfer_cert = $row['transfer_cert'];
    $birth_cert = $row['birth_cert'];
    $character_cert = $row['character_cert'];
    $leaving_cert = $row['leaving_cert'];
    $migration_cert = $row['migration_cert'];
    $phy_dis_cert = $row['phy_dis_cert'];
    $category_cert = $row['category_cert'];
    $aadhar = $row['aadhar'];
    $voter = $row['voter'];
    $pan = $row['pan'];

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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">10th
                                                Admit</label>
                                            <input type="file" class="form-control" id="10th_admit" accept=".png, .webp"
                                                name="10th_admit">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">10th
                                                Marksheet</label>
                                            <input type="file" class="form-control" name="10th_marksheet"
                                                id="10th_marksheet" accept=".png, .webp">
                                        </div>
                                    </div>
                                    <!-- 10th Admin Card -->
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php echo $tenth_admit; ?>" class="avatar avatar-xl"
                                                    alt="" id="show10th_admit">
                                            </center>
                                        </div>
                                    </div>
                                    <!-- 10th Marksheet -->
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php echo $tenmarksheet; ?>" height="100px" width="100px" class="avatar avatar-xl"
                                                    alt="" id="show10th_marksheet">
                                            </center>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">12th
                                                Admit</label>
                                            <input type="file" class="form-control" name="12th_admit" id="12th_admit">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">12th
                                                Marksheet</label>
                                            <input type="file" class="form-control" name="12th_marksheet"
                                                id="12th_marksheet">
                                        </div>
                                    </div>
                                    <!-- 12th Admit -->
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php echo $twelve_admit; ?>" height="100px" width="100px" class="avatar avatar-xl"
                                                    alt="" id="show12th_admit">
                                            </center>
                                        </div>
                                    </div>
                                    <!-- 12th Marksheet -->
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php echo $twelve_marksheet; ?>" height="100px" width="100px" class="avatar avatar-xl" alt="" id="show12th_marksheet">
                                            </center>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">12th Passing
                                                Certificate</label>
                                            <input type="file" class="form-control" name="12th_pass_certificate" id="12th_pass_certificate">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Cast
                                                Certificate</label>
                                            <input type="file" class="form-control" name="cast_certificate" id="cast_certificate">
                                        </div>
                                    </div>
                                    <!-- 12th Passing Certificate -->
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php echo $twelve_pass; ?>" height="100px" width="100px" class="avatar avatar-xl" alt="" id="show12th_pass_certificate">
                                            </center>
                                        </div>
                                    </div>
                                    <!-- cast Certificate-->
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php echo $cast_cert; ?>" height="100px" width="100px" class="avatar avatar-xl" alt="" id="showcast_certificate">
                                            </center>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Transfer
                                                certificate</label>
                                            <input type="file" class="form-control" name="transfer_certificate" id="transfer_certificate">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Birth
                                                certificate</label>
                                            <input type="file" class="form-control" name="birth_certificate" id="birth_certificate">
                                        </div>
                                    </div>
                                    <!-- Transfer Certificate -->
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php echo $transfer_cert; ?>" height="100px" width="100px" class="avatar avatar-xl"
                                                    alt="" id="showtransfer_certificate">
                                            </center>
                                        </div>
                                    </div>
                                    <!-- Birth Certificate-->
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php echo $birth_cert; ?>" height="100px" width="100px" class="avatar avatar-xl" alt="" id="showbirth_certificate">
                                            </center>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Character
                                                certificate</label>
                                            <input type="file" class="form-control" name="character_certificate"
                                                id="character_certificate">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Leaving
                                                certificate</label>
                                            <input type="file" class="form-control" name="leaving_certificate"
                                                id="leaving_certificate">
                                        </div>
                                    </div>

                                    <!-- Transfer Certificate -->
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php echo $character_cert; ?>" height="100px" width="100px" class="avatar avatar-xl"
                                                    alt="" id="showcharacter_certificate">
                                            </center>
                                        </div>
                                    </div>
                                    <!-- Birth Certificate-->
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php echo $leaving_cert; ?>" height="100px" width="100px" class="avatar avatar-xl"
                                                    alt="" id="showleaving_certificate">
                                            </center>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Migration
                                                certificate</label>
                                            <input type="file" class="form-control" name="migration_certificate"
                                                id="migration_certificate">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Physical
                                                Disability Certificate</label>
                                            <input type="file" class="form-control"                                              name="physical_disability_certificate"
                                                id="physical_disability_certificate">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php $migration_cert; ?>" height="100px" width="100px" class="avatar avatar-xl"
                                                    alt="" id="showmigration_certificate">
                                            </center>
                                        </div>
                                    </div>
                                    <!-- Birth Certificate-->
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php echo $phy_dis_cert; ?>" height="100px" width="100px" class="avatar avatar-xl"
                                                    alt="" id="showphysical_disability_certificate">
                                            </center>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Category
                                                certificate</label>
                                            <input type="file" class="form-control" name="category_certificate"
                                                id="category_certificate">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Aadhar
                                                Card</label>
                                            <input type="file" class="form-control" name="aadhar" id="aadhar">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php echo $category_cert; ?>" height="100px" width="100px" class="avatar avatar-xl"
                                                    alt="" id="showcategory_certificate">
                                            </center>
                                        </div>
                                    </div>
                                    <!-- Birth Certificate-->
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php echo $aadhar; ?>" height="100px" width="100px" class="avatar avatar-xl"
                                                    alt="" id="showaadhar">
                                            </center>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Voter
                                                Card</label>
                                            <input type="file" class="form-control" name="voter_card" id="voter_card">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Pan Card
                                                (Optional)</label>
                                            <input type="file" class="form-control" name="pan_card" id="pan_card">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php $voter; ?>" height="100px" width="100px" class="avatar avatar-xl"
                                                    alt="" id="showvoter_card">
                                            </center>
                                        </div>
                                    </div>
                                    <!-- Birth Certificate-->
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <center>
                                                <img src="<?php echo $pan; ?>" height="100px" width="100px" class="avatar avatar-xl"
                                                    alt="" id="showpan_card">
                                            </center>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <center>
                            <button type="submit" class="btn btn-primary" name="save">
                                <i class="fa-regular fa-floppy-disk"></i> Save</button>
                        </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
if (isset($_POST['save'])) {
    $added_id = 1;
    $modified_date = date('Y-m-d H:i:s');
    $tmp_dir = './upload/';

    function uploadFile($file, $tmp_dir, $uploaded_dir)
    {
        $tmp_name = $file['tmp_name'];
        $name = $file['name'];
        $thambname = uniqid();
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $size = $file['size'] / (1024 * 1024);
        $dir = $tmp_dir . $thambname . "." . $ext;
        move_uploaded_file($tmp_name, $dir);
        $upload_path = $uploaded_dir . $thambname . "." . $ext;

        if ($size > 5) {
            echo "<script>alert('Image size is greater than 5 MB')</script>";
            exit();
        }

        return $upload_path;
    }
 // Check if file with the same name already exists, delete it
//  if (file_exists($upload_path)) {
//     unlink($upload_path);
// }
    
    $ten_admit_img_upload = uploadFile($_FILES['10th_admit'], $tmp_dir, 'upload/');
    $ten_marksheet_img_upload = uploadFile($_FILES['10th_marksheet'], $tmp_dir, 'upload/');
    $twelve_admit_img_upload = uploadFile($_FILES['12th_admit'], $tmp_dir, 'upload/');
    $twelve_marksheet_img_upload = uploadFile($_FILES['12th_marksheet'], $tmp_dir, 'upload/');
    $twelve_pass_img_upload = uploadFile($_FILES['12th_pass_certificate'], $tmp_dir, 'upload/');
    $cast_certificate_img_upload = uploadFile($_FILES['cast_certificate'], $tmp_dir, 'upload/');
    $transfer_certificate_img_upload = uploadFile($_FILES['transfer_certificate'], $tmp_dir, 'upload/');
    $birth_certificate_img_upload = uploadFile($_FILES['birth_certificate'], $tmp_dir, 'upload/');
    $character_certificate_img_upload = uploadFile($_FILES['character_certificate'], $tmp_dir, 'upload/');
    $leaving_certificate_img_upload = uploadFile($_FILES['leaving_certificate'], $tmp_dir, 'upload/');
    $migration_certificate_img_upload = uploadFile($_FILES['migration_certificate'], $tmp_dir, 'upload/');
    $physical_disability_certificate_img_upload = uploadFile($_FILES['physical_disability_certificate'], $tmp_dir, 'upload/');
    $category_certificate_img_upload = uploadFile($_FILES['category_certificate'], $tmp_dir, 'upload/');
    $aadhar_img_upload = uploadFile($_FILES['aadhar'], $tmp_dir, 'upload/');
    $voter_card_img_upload = uploadFile($_FILES['voter_card'], $tmp_dir, 'upload/');
    $pan_card_img_upload = uploadFile($_FILES['pan_card'], $tmp_dir, 'upload/');

    $sqlUpdate = "UPDATE `student_upload_document` SET `student_id`= ?, `10th_admit`= ?,`10th_marksheet`= ?,`12th_admit`= ?,`12th_marksheet`= ?, `12th_pass_cert`= ?,`cast_cert`= ?,`transfer_cert`= ?,`birth_cert`= ?, `character_cert`= ?,`leaving_cert`= ?,`migration_cert`= ?, `phy_dis_cert`= ?,`category_cert`= ?,`aadhar`= ?,`voter`= ?,`pan`= ?, `added_by`= ? WHERE stu_id = ?";
    
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param(
        "issssssssssssssssis",
        $id,
        $ten_admit_img_upload,
        $ten_marksheet_img_upload,
        $twelve_admit_img_upload,
        $twelve_marksheet_img_upload,
        $twelve_pass_img_upload,
        $cast_certificate_img_upload,
        $transfer_certificate_img_upload,
        $birth_certificate_img_upload,
        $character_certificate_img_upload,
        $leaving_certificate_img_upload,
        $migration_certificate_img_upload,
        $physical_disability_certificate_img_upload,
        $category_certificate_img_upload,
        $aadhar_img_upload,
        $voter_card_img_upload,
        $pan_card_img_upload,
        $added_id,
        $stu_id
    );

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