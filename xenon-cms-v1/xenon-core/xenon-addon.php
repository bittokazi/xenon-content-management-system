<?php
function list_dir () {
global $addon_details;
//path to directory to scan
$directory = "../xenon-addons/";
 
//get all files in specified directory
$files = glob($directory . "*");
 
//print each file name
foreach($files as $file)
{
 //check to see if the file is a folder/directory
 if(is_dir($file))
 { ob_start();
 if (@include($file.'/xenon-addon-info.php')) {
 ob_clean();
 if (isset($addon_details['name']) && isset($addon_details['reg_name'])) {
  $strip=str_replace("../xenon-addons/", "", $file);
  echo '<p><big>Addon Name:</big><b>'.$addon_details['name'].'</b><br>';
  echo '<big>Developer Name:</big><b>'.$addon_details['dev_name'].'</b><br>';
  echo '<big>Description Name:</big><b>'.$addon_details['description'].'</b><br>';
  $result = @mysql_query("SELECT * FROM frndzk_addons WHERE name='$strip'");
  if ( @mysql_num_rows($result) > 0 ) {
  echo'(Active) <a href="addon.php?action=delete&registername='.$strip.'">Deactivate Addon</a></p><br>';
  }
  else {
  echo'(Deactive) <a href="addon.php?action=activate&registername='.$strip.'">Activate Addon</a></p><br>';
  }
  }
 }
 }
}
}
function activate_addon($i) {
$i=defence_sql_injection($i);
//check dir 
//path to directory to scan
$dir = "../xenon-addons/";
ob_start();
if (@include($dir.$i.'/xenon-addon-info.php')) {
ob_clean();
//finish check
$result = @mysql_query("SELECT * FROM frndzk_addons
WHERE name='$i'");
if ( !@mysql_num_rows($result) > 0 ) {
$query="INSERT INTO frndzk_addons VALUES ('','$i','true')";
mysql_query($query);
header('Location: addon.php?action=activate&registername='.$_GET['registername']);
}
}
}
function execute_xenon_addons() {
$result = @mysql_query("SELECT * FROM frndzk_addons");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
$dir = 'xenon-addons/'.$page['name'].'/';
@include($dir.'xenon-addon-functions.php');
}
}
}
function execute_xenon_addons_admin() {
$result = @mysql_query("SELECT * FROM frndzk_addons");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
@$oi=$page['name'];
@$dir = '../xenon-addons/'.$oi;
@include($dir.'/'.'xenon-addon-functions.php');
}
}
}
function delete_addon($i) {
$i=defence_sql_injection($i);
$result = @mysql_query("SELECT * FROM frndzk_addons
WHERE name='$i'");
if ( @mysql_num_rows($result) > 0 ) {
mysql_query("DELETE FROM frndzk_addons WHERE name='$i'");
header('Location: addon.php?action=delete&registername='.$_GET['registername']);
}
}
function get_addonpage($gi) {
global $admintitle;
global $addonfile;
if ( $admintitle == $gi ) {
//start
$result = @mysql_query("SELECT * FROM frndzk_addons");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
$dir = '../xenon-addons/'.@$page['name'].'/';
@include($dir.$admintitle.'.php');
}
}
else {
echo'Unauthorized access';
}
//finish 
}
else {
echo'Unauthorized access';
}
}
function xenon_addon_details($ad) {
global $addon_details;
$addon_details['name']=$ad['name'];
$addon_details['reg_name']=$ad['reg_name'];
$addon_details['description']="";
if(isset($ad['dev_name'])) {
$addon_details['dev_name']=$ad['dev_name'];
}
else { $addon_details['dev_name']=""; }
if(isset($ad['addon_url'])) {
$addon_details['addon_url']=$ad['addon_url'];
}
else { $addon_details['addon_url']=""; }
if(isset($ad['description'])) {
$addon_details['description']=$ad['description'];
}
}
function edit_addon_home() {
echo'<form method="post" action="edit-addon.php?action=edit">';
echo'<select name="xenon-theme">';
$result = @mysql_query("SELECT * FROM frndzk_addons");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
@$dir = '../xenon-addons/'.$page['name'].'/';
$files = glob($dir . "*.php");
if($files!="") {
foreach ( $files as $file )
{
$f=str_replace($dir,'',$file);
echo '<option value="'.$page['name'].','.$f.'">'.$page['name'].','.$f.'</option>';
}
}
$files = glob($dir . "*.css");
if($files!="") {
foreach ( $files as $file )
{
$f=str_replace($dir,'',$file);
echo '<option value="'.$page['name'].','.$f.'">'.$page['name'].','.$f.'</option>';
}
}
$files = glob($dir . "*.html");
if($files!="") {
foreach ( $files as $file )
{
$f=str_replace($dir,'',$file);
echo '<option value="'.$page['name'].','.$f.'">'.$page['name'].','.$f.'</option>';
}
}
}
}
echo'</select><input type="submit" name="save" value="Edit" /></form>';
}
function edit_addon_content() {
$i=$_POST['xenon-theme'];
$i=explode(',',$i);
echo'<form method="post" action="edit-addon.php?action=update">';
$result = @mysql_query("SELECT * FROM frndzk_addons WHERE name='$i[0]'");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
@$dir = '../xenon-addons/'.$page['name'].'/';
$files = glob($dir . "*.php");
if($files!="") {
foreach ( $files as $file )
{
$f=str_replace($dir,'',$file);
if ($f == $i[1]) { echo'Editing: '.$i[0].'/'.$i[1].'<br>';  echo'<input name="file" type="hidden" value="'.$f.'"><textarea name="content" rows="25" cols="90">'.@htmlspecialchars(@file_get_contents($file)).'</textarea>'; }
}
}
$files = glob($dir . "*.css");
if($files!="") {
foreach ( $files as $file )
{
$f=str_replace($dir,'',$file);
if ($f == $i[1]) { echo'Editing: '.$i[0].'/'.$i[1].'<br>'; echo'<input name="file" type="hidden" value="'.$f.'"><textarea name="content" rows="25" cols="90">'.@htmlspecialchars(@file_get_contents($file)).'</textarea>'; }
}
}
$files = glob($dir . "*.html");
if($files!="") {
foreach ( $files as $file )
{
$f=str_replace($dir,'',$file);
if ($f == $i[1]) { echo'Editing: '.$i[0].'/'.$i[1].'<br>'; echo'<input name="file" type="hidden" value="'.$f.'"><textarea name="content" rows="25" cols="90">'.@htmlspecialchars(@file_get_contents($file)).'</textarea>'; }
}
}
}
}
echo'<br><input type="submit" name="save" value="Save File" /></form>';
}
function edit_addon_action() {
$i=$_POST['file'];
$c=$_POST['content'];
$c=str_replace('\"','"',$c);
$c=str_replace("\'","'",$c);
$c = stripslashes($c);
$result = @mysql_query("SELECT * FROM frndzk_addons");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
@$dir = '../xenon-addons/'.$page['name'].'/';
$files = glob($dir . "*.php");
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
$files = glob($dir . "*.css");
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
$files = glob($dir . "*.html");
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
//Upload addon
function upload_addon($i) {
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

    if (file_exists("../xenon-addons/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../xenon-addons/" . $_FILES["file"]["name"]);
	  echo $_FILES['file']['name'];
$destination_dir = "../xenon-addons";

    $archive = new PclZip("../xenon-addons/" . $_FILES["file"]["name"]);
    if ($archive->extract(PCLZIP_OPT_PATH, $destination_dir) == 0) {
        die("Unzip failed. Error : ".$archive->errorInfo(true));
    }
	         unlink("../xenon-addons/" . $_FILES["file"]["name"]);
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
function upload_addon_int() {
echo ' 
<h4><form action="add-addon.php?action=upload" method="post"
enctype="multipart/form-data">
<label for="file">Select an Addon(allowed extentions: .zip file only) :</label>
<input type="file" name="file" id="file" />
<br />
<input type="submit" name="submit" value="Submit" />
</form></h4>';
}
?>