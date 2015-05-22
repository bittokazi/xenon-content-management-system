<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
upload_addon_int();
if (isset($_GET['action']) && $_GET['action']=="upload" && !$_GET['action']=="" ) {
upload_addon($_FILES['file']['name']);
echo " success ";
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>