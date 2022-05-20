<?php include '../config/constants.php';?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
	<style type="text/css">
		body{
			background-image: url("../images/backgroundregister.jpg");
		}
		.login{
			background-color: sandybrown;
		}
	</style>
	<div class="login">
		<br><br>  
		<h1 class="text-center">login</h1><br><br>

		<?php
		if (isset($_SESSION['login'])) {
			echo $_SESSION['login'];

		}
		if (isset($_SESSION['no-login-message'])) {
			echo $_SESSION['no-login-message'];
		}

		?>
          <form action="" method="POST" class="text-center background">
          	<label for="username">Username:</label><br>
          	<input class="form-group" type="text" name="username" placeholder="enter username"><br><br>
          	<label for="password">Password:</label><br>
          	<input class="form-group" type="password" name="password" placeholder="enter Password"><br><br>

          	<input type="submit" name="submit" value="login" class="btn-primary">
          </form>
		<p class="text-center">Created by..<a href="">@lleewii</a></p>
	</div>

</body>
</html>

<?php 
//check if submit clicked
if (isset($_POST['submit'])) {
	// processs login
	//get data from form

    $username = $_POST['username'];
	$password = md5($_POST['password']); 

	//sql to check whether usernam and pass exist
	$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

	//execute query
	$res = mysqli_query($conn, $sql);

	// count rows to check if user exists or not 
	$count = mysqli_num_rows($res);

	if ($count==1) {
		// user available and login success
		$_SESSION['login'] = $username;
		$_SESSION['user'] = $username;
		//redirect to index page 
		header('location:'.SITEURL.'admin/');
	}else{
		//user not available
		$_SESSION['login'] = "username and pass dont match";
		//redirect to index page 
		header('location:'.SITEURL.'admin/login.php');
	}

}
?>