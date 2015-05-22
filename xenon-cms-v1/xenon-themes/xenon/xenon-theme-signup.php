<?php xenon_add_header(); ?>
  
      <div id="templatemo_left_column">
 		<div class="text_area" align="justify">
<div class="title">Signup</div>
		<?php echo @xenon_signup_field();  ?>
       
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