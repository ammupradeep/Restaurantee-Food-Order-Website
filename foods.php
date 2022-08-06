<?php include('partials-front/menu.php');?>

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



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                //Display all foods
                $sql="SELECT * FROM food_tb ";
                $result=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($result);

                if($count > 0){
                    //Food available
                    while($row=mysqli_fetch_assoc($result)){
                        //Fetch id,title,price,image and description
                        $food_id=$row['id'];
                        $food_title=$row['title'];
                        $food_price=$row['price'];
                        $food_image_name=$row['image_name'];
                        $food_description=$row['description'];

                        ?>
                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <?php
                                            if($food_image_name!=""){
                                                //Image available
                                                ?>
                                                
                                                <img src="<?php echo SITEURL;?>images/food/<?php echo $food_image_name?>" class="img-responsive img-curve">
                                            
                                                <?php
                                            }else{
                                                //Image not Available
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
                    //Food not available
                    echo "<div class='error'>Food not Added</div>";
                }
            ?>


            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>