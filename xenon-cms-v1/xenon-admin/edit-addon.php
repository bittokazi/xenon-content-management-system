<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
if ( isset($_GET['action']) && isset($_POST['xenon-theme']) && $_POST['xenon-theme']!="" && $_GET['action']=="edit" ) {
edit_addon_home();
echo'<br>';
edit_addon_content();
}
elseif ( isset($_GET['action']) && isset($_POST['file']) && isset($_POST['content']) && $_POST['file']!="" && $_GET['action']=="update" && $_POST['content']!="" ) {
edit_addon_action();
echo'<br>';
edit_addon_home();
}
else {
edit_addon_home();
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>