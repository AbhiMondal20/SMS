<?php
include('header.php');
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
                                        <input type="text" class="form-control" name="stu_id" placeholder="Enter Student Id">
                                    </div>
                                    <div class="col-sm-4 mt-2 mt-sm-0">
                                        <input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d') ?>">
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
                    $stu_id = mysqli_real_escape_string($conn, $_GET['stu_id']);
                    $date = mysqli_real_escape_string($conn, $_GET['date']);
                
                    $sql = "SELECT * FROM `student`  WHERE stu_id = '$stu_id'";
                    $res_student = mysqli_query($conn, $sql);
                
                    if ($res_student) {
                        $sql = "SELECT monthly_fees.year, monthly_fees.month
                                FROM `monthly_fees` 
                                INNER JOIN `monthly_fees_menu` ON `monthly_fees_menu`.`fees_head_id` = `monthly_fees`.`id` ";
                
                        $res_monthly_fees = mysqli_query($conn, $sql);
                
                        if ($res_monthly_fees) {
                            while ($row_monthly_fees = mysqli_fetch_assoc($res_monthly_fees)) {
                                $month = $row_monthly_fees['month'];
                                $year = $row_monthly_fees['year'];
                
                                $sql = "SELECT * FROM `fees_head`";
                                $res_fees_head = mysqli_query($conn, $sql);
                
                                while ($row_fees_head = mysqli_fetch_assoc($res_fees_head)) {
                                    $title = $row_fees_head['title'];
                
                                    echo '<div class="col-xl-3 col-lg-4">
                                            <div class="clearfix">
                                                <div class="card card-bx profile-card author-profile m-b30">
                                                    <div class="card-body ">
                                                        <div class="card-header border-0 ">
                                                            <h2 class="card-title">' . $month . '- ' . $year . '</h2>
                                                        </div>
                                                        <div class="info-list">
                                                            <ul>
                                                                <li>' . $title . '<span>' . $month . '</span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="input-group">
                                                            <div class="form-check custom-checkbox mb-2">
                                                                <center>
                                                                    <input type="checkbox" class="form-check-input" id="same-address">
                                                                    <label class="form-check-label" for="same-address">Pay Now</label>
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
                }
                
                ?>            
        </div>
        <!--**********************************
                Footer start
        ***********************************-->
    </div>
</div>
</div>
<?php
include('footer.php');
?>