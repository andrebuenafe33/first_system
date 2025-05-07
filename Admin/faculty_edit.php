<?php 
include('security.php');
include('includes/_header.php');
include('includes/_topbar.php');
include('includes/_sidebar.php');
?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Faculties</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <h6><i class="fas fa-user"></i> Faculty Edit Page</h6>
                </div>

                <div class="card-body">
                    <?php
                    $connection = mysqli_connect("localhost", "root", "", "panel");

                    if (isset($_POST['faculty_edit'])) {
                        $id = $_POST['faculty_id'];
                        $query = "SELECT * FROM faculty WHERE id='$id'";
                        $query_run = mysqli_query($connection, $query);

                        foreach ($query_run as $row) {
                    ?>
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="faculty_id" value="<?php echo $row['id']; ?>">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="faculty_name">Name</label>
                                        <input type="text" id="faculty_name" name="faculty_name" value="<?php echo $row['name']; ?>" class="form-control" placeholder="Enter Name" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="faculty_designation">Designation</label>
                                        <input type="text" id="faculty_designation" name="faculty_designation" value="<?php echo $row['designation']; ?>" class="form-control" placeholder="Enter Designation" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="faculty_description">Description</label>
                                        <input type="text" id="faculty_description" name="faculty_description" value="<?php echo $row['description']; ?>" class="form-control" placeholder="Enter Description" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="faculty_images">Image</label>
                                        <input type="file" id="faculty_images" name="faculty_images" value="<?php echo $row['images']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" name="faculty_update" class="btn btn-success">Update</button>
                                    <a href="faculty.php" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>



<?php
include('includes/_footer.php');
?>