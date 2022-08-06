<?php include('partials/menu.php') ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>
            <br><br>

            <?php
            //Add image failed
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }


            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            //Delete
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['unauthorised'])){
                echo $_SESSION['unauthorised'];
                unset($_SESSION['unauthorised']);
            }

            //update
            if(isset($_SESSION['no-food-found'])){
                echo $_SESSION['no-food-found'];
                unset($_SESSION['no-food-found']);
            }

            if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            
            ?>
            <br><br><br>
            
            <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a> 
            
            <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>Sl.No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Featured</th>
                    <th>Active</th>
                </tr>

                <?php
                // 1. Query to get dta from food table
                $sql="SELECT * FROM food_tb ";
                $result=mysqli_query($conn,$sql);

                //Count rows
                $count=mysqli_num_rows($result);

                //Vairable for sl number
                $sn=1;

                if($count > 0){
                    while($row=mysqli_fetch_assoc($result)){
                        $id=$row['id'];
                        $title=$row['title'];
                        $description=$row['description'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];
                        $category_id=$row['category_id'];
                        $featured=$row['featured'];
                        $active=$row['active'];

                        ?>

                        <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $title;?></td>
                            <td><?php echo $description;?></td>
                            <td><?php echo $price;?></td>
                            <td>
                                <?php 
                                
                                //Check whether the image is available or not
                                if($image_name!=""){
                                    //Display the image
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name ;?>" width="100px">
                                    <?php
                                }else{
                                    //Display Message
                                    echo "<div class='error'>Image Not Added</div>";
                                }
                                ?>
                            </td>
    
                            <?php 
                                $sql2="SELECT title FROM category_tb WHERE id=$category_id";
                                $result2=mysqli_query($conn,$sql2);
                                
                                if($result2==true){
                                    //Category Available
                                    $row2=mysqli_fetch_assoc($result2);
                                    $category_title=$row2['title'];
                                    ?>
                                    <td><?php echo $category_title?></td>
                                    <?php

                                }else{
                                    //No category available
                                }
                            
                            ?>
                            
                            <td><?php echo $featured;?></td>
                            <td><?php echo $active;?></td>
                            <td><a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                                <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                            </td>
                        </tr>

                        <?php
                    }
                }else{
                    //No data found
                    //Display the message inside table
                    ?>
                    
                    <tr>
                        <td colspan="6"><div class="error">No Food Added.</div></td>
                    </tr>

                    <?php
                }
                ?>

                
            </table>

        
        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php') ?>