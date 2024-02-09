<?php
session_start();
if(isset($_SESSION['login']) && $_SESSION['login'] == true) {   
    // $user_email = $_SESSION['user_email'];
}
else{
    echo "<script>location.href='../login';</script>";
}
include('header.php');
?>
<?php

if (isset($_GET['id']) && $_GET['id'] === '1') {
    $id = $_GET['id'];
    $sql2 = "UPDATE `monthly_fees` SET `pay_status`= 1 WHERE id = ?";
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("ss", $id);
    if ($stmt->execute()) {
        echo "<script>
                swal('Success!', '', 'success');
                setTimeout(function(){
                    window.location.href = window.location.href;
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
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="GET" action="">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="stu_id"
                                            placeholder="Enter Student Id">
                                    </div>
                                    <div class="col-sm-4 mt-2 mt-sm-0">
                                        <input type="date" class="form-control" name="date"
                                            value="<?php echo date('Y-m-d') ?>">
                                    </div>
                                    <div class="col-sm-4 mt-2 mt-sm-0">
                                        <input type="submit" class="btn btn-primary" placeholder="" value="Search"
                                            name="search">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_GET['search'])) {
                $stu_id = $_GET['stu_id'];
                // $batch_id = "";
                $stu_id = mysqli_real_escape_string($conn, $_GET['stu_id']);
                $date = mysqli_real_escape_string($conn, $_GET['date']);
                $sql = "SELECT * FROM `student` WHERE stu_id = '$stu_id'";
                $res_student = mysqli_query($conn, $sql);
                if ($res_student) {
                    while ($row = mysqli_fetch_assoc($res_student)) {
                        $batch_id = $row['batch_id'];
                    }
                    $sql = "SELECT monthly_fees.id AS id, year, month FROM `monthly_fees` WHERE pay_status = '0' AND batch_id = '$batch_id'";
                    $res_monthly_fees = mysqli_query($conn, $sql);
                    if ($res_monthly_fees) {
                        while ($row_monthly_fees = mysqli_fetch_assoc($res_monthly_fees)) {
                            $monthly_fees_id = $row_monthly_fees['id'];
                            $month = $row_monthly_fees['month'];
                            $year = $row_monthly_fees['year'];
                            echo '
                            <div class="col-xl-3 col-lg-4">
                                <div class="clearfix">
                                    <div class="card card-bx profile-card author-profile m-b30">
                                        <div class="card-body ">
                                            <div class="card-header border-0 ">
                                                <h2 class="card-title">' . $month . '- ' . $year .'</h2>
                                            </div>
                                            <div class="info-list">
                                                <ul>';
                            $total_price = 0;
                            $encountered_titles = array();
                            $sql = "SELECT monthly_fees_menu.id AS id, fees_head_id, title, amount, month , monthly_fees_menu.status AS status, pay_status 
                            FROM `monthly_fees_menu` 
                            INNER JOIN fees_head ON fees_head.id = monthly_fees_menu.fees_head_id 
                            WHERE month = '$month' AND batch_id = '$batch_id' AND pay_status = '0' GROUP BY fees_head_id";
                            $res_fees_head = mysqli_query($conn, $sql);
                            while ($row_fees_head = mysqli_fetch_assoc($res_fees_head)) {
                                $title = $row_fees_head['title'];
                                $amount = $row_fees_head['amount'];
                                if (
                                    ($title == 'Hostel Rent' && in_array('Hostel Rent 1st Month', $encountered_titles)) ||
                                    ($title == 'Hostel Rent 1st Month' && in_array('Hostel Rent', $encountered_titles))
                                ) {
                                    continue;
                                }
                                $encountered_titles[] = $title;
                                $total_price += $amount;
                                echo '<li>' . $title . '<span>' . $amount . '</span></li>';
                            }
                            echo '</ul>
                                </div>
                            </div>
                            <div class="card-header border-0 ">
                                <h2 class="card-title"> Total: &nbsp; ₹' . $total_price . '</h2>
                            </div>
                            <div class="card-footer">
                                <div class="input-group">
                                        <div class="form-check custom-checkbox mb-2">
                                            <center>
                                                <input type="checkbox" class="form-check-input" id="fees_id_' . $monthly_fees_id . '"  value="' . $total_price . '" onchange="updateTotal()" >
                                                <label class="form-check-label" for="' . $monthly_fees_id . '">Pay</label>
                                            </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        } 
                        
                    }
                }
            }

            ?>
        <form method="POST">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <input type="text" class="form-control" placeholder="Transaction No" name="trans_no" required>
                </div>
                <div class="mb-3 col-md-6" style="display:none;">
                    <input type="hidden" class="form-control" placeholder="Batch" name="batch_id"
                        value="<?php echo $batch_id; ?>">
                </div>
                <div class="mb-3 col-md-6">
                    <input type="text" class="form-control" id="selected_ids" name="monthly_fees_id[]">
                </div>
                <div class="mb-3 col-md-6" style="display:none;">
                    <input type="text" class="form-control" placeholder="Student Id" name="stu_id"
                        value="<?php echo $stu_id; ?>">
                </div>
                <div class="mb-3 col-md-6" style="display:none;">
                    <input type="hidden" class="form-control" placeholder="month" name="month"
                        value="<?php echo $month; ?>">
                </div>
                <div class="mb-3 col-md-6" style="display:none;">
                    <input type="hidden" class="form-control" placeholder="year" name="year"
                        value="<?php echo $year; ?>">
                </div>
                <div class="mb-3 col-md-6" style="display:none">
                    <input type="text" class="form-control" id="additionalValue" name="additionalValue" onchange="updateTotal()">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="total" name="pay_amt">Pay ₹</button>
        </form>
        </div>
            
    </div>
</div>
</div>

<?php
// Assuming $conn is your database connection

if (isset($_POST['pay_amt'])) {
    $trans_no = $_POST['trans_no'];
    $batch_id = $_POST['batch_id'];
    $stu_id = $_POST['stu_id'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    // Convert the comma-separated values into an array
    // $selectedIds = explode(',', $_POST['monthly_fees_id']);
    $selectedIds = explode(',', implode(',', $_POST['monthly_fees_id']));

    
    $total_pay_amt = $_POST['additionalValue'];
    $added_by = 1;
    $pay_status = 1;

    $sqlInsert = "INSERT INTO `collection`(`stu_id`, `trans_no`, `batch_id`, `month`, `year`, `total_pay_amt`, `added_by`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("ssissii", $stu_id, $trans_no, $batch_id, $month, $year, $total_pay_amt, $added_by);

    if ($stmtInsert->execute()) {
        foreach ($selectedIds as $monthly_fees_id) {
            $sqlUpdate = "UPDATE `monthly_fees` SET `pay_status` = ? WHERE id = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("ii", $pay_status, $monthly_fees_id);
            
            if (!$stmtUpdate->execute()) {
                echo '<script>
                    swal("Error!", "Error updating data in monthly_fees table.", "error");
                </script>';
                exit;
            }
            
            $stmtUpdate->close();
        }

        echo '<script>
            swal("Success!", "", "success");
            setTimeout(function(){
                window.location.href =  window.location.href
            }, 1000);
        </script>';
        exit;
    } else {
        echo '<script>
            swal("Error!", "Error inserting data into collection table.", "error");
        </script>';
    }

    // Close the insert statement to release resources
    $stmtInsert->close();
}
?>



<script>
    
    // JavaScript function to update the total when a checkbox or text box value changes
function updateTotal() {
    var checkboxes = document.querySelectorAll('.form-check-input');
    var total = 0;
    var additionalValue = 0;

    checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
            total += parseFloat(checkbox.value);
            additionalValue += parseFloat(checkbox.value);
        }
    });

    // Update the total value on the page
    document.getElementById('total').innerText = total;
    document.getElementById('additionalValue').value = additionalValue;

    
    var checkboxes = document.querySelectorAll('.form-check-input');
    var selectedIds = [];

    checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
            selectedIds.push(checkbox.id.replace('fees_id_', ''));
        }
    });

    // Update the value of the text box with the selected IDs in array format
    document.getElementById('selected_ids').value = selectedIds.join(',');


}


</script>

<?php
include('footer.php');
?>