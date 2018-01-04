<?php
/**
 * The template for Settings up Functions
 */
/**
 * @Get logo
 *
 */
global $cs_theme_options;
if (!function_exists('cs_logo')) {

    function cs_logo() {
        global $cs_theme_options;
        $logo = $cs_theme_options['cs_custom_logo'];
        ?>
        <div class="col-md-4">
            <a href="<?php echo esc_url(esc_url(home_url('/'))); ?>" class="logo">
                <img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('name'); ?>"></a>
        </div>

        <?php
    }

}

if (!function_exists('cs_sticky_logo')) {

    function cs_sticky_logo() {
        global $cs_theme_options;
        $stickey_logo = isset($cs_theme_options['cs_sticky_logo']) ? $cs_theme_options['cs_sticky_logo'] : '';
        ?>
        <div class="logo has_sticky">
            <a href="<?php echo esc_url(esc_url(home_url('/'))); ?>">    
                <img src="<?php echo esc_url($stickey_logo); ?>" alt="<?php bloginfo('name'); ?>">
            </a>
        </div>
        <?php
    }

}
/**
 * @Set Header Position
 *
 *
 */
if (!function_exists('cs_header_postion_class')) {

    function cs_header_postion_class() {
        global $cs_theme_options;
        return 'header-' . $cs_theme_options['cs_header_position'];
    }

}
if (!function_exists('cs_header_search_class')) {

    function cs_header_search_class() {
        ?>

        <form method="get" action="<?php echo esc_url(esc_url(home_url('/'))); ?>" >
            <span><?php _e('Search', 'uoc'); ?></span>
            <input type="text" value="<?php echo get_search_query() ?>" name="s" id="s"   placeholder="<?php _e('Enter your search', 'uoc'); ?>" />
            <label><input type="submit" value=""></label>
        </form>

        <?php
    }

}
/**
 * @Set Header strip
 *
 *
 */
