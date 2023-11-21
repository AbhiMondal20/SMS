<?php
include('header.php');

if (isset($_GET['type']) && $_GET['type'] === 'delete' && isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    $sql2 = "DELETE FROM `courses` WHERE id = ?";
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>
                swal('Success!', '', 'success');
                setTimeout(function(){
                    window.location.href = 'courses';
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
                                        <td style="display:none">
                                                <?php echo $id; ?>
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
                                                    <input class="form-check-input" type="checkbox" role="switch" <?php if ($status == '1') {
                                                        echo "checked";
                                                    } ?> id="flexSwitchCheckChecked"
                                                        onclick="toggleStatus(<?php echo $id; ?>)">
                                            </div>
                                        </td>
                                        <td>
                                            
                                            <button type="button" class="edit btn btn-sm light btn-info" id="<?php echo $id; ?>"><i
                                                    class="fa-solid fa-pen-to-square"></i></button>
                                            <a href="javascript:void()" class="delete btn btn-sm light btn-danger" onclick="confirmDelete();"><i class="fa-solid fa-trash-can"></i></a>
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
<!-- Add Modal -->
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
                                    <option value="Yearly">Yearly</option>
                                    <option value="Half Yearly">Half Yearly</option>
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
                        <button type="submit" class="btn btn-primary" name="save">
                            <i class="fa-regular fa-floppy-disk"></i> Save
                        </button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditModals">Edit Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                <input type="hidden" name="editId" id="editId">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label mb-2">COURSE</label>
                                <input type="text" class="form-control" required id="editCourse"
                                    placeholder="COURSE" name="editCourse">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput4" required class="form-label mb-2">COURSE DURATION </label>
                                <input type="text" class="form-control" placeholder="IN MONTHS" name="editCourse_duration" id="editCourse_duration">
                            </div>

                        </div>
                        <div class="col-xl-6">

                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">COURSE PREFIX</label>
                                <input type="text" class="form-control" required id="editCourse_prefix"
                                    placeholder="COURSE PREFIX" name="editCourse_prefix">
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-2">SEMESTER PATTERN</label>
                                <select class="default-select wide" aria-label="Default select example" name="editSem_parttern" id="editSem_parttern">
                                    <option selected>Select Semester Pattern</option>
                                    <option value="Yearly">Yearly</option>
                                    <option value="Half Yearly">Half Yearly</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput5" class="form-label mb-2">COURSE DESCRIPTION</label>
                                <textarea type="number" class="form-control" id="editCourse_des"
                                    placeholder="COURSE DESCRIPTION" name="editCourse_des"></textarea>
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" name="editSave"><i
                                class="fa-regular fa-floppy-disk"></i> Save</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const edits = document.getElementsByClassName('edit');
    
    Array.from(edits).forEach((element) => {
        element.addEventListener('click', function (e) {
            const tr = e.target.closest('tr');
            const id = tr.querySelector('td:nth-child(2)').innerText;
            const course = tr.querySelector('td:nth-child(3)').innerText;
            const course_duration = tr.querySelector('td:nth-child(4)').innerText;
            const course_prefix = tr.querySelector('td:nth-child(5)').innerText;
            const sem_pattern = tr.querySelector('td:nth-child(6)').innerText;
            const course_des = tr.querySelector('td:nth-child(7)').innerText;
            document.getElementById('editId').value = id;
            document.getElementById('editCourse').value = course;
            document.getElementById('editCourse_duration').value = course_duration;
            document.getElementById('editCourse_prefix').value = course_prefix;
            document.getElementById('editSem_parttern').value = sem_pattern;
            document.getElementById('editCourse_des').value = course_des;
            $('#EditModal').modal('show');
        });
    });
});

 // Delete Script
 function confirmDelete() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this course!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "?id=<?php echo $id; ?>&type=delete";
            }
        });
    }

// Status
    function toggleStatus(id) {
        var id = id;
        // Show a confirmation SweetAlert
        swal({
            title: "Are you sure?",
            text: "Do you want to Change the Course status?",
            icon: "warning",
            buttons: {
                cancel: "Cancel", // Rename the Cancel button
                confirm: "OK"     // Rename the OK button
            },
            dangerMode: true,
        }).then((confirmed) => {
            if (confirmed) {
                // If the course confirms, make the AJAX request and set the status to "Active"
                $.ajax({
                    url: "load/course_update_status.php",
                    type: "post",
                    data: { chatId: id },
                    success: function (result) {
                        // if (result == '1') {
                        //     swal("Success", "course is now Active", "success");
                        // }else if (result == '0') {
                        //     swal("Success", "course is now Inactive", "success");
                        // }
                        //  else {
                        //     swal("Error", "Failed to update course status", "error");
                        // }
                    }
                });
            } else {
                // If the course cancels, do nothing (status remains unchanged)
            }
        });
    }

</script>

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
    $editCourse = $_POST['editCourse'];
    $editCourse_duration = $_POST['editCourse_duration'];
    $editCourse_prefix = $_POST['editCourse_prefix'];
    $editSem_parttern = $_POST['editSem_parttern'];
    $editCourse_des = $_POST['editCourse_des'];
    $modified_date = date('Y-m-d H:i:s');

    // Prepare and bind the SQL statement
    $sql = "UPDATE courses SET courses=?, course_duration=?, course_prefix=?, sem_parttern=?, course_des=?, modified_by=?, modified_date=? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssssssi", $editCourse, $editCourse_duration, $editCourse_prefix, $editSem_parttern, $editCourse_des, $modified_by, $modified_date, $editId);

    // Execute the statement
    $res = $stmt->execute();

    // Close the statement
    $stmt->close();

    // Check the result
    if ($res) {
        echo '<script>
            swal("Success!", "This Course has been successfully Updated", "success");
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