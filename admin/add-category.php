<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>


        <br><br>
        <!-- All category starts here -->
        <form action="" method="post" enctype="multipart/form-data"> <!--enctype add image to db-->
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" placeholder="Category title"></td>
                </tr>

                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
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
                        <button name="submit" class="btn-secondary">Add Category</button>
                    </td>
                </tr>
            </table>
        </form>
        <!-- All category ends here -->
    </div>
</div>

<?php
//To check whether the button is clicked
if(isset($_POST['submit'])){
    // 1.Get value from form
    $title=$_POST['title'];
    
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

    //Check whether the image is selected or not and  set value for image name
    // print_r($_FILES['image']);

    // die();//break the code here/

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
            $image_name="Food_category_".rand(000,999).'.'.$ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/categories/".$image_name;

            //2.Finally upload the image
            $upoad =move_uploaded_file($source_path,$destination_path);

            //Check whether the image uploaded or not
            //If not then we will stop the process and redirect with error msg
            if($upoad==false){
                $_SESSION['upload']="<div class='error'>Failed to upload Image</div>";
                //Redirect to add category page
                header("Location:".SITEURL.'admin/add-category.php');
                //Stop the process
                die();
            } 
        }
    }else{
        //Don't upload image and set the image name valur as blank
        $image_name="";
    }


    //2. Sql query to insert value into category
    $sql="INSERT INTO category_tb SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'";
    
    //Execute
    $result=mysqli_query($conn,$sql);

    if($result==true){
        //Query executed and category added
        $_SESSION['add'] ="<div class='success'>Category Added Successfully</div>";
        //Redirect to manage-category page
        header("Location:".SITEURL.'admin/manage-category.php');
    }else{
        //Failed to add category
        $_SESSION['add'] ="<div class='error'>Failed to add Category</div>";
        //Redirect to manage-category page
        header("Location:".SITEURL.'admin/manage-category.php');
    }
}
?>

<?php include('partials/footer.php');?>
