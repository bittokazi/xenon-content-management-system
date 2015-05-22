<?php
ob_start();
session_start();
if(isset($_SESSION['bitto'])) {
session_destroy();
header("Location: index.php");
} else {
header("Location: index.php");
}
ob_flush();
?>