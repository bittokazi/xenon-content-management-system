<?php
function xenon_bread_crumb() {
$s=$_SERVER['PHP_SELF'];
$e=explode('/',$s);
return $e[count($e) -1];
}
function add_menu($file, $menuname, $cat, $roll) {
global $addontitle;
global $themefile;
global $themepage;
global $addonfile;
global $addonpage;
global $menupage;
global $menupost;
global $menuuser;
global $menutheme;
global $menuaddon;
global $menusettings;
global $menutop;
global $menusidetop;
global $admintitle;
global $accessrol;
global $i;
$i=$i+1;
if ($cat=="page"){
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menupage[$i]='<li><a href="'.$file.'">'.$menuname.'</a></li>';
}
elseif ($cat=="post"){
if ( $roll == "1" && user_roll() == "administrator" ) {
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menupost[$i]='<li><a href="'.$file.'">'.$menuname.'</a></li>';
}
elseif ( $roll == "2" && user_roll() != "user" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" ) {
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menupost[$i]='<li><a href="'.$file.'">'.$menuname.'</a></li>';
}
}
elseif ( $roll == "3" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" || user_roll() == "user" ) {
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menupost[$i]='<li><a href="'.$file.'">'.$menuname.'</a></li>';
}
}
elseif ( $roll == "1" && user_roll() == "user" ) {
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
}
elseif ( $roll == "1" && user_roll() == "moderator" ) {
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
}
elseif ( $roll == "2" && user_roll() == "user" ) {
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
}
}
elseif ($cat=="user"){
if ( $roll == "1" && user_roll() == "administrator" ) {
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menuuser[$i]='<li><a href="'.$file.'">'.$menuname.'</a></li>';
}
elseif ( $roll == "2" && user_roll() != "user" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" ) {
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menuuser[$i]='<li><a href="'.$file.'">'.$menuname.'</a></li>';
}
}
elseif ( $roll == "3" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" || user_roll() == "user" ) {
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menuuser[$i]='<li><a href="'.$file.'">'.$menuname.'</a></li>';
}
}
elseif ( $roll == "1" && user_roll() == "user" ) {
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
}
elseif ( $roll == "1" && user_roll() == "moderator" ) {
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
}
elseif ( $roll == "2" && user_roll() == "user" ) {
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
}
}
elseif ($cat=="theme"){
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menutheme[$i]='<li><a href="'.$file.'">'.$menuname.'</a></li>';
}
elseif ($cat=="addon"){
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menuaddon[$i]='<li><a href="'.$file.'">'.$menuname.'</a></li>';
}
elseif ($cat=="settings"){
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menusettings[$i]='<li><a href="'.$file.'">'.$menuname.'</a></li>';
}
elseif ($cat=="top") {
if ( $roll == "1" && user_roll() == "administrator" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menutop[$i]='<li '.$active.'><span><span><a href="'.$file.'">'.$menuname.'</a></span></span></li>';
}
elseif ( $roll == "2" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menutop[$i]='<li '.$active.'><span><span><a href="'.$file.'">'.$menuname.'</a></span></span></li>';
}
}
elseif ( $roll == "3" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" || user_roll() == "user" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menutop[$i]='<li '.$active.'><span><span><a href="'.$file.'">'.$menuname.'</a></span></span></li>';
}
}
}
elseif ($cat=="sidetop"){
if ( $roll == "1" && user_roll() == "administrator" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menusidetop[$i]='<a class="link" href="'.$file.'">'.$menuname.'</a>';
}
elseif ( $roll == "2" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menusidetop[$i]='<a class="link" href="'.$file.'">'.$menuname.'</a>';
}
}
elseif ( $roll == "3" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" || user_roll() == "user" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( xenon_bread_crumb() == "$file" ) { $admintitle=$menuname; $accessrol=$roll; }
$menusidetop[$i]='<a class="link" href="'.$file.'">'.$menuname.'</a>';
}
}
}
elseif ($cat=="addonpage"){
if ( $roll == "1" && user_roll() == "administrator" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( $addonfile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
$addonpage[$i]='<a class="link" href="xenon-addon-settings.php?addon='.$menuname.'">'.$addontitles.'</a>';
}
elseif ( $roll == "2" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( $addonfile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
$addonpage[$i]='<a class="link" href="xenon-addon-settings.php?addon='.$menuname.'">'.$addontitles.'</a>';
}
}
elseif ( $roll == "3" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" || user_roll() == "user" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( $addonfile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
$addonpage[$i]='<a class="link" href="xenon-addon-settings.php?addon='.$menuname.'">'.$addontitles.'</a>';
}
}
}
elseif ($cat=="themepage"){
if ( $roll == "1" && user_roll() == "administrator" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( $themefile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
$themepage[$i]='<li><a href="xenon-theme-settings.php?theme='.$menuname.'">'.$menuname.'</a></li>';
}
elseif ( $roll == "2" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( $themefile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
$themepage[$i]='<li><a href="xenon-theme-settings.php?theme='.$menuname.'">'.$menuname.'</a></li>';
}
}
elseif ( $roll == "3" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" || user_roll() == "user" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( $themefile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
$themepage[$i]='<li><a href="xenon-theme-settings.php?theme='.$menuname.'">'.$menuname.'</a></li>';
}
}
}
}
//top and Sidebar top level menu
function option_menu($file, $menuname, $cat, $roll, $addontitles) {
global $addontitle;
global $themefile;
global $themepage;
global $addonfile;
global $addonpage;
global $menupage;
global $menupost;
global $menuuser;
global $menutheme;
global $menuaddon;
global $menusettings;
global $menutop;
global $menusidetop;
global $admintitle;
global $accessrol;
global $i;
$i=$i+1;
if ($cat=="addonpage"){
if ( $roll == "1" && user_roll() == "administrator" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( $addonfile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
$addonpage[$i]='<a class="link" href="xenon-addon-settings.php?addon='.$menuname.'">'.$addontitles.'</a>';
}
elseif ( $roll == "2" && user_roll() != "user" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( $addonfile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
$addonpage[$i]='<a class="link" href="xenon-addon-settings.php?addon='.$menuname.'">'.$addontitles.'</a>';
}
}
elseif ( $roll == "3" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" || user_roll() == "user" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( $addonfile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
$addonpage[$i]='<a class="link" href="xenon-addon-settings.php?addon='.$menuname.'">'.$addontitles.'</a>';
}
}
elseif ( $roll == "1" && user_roll() == "user" ) {
if ( $addonfile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
}
elseif ( $roll == "1" && user_roll() == "moderator" ) {
if ( $addonfile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
}
elseif ( $roll == "2" && user_roll() == "user" ) {
if ( $addonfile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
}
}
elseif ($cat=="themepage"){
if ( $roll == "1" && user_roll() == "administrator" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( $themefile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
$themepage[$i]='<li><a href="xenon-theme-settings.php?theme='.$menuname.'">'.$menuname.'</a></li>';
}
elseif ( $roll == "2" && user_roll() != "user" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( $themefile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
$themepage[$i]='<li><a href="xenon-theme-settings.php?theme='.$menuname.'">'.$menuname.'</a></li>';
}
}
elseif ( $roll == "3" ) { if ( user_roll() == "administrator" || user_roll() == "moderator" || user_roll() == "user" ) {
if ( xenon_bread_crumb() == "$file" ) { $active='class="active"'; } else { $active=''; }
if ( $themefile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
$themepage[$i]='<li><a href="xenon-theme-settings.php?theme='.$menuname.'">'.$menuname.'</a></li>';
}
}
elseif ( $roll == "1" && user_roll() == "user" ) {
if ( $addonfile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
}
elseif ( $roll == "1" && user_roll() == "moderator" ) {
if ( $addonfile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
}
elseif ( $roll == "2" && user_roll() == "user" ) {
if ( $addonfile == $menuname ) { $admintitle=$menuname; $accessrol=$roll; }
}
}
}
//test post list
function frndzk_admin_media() {  
    add_menu('media.php', 'Image/Video upload','post','3');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_media');
function frndzk_admin_comment() {  
    add_menu('comment.php', 'Comments','post','3');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_comment');
function frndzk_admin_actions() {  
    add_menu('page.php', 'Page List','page','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actions');
function frndzk_admin_actionspaa() {  
    add_menu('add-page.php', 'Add Page','page','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actionspaa');
//theme list
function frndzk_admin_actionsss() {  
    add_menu('themes.php', 'Themes List', 'theme','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actionsss');
function frndzk_admin_actionsta() {  
    add_menu('add-themes.php', 'Add Themes', 'theme','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actionsta');
//post list
function frndzk_admin_actionspol() {  
    add_menu('post.php', 'Post List','post','3');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actionspol');
function frndzk_admin_actionspoa() {  
    add_menu('add-post.php', 'Add Post','post','3');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actionspoa');
function frndzk_admin_actionspoc() {  
    add_menu('category.php', 'Category List','post','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actionspoc');
function frndzk_admin_actionspoca() {  
    add_menu('add-category.php', 'Add Category','post','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actionspoca');
//user
function frndzk_admin_actionul() {  
    add_menu('user.php', 'User List', 'user','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actionul');
function frndzk_admin_actionua() {  
    add_menu('add-user.php', 'Add User', 'user','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actionua');
//addon
function frndzk_admin_actional() {  
    add_menu('addon.php', 'Addon List', 'addon','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actional');
//settings
function frndzk_admin_actiongs() {  
    add_menu('general.php', 'General', 'settings','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actiongs');
//top menu
function frndzk_admin_actiontopd() {  
    add_menu('admin.php', 'Dashboard', 'top','3');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actiontopd');
function frndzk_admin_actiontoppa() {  
    add_menu('page.php', 'Page', 'top', '1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actiontoppa');
//sidebar top menu
function frndzk_admin_actiontospa() {  
    add_menu('page.php', 'Pages', 'sidetop','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actiontospa');
function frndzk_admin_actionupro() {  
    add_menu('profile.php', 'My Profile', 'user','3');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actionupro');
function frndzk_admin_actionwidget() {  
    add_menu('widgets.php', 'Widgets', 'theme','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actionwidget');
function frndzk_admin_actionmenu() {  
    add_menu('menu.php', 'Menus', 'theme','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_actionmenu');
function frndzk_admin_themeedit() {  
    add_menu('edit-theme.php', 'Edit Theme', 'theme','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_themeedit');
function frndzk_admin_addonadd() {  
    add_menu('add-addon.php', 'Add Addons', 'addon','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_addonadd');
function frndzk_admin_addonedit() {  
    add_menu('edit-addon.php', 'Edit Addons', 'addon','1');  
}
xenon_core('xenon_add_menu', 'frndzk_admin_addonedit');
//register menu
function register_xenon_menu($wname) {
$wname=defence_sql_injection($wname);
$wn='xenon_menu_'.current_theme_name();
$wname=$wname.'_menu249ony_'.current_theme_name();
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE title ='$wn' AND tagline='$wname'");
if ( !@mysql_num_rows($result) > 0 ) {
$query="INSERT INTO frndzk_title VALUES ('','$wn','$wname')";
@mysql_query($query);
}
}
//menu page content
function menu_content() {
$wn='xenon_menu_'.current_theme_name();
echo'
<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Menu Container</th>
						<th>Edit</th>
					</tr>';
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE title ='$wn'");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$widgetname=str_replace('_menu249ony_'.current_theme_name(),"",$pages['tagline'] );
					echo'<tr>
						<td class="first style1">' . $widgetname . '</td>
						<td><a href="menu.php?action=edit&menu=' . $pages['tagline'] . '"><img src="img/save-icon.gif" width="16" height="16" alt="" /></a></td>
						</tr>'; }
}
echo'</table>';
}
function edit_menu($id) {
$ids=defence_sql_injection($id);
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE tagline ='$ids'");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
echo'<h2>Add Menu'; echo'</h2><form method="post" action="menu.php?action=add&menu=item">
<p>Menu name: <textarea name="title" rows="1" cols="55" style="resize: none;"></textarea></p>
<input type=hidden name=id value='.$page['tagline'].'>
<p>Select A Menu Item: <select name="menucontent">';
$results = @mysql_query("SELECT * FROM frndzk_page");
if ( @mysql_num_rows($results) > 0 ) {
while($pages = @mysql_fetch_array($results)) {
echo '<option value="'.$pages['shortname'].',page">'.$pages['page'].' (page)</option>';
}
}
$results = @mysql_query("SELECT * FROM frndzk_category");
if ( @mysql_num_rows($results) > 0 ) {
while($pages = @mysql_fetch_array($results)) {
echo '<option value="'.$pages['shortname'].',category">'.$pages['name'].' (category)</option>';
}
}
echo'</select></p>
<p>Select Parent: <select name="parent"><option value=""></option>';
$select_menu=$_GET['menu'];
$results = @mysql_query("SELECT * FROM frndzk_menu WHERE menuloc='$select_menu'");
if ( @mysql_num_rows($results) > 0 ) {
while($pages = @mysql_fetch_array($results)) {
echo '<option value="'.$pages['second'].'">'.$pages['first'].'</option>';
}
}
echo'</select></p>
<input type="submit" name="save" value="Save" /></form>';
}
}
//link
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE tagline ='$ids'");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
echo'<h2>Add Link to Menu'; echo'</h2><form method="post" action="menu.php?action=add&menu=item">
<p>Menu name: <textarea name="title" rows="1" cols="55" style="resize: none;"></textarea></p>
<input type=hidden name=id value="'.$page['tagline'].',link">
<p>Menu Link: <textarea name="menucontent" rows="1" cols="55" style="resize: none;"></textarea></p>';
echo'<p>Select Parent: <select name="parent"><option value=""></option>';
$select_menu=$_GET['menu'];
$results = @mysql_query("SELECT * FROM frndzk_menu WHERE menuloc='$select_menu'");
if ( @mysql_num_rows($results) > 0 ) {
while($pages = @mysql_fetch_array($results)) {
echo '<option value="'.$pages['second'].'">'.$pages['first'].'</option>';
}
}
echo'</select></p>
<input type="submit" name="save" value="Save" /></form>
<h3>Menu Structure</h3>';
}
}
//link finish
//menu
$wn=defence_sql_injection($_GET['menu']);
echo'<ul>';
$result = @mysql_query("SELECT * FROM frndzk_menu WHERE menuloc='$wn' AND parent=''");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
echo'<li>'.$pages['first'].' (<a href="menu.php?action=delete&loc='.$wn.'&id='.$pages['id'].'">Delete</a>)';
$resultsu = @mysql_query("SELECT * FROM frndzk_menu WHERE menuloc='$wn' AND parent='$pages[second]'");
if ( @mysql_num_rows($resultsu) > 0 ) {
echo'<ul>';
while($pagesp = @mysql_fetch_array($resultsu)) {
echo '<li>'.$pagesp['first'].' (<a href="menu.php?action=delete&loc='.$wn.'&id='.$pagesp['id'].'">Delete</a>)</li>';
}
echo'</ul>';
}
echo'</li>';
}
}
echo'</ul>';
//finish
}
function delete_menu() {
$id=defence_sql_injection($_GET['id']);
$loc=defence_sql_injection($_GET['loc']);
$result = @mysql_query("SELECT * FROM frndzk_menu
WHERE id='$id'");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$results = @mysql_query("SELECT * FROM frndzk_menu
WHERE menuloc='$loc' AND parent='$pages[second]'");
if ( @mysql_num_rows($results) == 0 ) {
mysql_query("DELETE FROM frndzk_menu WHERE id='$id'");
echo'Deleted Menu Item';
}
else { echo'Sub menu detected, delete that first'; }
}
}
}
//add default menus
function add_default_menu($title, $id, $widget, $parent) {
$id=defence_sql_injection($id);
$title=defence_sql_injection($title);
$widgets=defence_sql_injection($widget);
$widgetss=explode(',',$widgets);
$ids=explode(',',$id);
foreach ($ids as $idss) {
if ( $idss=="link" ) {
$type=$idss;
}
else {
$id=$idss;
}
}
foreach ($widgetss as $widgetsss) {
if ( $widgetsss=="page" || $widgetsss=="category") {
$type=$widgetsss;
}
else {
$widget=$widgetsss;
}
}
$parent=defence_sql_injection($parent);
$sname=$title;
$result = @mysql_query("SELECT * FROM frndzk_menu
WHERE first = '$title'");
$ijj=1;
if ( @mysql_num_rows($result) > 0 ) {
while ( @mysql_num_rows($result) > 0 )
{
$title=$sname.$ijj;
$result = @mysql_query("SELECT * FROM frndzk_menu
WHERE first = '$title'");
$ijj=$ijj+1;
}
}
$query="INSERT INTO frndzk_menu VALUES ('','$id','$sname','$title','$type','$parent','$widget')";
@mysql_query($query);
echo"<br>Menu Added<br>";
}
//show menu
function show_xenon_menu($ii,$array) {
$iii=0;
$ii=defence_sql_injection($ii);
$wn=$ii.'_menu249ony_'.current_theme_name();
if ( !isset($array['before_menu']) ) {
$array['before_menu']='';
}
if ( !isset($array['after_menu']) ) {
$array['after_menu']='';
}
if ( !isset($array['before_link']) ) {
$array['before_link']='';
}
if ( !isset($array['after_link']) ) {
$array['after_link']='';
}
if ( !isset($array['current_anchor_class']) ) {
$array['current_anchor_class']='xenon';
}
if ( !isset($array['sub_menu_anchor_class']) ) {
$array['sub_menu_anchor_class']='';
}
else{
$array['sub_menu_anchor_class']='class="'.$array['sub_menu_anchor_class'].'"';
}
if ( !isset($array['li_current_anchor_class']) ) {
$array['li_current_anchor_class']='xenon';
}
if ( !isset($array['list']) ) {
$lis='';
$lim='';
$lif='';
}
elseif ( isset($array['list']) && $array['list']=="yes" ) {
$iii=1;
$lis='<li';
$lim='>';
$lif='<li>';
}
if (isset($_GET['url'])) {
$d=defence_sql_injection($_GET['url']);
}
else{
$iii=0;
$d="";
$c="";
$p="";
}
$result = @mysql_query("SELECT * FROM frndzk_menu WHERE menuloc='$wn' AND parent=''");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
if ( $pages['content'] == $d )
{
$current='class="'.$array['current_anchor_class'].'" ';
if ($iii==1) {
$li_current=' class="'.$array['li_current_anchor_class'].'" '; }
else {$li_current='';}
}
else {
$current='';
$li_current='';
}
if ($pages['type']=="category") {
echo $array['before_link'].$lis.$li_current.$lim.'<a '.$current.'href="'.home_url().'/'.xenon_link_category().$pages['content'].'">'.$pages['first'].'</a>';
//sub menu start
$resultsu = @mysql_query("SELECT * FROM frndzk_menu WHERE menuloc='$wn' AND parent='$pages[first]'");
if ( @mysql_num_rows($resultsu) > 0 ) {
echo'<ul>';
while($pagesp = @mysql_fetch_array($resultsu)) {
if ($pagesp['type']=="category") {
echo '<li><a '.$array['sub_menu_anchor_class'].' href="'.home_url().'/'.xenon_link_category().$pagesp['content'].'">'.$pagesp['first'].'</a></li>';
}
elseif ($pagesp['type']=="page") {
echo '<li><a '.$array['sub_menu_anchor_class'].' href="'.home_url().'/'.xenon_link_page().$pagesp['content'].'">'.$pagesp['first'].'</a></li>';
}
elseif ($pagesp['type']=="link") {
echo '<li><a '.$array['sub_menu_anchor_class'].' href="'.$pagesp['content'].'">'.$pagesp['first'].'</a></li>';
}
}
echo'</ul>';
}
//sub menu finish
echo$lif.$array['after_link'];
}
elseif ($pages['type']=="link") {
echo $array['before_link'].$lis.$li_current.$lim.'<a '.$current.'href="'.$pages['content'].'">'.$pages['first'].'</a>';
//sub menu start
$resultsu = @mysql_query("SELECT * FROM frndzk_menu WHERE menuloc='$wn' AND parent='$pages[second]'");
if ( @mysql_num_rows($resultsu) > 0 ) {
echo'<ul>';
while($pagesp = @mysql_fetch_array($resultsu)) {
if ($pagesp['type']=="category") {
echo '<li><a '.$array['sub_menu_anchor_class'].' href="'.home_url().'/'.xenon_link_category().$pagesp['content'].'">'.$pagesp['first'].'</a></li>';
}
elseif ($pagesp['type']=="page") {
echo '<li><a '.$array['sub_menu_anchor_class'].' href="'.home_url().'/'.xenon_link_page().$pagesp['content'].'">'.$pagesp['first'].'</a></li>';
}
elseif ($pagesp['type']=="link") {
echo '<li><a '.$array['sub_menu_anchor_class'].' href="'.$pagesp['content'].'">'.$pagesp['first'].'</a></li>';
}
}
echo'</ul>';
}
//sub menu finish
echo$lif.$array['after_link'];
}
elseif ($pages['type']=="page") {
echo $array['before_link'].$lis.$li_current.$lim.'<a '.$current.'href="'.home_url().'/'.xenon_link_page().$pages['content'].'">'.$pages['first'].'</a>';
//sub menu start
$resultsu = @mysql_query("SELECT * FROM frndzk_menu WHERE menuloc='$wn' AND parent='$pages[second]'");
if ( @mysql_num_rows($resultsu) > 0 ) {
echo'<ul>';
while($pagesp = @mysql_fetch_array($resultsu)) {
if ($pagesp['type']=="category") {
echo '<li><a '.$array['sub_menu_anchor_class'].' href="'.home_url().'/'.xenon_link_category().$pagesp['content'].'">'.$pagesp['first'].'</a></li>';
}
elseif ($pagesp['type']=="page") {
echo '<li><a '.$array['sub_menu_anchor_class'].' href="'.home_url().'/'.xenon_link_page().$pagesp['content'].'">'.$pagesp['first'].'</a></li>';
}
elseif ($pagesp['type']=="link") {
echo '<li><a '.$array['sub_menu_anchor_class'].' href="'.$pagesp['content'].'">'.$pagesp['first'].'</a></li>';
}
}
echo'</ul>';
}
//sub menu finish
echo$lif.$array['after_link'];
}
}
}
}
?>