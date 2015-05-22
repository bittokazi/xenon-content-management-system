<?php
function bdwave_s24() {
$pi=defence_sql_injection($_GET['url']);
$result1a = @mysql_query("SELECT * FROM bdwave_cc WHERE post='$pi'");
if ( @mysql_num_rows($result1a) > 0 ) {
while($general1a = @mysql_fetch_array($result1a)) {
$c=$general1a['count']+1;
$query="UPDATE bdwave_cc SET count = '$c'
WHERE post = '$pi'";
@mysql_query($query);
}
}
else {
$query="INSERT INTO bdwave_cc VALUES ('','$pi','1')";
@mysql_query($query);
}
}
function xenon_comment_template() {
if (is_page() || is_post()) {
add_comment();
$result = @mysql_query("SELECT * FROM frndzk_commenton
WHERE id = '3'");
if ( @mysql_num_rows($result) > 0 ) {
while($general = @mysql_fetch_array($result)) {
if($general['commenter']=="true") {
if (isset($_GET['url'])) {
$d=defence_sql_injection($_GET['url']);
}
else{
$d="";
}
if (is_post()) {
$result = @mysql_query("SELECT * FROM frndzk_post WHERE shortname='$d'");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
if($pages['comstts']=="yes") {
echo'<form method="post" action="">
<input type="hidden" name="postedby" value="'.$pages['postedby'].'">
<input type="hidden" name="shortname" value="'.$d.'">
<p>Name:</p><p><input type="text" name="name"/></p>
<p>Email:</p><p><input type="text" name="comemail"></p>
<p>Website:</p><p><input type="text" name="website"></p>
<p>Comment:</p><p><textarea name="comment" rows="10" cols="20"></textarea></p>
<input type="submit" name="submit-xenon-comment" value="Submit Comment" /></form>';
}
else { echo'Comment Disabled'; }
}
}
}
elseif (is_page()) {
$result = @mysql_query("SELECT * FROM frndzk_page WHERE shortname='$d'");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
if($pages['comstts']=="yes") {
echo'<form method="post" action="">
<input type="hidden" name="postedby" value="xenon-pages">
<input type="hidden" name="shortname" value="'.$d.'">
<p>Name:</p><p><input type="text" name="name"/></p>
<p>Email:</p><p><input type="text" name="comemail"></p>
<p>Website:</p><p><input type="text" name="website"></p>
<p>Comment:</p><p><textarea name="comment" rows="10" cols="20"></textarea></p>
<input type="submit" name="submit-xenon-comment" value="Submit Comment" /></form>';
}
else { echo'Comment Disabled'; }
}
}
}
}
else { echo'Comment Disabled'; }
}
}
}
}
function add_comment() {
if (isset($_POST['name']) && isset($_POST['comemail']) && isset($_POST['website']) && isset($_POST['comment']) && isset($_POST['shortname']) && $_POST['name']!="" && $_POST['comemail']!="" && $_POST['shortname']!="" && $_POST['comment']!="" ) {
$name=defence_sql_injection($_POST['name']);
$email=defence_sql_injection($_POST['comemail']).','.defence_sql_injection($_POST['website']);
$comment=defence_sql_injection($_POST['comment']);
$shortname=defence_sql_injection($_POST['shortname']);
$postedby=defence_sql_injection($_POST['postedby']);
$query="INSERT INTO frndzk_comment VALUES ('','$name','$email','pending','$comment','$shortname','$postedby')";
@mysql_query($query);
bdwave_s24();
echo'Thanks for yor Comment!';
}
}
function comment_pending() {
echo'
<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Name</th>
						<th>Email</th>
						<th>website</th>
						<th>Post</th>
						<th>comment</th>
						<th class="last">Aproove/delete</th>
					</tr>';
					if( user_roll()=="administrator" || user_roll()=="moderator" ) {
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE commenter='pending'  ORDER by id desc");
}
elseif (user_roll()=="user") {
$un=user_name();
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE postedby='$un' AND commenter='pending'  ORDER by id desc");
}
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
					echo'<tr>
						<td class="first style1">' . $pages['name'] . '</td>';
						$es=explode(',',$pages['website']);
						$i=0;
						foreach($es as $e)
						{
						if($i==2) { break; }
						echo'<td>' . $e . '</td>';
						$i=$i+1;
						}
					echo'<td>'.$pages['post'].'</td>';
					echo'<td>'.$pages['comment'].'</td>';
					echo'<td><a href="comment.php?action=approve&number=single&id=' . $pages['id'] . '"><img src="img/save-icon.gif" width="16" height="16" alt="" /></a><a href="comment.php?action=deleted&number=single&id=' . $pages['id'] . '"><img src="img/hr.gif" width="16" height="16" alt="" /></a></td>
						</tr>'; }
				}
				echo'</table>';
}
function approved_list() {
echo'
<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Name</th>
						<th>Email</th>
						<th>website</th>
						<th>Post</th>
						<th>comment</th>
						<th class="last">Aproove/delete</th>
					</tr>';
					if( user_roll()=="administrator" || user_roll()=="moderator" ) {
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE commenter='approved'  ORDER by id desc");
}
elseif (user_roll()=="user") {
$un=user_name();
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE postedby='$un' AND commenter='approved'  ORDER by id desc");
}
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
					echo'<tr>
						<td class="first style1">' . $pages['name'] . '</td>';
						$es=explode(',',$pages['website']);
						$i=0;
						foreach($es as $e)
						{
						if($i==2) { break; }
						echo'<td>' . $e . '</td>';
						$i=$i+1;
						}
					echo'<td>'.$pages['post'].'</td>';
					echo'<td>'.$pages['comment'].'</td>';
					echo'<td><a href="comment.php?action=pending&number=single&id=' . $pages['id'] . '"><img src="img/save-icon.gif" width="16" height="16" alt="" /></a><a href="comment.php?action=delete&number=single&id=' . $pages['id'] . '"><img src="img/hr.gif" width="16" height="16" alt="" /></a></td>
						</tr>'; }
				}
				echo'</table>';
}
function comment_approve() {
$id=defence_sql_injection($_GET['id']);
if (user_roll()=="user") {
$un=user_name();
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE postedby='$un' AND id='$id'");
}
else {
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE id='$id'");
}
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$query="UPDATE frndzk_comment SET commenter = 'approved'
WHERE id='$id'";
mysql_query($query);
echo'<br>comment approved<br>';
}
}
}
function comment_pending_action() {
$id=defence_sql_injection($_GET['id']);
if (user_roll()=="user") {
$un=user_name();
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE postedby='$un' AND id='$id'");
}
else {
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE id='$id'");
}
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$query="UPDATE frndzk_comment SET commenter = 'pending'
WHERE id='$id'";
mysql_query($query);
echo'<br>comment again pending<br>';
}
}
}
function comment_delete() {
$id=defence_sql_injection($_GET['id']);
if (user_roll()=="user") {
$un=user_name();
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE postedby='$un' AND id='$id'");
}
else {
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE id='$id'");
}
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
$query="DELETE FROM frndzk_comment WHERE id = '$id'";
mysql_query($query);
echo'<br>Comment deleted<br>';
}
}
}
function comment_count_approved($un) {
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE postedby='$un' AND commenter='approved'");
return @mysql_num_rows($result);
}
function comment_count_pending($un) {
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE postedby='$un' AND commenter='pendint'");
return @mysql_num_rows($result);
}
function comment_pending_profile() {
echo'
<h2>Latest 10 Comments</h2>
<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Name</th>
						<th>Email</th>
						<th>website</th>
						<th>Post</th>
						<th class="last">Aproove/delete</th>
					</tr>';
					if( user_roll()=="administrator" || user_roll()=="moderator" ) {
					$un=user_name();
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE postedby='$un' AND commenter='pending'  ORDER by id desc LIMIT 0,10");
}
elseif (user_roll()=="user") {
$un=user_name();
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE postedby='$un' AND commenter='pending'  ORDER by id desc LIMIT 0,10");
}
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
					echo'<tr>
						<td class="first style1">' . $pages['name'] . '</td>';
						$es=explode(',',$pages['website']);
						$i=0;
						foreach($es as $e)
						{
						if($i==2) { break; }
						echo'<td>' . $e . '</td>';
						$i=$i+1;
						}
					echo'<td>'.$pages['post'].'</td>';
					echo'<td><a href="comment.php?action=approve&number=single&id=' . $pages['id'] . '"><img src="img/save-icon.gif" width="16" height="16" alt="" /></a><a href="comment.php?action=deleted&number=single&id=' . $pages['id'] . '"><img src="img/hr.gif" width="16" height="16" alt="" /></a></td>
						</tr>'; }
				}
				echo'</table>';
}
function xenon_comment_list($array,$loc) {
if(!isset($loc) || $loc=='') { $loc=home_url().'/xenon.png'; } else { $loc=home_url().'/xenon-themes/'.current_theme_name().$loc; }
if ( !isset($array['before_comment']) ) {
$array['before_comment']='';
}
if ( !isset($array['before_comment']) ) {
$array['before_comment']='';
}
if ( !isset($array['after_comment']) ) {
$array['after_comment']='';
}
if ( !isset($array['before_name']) ) {
$array['before_name']='';
}
if ( !isset($array['after_name']) ) {
$array['after_name']='';
}
if ( !isset($array['before_website']) ) {
$array['before_website']='';
}
if ( !isset($array['after_website']) ) {
$array['after_website']='';
}
if ( !isset($array['before_msg']) ) {
$array['after_msg']='';
}
if ( !isset($array['after_msg']) ) {
$array['after_msg']='';
}
if(is_post()){
$sn=defence_sql_injection($_GET['url']);
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE post='$sn' AND commenter='approved'  ORDER by id desc");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
if($pages['postedby']!='xenon-pages') {

					echo $array['before_comment'].'<div style="float:left; width:75px;"><img height="75px" width="75px" src="'.$loc.'"/></div><div style="margin-left:100px;">'.$array['before_name'].'Name :' . $pages['name'] . $array['after_name'].'<br>';
						$es=explode(',',$pages['website']);
						$i=0;
						foreach($es as $e)
						{
						if($i==2) { break; }
if($i==1) {
						echo $array['before_website'].'Website :<a target="_blank" href="http://' . $e . '">'.$e.'</a>'.$array['after_website'].'<br>';
}
						$i=$i+1;
						}
					echo $array['before_msg'].'Said : '.$pages['comment'].$array['after_msg'].'</div>'.$array['after_comment'].'<br><br>';  } }
				}


}
else if(is_page()) {
$sn=defence_sql_injection($_GET['url']);
$result = @mysql_query("SELECT * FROM frndzk_comment WHERE post='$sn' AND commenter='approved' AND postedby='xenon-pages'  ORDER by id desc");
if ( @mysql_num_rows($result) > 0 ) {
while($pages = @mysql_fetch_array($result)) {
					echo $array['before_comment'].$array['before_name'].'Name :' . $pages['name'] . $array['after_name'].'<br>';
						$es=explode(',',$pages['website']);
						$i=0;
						foreach($es as $e)
						{
						if($i==2) { break; }
if($i==1) {
						echo $array['before_website'].'Website :<a target="_blank" href="http://' . $e . '">'.$e.'</a>'.$array['after_website'].'<br>';
}
						$i=$i+1;
						}
					echo $array['before_msg'].'Said : '.$pages['comment'].$array['after_msg'].$array['after_comment'].'<br><br>'; }
				}


}
}
?>