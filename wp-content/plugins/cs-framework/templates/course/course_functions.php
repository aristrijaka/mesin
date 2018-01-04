<?php
/**
 * File Type: Event Shortcode
 */
if (!function_exists('cs_course_listing')) {

    function cs_course_listing($atts, $content = "") {
        global $post, $wp_query, $wpdb, $cs_node, $cs_theme_option, $events_time, $event_date, $cs_event_meta, $event_excerpt, $category, $cs_notification, $wp_query, $view;
        date_default_timezone_set('UTC');
        $current_time = strtotime(current_time('Y/m/d H:i', $gmt = 0));

        $defaults = array('column_size' => '1/1', 'section_title' => '', 'view' => '', 'category' => '', 'post_order' => 'DESC', 'orderby' => 'ID', 'course_excerpt' => '255', 'pagination' => '10', 'filterable' => '', 'display_pagination' => '');


        extract(shortcode_atts($defaults, $atts));
        $coloumn_class = cs_custom_column_class($column_size);
        $cs_dataObject = get_post_meta($post->ID, 'cs_full_data');
        ob_start();

        $active_classic = '';
        $active_simple = '';
        $active_modern = '';
        $filter_category = '';
        $active = ''; // me


        global $active_simple, $active_classic, $active_modern;
        if (isset($_GET['page_switch']) && $_GET['page_switch'] == 'simple') {

            $view = 'course-simple';
            $active_simple = 'active';
        } else {
            if (isset($_GET['page_switch']) && $_GET['page_switch'] == 'classic') {

                $view = 'course-classic';
                $active_classic = 'active';
            } else {

                if (isset($_GET['page_switch']) && $_GET['page_switch'] == 'modern') {

                    $view = 'course-modern';
                    $active_modern = 'active';
                }
            }
        }


        $organizer_filter = '';
        $user_meta_key = '';
        $user_meta_value = '';
        $meta_compare = "";
        $meta_value = $current_time;
        $meta_key = 'date_time';


        //==Filters
        $filter_category = '';
        $filter_category_array = array();
        $row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from " . $wpdb->prefix . "terms WHERE slug = %s", $category));

        if (isset($_GET['filter_category']) && $_GET['filter_category'] <> '0') {
            $filter_category = $_GET['filter_category'];
        } else {
            if (isset($row_cat->slug)) {
                $filter_category = $row_cat->slug;
            }
        }
        //==Filters End

		$orderby = 'DATE';
		$order = $post_order;
		
        $cs_counter_events = 0;
        if (isset($_GET['sort']) and $_GET['sort'] == 'asc') {
            $order = 'ASC';
        }

        if (isset($_GET['sort']) and $_GET['sort'] == 'alphabetical') {
            $orderby = 'title';
            $order = 'ASC';
        }

        $post_order = isset($post_order) ? $post_order : '';
        if (empty($_GET['page_id_all']))
            $_GET['page_id_all'] = 1;

        if (isset($_GET['organizer']) && $_GET['organizer'] <> '') {
            $meta_key = 'dynamic_event_members';
            $meta_value = $_GET['organizer'];
            $meta_compare = "LIKE";
            $organizer_filter = $_GET['organizer'];
        }


        $args = array('posts_per_page' => "-1", 'post_type' => 'course', 'post_status' => 'publish');

        if (isset($_GET['filter_category']) && $_GET['filter_category'] <> '' && $_GET['filter_category'] <> '0') {
            $event_category_array = array('course-category' => $filter_category);
            $args = array_merge($args, $event_category_array);
        } else if (isset($category) && $category <> '' && $category <> '0') {
            $event_category_array = array('course-category' => $category);
            $args = array_merge($args, $event_category_array);
        }

        $custom_query = new WP_Query($args);
        $count_post = 0;
        $counter = 1;
        $count_post = $custom_query->post_count;

        $args = array('posts_per_page' => "$pagination", 'paged' => $_GET['page_id_all'], 'post_type' => 'course', 'post_status' => 'publish', 'orderby'=> $orderby, 'order' => $order);

        if (isset($_GET['filter_category']) && $_GET['filter_category'] <> '' && $_GET['filter_category'] <> '0') {
            $course_category_array = array('course-category' => $filter_category);
            $args = array_merge($args, $course_category_array);
        } else if (isset($category) && $category <> '' && $category <> '0') {
            $course_category_array = array('course-category' => $category);
            $args = array_merge($args, $course_category_array);
        }


        if (isset($_GET['organizer']) && $_GET['organizer'] <> '') {
            $user_meta_key = '';
            $user_meta_value = '';
        }

        $user_args = array(
            'posts_per_page' => "",
            'paged' => "",
            'meta_key' => $user_meta_key,
            'meta_value' => $user_meta_value,
        );

        $user_args = array_merge($args, $user_args);


        if (isset($section_title) && $section_title <> '') {
            echo '<div class="cs-section-title col-md-12">
					<h2>' . esc_attr($section_title) . '</h2>
				  </div>';
        }

        if (isset($filterable) && $filterable == 'Yes') {

            cs_get_course_filters($filter_category, $active);
        }



        set_query_var('args', $args);
        if ($view == 'course-simple') {
            include('course-simple.php');
        } else if ($view == 'course-classic') {
            include('course-classic.php');
        } else if ($view == 'course-modern') {
            include('course-modern.php');
        }

        //==Pagination Start
        if (isset($display_pagination) && $display_pagination == 'Yes') {

            if ($count_post > $pagination && $pagination > 0) {
                $qrystr = '';

                if (isset($_GET['page_switch']))
                    $qrystr .= "&amp;page_switch=" . $_GET['page_switch'];
                if (isset($_GET['filter_category']))
                    $qrystr .= "&amp;filter_category=" . $_GET['filter_category'];
                echo cs_pagination($count_post, $pagination, $qrystr, 'Show Pagination');
            }
        }
        //==Pagination End  

        $eventpost_data = ob_get_clean();
        return $eventpost_data;
    }

    add_shortcode('cs_course', 'cs_course_listing');
}

