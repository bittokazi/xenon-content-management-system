<?php
function add_user_content() {
echo'<h2>'; admin_title(); echo'</h2>
<script type="text/javascript"> 
function validateForm() 
{ 
var x=document.forms["signup"]["email"].value; 
var atpos=x.indexOf("@"); 
var dotpos=x.lastIndexOf("."); 
if (atpos<2 || dotpos<atpos+2 || dotpos+1>=x.length) 
  { 
  alert("Not a valid e-mail address"); 
  return false; 
  } 
var d=document.forms["signup"]["password"].value; 
var g = d.length; 
if (g<6) 
  { 
  alert("password must be more than 5 charecters"); 
  return false; 
  }
var e=document.forms["signup"]["title"].value; 
var f = e.length; 
if (f<5) 
  { 
  alert("username must be more than 4 charecters"); 
  return false; 
  } 
} 
</script> 
<form method="post" onsubmit="return validateForm()"  name="signup" action="add-user.php?action=add">
<p>Username: <textarea name="title" rows="1" cols="55" style="resize: none;"></textarea></p>
<p>Password: <textarea name="password" rows="1" cols="55" style="resize: none;"></textarea></p>
<p>Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="email" rows="1" cols="55" style="resize: none;"></textarea></p>
<p>Fullname: <textarea name="fullname" rows="1" cols="55" style="resize: none;"></textarea></p>
<p>Website: <textarea name="website" rows="1" cols="55" style="resize: none;"></textarea></p>
<p>User Role: <select name="userrole">
<option value="administrator">administrator</option>
<option value="moderator">moderator</option>
<option value="user">user</option>
<select></p>
<input type="submit" name="save" value="Save" /></form>';
}
function add_user_action() {
$username=defence_sql_injection($_POST['title']);
$password=defence_sql_injection($_POST['password']);
$countpass=strlen($password);
$password=hash('sha512',sha1(md5($password)));
$fullname=defence_sql_injection($_POST['fullname']);
$website=defence_sql_injection($_POST['website']);
$email=defence_sql_injection($_POST['email']);
$userrole=defence_sql_injection($_POST['userrole']);
$username=strtolower($username);
$oppbadchars=str_split($username);
$oppbadcharemails=str_split($email);
$iye=0;
$iyee=0;
$iyu=0;
foreach ( $oppbadchars as $oppbadchar ) {
if ( $oppbadchar == "." || $oppbadchar == " " || $oppbadchar == "~" || $oppbadchar == "!" || $oppbadchar == "@" || $oppbadchar == "#" || $oppbadchar == "%" || $oppbadchar == "^" || $oppbadchar == "&" || $oppbadchar == "*" || $oppbadchar == "+" || $oppbadchar == "'" || $oppbadchar == '"' || $oppbadchar == ')' || $oppbadchar == '(' || $oppbadchar == '{' || $oppbadchar == '}' || $oppbadchar == '[' || $oppbadchar == ']' || $oppbadchar == '$' || $oppbadchar == '|' || $oppbadchar == '`' || $oppbadchar == '=' || $oppbadchar == '?' || $oppbadchar == '>' || $oppbadchar == '<' || $oppbadchar == ',') { $iyu=1; echo'Dont use .~!@#$%^&*()_+{}()[] in username'; break; }
else {
}
}
foreach ( $oppbadcharemails as $oppbadcharemail ) {
if ( $oppbadcharemail == "@" ) {
$iyee=$iyee+1;
}
}
if ($iyu==0 && $iyee==1 && $countpass > 5) {
$result = @mysql_query("SELECT * FROM frndzk_admin
WHERE username ='$username'");
$result1 = @mysql_query("SELECT * FROM frndzk_admin
WHERE email ='$email'");
if ( @mysql_num_rows($result) > 0 || @mysql_num_rows($result1) > 0 ) {
echo"<br>Username or Email already exist. Please chose another one<br>";
}
else {
$query="INSERT INTO frndzk_admin VALUES ('','$username','$password','$fullname','$website','$email','$userrole')";
@mysql_query($query);
echo"<br>Username Added Successfully<br>";
}
}
else {
echo'<br>Password must be more than 5 char long, give email correctly';
}
}
function userlist() {
$c=50;
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
						<th class="first" width="177">Username</th>
						<th>Email</th>
						<th>User Role</th>
						<th>Post Count</th>
						<th>Edit</th>
						<th class="last">Delete</th>
					</tr>';
$result = @mysql_query("SELECT * FROM frndzk_admin ORDER by id desc");
					$postc=@mysql_num_rows($result);
while ( $c < $postc ) {
$c=$c+$e;
}
$g=$c/50;
$start=50*($p-1);
$finish=50*$p;
if ( $finish > $postc ) { $finish=$finish-($finish-$postc); $gy=$finish-$start; $postc=$gy; }
else { $postc=$e; }
$finish=50;
$result = @mysql_query("SELECT * FROM frndzk_admin ORDER by id desc LIMIT $start,$finish");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
					echo'<tr>
						<td class="first style1"><a target="_blank" href="'.home_url().'/'.xenon_link_author().$pages['username'].'">' . $pages['username'] . '</a></td>
						<td>' . $pages['email'] . '</td>
						<td>' . $pages['position'] . '</td>';
						
$pc111bk = @mysql_query("SELECT * FROM frndzk_post WHERE postedby='$pages[username]'");
if ( @mysql_num_rows($pc111bk) > 0 ) {
echo '<td>'.@mysql_num_rows($pc111bk).'</td>';
}
else {
echo'<td>0</td>';
}
						
						echo'
						<td><a href="profile.php?action=edit&number=edit&id=' . $pages['id'] . '"><img src="img/save-icon.gif" width="16" height="16" alt="" /></a></td>
						<td><a href="profile.php?action=delete&number=single&id=' . $pages['id'] . '"><img src="img/hr.gif" width="16" height="16" alt="" /></a></td>
						</tr>'; }
				}
				echo'</table>';
				$c=1;
$ccc=$p-5;
$ccf=$p+5;
if($ccc<1) { $ccc=1; }
if($ccf>$g) { $ccf=$g; }
while ( $ccc <= $ccf ) {
	echo '<a href="user.php?p='.$ccc.'">Page '.$ccc.'</a> | ';
	$ccc++;
}
echo'&nbsp;Total Pages>>'.$g;
}
function edit_user($id) {
$ids=defence_sql_injection($id);
$username2234=user_name();
if ( user_roll() == "administrator" ) {
$result = @mysql_query("SELECT * FROM frndzk_admin
WHERE id ='$ids'");
}
elseif ( user_roll() == "user" || user_roll() == "moderator" ) {
$result = @mysql_query("SELECT * FROM frndzk_admin
WHERE id ='$ids' and username='$username2234'");
}
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
echo'<h2>Edit Profile'; echo'</h2>
<h4>Editing User: '.$page['username'].'</h4>

<form method="post" action="profile.php?action=pass&number=update">
<input type=hidden name=id value='.$page['id'].'>
<p>Password: <textarea name="password" rows="1" cols="55" style="resize: none;"></textarea></p>
<input type="submit" name="save" value="Save" /></form>

<form method="post" action="profile.php?action=edit&number=update">
<input type=hidden name=id value='.$page['id'].'>
<input type=hidden name="un" value='.$page['username'].'>
<p>Email: <textarea name="email" rows="1" cols="55" style="resize: none;">'.$page['email'].'</textarea></p>
<p>Fullname: <textarea name="fullname" rows="1" cols="55" style="resize: none;">'; echo$page['name']; echo'</textarea></p>
<p>Website: <textarea name="website" rows="1" cols="55" style="resize: none;">'.$page['website'].'</textarea></p>';
if ( user_roll() == "administrator" ) {
echo'<p>User Role: <select name="userrole">
<option value="'.$page['position'].'">'.$page['position'].'</option>
<option value="administrator">administrator</option>
<option value="moderator">moderator</option>
<option value="user">user</option>
<option value="suspend">suspend</option>
<select></p>';
}
else{
}
echo'<input type="submit" name="save" value="Save" /></form>';
}
}
media_upload_int_profile();
}
function profile() {
echo'<h2>My Profile'; echo'</h2>';
$username2234=user_name();
$result = @mysql_query("SELECT * FROM frndzk_admin WHERE username='$username2234'");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
$resulta = @mysql_query("SELECT * FROM frndzk_file WHERE mdby='$username2234'");
if ( @mysql_num_rows($resulta) > 0 ) {
while($pagea = @mysql_fetch_array($resulta))
{
echo'<p><img src="'.home_url().'/xenon-upload/'.$pagea['url'].'"></p>';
}
}
echo'<h4>Username: '.$page['username'].'</h4>
<h4>Email: '.$page['email'].'</h4>
<h4>Fullname: '.$page['name'].'</h4>
<h4>Website: '.$page['website'].'</h4>
<h4>User role: '.$page['position'].'</h4>';
$pc111bk = @mysql_query("SELECT * FROM frndzk_post WHERE postedby='$page[username]'");
if ( @mysql_num_rows($pc111bk) > 0 ) {
echo '<h4>Post Count: '.@mysql_num_rows($pc111bk).'</h4>';
}
else {
echo'<h4>Post count: 0</h4>';
}
echo'<p><a href="profile.php?action=edit&number=edit&id=' . $page['id'] . '">Edit profile</a></p>
';
}
}
}
function author_title() {
if (isset($_GET['url'])) {
$d=strip_tags(defence_sql_injection($_GET['url']));
}
else{
$d="";
}
$result = @mysql_query("SELECT * FROM frndzk_post WHERE postedby='$d'");
if ( @mysql_num_rows($result) > 0 ) {
return $d;
}
else {
return'not found';
}
}
function xenon_signup_field() {
$result = @mysql_query("SELECT * FROM frndzk_commenton
WHERE id = '1'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if($general['commenter']=="true") {
if (isset($_POST['title']) && $_POST['title']!="" && isset($_POST['password']) && $_POST['password']!="" && isset($_POST['email']) && $_POST['email']!="") {
add_user_action();
}
else {
echo'<p>Something went wrong</p> 
'; }
echo'</h2>
<script type="text/javascript"> 
function validateForm() 
{ 
var x=document.forms["signup"]["email"].value; 
var atpos=x.indexOf("@"); 
var dotpos=x.lastIndexOf("."); 
if (atpos<2 || dotpos<atpos+2 || dotpos+1>=x.length) 
  { 
  alert("Not a valid e-mail address"); 
  return false; 
  } 
var d=document.forms["signup"]["password"].value; 
var g = d.length; 
if (g<6) 
  { 
  alert("password must be more than 5 charecters"); 
  return false; 
  }
var e=document.forms["signup"]["title"].value; 
var f = e.length; 
if (f<5) 
  { 
  alert("username must be more than 4 charecters"); 
  return false; 
  } 
} 
</script>
<form method="post" onsubmit="return validateForm()"  name="signup" action="">
<p>Username: <textarea name="title" rows="1" cols="55" style="resize: none;"></textarea></p>
<p>Password: <textarea name="password" rows="1" cols="55" style="resize: none;"></textarea></p>
<p>Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="email" rows="1" cols="55" style="resize: none;"></textarea></p>
<p>Fullname: <textarea name="fullname" rows="1" cols="55" style="resize: none;"></textarea></p>
<p>Website: <textarea name="website" rows="1" cols="55" style="resize: none;"></textarea></p>
<p>User Role: <select name="userrole">';
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE title = 'default_signup' AND id='7'");
if ( @mysql_num_rows($result) > 0 ) {
while($generalper = @mysql_fetch_array($result)) {
if ($generalper['tagline']=="user") {
echo'<option value="user">User</option>';
}
elseif ($generalper['tagline']=="moderator") {
echo'<option value="moderator">Moderator</option>';
}
elseif ($generalper['tagline']=="administrator") {
echo'<option value="administrator">Administrator</option>';
}
}
}
echo'<select></p>
<input type="submit" name="save" value="Save" /></form>';
}
else {
echo'Signup is Disabled';
}
}
}
}
function xenon_user_profile($username2234,$array) {
if(isset($array['img_height']) && $array['img_height']='yes') {} else {$array['img_height']='128px';}
if(isset($array['img_width']) && $array['img_height']='yes') {} else {$array['img_width']='128px';}
if(isset($array['email']) && $array['email']=='yes' ) {} else {$array['email']='no';}
if(isset($array['website']) && $array['website']=='yes' ) {} else {$array['website']='no';}
if(isset($array['fullname']) && $array['fullname']=='yes' ) {} else {$array['fullname']='no';}
if(isset($array['role']) && $array['role']=='yes' ) {} else {$array['role']='no';}
$result = @mysql_query("SELECT * FROM frndzk_admin WHERE username='$username2234'");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
echo'<h4>Username: '.$page['username'].'</h4>
<h4>Email: '.$page['email'].'</h4>
<h4>Fullname: '.$page['name'].'</h4>
<h4>Website: '.$page['website'].'</h4>
<h4>User role: '.$page['position'].'</h4>';
$pc111bk = @mysql_query("SELECT * FROM frndzk_post WHERE postedby='$page[username]'");
if ( @mysql_num_rows($pc111bk) > 0 ) {
echo '<h4>Post Count: '.@mysql_num_rows($pc111bk).'</h4>';
}
else {
echo'<h4>Post count: 0</h4>';
}
echo'<p><a href="profile.php?action=edit&number=edit&id=' . $page['id'] . '">Edit profile</a></p>
';
}
}
}
function user_profile_picture($username2234,$array) {
if(isset($array['img_height']) && $array['img_height']='yes') {} else {$array['img_height']='128px';}
if(isset($array['img_width']) && $array['img_height']='yes') {} else {$array['img_width']='128px';}
$result = @mysql_query("SELECT * FROM frndzk_admin WHERE username='$username2234'");
if ( @mysql_num_rows($result) > 0 ) {
$resulta = @mysql_query("SELECT * FROM frndzk_file WHERE mdby='$username2234'");
if ( @mysql_num_rows($resulta) > 0 ) {
while($pagea = @mysql_fetch_array($resulta))
{
echo'<p style="border-width:3px; border-color:#A9A9A9; border-style:solid;"><img height="'.$array['img_height'].'" width="'.$array['img_width'].'" src="'.home_url().'/xenon-upload/'.$pagea['url'].'"></p>';
}
}
}
}
?>