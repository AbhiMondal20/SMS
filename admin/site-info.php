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
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Site Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <?php
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
                                                $email2 = $row['email2'];
                                                $whatsapp = $row['whatsapp'];
                                                $facebook = $row['facebook'];
                                                $youtube = $row['youtube'];
                                                $instagram = $row['instagram'];
                                                $blog = $row['blog'];
                                            }
                                            ?>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Site Name</label>
                                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                                <input type="text" class="form-control" placeholder="Site Name" value="<?php echo $site_name ?>" name="site_name">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Site URL</label>
                                                <input type="text" class="form-control" placeholder="Site URL"
                                                    value="<?php echo $site_url ?>" name="site_url">
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <br>
                                                <div>
                                                    <center>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
                                                            src="<?php echo $logo ?>" class="avatar-md rounded-circle"
                                                            alt="" id="showlogo" srcset="">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <br>
                                                <div>
                                                    <center>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
                                                            src="<?php echo $fav_icon ?>"
                                                            class="avatar-md rounded-circle" alt="" id="showfav"
                                                            srcset="">
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">LOGO</label>
                                                <input type="file" class="form-control" id="logo" placeholder="logo"
                                                    value="" name="logo" >
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Fav ICONs</label>
                                                <input type="file" class="form-control" id="favicon"
                                                    placeholder="Fav Icons" value="" name="fav_icon" >
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label>Address</label>
                                                <textarea rows="1" class="form-control" id="validationTooltip01"
                                                    placeholder="Address"
                                                    name="address"><?php echo $address ?></textarea>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control" placeholder="Phone"
                                                    value="<?php echo $phone ?>" name="phone" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Phone2</label>
                                                <input type="text" class="form-control" placeholder="phone 2"
                                                    value="<?php echo $phone2 ?>" name="phone2">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" placeholder="Email"
                                                    value="<?php echo $email ?>" name="email" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Email 2</label>
                                                <input type="text" class="form-control" placeholder="Email 2"
                                                    value="<?php echo $email2 ?>" name="email2" >
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Whatsapp No</label>
                                                <input type="text" class="form-control" placeholder="Whatsaap No"
                                                    value="<?php echo $whatsapp ?>" name="whatsapp" >
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Facebook Page Id</label>
                                                <input type="text" class="form-control" placeholder="Facebook Page Id"
                                                    value="<?php echo $facebook ?>" name="facebook" >
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Youtube Chanel</label>
                                                <input type="text" class="form-control" placeholder="Youtube Chanel"
                                                    value="<?php echo $youtube ?>" name="youtube" >
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Instagram Id</label>
                                                <input type="text" class="form-control" placeholder="Instagram Id"
                                                    value="<?php echo $instagram ?>" name="instagram" >
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Blog Url</label>
                                                <input type="text" class="form-control" placeholder="Blog Url"
                                                    value="<?php echo $blog ?>" name="blog" >
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="save"> SAVE</button>
                                    </form>
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
if(isset($_POST['save'])){
    $id = $_POST['id'];
    $site_name = $_POST['site_name'];
    $site_url = $_POST['site_url'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $phone2 = $_POST['phone2'];
    $email = $_POST['email'];
    $email2 = $_POST['email2'];
    $whatsapp = $_POST['whatsapp'];
    $facebook = $_POST['facebook'];
    $youtube = $_POST['youtube'];
    $instagram = $_POST['instagram'];
    $blog = $_POST['blog'];
    $img_loc = $_FILES['logo']['tmp_name'];
    $img_name = $_FILES['logo']['name'];
    $img_loc_fav = $_FILES['fav_icon']['tmp_name'];
    $img_name_fav = $_FILES['fav_icon']['name'];
    $thambname = uniqid();
    $thambname_fav = uniqid();
    $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ext_fav = pathinfo($img_name_fav, PATHINFO_EXTENSION);
    $backend = 'backend';
    $img_size = $_FILES['logo']['size'] / (1024 * 1024);
    $img_upload = 'upload/' .$thambname."." . $img_ext ;
    $img_size = $_FILES['logo']['size'] / (1024 * 1024);
    $img_upload_fav = 'upload/' .$thambname_fav."." . $img_ext_fav ;

    if (!empty($img_name)) {
        if($img_size > 5) {
            echo "<script>alert('Image size is greater than 5 MB')</script>";
            exit();
        }
        $logo_sql = "`logo`='$img_upload',";
        $move_logo = true;
    } else {
        $logo_sql = "";
        $move_logo = false;
    }

    if (!empty($img_name_fav)) {
        $fav_icon_sql = "`fav_icon`='$img_upload_fav',";
        $move_fav_icon = true;
    } else {
        $fav_icon_sql = "";
        $move_fav_icon = false;
    }

    $sql = "UPDATE `site_info` SET `site_name`='$site_name',`site_url`='$site_url',$logo_sql$fav_icon_sql`address`='$address',`phone`='$phone',`phone2`='$phone2',`email`='$email',`email2`='$email2',`whatsapp`='$whatsapp',`facebook`='$facebook',`youtube`='$youtube',`instagram`='$instagram',`blog`='$blog' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        if ($move_logo) {
            move_uploaded_file($img_loc, $img_upload);
        }
        if ($move_fav_icon) {
            move_uploaded_file($img_loc_fav, $img_upload_fav);
        }
        echo "<script>
            swal({
                title: 'Success full!',
                text: 'Thank you!',
                icon: 'success',
                button: 'Ok!',
            });
            setTimeout(function(){
                window.location.href =  window.location.href;
            },1000);
        </script>";
    } else {
        echo "<script>swal({
            title: 'Invalid!',
            text: 'Please Contact The Support Team!',
            icon: 'error',
            button: 'Ok',
            });
            setTimeout(function(){
                window.location.href =  window.location.href;
            },1000);
        </script>";
    }
}


include('footer.php');
?>

<script>
    function showUploadFile() {
        var uploadOption = document.getElementById("uploadOption");
        var uploadFileBox = document.getElementById("uploadFileBox");
        if (uploadOption.value == "doctor") {
            uploadFileBox.style.display = "block";
        } else {
            uploadFileBox.style.display = "none";
        }
    }
</script>