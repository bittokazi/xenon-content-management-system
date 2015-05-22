<?php
function general_content() {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id ='1'");
if ( @mysql_num_rows($result) > 0 ) {
echo'<h2>'; admin_title(); echo'</h2>';
while($general = @mysql_fetch_array($result)) {
echo'<form method="post" action="general.php?action=edit&id=1"><p>Site title: <textarea name="title" rows="1" cols="55" style="resize: none;">'.$general['title'].'</textarea></p>
<p>Site Tagline: <textarea name="tagline" rows="1" cols="55" style="resize: none;">'; echo$general['tagline']; echo'</textarea></p><input type="submit" name="save" value="Save" /></form>
';
}
}
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id ='5'");
if ( @mysql_num_rows($result) > 0 ) {
echo'';
while($general = @mysql_fetch_array($result)) {
echo'<form method="post" action="general.php?action=edit&id=5"><input type="hidden" name="title" value="front_page">
<p>Front Page: <select name="tagline"><option value="'.$general['tagline'].'">'.$general['tagline'].'</option><option value="xenon_latest_page">Latest Page</option>
';
}
}
$result = @mysql_query("SELECT * FROM frndzk_page");
if ( @mysql_num_rows($result) > 0 ) {
echo'';
while($general = @mysql_fetch_array($result)) {
echo'<option value="'.$general['shortname'].'">'.$general['page'].'</option>
';
}
}
echo'</select></p><input type="submit" name="save" value="Save" /></form>';
//blog page start
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id ='5'");
if ( @mysql_num_rows($result) > 0 ) {
echo'';
while($general = @mysql_fetch_array($result)) {
if($general['tagline']!="xenon_latest_page") {
$resultbp = @mysql_query("SELECT * FROM frndzk_title WHERE id ='6'");
while($generalbp = @mysql_fetch_array($resultbp)) {
echo'<form method="post" action="general.php?action=edit&id=6"><input type="hidden" name="title" value="blog_page">
<p>Blog Page: <select name="tagline"><option value="'.$generalbp['tagline'].'">'.$generalbp['tagline'].'</option><option value=""></option>
';
//page list
$resultpl = @mysql_query("SELECT * FROM frndzk_page");
if ( @mysql_num_rows($resultpl) > 0 ) {
echo'';
while($generalpl = @mysql_fetch_array($resultpl)) {
if ( $general['tagline']!=$generalpl['shortname']) {
echo'<option value="'.$generalpl['shortname'].'">'.$generalpl['page'].'</option>
';
}
}
}
//page list finish
}echo'</select></p><input type="submit" name="save" value="Save" /></form>';}}
}
//blog page finish
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE title = 'install_loc'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
echo'<p>Install Lication: <form method="post" action="general.php?action=edit&id=3"><input type="hidden" name="title" value="install_loc"><textarea name="tagline" rows="1" cols="55" style="resize: none;">'.$general['tagline'].'</textarea></p><input type="submit" name="save" value="Save" /></form>';
}
}
//install loc finish
echo'<form method="post" action="general.php?action=edit&id=4"><input type="hidden" name="title" value="install_loc">
<p>Permalink: <select name="tagline">';
$resultper = @mysql_query("SELECT * FROM frndzk_title
WHERE title = 'link_style'");
if ( @mysql_num_rows($resultper) > 0 ) {
while($generalper = @mysql_fetch_array($resultper)) {
if ($generalper['tagline']=="number") {
echo'<option value="number">'.home_url().'/?view=post&url=sample-post</option>';
echo'<option value="text">'.home_url().'/post/sample-post</option>';
}
elseif ($generalper['tagline']=="text") {
echo'<option value="text">'.home_url().'/post/sample-post</option>';
echo'<option value="number">'.home_url().'/?view=post&url=sample-post</option>';
}
}
}
echo'</select></p><input type="submit" name="save" value="Save" /></form>';
//permalink finish
echo'<form method="post" action="general.php?action=edit&id=7"><input type="hidden" name="title" value="default_signup">
<p>Default user role on signup: <select name="tagline">';
$resultper = @mysql_query("SELECT * FROM frndzk_title
WHERE title = 'default_signup'");
if ( @mysql_num_rows($resultper) > 0 ) {
while($generalper = @mysql_fetch_array($resultper)) {
if ($generalper['tagline']=="user") {
echo'<option value="user">User</option>';
echo'<option value="moderator">Moderator</option>';
echo'<option value="administrator">Administrator</option>';
}
elseif ($generalper['tagline']=="moderator") {
echo'<option value="moderator">Moderator</option>';
echo'<option value="administrator">Administrator</option>';
echo'<option value="user">User</option>';
}
elseif ($generalper['tagline']=="administrator") {
echo'<option value="administrator">Administrator</option>';
echo'<option value="user">User</option>';
echo'<option value="moderator">Moderator</option>';
}
}
}
echo'</select></p><input type="submit" name="save" value="Save" /></form>';
//signup user role
$result = @mysql_query("SELECT * FROM frndzk_commenton
WHERE id = '1'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
echo'<p>Signup: '; if($general['commenter']=="true") { $value="ON"; } else { $value="OFF"; } echo$value.' (<a href="general.php?num=1&action=onoff&turn=true">ON</a> / <a href="general.php?num=1&action=onoff&turn=false">OFF</a> )</p>';
}
}
$result = @mysql_query("SELECT * FROM frndzk_commenton
WHERE id = '2'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
echo'<p>Login: '; if($general['commenter']=="true") { $value="ON"; } else { $value="OFF"; } echo$value.' (<a href="general.php?num=2&action=onoff&turn=true">ON</a> / <a href="general.php?num=2&action=onoff&turn=false">OFF</a> )</p>';
}
}
$result = @mysql_query("SELECT * FROM frndzk_commenton
WHERE id = '3'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
echo'<p>Comment: '; if($general['commenter']=="true") { $value="ON"; } else { $value="OFF"; } echo$value.' (<a href="general.php?num=3&action=onoff&turn=true">ON</a> / <a href="general.php?num=3&action=onoff&turn=false">OFF</a> )</p>';
}
}
$result = @mysql_query("SELECT * FROM frndzk_commenton
WHERE id = '4'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
echo'<p>File-Upload: '; if($general['commenter']=="true") { $value="ON"; } else { $value="OFF"; } echo$value.' (<a href="general.php?num=4&action=onoff&turn=true">ON</a> / <a href="general.php?num=4&action=onoff&turn=false">OFF</a> )</p>';
}
}
}
function update_general($num, $tf) {
if ( $num==1 || $num==2 || $num==3 || $num==4 ) {
$nums=defence_sql_injection($num);
$tfs=defence_sql_injection($tf);
$result = @mysql_query("SELECT * FROM frndzk_commenton
WHERE id = '$nums'");
if ( @mysql_num_rows($result) > 0 ) {
$query="UPDATE frndzk_commenton SET commenter = '$tfs'
WHERE id = '$nums'";
mysql_query($query);
echo "Update Successful<br>";
}
}
}
function generator() {
return'
<script type="text/javascript" src="'.home_url().'/xenon-core/js/jquery-1.10.1.min.js"></script>
<meta name="generator" content="Xenon web engine" />
<meta name="About Generator" content="Xenon web engine is made in Bangladesh" />
<meta name="Developer" content="Bitto Kazi" />';
}
xenon_core("xenon_header", "generator");
function update_general_title($id, $t, $tg) {
if ( $id==1 ) {
$ids=defence_sql_injection($id);
$ts=defence_sql_injection($t);
$tgs=defence_sql_injection($tg);
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '$ids'");
if ( @mysql_num_rows($result) > 0 ) {
$query="UPDATE frndzk_title SET title = '$ts'
WHERE id = '$ids'";
mysql_query($query);
$query="UPDATE frndzk_title SET tagline = '$tgs'
WHERE id = '$ids'";
mysql_query($query);
echo "Update Successful<br>";
}
}
elseif ( $id==5 ) {
$ids=defence_sql_injection($id);
$ts=defence_sql_injection($t);
$tgs=defence_sql_injection($tg);
if ($tgs=="xenon_latest_page") {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '$ids'");
if ( @mysql_num_rows($result) > 0 ) {
$query="UPDATE frndzk_title SET tagline = '$tgs'
WHERE id = '$ids'";
mysql_query($query);
$query="UPDATE frndzk_title SET tagline = ''
WHERE id = '6'";
mysql_query($query);
echo "Front PAGE Update Successful<br>";
}
}
else {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '$ids'");
if ( @mysql_num_rows($result) > 0 ) {
$query="UPDATE frndzk_title SET tagline = '$tgs'
WHERE id = '$ids'";
mysql_query($query);
echo "Front PAGE Update Successful<br>";
}
}
}
elseif ( $id==3 ) {
$ids=defence_sql_injection($id);
$ts=defence_sql_injection($t);
$tgs=defence_sql_injection($tg);
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '$ids'");
if ( @mysql_num_rows($result) > 0 ) {
$query="UPDATE frndzk_title SET tagline = '$tgs'
WHERE id = '$ids'";
mysql_query($query);
echo "Update Successful...<br>";

$addrs=str_replace($_SERVER['SERVER_NAME'],"",$tgs);
$addrs=str_replace("www.","",$addrs);
$addrs=str_replace("http://","",$addrs);
$addrs=str_replace("https://","",$addrs);
$addrs=str_replace("xenon-admin","",$addrs);
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
$bitto = "../.htaccess";
$fh = fopen($bitto, 'w') or die("can't open file");
$stringData = "$lol";
fwrite($fh, $stringData);
fclose($fh);



}
}
elseif ( $id==4 ) {
$ids=defence_sql_injection($id);
$ts=defence_sql_injection($t);
$tgs=defence_sql_injection($tg);
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '$ids'");
if ( @mysql_num_rows($result) > 0 ) {
$query="UPDATE frndzk_title SET tagline = '$tgs'
WHERE id = '$ids'";
mysql_query($query);
echo "Update Successful<br>";
}
}
elseif ( $id==6 ) {
$ids=defence_sql_injection($id);
$ts=defence_sql_injection($t);
$tgs=defence_sql_injection($tg);
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '$ids'");
if ( @mysql_num_rows($result) > 0 ) {
$query="UPDATE frndzk_title SET tagline = '$tgs'
WHERE id = '$ids'";
mysql_query($query);
echo "Update Successful<br>";
}
}
elseif ( $id==7 ) {
$ids=defence_sql_injection($id);
$ts=defence_sql_injection($t);
$tgs=defence_sql_injection($tg);
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '$ids'");
if ( @mysql_num_rows($result) > 0 ) {
$query="UPDATE frndzk_title SET tagline = '$tgs'
WHERE id = '$ids'";
mysql_query($query);
echo "Update Successful<br>";
}
}
}
?>