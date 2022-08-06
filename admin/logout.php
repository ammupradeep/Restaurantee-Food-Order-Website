<?php

//include constants.php to db connection
include('../config/constants.php');
//Destroy our session  
session_destroy(); //unsets $_session['user']
//redirect to login page
header("Location:".SITEURL."admin/login.php");

?>