/**
 *
 * @Get Event CAtegories
 * @return
 */
if (!function_exists('cs_course_categories')) {

    function cs_course_categories($category) {

        if ($category != '' && $category != '0') {
            $row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $category));
        }

        if (isset($category) && $category != '' && $category != '0') {
            echo '<a href="' . esc_url(home_url('/')) . '?cat=' . $row_cat->term_id . '">' . $row_cat->name . '</a>';
        } else {
            /* Get All Tags */
            $before_cat = '<i class="fa fa-align-left"></i> ';
            $categories_list = get_the_term_list(get_the_id(), 'course-category', $before_cat, ', ', '');
            if ($categories_list) {
                printf('%1$s', $categories_list);
            }
            // End if Tags 
        }
    }

}


/**
 *
 * @Get Event Filters
 * @return
 */
if (!function_exists('cs_get_course_filters')) {

    function cs_get_course_filters($filter_category = '', $activelist = '', $activegird = '') {
        global $post;
        $categories = get_categories(array('taxonomy' => 'course-category', 'hide_empty' => 0));
        global $active_simple, $active_classic, $active_modern;
        ?>

        <div class="col-md-12">
            <div class="cs-filterable">
                <ul class="cs-sort">
                    <li><span><?php _e('Sort by', 'cs_frame'); ?></span></li>
                    <li>
                        <!--<div class="select-holder filter">
                        <form action="" method="get" name="filter_by">
                                <select>
                                        <option value="<?php //echo cs_allow_special_char($val);    ?>">Filter By</option>
                        <?php
                        //if( function_exists('cs_get_degree_levels') ) {	
                        //$degree_levels = array();
                        //foreach( cs_get_degree_levels() as $key => $val ):
                        ?>
                                                        <option value="<?php //echo cs_allow_special_char($val);    ?>"><?php //echo cs_allow_special_char($val);    ?></option>
                        <?php
                        //endforeach;	
                        // }
                        ?>
                                 
                                </select>     
                        </form>   
                         
                           
                        </div>-->
                    </li>
                    <li>
                        <div class="select-holder cat">
                            <form action="#" method="get" name="filterable" >

                                <select name="filter_category" onChange="this.form.submit()" > <option value="0"> Select Category</option>
                                    <?php
                                    $i = 0;
                                    foreach ($categories as $category) {
                                        ?>
                                        <option value="<?php echo esc_attr($category->slug); ?>"  
                                        <?php
                                        if ($filter_category == $category->slug) {
                                            echo 'selected';
                                        }
                                        ?>><?php echo esc_attr($category->cat_name); ?>
                                        </option>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </select>
                            </form> 
                        </div>
                    </li>
                </ul>


                <?php
                $qrystr = '';
                if (isset($_GET['filter_category']))
                    $qrystr .= "&amp;filter_category=" . $_GET['filter_category'];
                $switch_to_modern = '?page_switch=modern' . $qrystr;
                $switch_to_classic = '?page_switch=classic' . $qrystr;
                $switch_to_simple = '?page_switch=simple' . $qrystr;
                ?>
                <ul class="cs-views">
                    <li class="<?php echo esc_html($active_modern); ?>">
                        <a href="<?php echo esc_url($switch_to_modern); ?>" title="modern">
                            <i class="icon-list7"></i>
                        </a>
                    </li>
                    <li class="<?php echo esc_html($active_classic); ?>" >
                        <a href="<?php echo esc_html($switch_to_classic); ?>" title="classic">
                            <i class="icon-th"></i>

                        </a>
                    </li>
                    <li class="<?php echo esc_html($active_simple); ?>">
                        <a href="<?php echo esc_url($switch_to_simple); ?>" title="simple">
                            <i class="icon-layout15"></i>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
        <?php
    }

}






/**
 *
 * @Get Event Address
 * @return
 */
if (!function_exists('cs_get_course_address')) {

    function cs_get_event_address($address = '', $limit = 35) {
        return substr($address, 0, $limit);
        if (strlen($address) > $limit) {
            echo '...';
        }
    }

}

/**
 *
 * @Get Event Title
 * @return
 */
if (!function_exists('cs_get_course_title')) {

    function cs_get_course_title($address = '', $limit = 35) {
        return substr($address, 0, $limit);
        if (strlen($address) > $limit) {
            echo '...';
        }
    }

}


if (!function_exists('cs_convert_time_full_format_to_half')) {

    function cs_convert_time_full_format_to_half($hour) {

        $aTime_return_with_format = array();
        if ($hour == '01') {
            $aTime_return_with_format[0] = '01';
            $aTime_return_with_format[1] = 'Am';
        } else
        if ($hour == '02') {
            $aTime_return_with_format[0] = '02';
            $aTime_return_with_format[1] = 'Am';
        } else
        if ($hour == '03') {
            $aTime_return_with_format[0] = '03';
            $aTime_return_with_format[1] = 'Am';
        } else
        if ($hour == '04') {
            $aTime_return_with_format[0] = '04';
            $aTime_return_with_format[1] = 'Am';
        } else
        if ($hour == '05') {
            $aTime_return_with_format[0] = '05';
            $aTime_return_with_format[1] = 'Am';
        } else
        if ($hour == '06') {
            $aTime_return_with_format[0] = '06';
            $aTime_return_with_format[1] = 'Am';
        } else
        if ($hour == '07') {
            $aTime_return_with_format[0] = '07';
            $aTime_return_with_format[1] = 'Am';
        } else
        if ($hour == '08') {
            $aTime_return_with_format[0] = '08';
            $aTime_return_with_format[1] = 'Am';
        } else
        if ($hour == '09') {
            $aTime_return_with_format[0] = '09';
            $aTime_return_with_format[1] = 'Am';
        } else
        if ($hour == '10') {
            $aTime_return_with_format[0] = '10';
            $aTime_return_with_format[1] = 'Am';
        } else
        if ($hour == '11') {
            $aTime_return_with_format[0] = '11';
            $aTime_return_with_format[1] = 'Am';
        } else
        if ($hour == '12') {
            $aTime_return_with_format[0] = '12';
            $aTime_return_with_format[1] = 'Am';
        } else
        if ($hour == '13') {
            $aTime_return_with_format[0] = '01';
            $aTime_return_with_format[1] = 'Pm';
        } else
        if ($hour == '14') {
            $aTime_return_with_format[0] = '02';
            $aTime_return_with_format[1] = 'Pm';
        } else
        if ($hour == '15') {
            $aTime_return_with_format[0] = '03';
            $aTime_return_with_format[1] = 'Pm';
        } else
        if ($hour == '16') {
            $aTime_return_with_format[0] = '04';
            $aTime_return_with_format[1] = 'Pm';
        } else
        if ($hour == '17') {
            $aTime_return_with_format[0] = '05';
            $aTime_return_with_format[1] = 'Pm';
        } else
        if ($hour == '18') {
            $aTime_return_with_format[0] = '06';
            $aTime_return_with_format[1] = 'Pm';
        } else
        if ($hour == '19') {
            $aTime_return_with_format[0] = '07';
            $aTime_return_with_format[1] = 'Pm';
        } else
        if ($hour == '20') {
            $aTime_return_with_format[0] = '08';
            $aTime_return_with_format[1] = 'Pm';
        } else
        if ($hour == '21') {
            $aTime_return_with_format[0] = '09';
            $aTime_return_with_format[1] = 'Pm';
        } else
        if ($hour == '22') {
            $aTime_return_with_format[0] = '10';
            $aTime_return_with_format[1] = 'Pm';
        } else
        if ($hour == '23') {
            $aTime_return_with_format[0] = '11';
            $aTime_return_with_format[1] = 'Pm';
        } else
        if ($hour == '24') {
            $aTime_return_with_format[0] = '12';
            $aTime_return_with_format[1] = 'Pm';
        }

        return $aTime_return_with_format;
    }

}

/* -----------------------------------------------------------------
 * Attachment Icon
 * --------------------------------------------------------------- */
if (!function_exists('cs_get_attachment_icon')) {

    function cs_get_attachment_icon($ext = 'default') {

        $cs_attachment = array(
            'txt' => 'icon-document',
            'xlsx' => 'icon-file-excel-o',
            'pdf' => 'icon-file-pdf-o',
            'doc' => 'icon-documents',
            'docx' => 'icon-documents',
            'xls' => 'icon-file-excel-o',
            'jpg' => 'icon-file-photo-o',
            'png' => 'icon-file-photo-o',
            'gif' => 'icon-file-photo-o',
            'psd' => 'icon-file-photo-o',
            'ppt' => 'icon-document',
            'zip' => 'icon-file-zip-o',
            'default' => 'icon-file-text-o',
        );

        if (isset($cs_attachment[$ext])) {
            return $cs_attachment[$ext];
        }
    }

}

// remove user role
$role = get_role('instructor');
if (!isset($role)) {
    $role = add_role('instructor', 'Instructor', array(
        'read' => true, // True allows that capability
        'write' => true, // True allows that capability
        'edit_posts' => true,
        'delete_posts' => false, // Use false to explicitly deny
    ));
}








