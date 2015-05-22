<?php
function current_theme_name() {
$result = @mysql_query("SELECT * FROM frndzk_themes
WHERE id = '1'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
$theme=$general['theme'];
return $theme;
}
}
}
function admin_bar() {
ob_start();
@session_start();
if(isset($_SESSION['bitto'])) {
echo '<div style="clear:both;"></div>
<div style="height: 35px;
    width: 100%;"></div>
	<div style="clear:both;"></div>
<div style="   position: fixed;
    z-index: 100; 
    bottom: 0; 
	clear: both;
    left: 0;
	float:left;
	margin:0;
	height: 35px;
    width: 100%; background: white url('.home_url().'/xenon-core/images/hi.png) repeat-x left top;"><div style="float:left; margin-left:20px;"><a href="'.home_url().'/xenon-admin"><img src="'.home_url().'/xenon-core/images/xenon.png"></a></div>
	<div style="color:white; font-size:20px; padding-top:8px; float:left;margin-left:20px;">|&nbsp;&nbsp;&nbsp;&nbsp;Powered By Xenon Content Management System.</div>
	<div style="color:white; font-size:20px; padding-top:8px; float:right; margin-right:20px;">Welcome Back, '.@user_name().'&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="'.home_url().'/xenon-admin" style="text-decoraton:none;color:white;">Dashboard</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="'.home_url().'/xenon-admin/logout.php" style="text-decoraton:none; color:white;">Logout?</a></div></div><div style="clear:both;"></div>';
}
ob_flush();
}
function call_theme() {
$result = @mysql_query("SELECT * FROM frndzk_themes
WHERE id = '1'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
$theme=$general['theme'];
}
if (is_home()) {
@include('xenon-themes/'.$theme.'/index.php');
}
elseif (is_home_navi()) {
@include('xenon-themes/'.$theme.'/index.php');
}
elseif (is_page()) {
if (is_blog()) {
if(@include('xenon-themes/'.$theme.'/xenon-theme-blog.php')) { } else { include('xenon-themes/'.$theme.'/index.php'); }
}
else {
if(@include('xenon-themes/'.$theme.'/xenon-theme-page.php')) { } else { include('xenon-themes/'.$theme.'/index.php'); }
}
}
elseif (is_post()) {
if(@include('xenon-themes/'.$theme.'/xenon-theme-post.php')) { } else { include('xenon-themes/'.$theme.'/index.php'); }
}
elseif (is_category()) {
if(@include('xenon-themes/'.$theme.'/xenon-theme-category.php')) { } else { include('xenon-themes/'.$theme.'/index.php'); }
}
elseif (is_tags()) {
if(@include('xenon-themes/'.$theme.'/xenon-theme-tags.php')) { } else { include('xenon-themes/'.$theme.'/index.php'); }
}
elseif (is_search()) {
if(@include('xenon-themes/'.$theme.'/xenon-theme-search.php')) { } else { include('xenon-themes/'.$theme.'/index.php'); }
}
elseif (is_author()) {
if(@include('xenon-themes/'.$theme.'/xenon-theme-author.php')) { } else { include('xenon-themes/'.$theme.'/index.php'); }
}
elseif (is_custom()) {
global $customlinkview;
global $customlinki;
if(@include($customlinkview[$customlinki])) { } else { @include('xenon-themes/'.$theme.'/index.php'); }
}
elseif (is_404()) {
if(@include('xenon-themes/'.$theme.'/xenon-theme-404.php')) { } else { include('xenon-themes/'.$theme.'/index.php'); }
}
elseif (is_signup()) {
if(@include('xenon-themes/'.$theme.'/xenon-theme-signup.php')) { } else { @include('xenon-signup.php'); }
}
else {
@include('xenon-themes/'.$theme.'/index.php');
}
admin_bar();
}
else { echo'<html><head><title>Xenon CMS</title></head><body>Please install xenon Content Management System. <a href="install.php">Install</a></body></html>'; }
}
//theme location
function theme_location() {
$result = @mysql_query("SELECT * FROM frndzk_themes
WHERE id = '1'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
$theme=$general['theme'];
}
}
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE title = 'install_loc'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
$install=$general['tagline'];
}
}
return $install.'/xenon-themes/'.$theme;
}
//theme list
function list_theme_dir () {
global $theme_details;
//path to directory to scan
$directory = "../xenon-themes/";
 
//get all files in specified directory
$files = glob($directory . "*");
 
//print each file name
foreach($files as $file)
{
 //check to see if the file is a folder/directory
 if(is_dir($file))
 { ob_start();
 if (@include($file.'/xenon-theme-info.php')) {
 ob_clean();
 if (isset($theme_details['name']) && isset($theme_details['reg_name'])) {
  $strip=str_replace("../xenon-themes/", "", $file);
  echo '<p><big>theme Name:</big><b>'.$theme_details['name'].'</b><br>';
  echo '<big>Developer Name:</big><b>'.$theme_details['dev_name'].'</b><br>';
  echo '<big>Description Name:</big><b>'.$theme_details['description'].'</b><br>';
  $result = @mysql_query("SELECT * FROM frndzk_themes WHERE theme='$strip'");
  if ( @mysql_num_rows($result) > 0 ) {
  echo'(Current Theme)';
  }
  else {
  echo'(Deactive) <a href="themes.php?action=activate&registertheme='.$strip.'">Activate theme</a></p><br>';
  }
  }
 }
 }
}
}
//activate theme
function activate_theme($i) {
$i=defence_sql_injection($i);
$result = @mysql_query("SELECT * FROM frndzk_themes
WHERE id='1'");
if ( @mysql_num_rows($result) > 0 ) {
$query="UPDATE frndzk_themes SET theme = '$i'
WHERE id = '1'";
mysql_query($query);
header('Location: themes.php?action=true&registertheme='.$_GET['registertheme']);
}
}
//Upload Theme
function upload_theme($i) {
echo $i;
$_FILES['file']['name']=$i;
echo $_FILES['file']['name'];
function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
$filename = stripslashes($_FILES['file']['name']);
 	
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
if ($extension == "zip")
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {

    if (file_exists("../xenon-themes/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../xenon-themes/" . $_FILES["file"]["name"]);
	  echo $_FILES['file']['name'];
$destination_dir = "../xenon-themes";

    $archive = new PclZip("../xenon-themes/" . $_FILES["file"]["name"]);
    if ($archive->extract(PCLZIP_OPT_PATH, $destination_dir) == 0) {
        die("Unzip failed. Error : ".$archive->errorInfo(true));
    }
	         unlink("../xenon-themes/" . $_FILES["file"]["name"]);
    echo "Successfully extracted files to ".$destination_dir;
     }
}
    }
else
  {
  echo "Invalid file extention";
  }
  
}
//upload file interface
function upload_theme_int() {
echo ' 
<h4><form action="add-themes.php?action=upload" method="post"
enctype="multipart/form-data">
<label for="file">Select a theme(allowed extentions: .zip file only) :</label>
<input type="file" name="file" id="file" />
<br />
<input type="submit" name="submit" value="Submit" />
</form></h4>';
}
function get_themepage($gi) {
global $admintitle;
global $themefile;
if ( $admintitle == $gi ) {
//start
$result = @mysql_query("SELECT * FROM frndzk_themes WHERE id='1'");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
$dir = '../xenon-themes/'.$page['theme'].'/';
@include($dir.$admintitle.'.php');
}
}
//finish 
}
}
function execute_xenon_themef() {
$result = @mysql_query("SELECT * FROM frndzk_themes WHERE id='1'");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
$dir = 'xenon-themes/'.$page['theme'].'/';
@include($dir.'xenon-theme-functions.php');
}
}
}
function execute_xenon_themef_admin() {
$result = @mysql_query("SELECT * FROM frndzk_themes WHERE id='1'");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
$dir = '../xenon-themes/'.@$page['theme'].'/';
@include($dir.'xenon-theme-functions.php');
}
}
}
function xenon_add_header() {
if(include('xenon-themes/'.current_theme_name().'/xenon-theme-header.php')) { } else { }
}
function xenon_add_footer() {
if(include('xenon-themes/'.current_theme_name().'/xenon-theme-footer.php')) { } else { }
}
function xenon_add_sidebar() {
if(@include('xenon-themes/'.current_theme_name().'/xenon-theme-sidebar.php')) { } else { }
}
function xenon_add_comment() {
if(include('xenon-themes/'.current_theme_name().'/xenon-theme-comment.php')) { } else { }
}
function xenon_theme_details($ad) {
global $theme_details;
$theme_details['name']=$ad['name'];
$theme_details['reg_name']=$ad['reg_name'];
$theme_details['description']="";
if(isset($ad['dev_name'])) {
$theme_details['dev_name']=$ad['dev_name'];
}
else { $theme_details['dev_name']=""; }
if(isset($ad['theme_url'])) {
$theme_details['theme_url']=$ad['theme_url'];
}
else { $theme_details['theme_url']=""; }
if(isset($ad['description'])) {
$theme_details['description']=$ad['description'];
}
}
function edit_theme_home() {
echo'<form method="post" action="edit-theme.php?action=edit">';
echo'<select name="xenon-theme">';
$result = @mysql_query("SELECT * FROM frndzk_themes WHERE id='1'");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
$dir = '../xenon-themes/'.$page['theme'].'/';
@$files = glob($dir . "*.php");
if($files!="") {
foreach ( $files as $file )
{
$f=str_replace($dir,'',$file);
echo '<option value="'.$f.'">'.$f.'</option>';
}
}
@$files = glob($dir . "*.css");
if($files!="") {
foreach ( $files as $file )
{
$f=str_replace($dir,'',$file);
echo '<option value="'.$f.'">'.$f.'</option>';
}
}
@$files = glob($dir . "*.html");
if($files!="") {
foreach ( $files as $file )
{
$f=str_replace($dir,'',$file);
echo '<option value="'.$f.'">'.$f.'</option>';
}
}
}
}
echo'</select><input type="submit" name="save" value="Edit" /></form>';
}
function edit_theme_content() {
$i=$_POST['xenon-theme'];
echo'<form method="post" action="edit-theme.php?action=update">';
$result = @mysql_query("SELECT * FROM frndzk_themes WHERE id='1'");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
$dir = '../xenon-themes/'.$page['theme'].'/';
@$files = glob($dir . "*.php");
if($files!="") {
foreach ( $files as $file )
{
$f=str_replace($dir,'',$file);
if ($f == $i) { echo'<input name="file" type="hidden" value="'.$f.'"><textarea name="content" rows="25" cols="90">'.@htmlspecialchars(@file_get_contents($file)).'</textarea>'; }
}
}
@$files = glob($dir . "*.css");
if($files!="") {
foreach ( $files as $file )
{
$f=str_replace($dir,'',$file);
if ($f == $i) { echo'<input name="file" type="hidden" value="'.$f.'"><textarea name="content" rows="25" cols="90">'.@htmlspecialchars(@file_get_contents($file)).'</textarea>'; }
}
}
@$files = glob($dir . "*.html");
if($files!="") {
foreach ( $files as $file )
{
$f=str_replace($dir,'',$file);
if ($f == $i) { echo'<input name="file" type="hidden" value="'.$f.'"><textarea name="content" rows="25" cols="90">'.@htmlspecialchars(@file_get_contents($file)).'</textarea>'; }
}
}
}
}
echo'<br><input type="submit" name="save" value="Save File" /></form>';
}
function edit_theme_action() {
$i=$_POST['file'];
$c=$_POST['content'];
$c=str_replace('\"','"',$c);
$c=str_replace("\'","'",$c);
$c = stripslashes($c);
$result = @mysql_query("SELECT * FROM frndzk_themes WHERE id='1'");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
$dir = '../xenon-themes/'.$page['theme'].'/';
@$files = glob($dir . "*.php");
if($files!="") {
foreach ( $files as $file )
{
$f=str_replace($dir,'',$file);
if ($f == $i) {
$bitto = $file;
$fh = fopen($bitto, 'w') or die(" Xenon can't open file");
$stringData = "$c";
fwrite($fh, $stringData);
fclose($fh);
echo'File Edited Successfully';
}
}
}
@$files = glob($dir . "*.css");
if($files!="") {
foreach ( $files as $file )
{
$f=str_replace($dir,'',$file);
if ($f == $i) {
$bitto = $file;
$fh = fopen($bitto, 'w') or die(" Xenon can't open file");
$stringData = "$c";
fwrite($fh, $stringData);
fclose($fh);
echo'File Edited Successfully';
}
}
}
@$files = glob($dir . "*.html");
if($files!="") {
foreach ( $files as $file )
{
$f=str_replace($dir,'',$file);
if ($f == $i) {
$bitto = $file;
$fh = fopen($bitto, 'w') or die(" Xenon can't open file");
$stringData = "$c";
fwrite($fh, $stringData);
fclose($fh);
echo'File Edited Successfully';
}
}
}
}
}
}
?>