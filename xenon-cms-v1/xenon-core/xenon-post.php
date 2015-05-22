<?php
function post_deleted() {
if(isset($_GET['deleted']) && $_GET['deleted']=="single") {
echo"deleted the post successfully<br><br>";
}
}
global $catsname;
global $icats;
$icats=1;
$result = @mysql_query("SELECT * FROM frndzk_category");
if ( @mysql_num_rows($result) > 0 ) {
while($cat = @mysql_fetch_array($result)) {
$icats=$icats+1;
$catsname[$icats]='' . $cat['name'] . '';
}
}
function add_post_content() {
global $catsname;
echo'<h2>Add New Post'; echo'</h2><form method="post" action="add-post.php?action=add">
<p>Post Name: <textarea name="title" rows="1" cols="55" style="resize: none;"></textarea></p>
<p>Post Summury: <textarea name="comment" rows="1" cols="55" style="resize: none;"></textarea></p>
<p>Post Content:
<div style="width:100px;"><textarea class="tinymces" id="elm1" name="content" rows="20" cols="10" style="width: 50%">				
Xenon Content Management System
			</textarea></div></p>
<p>Tags: <textarea name="tags" rows="1" cols="55" style="resize: none;" id="tag"></textarea></p>
<p>Select Category: <select name="category">';
            $result = @mysql_query("SELECT * FROM frndzk_category");
if ( @mysql_num_rows($result) > 0 ) {
while($cat = @mysql_fetch_array($result)) {
echo'<option value="'.$cat['shortname'].'">'.$cat['name'].'</option>';
}
}
			echo'</select></p><p>Enable Comment: <select name="comstts"><option value="yes">Yes</option><option value="no">No</option></select></p>
<input type="submit" name="save" value="Save" /></form>';
}
function add_post_action() {
$title=defence_sql_injection($_POST['title']);
$content=defence_sql_injection($_POST['content']);
$comment=defence_sql_injection($_POST['comment']);
$comstts=$_POST['comstts'];
$tags=defence_sql_injection($_POST['tags']);
$tags=strtolower($tags);
$tags=str_replace(', ', ',', $tags);
$tags=str_replace(' ', '_', $tags);
$tags=str_replace("'", '_', $tags);
$tags=str_replace('/', '_', $tags);
$tags=str_replace('.', '_', $tags);
$tags=str_replace('?', '_', $tags);
$tags=str_replace('&', '_', $tags);
$tags=str_replace(";", '_', $tags);
$tags=str_replace("!", '_', $tags);
$tags=str_replace("#", '_', $tags);
$tags=str_replace("+", '_', $tags);
$tags=str_replace("$", '_', $tags);
$tags=str_replace("%", '_', $tags);
$tags=str_replace("*", '_', $tags);
$tags=str_replace('"', '_', $tags);
$tags=str_replace('=', '_', $tags);
$tags=str_replace('`', '_', $tags);
$tags=str_replace('~', '_', $tags);
$tags=str_replace('(', '_', $tags);
$tags=str_replace(')', '_', $tags);
$tags=str_replace('{', '_', $tags);
$tags=str_replace('}', '_', $tags);
$tags=str_replace('[', '_', $tags);
$tags=str_replace(']', '_', $tags);
$tags=str_replace('|', '_', $tags);
$tags=str_replace('<', '_', $tags);
$tags=str_replace('>', '_', $tags);
$tags=str_replace('@', '_', $tags);
$tags=str_replace('^', '_', $tags);
$tags=str_replace('_', '-', $tags);
$shortname=str_replace(' ', '_', $title);
$shortname=strtolower($shortname);
$shortname=str_replace("'", '_', $shortname);
$shortname=str_replace('/', '_', $shortname);
$shortname=str_replace('.', '_', $shortname);
$shortname=str_replace('?', '_', $shortname);
$shortname=str_replace('&', '_', $shortname);
$shortname=str_replace(";", '_', $shortname);
$shortname=str_replace("!", '_', $shortname);
$shortname=str_replace("#", '_', $shortname);
$shortname=str_replace("+", '_', $shortname);
$shortname=str_replace("$", '_', $shortname);
$shortname=str_replace("%", '_', $shortname);
$shortname=str_replace("*", '_', $shortname);
$shortname=str_replace('"', '_', $shortname);
$shortname=str_replace('=', '_', $shortname);
$shortname=str_replace('`', '_', $shortname);
$shortname=str_replace('~', '_', $shortname);
$shortname=str_replace('(', '_', $shortname);
$shortname=str_replace(')', '_', $shortname);
$shortname=str_replace('{', '_', $shortname);
$shortname=str_replace('}', '_', $shortname);
$shortname=str_replace('[', '_', $shortname);
$shortname=str_replace(']', '_', $shortname);
$shortname=str_replace('|', '_', $shortname);
$shortname=str_replace('<', '_', $shortname);
$shortname=str_replace('>', '_', $shortname);
$shortname=str_replace('@', '_', $shortname);
$shortname=str_replace('^', '_', $shortname);
$shortname=str_replace(',', '_', $shortname);
$shortname=str_replace('&#10;', '_', $shortname);
$shortname=str_replace('\_', '_', $shortname);
$shortname=str_replace('_', '-', $shortname);
$catname=$_POST['category'];
$postedby=user_name();
$sname=$shortname;
$result = @mysql_query("SELECT * FROM frndzk_post
WHERE shortname = '$shortname'");
$ijj=1;
if ( @mysql_num_rows($result) > 0 ) {
while ( @mysql_num_rows($result) > 0 )
{
$shortname=$sname.$ijj;
$result = @mysql_query("SELECT * FROM frndzk_post
WHERE shortname = '$shortname'");
$ijj=$ijj+1;
}
}
$query="INSERT INTO frndzk_post VALUES ('','$title','$shortname','$content','$comment','$comstts',CURDATE(),CURTIME(),'$postedby','$catname','$tags')";
@mysql_query($query);
}
//postlist
function postlist() {
global $catsname;
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
						<th class="first" width="177">Page Name</th>
						<th>Posted By</th>
						<th>Enable Comment</th>
						<th>View Count</th>
						<th>Edit</th>
						<th class="last">Delete</th>
					</tr>';
					$user_name2234=user_name();
					if ( user_roll() == "administrator" || user_roll() == "moderator" ) {
					$result = @mysql_query("SELECT * FROM frndzk_post ORDER by id desc");
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
$result = @mysql_query("SELECT * FROM frndzk_post ORDER by id desc LIMIT $start,$finish");
					}
					else {
$result = @mysql_query("SELECT * FROM frndzk_post WHERE postedby='$user_name2234' ORDER by id desc");
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
$result = @mysql_query("SELECT * FROM frndzk_post WHERE postedby='$user_name2234' ORDER by id desc LIMIT $start,$finish");
}
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
					echo'<tr>
						<td class="first style1"><a target="_blank" href="'.home_url().'/'.xenon_link_post().$pages['shortname'].'">' . $pages['post'] . '</a></td>
						<td>' . $pages['postedby'] . '</td>
						<td>' . $pages['comstts'] . '</td>';
						
$result321 = @mysql_query("SELECT * FROM bdwave_counter WHERE post='$pages[id]'");
if ( @mysql_num_rows($result321) > 0 ) {
while($pages321 = @mysql_fetch_array($result321)) {
echo '<td>'.@$pages321['count'].'</td>';
}
}
else {
echo '<td>0</td>';
}
						
echo'						<td><a href="post.php?action=edit&number=edit&id=' . $pages['id'] . '"><img src="img/save-icon.gif" width="16" height="16" alt="" /></a></td>
						<td><a href="post.php?action=delete&number=single&id=' . $pages['id'] . '"><img src="img/hr.gif" width="16" height="16" alt="" /></a></td>
						</tr>'; }
				}
				echo'</table>';
$c=1;
$ccc=$p-5;
$ccf=$p+5;
if($ccc<1) { $ccc=1; }
if($ccf>$g) { $ccf=$g; }
while ( $ccc <= $ccf ) {
	echo '<a href="post.php?p='.$ccc.'">Page '.$ccc.'</a> | ';
	$ccc++;
}
echo'&nbsp;Total Pages>>'.$g;
}

function edit_post($id) {
$ids=defence_sql_injection($id);
$username2234=user_name();
if ( user_roll() == "moderator" || user_roll() == "administrator" ) {
$result = @mysql_query("SELECT * FROM frndzk_post
WHERE id ='$ids'");
}
elseif ( user_roll() == "user" ) {
$result = @mysql_query("SELECT * FROM frndzk_post
WHERE id ='$ids' and postedby='$username2234'");
}
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
global $catsname;
echo'<h2>Edit Post'; echo'</h2><form method="post" action="post.php?action=edit&number=update">
<input type=hidden name=id value='.$page['id'].'>
<p>Page Name: <textarea name="title" rows="1" cols="55" style="resize: none;">'; echo$page['post']; echo'</textarea></p>
<p>Post Summury: <textarea name="comment" rows="1" cols="55" style="resize: none;">'.$page['comment'].'</textarea></p>
<p>Page Content:
<div style="width:100px;"><textarea class="tinymces" id="elm1" name="content" rows="20" cols="10" style="width: 50%">
';echo$page['postcontent'];echo'
			</textarea></div></p>
			<p>Tags: <textarea name="tags" id="tag" rows="1" cols="55" style="resize: none;">'.$page['tags'].'</textarea></p>
<p>Select Category: <select name="category">';
echo'<option value="'.$page['category'].'">'.$page['category'].'</option>';
            $result = @mysql_query("SELECT * FROM frndzk_category");
if ( @mysql_num_rows($result) > 0 ) {
while($cat = @mysql_fetch_array($result)) {
echo'<option value="'.$cat['shortname'].'">'.$cat['name'].'</option>';
}
}
			echo'</select></p>
			<p>Enable Comment: <select name="comstts"><option value="yes">Yes</option><option value="no">No</option></select></p>
<input type="submit" name="save" value="Save" /></form>';
}
}
}
function genRandomString() {
    $length = 5;
    $characters = "0123456789abcdefghijklmnopqrstuvwxyz";
    $string = '';    
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters)-1)];
    }
    return $string;
}
function post_title() {
if (isset($_GET['url'])) {
$d=strip_tags(defence_sql_injection($_GET['url']));
}
else{
$d="";
}
$result = @mysql_query("SELECT * FROM frndzk_post WHERE shortname='$d'");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
return $pages['post'];
}
}
else {
return'not found';
}
}
//post list widget
function post_list_widget() {
$result = @mysql_query("SELECT * FROM frndzk_post ORDER by id desc LIMIT 0,10");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
echo '<li><a href="'.home_url().'/'.xenon_link_post().$pages['shortname'].'">'.$pages['post'].'</a></li>';
}
}
}
//admin page

