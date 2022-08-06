<?php include('partials/menu.php') ?>

<div class="main-content">
        <div class="wrapper">
            <h1>Change Password Admin</h1>

            <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
            ?>

            <br><br>

            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password</td>
                        <td>
                            <input type="password" name="current-password" placeholder="Current Password" value="">
                        </td>
                    </tr>

                    <tr>
                        <td>New Password</td>
                        <td>
                            <input type="password" name="new-password" placeholder="New Password" value="">
                        </td>
                    </tr>

                    <tr>
                        <td>Confirm Password</td>
                        <td>
                            <input type="password" name="confirm-password" placeholder="Confirm Password" value="">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            <button name="submit" class="btn-secondary">Change Password</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</div>

<?php
if(isset($_POST['submit'])){
    //1.Get data from form
    $id=$_POST['id'];
    $current=md5($_POST['current-password']);
    $new=md5($_POST['new-password']);
    $confirm=md5($_POST['confirm-password']);

    //2.Check the user with id to confirm the password is exist or not
    $sql="SELECT * FROM admin_tb WHERE id ='$id' AND password='$current'";
    //execute
    $result=mysqli_query($conn,$sql);
    if($result==true){
        //Check whether the data is available or not
        $count =mysqli_num_rows($result);

        if($count==1){
            //User exists and password can be changed
            //Check whether the new pass and confirm password is sme or not
            if($new==$confirm){
                //Update Password
                $sql2="UPDATE admin_tb SET
                    password='$new' WHERE id='$id'";
                
                $result2=mysqli_query($conn,$sql2);

                //Check whether query executed
                if($result2==true){
                    //Display Success Message
                    $_SESSION['change-pwd'] ="<div class='success'>Password is Changed</div>";
                    header("Location:".SITEURL.'admin/manage-admin.php');
                }else{
                    //Display Error message
                    $_SESSION['error'] ="<div class='error'>Error Occured</div>";
                    header("Location:".SITEURL.'admin/manage-admin.php');
                }
            }else{
                //Not match password set session and Redirect 
                $_SESSION['pwd-not-match'] ="<div class='error'>Password is not Match</div>";
                header("Location:".SITEURL.'admin/manage-admin.php');
            }
        }else{
            //User doesnot exists set session and Redirect 
            $_SESSION['user-not-found'] ="<div class='error'>User Not Found</div>";
            header("Location:".SITEURL.'admin/manage-admin.php');
        }
    }

    //3.Check the password confirms or not

    //4Change password f all above are true
}

?>

<?php include('partials/footer.php') ?>