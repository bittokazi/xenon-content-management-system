<?php
function admin_title() {
global $admintitle;
echo $admintitle;
}
function access_roll() {
global $accessrol;
echo $accessrol;
}
function xenon_admin_menu($cat){
if ($cat == "page") {
global $menupage;
if ($menupage == "") {}
else {
foreach($menupage as $menupages)
{
echo $menupages;
}
}
}
if ($cat == "post") {
global $menupost;
if ($menupost == "") {}
else {
foreach($menupost as $menuposts)
{
echo $menuposts;
}
}
}
if ($cat == "user") {
global $menuuser;
if ($menuuser == "") {}
else {
foreach($menuuser as $menuusers)
{
echo $menuusers;
}
}
}
if ($cat == "theme") {
global $menutheme;
if ($menutheme == "") {}
else {
foreach($menutheme as $menuthemes)
{
echo $menuthemes;
}
}
}
if ($cat == "addon") {
global $menuaddon;
if ($menuaddon == "") {}
else {
foreach($menuaddon as $menuaddons)
{
echo $menuaddons;
}
}
}
if ($cat == "settings") {
global $menusettings;
if ($menusettings == "") {}
else {
foreach($menusettings as $menusettingss)
{
echo $menusettingss;
}
}
}
if ($cat == "top") {
global $menutop;
if ($menutop == "") {}
else {
foreach($menutop as $menutops)
{
echo $menutops;
}
}
}
if ($cat == "sidetop") {
global $menusidetop;
if ($menusidetop == "") {}
else {
foreach($menusidetop as $menusidetops)
{
echo $menusidetops;
}
}
}
if ($cat == "addonpage") {
global $addonpage;
if ($addonpage == "") {}
else {
foreach($addonpage as $addonpages)
{
echo $addonpages;
}
}
}
if ($cat == "themepage") {
global $themepage;
if ($themepage == "") {}
else {
foreach($themepage as $themepages)
{
echo $themepages;
}
}
}
}
//widget

