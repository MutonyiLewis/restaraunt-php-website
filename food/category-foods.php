<?php include 'partials_front/menu.php';?>

<?php 
//check if id is passed
if (isset($_GET['category_id'])) {
    // category id is set get the id
    $category_id = $_GET['category_id'];

    //get category title
    $sql = "SELECT title FROM category WHERE id='$category_id'";

    //execute
    $res = mysqli_query($conn, $sql);

    //get value from db
    $row = mysqli_fetch_assoc($res);

    //get the title
    $category_title = $row['title'];
}else{
    //not passed 
    //redirect to home
    header('location:'.SITEURL.'index.php');
}

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
            //create sqql to get foods from category
            $sql2 = "SELECT * FROM food WHERE category_id='$category_id'";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);

            //count rows
            $count2 = mysqli_num_rows($res2);

            //check if food is available
            if ($count2>0) {
                // available
                while ($row2=mysqli_fetch_assoc($res2)) {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['imagepathname'];

                    ?>

                    <div class="food-menu-box">
                         <div class="food-menu-img">

                            <?php
                            if ($image_name=="") {
                                // not available
                                echo "<div class='error'>image not available</div>";
                            }else{
                                //available
                                ?>

                                <img src="<?php echo SITEURL?>images/food/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">

                                <?php
                            }

                            ?>
                              
                         </div>

                    <div class="food-menu-desc">
                         <h4><?php echo $title;?></h4>
                         <p class="food-price"><?php echo $price;?></p>
                         <p class="food-detail">
                              <?php echo $description;?>
                         </p>
                    <br>

                        <a href="<?php echo SITEURL?>/order.php" class="btn btn-primary">Order Now</a>
                    </div>
                    </div>

                    <?php 
                }
            }else{
                //not available
                echo "<div class='error'>food isnt available</div>";
            }


            ?>



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include 'partials_front/footer.php';?>