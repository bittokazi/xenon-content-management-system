<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
if (isset($_GET['action']) && isset($_GET['number']) && $_GET['action']=="edit" && $_GET['number']=="edit" && isset($_GET['id']) ) {
edit_user($_GET['id']);
}
//update picture
elseif (isset($_GET['action']) && $_GET['action']=="upload" && $_GET['action']!="" ) {
upload_media_pro($_FILES['file']['name']);
}
//delete user
elseif (isset($_GET['action']) && $_GET['action']=="delete" && $_GET['action']!="" && isset($_GET['id']) && $_GET['id']!="" ) {
if ( user_roll() == "administrator" ) {
$id=$_GET['id'];
$id=defence_sql_injection($id);
$resulte = @mysql_query("SELECT * FROM frndzk_admin
WHERE id='$id'");
if ( @mysql_num_rows($resulte) > 0 ) {
while($page = @mysql_fetch_array($resulte)) {
if ( $page['username']!=user_name() ) {
@mysql_query("DELETE FROM frndzk_admin WHERE id ='$id'");
echo'<br>Username deleted<br>';
}
else { echo'you cant delete yourself !!!! :O :O :O'; }
}
}
}
}
// update email
elseif (isset($_GET['action']) && isset($_GET['number']) && $_GET['action']=="edit" && $_GET['number']=="update" && isset($_POST['id']) && isset($_POST['email']) && !$_POST['email']=="" ) {
$fullname=defence_sql_injection($_POST['fullname']);
$website=defence_sql_injection($_POST['website']);
$email=defence_sql_injection($_POST['email']);
if (isset($_POST['userrole'])) {
$userrole=defence_sql_injection($_POST['userrole']);
}
$username2234=defence_sql_injection($_POST['un']);
//check email
$resulte = @mysql_query("SELECT * FROM frndzk_admin
WHERE email='$email'");
$resulte1 = @mysql_query("SELECT * FROM frndzk_admin
WHERE email='$email' AND username='$username2234'");
if ( @mysql_num_rows($resulte1) > 0 && @mysql_num_rows($resulte) > 0 ) {
$sameemail="";
}
elseif ( @mysql_num_rows($resulte) > 0 && @mysql_num_rows($resulte1) == 0 ) {
$sameemail="sameemail";
}
elseif ( @mysql_num_rows($resulte1) == 0 && @mysql_num_rows($resulte) == 0 ) {
$sameemail="";
}
else {
$sameemail="";
}
//email check complete
if ( user_roll() == "administrator" && $sameemail=="" ) {
$query="UPDATE frndzk_admin SET email = '$email'
WHERE id = '$_POST[id]'";
mysql_query($query);
$query="UPDATE frndzk_admin SET name = '$fullname'
WHERE id = '$_POST[id]'";
mysql_query($query);
$query="UPDATE frndzk_admin SET website = '$website'
WHERE id = '$_POST[id]'";
mysql_query($query);
$query="UPDATE frndzk_admin SET position = '$userrole'
WHERE id = '$_POST[id]'";
mysql_query($query);
echo'<br>Updated Post Successfully<br>';
edit_user($_POST['id']);
}
elseif ( user_roll() == "moderator" && $sameemail=="" ) {
$query="UPDATE frndzk_admin SET email = '$email'
WHERE id = '$_POST[id]' and username='$username2234'";
mysql_query($query);
$query="UPDATE frndzk_admin SET name = '$fullname'
WHERE id = '$_POST[id]' and username='$username2234'";
mysql_query($query);
$query="UPDATE frndzk_admin SET website = '$website'
WHERE id = '$_POST[id]' and username='$username2234'";
mysql_query($query);
echo'<br>Updated Post Successfully<br>';
edit_user($_POST['id']);
}
elseif ( user_roll() == "user" && $sameemail=="" ) {
$query="UPDATE frndzk_admin SET email = '$email'
WHERE id = '$_POST[id]' and username='$username2234'";
mysql_query($query);
$query="UPDATE frndzk_admin SET name = '$fullname'
WHERE id = '$_POST[id]' and username='$username2234'";
mysql_query($query);
$query="UPDATE frndzk_admin SET website = '$website'
WHERE id = '$_POST[id]' and username='$username2234'";
mysql_query($query);
echo'<br>Updated Post Successfully<br>';
edit_user($_POST['id']);
}
elseif ( $sameemail=="sameemail" ) {
echo'<br>Same Email found. Please chose another<br>';
edit_user($_POST['id']);
}
}
//update password
elseif (isset($_GET['action']) && isset($_GET['number']) && $_GET['action']=="pass" && $_GET['number']=="update" && isset($_POST['id']) && isset($_POST['password']) && !$_POST['password']=="" ) {
$password=defence_sql_injection($_POST['password']);
$password=hash('sha512',sha1(md5($password)));
$username2234=user_name();
if ( user_roll() == "administrator" ) {
$query="UPDATE frndzk_admin SET password = '$password'
WHERE id = '$_POST[id]'";
mysql_query($query);
echo'<br>Updated Post Successfully<br>';
edit_user($_POST['id']);
}
elseif ( user_roll() == "user" || user_roll() == "moderator" ) {
$query="UPDATE frndzk_admin SET password = '$password'
WHERE id = '$_POST[id]' and username='$username2234'";
mysql_query($query);
echo'<br>Updated Password Successfully<br>';
edit_user($_POST['id']);
}

}
else {
profile();
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>