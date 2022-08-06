<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <!-- All category ends here -->
        <form action="" method="post" enctype="multipart/form-data"> <!--enctype add image to db-->
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" placeholder="Food title"></td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="20" rows="2" placeholder="Description of Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><input type="number" name="price"></td>
                </tr>

                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">
                            <?php
                            //Display categories from database
                            //1.Create sql to get data from db
                            $sql="SELECT * FROM category_tb WHERE active='Yes'";
                            $result=mysqli_query($conn,$sql);

                            //Count rows
                            $count=mysqli_num_rows($result);

                            if($count  >0){
                                //Have categories
                                while($row=mysqli_fetch_assoc($result)){
                                    //get deteails of categories
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    ?>

                                    <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                    
                                    <?php

                                }
                            }else{
                                //Do not have category
                                ?>
                                <option value="0">No Category found</option>
                                <?php

                            }

                            //2.Display in the dropdown
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td><input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td><input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <br>
                <tr>
                    <td colspan="2">
                        <button name="submit" class="btn-secondary">Add Food</button>
                    </td>
                </tr>
            </table>
        </form>
        <!-- All category ends here -->

    </div>
</div>

<?php
if(isset($_POST['submit'])){
    //Get data from form
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category=$_POST['category'];

    //For radio input check wether the button is selected or not
    if(isset($_POST['featured'])){
        //Get value from form
        $featured = $_POST['featured'];

    }else{
        //Set default value;
        $featured="No";
    }

    if(isset($_POST['active'])){
        //Get value from form
        $active=$_POST['active'];
    }else{
        //Default value
        $active="No";
    }

    //2.Upload image if selected
    //Check whether the image is selected or not and  set value for image name

    if(isset($_FILES['image']['name'])){
        //upload the image
        //1.Image name and src path and destination path are needed
        $image_name=$_FILES['image']['name'];

        //Upload image only if image is selected
        if($image_name != ""){
            //Auto  rename the image
            //Get extension of the image(jpg,png,gif,jfif etc) ag: food.jpg
            $ext=end(explode('.', $image_name)); //explode will split the name from '.' and end() will take the last portion

            //Rename the image
            $image_name="Food_".rand(000,999).'.'.$ext;

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
        }
    }else{
        //Don't upload image and set the image name value as blank
        $image_name="";
    }

    //3.Insert into database
    $sql2="INSERT INTO food_tb SET
            title='$title',
            description ='$description',
            price=$price,
            image_name='$image_name',
            category_id=$category,
            featured='$featured',
            active='$active'";
    $result2=mysqli_query($conn,$sql2);

    //4.Redirect with msg
    if($result2==true){
        //Query executed and category added
        $_SESSION['add'] ="<div class='success'>Food Added Successfully</div>";
        //Redirect to manage-category page
        header("Location:".SITEURL.'admin/manage-food.php');
    }else{
        //Failed to add category
        $_SESSION['add'] ="<div class='error'>Failed to add Food</div>";
        //Redirect to manage-category page
        header("Location:".SITEURL.'admin/manage-food.php');
    }

}

?>



<?php include('partials/footer.php');?>