<?php
ob_start();
session_start();
if(isset($_SESSION['bitto'])) 
{
header("Location: ../bitto.php");
} else {  
header("Location: ../login.php");
}
ob_flush();
?>