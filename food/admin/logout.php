<?php
//include constants
include('../dbconnect/db.php');
//destroy the session 

session_destroy();//unsets user session


// redirect to login page
header('../admin/login.php');
?>