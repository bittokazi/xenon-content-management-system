<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
list_theme_dir ();
if (isset($_GET['action']) && isset($_GET['registertheme']) && $_GET['action']=="activate" && $_GET['registertheme']!="" && $_GET['action']!="" ) {
activate_theme($_GET['registertheme']);
}
elseif (isset($_GET['action']) && isset($_GET['registertheme']) && $_GET['action']=="true" && $_GET['registertheme']!="" && $_GET['action']!="" ) {
echo " success ";
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>