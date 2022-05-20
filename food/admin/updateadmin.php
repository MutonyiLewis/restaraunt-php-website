<?php
include 'partials/menu.php';?>
<div class="main-content">
	<div class="wrapper">
		<h1>Update admkin</h1>
		<br><br>

		<?php
		//get id of admin
		$id = $_GET['id'];

		//create update query
		$sql="SELECT * FROM admin WHERE id='$id'";

		//excecute
		$res=mysqli_query($conn, $sql);

		//check query excecution
		if ($res==true) {
			// check if data is available
			$count = mysqli_num_rows($res);

			//check if theres data
			if ($count==1) {
				// fetch the details
				//echo "admin available";
				$row = mysqli_fetch_assoc($res);

				$full_name = $row['fullname'];
				$username  = $row['username'];
			}else{
				//redirect to maanage admin
				header('location:'.SITEURL.'admin/manageadmin.php');
			}
		}

		?>

		<form action="" method="POST">
			<table class="tbl-30">
				<tr>
					<td>Full name</td>
					<td><input type="text" name="full-name" value="<?php echo $full_name;?>"></td>
				</tr>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username" value="<?php echo $username;?>"></td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<input type="submit" name="submit" value="update password" class="btn-primary">
					
				   </td>
			</tr>
			</table>
			
		</form>
	</div>
	
	
</div>

<?php
//check if update button is clicked
if (isset($_POST['submit'])){

	//echo "button clicked";
	//get valuues from the form
	 $id = $_POST['id'];
	 $full_name = $_POST['full-name'];
	 $username = $_POST['username'];

	 //update sql
	 $sql = "UPDATE admin SET
	 fullname = '$full_name',
	 username = '$username' WHERE id='$id' 
	 ";

	 //excecute query
	 $res = mysqli_query($conn, $sql);

	 //check query success 
	 if ($res==true) {
	 	// admin updated
	 	$_SESSION['update'] = "admin updayed successfully";
	 	header('location:'.SITEURL.'admin/manageadmin.php');
	 }else{
	 	//failed
	 	// admin updated
	 	$_SESSION['update'] = "not updated";
	 	header('location:'.SITEURL.'admin/manageadmin.php');
	 }
}

 ?>


<?php include 'partials/footer.php';?>