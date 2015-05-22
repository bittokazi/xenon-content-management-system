<?php
ob_start();
session_start(); 
if(isset($_SESSION['bitto'])) {
include('header.php');
// initializes header
if (isset($_GET['action']) && isset($_GET['widget']) && $_GET['action']=="edit" && !$_GET['widget']=="" ) {
edit_widget($_GET['widget']);
}
elseif (isset($_GET['action']) && isset($_GET['widget']) && isset($_POST['id']) && isset($_POST['widgetcontent']) && isset($_POST['title']) && $_GET['action']=="add" && $_GET['widget']=="item" && $_POST['id'] != "" && !$_POST['widgetcontent'] == "" && $_POST['title'] != "" && $_GET['action'] != "" && $_GET['widget'] != "" ) {
add_default_widget($_POST['title'], $_POST['id'], $_POST['widgetcontent']);
}
elseif (isset($_GET['action']) && isset($_GET['type']) && isset($_POST['content']) && isset($_POST['title']) && $_GET['action']=="add" && $_GET['type']=="custom" && $_POST['content'] != "" && $_POST['title'] != "" && $_GET['action'] != "" && $_GET['type'] != "" ) {
add_custom_widget($_POST['title'], $_POST['content']);
}
elseif (isset($_GET['action']) && isset($_GET['widgetname']) && isset($_GET['delete']) && $_GET['action']=="edit" && $_GET['widgetname'] != "" && $_GET['delete'] != "" && $_GET['action'] != "" ) {
delete_widget_confirm();
}
elseif (isset($_GET['action']) && isset($_GET['widgetname']) && isset($_GET['editwidget']) && $_GET['action']=="edit" && $_GET['widgetname'] != "" && $_GET['editwidget'] != "" && $_GET['action'] != "" ) {
edit_widget_item();
}
elseif (isset($_GET['action']) && isset($_GET['widget']) && isset($_GET['content']) && $_GET['action']=="delete" && $_GET['widget'] != "" && $_GET['content'] != "" && $_GET['action'] != "" ) {
delete_widget_true();
}
elseif (isset($_GET['action']) && isset($_GET['custom']) && $_GET['action']=="edit" && $_GET['custom'] != "" && $_GET['action'] != "" ) {
edit_custom();
}
elseif (isset($_GET['action']) && isset($_GET['custom-edit']) && isset($_POST['content']) && isset($_POST['title']) && $_GET['action']=="edit" && $_GET['custom-edit']=="confirm" && $_POST['content'] != "" && $_POST['title'] != "" && $_GET['action'] != "" && $_GET['custom-edit'] != "" ) {
edit_custom_confirm();
}
elseif (isset($_GET['action']) && isset($_GET['widgetitem']) && $_GET['action']=="edit" && $_GET['widgetitem'] == "name" && $_POST['title'] != "" && $_POST['id'] != "" && $_GET['action'] != "" ) {
edit_widget_item_action("name");
}
elseif (isset($_GET['action']) && isset($_GET['widgetitem']) && $_GET['action']=="edit" && $_GET['widgetitem'] == "content" && $_POST['widgetcontent'] != "" && $_POST['id'] != "" && $_GET['action'] != "" ) {
edit_widget_item_action("content");
}
elseif (isset($_GET['action']) && isset($_GET['custom']) && $_GET['action']=="delete" && $_GET['custom'] != "" && $_GET['action'] != "" ) {
delete_custom_widget();
}
else {
widgets_content(); echo'<br><br><br>';
show_xenon_widget('side-bar',
array('before_widget' => '<div>',
'after_widget' => '</div>',
'before_content' => '<div>',
'after_content' => '</div>'
));
}
// initializes footer
include('footer.php');
} else {
  header("Location: index.php");
}
ob_flush();
?>