//install frndzk
function xenon_install()
{
ob_start();
require('frndzk.php');
$result = @mysql_query("SELECT * FROM frndzk_admin
WHERE id = '1'");
ob_clean();
if(!$result) {

if (isset($_GET['install']) && $_GET['install'] == "frndzk" )
{


if (isset($_REQUEST['server']) && isset($_REQUEST['dbname']) && isset($_REQUEST['dbuname']) && isset($_REQUEST['pass']) && isset($_REQUEST['un']) && isset($_REQUEST['pw']) && isset($_REQUEST['email']))

{

$server=$_REQUEST['server'];
$dbname=$_REQUEST['dbname'];
$dbuname=$_REQUEST['dbuname'];
$dbpass=$_REQUEST['pass'];


$l="fzk";
$lol="<?php
$$l = @mysql_connect(\"$server\",\"$dbuname\",\"$dbpass\");
if (!$$l)
  {
  echo'frndzk cms Could not connect';
  }
@mysql_query('SET CHARACTER SET utf8');
@mysql_query(\"SET SESSION collation_connection ='utf8_general_ci'\");
if (!@mysql_select_db(\"$dbname\",$$l)) {
echo'frndzk cms Could not connect to database error type';
}
?>";
$bitto = "frndzk.php";
$fh = fopen($bitto, 'w') or die("can't open file");
$stringData = "$lol";
fwrite($fh, $stringData);
fclose($fh);



require('frndzk.php');

$un=defence_sql_injection("$_REQUEST[un]");
$pw=defence_sql_injection("$_REQUEST[pw]");
$email=defence_sql_injection("$_REQUEST[email]");



ob_start();
$result = @mysql_query("SELECT * FROM frndzk_admin
WHERE id = '1'");
ob_clean();
if(!$result) {


// creat table

$query="CREATE TABLE frndzk_title (id int(20) NOT NULL auto_increment,title LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,tagline LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_page (id int(20) NOT NULL auto_increment,page LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,shortname LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,pagecontent LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,comstts LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_post (id int(20) NOT NULL auto_increment,post LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,shortname LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,postcontent LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,comment LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,comstts varchar(160) CHARACTER SET utf8 COLLATE utf8_general_ci,date varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci,time varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,postedby LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,category LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,tags LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_header (id int(6) NOT NULL auto_increment,header varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci,footer text(200) CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_bar (id int(20) NOT NULL auto_increment,addvertise varchar(10000) CHARACTER SET utf8 COLLATE utf8_general_ci,content varchar(10000) CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_apibar (id int(20) NOT NULL auto_increment,loc varchar(10000) CHARACTER SET utf8 COLLATE utf8_general_ci,addvertise LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,content varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_login (id int(20) NOT NULL auto_increment,addvertise LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,content LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_admin (id int(20) NOT NULL auto_increment,username varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci,password varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,name varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci,website varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci,email varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci,position varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_comment (id int(20) NOT NULL auto_increment,name varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci,website varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci,commenter varchar(3000) CHARACTER SET utf8 COLLATE utf8_general_ci,comment LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,post LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,postedby varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_commenton (id int(20) NOT NULL auto_increment,commenter varchar(3000) CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_addons (id int(20) NOT NULL auto_increment,name varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci,status varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_themes (id int(20) NOT NULL auto_increment,theme varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_message (id int(6) NOT NULL auto_increment,mfrom varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,mto varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci,mbody varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_menu (id int(20) NOT NULL auto_increment,menuloc varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,first varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,second varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,type varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,parent varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,content varchar(3000) CHARACTER SET utf8 COLLATE utf8_general_ci,UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_media (id int(20) NOT NULL auto_increment,url text(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,mdby text(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_file (id int(20) NOT NULL auto_increment,url text(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,mdby text(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,name text(1000) CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);
$query="CREATE TABLE frndzk_category (id int(20) NOT NULL auto_increment,name varchar(3000) CHARACTER SET utf8 COLLATE utf8_general_ci,parent varchar(3000) CHARACTER SET utf8 COLLATE utf8_general_ci,shortname varchar(3000) CHARACTER SET utf8 COLLATE utf8_general_ci,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
@mysql_query($query);


$query="INSERT INTO frndzk_title VALUES ('','Xenon CMS','Made In Bangladesh')";
@mysql_query($query);
$query="INSERT INTO frndzk_title VALUES ('','Frndzk CMS','Created by bitto kazi')";
@mysql_query($query);
$query="INSERT INTO frndzk_page VALUES ('','About Xenon','about-xenon','This website is created with Xenon content management system','yes')";
@mysql_query($query);
$query="INSERT INTO frndzk_header VALUES ('','frndzk cms','Copyright 2013 <a href=\"http://bitto.us\" target=\"_blank\">Bitto Kazi</a>')";
@mysql_query($query);
$query="INSERT INTO frndzk_header VALUES ('','frndzk cms','Copyright 2011 <a href=\"http://bitto.us\" target=\"_blank\">Bitto Kazi</a>')";
@mysql_query($query);
$querys="INSERT INTO frndzk_post VALUES ('','Xenon First post','xenon-first-post','website is created with Xenon content management system','this is a sample post','yes',CURDATE(),CURTIME(),'$un','uncategorized','xenon')";
@mysql_query($querys);
$query="INSERT INTO frndzk_bar VALUES ('','Developers','Developed By Bitto Kazi')";
@mysql_query($query);
$query="INSERT INTO frndzk_bar VALUES ('','About this site','this website is created with Xenon content management system')";
@mysql_query($query);





$query="INSERT INTO frndzk_login VALUES ('','User Panel','<ul><li><a href=\"frndzk-user\">Log in</a></li><li><a href=\"frndzk-signup.php\">Signup</a></li></ul>')";
@mysql_query($query);

$bitto=hash('sha512',sha1(md5($pw)));
$query="INSERT INTO frndzk_admin VALUES ('','$un', '$bitto','','','$email','administrator')";
@mysql_query($query);
$query="INSERT INTO frndzk_commenton VALUES ('','true')";
@mysql_query($query);
$query="INSERT INTO frndzk_commenton VALUES ('','true')";
@mysql_query($query);
$query="INSERT INTO frndzk_commenton VALUES ('','true')";
@mysql_query($query);
$query="INSERT INTO frndzk_commenton VALUES ('','true')";
@mysql_query($query);
$query="INSERT INTO frndzk_commenton VALUES ('','frndzk')";
@mysql_query($query);
$query="INSERT INTO frndzk_commenton VALUES ('','true')";
@mysql_query($query);
$query="INSERT INTO frndzk_commenton VALUES ('','true')";
@mysql_query($query);
$query="INSERT INTO frndzk_commenton VALUES ('','true')";
@mysql_query($query);
$query="INSERT INTO frndzk_commenton VALUES ('','true')";
@mysql_query($query);
$query="INSERT INTO frndzk_themes VALUES ('','xenon')";
@mysql_query($query);
$query="INSERT INTO frndzk_message VALUES ('','lol','lol','lol')";
@mysql_query($query);
$query="INSERT INTO frndzk_category VALUES ('','uncategorized','','uncategorized')";
@mysql_query($query);

$addrs=$_SERVER['SERVER_NAME'];


$d=dirname($_SERVER['PHP_SELF']);
$addrs=str_replace("www.","",$_SERVER['SERVER_NAME']);
if($d == "/"){
$e="http://$addrs";
}
else
{
$e="http://$addrs$d";
}
$query="INSERT INTO frndzk_title VALUES ('','install_loc','$e')";
@mysql_query($query);
$query="INSERT INTO frndzk_title VALUES ('','link_style','number')";
@mysql_query($query);
$query="INSERT INTO frndzk_title VALUES ('','home_page','xenon_latest_page')";
@mysql_query($query);
$query="INSERT INTO frndzk_title VALUES ('','blog_page','')";
@mysql_query($query);
$query="INSERT INTO frndzk_title VALUES ('','default_signup','user')";
@mysql_query($query);


$addrs=$_SERVER['SERVER_NAME'];


$d=dirname($_SERVER['PHP_SELF']);
$addrs=str_replace("www.","",$_SERVER['SERVER_NAME']);
if($d == "/"){
$e="http://www.$addrs";
}
else
{
$e="http://www.$addrs$d";
}

$addrs=str_replace($_SERVER['SERVER_NAME'],"",$e);
$addrs=str_replace("www.","",$addrs);
$addrs=str_replace("http://","",$addrs);
$addrs=str_replace("https://","",$addrs);
$addrs = explode('/',$addrs);
unset($addrs[0]);
$addrs = implode($addrs);
$addrs='/'.$addrs;

$lol="<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase $addrs
RewriteRule ^([0-9a-zA-Z]+)$ index.php?dir=$1 [QSA,L]
RewriteRule ^([0-9a-zA-Z]+)/$ index.php?dir=$1 [QSA,L]
RewriteRule ^([^/.]+)/([^/.]+)$ index.php?dir=$1&url=$2 [QSA,L]
RewriteRule ^([^/.]+)/([^/.]+)/$ index.php?dir=$1&url=$2 [QSA,L]
RewriteRule ^([^/.]+)/([^/.]+)/([0-9a-zA-Z]+)$ index.php?dir=$1&url=$2&p=$3 [QSA,L]
RewriteRule ^([^/.]+)/([^/.]+)/([0-9a-zA-Z]+)/$ index.php?dir=$1&url=$2&p=$3 [QSA,L]
RewriteRule ^frndzk-home-page.php index.php
RewriteRule ^frndzk.php index.php
RewriteRule ^frndzk_bitto_functions.php index.php
</IfModule>
";
$bitto = ".htaccess";
$fh = fopen($bitto, 'w') or die("can't open file");
$stringData = "$lol";
fwrite($fh, $stringData);
fclose($fh);




$result = @mysql_query("SELECT * FROM frndzk_admin
WHERE id = '1'");
if($result) {
echo "<html><head><title>Xenon CMS Installetion</title></head><body><center><h3>website created</h3><h3>administrator username: ".$un."</h3></br><h3>administrator password: ".$pw."</h3></br></body></html>";
}
else
{
exit;
}
}
else
{
echo "<html><head><title>Xenon CMS Installetion</title></head><body><center><h3>Xenon CMS is Already installed on the database.</h3></body></html>";
}

}

else {
echo"<html><head><title>Xenon CMS Installetion</title></head><body><center><h2>Please Give All Information To Run The Installetion Proccess of Frndzk Link Shortner</h2></body></html>";
}

}
else
{








echo'
<html> 
<head> 
<title>Xenon CMS Installetion</title> 
</head><body> 
<center> 
<script type="text/javascript"> 
function validateForm() 
{ 
var y=document.forms["frndzk"]["server"].value; 
var r = y.length; 
if (r<1) 
  { 
  alert("Database Server field empty"); 
  return false; 
  } 
var x=document.forms["frndzk"]["email"].value; 
var atpos=x.indexOf("@"); 
var dotpos=x.lastIndexOf("."); 
if (atpos<3 || dotpos<atpos+3 || dotpos+2>=x.length) 
  { 
  alert("Not a valid e-mail address"); 
  return false; 
  } 
var d=document.forms["frndzk"]["pw"].value; 
var g = d.length; 
if (g<6) 
  { 
  alert("password must be more than 5 charecters"); 
  return false; 
  }
var e=document.forms["frndzk"]["un"].value; 
var f = e.length; 
if (f<5) 
  { 
  alert("username must be more than 4 charecters"); 
  return false; 
  } 
} 
</script> 
<img src="xenon.png" height="200px" wideth="200px"></left><br>
<h3>Xenon CMS Installetion</h3> 
<h3>Database Information</h3> 
<form name="frndzk" action="install.php?install=frndzk" onsubmit="return validateForm()"  method="post"> 
Database Server: <input type="text" name="server" /></br> 
Database Username: <input type="text" name="dbuname" /></br> 
&nbsp Database name: <input type="text" name="dbname" /></br> 
&nbsp Database password: <input type="password" name="pass" /></br> 
<h3>Administrator Details</h3> 
Email: <input type="text" name="email" /><br>
Username: <input type="text" name="un" /><br>
Password: <input type="text" name="pw" /> <br><br>';


$d=dirname($_SERVER['PHP_SELF']);
$addrs=str_replace("www.","",$_SERVER['SERVER_NAME']);
if($d == "/"){
echo"<b>Installetion Directory Detected: http://$addrs (you can change it after installetion)</b>";
}
else
{
echo"<b>Installetion Directory Detected: http://$addrs$d (you can change it after installetion)</b>";
}

echo'</br></br> 
<input type="submit" value="Install"/></form> 
</center></body></html>';
}

}
else
{
echo"<html><head><title>Xenon CMS Installer</title></head><body><center><h2>No hunky punky baby. The installetion process is locked.</h2></body></html>";
}
}
post();
?>