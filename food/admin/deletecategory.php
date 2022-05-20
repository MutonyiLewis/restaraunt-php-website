<?php 
include '../config/constants.php';

//getid of category to be deleted
$id = $_GET['id'];

//sql statement
$sql = "DELETE FROM category WHERE id='$id'";

//EXECUTE THE STATEMENT
$res = mysqli_query($conn, $sql);

//check query execution
if ($res==true) {
	$_SESSION['deleted'] = "<div class='success'>category deleted successfully</div>";
	header('location:'.SITEURL.'admin/managecategory.php');
}else{
	$_SESSION['deleted'] = "<div class='eeror'>failed to delete category</div>";
	header('location:'.SITEURL.'admin/managecategory.php');
}
?>