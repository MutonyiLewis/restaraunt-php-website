<?php include 'partials_front/menu.php';?>

<?php 
if (isset($_SESSION['login'])) {
        // cod
        echo $_SESSION['login'];
        
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 

    if (isset($_SESSION['ordered'])) {
        echo $_SESSION['ordered'];
        unset($_SESSION['ordered']);
    }
    if (isset($_SESSION['login'])) {
        // cod
        echo $_SESSION['login'];
        
    }
    

    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <br><br>

            <?php 
            //create query t display categories
            $sql = "SELECT * FROM category WHERE active='yes' AND featured='yes' LIMIT 3";

            //execute the query
            $res = mysqli_query($conn, $sql);
            
            //check category availability
            $count = mysqli_num_rows($res);
            if ($count>0) {
                //category available
                while ($row=mysqli_fetch_assoc($res)) {
                    // get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];

                    ?>
                     <a href="<?php SITEURL?>category-foods.php?category_id=<?php echo $id;?>">
                     <div class="box-3 float-container">
                        <?php 
                        if ($image_name=="") {
                            // display message
                            echo "image not available";
                        }else{
                            //image available
                            ?>
                            <img src="<?php echo SITEURL?>images/category/<?php echo $image_name?>" alt="<?php echo $title;?>" class="img-responsive img-curve">

                            <?php
                        }
                        //display message

                        ?>
                      

                        <h3 class="float-text text-blue"><?php echo $title;?></h3>
                    </div>
                    </a>

                    <?php
                }
            }else{
                //no categories
                echo "<div class='error'>no categories available</div>";
            }

            ?>

           
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            //getting food from db
            //query
            $sql2 = "SELECT * FROM food WHERE active='yes' AND featured='yes' LIMIT 6";

            //execute
            $res2 = mysqli_query($conn, $sql2);

            //count rows
            $count2 = mysqli_num_rows($res2);

            //check availabiluty
            if ($count2>0) {
                // available
                while ($row=mysqli_fetch_assoc($res2)) {
                    // //get all value 
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['imagepathname'];
                    ?>
                    <div class="food-menu-box">
                      <div class="food-menu-img">
                        <?php
                        //check imge
                        if ($image_name=="") {
                            // not
                            echo "image not available";
                        }else{
                            ?>
                             <img src="<?php echo SITEURL?>images/food/<?php echo $image_name?>" alt="<?php echo $title;?>" class="img-responsive img-curve">

                            <?php
                        }

                        ?>
                       
                      </div>

                    <div class="food-menu-desc">
                      <h4><?php echo $title;?></h4>
                      <p class="food-price"><?php echo $price;?></p>
                      <p class="food-detail"><?php echo $description;?>
                      </p>
                    <br>

                      <a href="<?php echo SITEURL?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                    </div>
                    </div>


            

                    <?php
                    
                }
            }else{
                //not available
                echo "food not available";
            }

            ?>

            
               
            </div>


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="<?php SITEURL;?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include 'partials_front/footer.php';?>