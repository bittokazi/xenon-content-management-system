<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
if  ( user_roll() == "administrator" ) {
get_themepage($_GET['theme']);
global $themefile;
echo $themefile;
// initializes footer
include('footer.php');
}
else {
header("Location: index.php");
}
} else {
  header("Location: index.php");
}
ob_flush();
?>