<?php include('partials-front/menu.php');?>

<?php

    //Check whether food id is checked or not
    if(isset($_GET['food_id'])){
        //Get the food id and detailes of selected food
        $food_id=$_GET['food_id'];

        //Get the details of selected food
        $sql="SELECT * FROM food_tb WHERE id=$food_id";
        $result=mysqli_query($conn,$sql);

        $count=mysqli_num_rows($result);

        if($count==1){
            //Data is available
            //Get data from database
            $row=mysqli_fetch_assoc($result);

            $title=$row['title'];
            $price=$row['price'];
            $image_name=$row['image_name'];
            

        }else{
            //Food not Available
            header("Location:".SITEURL);
        }


    }else{
        //Redirect to home page
        header("Location:".SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            //Check whether the image is available or not
                            if($image_name!=""){
                                //Image available

                                ?>

                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" class="img-responsive img-curve">

                                <?php

                            }else{
                                //Image not available
                                echo "<div class='error'>Image not Available</div>";
                            }
                        
                        ?>

                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Ammukutty Pradeep" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@ammukuttypradeep.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            
                //cHECK WHETHER HE SUBMIT IS CLICKE DOR NOT
                if(isset($_POST['submit'])){
                    //Get all detailes from the form
                    
                    $food=$_POST['food'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];

                    $total=$price * $qty; //Total= price * quantity

                    $order_date=date("Y-m-d h:i:sa"); // now 2022 8 1 13.17pm

                    $status="Ordered"; //ordered,on delivery ,Deliverd ,Cancelled

                    $customer_name=$_POST['full-name'];
                    $customer_contact=$_POST['contact'];
                    $customer_email=$_POST['email'];
                    $customer_address=$_POST['address'];


                    //Save data in database
                    $sql2="INSERT INTO order_tb SET
                            food='$food',
                            price=$price,
                            qty=$qty,
                            total=$total,
                            order_date='$order_date',
                            status='$status',
                            customer_name='$customer_name',
                            customer_contact='$customer_contact',
                            customer_email='$customer_email',
                            customer_address='$customer_address'";

                    $result2=mysqli_query($conn,$sql2);

                    if($result==true){
                        //Query executed and inserted
                        $_SESSION['order']="<div class='success text-center'>Ordered Successfully</div>";
                        header("Location:".SITEURL);

                    }else{
                        //Filed to save order
                        $_SESSION['order']="<div class='error text-center'>Failed to Order</div>";
                        header("Location:".SITEURL);

                    }

                }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php');?>