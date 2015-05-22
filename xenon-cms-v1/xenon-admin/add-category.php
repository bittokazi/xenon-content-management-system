<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
add_category_content();
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>