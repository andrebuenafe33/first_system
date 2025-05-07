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
                <h5 class="modal-title" id="exampleModalLabel">Add Faculty Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="faculty_name" class="form-control" placeholder="Enter Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input type="text" name="faculty_designation" class="form-control" placeholder="Enter Designation" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" name="faculty_description" class="form-control" placeholder="Enter Description" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Upload Image</label>
                                        <input type="file" name="faculty_image" id="faculty_image" class="form-control" required>
                                    </div>
                            
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="faculty_save" class="btn btn-success">Save</button>
                            </div>
                    </form>


                </div>
            </div>
    </div>
    <!-- End of Modal -->

    <!-- Delete Multiple Modal -->
    <div class="modal fade" id="deletemultipledata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="code.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure you want to delete?</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Selected data will be deleted.
                        <!-- Hidden input to hold selected IDs -->
                        <input type="hidden" name="delete_ids" id="delete_ids">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete_multiple" class="btn btn-danger">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Delete Multiple Modal -->

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="code.php" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this faculty record?
                        <input type="hidden" name="faculty_id" id="delete_faculty_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="faculty_delete" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End of Delete Confirmation Modal -->



    <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Faculties</li>
                            </ol>
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <!-- Add Button (Left) -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addadminprofile">
                                            <i class="fas fa-user"></i> Add Faculty
                                        </button>

                                        <!-- Delete Multiple Button (Right) -->
                                        <button type="button" class="btn btn-danger" onclick="prepareDelete()" data-bs-toggle="modal" data-bs-target="#deletemultipledata">
                                            <i class="fas fa-trash"></i> Delete Multiple Data
                                        </button>
                                    </div>
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
                                                    $query = "SELECT * FROM faculty";
                                                    $query_run = mysqli_query($connection, $query);
                                                
                                                    if(mysqli_num_rows($query_run) > 0)    
                                                    {
                                                ?>
                                                <table class="table table-bordered" id="dataTable" width="100"% cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Check</th>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Designation</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
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
                                                                    <td>
                                                                        <input type="checkbox" onclick="toggleCheckbox(this)" value="<?php echo $row['id'] ?>" <?php echo $row['visible'] == 1 ? "checked" : "" ?> >
                                                                    </td>
                                                                    <td><?php echo $row['id']?> </td>
                                                                    <td><?php echo $row['name']?></td>
                                                                    <td><?php echo $row['designation']?></td>
                                                                    <td><?php echo $row['description']?></td>
                                                                    <td><?php echo '<img src="upload/'.$row['images'].'" width="100px;" height="100px;" alt="Image">' ?></td>
                                                                    <td> 
                                                                        <form action="faculty_edit.php" method="post">
                                                                            <input type="hidden" name="faculty_id" value="<?php echo $row['id']; ?>">
                                                                        <button type="submit" name="faculty_edit" class="btn btn-info">
                                                                            <i class="bi bi-pecil-square">EDIT</li>
                                                                        </button>
                                                                        </form>
                                                                    </td>
                                                                    <td> 
                                                                        <button type="button" class="btn btn-danger" onclick="confirmDelete(<?php echo $row['id']; ?>)">
                                                                            <i class="bi bi-trash3">DELETE</i>
                                                                        </button>
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

<!-- This is the scripts for the checkbox -->
<script>
    function toggleCheckbox(box) {
        var id = $(box).val(); 
        var visible = $(box).prop("checked") ? 1 : 0;

        $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                search_data: 1,
                id: id,
                visible: visible
            },
            success: function(response) {
                console.log("Checkbox updated: ID " + id + ", Visible: " + visible);
            }
        });
    }
</script>

<!-- This script is to collect the data from checkbox -->
<script>
    function prepareDelete() {
        var selected = [];
        $('input[type=checkbox]').each(function() {
            if (this.checked && $(this).val() !== '') {
                selected.push($(this).val());
            }
        });

        $('#delete_ids').val(selected.join(','));
    }
</script>

<!-- this is for delete comfirmation modal -->
<script>
    function confirmDelete(id) {
        document.getElementById('delete_faculty_id').value = id;
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        deleteModal.show();
    }
</script>


<?php
include('includes/_footer.php');
?>