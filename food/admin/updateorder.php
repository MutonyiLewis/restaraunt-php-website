<?php include 'partials/menu.php';?>

<div class="main-content">
	<div class="wrapper">
		<h2>Update Order</h2>
		<br><br>

		<?php 

		//check whether id is set or nort
		if (isset($_GET['id'])) {
			// get id

			$id = $_GET['id'];

			//sql
			$sql = "SELECT * FROM order_tbl WHERE id='$id'";

			//execute
			$res = mysqli_query($conn, $sql);

			//count rows
			$count = mysqli_num_rows($res);

			if ($count==1) {
				// availabe
				$row=mysqli_fetch_assoc($res);

				$food = $row['food'];
				$price = $row['price'];
				$qty = $row['quantity'];
				$status = $row['status'];
				$customername = $row['customername'];
				$customercontact = $row['customercontact'];
				$customeremail = $row['customeremail'];
				$customeraddress = $row['customeraddress'];

			}else{
				header('location:'.SITEURL.'admin/manageorder.php');
			}
		}else{
			//redirect
			header('location:'.SITEURL.'admin/manageorder.php');
		}

		?>

		<form action="" method="POST" >
			
			<table class="tbl-30">
				<tr>
					<td>Food name</td>
					<td><strong><?php echo $food;?></strong></td>
				</tr>
				<tr>
					<td>Price</td>
					<td><b><?php echo $price?></b></td>
				</tr>
				<tr>
					<td>Quantity</td>
					<td>
						<input type="number" name="qty" value="<?php echo $qty;?>">
					</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>
						<select name="status">
							<option <?php if($status=="ordered"){echo "selected";}?> value="ordered">ordered</option>
							<option <?php if($status=="on_delivery"){echo "selected";}?> value="on_delivery">on_delivery</option>
							<option <?php if($status=="delivered"){echo "selected";}?> value="delivered">delivered</option>
							<option <?php if($status=="cancelled"){echo "selected";}?> value="cancelled">cancelled</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Customer name</td>
					<td>
						<input type="text" name="customername" value="<?php echo $customername;?>">
					</td>
				</tr>
				<tr>
					<td>Customer contact</td>
					<td>
						<input type="text" name="customercontact" value="<?php echo $customercontact;?>">
					</td>
				</tr>
				<tr>
					<td>Customer email</td>
					<td>
						<input type="text" name="customeremail" value="<?php echo $customeremail;?>">
					</td>
				</tr>
				<tr>
					<td>Customer address</td>
					<td>
						<textarea name="customeraddress" cols="30" rows="5"><?php echo $customeraddress;?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<input type="hidden" name="price" value="<?php echo $price;?>">
						<input type="submit" name="submit" value="update order" class="btn-primary">
					</td>
				</tr>
			</table>
		</form>

		<?php 
		//check if clicked
		if (isset($_POST['submit'])) {
			// echo "clicked";
			//get values from form
			$id=$_POST['id'];
			$price=$_POST['price'];
			$qty = $_POST['qty'];
			$total = $price * $qty;
			$status = $_POST['status'];

			$customername = $_POST['customername'];
			$customercontact = $_POST['customercontact'];
			$customeremail = $_POST['customeremail'];
			$customeraddress = $_POST['customeraddress'];


			//update values
			$sql2 = "UPDATE order_tbl SET
			quantity = $qty,
			total = $total,
			status = '$status',
			customername = '$customername',
			customercontact = '$customercontact',
			customeremail = '$customeremail',
			customeraddress = '$customeraddress'
            WHERE id=$id
			";

			// echo $sql2; die();

			//execute query
			$res2 = mysqli_query($conn, $sql2);

			//redirect to manage order
			if ($res2==true) {
				// updayed
				$_SESSION['update'] = "<div class='success'>updated successfully</div>";
				header('location:'.SITEURL.'admin/manageorder.php');
			}else{
				//failed
				$_SESSION['update'] = "<div class='error'>not updated</div>";
				header('location:'.SITEURL.'admin/manageorder.php');

			}

		}


		?>
		
	</div>
	
</div>

<?php include 'partials/footer.php';?>