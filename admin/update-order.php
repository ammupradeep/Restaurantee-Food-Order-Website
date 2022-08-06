<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <br><br>
        <?php
        
       
        if(isset($_GET['id'])){
             //gET ID FROM THE BTN CLICK
             $id=$_GET['id'];
            ////Get data from order_tb to display current data
            $sql="SELECT * FROM order_tb WHERE id=$id";
            $result=mysqli_query($conn,$sql);

            $count=mysqli_num_rows($result);

            if($count==1){
                //Data found
                $row=mysqli_fetch_assoc($result);

                $id=$row['id'];
                $food=$row['food'];
                $price=$row['price'];
                $qty=$row['qty'];
                $status=$row['status'];
                $customer_name=$row['customer_name'];
                $customer_contact=$row['customer_contact'];
                $customer_email=$row['customer_email'];
                $customer_address=$row['customer_address'];

            }else{
                //No data  found
                //Redirect with error msg
                $_SESSION['no-category-found'] ="<div class='error'>Category not found</div>";
                header("Location:".SITEURL.'admin/manage-category.php');
            }
        }else{
            //No data
            //Redirect to manage order
            header("Location:".SITEURL.'admin/manage-order.php');
        }
        
        
        ?>

        <br><br><br>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td>
                        <b><?php echo $food; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><b><?php echo $price; ?></b>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="On Delivery"){echo "selected";} ?>value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?>value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?>value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name</td>
                    <td><input type="text" name="full-name" value="<?php echo $customer_name; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Contact</td>
                    <td><input type="number" name="contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Email</td>
                    <td><input type="email" name="email" value="<?php echo $customer_email; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="address" cols="20" rows="5"><?php echo $customer_address; ?></textarea>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <button name="submit" class="btn-secondary">Update Order</button>
                    </td>
                </tr>
            </table>
        </form>

        <?php
        //cHECK WHETHER UPDATE BUTTON IS CLICKED OR NOT
        if(isset($_POST['submit'])){
            // echo "Clicked";
            //Get all values from form
            $id=$_POST['id'];
            $price=$_POST['price'];
            $qty=$_POST['qty'];

            $total= $price * $qty;

            $status=$_POST['status'];
            $customer_name=$_POST['full-name'];
            $customer_contact=$_POST['contact'];
            $customer_email=$_POST['email'];
            $customer_address=$_POST['address'];

            $sql2="UPDATE order_tb SET
                    qty=$qty,
                    total=$total,
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                    WHERE id=$id";
            

            // echo $sql2; 
            $result2=mysqli_query($conn,$sql2);

            if($result2==true){
                //Updated
                $_SESSION['update'] ="<div class='success'>Order Updated Successfully</div>";
                header("Location:".SITEURL.'admin/manage-order.php');
            }else{
                //Failed
                // echo mysqli_error($result2);
                $_SESSION['update'] ="<div class='error'>Failed to Update Order</div>";
                header("Location:".SITEURL.'admin/manage-order.php');
            }

        }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php')?>