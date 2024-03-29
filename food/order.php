<?php include 'partials_front/menu.php';?>

<?php

if (isset($_GET['food_id'])) {
    // get fooed id and details of selected food
    $food_id = $_GET['food_id'];


    //get the details of selected food
    $sql = "SELECT * FROM food WHERE id='$food_id'";

    //execute
    $res = mysqli_query($conn, $sql);

    //count rows
    $count = mysqli_num_rows($res);

    //check data vailable
    if ($count>0) {
        // we have data
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['imagepathname'];
    }else{
        //not available
        //redirect
        header('location'.SITEURL);
    }
}else{
    //redirect to home
    header('location:'.SITEURL.'index.php');
}

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php

                        //check if image is available
                        if ($image_name=="") {
                            // not available
                            echo "<div class='error'>image not available</div>";
                        }else{
                            //available
                            ?>

                            <img src="<?php SITEURL?>images/food/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">

                            <?php
                        }

                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>">
                        <p class="food-price"><?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full_name" placeholder="E.g. Lewis Mutonyi" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. o712435678" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@order.gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
            //check whether button iss clicked
            if (isset($_POST['submit'])) {
                // get all the data from form
                $food = $_POST['food'];
                $price = $_POST['price'];
                $quantity = $_POST['qty'];

                $total = $price * $quantity;

                $orderdate = date("Y-m-d h:i:sa");

                $status = "ordered";

                $customername = $_POST['full_name'];
                $customercontact = $_POST['contact'];
                $customeremail = $_POST['email'];
                $customeraddress = $_POST['address'];

                //save the order to db
                // sql

                $sql2 = "INSERT INTO order_tbl SET
                food = '$food',
                price = $price,
                quantity = $quantity,
                total = $total,
                orderdate = '$orderdate',
                status = '$status',
                customername = '$customername',
                customercontact = '$customercontact',
                customeremail = '$customeremail',
                customeraddress = '$customeraddress'
                ";

              //  echo $sql2; die();
               
                //execute query
                $result = mysqli_query($conn, $sql2);

                //check execution
                if ($result==true) {
                    // success
                    $_SESSION['ordered'] = "<div class='success'>order has been taken</div>";
                    header('location:'.SITEURL);
                }else{
                    //failed to save
                    $_SESSION['order_fail'] = "<div class='error'>order has not been taken</div>";
                    header('location:'.SITEURL);
                }




            }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include 'partials_front/footer.php';?>