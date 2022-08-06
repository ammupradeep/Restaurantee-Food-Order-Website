<?php include('partials/menu.php') ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1><br><br>
            
            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//Displaying the session messege
                unset($_SESSION['add']); //Removing seddion message
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];//Displaying the session messege
                unset($_SESSION['delete']); //Removing seddion message
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];//Displaying the session messege
                unset($_SESSION['update']); //Removing seddion message
            }

            if(isset($_SESSION['user-not-found'])){
                echo $_SESSION['user-not-found'];//Displaying the session messege
                unset($_SESSION['user-not-found']); //Removing seddion message
            }

            if(isset($_SESSION['pwd-not-match'])){
                echo $_SESSION['pwd-not-match'];//Displaying the session messege
                unset($_SESSION['pwd-not-match']); //Removing seddion message
            }

            if(isset($_SESSION['change-pwd'])){
                echo $_SESSION['change-pwd'];//Displaying the session messege
                unset($_SESSION['change-pwd']); //Removing seddion message
            }

            if(isset($_SESSION['error'])){
                echo $_SESSION['error'];//Displaying the session messege
                unset($_SESSION['error']); //Removing seddion message
            }
            ?>

            <br><br><br>

            <!-- Button to add admin  -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a> 
            
            <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>Sl.No</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Actions</th>
                </tr>

                                
                <?php
                    //Query to et all admin
                    $sql = "SELECT * FROM admin_tb ";
                    // Execute the query
                    $result = mysqli_query($conn,$sql);
                    // Check whether query is executed or not
                    if($result == true){
                        // Count rows
                        $count = mysqli_num_rows($result); //get all the rows
                        
                        $sn = 1;//create a var and assign the value to maintain the order in display
                        // check the number of rows
                        if($count > 0){
                            // echo "We have data in database";
                            while($rows=mysqli_fetch_assoc($result)){
                                //uSING WHILE LOOP TO GET ALL the data from the database

                                $id = $rows['id'];
                                $fname = $rows['fullname'];
                                $uname = $rows['username'];

                                //Display the values in the table
                                ?>
                                <tr>
                                    <td><?php echo $sn++?></td>
                                    <td><?php echo $fname?></td>
                                    <td><?php echo $uname?></td>
                                    <td>
                                        <a href="<?php echo SITEURL ;?>admin/update-password.php?id=<?php echo $id?>" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL ;?>admin/update-admin.php?id=<?php echo $id?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL ;?>admin/delete-admin.php?id=<?php echo $id?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }else{
                            // echo "We have no dta in database";
                        }

                    }
                ?>

            </table>

        
        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php') ?>

