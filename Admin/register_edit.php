<?php 
include('security.php');
include('includes/_header.php');
include('includes/_topbar.php');
include('includes/_sidebar.php');
?>
    
    <!-- this is from register.php then below in the <TD> -->



<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Users</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <h6><i class="fas fa-user"></i> Edit User</h6>
                </div>

                <div class="card-body">
                    <?php
                    $connection = mysqli_connect("localhost", "root", "", "panel");

                    if (isset($_POST['edit_btn'])) {
                        $id = $_POST['edit_id'];
                        $query = "SELECT * FROM register WHERE id='$id'";
                        $query_run = mysqli_query($connection, $query);

                        foreach ($query_run as $row) {
                    ?>
                            <form action="code.php" method="POST">
                                <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_username">Username</label>
                                        <input type="text" id="edit_username" name="edit_username" value="<?php echo $row['username']; ?>" class="form-control" placeholder="Enter Username" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="edit_email">Email</label>
                                        <input type="email" id="edit_email" name="edit_email" value="<?php echo $row['email']; ?>" class="form-control" placeholder="Enter Email" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="edit_password">Password</label>
                                        <input type="password" id="edit_password" name="edit_password" value="<?php echo $row['password']; ?>" class="form-control" placeholder="Enter Password" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="update_usertype">Usertype</label>
                                        <select name="update_usertype" id="update_usertype" class="form-control">
                                            <option value="Admin" <?php echo $row['usertype'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                                            <option value="Guest" <?php echo $row['usertype'] == 'Guest' ? 'selected' : ''; ?>>Guest</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" name="updatebtn" class="btn btn-success">Update</button>
                                    <a href="register.php" class="btn btn-danger">Cancel</a>
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