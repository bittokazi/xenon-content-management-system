<?php
function xenon_tag_title() {
if (isset($_GET['url'])) {
$d=strip_tags(defence_sql_injection($_GET['url']));
}
else{
$d="Not Found";
}
$result = @mysql_query("SELECT * FROM frndzk_post WHERE tags LIKE'%$find%'");
if ( @mysql_num_rows($result) > 0 ) {
return $d;
}
elseif ( @mysql_num_rows($result) < 1 ) {
return'not found';
}
}
?>