<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
if (isset($_GET['action']) && isset($_GET['menu']) && $_GET['action']=="edit" && !$_GET['menu']=="" ) {
edit_menu($_GET['menu']);
}
elseif (isset($_GET['action']) && isset($_GET['menu']) && isset($_POST['id']) && isset($_POST['menucontent']) && isset($_POST['title']) && $_GET['action']=="add" && $_GET['menu']=="item" && !$_POST['id'] == "" && !$_POST['menucontent'] == "" && !$_POST['title'] == "" && !$_GET['action'] == "" && !$_GET['menu'] == "" ) {
add_default_menu($_POST['title'], $_POST['id'], $_POST['menucontent'], $_POST['parent']);
}
elseif (isset($_GET['action']) && isset($_GET['loc']) && isset($_GET['id']) && $_GET['action']=="delete" && $_GET['loc']!="" && $_GET['id']!="" ) {
delete_menu();
}
else {
menu_content();
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>