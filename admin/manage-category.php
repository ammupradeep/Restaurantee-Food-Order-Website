<?php include('partials/menu.php') ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Category</h1>
            <br><br>
            
            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            //Remove image from category
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            //If no category is found in update
            if(isset($_SESSION['no-category-found'])){
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            //update category
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            //update new img
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            //Failed to remove image in update
            if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
            ?>
            
            <br><br>

            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a> 
            
            <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>Sl.No</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                <?php
                //Query to get category from database
                $sql="SELECT * FROM category_tb";
                $result=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($result);
                $sn=1;//create serial number variable and assign value as 1

                //Check whether data in database or not
                if($count > 0){
                    //Have data in database
                    //Get the data
                    while($row=mysqli_fetch_assoc($result)){
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];
                        
                        ?>

                        <tr>
                            <td><?php echo $sn++ ;?>.</td>
                            <td><?php echo $title;?></td>
                            <td>
                                <?php 
                                //Check whether teh image is available or not
                                if($image_name!=""){
                                    //Display the image
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/categories/<?php echo $image_name ;?>" width="100px">
                                    <?php
                                }else{
                                    //Display Message
                                    echo "<div class='error'>Image Not Added</div>";
                                }
                                ?>
                            </td>
                            <td><?php echo $featured;?></td>
                            <td><?php echo $active;?></td>
                            <td><a href="<?php echo SITEURL ;?>admin/update-category.php?id=<?php echo $id?>" class="btn-secondary">Update Category</a>
                                <!-- id and image name is also passed to delete it from the db-->
                                <a href="<?php echo SITEURL ;?>admin/delete-category.php?id=<?php echo $id?>&image_name=<?php echo $image_name; ?>" class="btn-danger" >Delete Category</a>
                            </td>
                        </tr>

                        <?php


                    }
                }else{
                    //Donot have database
                    //Display the message inside table
                    ?>
                    
                    <tr>
                        <td colspan="6"><div class="error">No Catgory Added.</div></td>
                    </tr>

                    <?php
                }
                ?>
            </table>
        
        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php') ?>