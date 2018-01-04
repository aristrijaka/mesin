<?php
/**
 * Event Listing View
 *
 */
 	//die("this is event calender view page");
 
	global $cs_theme_options,$events_time,$event_date,$cs_event_meta,$event_excerpt,$category,$cs_notification,$wp_query;
	extract( $wp_query->query_vars );
	
	$width 		  	= '290';
	$height	      	= '218';
	$title_limit 	= 46;
	$events_json	= array();
	$randomid = cs_generate_random_string('10');
	cs_framework::cs_enqueue_full_calender_script();

	$query = new WP_Query( $args );
	$post_count = $query->post_count;
	
	if ( $query->have_posts() ) {  
		$postCounter    = 0;
		while ( $query->have_posts() )  : $query->the_post();             
			
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );                
			
			if( $thumbnail == '' ) {
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
			$cs_event_to_date = get_post_meta(get_the_id(), "cs_event_to_date", true);
						
			$event_from_date  = date( "Y-m-d", strtotime($cs_event_from_date) );
			$event_to_date  = date( "Y-m-d", strtotime($cs_event_to_date) );
						
			$the_titles = wp_trim_words( get_the_title(), 3, '...' );
			$the_title = str_replace('&#038;', '&', $the_titles);
			
			$events_json[] = array(
				'title' => $the_title,
				'start' => $event_from_date,
				'end' => $event_to_date,
				'url' => get_permalink()
			);
		
		endwhile;
		
		?>
        <script type="text/javascript">
    
		jQuery(document).ready(function($) {
			var date = new Date();
			var d = date.getDate();
			var m = date.getMonth();
			var y = date.getFullYear();
			
			jQuery('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				editable: true,
				eventMouseover: function(calEvent, domEvent) {
					var thistxt = $(this) .html();
					jQuery('body') .append("<div class='wrappertooltip'><span class='innertooltip'>"+ thistxt +"</span></div>");
					var x =jQuery(this) .offset().left;
					var y =jQuery(this) .offset().top;
					var xw = jQuery(".wrappertooltip") .outerWidth();
					var xh = jQuery(".wrappertooltip") .outerHeight();
					jQuery(".wrappertooltip") .css({"top":y,"left":x,"margin-left":-xw/2,"margin-top":-(xh)});
				},
				eventMouseout: function(calEvent, domEvent) {
					jQuery(".wrappertooltip") .remove();	
				}, 
				disableResizing:true,
				disableDragging : true,
				events: <?php echo json_encode( $events_json ) ?>
			});
		});
		</script>
        <?php
	} else {
		_e('No Event found.', 'cs_frame');
	}
	?>
    <div class="col-md-12">
         <div class="cs-calendar"> <div id='calendar'></div> </div>
    </div>
