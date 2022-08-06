
<?php  include('partials/menu.php');?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>DASHBOARD</h1>
            <br><br>
            <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];//Displaying the session messege
                unset($_SESSION['login']); //Removing seddion message
            }
            ?>
            <br><br>


            <div class="col-4 text-center">

                <?php
                    //Sql query
                    $sql="SELECT * FROM category_tb";
                    $result = mysqli_query($conn,$sql);

                    //Count rows
                    $count=mysqli_num_rows($result);
                ?>

                <h1><?php echo $count; ?></h1><br>
                Categories
            </div>

            <div class="col-4 text-center">

                <?php
                    //Sql query
                    $sql2="SELECT * FROM food_tb";
                    $result2 = mysqli_query($conn,$sql2);

                    //Count rows
                    $count2=mysqli_num_rows($result2);
                ?>

                <h1><?php echo $count2; ?></h1><br>
                Foods
            </div>

            <div class="col-4 text-center">

                <?php
                    //Sql query
                    $sql3="SELECT * FROM order_tb";
                    $result3 = mysqli_query($conn,$sql3);

                    //Count rows
                    $count3=mysqli_num_rows($result3);
                ?>

                <h1><?php echo $count3; ?></h1><br>
                Orders
            </div>

            <div class="col-4 text-center">


                <?php
                    //Query to find total revenue
                    //Aggregate function in sql
                    $sql4="SELECT SUM(total) AS Total FROM order_tb WHERE status='Delivered'";

                    $result4=mysqli_query($conn,$sql4);

                    //Get the value
                    $row4 = mysqli_fetch_assoc($result4);

                    //Get total revenue
                    $total_revenue = $row4['Total'];

                ?>

                <h1><?php echo $total_revenue; ?></h1><br>
                Revenue Generated
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- Main Content Section Ends -->

<?php  include('partials/footer.php');?>