//Latest 10 posts
function postlist_admin() {
echo'<h2>Latest 10 Posts</h2>';
global $catsname;
echo'
<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Page Name</th>
						<th>Posted By</th>
						<th>Enable Comment</th>
						<th>Edit</th>
						<th class="last">Delete</th>
					</tr>';
					$user_name2234=user_name();
$result = @mysql_query("SELECT * FROM frndzk_post WHERE postedby='$user_name2234' ORDER by id desc LIMIT 0,10");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
					echo'<tr>
						<td class="first style1">' . $pages['post'] . '</td>
						<td>' . $pages['postedby'] . '</td>
						<td>' . $pages['comstts'] . '</td>
						<td><a href="post.php?action=edit&number=edit&id=' . $pages['id'] . '"><img src="img/save-icon.gif" width="16" height="16" alt="" /></a></td>
						<td><a href="post.php?action=delete&number=single&id=' . $pages['id'] . '"><img src="img/hr.gif" width="16" height="16" alt="" /></a></td>
						</tr>'; }
				}
				echo'</table>';
}
function user_post_count($user_name2234) {
$result = @mysql_query("SELECT * FROM frndzk_post WHERE postedby='$user_name2234'");
return @mysql_num_rows($result);
}
function xenon_feed() {
header('Content-type: text/xml');
echo'<?xml version="1.0" encoding="utf-8" ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
';
$addrs=home_url();
$result = mysql_query("SELECT * FROM frndzk_title
WHERE id = '1'");
if ( @mysql_num_rows($result) > 0 ) {
while($title = mysql_fetch_array($result))
{
echo "<title>" . $title['title'] . "</title>
<atom:link href=\"" . $addrs . "/xenon-feed.php\" rel=\"self\" type=\"application/rss+xml\" />
<link>http://" . $addrs . "</link>
<description>" . $title['tagline'] . "</description>";
}
}
$results = @mysql_query("SELECT * FROM frndzk_post ORDER by id desc LIMIT 0, 25");
if ( @mysql_num_rows($result) > 0 ) {
while($post = mysql_fetch_array($results))
{
echo "<item>
<title>" . $post['post'] . "</title>
<link>" . $addrs . "/".xenon_link_post_rss(). $post['shortname'] . "</link>
<guid>" . $addrs . "/".xenon_link_post_rss(). $post['shortname'] . "</guid>
<pubDate>";

$timea="" . $post['date'] . " " . $post['time'] . "";

$date = date_create("$timea");

echo date_format($date, 'D, d M Y H:i:s O');

echo"</pubDate>
<description><![CDATA[" . $post['comment'] . "]]></description>
</item>";
}
}
echo'</channel>
</rss>';
}
function get_keyword($exclude) {
$post='';
$post=$_GET['url'];
$result = @mysql_query("SELECT * FROM frndzk_post WHERE shortname='$post'");
if ( @mysql_num_rows($result) > 0 ) {
while($kw = @mysql_fetch_array($result)) {
$keyword=$kw['tags'];
$excude_all=explode(',',$exclude);
foreach($excude_all as $es) {
if ($es!="") {
$keyword=str_replace($es.",","",$keyword);
}
}
$keyword=str_replace("-"," ",$keyword);
return $keyword;
}
}
else {
return '';
}
}
?>