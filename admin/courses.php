<?php
include('header.php');
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
                                    data-bs-target="#CoursesModal">
                                    + Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <!--column-->
                    <div class="col-xl-12 wow fadeInUp" data-wow-delay="1.5s">
                        <div class="table-responsive full-data">
                            <table
                                class="table-responsive-lg table display dataTablesCard student-tab dataTable no-footer"
                                id="example-student">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course</th>
                                        <th>Course Duration (In Months)</th>
                                        <th>Coures Prefix</th>
                                        <th>Semester Pattern</th>
                                        <th>Semester Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM courses";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $sno = 0;
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['id'];
                                            $courses = $row['courses'];
                                            $course_duration = $row['course_duration'];
                                            $course_prefix = $row['course_prefix'];
                                            $sem_parttern = $row['sem_parttern'];
                                            $course_des = $row['course_des'];
                                            $status = $row['status'];
                                            $sno += 1;
                                    ?>
                                        <tr>
                                        <td>
                                            <?php echo $sno; ?>
                                        </td>
                                        <td>
                                            <div class="trans-list">
                                                <h4><?php echo $courses; ?></h4>
                                            </div>
                                        </td>
                                        <td><?php echo $course_duration; ?></td>
                                        <td><?php echo $course_prefix; ?></td>
                                        <td><?php echo $sem_parttern; ?></td>
                                        <td><?php echo $course_des; ?></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked" checked>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                            </div>
                                        </td>
                                        <td>
                                            
                                            <button type="button" class="btn btn-sm light btn-info"><i
                                                    class="fa-solid fa-pen-to-square"></i></button>
                                            <button type="button" class="btn btn-sm light btn-danger"><i
                                                    class="fa-solid fa-trash-can"></i></button>
                                        </td>
                                    </tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/column-->
                </div>
            </div>
        </div>
        <!--**********************************
                    Footer start
                ***********************************-->
    </div>
</div>
<div class="modal fade" id="CoursesModal" tabindex="-1" aria-labelledby="CoursesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CoursesModalLabel">Course Management</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label mb-2">COURSE</label>
                                <input type="text" class="form-control" required id="exampleFormControlInput1"
                                    placeholder="COURSE" name="course">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput4" required class="form-label mb-2">COURSE DURATION </label>
                                <input type="number" class="form-control" placeholder="IN MONTHS" name="course_duration">
                            </div>

                        </div>
                        <div class="col-xl-6">

                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">COURSE PREFIX</label>
                                <input type="text" class="form-control" required id="exampleFormControlInput2"
                                    placeholder="COURSE PREFIX" name="course_prefix">
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-2">SEMESTER PATTERN</label>
                                <select class="default-select wide" aria-label="Default select example" name="sem_parttern">
                                    <option selected>Select Semester Pattern</option>
                                    <option value="yearly">Yearly</option>
                                    <option value="half yearly">Half Yearly</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput5" class="form-label mb-2">COURSE DESCRIPTION</label>
                                <textarea type="number" class="form-control" id="exampleFormControlInput5"
                                    placeholder="COURSE DESCRIPTION" name="course_des"></textarea>
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" name="save"><i
                                class="fa-regular fa-floppy-disk"></i> Save</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
// Insert Code
if (isset($_POST['save'])) {
    $course = $_POST['course'];
    $course_duration = $_POST['course_duration'];
    $course_prefix = $_POST['course_prefix'];
    $sem_parttern = $_POST['sem_parttern'];
    $course_des = $_POST['course_des'];
    $sqlCheck = "SELECT * FROM courses WHERE courses = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("s", $course);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        echo '<script>
        swal("Error!", "Course already exists!", "error");
        </script>';
        exit;
    } else {
        // Use a different variable for the second prepared statement
        $sqlInsert = "INSERT INTO `courses`(`courses`, `course_duration`, `course_prefix`, `sem_parttern`, `course_des`, `added_by`) VALUES (?, ?, ?, ?, ?, 'admin')";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("sssss", $course, $course_duration, $course_prefix, $sem_parttern, $course_des);

        if ($stmtInsert->execute()) {
            echo '<script>
                swal("Success!", "", "success");
                setTimeout(function(){
                    window.location.href =  window.location.href
                }, 1000);
            </script>';
            exit;
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
    $editName = $_POST['editName'];
    $editEmail = $_POST['editEmail'];
    $editMobile = $_POST['editMobile'];
    $editRole = $_POST['editRole'];

    $sql = "UPDATE `user` SET `name`='$editName',`email`='$editEmail',`mobile`='$editMobile',`role`='$editRole' WHERE id = '$editId'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo '<script>
            swal("Success!", "This user has been successfully Updated", "success");
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