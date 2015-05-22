<?php
function media_upload_int() {
echo ' 
<h4><form action="media.php?action=upload" method="post"
enctype="multipart/form-data">
<label for="file">Select a image/video(allowed extentions:  file only) :</label>
<input type="file" name="file" id="file" />
<br />
<input type="submit" name="submit" value="Submit" />
</form></h4>
<h5><a href="?action=view">Image/Video/File List</a></h5>';
}
function media_upload_int_profile() {
echo ' 
<h4><form action="profile.php?action=upload" method="post"
enctype="multipart/form-data">
<label for="file">Select a image for profile picture(allowed extentions:  file only) :</label>
<input type="file" name="file" id="file" />
<br />
<input type="submit" name="submit" value="Submit" />
</form></h4>';
}
//Upload media
function genRandomStringmu() {
    $length = 40;
    $characters = "0123456789abcdefghijklmnopqrstuvwxyz";
    $string = '';    
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters)-1)];
    }
    return $string;
}
function upload_media($i) {
$name=genRandomStringmu();
$_FILES['file']['name']=$i;
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
if ($extension == "bmp" || $extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif")
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {

    if (file_exists("../xenon-upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
//tree
if($extension=="jpg" || $extension=="jpeg" )
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefromjpeg($uploadedfile);

}
elseif($extension=="png")
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefrompng($uploadedfile);
}
elseif($extension=="bmp")
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefrombmp($uploadedfile);
}
else 
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefromgif($uploadedfile);
}
list($width,$height)=getimagesize($uploadedfile);
$newwidth=400;
$newheight=400;
$tmp=imagecreatetruecolor($newwidth,$newheight);
imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
$filename1="../xenon-upload/xenon_cms_media_".$name.'.'.$extension;
if($extension=="jpg" || $extension=="jpeg" )
{
imagejpeg($tmp,$filename1,100);
}
elseif($extension=="png")
{
imagepng($tmp,$filename1,9);
}
elseif($extension=="bmp")
{
imagebmp($tmp,$filename1,100);
}
else 
{
imagegif($tmp,$filename1,100);
}
imagedestroy($src);
imagedestroy($tmp);
//free
	  $mdby=user_name();
	  $url='xenon_cms_media_'.$name.'.'.$extension;
	  if (file_exists("../xenon-upload/xenon_cms_media_".$name.'.'.$extension))
      {
	  $query="INSERT INTO frndzk_media VALUES ('','$url','$mdby')";
@mysql_query($query);
echo $_FILES['file']['name'].' was successfully uploaded';
}
     }
}
    }
	elseif ($extension == "3gp" || $extension == "mp4" || $extension == "avi")
  {
    if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
	move_uploaded_file($_FILES["file"]["tmp_name"],
      "../xenon-upload/xenon_cms_media_".$name.'.'.$extension);
	  $mdby=user_name();
	  $url='xenon_cms_media_'.$name.'.'.$extension;
	  if (file_exists("../xenon-upload/xenon_cms_media_".$name.'.'.$extension))
      {
	  $query="INSERT INTO frndzk_media VALUES ('','$url','$mdby')";
@mysql_query($query);
echo $_FILES['file']['name'].' was successfully uploaded';
	}
  }
  }
  	elseif ($extension == "pdf" || $extension == "zip" ||  $extension == "rar" || $extension == "doc")
  {
  $result = @mysql_query("SELECT * FROM frndzk_commenton
WHERE id = '4'");
  if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
    if($general['commenter']=="true" || user_roll() == "administrator") {
    if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
	move_uploaded_file($_FILES["file"]["tmp_name"],
      "../xenon-upload/xenon_cms_media_".$name.'.'.$extension);
	  $mdby=user_name();
	  $url='xenon_cms_media_'.$name.'.'.$extension;
	  if (file_exists("../xenon-upload/xenon_cms_media_".$name.'.'.$extension))
      {
	  $query="INSERT INTO frndzk_media VALUES ('','$url','$mdby')";
@mysql_query($query);
echo $_FILES['file']['name'].' was successfully uploaded';
}
	}
	}
	else
  {
  echo "File Upload Disabled but Image and Videos can be uploaded";
  }
	}
	}
  }
