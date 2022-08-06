<?php include('partials/menu.php') ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">

            <h1>Manage Order</h1>

            <br>
            <?php
                //Updation
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            
            <br><br><br>
            <table class="tbl-full text-center">
                <tr>
                    <th>Sl.No</th>
                    <th>Food Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th class="text-center">Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th class="text-center">Actions</th>
                </tr>


                <?php
            
                    //Get data from db
                    $sql="SELECT * FROM order_tb ORDER BY id DESC";
                    $result=mysqli_query($conn,$sql);

                    $count=mysqli_num_rows($result);

                    $sn=1;

                    if($result==true){
                        //Data available
                        while($row=mysqli_fetch_assoc($result)){
                            $id=$row['id'];
                            $food=$row['food'];
                            $price=$row['price'];
                            $qty=$row['qty'];
                            $total=$row['total']; 
                            $order_date=$row['order_date']; 
                            $status=$row['status'];
                            $customer_name=$row['customer_name'];
                            $customer_contact=$row['customer_contact'];
                            $customer_email=$row['customer_email'];
                            $customer_address=$row['customer_address'];


                            ?>

                            <tr>
                                <td><?php echo $sn++;?></td>
                                <td><?php echo $food;?></td>
                                <td><?php echo $price;?></td>
                                <td class="text-center"><?php echo $qty;?></td>
                                <td><?php echo $total;?></td>
                                <td><?php echo $order_date;?></td>

                                <td>
                                    <?php 
                                        if($status=="Ordered"){
                                            echo "<label>$status</label>";
                                        }elseif($status=="On Delivery"){
                                            echo "<label style='color: orange;'>$status</label>";
                                        }elseif($status=="Delivered"){
                                            echo "<label style='color: green;'>$status</label>";
                                        }elseif($status=="Cancelled"){
                                            echo "<label style='color: red;'>$status</label>";
                                        }
                                    ?>
                                </td>
                                
                                <td><?php echo $customer_name;?></td>
                                <td><?php echo $customer_contact;?></td>
                                <td><?php echo $customer_email;?></td>
                                <td><?php echo $customer_address;?></td>
                                <td><a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a></td>
                            </tr>

                            <?php
                        }
                    }else{
                        //No data available
                        //Display the message inside table
                        ?>
                        
                        <tr>
                            <td colspan="6"><div class="error">No Oder Placed.</div></td>
                        </tr>

                        <?php
                    }
            
                ?>

            </table>

        
        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php') ?>