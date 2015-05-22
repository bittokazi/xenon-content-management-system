<?php
ob_start();
if(isset($_SESSION['bitto'])) {
echo'		</div>
		<div id="right-column">
			<strong class="h">Profile</strong>
			<div class="box">';
			user_profile_picture(user_name(),array('img_height'=>'100px','img_width'=>'115px'));
			echo'Welcome, <a href="profile.php">('; echo $_SESSION['bitto']; echo')</a><br><br>';
			echo'Position: '.user_roll(); echo'<br>';
			 echo'Total Posts: '.user_post_count(user_name()); echo'<br><br>';
			 echo'Approved Comments: '.comment_count_approved(user_name()); echo'<br>';
			 echo'Pending Comments: '.comment_count_pending(user_name()); echo'<br><br>';
			echo'<a href="logout.php">Logout?</a>';
		echo'</div>
	    </div>
	</div>
	<div id="footer"><center><br>Copyright &copy; '.date('Y').' Xenon CMS<br><br></center></div>
</div>';

@xenon_footer_admin_panel();
echo'</body>
</html>';
} else { 
  header("Location: index.php"); 
}
ob_flush();
?>