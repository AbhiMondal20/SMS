<?php
include('header.php');

if (isset($_GET['type']) && $_GET['type'] === 'delete' && isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    $sql2 = "DELETE FROM `batches` WHERE id = ?";
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>
                swal('Success!', '', 'success');
                setTimeout(function(){
                    window.location.href = 'batches';
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
                                    data-bs-target="#BatchesModal">
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
                                        <th>Session</th>
                                        <th>Course</th>
                                        <th>Batches</th>
                                        <th>No of Student</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT batches.id AS id, batches.batches_name AS batches_name, batches.start_date AS start_date, batches.end_date AS end_date, batches.no_student AS no_student, batches.batche_desc AS batche_desc, batches.status AS status, session.session AS session, courses.courses AS courses FROM batches INNER JOIN session ON batches.session_id = session.id INNER JOIN courses ON batches.course_id = courses.id;";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $sno = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['id'];
                                        $session = $row['session'];
                                        $courses = $row['courses'];
                                        $batches_name = $row['batches_name'];
                                        $no_student = $row['no_student'];
                                        $start_date = $row['start_date'];
                                        $end_date = $row['end_date'];
                                        $batche_desc = $row['batche_desc'];
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
                                                    <h4>
                                                        <?php echo $session; ?>
                                                    </h4>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo $courses; ?>
                                            </td>
                                            <td>
                                                <?php echo $batches_name; ?>
                                            </td>
                                            <td>
                                                <?php echo $no_student; ?>
                                            </td>
                                            <td>
                                                <?php echo $start_date; ?>
                                            </td>
                                            <td>
                                                <?php echo $end_date; ?>
                                            </td>
                                            <td>
                                                <?php echo $batche_desc; ?>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" <?php if ($status == '1') {
                                                        echo "checked";
                                                    } ?> id="flexSwitchCheckChecked"
                                                        onclick="toggleStatus(<?php echo $id; ?>)">
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="edit btn btn-sm light btn-info"
                                                    id="<?php echo $id; ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <a href="javascript:void()" class="delete btn btn-sm light btn-danger"
                                                    onclick="confirmDelete();"><i class="fa-solid fa-trash-can"></i></a>
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
<div class="modal fade" id="BatchesModal" tabindex="-1" aria-labelledby="BatchesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="BatchesModalLabel">Batches Management</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <div class="dropdown bootstrap-select form-select wide form-control dropup mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">SESSION</label>
                                    <select class="form-select wide form-control" id="validationCustom05" required=""
                                        name="session_id">
                                        <option selected="" disabled="" value="">Please select</option>
                                        <?php
                                        $sql = "SELECT * FROM session WHERE status = 1";
                                        $res = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $session_id = $row['id'];
                                            $session = $row['session'];
                                            echo '<option value="' . $session_id . '">' . $session . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <div class="dropdown bootstrap-select form-select wide form-control dropup mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">COURSE</label>
                                    <select class="form-select wide form-control" id="validationCustom05" required=""
                                        name="course_id">
                                        <option selected="" disabled="" value="">Please select</option>
                                        <?php
                                        $sql = "SELECT * FROM courses WHERE status = 1";
                                        $res = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $session_id = $row['id'];
                                            $courses = $row['courses'];
                                            echo '<option value="' . $session_id . '">' . $courses . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">NAME</label>
                                <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="NAME"
                                    required name="batches_name">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">NO OF STUDENTS</label>
                                <input type="text" class="form-control" id="exampleFormControlInput2"
                                    placeholder="NO OF STUDENTS" required name="no_student">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label mb-2">START DATE</label>
                                <input type="date" class="form-control" id="start_date" placeholder="START DATE"
                                    value="<?php echo date('Y-m-d'); ?>" name="start_date"
                                    min="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="end_date" class="form-label mb-2">END DATE</label>
                                <input type="date" class="form-control" id="end_date" placeholder="END DATE"
                                    value="<?php echo date('Y-m-d'); ?>" name="end_date"
                                    min="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput5" class="form-label mb-2">BATCHE
                                    DESCRIPTION</label>
                                <textarea class="form-control" id="exampleFormControlInput5"
                                    placeholder="BATCHE DESCRIPTION" name="batche_desc"></textarea>
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
                <h5 class="modal-title" id="EditModals">Edit Session</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                <input type="hidden" name="editId" id="editId">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <div class="dropdown bootstrap-select form-select wide form-control dropup mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">SESSION</label>
                                    <select class="form-select wide form-control" id="edit_session_id" required="" name="edit_session_id">
                                        <option disabled="" value="">Please select</option>
                                        <?php
                                        $sql = "SELECT * FROM session WHERE status = 1";
                                        $res = mysqli_query($conn, $sql);
                                        $editSessionId = isset($_POST['edit_session_id']) ? $_POST['edit_session_id'] : null;
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $session_id = $row['id']; 
                                            $session = $row['session'];
                                            $selected = ($editSessionId == $session_id) ? 'selected' : '';
                                            echo '<option value="' . $session_id . '" ' . $selected . '>' . $session . '</option>';
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <div class="dropdown bootstrap-select form-select wide form-control dropup mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">COURSE</label>
                                    <select class="form-select wide form-control" id="editCourse_id" required="" name="editCourse_id">
                                        <option selected="" disabled="" value="">Please select</option>
                                        <?php
                                        $sql = "SELECT * FROM courses WHERE status = 1";
                                        $res = mysqli_query($conn, $sql);
                                        $selectedCourseId = isset($_POST['editCourse_id']) ? $_POST['editCourse_id'] : null;
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $courseId = $row['id'];
                                            $courseName = $row['courses'];
                                            $selected = ($selectedCourseId == $courseId) ? 'selected' : '';
                                            echo '<option value="' . $courseId . '" ' . $selected . '>' . $courseName . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">NAME</label>
                                <input type="text" class="form-control" id="editBatches_name" placeholder="NAME" required name="editBatches_name">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">NO OF STUDENTS</label>
                                <input type="text" class="form-control" id="editNo_student"
                                    placeholder="NO OF STUDENTS" required name="editNo_student">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label mb-2">START DATE</label>
                                <input type="date" class="form-control" id="editStart_date" placeholder="START DATE"
                                    value="<?php echo date('Y-m-d'); ?>" name="editStart_date"
                                    min="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="end_date" class="form-label mb-2">END DATE</label>
                                <input type="date" class="form-control" id="editEnd_date" placeholder="END DATE"
                                    value="<?php echo date('Y-m-d'); ?>" name="editEnd_date"
                                    min="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput5" class="form-label mb-2">BATCHE
                                    DESCRIPTION</label>
                                <textarea class="form-control" id="editBatche_desc"
                                    placeholder="BATCHE DESCRIPTION" name="editBatche_desc"></textarea>
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" name="editSave">
                            <i class="fa-regular fa-floppy-disk"></i> Save
                        </button>
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
                const session_id = tr.querySelector('td:nth-child(3)').innerText;
                const course_id = tr.querySelector('td:nth-child(4)').innerText;
                const batches_name = tr.querySelector('td:nth-child(5)').innerText;
                const no_student = tr.querySelector('td:nth-child(6)').innerText;
                const start_date = tr.querySelector('td:nth-child(7)').innerText;
                const end_date = tr.querySelector('td:nth-child(8)').innerText;
                const batche_desc = tr.querySelector('td:nth-child(9)').innerText;
                console.log(id, session_id, course_id);
                document.getElementById('editId').value = id;
                document.getElementById('edit_session_id').value = session_id;
                document.getElementById('editCourse_id').value = course_id;
                document.getElementById('editBatches_name').value = batches_name;
                document.getElementById('editNo_student').value = no_student;
                document.getElementById('editStart_date').value = start_date;
                document.getElementById('editEnd_date').value = end_date;
                document.getElementById('editBatche_desc').value = batche_desc;
                $('#EditModal').modal('show');
            });
        });
    });

    // Delete Script
    function confirmDelete() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this Batche!',
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
        swal({
            title: "Are you sure?",
            text: "Do you want to Change the Batche status?",
            icon: "warning",
            buttons: {
                cancel: "Cancel", // Rename the Cancel button
                confirm: "OK"     // Rename the OK button
            },
            dangerMode: true,
        }).then((confirmed) => {
            if (confirmed) {
                $.ajax({
                    url: "load/batches_update_status.php",
                    type: "post",
                    data: { chatId: id },
                    success: function (result) {
                    }
                });
            } else {
            }
        });
    }

    // Date Range
    var startDateInput = document.getElementById('start_date');
    startDateInput.addEventListener('input', function () {
        var endDateInput = document.getElementById('end_date');
        endDateInput.min = startDateInput.value;
    });
