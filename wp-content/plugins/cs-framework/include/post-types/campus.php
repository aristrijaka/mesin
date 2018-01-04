<?php
/**
 * @Manage Columns
 * @return
 *
 */
 
if (!class_exists('post_type_campus')) {

    class post_type_campus {

        // The Constructor
        public function __construct() {
            // Adding columns
            add_filter('manage_campus_posts_columns', array(&$this, 'cs_campus_columns_add'));
            add_action('manage_campus_posts_custom_column', array(&$this, 'cs_campus_columns'), 10, 2);
			add_action('init', array(&$this, 'cs_campus_register'));
			//add_action('init', array(&$this, 'cs_campus_register'));
			
			
			
        }

		function cs_campus_columns_add($columns) {
			//$columns['category'] =__('Categories','cs_frame');
			//$columns['organizer'] =__('Organizer','cs_frame');
			$columns['start_date'] =__('Start Date','cs_frame');
			$columns['end_date'] =__('End Date','cs_frame');
			$columns['timing'] =__('Timing','cs_frame');
			return $columns;
		}

		function cs_campus_columns($name) {
			global $post;
			switch ($name) {
				/*case 'category':
					$categories = get_the_terms( $post->ID, 'campus-category' );
						if($categories <> ""){
							$couter_comma = 0;
							foreach ( $categories as $category ) {
								echo esc_attr($category->name);
								$couter_comma++;
								if ( $couter_comma < count($categories) ) {
									echo ", ";
								}
							}
						}
				break;*/
				/*case 'organizer':
					$campus_organizer = get_post_meta( $post->ID, 'cs_campus_organizer', true );
					if( $campus_organizer <> '' ) {
						echo esc_attr($campus_organizer);
					} else {
						echo '-';
					}
				break;*/
				case 'start_date':
					$from_date = get_post_meta( $post->ID, 'cs_campus_from_date', true );
					$from_date = cs_correct_date_form( $from_date );
					$from_date = date_i18n(get_option('date_format'), strtotime($from_date));
					echo esc_attr($from_date);
				break;
				case 'end_date':
					$end_date = get_post_meta( $post->ID, 'cs_campus_to_date', true );
					$end_date = cs_correct_date_form( $end_date );
					$end_date = date_i18n(get_option('date_format'), strtotime($end_date));
					echo esc_attr($end_date);
				break;
				case 'timing':
					$start_time = get_post_meta( $post->ID, 'cs_campus_start_time', true );
					$end_time = get_post_meta( $post->ID, 'cs_campus_end_time', true );
					$all_day = get_post_meta( $post->ID, 'cs_campus_all_day', true );
					
					$start_time = date_i18n(get_option('time_format'), strtotime($start_time));
					$end_time = date_i18n(get_option('time_format'), strtotime($end_time));
					
					if( $all_day == 'on' ) {
						_e('All day', 'cs_frame');
					} else if( $start_time <> '' && $end_time <> '' ) {
						echo esc_attr($start_time . ' - ' . $end_time);
					} else if( $start_time <> '' && $end_time == '' ) {
						echo esc_attr($start_time);
					} else {
						echo '-';
					}
				break;
			}
		}

		/**
		 * @Register Post Type
		 * @return
		 *
		 */
		function cs_campus_register() {
			$labels = array(
				'name' =>__('Campus','cs_frame'),
				'all_items' =>__('Campus','cs_frame'),
				'add_new_item' =>__('Add New Campus','cs_frame'), 
				'edit_item' =>__('Edit Campus','cs_frame'), 
				'new_item' =>__('New Campus Item','cs_frame'),
				'add_new' =>__('Add New Campus','cs_frame'),
				'view_item' =>__('View Campus Item','cs_frame'), 
				'search_items' =>__('Search Campus','cs_frame'), 
				'not_found' =>__('Nothing found','cs_frame'),  
				'not_found_in_trash' =>__('Nothing found in Trash','cs_frame'),
				'parent_item_colon' => ''
			);
			
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'menu_icon' => 'dashicons-book',
				'rewrite' => true,
				'capability_type' => 'post',
				'has_archive' => true,
				'map_meta_cap' => true,
				'hierarchical' => false,
				'menu_position' => null,
				'can_export' => true,
				'supports' => array('title','thumbnail'),
				'show_in_menu'=> 'edit.php?post_type=course',
				
			); 
			register_post_type( 'campus' , $args );

		}
	 }
	
	return new post_type_campus();
}
