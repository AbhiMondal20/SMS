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
    $sql2 = "DELETE FROM `fees_head` WHERE id = ?";
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>
                swal('Success!', '', 'success');
                setTimeout(function(){
                    window.location.href = 'fees-head';
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
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM `fees_head`";
                                        $stmt = $conn->prepare($sql);
                                        if (!$stmt) {
                                            die("Error in SQL query: " . $conn->error);
                                        }
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                            $sno = 0;
                                            while ($row = $result->fetch_assoc()) {
                                                $id = $row['id'];
                                                $title = $row['title'];
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
                                                        <?php echo $title; ?>
                                                    </h4>
                                                </div>
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
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">TITLE</label>
                                <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="TITLE"
                                    required name="title">
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
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">TITLE</label>
                                <input type="text" class="form-control" id="editTitle" placeholder="TITLE" required name="editTitle">
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
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener('click', function (e) {
                const tr = e.target.closest('tr');
                const id = tr.querySelector('td:nth-child(2)').innerText;
                const title = tr.querySelector('td:nth-child(3)').innerText;
                console.log(id, title);
                document.getElementById('editId').value = id;
                document.getElementById('editTitle').value = title;
                $('#EditModal').modal('show');
            });
        });
    });

    // Delete Script
    function confirmDelete() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this Title!',
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
            text: "Do you want to Change the Fees Head Title status?",
            icon: "warning",
            buttons: {
                cancel: "Cancel", // Rename the Cancel button
                confirm: "OK"     // Rename the OK button
            },
            dangerMode: true,
        }).then((confirmed) => {
            if (confirmed) {
                $.ajax({
                    url: "load/fees_head_update_status.php",
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
    $title = $_POST['title'];
    $sqlCheck = "SELECT * FROM fees_head WHERE title = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("s", $title);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        echo '<script>
        swal("Error!", "Title already exists!", "error");
        setTimeout(function(){
            window.location.href =  window.location.href
        }, 2000);
        </script>';
        exit;
    } else {
        $sqlInsert = "INSERT INTO `fees_head`(`title`, `status`, `added_by`) VALUES (?, '1', '1')";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("s", $title);
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
    $editTitle = $_POST['editTitle'];
    $modified_by = 1;
    
    $modified_date = date('Y-m-d H:i:s');
    $sql = "UPDATE `fees_head` SET `title`= ?,`modified_by`= ?,`modified_date`= ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $modified_by = 1;
    $stmt->bind_param("sisi", $editTitle, $modified_by, $modified_date, $editId);
    $res = $stmt->execute();

    // Check the result
    if ($res) {
        echo '<script>
        swal("Success!", "This Fees Head Title has been successfully Updated", "success");
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