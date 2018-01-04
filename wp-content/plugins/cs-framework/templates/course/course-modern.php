<?php
/**
 * Event Listing View
 *
 */
	global $cs_theme_options,$course_time,$course_date,$cs_course_meta,$course_excerpt,$category,$cs_notification,$wp_query;
	extract( $wp_query->query_vars );
	
	$width 		  = '202';
	$height	      = '146';
	$title_limit  = 46;
	$randomid	  = cs_generate_random_string('10');
	
?>

<div class="cs-courses listing-view list-2 col-md-12">
   
	<?php 
		$query = new WP_Query( $args );
		$post_count = $query->post_count;
		
		if ( $query->have_posts() ) {  
		  $postCounter    = 0;
		  while ( $query->have_posts() )  : $query->the_post();             
			$thumbnail 	  = cs_get_post_img_src( $post->ID, $width, $height );                
			$cs_postObject  	= get_post_meta(get_the_id(), "cs_full_data", true);
			
			//$event_loc_long = get_post_meta($post->ID, "cs_location_longitude", true);
			$event_loc_zoom = get_post_meta($post->ID, "cs_location_zoom", true);
			$event_loc_lat  = get_post_meta($post->ID, "cs_location_latitude", true);
			$cs_map_switch  = get_post_meta($post->ID, "cs_map_switch", true);
			$address_map    = get_post_meta($post->ID, "cs_location_address", true);
			
			
			/***************New Filed***************/
				$cs_course_duration = get_post_meta($post->ID, "cs_course_duration_period", true); // course duration
				$cs_course_price = get_post_meta($post->ID, "cs_course_price", true); // course price
				$cs_course_code = get_post_meta($post->ID, "cs_course_code", true); // course code
				$cs_degree_levels = get_post_meta($post->ID, "cs_degree_levels", true); // degree level
				$cs_degree_level_bg_color = get_post_meta($post->ID, "cs_degree_level_bg_color", true); // degree level bg color
				$cs_user_instructors = get_post_meta($post->ID, "cs_user_instructors", true); // instructor id
				$cs_buy_url = get_post_meta($post->ID, "cs_buy_url", true);  // buy url
				$cs_course_from_date = date_i18n('F j, Y', strtotime(get_post_meta($post->ID, "cs_course_from_date", true))); // start date
				
				$the_title = substr(get_the_title(),0,40); // the title
				//$the_content = substr(the_content(),0,45); // the conetnt
			
			 	// get user information
				$user = get_user_by( 'id', $cs_user_instructors ); 
				
	            if (isset($user) && $user !='')
	            {
	                $user_instructor_name  =  $user->first_name . ' ' . $user->last_name;
	            }
	            else
	            {
	                 $user_instructor_name = "";
	            }
				
				 // get terms against specific pist
				$term_list = wp_get_post_terms($post->ID , 'course-category', array("fields" => "all"));
				$terms='';
				for($i= 0 ; $i < sizeof($term_list); $i++){
					$terms .=  '<li><a  href="' . esc_url(get_term_link($term_list[$i]->slug, 'course-category')) . '">'.esc_attr($term_list[$i]->name).'</a></li>';   
				}
			
			/**************New Fileds*************/
			
			if( $thumbnail =='' ){
				$thumbnail	= get_template_directory_uri().'/assets/images/no-image.png';
			} 
			
		 ?>
                       <article>
                          <figure>
                            <a href="<?php esc_url(the_permalink());?>">
                            	<img src="<?php echo esc_url($thumbnail);?>"></a>
                            <figcaption>
							  <small style="background:<?php echo cs_allow_special_char($cs_degree_level_bg_color);?>!important;"><?php echo cs_allow_special_char($cs_degree_levels);?></small>
                              <span class="course-num"><?php echo esc_html($cs_course_code);?></span>
                            </figcaption>
                          </figure>
                          <div class="cs-text">
                              <ul class="course-tags">
                                 <?php echo cs_allow_special_char($terms);?>
                              </ul>
                              <h2><a href="<?php esc_url(the_permalink());?>"><?php echo cs_allow_special_char($the_title);?></a></h2>
                             	<?php   echo wp_trim_words( get_the_content(), 40 );?>
                              <ul class="course-info">
                             	<?php if($cs_user_instructors <> ""){?> 
                                  <li>
                                      <figure>
                                        <?php echo get_avatar( $cs_user_instructors, '96' );?>
                                      </figure>
                                      <div class="details">
                                        <span class="title"> <?php _e('Instructor','cs_frame');?></span>
                
                                        <span class="value"><?php echo esc_html($user_instructor_name);?></span>
                                      </div>
                                    </li>
                                <?php }?>
                                   <?php if($cs_course_duration <> ""){?> 
                                        <li>
                                          <div class="details">
                                            <span class="title"><?php _e('Duration','cs_frame');?></span>
                                            <i class="icon-folder5"></i>
                                            <span class="value"><?php echo esc_html($cs_course_duration);?></span>
                                          </div>
                                        </li>
                                 	<?php }?>
                                    <?php if($cs_course_from_date <> ""){?> 
                                        <li>
                                          <div class="details">
                                            <span class="title"> <?php _e('Starts From','cs_frame');?></span>
                                             <span class="value"><?php echo esc_html($cs_course_from_date); ?></span>
                                          </div>
                                        </li>
                                	<?php }?>
                                    <?php if($cs_course_price <> ""){?> 
                                    
                                		 <li class="price"><?php echo esc_html($cs_course_price);?></li>
                                         <?php } ?>
                              </ul>
                          </div>
                        </article>
                              
                            				
							<?php 
                       		 endwhile;
                        } else {
                        	_e('No Course found.', 'cs_frame');
                        }
                        ?>         
				                             
                                             
</div>