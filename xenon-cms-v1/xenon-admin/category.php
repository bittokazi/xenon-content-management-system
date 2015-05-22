<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
category_deleted();
if (isset($_GET['action']) && isset($_GET['number']) && $_GET['action']=="delete" && $_GET['number']=="single" && isset($_GET['id']) ) {
echo"<br>Are you Sure You Want to Delete the Category?<br>";
echo'<a href="category.php?action=delete&confirm=yes&id='.$_GET['id'].'">Yes</a> or <a href="post.php">No</a>';
}
//delete single
elseif (isset($_GET['action']) && isset($_GET['confirm']) && $_GET['action']=="delete" && $_GET['confirm']=="yes" && isset($_GET['id']) ) {
$id=defence_sql_injection($_GET['id']);
$result = @mysql_query("SELECT * FROM frndzk_category WHERE id='$id'");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$resultcount = @mysql_query("SELECT * FROM frndzk_post WHERE category='$pages[shortname]'");
if ( @mysql_num_rows($resultcount) > 0 ) { echo'This category has posts under it so it cannot be deleted.'; }
else{ mysql_query("DELETE FROM frndzk_category WHERE id ='$id'");
header("Location: category.php?deleted=single");}
}
}
}
elseif (isset($_GET['action']) && isset($_POST['title']) && !$_POST['title']=="" && $_GET['action']=="add" ) {
add_category_action();
}
elseif (isset($_GET['action']) && isset($_POST['title']) && $_POST['title']=="" && $_GET['action']=="add" ) {
echo"<br>Category Name Cannot Be empty<br>";
add_category_content();
}
elseif (isset($_GET['action']) && isset($_GET['number']) && $_GET['action']=="edit" && $_GET['number']=="edit" && isset($_GET['id']) ) {
edit_cat($_GET['id']);
}
elseif (isset($_GET['action']) && isset($_GET['number']) && $_GET['action']=="edit" && $_GET['number']=="update" && isset($_POST['id']) && isset($_POST['title']) && !$_POST['title']=="" ) {
$title=defence_sql_injection($_POST['title']);
$shortname=str_replace(' ', '-', $title);
$shortname=strtolower($shortname);
$shortname=str_replace("'", '-', $shortname);
$shortname=str_replace('/', '-', $shortname);
$shortname=str_replace('.', '-', $shortname);
$shortname=str_replace('?', '-', $shortname);
$shortname=str_replace('&', '-', $shortname);
$shortname=str_replace(";", '-', $shortname);
$result = @mysql_query("SELECT * FROM frndzk_category WHERE name='$_POST[category]'");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$catname=$pages['shortname'];
}
}
else {
$catname=$_POST['category'];
}
$query="UPDATE frndzk_category SET parent = '$catname'  
WHERE id = '$_POST[id]'";
mysql_query($query);
$query="UPDATE frndzk_category SET name = '$title' 
WHERE id = '$_POST[id]'";
mysql_query($query);
echo'<br>Updated Post Successfully<br>';
edit_cat($_POST['id']);
}
else {
echo'<h2>'; admin_title(); echo'</h2>';
categorylist();
					echo'
				</table>
				';
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>