<?php
session_start();
if(isset($_SESSION['login']) && $_SESSION['login'] == true) {   
    // $user_email = $_SESSION['user_email'];
}
else{
    echo "<script>location.href='../login';</script>";
}
include('header.php');

if (isset($_GET['type']) && $_GET['type'] === 'delete' && isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    $sql2 = "DELETE FROM `student` WHERE id = ?";
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>
                swal('Success!', '', 'success');
                setTimeout(function(){
                    window.location.href = 'student';
                }, 2000);
        </script>";
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
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
                            <div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#StudentModal">
                                    + Add
                                </button>
                            </div>
                        </div>
                    </div>
                        <!--column-->
                        <div class="col-xl-12">
							<div class="card" id="accordion-three">
							   
									<!-- /tab-content -->	
									<div class="tab-content" id="myTabContent-2">
										<div class="tab-pane fade show active" id="withoutSpace" role="tabpanel" aria-labelledby="home-tab-2">
											 <div class="card-body p-0">
												<div class="table-responsive">
													<table id="example3" class="display table" style="min-width: 845px">
                                                        <thead>
                                                            
                                                            <tr>
                                                                <th>#</th>
                                                                <th>PFP.</th>
                                                                <th>Adm. Id</th>
                                                                <th>Name</th>
                                                                <th>Batch</th>
                                                                <th>Mobile (Login)</th>
                                                                <th>Father's Name</th>
                                                                <th>Status</th>
                                                                <th>Docs.</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
														<tbody>
                                                        <?php
                                        $sql = "SELECT student.id AS id, student.stu_id AS stu_id, student.batch_id AS batch_id, student.name AS name, student.mobile AS mobile, student.img AS img, student.status AS status, student.f_name AS f_name, student.m_name AS m_name, batches.batches_name AS batches_name FROM student INNER JOIN batches ON student.batch_id = batches.id ";
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
                                                $img = $row['img'];
                                                $sno += 1;
                                            ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $id; ?>
                                                    </td>
                                                
                                                    <td><img class="rounded-circle" width="35" src="<?php echo $img; ?>" alt=""></td>
                                                    <td><?php echo $stu_id; ?></td>
                                                    <td><?php echo $name; ?></td>
                                                    <td><?php echo $batches_name; ?></td>
                                                    <td><?php echo $mobile; ?></td>
                                                    <td><?php echo $f_name; ?></a></td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" <?php if ($status == '1') {
                                                                echo "checked";
                                                            } ?> id="flexSwitchCheckChecked"
                                                                onclick="toggleStatus(<?php echo $id; ?>)">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="student-upload-document?id=<?php echo $id; ?>&addmission_id=<?php echo $stu_id; ?>" class=" btn btn-sm light btn-danger"><i
                                                                class="fa-solid fa-file-arrow-up"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="edit-student?id=<?php echo $id; ?>&addmission_id=<?php echo $stu_id; ?>"
                                                            class="edit btn btn-sm light btn-info" id="<?php echo $id; ?>"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>

                                                        <a href="javascript:void(0)" class="delete btn btn-sm light btn-danger"
                                                            onclick="return confirmDelete(<?php echo $id; ?>);"><i
                                                                class="fa-solid fa-trash-can"></i></a>
                                                    </td>										
                                                </tr>		
                                        <?php } ?>

														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<!-- /tab-content -->		
							   
							</div>
						</div>
                        <!--/column-->
                    </div>
                </div>
            </div>
        </div>
            <!--**********************************
                Footer start
        ***********************************-->
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade bd-example-modal-lg" id="StudentModal" tabindex="-1" aria-labelledby="StudentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="StudentModalLabel">Student Manage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label mb-2">Student Id</label>
                                    <?php
                                    $sql = 'SELECT * FROM student ORDER BY id DESC LIMIT 1';
                                    $res = mysqli_query($conn, $sql);

                                    if (!$res) {
                                        echo "Error fetching student ID: " . mysqli_error($conn);
                                        // Handle the error appropriately, perhaps redirect or show a user-friendly message.
                                    } else {
                                        $row = mysqli_fetch_assoc($res);
                                        $last_id = $row['stu_id'];

                                        if ($last_id == '') {
                                            $stu_id = "ATT001";
                                        } else {
                                            $stu_id = substr($last_id, 3);
                                            $stu_id = intval($stu_id);
                                            $stu_id = "ATT" . str_pad(($stu_id + 1), 3, '0', STR_PAD_LEFT);
                                        }
                                        ?>
                                        <input type="text" class="form-control" required name="stu_id"
                                            value="<?php echo $stu_id; ?>" readonly>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">Name</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput2"
                                        placeholder="Student Name" required name="name">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">BATCH</label>
                                    <select class="form-select wide form-control" id="batch"
                                        onchange="updateYearOptions()" required="" name="batch_id">
                                        <option value="" disabled selected>Select Batch</option>
                                        <?php
                                        $sql = "SELECT * FROM batches";
                                        $res = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $batchId = $row['id'];
                                            $batchesName = $row['batches_name'];
                                            echo '<option value="' . $batchId . '">' . $batchesName . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">Profile Pic</label>
                                    <input type="file" class="form-control" name="file" id="file" accept=".png, .webp">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">Age</label>
                                    <input type="text" class="form-control" required name="age" placeholder="Age">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">Gender</label>
                                    <select class="form-select wide form-control" id="validationCustom05" required=""
                                        name="gender">
                                        <option selected="" disabled="" value="">Please select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">Mobile</label>
                                    <input type="tel" class="form-control" required name="mobile" placeholder="Mobile"
                                        maxlength="10">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">Email</label>
                                    <input type="email" class="form-control" required name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">Father Name</label>
                                    <input type="text" class="form-control" required name="f_name"
                                        placeholder="Father Name">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">Mother Name</label>
                                    <input type="text" class="form-control" required name="m_name"
                                        placeholder="Mother Name">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">Father Mobile</label>
                                    <input type="tel" class="form-control" required name="f_mobile"
                                        placeholder="Father Mobile" maxlength="10">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">Mother Mobile</label>
                                    <input type="tel" class="form-control" required name="m_mobile"
                                        placeholder="Mother Mobile" maxlength="10">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">State</label>
                                    <input type="text" class="form-control" required name="state" placeholder="State">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">Village</label>
                                    <input type="text" class="form-control" required name="vill" placeholder="Village">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">Police Station</label>
                                    <input type="text" class="form-control" required name="ps"
                                        placeholder="Police Station">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">Post Office</label>
                                    <input type="text" class="form-control" required name="po"
                                        placeholder="Post Office">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">Pin Code</label>
                                    <input type="text" class="form-control" required name="pin" maxlength="6"
                                        minlength="6" placeholder="Pin Code">
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

    <script>
        // Delete Script
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this session!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "?id=" + id + "&type=delete";
                }
            });
            return false;
        }

        // Status script
        function toggleStatus(id) {
            var id = id;
            swal({
                title: "Are you sure?",
                text: "Do you want to Change the Session status?",
                icon: "warning",
                buttons: {
                    cancel: "Cancel",
                    confirm: "OK"
                },
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
                    $.ajax({
                        url: "load/student_update_status.php",
                        type: "post",
                        data: { chatId: id },
                        success: function (result) {
                        }
                    });
                } else {
                }
            });
        }


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
    // Insert Code
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
        $admin_id = 1;

        // File upload handling for main image
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

        $sqlCheck = "SELECT * FROM student WHERE stu_id = ?";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bind_param("s", $stu_id);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            echo '<script>
        swal("Error!", "Addmission Id already exists!", "error");
        setTimeout(function(){
            window.location.href =  window.location.href
        }, 2000);
        </script>';
            exit;
        } else {
            $sqlInsert = "INSERT INTO `student`(`stu_id`, `name`, `batch_id`, `img`, `f_name`, `m_name`, `age`, `gender`, `mobile`, `email`, `f_mobile`, `m_mobile`, `po`, `ps`, `vill`, `dist`, `state`, `pin`, `address`, `added_by`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bind_param("ssssssssssssssssssss", $stu_id, $name, $batch_id, $img_upload, $f_name, $m_name, $age, $gender, $mobile, $email, $f_mobile, $m_mobile, $po, $ps, $vill, $dist, $state, $pin, $addre, $admin_id);

            if ($stmtInsert->execute()) {
                $sqlInsert = "INSERT INTO `student_upload_document`(`stu_id`) VALUES (?)";
                $stmtInsert = $conn->prepare($sqlInsert);
                $stmtInsert->bind_param("s", $stu_id);
                if ($stmtInsert->execute()) {
                    if ($stmtInsert->execute()) {
                    echo '<script>
                                swal("Success!", "", "success");
                                setTimeout(function(){
                                    window.location.href = "counter-collection?stu_id='.$stu_id.'&date='.date('Y-m-d').'&search=Search"
                                }, 1000);
                            </script>';
                    exit;
                    }
                }
            } else {
                echo '<script>
                swal("Error!", "Error inserting data.", "error");
            </script>';
            }
        }
    }
    // Update code
    if (isset($_POST['editSave'])) {
        $editId = $_POST['editId'];
        $editSession = $_POST['editSession'];
        $editSession_prefix = $_POST['editSession_prefix'];
        $editSession_des = $_POST['editSession_des'];
        $modified_date = date('Y-m-d H:i:s');

        // Prepare and bind the SQL statement
        $sql = "UPDATE session SET session=?, prefix=?, description=?, modified_by=?, modified_date=? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        // Assuming $modified_by is a user ID (integer)
        $modified_by = 1; // Replace with the actual user ID or retrieve it from your session
    
        // Bind parameters
        $stmt->bind_param("sssiii", $editSession, $editSession_prefix, $editSession_des, $modified_by, $modified_date, $editId);

        // Execute the statement
        $res = $stmt->execute();

        // Check the result
        if ($res) {
            echo '<script>
        swal("Success!", "This Session has been successfully Updated", "success");
        setTimeout(function(){
            window.location.href = window.location.href;
        }, 1000);
    </script>';
            exit;
        } else {
            echo '<script>
        swal("Error!", "Something Went Wrong", "error");
        setTimeout(function(){
            window.location.href = window.location.href;
        }, 1000);
    </script>';
            exit;
        }

    }
    ?>
    <?php
    include('footer.php');
    ?>