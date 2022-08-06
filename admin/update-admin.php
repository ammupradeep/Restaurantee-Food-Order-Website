<?php include('partials/menu.php') ?>

<div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>

            <br><br>

            <?php
            //1.Get id of selected admin
            $id=$_GET['id'];

            //2.Sql query for get details
            $sql="SELECT * FROM admin_tb WHERE id=$id";

            //3.Execute the query
            $result=mysqli_query($conn,$sql);

            if($result == true){
                $count = mysqli_num_rows($result);

                if($count==1){
                    // We have data in database;
                    $rows=mysqli_fetch_assoc($result);
                    $id = $rows['id'];
                    $fname = $rows['fullname'];
                    $uname = $rows['username'];
                    
                }else{
                    //Redirect to admin page
                    header("Location:".SITEURL.'admin/manage-admin.php');
                }
            }
            ?>

            <br><br>
            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name</td>
                        <td>
                            <input type="text" name="full-name" value="<?php echo $fname?>">
                        </td>
                    </tr>

                    <tr>
                        <td>User Name</td>
                        <td>
                            <input type="text" name="user-name" value="<?php echo $uname?>">
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            <button name="submit" class="btn-secondary">Update Admin</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</div>

<?php
//1.Check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    //Get value from form
    $id = $_POST['id'];
    $fname = $_POST['full-name'];
    $uname = $_POST['user-name'];
    //QUERY FOR UPDATE
    echo $sql2 = "UPDATE admin_tb SET 
    fullname='$fname',
    username='$uname'  WHERE id = '$id'";

    $result2 = mysqli_query($conn,$sql2);

    if($result2 == true){
        //Admin updated
        $_SESSION['update'] ="<div class='success'>Admin Updated Successfully</div>";
        header("Location:".SITEURL.'admin/manage-admin.php');
    }else{
        //Failed
        $_SESSION['update'] ="<div class='error'>Failed to Update Admin</div>";
        header("Location:".SITEURL.'admin/manage-admin.php');
    }
}
?>

<?php include('partials/footer.php') ?>