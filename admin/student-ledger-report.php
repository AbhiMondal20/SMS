<?php
    include('header.php');
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
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <h4 class="card-title">Input Style</h4> -->
                    </div>
                    <div class="card-body">
                        <form method="GET">
                            <div class="mb-3 col-xl-6 col-lg-6">
                                <input type="text" class="form-control input-default" name="stu_id" placeholder="Student Admission No">
                            </div>
                            <div class="mb-3">
                                <center>
                                    <button type="submit" class="btn btn-sm btn-primary">Search..</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th style="width:80px;"><strong>Cancel Date</strong></th>
                                                <th><strong>Cancel Remarks</strong></th>
                                                <th><strong>Month</strong></th>
                                                <th><strong>Session</strong></th>
                                                <th><strong>Student Name</strong></th>
                                                <th>Course</th>
                                                <th>Batch</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(isset($_GET['stu_id'])){
                                                $stu_id = $_GET['stu_id'];
                                                $trans_no = [];
                                                $fees_id = [];
                                                $sql = "SELECT student.name AS name, student.stu_id AS stu_id, collection.trans_no AS trans_no, batches.batches_name AS batches_name, collection.batch_id AS batch_id, collection.fees_id AS coll_fees_id, session.session AS session  FROM `student`
                                                INNER JOIN `collection`ON student.stu_id = collection.stu_id
                                                INNER JOIN `batches` ON student.batch_id = batches.id 
                                                INNER JOIN `session` ON batches.session_id = session.id
                                                WHERE student.stu_id = '$stu_id'";
                                                $res = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_assoc($res)){
                                                    $name = $row['name'];
                                                    $stu_id = $row['stu_id'];
                                                    $trans_no = $row['trans_no'];
                                                    $batches_name = $row['batches_name'];
                                                    $session = $row['session'];
                                                }
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $trans_no; ?></td>
                                                <td><strong><?php echo $name; ?></strong></td>
                                                <td><?php echo $stu_id; ?></td>
                                                <td><?php echo $session; ?></td>
                                                <td><?php echo $batches_name; ?></td>
                                                <td><?php echo "25125" ?></td>
                                                <td><a href="counter-receipt?stu_id=<?php echo $stu_id ?>" target="_BLANK">PDF</a></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
    include('footer.php');
?>