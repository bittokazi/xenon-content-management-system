<?php 
ob_start();
if(isset($_SESSION['bitto'])) {
require('../frndzk.php');
include('../xenon-core.php');
incliude_directory_admin ();
include('../xenon-rpc.php');
execute_xenon_addons_admin();
execute_xenon_themef_admin();
global $accessrol;
if ( $accessrol == "1" && user_roll() == "moderator" ) {
  header("Location: index.php"); 
}
elseif ( $accessrol == "1" && user_roll() == "user" ) {
  header("Location: index.php"); 
}
elseif ( $accessrol == "2" && user_roll() == "user" ) {
  header("Location: index.php"); 
}
else {
}
echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>'; admin_title(); echo'</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>';
//tinymce editor
echo"
<script type=\"text/javascript\" src=\"jscripts/tiny_mce/tiny_mce.js\"></script>
<script type=\"text/javascript\">
	tinyMCE.init({
		// General options
        mode : \"specific_textareas\",
        editor_selector : \"tinymces\",
		theme : \"advanced\",
        elements : 'nourlconvert',
        relative_urls : false,
		plugins : \"autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks\",
        width: \"100\",
        height: \"300\",
		
		// Theme options
		theme_advanced_buttons1 : \"save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect\",
		theme_advanced_buttons2 : \"cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor\",
		theme_advanced_buttons3 : \"tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell\",
		theme_advanced_buttons4 : \"insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks\",
		theme_advanced_buttons5 : \"image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor\",
		theme_advanced_buttons6 : \"media,advhr,|,print,|,ltr,rtl,|,fullscreen\",
		theme_advanced_toolbar_location : \"top\",
		theme_advanced_toolbar_align : \"left\",
		theme_advanced_statusbar_location : \"bottom\",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : \"css/content.css\",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : \"lists/template_list.js\",
		external_link_list_url : \"lists/link_list.js\",
		external_image_list_url : \"lists/image_list.js\",
		media_external_list_url : \"lists/media_list.js\",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : \"Some User\",
			staffid : \"991234\"
		}
	});
</script>
<!-- /TinyMCE -->
";
//tinymce finish	
echo'</head>
<body role="application">
<div id="main">
	<div id="header">
		<a href="admin.php" class="logo"><img src="img/logo.png" width="195" height="101" alt="Xenon CMS logo" /></a>
		<ul id="top-navigation">
				';
                xenon_admin_menu('top');
				echo'
		</ul>
	</div>
	<div id="middle">
		<div id="left-column">';
		if ( user_roll() == "administrator" ) { echo'
			<h3>Page</h3>
			<ul class="nav">
				';
                xenon_admin_menu('page');
				
				echo'
			</ul>'; }
		if ( user_roll() == "administrator" || user_roll() == "moderator" || user_roll() == "user" ) { 
			echo'<h3>Post</h3>
			<ul class="nav">
				';
                xenon_admin_menu('post');
				echo'
			</ul>'; }
		if ( user_roll() == "administrator" || user_roll() == "moderator" || user_roll() == "user" ) { 
			echo'<h3>User</h3>
			<ul class="nav">
				';
                xenon_admin_menu('user');
				echo'
			</ul>'; }
		if ( user_roll() == "administrator" ) {
			echo'<h3>Themes</h3>
			<ul class="nav">
				';
                xenon_admin_menu('theme');
				xenon_admin_menu('themepage');
				echo'
			</ul>'; }
		if ( user_roll() == "administrator" ) { 
			echo'<h3>Addon</h3>
			<ul class="nav">
				';
                xenon_admin_menu('addon');
				echo'
			</ul>'; }
		if ( user_roll() == "administrator" ) { 
			echo'<h3>Settings</h3>
			<ul class="nav">
				';
                xenon_admin_menu('settings');
				echo'
			</ul>'; }
                xenon_admin_menu('sidetop');
				xenon_admin_menu('addonpage');
				echo'
		</div>
		<div id="center-column">
		';
} else { 
  header("Location: index.php"); 
}
ob_flush();
?>