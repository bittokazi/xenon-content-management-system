<?php
ob_start(); 
session_start(); 
if(isset($_SESSION['bitto'])) {
header("Location: admin.php");
exit;
}
else{
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 

"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Xenon CMS</title>
<meta name="Robots" content="noindex,nofollow" />
<link href="login-box.css" rel="stylesheet" type="text/css" />
</head>
<body>
<center>
<div class="logo-xenon"><p><img src="img/logo.png" alt="xenon cms" title="Xenon Content Management System"></p></div>
<div id="login-main">
<h4>Xenon Content Management System</h4>
<p><img src="images/line.png"></p>
<?php 
				include('../xenon-core.php');
				incliude_directory_admin ();
				include('../xenon-rpc.php');
xenon_login_check();
?>
<form method="post" action=""> Username: <input name="un" input type="text" class="tb7"><br><br>
Password: <input name="pw" input type="password" class="tb7"><br>
<input type="submit" value="Login"> </form>
<p><b>Reset Password</b></p>
<p><img src="images/line.png"></p>
<?php
xenon_reset_password();
?>
<form method="post" action=""> Email address: <input name="email" input type="text" class="tb7"><br> <input  
type="submit" value="Reset Password"> </form>
<br>
<br>
<br>

</div>








<br><br><br><br>
<font face="Comic Sans MS" color="#696969">
<h6>Copyright &copy; <?php echo date('Y'); ?> Xenon CMS</h6><font>
</center>
</body>
</html>
<?php 
ob_flush(); 
?>