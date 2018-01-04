<?php
global $post,$wpdb,$cs_theme_options,$cs_counter_node,$cs_team_post_section_title,$column_attributes,$cs_team_post_description,$cs_team_post_excerpt,$pageSidebar;
extract($wp_query->query_vars);
$width = '350';
$height = '350';
$title_limit = 1000;
$cs_layout = '';

/*if($pageSidebar <> "" && $pageSidebar > 0){
	$column_size= 'col-md-4';	
}else{
 	$column_size= 'col-md-3';	
}*/

if ( is_single() ) {
	
	$column_size= 'col-md-4';		
	
}else{
	 if($pageSidebar <> "" && $pageSidebar > 0){
 		$column_size= 'col-md-4';		
     }else{
		 
		$column_size= 'col-md-3';	 
		 
	 }
}




?>   
     <div class="widget element-size-100 widget-team">
              <div class="widget-section-title"><h6><?php echo esc_html($cs_team_post_section_title);?></h6></div> 
              <div class="cs-unistaff">  
        <?php
        $query = new WP_Query($args);
        $post_count = $query->post_count;
        if ($query->have_posts()) {
            $postCounter = 0;
            while ($query->have_posts()) : $query->the_post();
                $thumbnail = cs_get_post_img_src($post->ID, $width, $height);
                $cs_postObject = get_post_meta($post->ID, "cs_full_data", true);
				$cs_layout 				= get_post_meta( $post->ID, 'cs_page_layout' ,true);
				$cs_position_color = get_post_meta($post->ID, 'cs_position_color', true);
				$cs_team_title_color = get_post_meta($post->ID, 'cs_team_title_color', true);
			 
				
				$cs_team_position = get_post_meta($post->ID, 'cs_team_position', true);
				$cs_team_email = get_post_meta($post->ID, 'cs_team_email', true);
				$cs_team_specs_desc = get_post_meta($post->ID, 'cs_team_specs_desc', true);
				$cs_team_phone = get_post_meta($post->ID, 'cs_team_phone', true);
				$cs_team_facebook = get_post_meta($post->ID, 'cs_team_facebook', true);
				$cs_team_twitter = get_post_meta($post->ID, 'cs_team_twitter', true);
				$cs_team_google = get_post_meta($post->ID, 'cs_team_google', true);
				$cs_team_linkedin = get_post_meta($post->ID, 'cs_team_linkedin', true);
                ?> 
         
              
                <article>
                  <figure><a href="<?php esc_url(the_permalink());?>"><img src="<?php echo esc_url($thumbnail);?>"></a></figure>
                  <div class="cs-text">
                    <h5><a href="<?php esc_url(the_permalink());?>"><?php the_title(); ?></a></h5>
                    <span><?php echo cs_allow_special_char($cs_team_position);?></span>
                    <?php if($cs_team_email <> '') { ?>
                    <a href="mailto:<?php echo sanitize_email($cs_team_email);?>" class="email"><i class="icon-envelope4"></i><?php echo sanitize_email($cs_team_email);?></a>    
                    <?php } ?>
                  </div>
                </article>
           
             
                <?php
            endwhile;
        } else {
            _e('No team found.','cs_frame');
        }
        ?>
  </div>
             </div>