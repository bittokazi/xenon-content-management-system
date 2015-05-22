<?php
function xenon_search_action() {
if (isset($_POST['xenon-search-post']) && $_POST['xenon-search-post']!="" ) {
$search=defence_sql_injection($_POST['xenon-search-post']);
Header('Location: '.home_url().'/'.xenon_link_search().$search.'');
}
}
function xenon_search_field() {
echo'<form method="post" action="'.home_url().'/'.xenon_link_search().'">
<p><input type="text" value="" name="xenon-search-post"></p>
<input type="submit" name="save" value="Search" /></form>';
}
function xenon_search_title() {
if (isset($_GET['url'])) {
$d=strip_tags(defence_sql_injection($_GET['url']));
}
else{
$d="Not Found";
}
$result = @mysql_query("SELECT * FROM frndzk_post WHERE post LIKE'%$find%'");
if ( @mysql_num_rows($result) > 0 ) {
return $d;
}
elseif ( @mysql_num_rows($result) < 1 ) {
return'not found';
}
}
?>