<?php
/**
 * @Manage Columns
 * @return
 *
 */
 
if (!class_exists('post_type_course')) {

    class post_type_course {

        // The Constructor
        public function __construct() {
            // Adding columns
            add_filter('manage_course_posts_columns', array(&$this, 'cs_course_columns_add'));
            add_action('manage_course_posts_custom_column', array(&$this, 'cs_course_columns'), 10, 2);
			add_action('init', array(&$this, 'cs_course_register')); // post type register
			add_action('init', array(&$this, 'cs_course_categories')); // post type categories
			//add_action('init', array(&$this, 'cs_course_tags')); // post type tags
        }

		function cs_course_columns_add($columns) {
			$columns['category'] =__('Categories','cs_frame');
			$columns['organizer'] =__('Organizer','cs_frame');
			$columns['start_date'] =__('Start Date','cs_frame');
			$columns['end_date'] =__('End Date','cs_frame');
			$columns['timing'] =__('Timing','cs_frame');
			return $columns;
		}

		function cs_course_columns($name) {
			global $post;
			switch ($name) {
				case 'category':
					$categories = get_the_terms( $post->ID, 'course-category' );
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
				break;
				case 'organizer':
					  $cs_user_instructors = get_post_meta( $post->ID, 'cs_user_instructors', true );
					  
					$cs_user_instructors = isset($cs_user_instructors) ? $cs_user_instructors :'';
				 	$user = get_user_by( 'id', $cs_user_instructors ); 
					$user = isset($user) ? $user : '';
					$user_first = isset($user->first_name) ? $user->first_name : '-';
					$user_last = isset( $user->last_name ) ?  $user->last_name : '';
				    $user_instructor_name  = $user_first . ' ' . $user_last;
					if( $user_instructor_name <> '' ) {
						echo $user_instructor_name;
					} else {
						echo '-';
					}
				break;
				case 'start_date':
					$from_date = get_post_meta( $post->ID, 'cs_course_from_date', true );
					$from_date = cs_correct_date_form( $from_date );
					$from_date = date_i18n(get_option('date_format'), strtotime($from_date));
					echo esc_attr($from_date);
				break;
				case 'end_date':
					$end_date = get_post_meta( $post->ID, 'cs_course_to_date', true );
					$end_date = cs_correct_date_form( $end_date );
					$end_date = date_i18n(get_option('date_format'), strtotime($end_date));
					echo esc_attr($end_date);
				break;
				case 'timing':
					$start_time = get_post_meta( $post->ID, 'cs_course_start_time', true );
					$end_time = get_post_meta( $post->ID, 'cs_course_end_time', true );
					$all_day = get_post_meta( $post->ID, 'cs_course_all_day', true );
					
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
		function cs_course_register() {
			$labels = array(
				'name' =>__('Course','cs_frame'),
				'all_items' =>__('Course','cs_frame'),
				'add_new_item' =>__('Add New Course','cs_frame'), 
				'edit_item' =>__('Edit Course','cs_frame'), 
				'new_item' =>__('New Course Item','cs_frame'),
				'add_new' =>__('Add New Course','cs_frame'),
				'view_item' =>__('View Course Item','cs_frame'), 
				'search_items' =>__('Search Course','cs_frame'), 
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
				'supports' => array('title','editor','thumbnail'),
				
			); 
			register_post_type( 'course' , $args );

		}
		
			
		/**
		 * @Register Categories
		 * @return
		 *
		 */	
		
		function cs_course_categories() { 
			$labels = array(
				'name' =>__('Course Categories','cs_frame'), 
				'search_items' =>__('Search course Categories','cs_frame'), 
				'edit_item' =>__('Edit course Category','cs_frame'), 
				'update_item' =>__('Update course Category','cs_frame'), 
				'add_new_item' =>__('Add New Category','cs_frame'), 
				'menu_name' =>__('Categories','cs_frame'), 
			); 	
			register_taxonomy('course-category',array('course'), array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'course-category' ),
			));
		}
			/**
		 * @Register Tags
		 * @return
		 *
		 */	
		
		/*function cs_course_tags() {
			$labels = array(
				'name' =>__('Course Tags','cs_frame'), 
				'singular_name' =>__('course-tag','cs_frame'), 
				'search_items' =>__('Search Tags','cs_frame'), 
				'popular_items' =>__('Popular Tags','cs_frame'), 
				'all_items' =>__('All Tags','cs_frame'), 
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' =>__('Edit Tag','cs_frame'),  
				'update_item' =>__('Update Tag','cs_frame'), 
				'add_new_item' =>__('Add New Tag','cs_frame'), 
				'new_item_name' =>__('New Tag Name','cs_frame'), 
				'separate_items_with_commas' =>__('Separate tags with commas','cs_frame'), 
				'add_or_remove_items' =>__('Add or remove tags','cs_frame'), 
				'choose_from_most_used' =>__('Choose from the most used tags','cs_frame'), 
				'menu_name' =>__('Tags','cs_frame'), 
			); 
			register_taxonomy('course-tag','course',array(
			
				'hierarchical' => false,
				'labels' => $labels,
				'show_ui' => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var' => true,
				'rewrite' => array( 'slug' => 'course-tag' ),
			));
		}*/
	}
	
	return new post_type_course();
}
