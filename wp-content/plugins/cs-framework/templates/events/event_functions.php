<?php
/**
 * File Type: Event Shortcode
 */
if (!function_exists('cs_event_listing')) {

    function cs_event_listing($atts, $content = "") {
        global $post, $wp_query, $wpdb, $cs_node, $cs_theme_option, $events_time, $event_date, $cs_event_meta, $event_excerpt, $category, $cs_notification, $wp_query, $view;
        date_default_timezone_set('UTC');
        $current_time = strtotime(current_time('Y/m/d H:i', $gmt = 0));

        $defaults = array('column_size' => '1/1', 'section_title' => '', 'view' => '', 'category' => '', 'post_order' => 'DESC', 'event_type' => '', 'orderby' => 'ID', 'event_excerpt' => '255', 'pagination' => '10', 'filterable' => '', 'events_time' => '', 'display_pagination' => '');


        extract(shortcode_atts($defaults, $atts));
        $coloumn_class = cs_custom_column_class($column_size);
        $cs_dataObject = get_post_meta($post->ID, 'cs_full_data');
        ob_start();
        global $activeGrid, $activeList;

        $filter_category = '';
        $active = '';
        if (isset($_GET['page_switch']) && $_GET['page_switch'] == 'grid') {
            $view = 'events-grid';
            $activegird = 'style="border:1px solid #00F !important;"';
        } else {
            if (isset($_GET['page_switch']) && $_GET['page_switch'] == 'list') {
                $view = 'events-listing';
                $activelist = 'style="border:1px solid #00F !important;"';
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

        if (isset($_GET['filter_category'])) {
            $filter_category = $_GET['filter_category'];
        } else {
            if (isset($row_cat->slug)) {
                $filter_category = $row_cat->slug;
            }
        }
        //==Filters End

        if ($event_type == "upcoming-events")
            $meta_compare = ">=";
        else if ($event_type == "past-events")
            $meta_compare = "<";
        $cs_counter_events = 0;

        if (isset($_GET['sort']) and $_GET['sort'] == 'asc') {
            $order = 'ASC';
        } else {
            $order = 'DESC';
        }

        if (isset($_GET['sort']) and $_GET['sort'] == 'alphabetical') {
            $orderby = 'title';
            $order = 'ASC';
        } else {
            $orderby = 'meta_value';
        }


        if (empty($_GET['page_id_all']))
            $_GET['page_id_all'] = 1;

        if (isset($_GET['organizer']) && $_GET['organizer'] <> '') {
            $meta_key = 'dynamic_event_members';
            $meta_value = $_GET['organizer'];
            $meta_compare = "LIKE";
            $organizer_filter = $_GET['organizer'];
        }

        if ($event_type == "all-events") {
            $args = array(
                'posts_per_page' => "-1",
                'post_type' => 'events',
                'post_status' => 'publish',
                'orderby' => $orderby,
                'order' => $order,
            );
        } else {
            $args = array(
                'posts_per_page' => "-1",
                'post_type' => 'events',
                'post_status' => 'publish',
                'meta_key' => $meta_key,
                'meta_value' => $meta_value,
                'meta_compare' => $meta_compare,
                'orderby' => $orderby,
                'order' => $order,
            );
        }


        if (isset($_GET['filter_category']) && $_GET['filter_category'] <> '' && $_GET['filter_category'] <> '0') {
            $event_category_array = array('event-category' => $filter_category);
            $args = array_merge($args, $event_category_array);
        } else if (isset($category) && $category <> '' && $category <> '0') {
            $event_category_array = array('event-category' => "$category");
            $args = array_merge($args, $event_category_array);
        }

        $custom_query = new WP_Query($args);
        $count_post = 0;
        $counter = 1;
        $count_post = $custom_query->post_count;

        if ($event_type == "upcoming-events") {


            $args = array(
                'posts_per_page' => "$pagination",
                'paged' => $_GET['page_id_all'],
                'post_type' => 'events',
                'post_status' => 'publish',
                'meta_key' => $meta_key,
                'meta_value' => $meta_value,
                'meta_compare' => $meta_compare,
                'orderby' => $orderby,
                'order' => $order,
            );
        } else if ($event_type == "all-events") {



            $args = array(
                'posts_per_page' => "$pagination",
                'paged' => $_GET['page_id_all'],
                'post_type' => 'events',
                //'meta_key'				=> $meta_key,
                //'meta_value'				=> '',
                'post_status' => 'publish',
                'orderby' => $orderby,
                'order' => $order,
            );
        } else {

            $args = array(
                'posts_per_page' => "$pagination",
                'paged' => $_GET['page_id_all'],
                'post_type' => 'events',
                'post_status' => 'publish',
                'meta_key' => $meta_key,
                'meta_value' => $meta_value,
                'meta_compare' => $meta_compare,
                'orderby' => $orderby,
                'order' => $order,
            );
        }


        if (isset($_GET['filter_category']) && $_GET['filter_category'] <> '' && $_GET['filter_category'] <> '0') {
            $event_category_array = array('event-category' => "$filter_category");
            $args = array_merge($args, $event_category_array);
        } else if (isset($category) && $category <> '' && $category <> '0') {
            $event_category_array = array('event-category' => "$category");
            $args = array_merge($args, $event_category_array);
        }
        // below block will be commnet for filter
        //if(isset($filter_category) && $filter_category <> '' && $filter_category <> '0'){
        //$events_category_array = array('event-category' => "$filter_category");
        //$args = array_merge($args, $events_category_array);
        //} 

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

        // below block will be commnet for filter
        //if(isset($category) && $category <> '' && $category <> '0'){
        //$event_category_array = array('event-category' => "$category");
        //$args = array_merge($args, $event_category_array);
        //}
        if (isset($section_title) && $section_title <> '') {
            echo '<div class="cs-section-title col-md-12">
					<h2>' . esc_attr($section_title) . '</h2>
				  </div>';
        }

        if (isset($filterable) && $filterable == 'Yes' && $view <> 'events-slider' && $view <> 'events-calender') {
            //cs_get_event_filters( $filter_category_array );
            cs_get_event_filters($filter_category, $active);
        }
        set_query_var('args', $args);
        if ($view == 'events-grid') {
            include('event-grid.php');
        } else if ($view == 'events-listing') {
            include('event-list.php');
        } else if ($view == 'announcement') {

            include('event-announcement.php');
        } else if ($view == 'events-slider') {
            include('event-slider.php');
        } else if ($view == 'events-calender') {
            include('event-calender.php');
        }

        //==Pagination Start
        if (isset($display_pagination) && $display_pagination == 'Yes') {
            if ($count_post > $pagination && $pagination > 0 && $view <> 'events-slider' && $view <> 'events-calender') {
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

    add_shortcode('cs_events', 'cs_event_listing');
}

/**
 *
 * @Get Event CAtegories
 * @return
 */
if (!function_exists('cs_event_categories')) {

    function cs_event_categories($category) {

        if ($category != '' && $category != '0') {
            $row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $category));
        }

        if (isset($category) && $category != '' && $category != '0') {
            echo '<a href="' . esc_url(home_url('/')) . '?cat=' . $row_cat->term_id . '">' . $row_cat->name . '</a>';
        } else {
            /* Get All Tags */
            $before_cat = '<i class="fa fa-align-left"></i> ';
            $categories_list = get_the_term_list(get_the_id(), 'event-category', $before_cat, ', ', '');
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
if (!function_exists('cs_get_event_filters')) {

    function cs_get_event_filters($filter_category = '', $activelist = '', $activegird = '') {
        global $post;
        global $activeGrid, $activeList;
        $categories = get_categories(array('taxonomy' => 'event-category', 'hide_empty' => 0));
        ?>
        <div class="col-md-12 main-filter">
            <nav class="filter-nav">
                <ul class="cs-filter-menu pull-left">
                    <li><span class="sortby"><?php _e('Sort by', 'cs_frame'); ?></span></li>
                    <li>
                        <div class="slect-area">
                            <i class="icon-location7"></i>
                            <form action="#" method="get" name="filterable" >
                                <select name="filter_category" onChange="this.form.submit()" >
        <?php
        $i = 0;
        foreach ($categories as $category) {
            ?>
                                        <option value="<?php echo esc_attr($category->slug); ?>"  
                                                <?php if ($filter_category == $category->slug) {
                                                    echo 'selected';
                                                } ?>><?php echo esc_attr($category->cat_name); ?>
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
                $switchToGrid = '?page_switch=grid' . $qrystr;
                $switchToList = '?page_switch=list' . $qrystr;
                ?>

                <ul class="grid-filter">
                    <li class="" <?php echo cs_allow_special_char($activegird); ?>>
                        <a href="<?php echo esc_url($switchToList); ?>"><i class="icon-th-list"></i></a>
                    </li>
                    <li class="" <?php echo cs_allow_special_char($activelist); ?>>
                        <a href="<?php echo esc_url($switchToGrid); ?>"><i class="icon-grid4"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php
    }

}

/**
 *
 * @Get Event Address
 * @return
 */
if (!function_exists('cs_get_event_address')) {

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
if (!function_exists('cs_get_event_title')) {

    function cs_get_event_title($address = '', $limit = 35) {
        return substr($address, 0, $limit);
        if (strlen($address) > $limit) {
            echo '...';
        }
    }

}

/**
 *
 * @Get Event Date
 * @return
 */
if (!function_exists('cs_correct_date_form')) {

    function cs_correct_date_form($date = '') {

        $cs_date_params = explode('-', $date);
        if (strpos($date, '/') !== false) {
            $cs_date_params = explode('/', $date);
        }

        $cs_right_date = $date;
        if (is_array($cs_date_params) && sizeof($cs_date_params) == 3) {
            $cs_right_date = $cs_date_params[1] . '-' . $cs_date_params[0] . '-' . $cs_date_params[2];
        }
        return $cs_right_date;
    }

}




if (!function_exists('cs_get_current_pageurl')) {

    function cs_get_current_pageurl() {

        $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

}

function calender_time($event_time) {

    //$event_time = str_replace(':', '', $event_time).'00';

    $event_time = str_replace('am', '', $event_time);

    $event_time = str_replace('pm', '', $event_time);

    if (strlen($event_time) < 6) {

        $event_time = '0' . $event_time;
    }

    return $event_time; // Removes special chars.
}

function cs_event_calendar($post_id = '') {

    if (!isset($post_id) && $post_id == '') {

        global $post;

        $post_id = $post->ID;
    }
        
    $cal_post = get_post($post_id);
    if ($cal_post) {

        $event_from_date = get_post_meta($post_id, 'cs_event_from_date', true);

        $cs_event_to_date = get_post_meta($post_id, "cs_event_to_date", true);

        $location = get_post_meta($post_id, "cs_location_address", true);

        $cs_event_all_day = get_post_meta($post_id, 'cs_event_all_day', true);


        $start_year = date('Y', strtotime($event_from_date));

        $start_month = date('m', strtotime($event_from_date));

        $start_day = date('d', strtotime($event_from_date));


        $end_year = date('Y', strtotime($cs_event_to_date));

        $end_month = date('m', strtotime($cs_event_to_date));

        $end_day = date('d', strtotime($cs_event_to_date));

      
        if ($cs_event_all_day != "on") {

            $start_time = get_post_meta($post_id, 'cs_event_start_time', true);
            $end_time = get_post_meta($post_id, 'cs_event_end_time', true);
        } else {

            $start_time = $end_time = '';
        }

        if (($start_time != '') && ($start_time != ':')) {
            $event_start_time = explode(":", $start_time);
        }

        if (($end_time != '') && ($end_time != ':')) {
            $event_end_time = explode(":", $end_time);
        }

   

        $post_title = get_the_title($post_id);

        $cs_vcalendar = new vcalendar();

        $cs_vevent = new vevent();


        $site_info = get_bloginfo('name') . ' Events';

        $cs_vevent->setProperty('categories', $site_info);



        if (isset($event_start_time)) {
            @$cs_vevent->setProperty('dtstart', @$start_year, @$start_month, @$start_day, @$event_start_time[0], @$event_start_time[1], 00);
        } else {
            $cs_vevent->setProperty('dtstart', $start_year, $start_month, $start_day);
        } // YY MM dd hh mm ss

        if (isset($event_end_time)) {
            @$cs_vevent->setProperty('dtend', $end_year, $end_month, $end_day, $event_end_time[0], $event_end_time[1], 00);
        } else {
            $cs_vevent->setProperty('dtend', $end_year, $end_month, $end_day);
        } // YY MM dd hh mm ss

        $cs_vevent->setProperty('description', strip_tags($cal_post->post_excerpt));

        if (isset($location)) {
            $cs_vevent->setProperty('location', $location);
        }

        $cs_vevent->setProperty('summary', $post_title);

        $cs_vcalendar->addComponent($cs_vevent);

        $templateurl = cs_framework::plugin_url() . 'cache/';

        $cs_vcalendar->setConfig('directory', cs_framework::plugin_dir() . 'cache');

        $cs_vcalendar->setConfig('filename', 'event-' . $post_id . '.ics');

        $cs_vcalendar->saveCalendar();

        ////OUT LOOK & iCAL URL//

        $output_calendar_url['ical'] = $templateurl . 'event-' . $post_id . '.ics';

        ////GOOGLE URL//

        $google_url = "http://www.google.com/calendar/event?action=TEMPLATE";

        $google_url .= "&text=" . urlencode($post_title);

        if (isset($event_start_time) && isset($event_end_time)) {

            $google_url .= "&dates=" . @$start_year . @$start_month . @$start_day . "T" . str_replace('.', '', @$event_start_time[0]) . str_replace('.', '', @$event_start_time[1]) . "00/" . @$end_year . @$end_month . @$end_day . "T" . str_replace('.', '', @$event_end_time[0]) . str_replace('.', '', @$event_end_time[1]) . "00";
        } else {

            $google_url .= "&dates=" . $start_year . $start_month . $start_day . "/" . $end_year . $end_month . $end_day;
        }

        $google_url .= "&sprop=website:" . get_permalink($post_id);

        $google_url .= "&details=" . strip_tags($cal_post->post_excerpt);

        if (isset($location)) {
            $google_url .= "&location=" . $location;
        } else {
            $google_url .= "&location=Unknown";
        }

        $google_url .= "&trp=true";

        $output_calendar_url['google'] = $google_url;

        ////YAHOO CALENDAR URL///

        $yahoo_url = "http://calendar.yahoo.com/?v=60&view=d&type=20";

        $yahoo_url .= "&title=" . str_replace(' ', '+', $post_title);

        if (isset($event_start_time)) {

            $yahoo_url .= "&st=" . @$start_year . @$start_month . @$start_day . "T" . @$event_start_time[0] . @$event_start_time[1] . "00";
        } else {

            $yahoo_url .= "&st=" . $start_year . $start_month . $start_day;
        }

        $yahoo_url .= "&desc=" . str_replace(' ', '+', strip_tags($cal_post->post_excerpt)) . ' -- ' . get_permalink($post_id);

        $yahoo_url .= "&in_loc=" . str_replace(' ', '+', $location);

        $output_calendar_url['yahoo'] = $yahoo_url;
    }

    return $output_calendar_url;
}

function add_to_calender() {
    global $post;

    $calendar_args = array('outlook' => 1, 'google_calender' => 1, 'yahoo_calender' => 1, 'ical_cal' => 1);
   
    if ($calendar_args) {

       $calendar_url = cs_event_calendar($post->ID);

        ?>

        <a class="add-calender add_calendar_toggle<?php echo absint($post->ID) ?> btn-toggle_cal"><?php _e('Add to Calender', 'cs_frame'); ?></a>

        <ul class="add_calendar add_calendar<?php echo absint($post->ID); ?>" id="inline-<?php echo absint($post->ID); ?>">

            <?php if ($calendar_args['outlook']) { ?>

                <li class="i_calendar">

                    <a href="<?php echo esc_url_raw($calendar_url['ical']) ?>"> 

                        <img src="<?php echo cs_framework::plugin_url() ?>assets/images/calendar-icon.png" alt="" width="24" />

                    </a> 

                </li>

            <?php } ?>

            <?php if ($calendar_args['google_calender']) { ?>

                <li class="i_google"><a href="<?php echo esc_url_raw($calendar_url['google']) ?>" target="_blank"> 

                        <img src="<?php echo cs_framework::plugin_url() ?>assets/images/google-icon.png" alt="" width="25" />

                    </a> 

                </li>

            <?php } ?>

        <?php if ($calendar_args['yahoo_calender']) { ?>

                <li class="i_yahoo"><a href="<?php echo esc_url_raw($calendar_url['yahoo']) ?>" target="_blank">

                        <img src="<?php echo cs_framework::plugin_url() ?>assets/images/yahoo-icon.png" alt="" width="24" />

                    </a> 

                </li>

        <?php } ?>

        </ul>

        <?php
    }

}
