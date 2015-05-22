<?php
function is_home() {
if(!isset($_GET['dir']) && !isset($_GET['view'])) {
$k=stripslashes(dirname($_SERVER['PHP_SELF']));
$addrs=str_replace("www.","",$_SERVER['SERVER_NAME']);
$k=str_replace("/","",$k);
if($k==''){ $d="http://".$addrs; }
else {
$d="http://".$addrs."/".$k."";
}
if ( home_url() == $d ) {
$result = @mysql_query("SELECT * FROM frndzk_title WHERE id ='5'");
if ( @mysql_num_rows($result) > 0 ) {
while($generalfp = @mysql_fetch_array($result)) {
if($generalfp['tagline']!="xenon_latest_page") {
global $xenon12345home;
$xenon12345home="home";
}
}
}
return true;
}
else { return false;
}
}
else {
return false;
}
}
function is_page() {
if(isset($_GET['dir']) && $_GET['dir'] == "page") {
return true;
}
elseif(!isset($_GET['dir']) && isset($_GET['view']) && $_GET['view'] == "page" ) {
return true;
}
else { return false;
}
}
function is_post() {
if(isset($_GET['dir']) && $_GET['dir'] == "post") {
return true;
}
elseif(!isset($_GET['dir']) && isset($_GET['view']) && $_GET['view'] == "post" ) {
return true;
}
else { return false;
}
}
function is_category() {
if(isset($_GET['dir']) && $_GET['dir'] == "category") {
return true;
}
elseif(!isset($_GET['dir']) && isset($_GET['view']) && $_GET['view'] == "category" ) {
return true;
}
else { return false;
}
}
function is_tags() {
if(isset($_GET['dir']) && $_GET['dir'] == "tag") {
return true;
}
elseif(!isset($_GET['dir']) && isset($_GET['view']) && $_GET['view'] == "tag" ) {
return true;
}
else { return false;
}
}
function is_search() {
if(isset($_GET['dir']) && $_GET['dir'] == "search") {
return true;
}
elseif(!isset($_GET['dir']) && isset($_GET['view']) && $_GET['view'] == "search" ) {
return true;
}
else { return false;
}
}
function is_author() {
if(isset($_GET['dir']) && $_GET['dir'] == "author") {
return true;
}
elseif(!isset($_GET['dir']) && isset($_GET['view']) && $_GET['view'] == "author" ) {
return true;
}
else { return false;
}
}
function is_signup() {
if(isset($_GET['dir']) && $_GET['dir'] == "signup") {
return true;
}
elseif(!isset($_GET['dir']) && isset($_GET['view']) && $_GET['view'] == "signup" ) {
return true;
}
else { return false;
}
}
function is_home_navi() {
if(isset($_GET['dir']) && $_GET['dir'] == "next") {
return true;
}
elseif(!isset($_GET['dir']) && isset($_GET['view']) && $_GET['view'] == "next" ) {
return true;
}
else { return false;
}
}
function home_page() {
global $xenon12345home;
if($xenon12345home=="home") {
return true;
}
else { return false; }
}
function is_blog() {
if (isset($_GET['url'])) {
$d=defence_sql_injection($_GET['url']);
}
else{
$d="";
}
if(is_page()) {
$result = @mysql_query("SELECT * FROM frndzk_title WHERE id ='5'");
if ( @mysql_num_rows($result) > 0 ) {
while($generalfp = @mysql_fetch_array($result)) {
if($generalfp['tagline']!="xenon_latest_page") {
$resultbp = @mysql_query("SELECT * FROM frndzk_title WHERE id ='6'");
if ( @mysql_num_rows($resultbp) > 0 ) {
while($generalbp = @mysql_fetch_array($resultbp)) {
if($generalbp['tagline']==$d) {
return true;
}
else {
return false;
}
}
}
}
else { return false;
}
}
}
}
else { return false;
}
}
function is_404() {
if(isset($_GET['dir'])) {
if( $_GET['dir'] == "signup" || $_GET['dir'] == "page" || $_GET['dir'] == "post" || $_GET['dir'] == "category" || $_GET['dir'] == "tag" || $_GET['dir'] == "author" || $_GET['dir'] == "search" || $_GET['dir'] == "p" ) {
return false;
}
else { return true; }
}
elseif(isset($_GET['view'])) {
if( $_GET['view'] == "signup" || $_GET['view'] == "page" || $_GET['view'] == "post" || $_GET['view'] == "category" || $_GET['view'] == "tag" || $_GET['view'] == "author" || $_GET['view'] == "search" || $_GET['view'] == "p") {
return false;
}
else { return true; }
}
else { return false;
}
}
function is_login_page() {
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
if ($parts[count($parts) - 1] == "login.php" ) {
return true;
}
else {
return false;
}
}
function is_admin_page() {
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
if ($parts[count($parts) - 1] == "admin.php" ) {
return true;
}
else {
return false;
}
}
function xenon_title() {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '1'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
return $general['title'];
}
}
}
function xenon_tagline() {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '1'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
return $general['tagline'];
}
}
}
//link stlye for page
function xenon_link_page() {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '4'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if ( $general['tagline'] == "text" ) {
return 'page/';
}
elseif ( $general['tagline'] == "number" ) {
return '?view=page&url=';
}
}
}
}
//link style post
function xenon_link_post() {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '4'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if ( $general['tagline'] == "text" ) {
return 'post/';
}
elseif ( $general['tagline'] == "number" ) {
return '?view=post&url=';
}
}
}
}
function xenon_link_post_rss() {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '4'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if ( $general['tagline'] == "text" ) {
return 'post/';
}
elseif ( $general['tagline'] == "number" ) {
return '?view=post&amp;url=';
}
}
}
}
//link style category
function xenon_link_category() {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '4'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if ( $general['tagline'] == "text" ) {
return 'category/';
}
elseif ( $general['tagline'] == "number" ) {
return '?view=category&url=';
}
}
}
}
//link style tags
function xenon_link_tag() {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '4'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if ( $general['tagline'] == "text" ) {
return 'tag/';
}
elseif ( $general['tagline'] == "number" ) {
return '?view=tag&url=';
}
}
}
}
function xenon_link_signup() {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '4'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if ( $general['tagline'] == "text" ) {
return 'signup';
}
elseif ( $general['tagline'] == "number" ) {
return '?view=signup';
}
}
}
}
function xenon_link_search() {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '4'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if ( $general['tagline'] == "text" ) {
return 'search/';
}
elseif ( $general['tagline'] == "number" ) {
return '?view=search&url=';
}
}
}
}
function xenon_link_author() {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '4'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if ( $general['tagline'] == "text" ) {
return 'author/';
}
elseif ( $general['tagline'] == "number" ) {
return '?view=author&url=';
}
}
}
}
function xenon_page_navi() {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id = '4'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if ( $general['tagline'] == "text" ) {
return '/';
}
elseif ( $general['tagline'] == "number" ) {
return '&p=';
}
}
}
}
function xenon_custom_link($name,$view) {
global $customlink;
global $customlinkview;
global $customlinki;
$customlink[$customlinki]=$name;
$customlinkview[$customlinki]=$view;
$customlinki++;
}
function is_custom() {
global $customlink;
global $customlinkview;
global $customlinki;
$i=0;
$d=0;
if(isset($_GET['dir']) && $_GET['dir']) {
$check=$_GET['dir'];
}
elseif(!isset($_GET['dir']) && isset($_GET['view'])) {
$check=$_GET['view'];
}
else {
return false;
}
if($customlink) {
foreach ($customlink as $customlinks) {
if ($customlinks==$check) {
global $customlinki;
$customlinki=$i;
$d=1;
return true;
}
$i++;
}
}
if($d==0){
return false;
}
}
?>