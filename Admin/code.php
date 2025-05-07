<?php 
    include('security.php'); 

    $connection = mysqli_connect("localhost","root","","panel");

    if(isset($_POST['check_submit_btn']))
    {
        $email = $_POST['email_id'];
        $email_query = "SELECT * FROM register WHERE email='$email' ";
        $email_query_run = mysqli_query($connection, $email_query);
        if(mysqli_num_rows($email_query_run) > 0 )
        {
            echo "Email Already Taken!";
        }
        else
        {
            echo "It's Available!"; 
        }
    }

    if(isset($_POST['registerbtn']))
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['confirmpassword'];
        $usertype = $_POST['usertype'];


        $email_query = "SELECT * FROM register WHERE email='$email' ";
        $email_query_run = mysqli_query($connection, $email_query);
        if(mysqli_num_rows($email_query_run) > 0 )
        {
            $_SESSION['status'] = "Email Already Taken!";
            header('Location: register.php');
        }
        else
        {

            if($password === $cpassword)
            {
                $query = "INSERT INTO register (username,email,password,usertype,date) VALUES  ('$username','$email','$password','$usertype', NOW())";
                $query_run = mysqli_query($connection, $query);
        
        
                    if($query_run)
                    {
                            $_SESSION['success'] = "User Added!";
                            header('Location: register.php');
                    }
                    else
                    {       
                            $_SESSION['status'] = "User Not Added!";
                            header('Location: register.php');
                    }
            }
            else
            {
                $_SESSION['status'] = "Password and Confirm Password Does Not Match!";
                header('Location: register.php');
            }
        }
    }





    // This is from register_edit.php line 53 If you click the "Update" button //

    if(isset($_POST['updatebtn']))
    {
            $id = $_POST['edit_id'];
            $username = $_POST['edit_username'];
            $email = $_POST['edit_email'];
            $password = $_POST['edit_password'];
            $upusertype = $_POST['update_usertype'];

            $query = "UPDATE register SET username='$username', email='$email', password='$password', usertype='$upusertype' WHERE id='$id' ";
            $query_run = mysqli_query($connection, $query);

            if($query_run)
            {
                $_SESSION['success'] = "Your Data is Updated Successfully!";
                header('Location: register.php');
            }
            else
            {
                $_SESSION['status'] = "Your Data is NOT Updated!";
                header('Location: register.php');
            }

    }

            //this is from register.php line 121 If you click the "Delete" button //


        if(isset($_POST['deletebtn']))
        {
            $id = $_POST['delete_id'];

            $query = "DELETE FROM register Where id='$id' ";
            $query_run = mysqli_query($connection, $query);

            if($query_run)
            {
                $_SESSION['success'] = "Your Data is Deleted Successfully!";
                header('Location: register.php');
            }
            else
            {
                $_SESSION['status'] = "Your Data is NOT Deleted!";
                header('Location: register.php');
            }
        }
?>

<?php
include('security.php');
 
        // This is from Login.php //

        if(isset($_POST['login_btn']))
        {
            $email_login = $_POST ['email'];
            $password_login = $_POST ['password'];

            $query = "SELECT * FROM register WHERE email='$email_login'  AND password='$password_login' ";
            $query_run = mysqli_query($connection, $query);
            $usertypes = mysqli_fetch_array($query_run);

            if($usertypes['usertype'] == "Admin")
            {
                $_SESSION['username'] = $email_login;
                 header('Location: index.php');
            }
            else if($usertypes['usertype'] == "Guest") 
            {
                $_SESSION['username'] = $email_login;
                 header('Location: ../index.php');
            }
            else 
            {
                $_SESSION['status'] = 'Email id / Password is Invalid!';
                 header('Location: login.php');
            }
        }

?>

<?php 
        // This is from About.php //
    $connection = mysqli_connect("localhost","root","","panel"); 

if(isset($_POST['about_save']))
{
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $description = $_POST['description'];
        $links = $_POST['links'];
        
        $query = "INSERT INTO abouts (title,subtitle,description,links,date) VALUES  ('$title','$subtitle','$description','$links',NOW())";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            $_SESSION['success'] = "About Us Added Successfully!";
            header('Location: about.php');
        }
        else 
        {
            $_SESSION['status'] = "About Us Not Added!";
            header('Location: about.php');
        }

}

    // This is Delete Button of About.php //
    if(isset($_POST['about_delete']))
        {
            $id = $_POST['about_id'];

            $query = "DELETE FROM abouts Where id='$id' ";
            $query_run = mysqli_query($connection, $query);

            if($query_run)
            {
                $_SESSION['success'] = "Your Data is Deleted Successfully!";
                header('Location: about.php');
            }
            else
            {
                $_SESSION['status'] = "Your Data is NOT Deleted!";
                header('Location: about.php');
            }
        }


        // This is Update Button of About.php //
        if(isset($_POST['about_update']))
    {
            $id = $_POST['about_id'];
            $title = $_POST['about_title'];
            $subtitle = $_POST['about_subtitle'];
            $description = $_POST['about_description'];
            $links = $_POST['about_links'];

            $query = "UPDATE abouts SET title='$title', subtitle='$subtitle', description='$description', links='$links' WHERE id='$id' ";
            $query_run = mysqli_query($connection, $query);

            if($query_run)
            {
                $_SESSION['success'] = "Your Data is Updated Successfully!";
                header('Location: about.php');
            }
            else
            {
                $_SESSION['status'] = "Your Data is NOT Updated!";
                header('Location: about.php');
            }

    }
