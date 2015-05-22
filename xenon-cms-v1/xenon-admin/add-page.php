<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
//page add action
if (isset($_GET['action']) && isset($_POST['title']) && !$_POST['title']=="" && $_GET['action']=="add" ) {
add_page_action();
}
elseif (isset($_GET['action']) && isset($_POST['title']) && $_POST['title']=="" && $_GET['action']=="add" ) {
echo"<br>Page Name Cannot Be empty<br>";
add_page_content();
}
//delete page single cofirmation
elseif (isset($_GET['action']) && isset($_GET['number']) && $_GET['action']=="delete" && $_GET['number']=="single" && isset($_GET['id']) ) {
echo"<br>Are you Sure You Want to Delete the Page?<br>";
echo'<a href="add-page.php?action=delete&confirm=yes&id='.$_GET['id'].'">Yes</a> or <a href="page.php">No</a>';
}
//delete single
elseif (isset($_GET['action']) && isset($_GET['confirm']) && $_GET['action']=="delete" && $_GET['confirm']=="yes" && isset($_GET['id']) ) {
$id=defence_sql_injection($_GET['id']);
mysql_query("DELETE FROM frndzk_page WHERE id ='$id'");
header("Location: page.php?deleted=single");
}
elseif (isset($_GET['action']) && isset($_GET['number']) && $_GET['action']=="edit" && $_GET['number']=="edit" && isset($_GET['id']) ) {
edit_page($_GET['id']);
}
elseif (isset($_GET['action']) && isset($_GET['number']) && $_GET['action']=="edit" && $_GET['number']=="update" && isset($_POST['id']) && isset($_POST['title']) && !$_POST['title']=="" ) {
$title=defence_sql_injection($_POST['title']);
$content=defence_sql_injection($_POST['content']);
$comstts=$_POST['comstts'];
$shortname=str_replace(' ', '-', $title);
$shortname=strtolower($shortname);
$shortname=str_replace("'", '-', $shortname);
$shortname=str_replace('/', '-', $shortname);
$shortname=str_replace('.', '-', $shortname);
$shortname=str_replace('?', '-', $shortname);
$shortname=str_replace('&', '-', $shortname);
$shortname=str_replace(";", '-', $shortname);
$query="UPDATE frndzk_page SET page = '$title'
WHERE id = '$_POST[id]'";
mysql_query($query);
$query="UPDATE frndzk_page SET pagecontent = '$content'
WHERE id = '$_POST[id]'";
mysql_query($query);
$query="UPDATE frndzk_page SET comstts = '$comstts'
WHERE id = '$_POST[id]'";
mysql_query($query);
echo'<br>Updated Page Successfully<br>';
edit_page($_POST['id']);
}
else {
//add page
add_page_content();
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>