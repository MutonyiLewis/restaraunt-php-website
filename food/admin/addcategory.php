<?php include 'partials/menu.php';?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add category</h1><br><br>

		<?php 
		if (isset($_SESSION['add'])) {
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
		if (isset($_SESSION['upload'])) {
			echo $_SESSION['upload'];
			unset($_SESSION['upload']);
		}

		?>
		<br><br>

		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Title</td>
					<td>
						<input type="text" name="title" placeholder="category title">
					</td>
				</tr>
				<tr>
					<td>
						Select image
					</td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>
				<tr>
					<td>Featured</td>
					<td>
						<input type="radio" name="featured" placeholder="" value="yes">Yes
						<input type="radio" name="featured" placeholder="" value="no">No
					</td>
				</tr>
				<tr>
					<td>Active</td>
					<td>
						<input type="radio" name="active" value="yes">Yes
						<input type="radio" name="active" value="no">No
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="add category" class="btn-primary">
					</td>
				</tr>
			</table>
		</form>

		<?php 
		  //check if btn is clicked
		if (isset($_POST['submit'])) {
			
			//get values from the form
			$title = $_POST['title'];

			// for radio input ,...check if selected
			if (isset($_POST['featured'])) {
				// get the value from the form
				$featured = $_POST['featured'];
			}else{
				//set defaukt value
				$featured = "no";
			}
			if (isset($_POST['active'])) {
				// value from the form
				$active = $_POST['active'];
			}else{
				$active = "no";
			}


			//checck whether image is selected
			/*print_r($_FILES['image']);

			die();*/

			if (isset($_FILES['image']['name'])) {
				// upload image
				//image name, source path, destination path

				$image_name = $_FILES['image']['name'];
              if ($image_name != "") {
              	// code...
              
				//auto rename image
				$ext = end(explode('.', $image_name));

				//rename the image
				$image_name = "food_category_".rand(000, 999).'.'.$ext;

				$source_path = $_FILES['image']['tmp_name'];

				$destination_path = "../images/category/".$image_name;

				//upload image
				$upload = move_uploaded_file($source_path, $destination_path);

				//check if image is uploaded
				if ($upload==false) {
					// set message
					$_SESSION['upload'] = "<div class='error'>failed to upload image</div> ";

					//redirect to add category
					header('location:'.SITEURL.'admin/addcategory.php');

					//stop the process
					die();


				}
			}
			}else{
				//dont upload image
				$image_name = "";
			}



			// sql code to insert the category to db
			$sql = "INSERT INTO category SET 
			title='$title',
			image_name='$image_name',
			featured='$featured',
			active='$active'
			";

			//execute sql n save
			$res = mysqli_query($conn, $sql);

			//check if query is executed n data saved
			if ($res==true) {
				// query successful

				$_SESSION['add'] = "<div class='success'>Category added successfully</div>";
				header('location:'.SITEURL.'admin/managecategory.php');

			}else{
				//failed to add category

				$_SESSION['add'] = "<div class='error'>Failed to add category</div>";
				header('location:'.SITEURL.'admin/addcategory.php');
			}
		}

		?>
	</div>
</div>
<?php include 'partials/footer.php';?>