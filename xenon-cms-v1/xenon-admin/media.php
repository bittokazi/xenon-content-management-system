<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header

echo'<h2>'; admin_title(); echo'</h2>';
if (isset($_GET['action']) && $_GET['action']=="upload" && $_GET['action']!="" ) {
upload_media($_FILES['file']['name']);
}
elseif (isset($_GET['action']) && $_GET['action']=="view" && $_GET['action']!="" ) {
list_media();
}
elseif (isset($_GET['action']) && $_GET['action']=="delete" && $_GET['action']!="" && isset($_GET['id']) && $_GET['id']!="" && isset($_GET['number']) && $_GET['number']=="single"  ) {
delete_image();
}
else {
media_upload_int();
}

// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>