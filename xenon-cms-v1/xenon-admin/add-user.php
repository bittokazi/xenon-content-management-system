<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
if (isset($_GET['action']) && isset($_POST['title']) && !$_POST['title']=="" && isset($_POST['password']) && !$_POST['password']=="" && isset($_POST['email']) && !$_POST['email']=="" && $_GET['action']=="add" ) {
add_user_action();
}
elseif (isset($_GET['action']) && isset($_POST['title']) && $_POST['title']=="" && isset($_POST['password']) && $_POST['password']=="" && isset($_POST['email']) && $_POST['email']=="" && $_GET['action']=="add" ) {
echo"<br>Username, Email, Password cannot be empty<br>";
add_user_content();
}
else {
//add post
add_user_content();
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>