<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php
        
            //Get the search keyword
            // $search=$_POST['search'];
            $search=mysqli_real_escape_string($conn,$_POST['search']);

        ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                //sql for get food based on search keyword
                //$search=burger' DROP table name;
                //"SELECT * FOM order_tb WHERE title LIKE '%burger'%' OR description LIKE '%%'"

                $sql="SELECT * FROM food_tb WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                $result=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($result);

                if($count > 0){
                    //Food Available
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
                                    //Check if image is Available
                                    if($food_image_name!=""){
                                        //Image is available
                                        ?>

                                            <img src="<?php echo SITEURL;?>images/food/<?php echo $food_image_name;?>"  class="img-responsive img-curve">

                                        <?php
                                    }else{
                                        //Image is not available
                                        echo "<div class='error'>Image is not Available Now</div>";
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
                    echo "<div class='error'>Food is not Available Now</div>";
                }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>