</script>

<?php
// Insert Code
if (isset($_POST['save'])) {
    $session_id = $_POST['session_id'];
    $course_id = $_POST['course_id'];
    $batches_name = $_POST['batches_name'];
    $no_student = $_POST['no_student'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $batche_desc = $_POST['batche_desc'];
    $sqlCheck = "SELECT * FROM batches WHERE batches_name = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("s", $batches_name);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        echo '<script>
        swal("Error!", "Batches already exists!", "error");
        setTimeout(function(){
            window.location.href =  window.location.href
        }, 2000);
        </script>';
        exit;
    } else {
        $sqlInsert = "INSERT INTO `batches`(`session_id`, `course_id`, `batches_name`, `no_student`, `start_date`, `end_date`, `batche_desc`, `added_by`) VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("iisisis", $session_id, $course_id, $batches_name, $no_student, $start_date, $end_date, $batche_desc);

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
    $edit_session_id = $_POST['edit_session_id'];
    $editCourse_id = $_POST['editCourse_id'];
    $editBatches_name = $_POST['editBatches_name'];
    $editNo_student = $_POST['editNo_student'];
    $editStart_date = $_POST['editStart_date'];
    $editEnd_date = $_POST['editEnd_date'];
    $editBatche_desc = $_POST['editBatche_desc'];
    $modified_date = date('Y-m-d H:i:s');
    $sql = "UPDATE `batches` SET `session_id`= ?,`course_id`= ? ,`batches_name`= ? ,`no_student`= ?,`start_date`= ?,`end_date`= ?,`batche_desc`= ?,`modified_by`= ?,`modified_date`= ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $modified_by = 1;
    $stmt->bind_param("iisiiisiii", $edit_session_id, $editCourse_id, $editBatches_name, $editNo_student, $editStart_date, $editEnd_date, $editBatche_desc, $modified_by, $modified_date, $editId);
    $res = $stmt->execute();

    // Check the result
    if ($res) {
        echo '<script>
        swal("Success!", "This Batches has been successfully Updated", "success");
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