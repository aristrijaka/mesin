<?php
/**
 * The template for Event Detail
 */
  	get_header();	
	
	global $post, $cs_theme_options;
	$cs_uniq = rand(11111111, 99999999);
	$cs_postObject = get_post_meta( $post->ID, 'cs_full_data' ,true);
 	$cs_layout = '';
	$leftSidebarFlag		= false;
	$rightSidebarFlag		= false;
	
	$cs_layout 				= get_post_meta( $post->ID, 'cs_page_layout' ,true);
	$cs_sidebar_left		= get_post_meta( $post->ID, 'cs_page_sidebar_left' ,true);
	$cs_sidebar_right		= get_post_meta( $post->ID, 'cs_page_sidebar_right' ,true);	
	$post_tags_show			= get_post_meta( $post->ID, 'cs_post_tags_show' ,true);
	
	$cs_port_gallery = get_post_meta($post->ID, 'cs_port_gallery', true);
	$cs_port_gallery_title = get_post_meta($post->ID, "cs_attachments_title", true);
	$cs_port_list_gallery = get_post_meta($post->ID, "cs_port_list_gallery", true); // check whatever gallery exists or not
	
	/*************** New Filed ***************/
	$cs_course_duration = get_post_meta($post->ID, "cs_course_duration_period", true); // course duration
	$cs_course_price = get_post_meta($post->ID, "cs_course_price", true); // course price
	$cs_course_code = get_post_meta($post->ID, "cs_course_code", true); // course code
	$cs_degree_levels = get_post_meta($post->ID, "cs_degree_levels", true); // degree level
	$cs_degree_level_bg_color = get_post_meta($post->ID, "cs_degree_level_bg_color", true);
	$cs_user_instructors = get_post_meta($post->ID, "cs_user_instructors", true); // instructor id
	$cs_buy_url = get_post_meta($post->ID, "cs_buy_url", true);  // buy url
	$cs_price_title = get_post_meta($post->ID, "cs_price_title", true);  // price title
	
	$cs_course_campus_id = get_post_meta($post->ID, "cs_course_campus_id", true);  // campus id
	$cs_team_shortcode_title = get_post_meta($post->ID, "cs_team_shortcode_title", true);  // campus id
	$cs_tabs_title = get_post_meta($post->ID, "cs_tabs_title", true);  // campus id
	$cs_course_team_ids = get_post_meta($post->ID, "cs_course_team_ids", true);  // campus id
	
	
	$address=''; 
	
	$cs_location_address = get_post_meta($cs_course_campus_id, "cs_location_address", true);
	$cs_loc_city = get_post_meta($cs_course_campus_id, "cs_loc_city", true);
	$cs_map_switch = get_post_meta($cs_course_campus_id, "cs_map_switch", true);
	$cs_loc_region = get_post_meta($cs_course_campus_id, "cs_loc_region", true);
	$cs_loc_country = get_post_meta($cs_course_campus_id, "cs_loc_country", true);
	
	$cs_loc_latitude   = get_post_meta($cs_course_campus_id, "cs_loc_latitude", true);
	$cs_loc_longitude = get_post_meta($cs_course_campus_id, "cs_loc_longitude", true);
	
	
	if($cs_location_address <> ""){
	 $address .=$cs_location_address;	
	}
	if($cs_loc_city <> ""){
	 $address .= ','.$cs_loc_city;	
	}
	if($cs_loc_region <> ""){
	 $address .= ','.$cs_loc_region;	
	}
	if($cs_loc_country <> ""){
	 $address .= ','.$cs_loc_country;	
	}
			
			
	$cs_course_from_date = date_i18n('D, F j, Y', strtotime(get_post_meta($post->ID, "cs_course_from_date", true))); // start date
	$cs_course_start_time = get_post_meta($post->ID, "cs_course_start_time", true);  // course start time
	$cs_course_end_time = get_post_meta($post->ID, "cs_course_end_time", true);  //   course end time
	$cs_tab_option_shortcode = get_post_meta($post->ID, "cs_tab_option_shortcode", true); // tab short code
	$cs_team_shortcode = get_post_meta($post->ID, "cs_team_shortcode", true);  //   team short code
			
	$the_title = substr(get_the_title(),0,40); // the title
	//$the_content = substr(the_content(),0,45); // the conetnt
	
	// get user information
	$user_instructor_name	= '';
	if( isset( $cs_user_instructors ) && !empty( $cs_user_instructors ) ) {
		$user = get_user_by( 'id', $cs_user_instructors );
		if( isset( $user ) &&  !empty( $user ) ) { 
			$user_instructor_name  =  $user->first_name . ' ' . $user->last_name;
		}
	}
	
	// get terms against specific post
		$term_list = wp_get_post_terms($post->ID , 'course-category', array("fields" => "all"));
		$terms='';
		for($i= 0 ; $i < sizeof($term_list); $i++){
			$terms .=  '<li><a  href="' . esc_url(get_term_link($term_list[$i]->slug, 'course-category')) . '">'.esc_attr($term_list[$i]->name).'</a></li>';   
		}
		
	/**************New Fileds*************/
	if ( $cs_layout == "left") {
		$cs_layout = "page-content";
		$leftSidebarFlag	= true;
	}else if ( $cs_layout == "right" ) {
		$cs_layout = "page-content";
		$rightSidebarFlag	= true;
	}else {
		$cs_layout = "page-content-fullwidth";
	}
	$width = 818;
	$height = 460;
	?>

