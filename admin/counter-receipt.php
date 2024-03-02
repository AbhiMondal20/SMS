<?php
    session_start();
    if(isset($_SESSION['login']) && $_SESSION['login'] == true) {   
        // $user_email = $_SESSION['user_email'];
    }
    else{
        echo "<script>location.href='../login';</script>";
    }
    include('header.php');
    $sql = "SELECT * FROM `site_info`";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $site_name = $row['site_name'];
        $site_url = $row['site_url'];
        $logo = $row['logo'];
        $fav_icon = $row['fav_icon'];
        $address = $row['address'];
        $phone = $row['phone'];
        $phone2 = $row['phone2'];
        $email = $row['email'];
 }
?>
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <!-- Row -->
        <div class="row">
            <div class="col-xl-12 content_hide" >
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page-title flex-wrap">
                            <div class="input-group search-area mb-md-0 mb-3">
                                <input type="text" class="form-control" placeholder="Search here...">
                                <span class="input-group-text">
                                    <a href="javascript:void(0)">
                                        <svg width="15" height="15" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.5605 15.4395L13.7527 11.6317C14.5395 10.446 15 9.02625 15 7.5C15 3.3645 11.6355 0 7.5 0C3.3645 0 0 3.3645 0 7.5C0 11.6355 3.3645 15 7.5 15C9.02625 15 10.446 14.5395 11.6317 13.7527L15.4395 17.5605C16.0245 18.1462 16.9755 18.1462 17.5605 17.5605C18.1462 16.9747 18.1462 16.0252 17.5605 15.4395V15.4395ZM2.25 7.5C2.25 4.605 4.605 2.25 7.5 2.25C10.395 2.25 12.75 4.605 12.75 7.5C12.75 10.395 10.395 12.75 7.5 12.75C4.605 12.75 2.25 10.395 2.25 7.5V7.5Z"
                                                fill="#01A3FF" />
                                        </svg>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="media" style="padding:10px">
                                                <img class="align-self-start mr-3" src="images/logo-full.png" alt="Akademi Logo">
                                            </div>
                                            <center>
                                                <h1>Fees Receipt</h1>
                                            </center>
                                            <address style="padding-left:10px" >
                                                <strong><?php echo $address; ?></strong><br>
                                                 <?php echo $phone; ?> / <?php echo $phone2; ?><br/>
                                                 <?php echo $email; ?>
                                            </address>
                                        </div>
                                    <hr>
                                    </div>    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive" style="box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.5);">
                                                <table id="mainTable" class="table table-striped" style="cursor: pointer;">
                                                    <thead>
                                                        <tr>
                                                            <th>Bank Transaction No</th>
                                                            <th>Admission No</th>
                                                            <th>Student Name</th>
                                                            <th>Session</th>
                                                            <th>Batch</th>
                                                        </tr>
                                                </thead>
                                                    <tbody>
                                                        <?php
                                                            $stu_id = $_GET['stu_id'];
                                                            $trans_no = [];
                                                            $fees_id = [];                                             
                                                            $sql = "SELECT student.name AS name, student.stu_id AS stu_id, collection.trans_no AS trans_no, batches.batches_name AS batches_name, collection.batch_id AS batch_id, collection.fees_id AS coll_fees_id, session.session AS session  FROM `student`
                                                            INNER JOIN `collection`ON student.stu_id = collection.stu_id
                                                            INNER JOIN `batches` ON student.batch_id = batches.id 
                                                            INNER JOIN `session` ON batches.session_id = session.id
                                                            WHERE student.stu_id = '$stu_id'
                                                            GROUP BY student.name";
                                                            $res = mysqli_query($conn, $sql);
                                                            while($row = mysqli_fetch_assoc($res))
                                                            {
                                                                $stu_id = $row['stu_id'];
                                                                $trans_no[] = $row['trans_no'];
                                                                $trans_no_str = implode(", ", $trans_no);
                                                                $name = $row['name'];
                                                                $batch = $row['batches_name'];
                                                                $batch_id = $row['batch_id'];
                                                                $session = $row['session'];
                                                                $coll_fees_id[] = $row['coll_fees_id'];
                                                                $fees_id_str = implode(",", $coll_fees_id);
                                                            }
                                                        ?>
                                                        <tr>
                                                            <td>021563241</td>
                                                            <td><?php echo $stu_id; ?></td>
                                                            <td><?php echo $name; ?></td>
                                                            <td><?php echo $session; ?></td>
                                                            <td><?php echo $batch; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php
                                        if (is_array($coll_fees_id)) {
                                            $fees_id_str = implode(",", array_filter($coll_fees_id, 'strlen'));
                                            if (!empty($fees_id_str)) {
                                                $sql = "SELECT monthly_fees.id AS fees_id, year, month FROM `monthly_fees` WHERE id IN ($fees_id_str)";
                                            } else {
                                                // Handle case where $fees_id_str is empty (no valid IDs)
                                                // You might want to decide what to do in this case, such as showing an error message or providing a default query
                                            }
                                        } else {
                                            $sql = "SELECT monthly_fees.id AS fees_id, year, month FROM `monthly_fees` WHERE id = '$coll_fees_id'";
                                        }

                                        $res_monthly_fees = mysqli_query($conn, $sql);
                                        if ($res_monthly_fees) {
                                            while ($row_monthly_fees = mysqli_fetch_assoc($res_monthly_fees)) {
                                                $monthly_fees_id = $row_monthly_fees['fees_id'];
                                                $fees_month = $row_monthly_fees['month'];
                                                $fees_year = $row_monthly_fees['year'];
                                                echo '
                                                <div class="col-xl-3 col-lg-3 m-5" style="box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.5)">
                                                    <div class="clearfix">
                                                        <div class="card card-bx profile-card author-profile m-b30">
                                                            <div class="card-body ">
                                                                <div class="card-header border-0 ">
                                                                    <h2 class="card-title">' . $fees_month . '- ' . $fees_year .'</h2>
                                                                </div>
                                                                <div class="info-list">
                                                                    <ul>';
                                                $total_price = 0;
                                                $encountered_titles = array();
                                                $sql = "SELECT monthly_fees_menu.id AS id, fees_head_id, title, amount, monthly_fees_menu.status AS status, pay_status 
                                                FROM `monthly_fees_menu` INNER JOIN fees_head ON fees_head.id = monthly_fees_menu.fees_head_id WHERE month = '$fees_month' AND monthly_fees_menu.batch_id = '$batch_id' AND pay_status = '0' GROUP BY fees_head_id";
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
                                                                   
                                                                </center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                            }
                                        }
                                        $fees11 = $total_price + $total_price;
                                    ?>
                                        
                                    </div>                        
                                    <div class="row" style="padding-left:10px">
                                        <div class="col-md-12 text-right">
                                            <!-- <p class="text-right mb-0"><b>Total Fees Paid : </b> ₹</p> -->
                                        </div>
                                        <div class="col-md-12 text-right hidden-print mb-3">
                                            <hr>
                                            <center>
                                                <a onclick="printPage()" class="btn btn-raised btn-success">
                                                    <i class="fa-solid fa-print"></i>
                                                </a>
                                            </center>
                                        </div>
                                    </div>                            
                                </div>
                            </div>
                        </div>
                </div>
            </section>
        </div>
    </div>
    </div>
</div>

<?php
    include('footer.php');
?>