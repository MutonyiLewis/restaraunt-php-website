<?php include 'partials/menu.php';?>
<div class="main-content">
	<div class="wrapper">
		<h1>change password</h1>
		<br><br>

		<?php 
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
		}
		

		?>

		<form action="" method="POST">

			<table class="tbl-30">
				<tr>
					<td>
						Old password
					</td>
					<td>
						<input type="password" name="old_password" placeholder="old password">
					</td>
				</tr>
				<tr>
					<td>New password</td>
					<td>
						<input type="password" name="new_password" placeholder="new password">
					</td>
				</tr>
				<tr>
					<td>
						confirm password
					</td>
					<td>
						<input type="password" name="confirm_password" placeholder="confirm password">
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id?>">
						<input class="btn-primary" type="submit" name="submit" value="change password">
					</td>
				</tr>
			</table>
			
		</form>
		
	</div>
	
</div>
<?php
//chck if btn is clicjke

if (isset($_POST['submit'])) {
	// get data from form

	$id = $_POST['id'];
	$old_password = md5($_POST['old_password']);
	$new_password = md5($_POST['new_password']);
	$confrim_password = md5($_POST['confirm_password']);


	//get data from form

	$sql = "SELECT * FROM admin WHERE id='$id' AND  password='$old_password'";
	//excecute
	$res = mysqli_query($conn, $sql);

	if ($res==true) {
		// check data
		$count=mysqli_num_rows($res);

		if ($count==1) {
			// user exists
			//echo "user found";
			//check if passwordsmatch
			if ($new_password == $confrim_password) {
				echo "passwords match";
				//update password

				$sql2 = "UPDATE admin SET password='$new_password' WHERE id=$id";

				//ExcEcUTE
				$res2 = mysqli_query($conn, $sql2);

				//check excecution
				if ($res2==true) {
					// success message
					$_SESSION['passwords-change'] = "password changed successfully";  
			        header('location:'.SITEURL.'admin/manageadmin.php');
				}else{
					//display error message
					$_SESSION['passwords-change'] = "failed to change";  
			        header('location:'.SITEURL.'admin/manageadmin.php');
				}
			}else{
				$_SESSION['passwords-dont-match'] = "passwords dont match";  
		     	header('location:'.SITEURL.'admin/manageadmin.php');
			}
		}else{
			$_SESSION['user-not-found'] = "user not found";  
			header('location:'.SITEURL.'admin/manageadmin.php');
		}

	}

	//validate old pass == id 

	//check if new and confirm are same

	//change password
}
?>
<?php include 'partials/footer.php';?>