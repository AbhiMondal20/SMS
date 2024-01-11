<?php
include('header.php');

$id = $_GET['id'];
$addmission_id = $_GET['addmission_id'];
$sql = "SELECT student.id AS id, student.stu_id AS stu_id, student.batch_id AS batch_id, student.name AS name, student.mobile AS mobile, student.status AS status, student.f_name AS f_name, student.m_name AS m_name, student.img AS img, student.age AS age, student.gender AS gender, student.mobile AS mobile, student.email AS email, student.po AS po, student.ps AS ps, student.vill AS vill, student.state AS state, student.gender AS gender, student.pin AS pin, student.address AS address, student.m_mobile AS m_mobile, student.f_mobile AS f_mobile, batches.batches_name AS batches_name FROM student INNER JOIN batches ON student.batch_id = batches.id WHERE student.id = '$id' AND student.stu_id = '$addmission_id'";
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label mb-2">Student
                                                Id</label>
                                            <input type="text" class="form-control" required name="stu_id"
                                                value="<?php echo $stu_id; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Name</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="Student Name" required name="name" value="<?php echo $name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">BATCH</label>
                                            <select class="form-select wide form-control" id="batch" required="" name="batch_id">
                                                <option value="" disabled>Select Batch</option>
                                                <?php
                                                $sql = "SELECT * FROM batches";
                                                $res = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_assoc($res)) {
                                                    $batchId = $row['id'];
                                                    $batchesName = $row['batches_name'];
                                                    $selected = ($batchId == $batch) ? 'selected' : '';
                                                    echo '<option value="' . $batchId . '" ' . $selected . '>' . $batchesName . '</option>';
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Profile
                                                Pic</label>
                                            <input type="file" class="form-control" name="file" id="file"
                                                accept=".png, .webp">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Age</label>
                                            <input type="text" class="form-control" required name="age" value="<?php echo $age; ?>"
                                                placeholder="Age">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Gender</label>
                                            <select class="form-select wide form-control" id="validationCustom05" required="" name="gender">
                                                <option>Select Gender</option>
                                                <?php
                                                    $selectedMale = ($gender == 'Male') ? 'selected' : '';
                                                    $selectedFemale = ($gender == 'Female') ? 'selected' : '';
                                                ?>
                                                <option value="Male" <?php echo $selectedMale ?>>Male</option>
                                                <option value="Female" <?php echo $selectedFemale ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Mobile</label>
                                            <input type="tel" class="form-control" required name="mobile" value="<?php echo $mobile; ?>" placeholder="Mobile" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Email</label>
                                            <input type="email" class="form-control" required name="email" value="<?php echo $email; ?>" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Father
                                                Name</label>
                                            <input type="text" class="form-control" required name="f_name" value="<?php echo $f_name; ?>" placeholder="Father Name">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Mother
                                                Name</label>
                                            <input type="text" class="form-control" required name="m_name" value="<?php echo $m_name; ?>" placeholder="Mother Name">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Father
                                                Mobile</label>
                                            <input type="tel" class="form-control" required name="f_mobile" value="<?php echo $f_mobile; ?>" placeholder="Father Mobile" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Mother
                                                Mobile</label>
                                            <input type="tel" class="form-control" required name="m_mobile" value="<?php echo $m_mobile; ?>" placeholder="Mother Mobile" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">State</label>
                                            <input type="text" class="form-control" required name="state" value="<?php echo $state; ?>" placeholder="State">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2"
                                                class="form-label mb-2">Village</label>
                                            <input type="text" class="form-control" required name="vill" value="<?php echo $vill; ?>"
                                                placeholder="Village">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Police
                                                Station</label>
                                            <input type="text" class="form-control" required name="ps" value="<?php echo $ps; ?>"
                                                placeholder="Police Station">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Post
                                                Office</label>
                                            <input type="text" class="form-control" required name="po" value="<?php echo $po; ?>"
                                                placeholder="Post Office">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">Pin
                                                Code</label>
                                            <input type="text" class="form-control" required name="pin" maxlength="6" value="<?php echo $pin; ?>" minlength="6" placeholder="Pin Code">
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


<script>

    // File filtering script
    const fileInput = document.getElementById('file');
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
    $stu_id = $_POST['stu_id'];
    $name = $_POST['name'];
    $batch_id = $_POST['batch_id'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $mobile = $_POST['mobile'];
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $f_mobile = $_POST['f_mobile'];
    $m_mobile = $_POST['m_mobile'];
    $state = $_POST['state'];
    $vill = $_POST['vill'];
    $ps = $_POST['ps'];
    $po = $_POST['po'];
    $pin = $_POST['pin'];
    $modified_id = 1;
    $modified_date = date('Y-m-d H:i:s');

    // File upload handling for main image
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $tmp_dir = './upload/';
        $img_loc = $_FILES['file']['tmp_name'];
        $img_name = $_FILES['file']['name'];
        $thambname = uniqid();
        $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);

        $img_size = $_FILES['file']['size'] / (1024 * 1024);
        $img_dir = $tmp_dir . $thambname . "." . $img_ext;
        move_uploaded_file($img_loc, $img_dir);

        $img_upload = 'upload/' . $thambname . "." . $img_ext;
        if ($img_size > 5) {
            echo "<script>alert('image size is greater than 5 MB')</script>";
            exit();
        }
    }else{
        $img_upload = $img;
    }
   
    $sqlUpdate = "UPDATE `student` SET `name`= ?, `batch_id`= ?, `img`= ?, `f_name`= ?, `m_name`= ?, `age`= ?, `gender`= ?, `mobile`= ?, `email`= ?, `f_mobile`= ?, `m_mobile`= ?, `po`= ?, `ps`= ?, `vill`= ?, `dist`= ?, `state`= ?, `pin`= ?, `address`= ?, `modified_by`= ?, `modified_date`= ? WHERE id = ? AND stu_id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);

    $stmtUpdate->bind_param("sisssissssssssssisssis", $name, $batch_id, $img_upload, $f_name, $m_name, $age, $gender, $mobile, $email, $f_mobile, $m_mobile, $po, $ps, $vill, $dist, $state, $pin, $addre, $modified_id, $modified_date, $id, $addmission_id);

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