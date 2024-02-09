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
$batchId = $_GET['batchId'];
$month = $_GET['month'];

$sql = "SELECT monthly_fees.id AS id, monthly_fees.batch_id AS batch_id, batches.batches_name AS batches_name, monthly_fees.year AS year, monthly_fees.month AS month, monthly_fees.late_fine_due_date AS late_fine_due_date, monthly_fees.late_fine_amount AS late_fine_amount, monthly_fees.total_fees AS total_fees, monthly_fees.status AS status FROM `monthly_fees` INNER JOIN batches ON batches.id = monthly_fees.batch_id WHERE monthly_fees.id = $id AND monthly_fees.batch_id = $batchId";
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
}
?>
<div class="content-body">
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">BATCH</label>
                                            <select class="form-select wide form-control" id="batch"
                                                onchange="getbatch(this.value)" required="" name="batch_id">
                                                <option disabled selected>Please select</option>
                                                <?php
                                                // Assuming $conn is your database connection
                                                $sql = "SELECT * FROM batches";
                                                $res = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_assoc($res)) {
                                                    $batches_name = $row['batches_name'];
                                                    $id = $row['id'];
                                                    echo '<option value="' . $id . '" ' . (($batch_id == $id) ? 'selected' : '') . '>' . $batches_name . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">YEAR</label>
                                            <select class="form-select wide form-control" id="year" name="year">
                                                <option disabled selected>Please select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">MONTH</label>
                                            <select class="form-select wide form-control" id="validationCustom05" required="" name="month">
                                                <option disabled <?php echo ($month == "") ? 'selected' : ''; ?>>Select</option>
                                                <option value="Jan" <?php echo ($month == "Jan") ? 'selected' : ''; ?>>Jan</option>
                                                <option value="Feb" <?php echo ($month == "Feb") ? 'selected' : ''; ?>>Feb</option>
                                                <option value="Mar" <?php echo ($month == "Mar") ? 'selected' : ''; ?>>Mar</option>
                                                <option value="Apr" <?php echo ($month == "Apr") ? 'selected' : ''; ?>>Apr</option>
                                                <option value="May" <?php echo ($month == "May") ? 'selected' : ''; ?>>May</option>
                                                <option value="Jun" <?php echo ($month == "Jun") ? 'selected' : ''; ?>>Jun</option>
                                                <option value="Jul" <?php echo ($month == "Jul") ? 'selected' : ''; ?>>Jul</option>
                                                <option value="Aug" <?php echo ($month == "Aug") ? 'selected' : ''; ?>>Aug</option>
                                                <option value="Sep" <?php echo ($month == "Sep") ? 'selected' : ''; ?>>Sep</option>
                                                <option value="Oct" <?php echo ($month == "Oct") ? 'selected' : ''; ?>>Oct</option>
                                                <option value="Nov" <?php echo ($month == "Nov") ? 'selected' : ''; ?>>Nov</option>
                                                <option value="Dec" <?php echo ($month == "Dec") ? 'selected' : ''; ?>>Dec</option>
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
                                                    <select class='form-select wide form-control'
                                                        id='validationCustom05' required name='fees_head[]'>
                                                        <option>Select</option>
                                                        <?php
                                                        $sql = "SELECT fees_head.id AS id, fees_head.title AS title FROM fees_head INNER JOIN monthly_fees_menu ON monthly_fees_menu.fees_head_id = fees_head.id WHERE status = 1";
                                                        $res = mysqli_query($conn, $sql);
                                                        while ($rows = mysqli_fetch_assoc($res)) {
                                                            $title = $rows['title'];
                                                            $id = $rows['id'];
                                                            echo '<option value="' . $id . '" ' . (($batch_id == $id) ? 'selected' : '') . '>' . $title . '</option>';
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
                                                <td><input type='button' value='+ Add Row'
                                                        class='btn btn-primary btn-sm' id='btn-add-row'></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="col-xl-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">LATE FINE DUE
                                                DATE</label>
                                            <input type="date" class="form-control" id="exampleFormControlInput2"
                                                placeholder="Fine Date" value="<?php echo $late_fine_due_date ?>" required
                                                name="late_due_date">
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">LATE FINE
                                                AMOUNT</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput2"
                                                placeholder="LATE FINE AMOUNT" name="late_fine_amount" <?php echo $late_fine_amount; ?>>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2" class="form-label mb-2">TOTAL
                                                FEES</label>
                                            <input type="number" class="form-control" placeholder="TOTAL FEES"
                                                name="total_fees" id="total_fee" <?php echo $total_fees; ?>>
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

    // Year dropdown Script
    function getbatch(batch) {
        $.ajax({
            url: "load/get_year.php",
            type: "POST",
            data: { batch: batch },
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

</script>

<?php
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