<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
if ( isset($_GET['action']) && isset($_GET['num']) && !$_GET['num']=="" && $_GET['action']=="onoff" ) {
update_general($_GET['num'], $_GET['turn']);
general_content();
}
elseif (isset($_GET['action']) && isset($_GET['id']) && !$_GET['id']=="" && !$_POST['title']=="" && $_GET['action']=="edit" ) {
update_general_title($_GET['id'], $_POST['title'], $_POST['tagline']);
general_content();
}
else {
general_content();
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>