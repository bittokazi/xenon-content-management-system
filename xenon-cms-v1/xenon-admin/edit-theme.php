<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
if ( isset($_GET['action']) && isset($_POST['xenon-theme']) && $_POST['xenon-theme']!="" && $_GET['action']=="edit" ) {
edit_theme_home();
echo'<br>';
edit_theme_content();
}
elseif ( isset($_GET['action']) && isset($_POST['file']) && isset($_POST['content']) && $_POST['file']!="" && $_GET['action']=="update" && $_POST['content']!="" ) {
edit_theme_action();
echo'<br>';
edit_theme_home();
}
else {
edit_theme_home();
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>