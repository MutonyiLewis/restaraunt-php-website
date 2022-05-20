<?php include 'partials/menu.php';?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update category</h1>
		<br><br>

		<?php 
		//check if id is set
		if (isset($_GET['id'])) {
			// get id and other data

			$id=$_GET['id'];
			//create sql to get other data
			$sql = "SELECT * FROM category WHERE id=$id";

			//execute query
			$res = mysqli_query($conn, $sql);

			//count rows to check if theres data
			$count = mysqli_num_rows($res);

			if ($count==1) {
				// get its adata
				$row = mysqli_fetch_assoc($res);
				$title = $row['title'];
				$current_image = $row['image_name'];
				$featured = $row['featured'];
				$active = $row['active'];



			}else{
				//redirect to manage categoty
				$_SESSION['no-category'] = "<div class='error'>no such category</div>";
				header('location:'.SITEURL.'/admin/managecategory.php');
			}

		}else{
			//redirect to manage category
			header('location:'.SITEURL.'/admin/managecategory.php');
		}

		?>

        <form action="" method="POST" enctype="multipart/form-data">
		 <table class="tbl-30">
			<tr>
				<td>title</td>
				<td>
					<input type="text" name="title" value="<?php echo $title;?>">
				</td>
			</tr>
			<tr>
				<td>Current image</td>
				<td>
					<?php
					if ($current_image!= "") {
					 	// code... display image
					 	?>
					 	<img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image;?>" width="150px">

					 	<?php

					 }else{
					 	//display essage
					 	echo "<div class='error'>image wasnt added</div>";
					 }

					?>
				</td>
			</tr>
			<tr>
				<td>New image</td>
				<td>
					<input type="file" name="image">
				</td>
			</tr>
			<tr>
				<td>Fetaured</td>
				<td>
					<input <?php if($featured == "yes"){echo "checked";}?> type="radio" name="featured" value="yes">YES
					<input <?php if($featured == "no"){echo "checked";}?> type="radio" name="featured" value="no">No
				</td>
			</tr>
			<tr>
				<td>Active</td>
				<td>
					<input <?php if($active == "yes"){echo "checked";}?> type="radio" name="active" value="yes">Yes
					<input <?php if($active == "no"){echo "checked";}?> type="radio" name="active" value="no">No
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="current_image" value="<?php $current_image;?>">
					<input type="hidden" name="id" value="<? $id;?>">
				<input type="submit" name="submit" class="btn-secondary" value="update category">
			    </td>
			</tr>
		</table>
	</form>

	<?php

	//check if button is clicked
	if (isset($_POST['submit'])) {
	 	// clicked
	 	//get all values from form
	 	$id = $_POST['id'];
	 	$title = $_POST['title'];
	 	$current_image = $_POST['current_image'];
	 	$featured = $_POST['featured'];
	 	$active = $_POST['active'];

	 	//update new image if selected
	 	if (isset($_FILES['image']['name'])) {
	 		// get the image details
	 		$image_name = $_FILES['imaage']['name'];

	 		//check if image i savailable
	 		if ($image_name != "") {
	 			// image available
	 			//upload new image
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
					header('location:'.SITEURL.'admin/managecategory.php');

					//stop the process
					die();


				}
	 			//remove current image if available
	 			if ($current_image != "") {
	 				// code...
	 				$remove_path = "../images/category/".$current_image;
	 			    $remove = unlink($remove_path);

	 			//check if removed
	 			     if ($remove==false) {
	 				// failed to remove
	 				$_SESSION['failed-remove'] = "<div class='error'>failed to remove</div>";
	 				header('location:'.SITEURL.'admin/managecategory.php');
	 				die();
	 			}
	 			}
	 			
	 		}else{
	 			$image_name = $current_image;
	 		}
	 	}else{

	 		$image_name = $current_image;
	 	}


	 	//update db
	 	$sql2 = "UPDATE category SET
	 	title='$title',
	 	image_name='$image_name',
	 	featured='$featured',
	 	active='$active' WHERE id=$id
	 	";
	 	//EXECUTE QUERY
	 	$res2 = mysqli_query($conn, $sql2);


	 	//redirect
	 	//check query
	 	if ($res2==true) {
	 		// category updated
	 		$_SESSION['updated'] = "<div class='success'>updated</div>";
	 		header('location:'.SITEURL.'admin/managecategory.php');
	 	}else{
	 		//failed to update
	 		$_SESSION['updated'] = "<div class='error'>not updated</div>";
	 		header('location:'.SITEURL.'admin/managecategory.php');
	 	}


	 } 

	?>
		
	</div>
	
</div>

<?php include 'partials/footer.php';?>