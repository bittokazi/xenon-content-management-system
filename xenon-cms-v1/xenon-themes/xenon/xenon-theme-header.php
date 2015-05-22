<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php
if (is_home()) { echo xenon_title().' | '.xenon_tagline(); }
elseif (is_home_navi()) { echo'next page'; }
elseif(is_page()) { echo page_title(); }
elseif(is_post()) { echo post_title(); }
elseif(is_category()) { echo category_title(); }
elseif(is_tags()) { echo xenon_tag_title(); }
elseif(is_search()) { echo xenon_search_title(); }
elseif(is_author()) { echo author_title(); }
elseif(is_404()) { echo'Not Found - 404'; }
elseif(is_signup()) { echo 'Signup'; }
else { echo'404 not found'; } ?></title>
<link href="<?php echo theme_location(); ?>/templatemo_style.css" rel="stylesheet" type="text/css" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<?php xenon_header(); ?>
</head>
<body>
<!--
This is a free CSS template provided by templatemo.com
-->
<div id="templatemo_container_wrapper">
	<div class="templatemo_spacer"></div>
<div id="templatemo_container">
<div id="templatemo_top">

<!-- Start css3menu.com BODY section id=3 -->
<ul id="css3menu5" class="topmenu">
	<li class="topfirst"><a <?php if (is_home()) { echo 'class="pressed"'; } else { } ?> href="<?php echo home_url(); ?>">Home</a></li>
			            <?php
            show_xenon_menu('upper-menu',
array('before_menu' => '',
'after_menu' => '',
'before_link' => '<li class="topmenu">',
'after_link' => '</li>',
'current_anchor_class' => 'pressed'
)); ?>
</ul>
<!-- End css3menu.com BODY section -->

</div>
  <div id="templatemo_header">
      <div id="inner_header">
	  <a href="<?php echo home_url(); ?>"><div id="templatemo_site_title"><?php echo xenon_title(); ?></div>
          <div id="templatemo_site_slogan"><?php echo xenon_tagline(); ?></div></a>
      </div>
  </div>