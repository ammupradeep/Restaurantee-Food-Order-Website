<!-- //simple login page -->

<?php include('../config/constants.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login-fOOF-ORDER SYSTEM</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login text-center" >
        <h1>Login</h1>

        <br><br>
        <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];//Displaying the session messege
            unset($_SESSION['login']); //Removing seddion message
        }

        if(isset($_SESSION['no-login-messege'])){
            echo $_SESSION['no-login-messege'];//Displaying the session messege
            unset($_SESSION['no-login-messege']); //Removing seddion message
        }
        ?>
        <br><br>
        <!-- Lgin form Starts here -->
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>UserName  </td>
                    <td><input type="text" name="username" placeholder="Username"></td>
                </tr>

                <tr>
                    <td>Password  </td>
                    <td><input type="password" name="password" placeholder="Password"></td>
                </tr>

                <tr>
                    <td>
                    <button name="submit" class="btn-primary">Login</button><br><br>
                    </td>
                </tr>
            </table>
        </form>
        <br><br>
        <!-- Lgin form ends here -->
        <p>Created by <a href="#">Ammukutty Pradeep</a></p>
    </div>
</body>
</html>

<?php

//Check wether the submit button is clicked
if(isset($_POST['submit'])){
    //Process for login
    //1.Get data from login

    // $username=$_POST['username'];
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    //$password=md5($_POST['password']);
    $raw_password=md5($_POST['password']);
    $password=mysqli_real_escape_string($conn,$raw_password);
    

    //2.Check uname and pwd exist or not
    $sql="SELECT * FROM admin_tb WHERE username='$username' AND password='$password'";

    //3.Execute query
    $result=mysqli_query($conn,$sql);

    $count = mysqli_num_rows($result); //get all the rows

    if($count==1){
        //user available and login success
        $_SESSION['login'] ="<div class='success'>Login Successfull!</div>";
        $_SESSION['user'] =$username;//to check wether the user is logged out or not

        header("Location:".SITEURL.'admin/');
    }else{
        //User not found
        $_SESSION['login'] ="<div class='error'>Username and Password didn't Match</div>";
        header("Location:".SITEURL.'admin/login.php');
    }
}

?>