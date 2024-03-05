<?php
session_start();

if(isset($_SESSION['login']) && $_SESSION['login'] == true) {   
    // $user_email = $_SESSION['user_email'];
}
else{
    echo "<script>location.href='../login';</script>";
}
include 'header.php';
if (isset($_GET['type']) && $_GET['type'] === 'delete' && isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    $sql2 = "DELETE FROM `user` WHERE id = ?";
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>
                swal('Success!', '', 'success');
                setTimeout(function(){
                    window.location.href = 'user';
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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#CoursesModal">
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>password</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM user";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $sno = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['id'];
                                        $name = $row['name'];
                                        $email = $row['email'];
                                        $mobile = $row['mobile'];
                                        $password = $row['password'];
                                        $pass10 = substr($password, 0, 10);
                                        $status = $row['status'];
                                        $role = $row['role'];
                                        $sno += 1;
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $sno; ?>
                                            </td>
                                            <td style="display:none">
                                                <?php echo $id; ?>
                                            </td>
                                            <td>
                                                <div class="trans-list" style="text-transform: capitalize;">
                                                    <h4>
                                                        <?php echo $name; ?>
                                                    </h4>
                                                </div>
                                            </td>
                                            <td><span class="text-primary font-w600">
                                                    <?php echo $email; ?>
                                                </span></td>
                                            <td>
                                                <div class="">
                                                    <?php echo $mobile; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="">
                                                    <?php echo $pass10; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="" style="text-transform: capitalize;">
                                                    <?php echo $role; ?>
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
                                                <!-- <button type="button" class="btn btn-sm light btn-secondary"
                                                    data-bs-toggle="modal" data-bs-target="#ViewModal"><i
                                                        class="fa-solid fa-eye"></i></button> -->
                                                <button class='edit btn btn-sm btn-info light' id="<?php echo $id; ?>"><i
                                                        class="fa-solid fa-pen-to-square"></i></button>
                                                <a href="javascript:void()" class="delete btn btn-sm light btn-danger" onclick="confirmDelete();"><i class="fa-solid fa-trash-can"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="ViewModal" tabindex="-1" aria-labelledby="ViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-2">Name</label>
                            <input type="text" class="form-control" id="viewId" readonly>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput2" class="form-label mb-2">email</label>
                            <input type="text" class="form-control" id="viewName" readonly>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput2" class="form-label mb-2">Password</label>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput2" class="form-label mb-2">Mobile</label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="dropdown bootstrap-select form-select wide form-control dropup mb-3">
                            <label for="exampleFormControlInput2" class="form-label mb-2">Role</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add user Modal -->
<div class="modal fade" id="CoursesModal" tabindex="-1" aria-labelledby="CoursesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CoursesModalLabel">User Management</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label mb-2">Name</label>
                                <input type="text" class="form-control" required id="exampleFormControlInput1"
                                    placeholder="Name" name="name">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">email</label>
                                <input type="email" class="form-control" id="exampleFormControlInput2"
                                    placeholder="Email" required name="email">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="exampleFormControlInput2"
                                        placeholder="Password" required name="password" minlength="6">
                                    <span class="input-group-text" id="togglePassword">
                                        <i class="far fa-eye" id="toggleIcon"></i>
                                    </span>
                                    <label for="exampleFormControlInput2" class="form-label mb-2"
                                        id="passwordErrorLabel" style="color:red"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">Mobile</label>
                                <input type="tel" class="form-control" maxlength="10" id="exampleFormControlInput2"
                                    placeholder="Mobile" required name="mobile">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="dropdown bootstrap-select form-select wide form-control dropup mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">Role</label>
                                <select class="form-select wide form-control" id="validationCustom05" required=""
                                    name="role">
                                    <option selected="" disabled="" value="">Please select</option>
                                    <option value="admin">Admin</option>
                                    <option value="teacher">Teacher</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" name="save">
                            <i class="fa-regular fa-floppy-disk"></i> Save</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditModal">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <input type="hidden" name="editId" id="editId">

                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="editName" class="form-label mb-2">Name</label>
                                <input type="text" class="form-control" required id="editName" placeholder="Name"
                                    name="editName">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="editEmail" class="form-label mb-2">email</label>
                                <input type="email" class="form-control" id="editEmail" placeholder="Email" required
                                    name="editEmail">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="editMobile" class="form-label mb-2">Mobile</label>
                                <input type="tel" class="form-control" id="editMobile" maxlength="10"
                                    placeholder="Mobile" required name="editMobile">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="dropdown bootstrap-select form-select wide form-control dropup mb-3">
                                <label for="editRole" class="form-label mb-2">Role</label>
                                <select class="form-select wide form-control" id="editRole" required="" name="editRole">
                                    <option value="admin">Admin</option>
                                    <option value="teacher">Teacher</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" name="editSave"><i
                                class="fa-regular fa-floppy-disk"></i> Save</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Edit Script
    document.addEventListener('DOMContentLoaded', function () {
        const edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener('click', function (e) {
                const tr = e.target.closest('tr');
                const id = tr.querySelector('td:nth-child(2)').innerText;
                const name = tr.querySelector('td:nth-child(3)').innerText;
                const email = tr.querySelector('td:nth-child(4)').innerText;
                const mobile = tr.querySelector('td:nth-child(5)').innerText;
                const role = tr.querySelector('td:nth-child(7)').innerText;
                document.getElementById('editId').value = id;
                document.getElementById('editName').value = name;
                document.getElementById('editEmail').value = email;
                document.getElementById('editMobile').value = mobile;
                const editRole = document.getElementById('editRole').value = role;
                $('#EditModal').modal('show');
            });
        });
    });

    // view Script
    document.addEventListener('DOMContentLoaded', function () {
        const views = document.getElementsByClassName('view');
        Array.from(views).forEach((element) => {
            element.addEventListener('click', function (e) {
                const tr = e.target.closest('tr');
                const id = tr.querySelector('td:nth-child(2)').innerText;
                const name = tr.querySelector('td:nth-child(3)').innerText;
                const email = tr.querySelector('td:nth-child(4)').innerText;
                const mobile = tr.querySelector('td:nth-child(5)').innerText;
                const role = tr.querySelector('td:nth-child(7)').innerText;
                document.getElementById('viewId').value = id;
                document.getElementById('viewName').value = name;
                document.getElementById('viewEmail').value = email;
                document.getElementById('viewMobile').value = mobile;
                const viewRole = document.getElementById('viewRole').value = role;
                $('#ViewModal').modal('show');
            });
        });
    });
</script>
<?php
// Insert Code
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $pass = password_hash($password, PASSWORD_BCRYPT);
    $role = $_POST['role'];
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $success = false;

    if ($result->num_rows > 0) {
        echo '<script>
        swal("Error!", "Email already exists!", "error");
        </script>';
        exit;
    } else {
        if (filter_var($mobile, FILTER_VALIDATE_INT) !== false) {

            $sql = "INSERT INTO `user`(`name`, `email`, `password`, `mobile`, `role`, `status`) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $status = 1;
            $stmt->bind_param("sssssi", $name, $email, $pass, $mobile, $role, $status);

            if ($stmt->execute()) {
                $success = true;
            } else {
                echo '<script>
                swal("Error!", "Error inserting data.", "error");
            </script>';
            }
        } else {
            echo '<script>
                swal("Error!", "Mobile is not a valid integer.", "error");
            </script>';
        }

    }

    if ($success) {
        echo '<script>
            swal("Success!", "New User has been added successfully!", "success");
            setTimeout(function(){
                window.location.href =  window.location.href
            }, 1000);
        </script>';
        exit;
    }
}

