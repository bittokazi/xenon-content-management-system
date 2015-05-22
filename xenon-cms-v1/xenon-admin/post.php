<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
post_deleted();
//delete page single cofirmation
if (isset($_GET['action']) && isset($_GET['number']) && $_GET['action']=="delete" && $_GET['number']=="single" && isset($_GET['id']) ) {
echo"<br>Are you Sure You Want to Delete the Post?<br>";
echo'<a href="post.php?action=delete&confirm=yes&id='.$_GET['id'].'">Yes</a> or <a href="post.php">No</a>';
}
//delete single
elseif (isset($_GET['action']) && isset($_GET['confirm']) && $_GET['action']=="delete" && $_GET['confirm']=="yes" && isset($_GET['id']) ) {
$id=defence_sql_injection($_GET['id']);
$username2234=user_name();
if ( user_roll() == "moderator" || user_roll() == "administrator" ) {
@mysql_query("DELETE FROM frndzk_post WHERE id ='$id'");
}
elseif ( user_roll() == "user" ) {
@mysql_query("DELETE FROM frndzk_post WHERE id ='$id' and postedby='$username2234'");
}
header("Location: post.php?deleted=single");
}
elseif (isset($_GET['action']) && isset($_GET['number']) && $_GET['action']=="edit" && $_GET['number']=="edit" && isset($_GET['id']) ) {
edit_post($_GET['id']);
}
elseif (isset($_GET['action']) && isset($_GET['number']) && $_GET['action']=="edit" && $_GET['number']=="update" && isset($_POST['id']) && isset($_POST['title']) && !$_POST['title']=="" ) {
$title=defence_sql_injection($_POST['title']);
$content=defence_sql_injection($_POST['content']);
$comment=defence_sql_injection($_POST['comment']);
$comstts=$_POST['comstts'];
$tags=defence_sql_injection($_POST['tags']);
$tags=strtolower($tags);
$tags=str_replace(', ', ',', $tags);
$tags=str_replace(' ', '-', $tags);
$tags=str_replace("'", '-', $tags);
$tags=str_replace('/', '-', $tags);
$tags=str_replace('.', '-', $tags);
$tags=str_replace('?', '-', $tags);
$tags=str_replace('&', '-', $tags);
$tags=str_replace(";", '-', $tags);
$catname=$_POST['category'];
$username2234=user_name();
if ( user_roll() == "moderator" || user_roll() == "administrator" ) {
$query="UPDATE frndzk_post SET post = '$title'
WHERE id = '$_POST[id]'";
mysql_query($query);
$query="UPDATE frndzk_post SET postcontent = '$content'
WHERE id = '$_POST[id]'";
mysql_query($query);
$query="UPDATE frndzk_post SET comstts = '$comstts'
WHERE id = '$_POST[id]'";
mysql_query($query);
$query="UPDATE frndzk_post SET category = '$catname'
WHERE id = '$_POST[id]'";
mysql_query($query);
$query="UPDATE frndzk_post SET comment = '$comment'
WHERE id = '$_POST[id]'";
mysql_query($query);
$query="UPDATE frndzk_post SET tags = '$tags'
WHERE id = '$_POST[id]'";
mysql_query($query);
echo'<br>Updated Post Successfully<br>';
edit_post($_POST['id']);
}
elseif ( user_roll() == "user" ) {
$query="UPDATE frndzk_post SET post = '$title'
WHERE id = '$_POST[id]' and postedby='$username2234'";
mysql_query($query);
$query="UPDATE frndzk_post SET postcontent = '$content'
WHERE id = '$_POST[id]' and postedby='$username2234'";
mysql_query($query);
$query="UPDATE frndzk_post SET comstts = '$comstts'
WHERE id = '$_POST[id]' and postedby='$username2234'";
mysql_query($query);
$query="UPDATE frndzk_post SET category = '$catname'
WHERE id = '$_POST[id]' and postedby='$username2234'";
mysql_query($query);
$query="UPDATE frndzk_post SET comment = '$comment'
WHERE id = '$_POST[id]' and postedby='$username2234'";
mysql_query($query);
$query="UPDATE frndzk_post SET tags = '$tags'
WHERE id = '$_POST[id]' and postedby='$username2234'";
mysql_query($query);
echo'<br>Updated Post Successfully<br>';
edit_post($_POST['id']);
}
}
else {
echo'<h2>'; admin_title(); echo'</h2>';
postlist();
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>