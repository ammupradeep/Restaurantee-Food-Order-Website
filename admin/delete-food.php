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
        $path="../images/food/".$image_name;

        //Remove image
        $remove=unlink($path);
        //If failed to remove
        if($remove==false){
            die(mysqli_error());
            //Set session and redirect and stop the process
            $_SESSION['remove'] ="<div class='error'>Failed to remove Food Image</div>";
            header("Location:".SITEURL.'admin/manage-food.php');
            die();
        }
    }
    //2.Delete image from db
    $sql="DELETE FROM food_tb WHERE id=$id";
    $result=mysqli_query($conn,$sql);

    //Check whether data is in db or not
    if($result==true){
        //Redirect to  manage food page
        $_SESSION['delete'] ="<div class='success'>Foood Deleted Successfully</div>";
        header("Location:".SITEURL.'admin/manage-food.php');
    }else{
            //Redirect to  manage food page
        $_SESSION['delete'] ="<div class='error'>Failed to Delete Food</div>";
        header("Location:".SITEURL.'admin/manage-food.php');
    }
}else{
    //Redirect to  manage food page
    $_SESSION['unauthorised'] ="<div class='error'>UnAuthorised Access</div>";
    header("Location:".SITEURL.'admin/manage-food.php');

}