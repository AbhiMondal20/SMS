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
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" placeholder="Enter Student Id">
                                    </div>
                                    <div class="col-sm-4 mt-2 mt-sm-0">
                                        <input type="date" class="form-control" value="<?php echo date('Y-m-d') ?>">
                                    </div>
                                    <div class="col-sm-4 mt-2 mt-sm-0">
                                        <input type="submit" class="btn btn-primary" placeholder="" value="Search" name="search" >
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
                Footer start
        ***********************************-->
    </div>
</div>
<?php
include('footer.php');
?>