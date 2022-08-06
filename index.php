<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
        //Order
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            //sql to diasplay categories from db
            $sql="SELECT * FROM category_tb WHERE active='Yes' AND featured='Yes' LIMIT 3";
            $result=mysqli_query($conn,$sql);

            //$count
            $count=mysqli_num_rows($result);

            if($count>0){
                while($row=mysqli_fetch_assoc($result)){
                    //Fetch id, title and image name for the display
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];

                    ?>
                        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //Check whether image is available or not
                                    if($image_name==""){
                                        //Display message
                                        echo "<div class='error'>Image Not Available </div>";
                                    }else{
                                        //Image Available
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/categories/<?php echo $image_name;?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title;?></h3>
                            </div>
                        </a>

                    <?php
                }
            }else{
                //Category is not available
                echo "<div class='error'>Category not Added</div>";
            }
            ?>

            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //Display all food having active and featured='Yes'
                $sql2="SELECT * FROM food_tb WHERE featured='Yes' and active='Yes'";
                $result2=mysqli_query($conn,$sql2);

                $count2=mysqli_num_rows($result2);

                if($count2>0){
                    //Food available
                    while($row2=mysqli_fetch_assoc($result2)){
                        //Fetch id,title,price,image and description
                        $food_id=$row2['id'];
                        $food_title=$row2['title'];
                        $food_price=$row2['price'];
                        $food_image_name=$row2['image_name'];
                        $food_description=$row2['description'];

                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($food_image_name!=""){
                                            //Image Available
                                            ?>
                                                <img src="<?php echo SITEURL;?>images/food/<?php echo $food_image_name;?>" class="img-responsive img-curve">
                                            <?php
                                        }else{
                                            //Image is not Available
                                            echo "<div class='error'>Image not Available</div>";

                                        }
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $food_title;?></h4>
                                    <p class="food-price"><?php echo $food_price;?></p>
                                    <p class="food-detail"><?php echo $food_description;?></p>
                                    <br>

                                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $food_id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                        <?php
                    }
                }else{
                    //Food is not available
                    echo "<div class='error'>Food not Added</div>";
                }
            ?>

            

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL;?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
    