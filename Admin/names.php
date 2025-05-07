<?php 
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

                            
 <div class="col-xl-4 col-md-4 mb-4">
 <div class="card border-left-primary shadow h-100 py-2">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="text-40% font-weight-bold text-primary text-uppercase mb-5">Name of Accounts</div>
 <div class="h5 mb-0 font-weight-bold text-gray-800"> 
<div class="table-responsive">

 <table class="table table-bordered" id="dataTable" width="100"% cellspacing="0">
     <thead>
         <tr>
                                                                
                                                                
          <?php 
           require 'dbconfig.php';

           $query = "SELECT username FROM register ORDER BY register.id ASC";
           $query_run = mysqli_query($connection, $query);                                                    
                    if(mysqli_num_rows($query_run) > 0)    
               {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
            ?>          
            <tr>
                                                                            
            <td><?php echo $row['username']; ?></td>
                                                                            
             </tr>
              </thead>
               <thead>
  <tbody>
             <?php        
                 }
                  }
                    else {
                      echo "No Accounts Found";
                     }                      
              ?>  


                                                            
</div>

</div>
                                        
 </div>
                                                         
 </div>
</div>
</div>
 </div>


<?php
include('includes/scripts.php');
?>