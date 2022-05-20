<?php
//include constants
include('../config/constants.php');
//destroy the session 

session_destroy();//unsets user session


// redirect to login page
header('location: login.php');
?>