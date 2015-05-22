<?php
function register_xenon_widget($wname) {
$wname=defence_sql_injection($wname);
$wn='xenon_addon_'.current_theme_name();
$wname=$wname.'_'.current_theme_name();
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE title ='$wn' AND tagline='$wname'");
if ( !@mysql_num_rows($result) > 0 ) {
$query="INSERT INTO frndzk_title VALUES ('','$wn','$wname')";
@mysql_query($query);
}
}
//Widget page content
function widgets_content() {
$wn='xenon_addon_'.current_theme_name();
echo'<h2>Widget Container</h2>
<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Widget Container</th>
						<th>Edit</th>
					</tr>';
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE title ='$wn'");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$widgetname=str_replace('_'.current_theme_name(),"",$pages['tagline'] );
					echo'<tr>
						<td class="first style1">' . $widgetname . '</td>
						<td><a href="widgets.php?action=edit&widget=' . $pages['tagline'] . '"><img src="img/save-icon.gif" width="16" height="16" alt="" /></a></td>
						</tr>'; }
}
echo'</table>
<h2>Custom Widget</h2>';
echo'<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Widgets</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>';
$result = @mysql_query("SELECT * FROM frndzk_bar");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
					echo'<tr>
						<td class="first style1">' . $pages['addvertise'] . '</td>
						<td><a href="widgets.php?action=edit&custom=' . $pages['id'] . '"><img src="img/save-icon.gif" width="16" height="16" alt="" /></a></td>
						<td><a href="widgets.php?action=delete&custom='.$pages['id'].'"><img src="img/hr.gif" width="16" height="16" alt="" /></a></td>
						</tr>'; }
}
global $addwitem,$addwitemi;
if (isset($addwitem)) {
foreach ($addwitem as $addwitems ) {
echo'<tr>
						<td class="first style1">' . $addwitems . '</td>
						<td><img src="img/save-icon.gif" width="16" height="16" alt="" /></td>
						<td><img src="img/hr.gif" width="16" height="16" alt="" /></td>
						</tr>';
						}
						}
