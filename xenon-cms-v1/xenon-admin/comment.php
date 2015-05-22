<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
echo'<h2>Comments</h2>';
echo'<h4><a href="comment.php?action=approved">Approved Comment List</a></h4>';
if (isset($_GET['action']) && isset($_GET['number']) && $_GET['number']!="" && $_GET['action']=="approve" && $_GET['number']=="single" && isset($_GET['id']) && $_GET['id']!="") {
comment_approve();
comment_pending();
}
elseif (isset($_GET['action']) && isset($_GET['number']) && $_GET['number']!="" && $_GET['action']=="pending" && $_GET['number']=="single" && isset($_GET['id']) && $_GET['id']!="") {
comment_pending_action();
approved_list();
}
elseif (isset($_GET['action']) && isset($_GET['number']) && $_GET['number']!="" && $_GET['action']=="delete" && $_GET['number']=="single" && isset($_GET['id']) && $_GET['id']!="") {
comment_delete();
approved_list();
}
elseif (isset($_GET['action']) && isset($_GET['number']) && $_GET['number']!="" && $_GET['action']=="deleted" && $_GET['number']=="single" && isset($_GET['id']) && $_GET['id']!="") {
comment_delete();
comment_pending();
}
elseif (isset($_GET['action']) && $_GET['action']=="approved"){
approved_list();
}
elseif (isset($_GET['action']) && isset($_POST['title']) && $_POST['title']=="" && isset($_POST['password']) && $_POST['password']=="" && isset($_POST['email']) && $_POST['email']=="" && $_GET['action']=="add" ) {
echo"<br>Username, Email, Password cannot be empty<br>";
add_user_content();
}
else {
//add post
comment_pending();
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>