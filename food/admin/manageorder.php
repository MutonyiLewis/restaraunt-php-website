<?php include ('partials/menu.php');?>

<div class="main-content">
	<div class="wrapper">
	   <h1>Manage Order</h1>
	   <br><br>

	   <?php 
	   if (isset($_SESSION['update'])) {
	   	   echo $_SESSION['update'];
	   	   unset($_SESSION['update']);
	   }

	   ?>
	   <br>

		<table class="tbl-full">
			<tr>
				<th>S.N</th>
				<th>Food</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
				<th>order_date</th>
				<th>Status</th>
				<th>Customer name</th>
				<th>Customer contact</th>
				<th>Customer email</th>
				<th>Address</th>
				<th>Action</th>
			</tr>

		 <?php 
		 //.get data
		 $sql = "SELECT * FROM order_tbl ORDER BY id DESC";

		 //execute
		 $res = mysqli_query($conn, $sql);

		 if ($res == true) {
		 	$count = mysqli_num_rows($res);
		 	$sn = 1;

		 	if ($count>0) {
		 		// kuna data dat a atta dat a atdatta a
		 		while ($row=mysqli_fetch_assoc($res)) {
		 			
		 			$id = $row['id'];
		 			$food = $row['food'];
		 			$price = $row['price'];
		 			$quantity = $row['quantity'];
		 			$total = $row['total'];
		 			$orderdate = $row['orderdate'];


		 			$status = $row['status'];
		 			$customername = $row['customername'];
		 			$customercontact = $row['customercontact'];
		 			$customeremail = $row['customeremail'];
		 			$customeraddress = $row['customeraddress'];

		 			?>
		 			<tr>
			        	<td><?php echo $sn++; ?></td>
				        <td><?php echo $food;?></td>
				        <td><?php echo $price;?></td>
				        <td><?php echo $quantity;?></td>
				        <td><?php echo $total;?></td>
				        <td><?php echo $orderdate;?></td>

				        <td>
				        	<?php 

				        	if ($status=="ordered") {
				        		echo "<label style='color: black;'>$status</label>";
				        	}elseif ($status=="on_delivery") {
				        		echo "<label style='color: orange;'>$status</label>";
				        	}elseif ($status=="delivered") {
				        		echo "<label style='color: lightgreen;'>$status<?label>";
				        	}else{

				             echo "<div style='color: red;'>$status</div>";
				        	}
				            ?>
				        	
				        </td>

				        <td><?php echo $customername;?></td>
				        <td><?php echo $customercontact;?></td>
				        <td><?php echo $customeremail;?></td>
				        <td><?php echo $customeraddress;?></td>
				        <td>
					        <a href="<?php echo SITEURL;?>admin/updateorder.php?id=<?php echo $id;?>" class="btn-secondary">Update Order</a>
				        </td>
			        </tr>

		 			<?php
		 		}
		 	}else{
		 		echo "no  data in db";
		 	}
		 }


		 ?>

			

			
		</table>

    </div>
</div>

<?php include ('partials/footer.php');?>
