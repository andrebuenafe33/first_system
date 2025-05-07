<?php
session_start();

include('dbconfig.php');

//  if($dbconfig) 
// {
//      echo "database connected";
// }
// else
// {
//     header ('Location: index.php');
// }

if(!$_SESSION['username'])
{
    header ('Location: login.php');
}

?>