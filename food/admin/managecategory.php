<?php include ('partials/menu.php');?>

<div class="main-content">
	<div class="wrapper">
	   <h1>Manage Category</h1>
	   <br><br>

	   <!--<?php 
		if (isset($_SESSION['add'])) {
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
		if (isset($_SESSION['deleted'])) {
			echo $_SESSION['deleted'];
			unset($_SESSION['deleted']);
		}
		if (isset($_SESSION['no-category'])) {
			echo $_SESSION['no-category'];
			unset($_SESSION['no-category']);
		}
		if (isset($_SESSION['updated'])) {
	        echo $_SESSION['updated'];
	        unset($_SESSION['updated']);
		}
		if (isset($_SESSION['upload'])) {
			echo $_SESSION['upload'];
			unset($_SESSION['upload']);
		}

		?>-->
		<br><br>


		<a href="<?php echo SITEURL;?>admin/addcategory.php" class="btn-primary">Add Category</a>
		<br><br>

		<table class="tbl-full">
			<tr>
				<th>S.N</th>
				<th>title</th>
				<th>Image</th>
				<th>Featured</th>
				<th>Active</th>
				<th>Actions </th>
			</tr>
			<?php

			$sql = "SELECT * FROM category";

			//execute query
			$res = mysqli_query($conn, $sql);

			//count roews
			$count = mysqli_num_rows($res);

			$sn=1;

			//check if theres data
			if ($count>0) {
			 	//theres data
			 	//get data and display
			 	while ($row=mysqli_fetch_assoc($res)) {
			 		$id = $row['id'];
			 		$title = $row['title'];
			 		$image_name = $row['image_name'];
			 		$featured = $row['featured'];
			 		$active = $row['active'];

			 		?>
			 		<tr>
			        	<td><?php echo $sn++;?></td>
				        <td><?php echo $title;?></td>
				        <td>

				        	<?php
				        	//check if image name i available
				        	if ($image_name!="") {
				        		// display image
				        		?>
				        		<img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width="100px">

				        		<?php
				        	}else{
				        		echo "<div class='error'>image not available</div>";
				        	}

				        	?>
				        		
				        </td>
				        <td><?php echo $featured;?></td>
				        <td><?php echo $active;?></td>
				        <td>
					        <a href="<?php echo SITEURL;?>admin/updatecategory.php?id=<?php echo $id;?>" class="btn-secondary">Update category</a>
					        <a href="<?php echo SITEURL;?>admin/deletecategory.php?id=<?php echo $id;?>" class="btn-danger">Delete category</a>
				        </td>
			        </tr>

			 		<?php
			 	}
			 }else{
			 	//no data
			 	//display message inside the table
			 	?>
			 	<tr>
			 		<td colspan="6"><div class="error">No category added</div></td>
			 	</tr>

			 	<?php

			 } 

			?>

			
		</table>

    </div>
</div>

<?php include ('partials/footer.php');?>
