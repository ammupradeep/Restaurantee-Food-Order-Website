<?php

include('../config/constants.php');

// Check whether the id and image name is set or not
if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //Get value and delete
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //1.Delete image physically
    if($image_name != ""){
        //Image is available so remove it
        $path="../images/categories/".$image_name;

        //Remove image
        $remove=unlink($path);
        //If failed to remove
        if($remove==false){
            //Set session and redirect and stop the process
            $_SESSION['remove'] ="<div class='success'>Failed to remove category Image</div>";
            header("Location:".SITEURL.'admin/manage-category.php');
            die();
        }
    }
    //2.Delete image from db
    $sql="DELETE FROM category_tb WHERE id=$id";
    $result=mysqli_query($conn,$sql);

    //Check whether data is in db or not
    if($result==true){
        //Redirect to  manage category page
        $_SESSION['delete'] ="<div class='success'>Category Deleted Successfully</div>";
        header("Location:".SITEURL.'admin/manage-category.php');
    }else{
            //Redirect to  manage category page
        $_SESSION['delete'] ="<div class='error'>Failed to Delete Category</div>";
        header("Location:".SITEURL.'admin/manage-category.php');
    }
}
