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
                <li class="breadcrumb-item active">About Us</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <h6><i class="fas fa-user"></i> Edit About</h6>
                </div>

                <div class="card-body">
                    <?php
                    $connection = mysqli_connect("localhost", "root", "", "panel");

                    if (isset($_POST['about_edit'])) {
                        $id = $_POST['about_id'];
                        $query = "SELECT * FROM abouts WHERE id='$id'";
                        $query_run = mysqli_query($connection, $query);

                        foreach ($query_run as $row) {
                    ?>
                            <form action="code.php" method="POST">
                                <input type="hidden" name="about_id" value="<?php echo $row['id']; ?>">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="about_title">Title</label>
                                        <input type="text" id="about_title" name="about_title" value="<?php echo $row['title']; ?>" class="form-control" placeholder="Enter Title" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="about_subtitle">Subtitle</label>
                                        <input type="text" id="about_subtitle" name="about_subtitle" value="<?php echo $row['subtitle']; ?>" class="form-control" placeholder="Enter Subtitle" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="about_description">Description</label>
                                        <input type="text" id="about_description" name="about_description" value="<?php echo $row['description']; ?>" class="form-control" placeholder="Enter Description" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="about_links">Links</label>
                                        <input type="text" id="about_links" name="about_links" value="<?php echo $row['links']; ?>" class="form-control" placeholder="Enter Links" required>
                                    </div>
                                </div>
                              
                                <div class="card-footer text-right">
                                    <button type="submit" name="about_update" class="btn btn-success">Update</button>
                                    <a href="about.php" class="btn btn-danger">Cancel</a>
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