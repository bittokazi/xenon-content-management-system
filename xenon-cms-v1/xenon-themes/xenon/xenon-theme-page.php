<?php xenon_add_header(); ?>
  
      <div id="templatemo_left_column">
 		<div class="text_area" align="justify">
		<?php while ( show_count() < post_count() ) { global $posts,$lolzzc; echo '<div class="title"><a href="'.content_link().'">'.the_title().'</a></div>'; echo the_content();  end_post(); } echo error_404();  ?>
		<br>
       <?php xenon_comment_template(); ?>
       <br>
	   <h2>Comments</h2>
	   <?php xenon_comment_list(); ?>
        </div>
      </div>
    
    	<div id="templatemo_right_column">
		  <?php
            show_xenon_widget('side-bar',
array('before_widget' => '',
'after_widget' => '',
'before_title' => '<div class="section_box" align="justify">
            <div class="subtitle">',
'after_title' => '</div>',
'before_content' => '',
'after_content' => '</div>'
)); ?>
        </div>

<?php xenon_add_footer(); ?>