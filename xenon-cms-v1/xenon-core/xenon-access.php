<?php
function user_roll() {
if (isset($_SESSION['access'])) {
$roll=$_SESSION['access'];
return $roll;
}
}
function user_name() {
if (isset($_SESSION['bitto'])) {
$roll=$_SESSION['bitto'];
return $roll;
}
}
function xenon_reset_password() {
ob_start();
@include('../frndzk.php');
if(isset($_POST['emailreset'])) {
$lolr=$_POST['emailreset'];
$lol = stripslashes($lolr);
$lol=@mysql_real_escape_string($lol);
$frndzk= genRandomString();
$lsdss=hash('sha512',sha1(md5($frndzk)));
$result = @mysql_query("SELECT * FROM frndzk_admin
WHERE email ='$lol'");
if ( @mysql_num_rows($result) > 0 ) {
while($user = @mysql_fetch_array($result)) {
if ( $lol == "" . $user['email'] . "") {
$query="UPDATE frndzk_admin SET password = '$lsdss'
WHERE email = '$lol'";
@mysql_query($query);
$addrs=$_SERVER['SERVER_NAME'];
$to = "$lol"; $subject = "Xenon Password Reset" ; $email = "Xenon user Password Reset Email" ; $message = "Your username: " . $user['username'] . "  
New password: $frndzk  
login with this password. You can change it later. </br>
Powered by www.bitto.us"; $headers = "From: xenon@$addrs"; $sent = mail($to, $subject, $message, $headers) ; if($sent) { echo"NEW PASSWORD WAS SENT TO YOUR EMAIL ADDRESS :)";
 } else {print "cant send email , may be smtp server not enabled in your host"; }
}
else
{
echo "user not exits";
}
}
}
else {
echo "user not exits :(";
}
}
else {

}



}











function xenon_login_check() {
ob_start();
if (isset($_POST['un'])) {
if (isset($_POST['pw'])) {
@include('../frndzk.php');
$usernamess=$_REQUEST['un'];
$usernamess = stripslashes($usernamess);
$lsdr=$_REQUEST['pw'];
$lsdr = stripslashes($lsdr);
$usernames=@mysql_real_escape_string($usernamess);
$lsd=@mysql_real_escape_string($lsdr);
$passwords=hash('sha512',sha1(md5($lsd)));
$result = @mysql_query("SELECT * FROM frndzk_admin
WHERE username = '$usernames'");

if($result) {
if ( @mysql_num_rows($result) > 0 ) {
while($admin = @mysql_fetch_array($result))
if ( $usernames == "" . $admin['username'] . "" ) {
if ( $passwords == "" . $admin['password'] . "")  {
if ( $admin['position']=="suspend" ) {
echo"You are currently suspended";
}
elseif ( $admin['position']=="user" || $admin['position']=="moderator" ) {
$result = @mysql_query("SELECT * FROM frndzk_commenton
WHERE id = '2'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if($general['commenter']=="true") {
$_SESSION['bitto']=$usernames;
$_SESSION['access']="" . $admin['position'] . "";        
header("Location: admin.php");
}
else {
echo"Login is Disabled";
}
}
}
}
else {
$_SESSION['bitto']=$usernames;
$_SESSION['access']="" . $admin['position'] . "";        
header("Location: admin.php");
}
} 
else {   echo"Username or Password Dosen't Match";
}
} else {   echo"Username or Password Dosen't Match";
}
}
else {   echo"Username or Password Dosen't Match";
}
}

else{
echo"<h1>DATABASE ERROR-frndzk link shortner</h1>";
}
}
else { 
}
}
else { 
}
ob_flush();
}
function xenon_login_check_widget() {
ob_start();
if (isset($_POST['un'])) {
if (isset($_POST['pw'])) {
$usernamess=$_REQUEST['un'];
$usernamess = stripslashes($usernamess);
$lsdr=$_REQUEST['pw'];
$lsdr = stripslashes($lsdr);
$usernames=@mysql_real_escape_string($usernamess);
$lsd=@mysql_real_escape_string($lsdr);
$passwords=hash('sha512',sha1(md5($lsd)));
$result = @mysql_query("SELECT * FROM frndzk_admin
WHERE username = '$usernames'");

if($result) {
if ( @mysql_num_rows($result) > 0 ) {
while($admin = @mysql_fetch_array($result))
if ( $usernames == "" . $admin['username'] . "" ) {
if ( $passwords == "" . $admin['password'] . "")  {
if ( $admin['position']=="suspend" ) {
echo"You are currently suspended";
}
elseif ( $admin['position']=="user" || $admin['position']=="moderator" ) {
$result = @mysql_query("SELECT * FROM frndzk_commenton
WHERE id = '2'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if($general['commenter']=="true") {
session_start();
$_SESSION['bitto']=$usernames;
$_SESSION['access']="" . $admin['position'] . "";        
header("Location: ".home_url()."/xenon-admin/"."admin.php");
}
else {
echo"Login is Disabled";
}
}
}
}
else {
session_start();
$_SESSION['bitto']=$usernames;
$_SESSION['access']="" . $admin['position'] . "";        
header("Location: ".home_url()."/xenon-admin/"."admin.php");
}
} 
else {   echo"Username or Password Dosen't Match";
}
} else {   echo"Username or Password Dosen't Match";
}
}
else {   echo"Username or Password Dosen't Match";
}
}

else{
echo"<h1>DATABASE ERROR-frndzk link shortner</h1>";
}
}
else { 
}
}
else { 
}
ob_flush();
}
?>