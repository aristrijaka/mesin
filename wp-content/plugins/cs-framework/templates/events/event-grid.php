<?php
/**
 * Event Listing View
 *
 */
	global $cs_theme_options,$events_time,$event_date,$cs_event_meta,$event_excerpt,$category,$cs_notification,$wp_query;
	extract( $wp_query->query_vars );
	
	$width 		  = '290';
	$height	      = '218';
	$title_limit  = 46;
	$randomid = cs_generate_random_string('10');
		
?>
 						<div class="cs-events events-grid">
                             <?php 
							 
								$query = new WP_Query( $args );
								$post_count = $query->post_count;
								
								if ( $query->have_posts() ) {  
								$postCounter    = 0;
									while ( $query->have_posts() )  : $query->the_post();             
									$thumbnail 	  = cs_get_post_img_src( $post->ID, $width, $height );                
									if( $thumbnail =='' ){
										$thumbnail	= get_template_directory_uri().'/assets/images/no-image.png';
									} 
									
									$cs_postObject  = get_post_meta(get_the_id(), "cs_full_data", true);
									$event_loc_long = get_post_meta($post->ID, "cs_location_longitude", true);
									$event_loc_zoom = get_post_meta($post->ID, "cs_location_zoom", true);
									$event_loc_lat  = get_post_meta($post->ID, "cs_location_latitude", true);
									$cs_map_switch  = get_post_meta($post->ID, "cs_map_switch", true);
									$address_map    = get_post_meta($post->ID, "cs_location_address", true);
									$cs_event_all_day = get_post_meta($post->ID, "cs_event_all_day", true);
									$cs_event_start_time = get_post_meta($post->ID, "cs_event_start_time", true);
									$cs_event_end_time = get_post_meta($post->ID, "cs_event_end_time", true);
									$cs_location_address = get_post_meta($post->ID, "cs_location_address", true);
									$cs_buy_url = get_post_meta($post->ID, "cs_buy_url", true);
									$cs_ticket_title = get_post_meta($post->ID, "cs_ticket_title", true);
									$cs_event_from_date = get_post_meta(get_the_id(), "cs_event_from_date", true);
									$cs_right_date = cs_correct_date_form( $cs_event_from_date );
									$cs_event_from_date = date_i18n('D, F j, Y', strtotime(get_post_meta($post->ID, "cs_event_from_date", true))); // start date
								?>
                              
                                         <article class="col-md-4">
												<figure>
													<a href="<?php esc_url(the_permalink());?>">
                                                    	<img src="<?php echo esc_url($thumbnail);?>" alt="#">
                                                     </a>
                                                     
													<figcaption>
														<div class="text">
															<span class="cs-event-time"><i class="icon-clock"></i><!--Satruary, May 23, 2015--> 
																	<?php echo esc_html($cs_event_from_date); ?>
                                                                 </span>
															<div class="inner-box">
																<h6>
                                                                	<a href="<?php esc_url(the_permalink());?>" style="color:#FFF !important;">
																		<?php echo cs_get_event_title(get_the_title(),$title_limit);?>
                                                                    </a>
                                                                 </h6>
																<span><?php echo esc_html($cs_event_start_time) ?> 
                                                                   
                                                                    <?php if($cs_location_address <> ""){ echo cs_get_event_address($cs_location_address,'45');?>
                                                                   <?php }?>
                                                                   
                                                                  </span>
															</div>
														</div>
													</figcaption>
												</figure>
											</article>
                                        
								<?php 
                                	endwhile;
                                
                                } else {
                               		$cs_notification->error('No Event found.');
                                }
                                ?>
                      </div>
    