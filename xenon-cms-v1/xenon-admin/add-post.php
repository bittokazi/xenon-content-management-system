<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
if (isset($_GET['action']) && isset($_POST['title']) && !$_POST['title']=="" && $_GET['action']=="add" ) {
echo"<br>post added Successfully<br>";
add_post_action();
}
elseif (isset($_GET['action']) && isset($_POST['title']) && $_POST['title']=="" && $_GET['action']=="add" ) {
echo"<br>Page Name Cannot Be empty<br>";
add_post_content();
}
else {
//add post
add_post_content();
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>