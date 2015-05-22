<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
echo'<h2>'; admin_title(); echo'</h2>';
postlist_admin();
add_post_content();
comment_pending_profile();
echo'<div style="border-width:3px; border-color:#A9A9A9; border-style:solid;"><h4>User Profile</h4></div>';
echo'<div style="border-width:3px; border-color:#A9A9A9; border-style:ridge; float:left;">';
echo'<div style="float:left; margin-left:100px;">'; user_profile_picture(user_name(),array()); echo'</div>';
echo'<div style="float:left; margin-left:100px;">'; xenon_user_profile(user_name(),array()); echo'</div>';
echo'</div>';
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>