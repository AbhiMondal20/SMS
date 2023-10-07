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
                                        <th>
                                            <input type="checkbox" class="form-check-input" id="checkAll" required="">
                                        </th>
                                        <th>Session</th>
                                        <th>Prefix</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="checkbox me-0 align-self-center">
                                                <div class="custom-control custom-checkbox ">
                                                    <input type="checkbox" class="form-check-input" id="check8"
                                                        required="">
                                                    <label class="custom-control-label" for="check8"></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="trans-list">
                                                <h4>2018-2021</h4>
                                            </div>
                                        </td>
                                        <td><span class="text-primary font-w600">18-21</span></td>
                                        <td>
                                            <div class=""></div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked" checked>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm light btn-secondary"><i
                                                    class="fa-solid fa-eye"></i>View</button>
                                            <button type="button" class="btn btn-sm light btn-info"><i
                                                    class="fa-solid fa-pen-to-square"></i>Edit</button>
                                            <button type="button" class="btn btn-sm light btn-danger"><i
                                                    class="fa-solid fa-trash-can"></i>Delete</button>
                                        </td>
                                    </tr>
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



<div class="modal fade" id="CoursesModal" tabindex="-1" aria-labelledby="CoursesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CoursesModalLabel">Session Management</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label mb-2">SESSION</label>
                                <input type="text" class="form-control" required id="exampleFormControlInput1"
                                    placeholder="SESSION" name="session">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label mb-2">PREFIX</label>
                                <input type="text" class="form-control" id="exampleFormControlInput2"
                                    placeholder="SESSION PREFIX" required name="session_prefix">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput5" class="form-label mb-2">SESSION DESCRIPTION</label>
                                <textarea type="number" class="form-control" id="exampleFormControlInput5"
                                    placeholder="SESSION DESCRIPTION" name="session_des"></textarea>
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" name="save">Save</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>