else
  {
  echo "Invalid file extention";
  }
  
}
//list media
function list_media() {
$un=user_name();
function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
$c=100;
$e=$c;
if(isset($_GET['p']) && !$_GET['p'] == "" ) {
$p=$_GET['p'];
}
else {
$p=1;
}
echo'
<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">ID</th>
						<th>Image</th>
						<th>Image Link</th>
						<th class="last">Delete</th>
					</tr>';
					if ( user_roll()=="administrator" || user_roll()=="moderator" ) {
$result = @mysql_query("SELECT * FROM frndzk_media ORDER by id desc");
					$postc=@mysql_num_rows($result);
while ( $c < $postc ) {
$c=$c+$e;
}
$g=$c/100;
$start=100*($p-1);
$finish=100*$p;
if ( $finish > $postc ) { $finish=$finish-($finish-$postc); $gy=$finish-$start; $postc=$gy; }
else { $postc=$e; }
$result = @mysql_query("SELECT * FROM frndzk_media ORDER by id desc  LIMIT $start,$finish");
}
else {
$un=user_name();
$result = @mysql_query("SELECT * FROM frndzk_media WHERE mdby='$un' ORDER by id desc");
					$postc=@mysql_num_rows($result);
while ( $c < $postc ) {
$c=$c+$e;
}
$g=$c/100;
$start=100*($p-1);
$finish=100*$p;
if ( $finish > $postc ) { $finish=$finish-($finish-$postc); $gy=$finish-$start; $postc=$gy; }
else { $postc=$e; }
$result = @mysql_query("SELECT * FROM frndzk_media WHERE mdby='$un' ORDER by id desc LIMIT $start,$finish");
}
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
					echo'<tr>
						<td class="first style1">' . $pages['id'] . '</td>';
						if ( getExtension($pages['url']) == 'bmp' || getExtension($pages['url']) == 'png' || getExtension($pages['url']) == 'jpeg' || getExtension($pages['url']) == 'jpg' || getExtension($pages['url']) == 'gif' ) {
					echo'<td><img height="28px" wideth="28px" src="'.home_url().'/xenon-upload/'. $pages['url'] . '"></td>';
						}
						else {
						echo'<td>'.getExtension($pages['url']).'</td>';
						}
					echo'<td><a href="'.home_url().'/xenon-upload/'. $pages['url'] . '" target="_blank">Copy Link</a></td>
						<td><a href="media.php?action=delete&number=single&id=' . $pages['id'] . '"><img src="img/hr.gif" width="16" height="16" alt="" /></a></td>
						</tr>'; }
				}
				echo'</table>';
				$c=1;
while ( $c <= $g ) {
	echo '<a href="media.php?p='.$c.'">Page '.$c.'</a> ';
	$c++;
}
}
function delete_image() {
$id=defence_sql_injection($_GET['id']);
if ( user_roll()=="administrator" || user_roll()=="moderator" ) {
$result = @mysql_query("SELECT * FROM frndzk_media WHERE id='$id' ORDER by id desc");
}
else {
$un=user_name();
$result = @mysql_query("SELECT * FROM frndzk_media WHERE id='$id' AND mdby='$un' ORDER by id desc");
}
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$uu=home_url().'/';
$del=str_replace($uu,'../',$pages['url']);
@unlink($del);
$query="DELETE FROM frndzk_media WHERE id = '$id'";
mysql_query($query);
}
}
}
//pro pic uploAD
function upload_media_pro($i) {
$name=user_name();
$_FILES['file']['name']=$i;
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
if ($extension == "bmp" || $extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif")
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
//tree
if($extension=="jpg" || $extension=="jpeg" )
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefromjpeg($uploadedfile);

}
elseif($extension=="png")
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefrompng($uploadedfile);
}
elseif($extension=="bmp")
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefrombmp($uploadedfile);
}
else 
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefromgif($uploadedfile);
}
list($width,$height)=getimagesize($uploadedfile);
$newwidth=128;
$newheight=128;
$tmp=imagecreatetruecolor($newwidth,$newheight);
imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
$filename1="../xenon-upload/xenon_cms_profile_".$name.'.'.$extension;
if($extension=="jpg" || $extension=="jpeg" )
{
imagejpeg($tmp,$filename1,100);
}
elseif($extension=="png")
{
imagepng($tmp,$filename1,9);
}
elseif($extension=="bmp")
{
imagebmp($tmp,$filename1,100);
}
else 
{
imagegif($tmp,$filename1,100);
}
imagedestroy($src);
imagedestroy($tmp);
//free
	  $mdby=user_name();
	  $url='xenon_cms_profile_'.$name.'.'.$extension;
	  if (file_exists("../xenon-upload/xenon_cms_profile_".$name.'.'.$extension))
      {
	  $resulta = @mysql_query("SELECT * FROM frndzk_file WHERE mdby='$mdby'");
if ( @mysql_num_rows($resulta) > 0 ) {
$query="UPDATE frndzk_file SET url = '$filename1'
WHERE mdby='$mdby'";
mysql_query($query);
echo 'Profile photo successfully uploaded';
}
else {
	  $query="INSERT INTO frndzk_file VALUES ('','$url','$mdby','$name')";
@mysql_query($query);
echo 'Profile photo successfully uploaded';
}
}
}
    }
else
  {
  echo "Invalid file extention";
  }
  
}
?>