// Update code
if (isset($_POST['editSave'])) {
    $editId = $_POST['editId'];
    $editName = $_POST['editName'];
    $editEmail = $_POST['editEmail'];
    $editMobile = $_POST['editMobile'];
    $editRole = $_POST['editRole'];

    $sql = "UPDATE `user` SET `name`='$editName',`email`='$editEmail',`mobile`='$editMobile',`role`='$editRole' WHERE id = '$editId'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo '<script>
            swal("Success!", "This user has been successfully Updated", "success");
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

<script>
    function toggleStatus(id) {
        var id = id;
        // Show a confirmation SweetAlert
        swal({
            title: "Are you sure?",
            text: "Do you want to Change the user's status?",
            icon: "warning",
            buttons: {
                cancel: "Cancel", // Rename the Cancel button
                confirm: "OK"     // Rename the OK button
            },
            dangerMode: true,
        }).then((confirmed) => {
            if (confirmed) {
                // If the user confirms, make the AJAX request and set the status to "Active"
                $.ajax({
                    url: "load/update_status.php",
                    type: "post",
                    data: { chatId: id },
                    success: function (result) {
                        // if (result == '1') {
                        //     swal("Success", "User is now Active", "success");
                        // }else if (result == '0') {
                        //     swal("Success", "User is now Inactive", "success");
                        // }
                        //  else {
                        //     swal("Error", "Failed to update user status", "error");
                        // }
                    }
                });
            } else {
                // If the user cancels, do nothing (status remains unchanged)
            }
        });
    }


    <!-- Show Password -->

    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.querySelector('input[type="password"]');
        const togglePasswordButton = document.getElementById('togglePassword');
        const toggleIcon = document.getElementById('toggleIcon');
        const passwordErrorLabel = document.getElementById('passwordErrorLabel');

        togglePasswordButton.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('far', 'fa-eye');
                toggleIcon.classList.add('fas', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fas', 'fa-eye-slash');
                toggleIcon.classList.add('far', 'fa-eye');
            }
        });

        passwordInput.addEventListener('input', function () {
            const passwordValue = passwordInput.value;
            if (passwordValue.length < 6) {
                passwordErrorLabel.textContent = 'Password must be at least 6 characters long.';
            } else {
                passwordErrorLabel.textContent = '';
            }
        });
    });


    // Delete Password

    function confirmDelete() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this user!',
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

</script>

<?php
include 'footer.php';
?>