?>

<?php 
// This is from Faculty.php Save Button // 
include('security.php');

if(isset($_POST['faculty_save'])) {
    $name = $_POST['faculty_name'];
    $designation = $_POST['faculty_designation'];
    $description = $_POST['faculty_description'];
    $images = $_FILES["faculty_image"]['name'];
    
    // Allowed image types //
    $img_types = array('image/jpg','image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["faculty_image"]['type'], $img_types);

    if($validate_img_extension) {
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["faculty_image"]["name"]);

        if(file_exists($target_file)) {
            // Image already exists, delete the existing image
            if(unlink($target_file)) {
                // If the old file is successfully deleted, continue with the new upload
                $_SESSION['status'] = "Existing image removed, uploading new image.";
            } else {
                $_SESSION['status'] = "Failed to delete existing image.";
                header('Location: faculty.php');
                exit();
            }
        }

        // Now insert the data into the database
        $query = "INSERT INTO faculty (name,designation,description,images,date) VALUES ('$name','$designation','$description','$images', NOW())";
        $query_run = mysqli_query($connection, $query);

        if($query_run) {
            // Move the new uploaded file
            move_uploaded_file($_FILES["faculty_image"]["tmp_name"], $target_file);
            $_SESSION['success'] = "Faculty Added Successfully!";
            header('Location: faculty.php');
        } else {
            $_SESSION['status'] = "Faculty Not Added!";
            header('Location: faculty.php');
        }

    } else {
        $_SESSION['status'] = "Only Png, Jpeg, Jpg Images Are Allowed!";
        header('Location: faculty.php');
    }
}


?>
<?php

// this is from faculty_edit.php Update Button // 
include('security.php');
    if(isset($_POST['faculty_update'])) {
        $id = $_POST['faculty_id'];
        $name = $_POST['faculty_name'];
        $designation = $_POST['faculty_designation'];
        $description = $_POST['faculty_description'];
        $images = $_FILES["faculty_images"]['name'];

        $faculty_query = "SELECT * FROM faculty WHERE id='$id'";
        $faculty_query_run = mysqli_query($connection, $faculty_query);
        
        foreach($faculty_query_run as $fac_row) {
            if($images == NULL) {
                // Keep existing image
                $image_data = $fac_row['images'];
            } else {
                // Replace with new image, delete old image
                $old_image_path = "upload/" . $fac_row['images'];
                if(file_exists($old_image_path)) {
                    unlink($old_image_path); // delete old image
                }
                $image_data = $images;
            }
        }

        $query = "UPDATE faculty SET name='$name', designation='$designation', description='$description', images='$image_data' WHERE id='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run) {
            if($images != NULL) {
                move_uploaded_file($_FILES["faculty_images"]["tmp_name"], "upload/" . $_FILES["faculty_images"]["name"]);
                $_SESSION['success'] = "Your Data is Updated Successfully with New Image!";
            } else {
                $_SESSION['success'] = "Your Data is Updated Successfully with Existing Image!";
            }
            header('Location: faculty.php');
        } else {
            $_SESSION['status'] = "Your Data is NOT Updated!";
            header('Location: faculty.php');
        }
    }

?>
<?php
        // this is from faculty.php Delete button //
        if(isset($_POST['faculty_delete']))
        {
            $id = $_POST['faculty_id'];

            $query = "DELETE FROM faculty WHERE id='$id' ";
            $query_run = mysqli_query($connection, $query);

            if($query_run)
            {
                $_SESSION['success'] = "Your Data is Deleted Successfully!";
                header('Location: faculty.php');
            }
            else
            {
                $_SESSION['status'] = "Your Data is NOT Deleted!";
                header('Location: faculty.php');
            }
        }
       
    



?>

        <!-- This is the code for script in the faculty.php to toggle on alert -->
<?php 
include('security.php');
    
    if(isset($_POST['search_data']))
    {
        $id = $_POST['id'];
        $visible = $_POST['visible'];

        $query = "UPDATE faculty SET visible='$visible' WHERE id='$id' ";
        $query_run = mysqli_query($connection, $query);


    }


    if (isset($_POST['delete_multiple'])) {
        $ids = $_POST['delete_ids']; // Comma-separated list of IDs

        if (!empty($ids)) {
            $id_array = explode(",", $ids);
            $clean_ids = array_map('intval', $id_array); // Clean the input
            $id_string = implode(",", $clean_ids);

            // Only delete where visible=1 and ID is in the selected list
            $query = "DELETE FROM faculty WHERE visible='1' AND id IN ($id_string)";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                $_SESSION['success'] = "Selected Data Deleted Successfully!";
            } else {
                $_SESSION['status'] = "Error Deleting Data!";
            }
        } else {
            $_SESSION['status'] = "No Data Selected!";
        }

        header('Location: faculty.php');
    }






?>