if (!function_exists('cs_header_strip')) {

    function cs_header_strip($container = 'on') {
        global $cs_theme_options;
        $cs_header_menu_strip = isset($cs_theme_options['cs_header_menu_strip']) ? $cs_theme_options['cs_header_menu_strip'] : '';
        $cs_header_top_search = isset($cs_theme_options['cs_header_top_search']) ? $cs_theme_options['cs_header_top_search'] : '';



        if (isset($cs_theme_options['cs_sitcky_header_switch']) and $cs_theme_options['cs_sitcky_header_switch'] == "on") { // cs_scrolltofix();  
            $cs_class = "sticky";
            ?>	
            <script type="text/javascript">

                jQuery(document).ready(function () {
                    jQuery(window).scroll(function () {
                        var sticky = jQuery('.sticky'),
                                scroll = jQuery(window).scrollTop();

                        if (scroll >= 2)
                            sticky.addClass('fixed');
                        else
                            sticky.removeClass('fixed');
                    });

                });

            </script>
            <?php
        } else {
            $cs_class = "";
        }
        ?> 



        <div class="container">
            <div class="row">
                <?php echo cs_logo() ?>
                <div class="col-md-8">
                    <div class="right-side">
                        <nav class="top-nav">
                            <?php
                            if ($cs_header_menu_strip == 'on') {
                                cs_navigation($nav = 'top-menu', $menus = '', $menu_class = '', $depth = '0');
                            }
                            ?>
                        </nav>
                        <div class="header-search">
                            <?php
                            if ($cs_header_top_search == 'on') {
                                echo cs_header_search_class();
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" >
                    <div class="main-nav <?php echo sanitize_html_class($cs_class) ?>">
                        <nav class="navigation">
                            <a class="cs-click-menu" href="#">
                                <i class="icon-align-justify"></i>
                            </a>
                            <?php echo cs_header_main_navigation(); ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (isset($cs_theme_options['cs_header_top_strip']) && $cs_theme_options['cs_header_top_strip'] == 'on') {
            $cs_afterlogin_class = '';
            ?>
            <div class="cs-top-bar">
                <div class="container">
                    <?php if (isset($cs_theme_options['cs_time_setting_switch']) && $cs_theme_options['cs_time_setting_switch'] == 'on') { ?>
                        <div class="left-side">
                            <span class="cs-timing-text"><?php echo esc_attr($cs_content_time); ?></span> 
                        </div>
                    <?php }
                    ?>

                    <div class="right-side">
                        <?php
                        $cs_multi_setting_switch = isset($cs_multi_setting_switch) ? $cs_multi_setting_switch : '';
                        if (function_exists('icl_object_id') && $cs_multi_setting_switch != 'off') {
                            ?>  
                            <?php echo do_action('icl_language_selector'); ?> 								
                        <?php } ?>
                        <div class="social-media">
                            <ul>
                                <?php if (isset($cs_theme_options['cs_social_setting_switch']) and $cs_theme_options['cs_social_setting_switch'] == 'on') { ?>
                                    <?php
                                    if (function_exists('cs_social_network')) {
                                        cs_social_network();
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }

}

/**
 * @Top and Main Navigation
 *
 *
 */
if (!function_exists('cs_navigation')) {

    function cs_navigation($nav = '', $menus = '', $menu_class = '', $depth = '0', $container_class = '') {
        global $cs_theme_options;
        if (has_nav_menu($nav)) {
            $defaults = array(
                'theme_location' => "$nav",
                'menu' => '',
                'container' => '',
                'container_class' => "$container_class",
                'container_id' => '',
                'menu_class' => "$menu_class",
                'menu_id' => "$menus",
                'echo' => false,
                'fallback_cb' => 'wp_page_menu',
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth' => "$depth",
                'walker' => '',
            );
            echo do_shortcode(str_replace(array('sub-menu', 'children', '<>'), array('sub-dropdown', 'sub-dropdown', ''), (wp_nav_menu($defaults))));
        } else {
            $defaults = array(
                'theme_location' => "",
                'menu' => '',
                'container' => '',
                'container_class' => "$container_class",
                'container_id' => '',
                'menu_class' => "$menu_class",
                'menu_id' => "$menus",
                'echo' => false,
                'fallback_cb' => 'wp_page_menu',
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth' => "$depth",
                'walker' => '',
            );
            echo do_shortcode(str_replace(array('sub-menu', 'children', '<>'), array('sub-dropdown', 'sub-dropdown', ''), (wp_nav_menu($defaults))));
        }
    }

}


//===============
//@ Header 
//===============
if (!function_exists('cs_get_headers')) {

    function cs_get_headers() {
        global $cs_theme_options;
        $cs_contact_us_switch = isset($cs_theme_options['cs_contact_us_switch']) ? $cs_theme_options['cs_contact_us_switch'] : '';
        $cs_contact_phone_switch = isset($cs_theme_options['cs_contact_phone_switch']) ? $cs_theme_options['cs_contact_phone_switch'] : '';
        $cs_contact_email_switch = isset($cs_theme_options['cs_contact_email_switch']) ? $cs_theme_options['cs_contact_email_switch'] : '';
        $cs_contact_button_switch = isset($cs_theme_options['cs_contact_button_switch']) ? $cs_theme_options['cs_contact_button_switch'] : '';
        $cs_contact_us_text = isset($cs_theme_options['cs_contact_us_text']) ? $cs_theme_options['cs_contact_us_text'] : '';
        $cs_sub_contact_us_text = isset($cs_theme_options['cs_sub_contact_us_text']) ? $cs_theme_options['cs_sub_contact_us_text'] : '';
        $cs_phone_number_text = isset($cs_theme_options['cs_phone_number_text']) ? $cs_theme_options['cs_phone_number_text'] : '';
        $cs_content_email = isset($cs_theme_options['cs_content_email']) ? $cs_theme_options['cs_content_email'] : '';
        $cs_button_text = isset($cs_theme_options['cs_button_text']) ? $cs_theme_options['cs_button_text'] : '';
        $cs_button_text_link = isset($cs_theme_options['cs_button_text_link']) ? $cs_theme_options['cs_button_text_link'] : '';
        ?>




        <!-- Header 1 Start -->
        <header id="main-header">
            <?php cs_header_strip(); ?>
        </header>
        <?php
        cs_page_title();
    }

}

// Page Title
if (!function_exists('cs_page_title')) {

    function cs_page_title() {

        global $cs_theme_options;
        if (is_page()) {

            $cs_page_title = get_post_meta(get_the_id(), 'cs_page_title', true);
            if ($cs_page_title == 'on') {
                ?>
                <div class="main-section">
                    <div class="container">
                        <h1><?php the_title(); ?></h1>
                    </div>
                </div>
                <?php
            }
        } else if (is_search() || is_archive() || is_404() || is_category() || is_author()) {
            $cs_page_title = isset($cs_theme_options['cs_def_page_title']) ? $cs_theme_options['cs_def_page_title'] : '';
            if ($cs_page_title == 'on') {
                ?>
                <div class="main-section">
                    <div class="container">
                        <h1><?php cs_post_page_title(); ?></h1>
                    </div>
                </div>
                <?php
            }
        }
    }

}


//=================
// @Main navigation
//=================
if (!function_exists('cs_header_main_navigation')) {

    function cs_header_main_navigation() {
        global $post, $post_meta;
        $post_type = get_post_type(get_the_ID());
        $meta_element = 'cs_full_data';
        $post_ID = get_the_ID();
        $post_meta = get_post_meta($post_ID, "$meta_element", true);

        if (function_exists("is_shop") and ! is_shop()) {
            if (is_author() || is_search() || is_archive() || is_category() || is_404()) {

                $cs_header_banner_style = '';
            }
        } else if (!function_exists("is_shop")) {
            if (is_author() || is_search() || is_archive() || is_category() || is_404()) {

                $cs_header_banner_style = '';
            }
        }
        cs_navigation('main-menu', '');
    }

}
