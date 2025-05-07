<?php 
include('security.php');
include('includes/_header.php');
include('includes/_topbar.php');
include('includes/_sidebar.php');
?>



    <!-- Modal -->
        <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                    <form action="code.php" method="POST">
                            <div class="modal-body">
                                
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control check_email" placeholder="Enter Email" required>
                                        <small class="error_email" style="color: red;"></small>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirmpassword" class="form-control" placeholder="Enter Password" required>
                                    </div>

                                        <input type="hidden" name="usertype" value="Admin">
                            
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="registerbtn" class="btn btn-success">Save</button>
                            </div>
                    </form>


                </div>
            </div>
        </div>
    <!-- End of Modal -->


    <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Users</li>
                            </ol>
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addadminprofile">
                                        <h6><li class="fas fa-user"></li> Add User</h6>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="card-body mt-2">
                                            <?php 
                                                if(isset($_SESSION['success']) && $_SESSION['success'] !="")
                                                {
                                                    echo '<h3 class="bg-success"> '.$_SESSION['success'].' </h3>';
                                                    unset($_SESSION['success']);
                                                }

                                                if(isset($_SESSION['status']) && $_SESSION['status'] !="")
                                                {
                                                    echo '<h2 class="bg-danger"> '.$_SESSION['status'].' </h2>';
                                                    unset($_SESSION['status']);
                                                }
                                            ?>
                                            <div class="table-responsive">
                                                <?php 
                                                    $connection = mysqli_connect ("localhost", "root", "", "panel");
                                                    $query = "SELECT * FROM register";
                                                    $query_run = mysqli_query($connection, $query);
                                                
                                                    if(mysqli_num_rows($query_run) > 0)    
                                                    {
                                                ?>
                                                <table class="table table-bordered" id="dataTable" width="100"% cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Password</th>
                                                        <th>Usertype</th>
                                                        <th>EDIT</th>
                                                        <th>DELETE</th>
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                            <?php 
                                                                    while($row = mysqli_fetch_assoc($query_run))
                                                                    {
                                                                    ?>          
                                                                <tr>
                                                                    <td><?php echo $row['id']; ?></td>
                                                                    <td><?php echo $row['username']; ?></td>
                                                                    <td><?php echo $row['email']; ?></td>
                                                                    <td><?php echo $row['password']; ?></td>
                                                                    <td><?php echo $row['usertype']; ?></td>
                                                                    <td> 
                                                                        <form action="register_edit.php" method="post">
                                                                            <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                                                            <button type="submit" name="edit_btn" class="btn btn-warning">
                                                                                <i class="fas fa-edit"></i>
                                                                            </button>
                                                                        </form>
                                                                    </td>
                                                                    <td> 
                                                                        <form action="code.php" method="post">
                                                                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                                            <button type="submit" name="deletebtn" class="btn btn-danger">
                                                                                <i class="fas fa-trash"></i>
                                                                            </button> 
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                <?php        
                                                                
                                                                }
                                                            }
                                                            else {
                                                                    echo "No Record Found";
                                                            }                      
                                                            ?>  


                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </main>

<?php
include('includes/_footer.php');
?>