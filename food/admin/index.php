<?php include 'partials/menu.php';?>
	<div class="main-content">
		<div class="wrapper">
		<h1>DASHBOARD</h1>
		<br><br>
		<?php
		   if (isset($_SESSION['login'])) {
			    echo $_SESSION['login'];
			    unset($_SESSION['login']);
			
		   }
		?>
		<br><br>

		<div class="col-4 text-center">

			<?php 
			$sql = "SELECT * FROM category";

			//execute
			$res = mysqli_query($conn, $sql);

			//count rows
			$count = mysqli_num_rows($res);

			?>
			<h1><?php echo $count;?></h1><br>
			Categories
		</div>

		<div class="col-4 text-center">
			<?php 
			$sql2 = "SELECT * FROM food";

			//execute
			$res2 = mysqli_query($conn, $sql2);

			//count rows
			$count2 = mysqli_num_rows($res2);

			?>
			<h1><?php echo $count2;?></h1><br>
			Food
		</div>

		<div class="col-4 text-center">
			<?php 
			$sql3 = "SELECT * FROM order_tbl";

			//execute
			$res3 = mysqli_query($conn, $sql3);

			//count rows
			$count3 = mysqli_num_rows($res3);

			?>
			<h1><?php echo $count;?></h1><br>
			Total orders
		</div>

		<div class="col-4 text-center">
			<?php

			//create sql
			//aggregate function
			$sql4 = "SELECT SUM(total) AS Total FROM order_tbl WHERE status='delivered'";

			//EXECUTE
			$res4 = mysqli_query($conn, $sql4);

			//get value
			$row4 = mysqli_fetch_assoc($res4);

			//get total rev
			$total_rev = $row4['Total'];

			?>
			<h1>Ksh.<?php echo $total_rev;?></h1><br>
			Earnings
		</div>

		<div class="clearfix"></div>
	    </div>
		
	</div>
	<?php include('partials/footer.php') ?>