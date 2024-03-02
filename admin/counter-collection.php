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
    $stu_id = "";
    if(isset($_GET['stu_id'])){
        $stu_id = $_GET['stu_id'];
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
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="stu_id" placeholder="Enter Student Id" required value="<?php echo $stu_id; ?>">
                                    </div>
                                    <div class="col-sm-3 mt-2 mt-sm-0">
                                        <input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d') ?>">
                                    </div>
                                    <div class="col-sm-3 mt-2 mt-sm-0">
                                        <input type="submit" class="btn btn-primary" placeholder="" value="Search" name="search">
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
                $batch_id = "";
                $fees_id = [];
                $stu_id = mysqli_real_escape_string($conn, $_GET['stu_id']);
                $payment_date = mysqli_real_escape_string($conn, $_GET['date']);
                // $sql = "SELECT * FROM `student` INNER JOIN collection ON collection.stu_id = student.stu_id WHERE student.stu_id = '$stu_id'";
                $sql = "SELECT student.stu_id AS stu_id, collection.month AS month, collection.year AS year, collection.batch_id AS batch_id, collection.fees_id AS fees_id FROM `student` LEFT JOIN collection ON collection.stu_id = student.stu_id WHERE student.stu_id = '$stu_id'";
                $res_student = mysqli_query($conn, $sql);
                if ($res_student) {
                    while ($row = mysqli_fetch_assoc($res_student)) {
                        $batch_id = $row['batch_id'];
                        $month = $row['month'];
                        $year = $row['year'];
                        $fees_id[] = $row['fees_id'];
                    }

                    if (!empty($fees_id)) {
                        if (is_array($fees_id)) {
                            $fees_id_str = implode('', $fees_id); 
                        } else {
                            $fees_id_str = $fees_id;
                        }
                    } else {
                        // echo "Error: fees_id is empty";
                        echo '<div class="alert alert-danger alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        <strong>Error!</strong> Student Id Not Found.
                        <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert" aria-label="btn-close">
                        <i class="fa-solid fa-xmark"></i>
                        </button>
                        </div>';
                        // echo '<script>
                        //     setTimeout(function(){
                        //         window.location.href =  "counter-collection";
                        //     }, 3000);
                        // </script>';
                        exit;
                    }

                    if (!empty($fees_id_str)) {
                        $sql = "SELECT monthly_fees.id AS fees_id, year, batch_id, month FROM `monthly_fees` WHERE batch_id = '$batch_id' AND id NOT IN ($fees_id_str)";
                    } else {
                        $sql = "SELECT monthly_fees.id AS fees_id, year, month FROM `monthly_fees` WHERE batch_id = '$batch_id'";
                    }
                        
                    $res_monthly_fees = mysqli_query($conn, $sql);
                    if ($res_monthly_fees) {
                        while ($row_monthly_fees = mysqli_fetch_assoc($res_monthly_fees)) {
                            $monthly_fees_id = $row_monthly_fees['fees_id'];
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
                <div class="mb-3 col-md-6" >
                    <input type="text" class="form-control" placeholder="Transaction No" name="trans_no" required>
                </div>
                <div class="mb-3 col-md-6" style="display:none;">
                    <input type="hidden" class="form-control" placeholder="Batch" name="batch_id"
                        value="<?php echo $batch_id; ?>">
                </div>
                <div class="mb-3 col-md-6" style="display:none;">
                    <input type="text" class="form-control" id="selected_ids" name="monthly_fees_id[]">
                </div>
                <div class="mb-3 col-md-6" style="display:none;">
                    <input type="text" class="form-control" placeholder="Student Id" name="stu_id"
                        value="<?php echo $stu_id; ?>">
                </div>
                <div class="mb-3 col-md-6" style="display:none;">
                    <input type="text" class="form-control" id="month" placeholder="month" name="month"
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
if (isset($_POST['pay_amt'])) {

    $trans_no = $_POST['trans_no'];
    $batch_id = $_POST['batch_id'];
    $stu_id = $_POST['stu_id'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    // Debugging statement to check $_POST['monthly_fees_id']
    // var_dump($_POST['monthly_fees_id']);

    if (is_array($_POST['monthly_fees_id'])) {
        $selectedIds = $_POST['monthly_fees_id'];
    } else {
        // echo "Error: monthly_fees_id is not an array";
        exit; // Exit the script as there's an error
    }
    $total_pay_amt = $_POST['additionalValue'];
    $added_by = 1;
    $pay_status = 1;
    // Begin transaction
    $conn->begin_transaction();
    try {
    
    // Fetch existing fees_id for the given stu_id
    $sqlSelect = "SELECT `fees_id` , `trans_no` FROM `collection` WHERE `stu_id` = ?";
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("s", $stu_id);
    $stmtSelect->execute();
    $stmtSelect->bind_result($existing_fees_id, $existing_trans_no);
    $stmtSelect->fetch();
    $stmtSelect->close();

    // Handle the case when $existing_fees_id is NULL or empty string
    $existing_fees_array = ($existing_fees_id !== null && $existing_fees_id !== '') ? explode(',', $existing_fees_id) : [];
    $merged_fees_id = array_merge($existing_fees_array, $selectedIds);
    $merged_fees_id = implode(',', array_unique($merged_fees_id));

    // Merge the existing trans_no with the new ones
    // $merged_trans_no = array_merge(explode(',', $existing_trans_no), [$trans_no]);
    // $merged_trans_no = implode(',', array_unique($merged_trans_no)); 


    // Handle the case when $existing_trans_no is NULL or empty string
    $existing_trans_array = ($existing_trans_no !== null && $existing_trans_no !== '') ? explode(',', $existing_trans_no) : [];
    $merged_trans_no = array_merge($existing_trans_array, [$trans_no]);
    $merged_trans_no = implode(',', array_unique($merged_trans_no));

    // Update the collection table with the merged fees_id
    $sqlUpdate = "UPDATE `collection` SET `total_pay_amt` = `total_pay_amt` + ?, `fees_id` = ?, `trans_no` = ?, `payment_date` = ? WHERE `stu_id` = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("sssss", $total_pay_amt, $merged_fees_id, $merged_trans_no, $payment_date, $stu_id);
    $stmtUpdate->execute();
    $stmtUpdate->close();

    // Update pay_status in monthly_fees table
    $sqlUpdate = "UPDATE `monthly_fees` SET `pay_status` = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);

    foreach ($selectedIds as $monthly_fees_id) {
        $stmtUpdate->bind_param("ii", $pay_status, $monthly_fees_id);
        $stmtUpdate->execute();
    }

    $conn->commit();
    echo '<script>
    swal("Success!", "", "success");
    setTimeout(function(){
        var url = "counter-receipt?stu_id='.$stu_id.'";
        window.open(url, "_blank");
    }, 1000);
</script>
';
    exit;
} catch (Exception $e) {
    // Rollback transaction if an error occurred
    $conn->rollback();
    echo '<script>
        swal("Error!", "Error processing transaction.", "error");
        
    </script>';
}

// Close the statements to release resources
// $stmtInsert->close();
// $stmtUpdate->close();
}

?>

<script>
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