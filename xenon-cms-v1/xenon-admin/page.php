<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header

echo'<h2>'; admin_title(); echo'</h2>';
page_deleted();
//pagelist
pagelist();
					echo'
				</table>
				';
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>