<?php include 'partials_front/menu.php';?>

   
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



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Categories</h2>
            <?php
            //display all active categories
            //query
            $sql = "SELECT * FROM category WHERE active='yes'";

            //execute query
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);

            //check count
            if ($count>0) {
                 // categories available
                while ($row=mysqli_fetch_assoc($res)) {
                    // get value
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    <a href="<?php echo SITEURL?>category-foods.php?category_id=<?php echo $id;?>">
                    <div class="cats">
                        <?php 
                        if ($image_name=="") {
                            // image not available
                            echo "<div class='error'>image not available</div>";
                        }else{
                            //image available
                            ?>
                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve" width="10%" height="5%">

                            <?php
                        }

                        ?>
                       

                    <?php
                }
             }else{
                //not categories
                echo "<div class='error'>categories not available</div>";
             } 

            ?>

          </div>
      </a>
  </div>

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


   <?php include 'partials_front/footer.php';?>