<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
list_dir();
if (isset($_GET['action']) && isset($_GET['registername']) && $_GET['action']=="activate" && !$_GET['registername']=="" && !$_GET['action']=="" ) {
activate_addon($_GET['registername']);
echo " success ";
}
elseif (isset($_GET['action']) && isset($_GET['registername']) && $_GET['action']=="delete" && !$_GET['registername']=="" && !$_GET['action']=="" ) {
delete_addon($_GET['registername']);
echo " success ";
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>