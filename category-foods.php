<?php include('partials-front/menu.php');?>

<?php
    //Check whether id is passed or not
    if(isset($_GET['category_id'])){
        //Categoy d is set 
        //Get the id
        $category_id=$_GET['category_id'];

        //Get category title Based on the id
        $sql="SELECT title FROM category_tb WHERE id=$category_id";
        $result=mysqli_query($conn,$sql);

        //Get value from database
        $row=mysqli_fetch_assoc($result);
        //Get the title
        $category_title=$row['title'];
    }else{
        //Id is not set
        header('Location:'.SITEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                $sql2="SELECT * FROM food_tb WHERE category_id='$category_id'";
                $result2=mysqli_query($conn,$sql2);

                $count=mysqli_num_rows($result2);

                if($count > 0){
                    //food is available
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
                                        //Check whether image is available\
                                        if($food_image_name!=""){
                                            //Image is available

                                            ?>

                                                <img src="<?php echo SITEURL;?>images\food\<?php echo $food_image_name;?>"  class="img-responsive img-curve">

                                            <?php
                                        }else{
                                            //Image is not available
                                            echo "<div class='error'>Image is not Available</div>";
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
                    echo "<div class='error'>Food is not Available</div>";
                }
            
            ?>

            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>