<?php
function category_deleted() {
if(isset($_GET['deleted']) && $_GET['deleted']=="single") {
echo"deleted the Category successfully<br><br>";
}
}
function add_category_content() {
global $catsname;
echo'<h2>Add Category</h2><form method="post" action="category.php?action=add">
<p>Add Category: <textarea name="title" rows="1" cols="55" style="resize: none;"></textarea></p>
<p>Select Parent Category: <select name="category"><option value=""></option>';
			foreach( $catsname as $catname )
			{
			echo'<option value="'.$catname.'">'.$catname.'</option>';
			}
			echo'</select></p><input type="submit" name="save" value="Save" /></form>';
}
function add_category_action() {
$title=defence_sql_injection($_POST['title']);
$shortname=str_replace(' ', '-', $title);
$shortname=strtolower($shortname);
$shortname=str_replace("'", '-', $shortname);
$shortname=str_replace('/', '-', $shortname);
$shortname=str_replace('.', '-', $shortname);
$shortname=str_replace('?', '-', $shortname);
$shortname=str_replace('&', '-', $shortname);
$shortname=str_replace(";", '-', $shortname);
$shortname=str_replace("!", '-', $shortname);
$shortname=str_replace("#", '-', $shortname);
$shortname=str_replace("+", '-', $shortname);
$shortname=str_replace("$", '-', $shortname);
$shortname=str_replace("%", '-', $shortname);
$shortname=str_replace("*", '-', $shortname);
$shortname=str_replace('"', '-', $shortname);
$shortname=str_replace('=', '-', $shortname);
$shortname=str_replace('`', '-', $shortname);
$shortname=str_replace('~', '-', $shortname);
$shortname=str_replace('(', '-', $shortname);
$shortname=str_replace(')', '-', $shortname);
$shortname=str_replace('{', '-', $shortname);
$shortname=str_replace('}', '-', $shortname);
$shortname=str_replace('[', '-', $shortname);
$shortname=str_replace(']', '-', $shortname);
$shortname=str_replace('|', '-', $shortname);
$shortname=str_replace('<', '-', $shortname);
$shortname=str_replace('>', '-', $shortname);
$shortname=str_replace('@', '-', $shortname);
$shortname=str_replace('^', '-', $shortname);
$shortname=str_replace(',', '-', $shortname);
$result = @mysql_query("SELECT * FROM frndzk_category WHERE name='$_POST[category]'");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$catname=$pages['shortname'];
}
}
else {
$catname=$_POST['category'];
}
$ijj=1;
$sname=$shortname;
$result = @mysql_query("SELECT * FROM frndzk_category
WHERE shortname = '$shortname'");
if ( @mysql_num_rows($result) > 0 ) {
while ( @mysql_num_rows($result) > 0 )
{
$shortname=$sname.$ijj;
$result = @mysql_query("SELECT * FROM frndzk_category
WHERE shortname = '$shortname'");
$ijj=$ijj+1;
}
}
$query="INSERT INTO frndzk_category VALUES ('','$title','$catname','$shortname')";
@mysql_query($query);
}
function categorylist() {
echo'
<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Category Name</th>
						<th>Parent</th>
						<th>Edit</th>
						<th class="last">Delete</th>
					</tr>';
$result = @mysql_query("SELECT * FROM frndzk_category ORDER by id desc");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
					echo'<tr>
						<td class="first style1"><a target="_blank" href="'.home_url().'/'.xenon_link_category().$pages['shortname'].'">' . $pages['name'] . '</a></td>
						<td>' . $pages['parent'] . '</td>
						<td><a href="category.php?action=edit&number=edit&id=' . $pages['id'] . '"><img src="img/save-icon.gif" width="16" height="16" alt="" /></a></td>
						<td><a href="category.php?action=delete&number=single&id=' . $pages['id'] . '"><img src="img/hr.gif" width="16" height="16" alt="" /></a></td>
						</tr>'; }
				}
}
function edit_cat($id) {
global $catsname;
$ids=defence_sql_injection($id);
$result = @mysql_query("SELECT * FROM frndzk_category
WHERE id ='$ids'");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
echo'<h2>Edit Category'; echo'</h2><form method="post" action="category.php?action=edit&number=update">
<p>Edit Category: <textarea name="title" rows="1" cols="55" style="resize: none;">'; echo$page['name']; echo'</textarea></p>
<input type=hidden name=id value='.$page['id'].'>
<p>Select Category: <select name="category"><option value=""></option>';
echo'<option value="'.$page['parent'].'">'.$page['parent'].'</option>';
			foreach( $catsname as $catname )
			{
			if ( $catname != $page['name'] ) {
			echo'<option value="'.$catname.'">'.$catname.'</option>';
			}
			}
			echo'</select></p>
<input type="submit" name="save" value="Save" /></form>';
}
}
}
function category_title() {
if (isset($_GET['url'])) {
$d=strip_tags(defence_sql_injection($_GET['url']));
}
else{
$d="";
}
$result = @mysql_query("SELECT * FROM frndzk_category WHERE shortname='$d'");
if ( @mysql_num_rows($result) > 0 ) {
while($pagesa = @mysql_fetch_array($result)) {
return $pagesa['name'];
}
}
else {
return'not found';
}
}
//category list for widget
function category_list_widget() {
$result = @mysql_query("SELECT * FROM frndzk_category WHERE parent=''");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
echo '<li><a href="'.home_url().'/'.xenon_link_category().$pages['shortname'].'">'.$pages['name'].'</a>';
$resultf = @mysql_query("SELECT * FROM frndzk_category WHERE parent='$pages[shortname]'");
if ( @mysql_num_rows($resultf) > 0 ) {
echo'<ul>';
while($pagesy = @mysql_fetch_array($resultf)) {
echo '<li><a href="'.home_url().'/'.xenon_link_category().$pagesy['shortname'].'">'.$pagesy['name'].'</a></li>';
} echo'</ul>'; }
echo'</li>';
}
}
}
?>