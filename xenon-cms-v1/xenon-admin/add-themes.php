<?phpob_start();session_start(); if(isset($_SESSION['bitto'])) {include('header.php');// initializes headerupload_theme_int();if (isset($_GET['action']) && $_GET['action']=="upload" && !$_GET['action']=="" ) {upload_theme($_FILES['file']['name']);echo " success ";}// initializes footerinclude('footer.php');} else {  header("Location: index.php");}ob_flush();?>