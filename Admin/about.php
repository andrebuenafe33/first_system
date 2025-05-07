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
        <h5 class="modal-title" id="exampleModalLabel">About Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
            <form action="code.php" method="POST">
                    <div class="modal-body">
                        
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                            </div>
                            <div class="form-group">
                                <label>Sub Title</label>
                                <input type="text" name="subtitle" class="form-control" placeholder="Enter Sub Title" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control" placeholder="Enter Description" required>
                            </div>
                            <div class="form-group">
                                <label>Links</label>
                                <input type="text" name="links" class="form-control" placeholder="Enter Links" required>
                            </div>
                    
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="about_save" class="btn btn-success">Save</button>
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
                                <li class="breadcrumb-item active">About Us</li>
                            </ol>
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addadminprofile">
                                        <h6><li class="fas fa-user"></li> Add Abouts</h6>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="card-body mt-2">
                                            <?php 
                                                if(isset($_SESSION['success']) && $_SESSION['success'] !="")
                                                {
                                                    echo '<h3> '.$_SESSION['success'].' </h3>';
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
                                                    $query = "SELECT * FROM abouts";
                                                    $query_run = mysqli_query($connection, $query);
                                                
                                                    if(mysqli_num_rows($query_run) > 0)    
                                                    {
                                                ?>
                                                <table class="table table-bordered" id="dataTable" width="100"% cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Title</th>
                                                        <th>Sub Title</th>
                                                        <th>Description</th>
                                                        <th>Links</th>
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
                                                                    <td><?php echo $row['title']; ?></td>
                                                                    <td><?php echo $row['subtitle']; ?></td>
                                                                    <td><?php echo $row['description']; ?></td>
                                                                    <td><?php echo $row['links']; ?></td>
                                                                    <td> 
                                                                        <form action="about_edit.php" method="post">
                                                                            <input type="hidden" name="about_id" value="<?php echo $row['id']; ?>">
                                                                            <button type="submit" name="about_edit" class="btn btn-warning">
                                                                                <i class="fas fa-edit"></i>
                                                                            </button>
                                                                        </form>
                                                                    </td>
                                                                    <td> 
                                                                        <form action="code.php" method="post">
                                                                            <input type="hidden" name="about_id" value="<?php echo $row['id']; ?>">
                                                                            <button type="submit" name="about_delete" class="btn btn-danger">
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