echo'</table>
<h3>Add Text or HTML or javascript Widget</h3>';
echo'<form method="post" action="widgets.php?action=add&type=custom">
<p>Widget Name:</p><p><textarea name="title" rows="1" cols="55" style="resize: none;"></textarea></p>
<p>Widget Content:</p><p><textarea name="content" rows="5" cols="55" style="resize: none;"></textarea></p>
<input type="submit" name="save" value="Save" /></form>';
}
//widget edit page
function edit_widget($id) {
$ids=defence_sql_injection($id);
echo'<h2>Widget content List</h2>
<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Widget Name</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>';
$result = @mysql_query("SELECT * FROM frndzk_apibar
WHERE loc ='$ids'");
if ( @mysql_num_rows($result) > 0 ) {
while($pagesre = @mysql_fetch_array($result)) {
					echo'<tr>
						<td class="first style1">' . $pagesre['addvertise'] . '</td>
						<td><a href="widgets.php?action=edit&widgetname='.$pagesre['loc'].'&editwidget=' . $pagesre['addvertise'] . '&id='.$pagesre['id'].'"><img src="img/save-icon.gif" width="16" height="16" alt="" /></a></td>
						<td><a href="widgets.php?action=edit&widgetname='.$pagesre['loc'].'&delete=' . $pagesre['addvertise'] . '&id='.$pagesre['id'].'"><img src="img/hr.gif" width="16" height="16" alt="" /></a></td>
						</tr>'; }
}
echo'</table>';
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE tagline ='$ids'");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
echo'<h2>Add Widget'; echo'</h2><form method="post" action="widgets.php?action=add&widget=item">
<p>Name of Widget: <textarea name="title" rows="1" cols="55" style="resize: none;"></textarea></p>
<input type=hidden name=id value='.$page['tagline'].'>
<p>Select Widget: <select name="widgetcontent">
<option value="page_list_widget()">Page List</option>
<option value="post_list_widget()">Post List</option>
<option value="category_list_widget()">Category List</option>
<option value="login_widget()">Login And Signup</option>
<option value="xenon_search_field()">Search Box</option>';
$result = @mysql_query("SELECT * FROM frndzk_bar");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
echo'<option value="'.$page['id'].'">'.$page['addvertise'].'</option>';
}
}
global $addwitem,$addwitemi;
foreach ($addwitem as $addwitems ) {
echo'
						<option value="xenon_249_c_widget_'.$addwitems.'">' . $addwitems . '</option>';
						}
echo'</select></p>
<input type="submit" name="save" value="Save" /></form>';
}
}
}
//add default widgets
function sidebar() {
global $iidddsss;
return $iidddsss.'_'.current_theme_name();
}
function add_default_widget($title, $id, $widget) {
$id=defence_sql_injection($id);
$title=defence_sql_injection($title);
$widget=defence_sql_injection($widget);
$query="INSERT INTO frndzk_apibar VALUES ('','$id','$title','$widget')";
@mysql_query($query);
echo"<br>Widget Added<br>";
}
function show_xenon_widget($ii,$array) {
global $iidddsss;
$iidddsss=$ii;
$ii=defence_sql_injection($ii);
$wn=$ii.'_'.current_theme_name();
if ( !isset($array['before_widget']) ) {
$array['before_widget']='';
}
if ( !isset($array['after_widget']) ) {
$array['after_widget']='';
}
if ( !isset($array['before_content']) ) {
$array['before_content']='';
}
if ( !isset($array['after_content']) ) {
$array['after_content']='';
}
if ( !isset($array['before_title']) ) {
$array['before_title']='';
}
if ( !isset($array['after_title']) ) {
$array['after_title']='';
}
echo $array['before_widget'];
$result = @mysql_query("SELECT * FROM frndzk_apibar
WHERE loc ='$wn'  ORDER by id ASC");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
echo $array['before_title'].$page['addvertise'].$array['after_title'].$array['before_content'];
$stripc=str_replace('xenon_249_c_widget_','',$page['content']);
if ( $page['content'] == "page_list_widget()" ) {
page_list_widget();
}
elseif ( $page['content'] == "post_list_widget()" ) {
post_list_widget();
}
elseif ( $page['content'] == "category_list_widget()"  ) {
category_list_widget();
}
elseif ( $page['content'] == "login_widget()"  ) {
login_widget();
}
elseif ( $page['content'] == "xenon_search_field()" ) {
xenon_search_field();
}
elseif ( $page['content'] == "xenon_249_c_widget_".$stripc ) {
$stripc();
}
else {
$resultsr = @mysql_query("SELECT * FROM frndzk_bar WHERE id='$page[content]' ORDER by id ASC");
if ( @mysql_num_rows($result) > 0 ) {
while($pagesr = @mysql_fetch_array($resultsr))
{
echo $pagesr['content'];
}
}
}
echo $array['after_content'];
}
}
echo $array['after_widget'];
}
function add_custom_widget($title, $widget) {
$title=defence_sql_injection($title);
$widget=defence_sql_injection($widget);
$query="INSERT INTO frndzk_bar VALUES ('','$title','$widget')";
@mysql_query($query);
echo"<br>Text Widget Added<br>";
}
function delete_widget_confirm() {
echo"<br>Are you Sure You Want to Delete the Widget?<br>";
echo'<a href="widgets.php?action=delete&widget='.$_GET['widgetname'].'&content='.$_GET['delete'].'&id='.$_GET['id'].'">Yes</a> or <a href="widgets.php">No</a>';
}
function delete_widget_true() {
$id=defence_sql_injection($_GET['id']);
$widget=defence_sql_injection($_GET['widget']);
$name=defence_sql_injection($_GET['content']);
mysql_query("DELETE FROM frndzk_apibar WHERE loc ='$widget' AND addvertise='$name' AND id='$id'");
echo'Deleted Widget Successfully ! ';
}
function edit_custom() {
$id=defence_sql_injection($_GET['custom']);
echo'<h3>Edit Custom Widget</h2>';
$result = @mysql_query("SELECT * FROM frndzk_bar
WHERE id ='$id'");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
echo'<form method="post" action="widgets.php?action=edit&custom-edit=confirm">
<input type="hidden" name="id" value="'.$page['id'].'">
<p>Widget Name:</p><p><textarea name="title" rows="1" cols="55" style="resize: none;">'.$page['addvertise'].'</textarea></p>
<p>Widget Content:</p><p><textarea name="content" rows="5" cols="55" style="resize: none;">'.$page['content'].'</textarea></p>
<input type="submit" name="save" value="Save" /></form>';
}
}
}
function edit_custom_confirm() {
$id=defence_sql_injection($_POST['id']);
$title=defence_sql_injection($_POST['title']);
$content=defence_sql_injection($_POST['content']);
$result = @mysql_query("SELECT * FROM frndzk_bar
WHERE id ='$id'");
if ( @mysql_num_rows($result) > 0 ) {
$query="UPDATE frndzk_bar SET addvertise = '$title'  
WHERE id = '$id'";
mysql_query($query);
$query="UPDATE frndzk_bar SET content = '$content'  
WHERE id = '$id'";
mysql_query($query);
echo'Widget Edit successful';
}
}
function delete_custom_widget() {
$id=defence_sql_injection($_GET['custom']);
$result = @mysql_query("SELECT * FROM frndzk_bar
WHERE id ='$id'");
if ( @mysql_num_rows($result) > 0 ) {
mysql_query("DELETE FROM frndzk_bar WHERE id='$id'");
echo'Deleted custom widget';
}
}
function edit_widget_item() {
$id=defence_sql_injection($_GET['id']);
$widget=defence_sql_injection($_GET['editwidget']);
$name=defence_sql_injection($_GET['widgetname']);
$result = @mysql_query("SELECT * FROM frndzk_apibar
WHERE id ='$id' AND loc='$name' AND addvertise='$widget'");
if ( @mysql_num_rows($result) > 0 ) {
echo'<h2>Edit Widget'; echo'</h2><form method="post" action="widgets.php?action=edit&widgetitem=name">';
while($page = @mysql_fetch_array($result))
{
echo'<p>Name of Widget: <textarea name="title" rows="1" cols="55" style="resize: none;">'.$page['addvertise'].'</textarea></p>
<input type=hidden name=id value='.$page['id'].'>
<input type="submit" name="save" value="Save" /></form>
<form method="post" action="widgets.php?action=edit&widgetitem=content">
<input type=hidden name=id value='.$page['id'].'>
<p>Select Widget: <select name="widgetcontent">
<option value="page_list_widget()">Page List</option>
<option value="post_list_widget()">Post List</option>
<option value="category_list_widget()">Category List</option>
<option value="login_widget()">Login And Signup</option>
<option value="xenon_search_field()">Search Box</option>';
$results = @mysql_query("SELECT * FROM frndzk_bar");
if ( @mysql_num_rows($results) > 0 ) {
while($pages = @mysql_fetch_array($results))
{
echo'<option value="'.$pages['id'].'">'.$pages['addvertise'].'</option>';
}
}
global $addwitem,$addwitemi;
foreach ($addwitem as $addwitems ) {
echo'
						<option value="xenon_249_c_widget_'.$addwitems.'">' . $addwitems . '</option>';
						}
echo'</select></p>';
}
echo'<input type="submit" name="save" value="Save" /></form>';
}
}
function edit_widget_item_action($i) {
if ($i=="name") {
$name=defence_sql_injection($_POST['title']);
$id=defence_sql_injection($_POST['id']);
$result = @mysql_query("SELECT * FROM frndzk_apibar
WHERE id ='$id'");
if ( @mysql_num_rows($result) > 0 ) {
$query="UPDATE frndzk_apibar SET addvertise = '$name'  
WHERE id = '$id'";
@mysql_query($query);
echo'widget update successfull';
}
}
elseif ($i=="content") {
$name=defence_sql_injection($_POST['widgetcontent']);
$id=defence_sql_injection($_POST['id']);
$result = @mysql_query("SELECT * FROM frndzk_apibar
WHERE id ='$id'");
if ( @mysql_num_rows($result) > 0 ) {
$query="UPDATE frndzk_apibar SET content = '$name'  
WHERE id = '$id'";
@mysql_query($query);
echo'widget update successfull';
}
}
}
function xenon_add_widget_item($i) {
global $addwitem;
global $addwitemi;
$addwitem[$addwitemi]=$i;
$addwitemi=$addwitemi+1;
}
function feed() {
return'<link rel="alternate" type="application/rss+xml" title="'.xenon_title().' &raquo; Feed" href="'.home_url().'/xenon-feed.php" />';
}
xenon_core("xenon_header", "feed");
function login_widget() {
ob_start();
@session_start();
if(!isset($_SESSION['bitto'])) {
xenon_login_check_widget();
echo'<form method="post" action=""> Username: <input name="un" input type="text" class="tb7"><br><br>
Password: <input name="pw" input type="password" class="tb7"><br>
<input type="submit" value="Login"> </form>';
echo'<p><a href="'.home_url().'/'.xenon_link_signup().'">Signup?</a></p>';
echo'<p><b>Reset Password</b></p>';
xenon_reset_password();
echo'<form method="post" action=""> Email-address: <input name="emailreset" input type="text" class="tb7"><br> <input  
type="submit" value="Reset Password"> </form>';
}
else { echo 'Welcome Back, '.@user_name().'<br>
<a href="'.home_url().'/xenon-admin" style="text-decoraton:none;color:black;">Dashboard</a>
<br>
<a href="'.home_url().'/xenon-admin/logout.php" style="text-decoraton:none; color:black;">Logout?</a>'; }
ob_flush();
}
?>