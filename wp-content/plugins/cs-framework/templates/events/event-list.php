<?php
/**
 * Event Listing View
 *
 */
	global $cs_theme_options,$events_time,$event_date,$cs_event_meta,$event_excerpt,$category,$cs_notification,$wp_query;
	extract( $wp_query->query_vars );
	if(isset($event_excerpt)  and $event_excerpt<>''){
	$event_excerpt = $event_excerpt;
}else {
	$event_excerpt = '255';
}
	$width 		  = '202';
	$height	      = '146';
	$title_limit  = 46;
	$randomid	  = cs_generate_random_string('10');
	
?>
<div class="cs-events events-listing col-md-12">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
	<?php 
		$query = new WP_Query( $args );
		$post_count = $query->post_count;
		
		if ( $query->have_posts() ) {  
		  $postCounter    = 0;
		  while ( $query->have_posts() )  : $query->the_post();             
				$thumbnail 	  = cs_get_post_img_src( $post->ID, $width, $height );                
				$cs_postObject  	= get_post_meta(get_the_id(), "cs_full_data", true);
				
				$event_loc_long = get_post_meta($post->ID, "cs_location_longitude", true);
				$event_loc_zoom = get_post_meta($post->ID, "cs_location_zoom", true);
				$event_loc_lat  = get_post_meta($post->ID, "cs_location_latitude", true);
				$cs_map_switch  = get_post_meta($post->ID, "cs_map_switch", true);
				$address_map    = get_post_meta($post->ID, "cs_location_address", true);
				$cs_event_all_day = get_post_meta($post->ID, "cs_event_all_day", true);
				
				$cs_event_start_time = get_post_meta($post->ID, "cs_event_start_time", true);
				$cs_event_end_time = get_post_meta($post->ID, "cs_event_end_time", true);
				
				$cs_location_address = get_post_meta($post->ID, "cs_location_address", true);
				$cs_event_status_type = get_post_meta($post->ID, "cs_event_status_type", true);
				
				$cs_buy_url = get_post_meta($post->ID, "cs_buy_url", true);
				$cs_ticket_title = get_post_meta($post->ID, "cs_ticket_title", true);
				$cs_status_color = get_post_meta($post->ID, "cs_status_color", true);
				$cs_event_status = get_post_meta($post->ID, "cs_event_status", true);
				$cs_ticket_price = get_post_meta($post->ID, "cs_ticket_price", true);
				$cs_event_organizer = get_post_meta($post->ID, "cs_event_organizer", true);
				if( $thumbnail =='' ){
					$thumbnail	= get_template_directory_uri().'/assets/images/no-image.png';
				} 
				
				$cs_event_from_date = get_post_meta(get_the_id(), "cs_event_from_date", true);
				$cs_event_to_date = get_post_meta(get_the_id(), "cs_event_to_date", true);
				$cs_right_date = cs_correct_date_form( $cs_event_from_date );
				$cs_date_time = get_post_meta(get_the_id(), "date_time", true);
				
				$term_list = wp_get_post_terms($post->ID, 'event-category', array("fields" => "names"));
				$terms='';
				for($i= 0 ; $i < sizeof($term_list); $i++){
					$terms .=  '<span>'.$term_list[$i].'</span> '; 
				}
		
					if(isset($cs_event_status_type) && $cs_event_status_type <> ""){
						$cancel_style='';
						if($cs_event_status_type == 0){
							$cancel_style = 'style="text-decoration: line-through;"';
						}
					}
					?>
                          		<article class="post-<?php echo esc_attr( $post->ID );?>">
													<div class="date-time">
														<span><?php  echo date_i18n('M',strtotime($cs_right_date));?></span>
														<strong><?php echo date_i18n('j',strtotime($cs_right_date));?></strong>
													</div>
													<section>
														<div class="text">
 
      <?php
$categories_list = get_the_term_list(get_the_id(), 'event-category', '','');
if ($categories_list) {
?>
<span> 
 <?php printf('%1$s', $categories_list);
 ?>
                                           </span>
                                        <?php
                                        } ?>   
															<?php //echo cs_allow_special_char($terms);?>
                                      <h2 <?php echo esc_html($cancel_style) ?>><a href="<?php esc_url(the_permalink());?>">
																<?php echo cs_get_event_title(get_the_title(),$title_limit);?></a>
                                                            </h2>
                                                            <ul class="post-options">
                                                                <?php 
																///**** mine
																$timeText ='';
																 if( isset( $events_time ) && $events_time =='Yes' ) {
																	  
																	if( isset( $cs_event_all_day ) && $cs_event_all_day =='on' ) {
																		$timeText = 'All Day';
																	} else {
																		$cs_event_start_time = isset($cs_event_start_time) ? $cs_event_start_time : '';
																		$cs_event_end_time = isset($cs_event_end_time) ? $cs_event_end_time : '';
																			if( $cs_event_start_time != '' || $cs_event_end_time != '' ) {
																			
																				if( isset( $cs_event_start_time ) && $cs_event_start_time <> ''){
																					$startDate = date('h:i A',strtotime($cs_event_start_time));
																				}
																			if(isset($cs_event_end_time) && $cs_event_end_time <> ''){
																				//$to =_e('to', 'cs_frame');
																				$endDate =  '&nbsp;to &nbsp;'.date('h:i A',strtotime($cs_event_end_time));
																			}
																			 $timeText = $startDate.''.$endDate;
																		}
																	 }
																	}
																?>
                                                                <?php if($timeText <> ""){?> 
                                                                <li><i class="icon-target5"></i> 
                                                                	<span class="cs-event-time"><?php echo esc_html($timeText) ?>
                                                            </span>
                                                                 </li>
                                                                <?php }?>
                                                                <li><i class="icon-location6"></i>
																	<?php echo cs_get_event_address($cs_location_address,'45');?>
                                                                </li>
                                                                
															</ul>
															<?php if($cs_event_organizer <> ""){?>
                                                                <ul class="categories">
                                                                    <li>
                                                                    <i class="icon-users5"></i><?php _e('Speakers:','cs_frame');?> 
                                                                   <?php echo esc_html($cs_event_organizer) ?> 
                                                                        
                                                                    </li>
                                                                </ul>
                                                            <?php }?>
														</div>
														<div class="right-side">
																	<?php 
																	if(isset($cs_event_status_type) && $cs_event_status_type <> ""){
																			 
																			  if($cs_event_status_type == 0){
																			   	echo '<a href="#" class="cancle-btn" >'.$cs_ticket_title.'</a>';	 // CANCEL	
																			  }else
																			  if($cs_event_status_type == 2){
																			     // cancel
																				 echo '<a href="#" class="free-btn" >'.$cs_ticket_title.'</a>';   // FREE
																			  
																			  }else
																			  if($cs_event_status_type == 1){   // OPEN
																				echo '<div class="ticket-area">
																						<p>
																							'.$cs_ticket_price.'
																						</p>
																						<a href="'.esc_url($cs_buy_url).'">'.$cs_ticket_title.'</a>
																					</div>';
																			   }else
																			   if($cs_event_status_type == 3){   // Closed
																				 echo '<a href="#" class="cancle-btn" >'.$cs_ticket_title.'</a>';   // FREE
																			   }
																			}
																		?>
                                                           </div>
													</section>
											</article>
								<?php 
                       		 endwhile;
                        } else {
                        	$cs_notification->error('No Event found.');
                        }
                        ?>         
		</div>