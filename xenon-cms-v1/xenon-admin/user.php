<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
if ( 1==2 ) {
}
else {
echo'<h2>'; admin_title(); echo'</h2>';
userlist();
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>