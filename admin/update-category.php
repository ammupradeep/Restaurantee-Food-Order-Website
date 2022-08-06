<?php include('partials/menu.php') ?>

<div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br><br>
            <?php
        //Validate category

            //Check if id is set or not
            if(isset($_GET['id'])){
                //Get id and all other datas
                // echo "Getting data";
                $id=$_GET['id'];
                //Sql for get all other data
                $sql="SELECT * FROM category_tb WHERE id=$id";
                
                $result=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($result);

                if($count==1){
                    //Get all the data
                    $row=mysqli_fetch_assoc($result);
                    $title=$row['title'];
                    $current_image=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                }else{
                    //Redirect with error msg
                    $_SESSION['no-category-found'] ="<div class='error'>Category not found</div>";
                    header("Location:".SITEURL.'admin/manage-category.php');
                    
                }
            }else{
                //Redirect to manage category
                header("Location:".SITEURL.'admin/manage-category.php');
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
                        <td>Image</td>
                        <td>
                            <?php
                             
                            if($current_image != ""){
                                //Display image
                                ?>
                                <img src="<?php echo SITEURL;?>images/categories/<?php echo $current_image;?>" width="150px">
                                <?php

                            }else{
                                echo "<div class='error'>Image not added</div>";
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
                            <input <?php if($active=="No"){echo "checked";}?>   type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image?>">
                            <button name="submit" class="btn-secondary">Update Category</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</div>

<?php
if(isset($_POST['submit'])){
    // echo "Clicked";
    //Get values from form
    $id=$_POST['id'];
    $title=$_POST['title'];
    $current_image=$_POST['current_image'];
    // $new_image=$_POST['new_image'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];

    //Update new image
    //Check whether image is selected or not
    if(isset($_FILES['image']['name'])){
        //get image detailes
        $image_name=$_FILES['image']['name'];

        //Check image is available or not
        if($image_name!=""){
            //Image available
            // A   Upload new image
            //Auto  rename the image
            //Get extension of the image(jpg,png,gif,jfif etc) ag: food.jpg
            $ext=end(explode('.', $image_name)); //explode will split the name from '.' and end() will take the last portion

            //Rename the image
            $image_name="Food_category_".rand(000,999).'.'.$ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/categories/".$image_name;

            //2.Finally upload the image
            $upload =move_uploaded_file($source_path,$destination_path);

            //Check whether the image uploaded or not
            //If not then we will stop the process and redirect with error msg
            if($upload==false){
                $_SESSION['upload']="<div class='error'>Failed to upload Image</div>";
                //Redirect to add category page
                header("Location:".SITEURL.'admin/manage-category.php');
                //Stop the process
                die();
            } 
            //B   Remove current image if available
            if($current_image!=""){
                $path="../images/categories/".$current_image;

                //Remove image
                $remove=unlink($path);
                //If failed to remove
                if($remove==false){
                    //Set session and redirect and stop the process
                    $_SESSION['failed-remove'] ="<div class='error'>Failed to remove Current Image</div>";
                    header("Location:".SITEURL.'admin/manage-category.php');
                    die();
                }
            }
        }else{
            $image_name=$current_image;    
        }
    }else{
        $image_name=$current_image;
    }

    //Update in db
    $sql2="UPDATE category_tb SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        WHERE id= $id";
    
    $result2=mysqli_query($conn,$sql2);

    //Redirect with messege
    if($result2==true){
        //Updated
        $_SESSION['update'] ="<div class='success'>Category Updated Successfully</div>";
        header("Location:".SITEURL.'admin/manage-category.php');
    }else{
        //Failed to update
        $_SESSION['update'] ="<div class='error'>Failed to Update Category</div>";
        header("Location:".SITEURL.'admin/manage-category.php');
    }


}

?>

<?php include('partials/footer.php') ?>