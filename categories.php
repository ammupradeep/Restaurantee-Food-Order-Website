<?php include('partials-front/menu.php');?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //Dispaly all categories even if its featured or active are 'NO'
                $sql="SELECT * FROM category_tb";
                $result=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($result);

                if($count>0){
                    //Category Available
                    while($rows=mysqli_fetch_assoc($result)){
                        //Fetch id ,title and images
                        $id=$rows['id'];
                        $title=$rows['title'];
                        $image_name=$rows['image_name'];

                        ?>
                            <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id?>">
                                <div class="box-3 float-container">
                                    <?php
                                        if($image_name!=""){
                                            //Image is not available
                                            ?>
                                                <img src="<?php echo SITEURL?>images/categories/<?php echo $image_name;?>" class="img-responsive img-curve">
                                            <?php

                                        }else{
                                            //Image Available
                                            echo "<div class='error'>Image not Available</div>";
                                        }
                                    ?>
                                    

                                    <h3 class="float-text text-white"><?php echo $title;?></h3>
                                </div>
                            </a>


                        <?php
                    }
                }else{
                    //No category Available
                    echo "<div class='error'>Category not Added</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('partials-front/footer.php');?>