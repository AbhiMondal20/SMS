<?php
include('header.php');
if (isset($_GET['type']) && $_GET['type'] === 'delete' && isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    $sql2 = "DELETE FROM `monthly_fees` WHERE id = ?";
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>
                swal('Success!', '', 'success');
                setTimeout(function(){
                    window.location.href = 'monthly-fees';
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
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
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
                                        <th>Batch</th>
                                        <th>Month</th>
                                        <th>Last Fine Due Date</th>
                                        <th>Last Fine Amount</th>
                                        <th>Total Fees</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM `monthly_fees` INNER JOIN batches ON batches.id = monthly_fees.batch_id";
                                    $stmt = $conn->prepare($sql);
                                    if (!$stmt) {
                                        die("Error in SQL query: " . $conn->error);
                                    }
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $sno = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $sno += 1;
                                        $id = $row['id'];
                                        $batch_id = $row['batch_id'];
                                        $batches_name = $row['batches_name'];
                                        $year = $row['year'];
                                        $month = $row['month'];
                                        $late_fine_due_date = $row['late_fine_due_date'];
                                        $late_fine_amount = $row['late_fine_amount'];
                                        $total_fees = $row['total_fees'];
                                        $status = $row['status'];
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
                                                        <?php echo $batches_name; ?>
                                                    </h4>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="trans-list">
                                                    <h4>
                                                        <?php echo $month; ?>
                                                    </h4>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="trans-list">
                                                    <h4>
                                                        <?php echo $late_fine_due_date; ?>
                                                    </h4>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="trans-list">
                                                    <h4>
                                                        ₹
                                                        <?php echo $late_fine_amount; ?>
                                                    </h4>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="trans-list">
                                                    <h4>
                                                        ₹
                                                        <?php echo $total_fees; ?>
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
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Fees Management</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">BATCH</label>
                                <select class="form-select wide form-control" id="batch" onchange="getbatch(this.value)" required="" name="batch">
                                    <option disabled selected>Please select</option>
                                    <?php
                                    // Assuming $conn is your database connection
                                    $sql = "SELECT * FROM batches";
                                    $res = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $batches_name = $row['batches_name'];
                                        $id = $row['id'];
                                        echo '<option value="' . $id . '">' . $batches_name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">YEAR</label>
                                <select class="form-select wide form-control" id="year" required="" name="year">
                                    <option disabled selected>Please select</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">MONTH</label>
                                <select class="form-select wide form-control" id="validationCustom05" required=""
                                    name="month">
                                        <option disabled selected>Select</option>
                                        <option value="1">Jan</option>
                                        <option value="2">Feb</option>
                                        <option value="3">Mar</option>
                                        <option value="4">Apr</option>
                                        <option value="5">May</option>
                                        <option value="6">Jun</option>
                                        <option value="7">Jul</option>
                                        <option value="8">Aug</option>
                                        <option value="9">Sep</option>
                                        <option value="10">Oct</option>
                                        <option value="11">Nov</option>
                                        <option value="12">Dec</option>
                                </select>
                            </div>
                        </div>
                        <div id="form-container">
                            <div class="col-xl-4">
                                <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">FEES HEAD</label>
                                <select class="form-select wide form-control" id="validationCustom05" required=""
                                    name="fees_head">
                                    <option value="0">Select</option>
                                    <option value="2">Tuition fees</option>
                                    <option value="5">Affiliation fees</option>
                                    <option value="4">Library fees</option>
                                    <option value="6">Celebration</option>
                                    <option value="7">Computer fee</option>
                                    <option value="8">Development fees</option>
                                    <option value="9">Lamp Lighting fee</option>
                                    <option value="10">Hostel Rent</option>
                                    <option value="11">Bus fees</option>
                                    <option value="12">Electricity</option>
                                    <option value="13">Fooding </option>
                                    <option value="14">Annual fees</option>
                                    <option value="15">Hostel Rent 1st Month</option>
                                    <option value="16">Celebration etc</option>
                                </select>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label mb-2">AMOUNT</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="Amount"
                                        required name="amount">
                                </div>
                            </div>
                            
                            <div class="col-xl-4 mt-4">
                                <button class="btn btn-primary" id="add_btn" onclick="addNewRow()">+ Add</button>
                                <button class="btn btn-primary" id="delete_btn" onclick="addNewRow()"><i class="fa-solid fa-trash-can"></i></button>
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
                                <input type="text" class="form-control" id="editTitle" placeholder="TITLE" required
                                    name="editTitle">
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
        function addNewRow() {
            // Clone the existing form container
            var formContainer = document.getElementById('form-container');
            var clonedRow = formContainer.cloneNode(true);

            // Clear input values in the cloned row
            var inputs = clonedRow.getElementsByTagName('input');
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].value = '';
            }

            // Append the cloned row to the container
            formContainer.parentNode.appendChild(clonedRow);
        }
    </script>

<script>
    
// Year dropdown Script
function getbatch(batch) {
    $.ajax({
        url: "load/get_year.php",
        type: "POST",
        data: { batch: batch },
        console.log(batch);
            dataType: "json",
            success: function (data) {
                var yearDropdown = $("#year");
                yearDropdown.empty().append('<option value="">-- Select --</option>');
                $.each(data, function (index, year) {
                    yearDropdown.append('<option value="' + year.id + '">' + year.name + '</option>');
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
            }
        });
    }


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
                    url: "load/monthly_fees_update_status.php",
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
    $sqlCheck = "SELECT * FROM monthly_fees WHERE title = ?";
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
        $sqlInsert = "INSERT INTO `monthly_fees`(`title`, `status`, `added_by`) VALUES (?, '1', '1')";
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
    $sql = "UPDATE `monthly_fees` SET `title`= ?,`modified_by`= ?,`modified_date`= ? WHERE id = ?";
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