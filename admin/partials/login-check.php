<?php
//Authorization
//Check wether the user is logged in or not
if(!isset($_SESSION['user'])){ //if user session is not checked
    //user is not logged in
    //Redirect to login.php with message
    $_SESSION['no-login-messege']="<div class='error'>Please login to access Admin Panel</div>";
    //Redirect
    header("Location:".SITEURL.'admin/login.php');
}


?>