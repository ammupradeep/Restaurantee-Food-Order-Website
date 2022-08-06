<?php

include('../config/constants.php');

//1. get id of admin to be deleted
$id=$_GET['id'];

//2.create sql query to delete admin
$sql = "DELETE FROM admin_tb WHERE id=$id";

//Execute the query
$result =mysqli_query($conn,$sql);

if($result==true){
    //Query executed and deleted
    //Sessio var to display msg

    $_SESSION['delete'] ="<div class='success'>Admin Deleted Successfully</div>";
    header("Location:".SITEURL.'admin/manage-admin.php');
}else{
    //Didn't deleted
    $_SESSION['delete'] ="<div class='error'>Failed to Delete Admin</div>";
    header("Location:".SITEURL.'admin/manage-admin.php');
}
//3.Redirect to manage-admin page with msg -> success or error


?>