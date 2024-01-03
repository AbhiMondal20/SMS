<?php
include('header.php');
if (isset($_GET['type']) && $_GET['type'] === 'delete' && isset($_GET['month']) && isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    $month = $_GET['month'];
    $sql2 = "DELETE FROM `monthly_fees` WHERE id = ? AND month = ?";
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("is", $id, $month);
    if ($stmt->execute()) {
        $sql2 = "DELETE FROM `monthly_fees_menu` WHERE month = ?";
        $stmt = $conn->prepare($sql2);
        $stmt->bind_param("s", $month);
        if ($stmt->execute()) {
            echo "<script>
                    swal('Success!', '', 'success');
                    setTimeout(function(){
                        window.location.href = 'monthly-fees';
                    }, 2000);
            </script>";
            exit;
        }
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
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                    data-bs-target=".bd-example-modal-lg">
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
                                        <th>Year</th>
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
                                    $sql = "SELECT monthly_fees.id AS id, monthly_fees.batch_id AS batch_id, batches.batches_name AS batches_name, monthly_fees.year AS year, monthly_fees.month AS month, monthly_fees.late_fine_due_date AS late_fine_due_date, monthly_fees.late_fine_amount AS late_fine_amount, monthly_fees.total_fees AS total_fees, monthly_fees.status AS status FROM `monthly_fees` INNER JOIN batches ON batches.id = monthly_fees.batch_id";
                                    $stmt = $conn->prepare($sql);
                                    if (!$stmt) {
                                        die("Error in SQL query: " . $conn->error);
                                    }
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $sno = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $sno += 1;
                                        $fees_id = $row['id'];
                                        $batch_id = $row['batch_id'];
                                        $batches_name = $row['batches_name'];
                                        $year = $row['year'];
                                        $month = $row['month'];
                                        $late_fine_due_date1 = $row['late_fine_due_date'];
                                        $timestamp = strtotime($late_fine_due_date1);
                                        $late_fine_due_date = date('d M Y', $timestamp);
                                        $late_fine_amount = $row['late_fine_amount'];
                                        $total_fees = $row['total_fees'];
                                        $status = $row['status'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $sno; ?>
                                            </td>
                                            <td style="display:none">
                                                <?php echo $fees_id; ?>
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
                                                        <?php echo $year; ?>
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
                                                <a href="edit-monthly-fees?id=<?php echo $fees_id; ?>&batchId=<?php echo $batch_id; ?>&month=<?php echo $month; ?>" class="edit btn btn-sm light btn-info">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
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
                                <select class="form-select wide form-control" id="batch" onchange="updateYearOptions()"
                                    required="" name="batch_id">
                                    <option value="" disabled selected>Select Batch</option>
                                    <?php
                                    // Assuming $conn is your database connection
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
                        <div class="col-xl-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">YEAR</label>
                                <input type="text" name="year" class="form-control" value="<?php echo date('Y'); ?>">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">MONTH</label>
                                <select class="form-select wide form-control" id="validationCustom05" required=""
                                    name="month">
                                    <option disabled selected>Select</option>
                                    <option value="Jan">Jan</option>
                                    <option value="Feb">Feb</option>
                                    <option value="Mar">Mar</option>
                                    <option value="Apr">Apr</option>
                                    <option value="May">May</option>
                                    <option value="Jun">Jun</option>
                                    <option value="Jul">Jul</option>
                                    <option value="Aug">Aug</option>
                                    <option value="Sep">Sep</option>
                                    <option value="Oct">Oct</option>
                                    <option value="Nov">Nov</option>
                                    <option value="Dec">Dec</option>
                                </select>
                            </div>
                        </div>
                        <table class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th>FEES HEAD</th>
                                    <th>AMOUNT</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id='fees_tbody'>
                                <tr>
                                    <td>
                                        <select class='form-select wide form-control' id='validationCustom05' required
                                            name='fees_head[]'>
                                            <option>Select</option>
                                            <?php
                                            $sql = "SELECT * FROM fees_head WHERE status = 1";
                                            $res = mysqli_query($conn, $sql);
                                            while ($rows = mysqli_fetch_assoc($res)) {
                                                $title = $rows['title'];
                                                $id = $rows['id'];
                                                echo "<option value='" . $id . "'>" . $title . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><input type='text' required name='amount[]'
                                            class='form-control total shadow-none'></td>
                                    <td><input type='button' value='x'
                                            class='btn btn-danger btn-sm btn-row-remove shadow-none'> </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type='button' value='+ Add Row' class='btn btn-primary btn-sm'
                                            id='btn-add-row'></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="col-xl-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">LATE FINE DUE DATE</label>
                                <input class="datepicker-default form-control" id="datepicker" value="<?php echo date('Y-m-d') ?>" required name="late_due_date">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">LATE FINE AMOUNT</label>
                                <input type="text" class="form-control" id="exampleFormControlInput2"
                                    placeholder="LATE FINE AMOUNT" name="late_fine_amount">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">TOTAL FEES</label>
                                <input type="number" class="form-control" placeholder="TOTAL FEES" name="total_fees"
                                    id='total_fees'>
                            </div>
                        </div>
                        <center>
                            <button type="submit" class="btn btn-primary" name="save">
                                <i class="fa-regular fa-floppy-disk"></i> Save
                            </button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->

<div class="modal fade bd-example-modal-lg" id="EditModal" tabindex="-1" role="dialog" aria-hidden="true"
    aria-labelledby="EditModal">
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
                                <select class="form-select wide form-control" id="editBatch"
                                    onchange="getbatch(this.value)" required="" name="batch_id">
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
                                <select class="form-select wide form-control" id="editYear" name="edityear">
                                    <option disabled selected>Please select</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">MONTH</label>
                                <select class="form-select wide form-control" id="editMonth" required=""
                                    name="editmonth">
                                    <option disabled selected>Select</option>
                                    <option value="Jan">Jan</option>
                                    <option value="Feb">Feb</option>
                                    <option value="Mar">Mar</option>
                                    <option value="Apr">Apr</option>
                                    <option value="May">May</option>
                                    <option value="Jun">Jun</option>
                                    <option value="Jul">Jul</option>
                                    <option value="Aug">Aug</option>
                                    <option value="Sep">Sep</option>
                                    <option value="Oct">Oct</option>
                                    <option value="Nov">Nov</option>
                                    <option value="Dec">Dec</option>
                                </select>
                            </div>
                        </div>
                        <table class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th>FEES HEAD</th>
                                    <th>AMOUNT</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id='fees_tbody'>
                                <tr>
                                    <td>
                                        <select class='form-select wide form-control' id='validationCustom05' required
                                            name='fees_head[]'>
                                            <option>Select</option>
                                            <?php
                                            $sql = "SELECT * FROM fees_head WHERE status = 1";
                                            $res = mysqli_query($conn, $sql);
                                            while ($rows = mysqli_fetch_assoc($res)) {
                                                $title = $rows['title'];
                                                $id = $rows['id'];
                                                echo "<option value='" . $id . "'>" . $title . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><input type='text' required name='amount[]'
                                            class='form-control total shadow-none'></td>
                                    <td><input type='button' value='x'
                                            class='btn btn-danger btn-sm btn-row-remove shadow-none'> </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type='button' value='+ Add Row' class='btn btn-primary btn-sm'
                                            id='btn-add-row'></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="col-xl-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">LATE FINE DUE DATE</label>
                                <input type="date" class="form-control" id="editLast_Due_Date" placeholder="Fine Date"
                                    value="<?php echo date('Y-m-d') ?>" required name="editlate_due_date">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">LATE FINE AMOUNT</label>
                                <input type="text" class="form-control" id="exampleFormControlInput2"
                                    placeholder="LATE FINE AMOUNT" name="late_fine_amount">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">TOTAL FEES</label>
                                <input type="number" class="form-control" placeholder="TOTAL FEES" name="total_fees"
                                    id='total_fees'>
                            </div>
                        </div>
                        <center>
                            <button type="submit" class="btn btn-primary" name="save">
                                <i class="fa-regular fa-floppy-disk"></i> Save
                            </button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $("#btn-add-row").click(function () {
            var row = "<tr><td><select class='form-select wide form-control' id='validationCustom05' required name='fees_head[]'><?php $sql = "SELECT * FROM fees_head WHERE status = 1";
            $res = mysqli_query($conn, $sql);
            while ($rows = mysqli_fetch_assoc($res)) {
                $title = $rows['title'];
                $id = $rows['id'];
                echo '<option value=' . $id . '>' . $title . '</option>';
            } ?></select></td><td><input type='number' required name='amount[]' class='form-control total'></td> <td><input type='button' value='x' class='btn btn-danger btn-sm btn-row-remove'> </td> </tr>";
            $("#fees_tbody").append(row);
        });

        $("body").on("click", ".btn-row-remove", function () {
            if (confirm("Are You Sure?")) {
                $(this).closest("tr").remove();
                grand_total();
            }
        });

        function grand_total() {
            var tot = 0;
            $(".total").each(function () {
                tot += Number($(this).val()) || 0;
            });
            $("#total_fees").val(tot);
            console.log("Grand total updated: " + tot);
        }
    });

</script>

<script>
    function updateYearOptions(batch) {
        console.log(batch);
        $.ajax({
            url: "load/get_year.php",
            type: "POST",
            data: { batch: batch },
            dataType: "json",
            success: function (data) {
                var yearDropdown = $("#year");
                yearDropdown.empty().append('<option value="">-- Year --</option>');
                $.each(data, function (index, year) {
                    doctorDropdown.append('<option value="' + year.id + '">' + year.name + '</option>');
                });
            }
        });
    }

    // Edit Script
    document.addEventListener('DOMContentLoaded', function () {
        const edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener('click', function (e) {
                const tr = e.target.closest('tr');
                const id = tr.querySelector('td:nth-child(2)').innerText;
                const batch = tr.querySelector('td:nth-child(3)').innerText;
                const year = tr.querySelector('td:nth-child(4)').innerText;
                const month = tr.querySelector('td:nth-child(5)').innerText;
                const last_due_date = tr.querySelector('td:nth-child(5)').innerText;
                console.log(id, batch);
                console.log(year);
                console.log(month);
                console.log(last_due_date);
                document.getElementById('editId').value = id;
                document.getElementById('editBatch').value = batch;
                document.getElementById('editYear').value = year;
                document.getElementById('editMonth').value = month;
                document.getElementById('editLast_Due_Date').value = last_due_date;
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
                window.location.href = "?id=<?php echo $fees_id; ?>&type=delete&month=<?php echo $month; ?>";
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
    $batch_id = $_POST['batch_id'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $late_due_date = $_POST['late_due_date'];
    $late_fine_amount = $_POST['late_fine_amount'];
    $total_fees = $_POST['total_fees'];
    $added_by = 1;
    $rows = [];


    $sqlInsert = "INSERT INTO `monthly_fees`(`batch_id`, `year`, `month`, `late_fine_due_date`, `late_fine_amount`, `total_fees`, `added_by`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("iissssi", $batch_id, $year, $month, $late_due_date, $late_fine_amount, $total_fees, $added_by);
    if ($stmtInsert->execute()) {

        $sql = "INSERT INTO `monthly_fees_menu`(`batch_id`, `month`, `fees_head_id`, `amount`) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        for ($i = 0; $i < count($_POST['fees_head']); $i++) {
            $fees_head = $_POST['fees_head'][$i]; 
            $amount = $_POST['amount'][$i];
            $stmt->bind_param("isis", $batch_id, $month , $fees_head, $amount);
            if ($stmt->execute()) {
            } else {
                echo '<script>
                        swal("Error!", "Error inserting data.", "error");
                    </script>';
                exit;
            }
        }
        echo '<script>
                swal("Success!", "", "success");
                setTimeout(function(){
                    window.location.href = window.location.href;
                }, 1000);
            </script>';
        exit;

    } else {
        echo '<script>
            swal("Error!", "Error inserting data.", "error");
        </script>';
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