<div class="container">
  <div class="row">
    <?php 
	   if ( $leftSidebarFlag == true ) { 
		?>
    <aside class="page-sidebar">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_left) ) : ?>
      <?php endif; ?>
    </aside>
    <?php } ?>
    <div class="<?php echo esc_html($cs_layout);?>">
      <section class="page-section">
        <div class="section-fullwidth">
          <div class="cs-course-detail">
            <?php 
                if (have_posts()):
					while (have_posts()) : the_post();	
					$cs_tags_name = 'course-tag';
					$cs_categories_name = 'course-category';
					$postname = 'course';						
					$image_url = cs_get_post_img_src($post->ID, $width, $height);
                ?>
            <div class="cs-heading-sec">
              <div class="inner-sec">
                <h1>
                  <?php the_title() ?>
                </h1>
              </div>
            </div>
            <div class="cs-detail-area">
              <?php if( $image_url <> '' ){ ?>
              <figure> <img src="<?php echo esc_url($image_url) ?>" alt="<?php the_title() ?>"> </figure>
              <?php } ?>
              <div class="detail-block">
                <ul class="course-tags">
                  <?php echo cs_allow_special_char($terms);?>
                  <li class="red" style="background:<?php echo cs_allow_special_char($cs_degree_level_bg_color);?>!important;"><?php echo cs_allow_special_char($cs_degree_levels);?></li>
                </ul>
                <?php if(isset($cs_course_from_date) && $cs_course_from_date <> "") {?>
                <span class="start-date"><i class="icon-calendar10"></i> <?php  _e('Starts from:','cs_frame'); echo esc_html($cs_course_from_date);?></span>
           
                <?php }?>
                <?php if($cs_course_start_time  <> ""  && $cs_course_start_time <> "") {?>
                <span class="timing"><i class="icon-clock6"></i>
				<?php echo date('g:i',strtotime( $cs_course_start_time)); echo date('A',strtotime( $cs_course_start_time ));?> 
                <?php }?>
                <?php if($cs_course_end_time  <> ""  && $cs_course_end_time <> "") {?>
                - <?php echo date('g:i',strtotime( $cs_course_end_time));?><?php echo date('A',strtotime( $cs_course_end_time ));?>
                
				</span> 
                <?php }?>
                <div class="address-box">
                  <?php if( $cs_course_from_date <> "" && $cs_buy_url <> "" && $cs_price_title <> "" ){?>
                  <div class="price-box"> <span class="price"><?php echo esc_html($cs_course_price);?></span> <a href="<?php echo esc_url($cs_buy_url);?>"><?php echo esc_html($cs_price_title);?></a> </div>
                  <?php }?>
                <address>
        
                            <span class="title"><?php _e('Campus Location','cs_frame');?></span>
                            <?php echo'<p>';echo esc_attr( $address ); echo'</p>';
							
						 if(isset($cs_map_switch) and $cs_map_switch =="on") { 
					 
							?>
                            <a href="#" class="map-btn"><?php _e('Map it','cs_frame');?></a>
                            <?php } ?>
                           </address>
                     
                </div>
              </div>
            </div>
            
                <div class="cs-map-view">
                <div class="row">
                    <?php 
				 	echo do_shortcode('[cs_map column_size="1/1" map_height="250" map_lat="'.$cs_loc_latitude.'" map_lon="'.$cs_loc_longitude .'" map_zoom="11" map_type="ROADMAP" map_info="'.$address.'" map_info_width="250" map_info_height="100" map_marker_icon1xis="Browse" map_show_marker="true" map_controls="false" map_draggable="true" map_scrollwheel="true" map_border="yes" cs_map_style="style-1"]');
					  
				$cs_port_proc_title = get_post_meta($post->ID, 'cs_port_proc_title', true);
				$cs_get_proc_list = get_post_meta($post->ID, 'cs_proc_list_array', true);
				$cs_proc_names = get_post_meta($post->ID, 'cs_proc_name_array', true);
				$cs_proc_descs = get_post_meta($post->ID, 'cs_proc_description_array', true);
				$cs_proc_icons = get_post_meta($post->ID, 'cs_proc_icon_array', true);	 
                                ?>
                </div>    </div>
         
            <div class="cs-features">
              <?php if ($cs_port_proc_title != '') { ?>
              <h5><?php echo esc_html($cs_port_proc_title);?></h5>
              <?php }
               
                    if (isset($cs_get_proc_list
                            ) && is_array($cs_get_proc_list) && count($cs_get_proc_list) > 0) { ?>
              <ul>
                <?php
					$proc_counter = 1;
					$cs_proc_counter = 0;
					$j = 0;
					
					foreach ($cs_get_proc_list as $proc_list) {
						if (isset($proc_list) && $proc_list <> '') {
						
							$counter_extra_feature = $extra_feature_id = $proc_list;
							$cs_proc_name = isset($cs_proc_names[$cs_proc_counter]) ? $cs_proc_names[$cs_proc_counter] : '';
							$cs_proc_description = isset($cs_proc_descs[$cs_proc_counter]) ? $cs_proc_descs[$cs_proc_counter] : '';
							$cs_proc_icon = isset($cs_proc_icons[$cs_proc_counter]) ? $cs_proc_icons[$cs_proc_counter] : '';
							
							if($cs_proc_icon <> ""){
								$icon  = $cs_proc_icon;
							}else{
								$icon  = 'icon-barcode3';	
							}
						?>
                            <li>
								<?php if( isset( $icon ) && !empty( $icon ) ) {?>
                                <i class="<?php echo esc_html($icon);?>"></i>
                                <?php }?>
                                <div class="feat-detail"> 
                                <span class="title"><?php echo esc_attr($cs_proc_name) ?></span> 
                                <span class="value"><?php echo do_shortcode($cs_proc_description) ?></span> </div>
                            </li>
                	<?php }
							 
							 		$proc_counter++;
									$cs_proc_counter++;
								if($j == 5){ $j =0;}
								$j++;
							} ?>
              </ul>
              <?php 	} ?>
            </div>
            <div class="cs-detail-text">
              <h5><?php _e('Class Description','cs_frame');?></h5>
              <?php the_content(); 
			  if( isset( $cs_tabs_title ) && !empty( $cs_tabs_title ) ) {?>
              <h5><?php echo esc_attr( $cs_tabs_title );?></h5>
              <?php }?>
			  
			  <?php
                if(isset($cs_tab_option_shortcode)){
                    echo do_shortcode($cs_tab_option_shortcode);
                }
              ?>
            </div>
    <div class="cs-team team-box">
    <?php cs_enqueue_flexslider_script();?>           
		<script>
			jQuery(window).load(function() {
				jQuery('.cs-team-slider').flexslider({
					slideshowSpeed: 4000,
					animationDuration: 1100,
					animation: 'slide',
					directionNav: true,
					controlNav: false,
					prevText: "<i class='icon-arrow-left10'></i>",
					nextText: "<i class='icon-arrow-right10'></i>",
				});
			});
        </script>
        
            <?php 
			 if (isset($cs_course_team_ids) && is_array($cs_course_team_ids) && count($cs_course_team_ids) > 0) { 
				$args = array('posts_per_page' => "-1", 'post_type' => 'teams', 'order' => "", 'orderby' => 'ID', 'post_status' => 'publish','post__in' => $cs_course_team_ids);
				$query = new WP_Query($args);
				$post_count = $query->post_count;
			?>   
               
               		 <h5><?php echo esc_html($cs_team_shortcode_title);?></h5>
                        <div class="cs-team-slider">
                        <ul class="slides">
             	  <?php
				   if ($query->have_posts()) { 
					  while ($query->have_posts()) : $query->the_post();
					  
					 		$thumbnail = cs_get_post_img_src($post->ID, $width, $height);
							$cs_postObject = get_post_meta($post->ID, "cs_full_data", true);
							$cs_position_color = get_post_meta($post->ID, 'cs_position_color', true);
							$cs_team_title_color = get_post_meta($post->ID, 'cs_team_title_color', true);
							$cs_description_color = get_post_meta($post->ID, 'cs_description_color', true);
							
							$cs_postObject = get_post_meta($post->ID, "cs_full_data", true);
							$cs_team_position = get_post_meta($post->ID, 'cs_team_position', true);
							$cs_team_email = get_post_meta($post->ID, 'cs_team_email', true);
							$cs_team_specs_desc = get_post_meta($post->ID, 'cs_team_specs_desc', true);
							$cs_team_phone = get_post_meta($post->ID, 'cs_team_phone', true);
							$cs_team_facebook = get_post_meta($post->ID, 'cs_team_facebook', true);
							$cs_team_twitter = get_post_meta($post->ID, 'cs_team_twitter', true);
							$cs_team_google = get_post_meta($post->ID, 'cs_team_google', true);
							$cs_team_linkedin = get_post_meta($post->ID, 'cs_team_linkedin', true);
					 ?>
                          <li>
                            <div class="graybackground">
                              <div class="media">
                              <?php if($thumbnail <> '') { ?>
                                <div class="media-left">
                                  <div class="overlayslide-team">
                                    <a href="<?php esc_url(the_permalink()); ?>">
                                      <img class="media-object" src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo cs_get_post_img_title($post->ID); ?>">
                                    </a>
                                  </div>
                                </div>
                                <?php } ?>
                                <div class="media-body">
                                  <h4 ><a href="<?php esc_url(the_permalink()); ?>" style="color:#FFF !important;"><?php the_title(); ?></a></h4>
                                  <h3 style="color:<?php echo cs_allow_special_char($cs_position_color);?> !important"><?php echo cs_allow_special_char($cs_team_position); ?></h3>
                                 <?php 
								  if(isset($cs_team_specs_desc) && $cs_team_specs_desc <> ""){
									  $readmore ='';
									  if(strlen($cs_team_specs_desc) > 255) {
										 $readmore = '...';  
									  }
									  
								   ?>
                                  <p class="whitecolor-text" style="color:<?php echo esc_html($cs_description_color);?> !important">
                                   <?php
									  echo substr($cs_team_specs_desc,0,255).$readmore;
								    ?>
                                  </p>
                                  <?php } ?>
                                  <div class="contactdiv">
                                      <ul>
                                      <?php if($cs_team_email <> '') { ?>
                                        <li>
                                            <a href="mailto:<?php echo sanitize_email( $cs_team_email ); ?>" class="emaildiv"><span><i class="icon-envelope4"></i></span><?php echo sanitize_email( $cs_team_email ); ?></a>
                                        </li>
                                        <?php } if($cs_team_phone <> ''){  ?>
                                        
                                        <li><a href="#" class="emaildiv"><span><i class="icon-phone6"></i></span> <?php echo esc_html($cs_team_phone); ?></a>    </li>
                        <?php } ?>              </ul>
                                  </div>
                                  <div class="col-lg-12 marginleft">
                                  <?php
								  if(  $cs_team_facebook <> '' || $cs_team_twitter <> '' || $cs_team_google <> '' || $cs_team_linkedin <> '' ) {
									  ?>
                                      <div class="social-media-blog"> 
                                          <ul>
                                              <li><a href="<?php echo esc_url( $cs_team_facebook ); ?>" data-original-title="Facebook" class="icon-facebook2"></a></li>
                                              <li><a href="<?php echo esc_url( $cs_team_twitter ); ?>" data-original-title="Twitter" class="icon-twitter6"></a></li>
                                              <li><a href="<?php echo esc_url( $cs_team_google ); ?>" data-original-title="GooglePlus" class="icon-googleplus7"></a></li>
                                              <li><a href="<?php echo esc_url( $cs_team_linkedin ); ?>" data-original-title="Instagram" class="icon-instagram4"></a></li>
                                              <li><a href="mailto:<?php echo sanitize_email( $cs_team_email ); ?>" data-original-title="Email" class="icon-envelope4"> <span><?php _e('Email','cs_frame');?></span></a></li>
                                          </ul>
                                      </div>
                                      <?php } ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          
				<?php
               	 endwhile;
                } else {
                	_e('No team found.','cs_frame');
                }
				?>
                </ul>
              </div>
            <?php    
			}	
           ?> 
                          
            
        </div>
               
        <?php
               if ($cs_port_gallery == 'on' && $cs_port_list_gallery <> '') {
				 $cs_port_list_gallery = explode(',', $cs_port_list_gallery);  ?>
            <div class="cs-document-list">
              <?php if( $cs_port_gallery_title != '' ) { ?>
              <h5><?php echo esc_html($cs_port_gallery_title);?></h5>
              <?php } ?>
              <ul>
              <?php	     
				if (is_array($cs_port_list_gallery) && sizeof($cs_port_list_gallery) > 0) {  
					foreach ($cs_port_list_gallery as $attachment_file_id) { 
						$attachments	= get_post( $attachment_file_id, 'OBJECT', 'raw' );
						$mime			= get_post_mime_type( $attachment_file_id );
						$mime_type_icon = wp_mime_type_icon($mime);
						$file_url 		= wp_get_attachment_url( $attachment_file_id );
						$filetype 		= wp_check_filetype( $file_url );
						 ?>
					<li> <span class="icon"> <i class="<?php echo cs_get_attachment_icon($filetype['ext']);?>"></i> </span> 
                    <?php
                    if ($attachments){
					?>
                    <a title="<?php echo esc_html($attachments->post_excerpt);?>" 
                     href="<?php echo wp_get_attachment_url( $attachment_file_id );?>"> <?php echo esc_html($attachments->post_title);?> </a> 
                     <?php } ?></li>
                <?php } ?>
                <?php } ?>
              </ul>
            </div>
            <?php } ?>
          </div>
        </div>
      </section>
    </div>
    <?php
		  endwhile;
		endif;  ?>
    <?php 
        if( $rightSidebarFlag == true ) { ?>
    <aside class="page-sidebar">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_right) ) : endif; ?>
    </aside>
    <?php } 
			?>
  </div>
</div>
         <script type="text/javascript">
                jQuery(window).load(function() {
					setTimeout(function(){
						jQuery('.cs-map-view').hide();
						jQuery('.map-btn').on('click', function(e){
							e.preventDefault();
							jQuery('.cs-course-detail').find('.cs-map-view').slideToggle();
						});
					}, 2000);
					
});
                </script>
<?php
	get_footer();
