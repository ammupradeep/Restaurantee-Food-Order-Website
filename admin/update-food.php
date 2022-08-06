<?php include('partials/menu.php') ?>

<div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
            <br><br>
            
            <?php
            //Validate Food
            if(isset($_GET['id'])){
                //Get  id
                $id=$_GET['id'];

                //Query to get data from db
                $sql="SELECT * FROM food_tb WHERE id=$id";
                $result=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($result);

                if($count==1){
                    //Data found
                    $row=mysqli_fetch_assoc($result);
                    $title=$row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $current_image=$row['image_name'];
                    $current_category=$row['category_id'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                    
                }else{
                    // No data
                    //Redirect with error msg
                    $_SESSION['no-food-found'] ="<div class='error'>Food not found</div>";
                    header("Location:".SITEURL.'admin/manage-category.php');
                }
            }
            
            ?>

            <br><br>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Description</td>
                        <td>
                            <textarea name="description" cols="20" rows="2"><?php echo $description?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price</td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Image</td>
                        <td>
                            <?php
                            if($current_image==''){
                                //Image not available
                                echo "<div class='error'>Image Not Available</div>";
                            }else{
                                //Image Available
                                ?>

                                <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="150px">
                                <?php
                            }
                            
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="category">

                                <?php
                                //Get active categories
                                $sql2="SELECT * FROM category_tb WHERE active='Yes'";
                                $result2=mysqli_query($conn,$sql2);

                                //Count Rows
                                $count=mysqli_num_rows($result2);
                                if($count>0){
                                    //Category Available
                                    $category_id=$row['id'];
                                    $category_title=$row['title'];

                                    ?>
                                    
                                    <option value="<?php echo $category_id;?>"><?php echo $category_title?></option>
                                    <?php

                                }else{
                                    //Category not available
                                    echo "<option value='0'>Category Not Available</option>;?>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured</td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active</td>
                        <td>
                            <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image?>">
                            <button name="submit" class="btn-secondary">Update Food</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</div>

<?php
if(isset($_POST['submit'])){
    //1\. Get deteails from the form 
    $id=$_POST['id'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $current_image=$_POST['current_image'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];


    //2. Upload image if selected
    if(isset($_FILES['image']['name'])){
        //Btn clicked
        $image_name=$_FILES['image']['name'];

        if($image_name!=""){
            $ext=end(explode('.', $image_name)); //explode will split the name from '.' and end() will take the last portion

            //Rename the image
            $image_name="Food_category_".rand(000,999).'.'.$ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/".$image_name;

            //2.Finally upload the image
            $upload =move_uploaded_file($source_path,$destination_path);


            //Check whether the image uploaded or not
            //If not then we will stop the process and redirect with error msg
            if($upload==false){
                $_SESSION['upload']="<div class='error'>Failed to upload Image</div>";
                //Redirect to add category page
                header("Location:".SITEURL.'admin/add-food.php');
                //Stop the process
                die();
            } 
            //3.Remove current image if new img is uploaded and curr image exists
            //   Remove current image if available
            if($current_image!=""){
                $path="../images/food/".$current_image;

                //Remove image
                $remove=unlink($path);
                //If failed to remove
                if($remove==false){
                    //Set session and redirect and stop the process
                    die(mysqli_error());
                    $_SESSION['failed-remove'] ="<div class='error'>Failed to remove Current Image</div>";
                    header("Location:".SITEURL.'admin/manage-food.php');
                    die();
                }
            }
        }else{
            $image_name=$current_image;
        }
    }else{
        $image_name=$current_image;
    }
    
    //4.Update foofd in db
    $sql3="UPDATE food_tb SET
        title='$title',
        description='$description',
        price=$price,
        image_name='$image_name',
        category_id=$category_id,
        featured='$featured',
        active='$active'
        WHERE id=$id";
    $result3=mysqli_query($conn,$sql3);

    //5.Redirect with message
    if($result3==true){
        //Updation done
        $_SESSION['update'] ="<div class='success'>Food Updated Successfully</div>";
        header("Location:".SITEURL.'admin/manage-food.php');
    }else{
        //Failed
        $_SESSION['update'] ="<div class='error'>Failed to update Food</div>";
        header("Location:".SITEURL.'admin/manage-food.php');

    }
}
?>

<?php include('partials/footer.php') ?>
