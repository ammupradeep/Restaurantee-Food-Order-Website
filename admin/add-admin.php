<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//Displaying the session messege
                unset($_SESSION['add']); //Removing seddion message
            }
            ?>
        <br><br>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full-name" placeholder="Enter your Name"></td>
                </tr>
                <tr>
                    <td>User Name</td>
                    <td><input type="text" name="user-name" placeholder="Enter User Name"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Enter Password"></td>
                </tr>
                <br>
                <tr>
                    <td colspan="2">
                        <button name="submit" class="btn-secondary">ADD ADMIN</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php');?>

<?php  

// Process the value from form and save it in the database

// Check weather the submit button is clicked

if(isset($_POST['submit'])){
    // echo "Button Clicked";
    //1.get data from form

    $full_name=mysqli_real_escape_string($conn,$_POST['full-name']);
    $user_name=mysqli_real_escape_string($conn,$_POST['user-name']);
    $password=md5($_POST['password']); //encrypt the password

    //2.Sql query to save data into database

    $sql= "INSERT INTO admin_tb SET 
        fullname = '$full_name',
        username ='$user_name',
        password ='$password'";

    //3.Execute query and save data to database
    $result=mysqli_query($conn,$sql) or die(mysqli_error());
    //4.Check whether the (Query is executed)data is inserted or not and display the error message 
    
    if($result == true){
        //create var to display message
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
        //redirect page to manage-admin
        header("Location:".SITEURL.'admin/manage-admin.php');
    }else{
        //create var to display message
        $_SESSION['add'] = "<div class='error'>Failed to add Admin</div>";
        //redirect page to manage-admin
        header("Location:".SITEURL.'admin/add-admin.php');
    }
}
?>