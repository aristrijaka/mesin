<?php
/**
 * @Theme option function
 * @return
 *
 */
if (!function_exists('cs_options_page')) {

    function cs_options_page() {
        global $cs_theme_options, $cs_options;
        // $cs_theme_options=get_option('cs_theme_options');
        ?>

        <div class="theme-wrap fullwidth">
            <div class="inner">
                <div class="outerwrapp-layer">
                    <div class="loading_div"> <i class="icon-circle-o-notch icon-spin"></i> <br>
        <?php _e('Saving changes...', 'uoc'); ?>
                    </div>
                    <div class="form-msg"> <i class="icon-check-circle-o"></i>
                        <div class="innermsg"></div>
                    </div>
                </div>
                <div class="row">
                    <form id="frm" method="post">
                        <?php
                        $theme_options_fields = new theme_options_fields();
                        $return = $theme_options_fields->cs_fields($cs_options);
                        ?>
                        <div class="col1">
                            <nav class="admin-navigtion">
                                <div class="logo"> <a href="#" class="logo1"><img src="<?php echo esc_url(get_template_directory_uri()) ?>/include/assets/images/logo-themeoption.png" /></a> <a href="#" class="nav-button"><i class="icon-align-justify"></i></a> </div>
                                <ul>
        <?php echo force_balance_tags($return[1], true); ?>
                                </ul>
                            </nav>
                        </div>
                        <div class="col2">
        <?php echo force_balance_tags($return[0], true); /* Settings */ ?>
                        </div>
                        <div class="clear"></div>
                        <div class="footer">
                            <input type="button" id="submit_btn" name="submit_btn" class="bottom_btn_save" value="<?php _e('Save All Settings', 'uoc'); ?>" onclick="javascript:theme_option_save('<?php echo esc_js(admin_url('admin-ajax.php')) ?>', '<?php echo esc_js(get_template_directory_uri()); ?>');" />
                            <input type="hidden" name="action" value="theme_option_save"  />
                            <input class="bottom_btn_reset" name="reset" type="button" value="<?php _e('Reset All Options', 'uoc'); ?>" onclick="javascript:cs_rest_all_options('<?php echo esc_js(admin_url('admin-ajax.php')) ?>', '<?php echo esc_js(get_template_directory_uri()) ?>');" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <!--wrap--> 
        <script type="text/javascript">
            // Sub Menus Show/hide
            jQuery(document).ready(function ($) {
                jQuery(".sub-menu").parent("li").addClass("parentIcon");
                $("a.nav-button").click(function () {
                    $(".admin-navigtion").toggleClass("navigation-small");
                });

                $("a.nav-button").click(function () {
                    $(".inner").toggleClass("shortnav");
                });

                $(".admin-navigtion > ul > li > a").click(function () {
                    var a = $(this).next('ul')
                    $(".admin-navigtion > ul > li > a").not($(this)).removeClass("changeicon")
                    $(".admin-navigtion > ul > li ul").not(a).slideUp();
                    $(this).next('.sub-menu').slideToggle();
                    $(this).toggleClass('changeicon');
                });
            });

            function show_hide(id) {
                var link = id.replace('#', '');
                jQuery('.horizontal_tab').fadeOut(0);
                jQuery('#' + link).fadeIn(400);
            }

            function toggleDiv(id) {
                jQuery('.col2').children().hide();
                jQuery(id).show();
                location.hash = id + "-show";
                var link = id.replace('#', '');
                jQuery('.categoryitems li').removeClass('active');
                jQuery(".menuheader.expandable").removeClass('openheader');
                jQuery(".categoryitems").hide();
                jQuery("." + link).addClass('active');
                jQuery("." + link).parent("ul").show().prev().addClass("openheader");
            }
            jQuery(document).ready(function () {
                jQuery(".categoryitems").hide();
                jQuery(".categoryitems:first").show();
                jQuery(".menuheader:first").addClass("openheader");
                jQuery(".menuheader").live('click', function (event) {
                    if (jQuery(this).hasClass('openheader')) {
                        jQuery(".menuheader").removeClass("openheader");
                        jQuery(this).next().slideUp(200);
                        return false;
                    }
                    jQuery(".menuheader").removeClass("openheader");
                    jQuery(this).addClass("openheader");
                    jQuery(".categoryitems").slideUp(200);
                    jQuery(this).next().slideDown(200);
                    return false;
                });

                var hash = window.location.hash.substring(1);
                var id = hash.split("-show")[0];
                if (id) {
                    jQuery('.col2').children().hide();
                    jQuery("#" + id).show();
                    jQuery('.categoryitems li').removeClass('active');
                    jQuery(".menuheader.expandable").removeClass('openheader');
                    jQuery(".categoryitems").hide();
                    jQuery("." + id).addClass('active');
                    jQuery("." + id).parent("ul").slideDown(300).prev().addClass("openheader");
                }
            });
            jQuery(function ($) {
                $("#cs_launch_date").datepicker({
                    defaultDate: "+1w",
                    dateFormat: "dd/mm/yy",
                    changeMonth: true,
                    numberOfMonths: 1,
                    onSelect: function (selectedDate) {
                        $("#cs_launch_date").datepicker();
                    }
                });
            });
        </script>
        <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()) ?>/include/assets/css/jquery_ui_datepicker.css">
        <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()) ?>/include/assets/css/jquery_ui_datepicker_theme.css">
        <?php
    }

}

/**
 * @Background Count function
 * @return
 *
 */
if (!function_exists('cs_bgcount')) {

    function cs_bgcount($name, $count) {
        for ($i = 0; $i <= $count; $i++) {
            $pattern['option' . $i] = $name . $i;
        }
        return $pattern;
    }

}

/**
 * @Theme Options Initilize
 * @return
 *
 */
add_action('init', 'cs_theme_option');
if (!function_exists('cs_theme_option')) {

    function cs_theme_option() {
        global $cs_options, $cs_header_colors, $cs_theme_options;
        // $cs_theme_options		= get_option('cs_theme_options');
        $on_off_option = array("show" => "on", "hide" => "off");
        $navigation_style = array("left" => "left", "center" => "center", "right" => "right");
        $google_fonts = array('google_font_family_name' => array('', '', ''), 'google_font_family_url' => array('', '', ''));
        $social_network = array('social_net_icon_path' => array('', '', '', '', ''), 'social_net_awesome' => array('icon-facebook9', 'icon-dribbble7', 'icon-twitter2', 'icon-behance2'), 'social_net_url' => array('https://www.facebook.com/', 'https://dribbble.com/', 'https://www.twitter.com/', 'https://www.behance.net/'), 'social_net_tooltip' => array('Facebook', 'Dribbble', 'Twitter', 'Behance'), 'social_font_awesome_color' => array('#cccccc', '#cccccc', '#cccccc', '#cccccc'));

        $banner_fields = array('banner_field_title' => array('Banner 1'), 'banner_field_style' => array('top_banner'), 'banner_field_type' => array('code'), 'banner_field_image' => array(''), 'banner_field_url' => array('#'), 'banner_field_url_target' => array('_self'), 'banner_adsense_code' => array(''), 'banner_field_code_no' => array('0'));


        $sidebar = array(
            'sidebar' => array(
                'blogs_sidebar' => __('Blogs Sidebar', 'uoc'),
                'faq_sidebar' => __('Faq Sidebar', 'uoc'),
                'courses_sidebar' => __('Courses Sidebar', 'uoc'),
                'courses_detail' => __('Courses Detail', 'uoc'),
                'event_sidebar' => __('Event Sidebar', 'uoc'),
                'gallery_sidebar' => __('Gallery Sidebar', 'uoc'),
                'team_sidebar' => __('Team sidebar', 'uoc'),
                'contact_us' => __('Contact us', 'uoc'),
                'widgets' => __('Widgets', 'uoc'),
                'search_sidebar' => __('Search sidebar', 'uoc'),
            )
        );
        $menus_locations = array_flip(get_nav_menu_locations());
        $breadcrumb_option = array("option1" => "option1", "option2" => "option2", "option3" => "option3");
        $deafult_sub_header = array('breadcrumbs_sub_header' => __('Breadcrumbs Sub Header', 'uoc'), 'slider' => __('Revolution Slider', 'uoc'), 'no_header' => __('No sub Header', 'uoc'));
        $padding_sub_header = array('Default' => 'default', 'Custom' => 'custom');

        #Menus List
        $menu_option = get_registered_nav_menus();
        foreach ($menu_option as $key => $menu) {
            $menu_location = $key;
            $menu_locations = get_nav_menu_locations();
            $menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
            $menu_name[] = (isset($menu_object->name) ? $menu_object->name : '');
        }

        #Mailchimp List
        $mail_chimp_list[] = '';
        if (isset($cs_theme_options['cs_mailchimp_key'])) {
            $mailchimp_option = $cs_theme_options['cs_mailchimp_key'];
            if ($mailchimp_option <> '' && function_exists('cs_mailchimp_list')) {
                $mc_list = cs_mailchimp_list($mailchimp_option);
                if (is_array($mc_list) && isset($mc_list['data'])) {
                    foreach ($mc_list['data'] as $list) {
                        $mail_chimp_list[$list['id']] = $list['name'];
                    }
                }
            }
        }

        #Map Search Pages
        $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-ad-search.php',
            'hierarchical' => 0
        ));

        $map_options = array();
        $map_options[] = 'Default';
        foreach ($pages as $page) {
            $map_options[$page->ID] = $page->post_title;
        }

        #google fonts array
        $g_fonts = cs_googlefont_list();
        $g_fonts_atts = cs_get_google_font_attribute();

        global $cs_theme_options;
        if (isset($cs_theme_options) and $cs_theme_options <> '') {
            if (isset($cs_theme_options['sidebar']) and count($cs_theme_options['sidebar']) > 0) {
                $cs_sidebar = array('sidebar' => $cs_theme_options['sidebar']);
            } elseif (!isset($cs_theme_options['sidebar'])) {
                $cs_sidebar = array('sidebar' => array());
            }
        } else {
            $cs_sidebar = $sidebar;
        }

        #Set the Options Array
        $cs_options = array();
        $cs_header_colors = cs_header_setting();

        #general setting options
        $cs_options[] = array(
            "name" => __("General", 'uoc'),
            "fontawesome" => 'icon-cog3',
            "type" => "heading",
            "options" => array(
                'tab-global-setting' => __("global", 'uoc'),
                'tab-header-options' => __("Header", 'uoc'),
                'tab-footer-options' => __("Footer", 'uoc'),
                'tab-social-setting' => __("social icons", 'uoc'),
                'tab-social-network' => __("social sharing", 'uoc'),
                'banner-fields' => __('Ads Unit Settings', 'uoc'),
                'tab-custom-code' => __("custom code", 'uoc'),
                'tab-search-code' => __("Search setting", 'uoc'),
            )
        );
        $cs_options[] = array(
            "name" => __("color", 'uoc'),
            "fontawesome" => 'icon-magic',
            "hint_text" => "",
            "type" => "heading",
            "options" => array(
                'tab-general-color' => __("general", 'uoc'),
                'tab-header-color' => __("Header", 'uoc'),
                'tab-footer-color' => __("Footer", 'uoc'),
                'tab-heading-color' => __("headings", 'uoc'),
            )
        );
        $cs_options[] = array(
            "name" => __("typography / fonts", 'uoc'),
            "fontawesome" => 'icon-font',
            "desc" => "",
            "hint_text" => "",
            "type" => "heading",
            "options" => array(
                'tab-custom-font' => __('Custom Font', 'uoc'),
                'tab-font-family' => __('font family', 'uoc'),
                'tab-font-size' => __('Font Size', 'uoc'),
            )
        );
        $cs_options[] = array(
            "name" => __("sidebar", 'uoc'),
            "fontawesome" => 'icon-columns',
            "id" => "tab-sidebar",
            "std" => "",
            "type" => "main-heading",
            "options" => ''
        );
        $cs_options[] = array(
            "name" => __("Seo", 'uoc'),
            "fontawesome" => 'icon-globe6',
            "id" => "tab-seo",
            "std" => "",
            "type" => "main-heading",
            "options" => ""
        );
        $cs_options[] = array(
            "name" => __("global", 'uoc'),
            "id" => "tab-global-setting",
            "type" => "sub-heading"
        );
        $cs_options[] = array(
            "name" => __("Layout", 'uoc'),
            "desc" => "",
            "hint_text" => __("Layout type", 'uoc'),
            "id" => "cs_layout",
            "std" => "boxed",
            "options" => array(
                "boxed" => __("Boxed", 'uoc'),
                "full_width" => __("Full width", 'uoc')
            ),
            "type" => "layout",
        );

        $cs_options[] = array(
            "name" => "",
            "id" => "cs_horizontal_tab",
            "class" => "horizontal_tab",
            "type" => "horizontal_tab",
            "std" => "",
            "options" => array(__('Background', 'uoc') => 'background_tab', __('Pattern', 'uoc') => 'pattern_tab', __('Custom Image', 'uoc') => 'custom_image_tab')
        );

        $cs_options[] = array(
            "name" => __("Background image", 'uoc'),
            "desc" => "",
            "hint_text" => __("Choose from Predefined Background images.", 'uoc'),
            "id" => "cs_bg_image",
            "class" => "cs_background_",
            "path" => "background",
            "tab" => "background_tab",
            "std" => "bg0",
            "type" => "layout_body",
            "display" => "block",
            "options" => cs_bgcount('bg', '10')
        );

        $cs_options[] = array("name" => __("Background pattern", 'uoc'),
            "desc" => "",
            "hint_text" => __("Choose from Predefined Pattern images.", 'uoc'),
            "id" => "cs_bg_image",
            "class" => "cs_background_",
            "path" => "patterns",
            "tab" => "pattern_tab",
            "std" => "bg7",
            "type" => "layout_body",
            "display" => "none",
            "options" => cs_bgcount('pattern', '27')
        );
        $cs_options[] = array(
            "name" => __("Custom image", 'uoc'),
            "desc" => "",
            "hint_text" => __("This option can be used only with Boxed Layout.", 'uoc'),
            "id" => "cs_custom_bgimage",
            "std" => "",
            "tab" => "custom_image_tab",
            "display" => "none",
            "type" => "upload logo"
        );
        $cs_options[] = array("name" => __("Background image position", 'uoc'),
            "desc" => "",
            "hint_text" => __("Choose image position for body background", 'uoc'),
            "id" => "cs_bgimage_position",
            "std" => "Center Repeat",
            "type" => "select",
            "options" => array(
                "option1" => "no-repeat center top",
                "option2" => "repeat center top",
                "option3" => "no-repeat center",
                "option4" => "Repeat Center",
                "option5" => "no-repeat left top",
                "option6" => "repeat left top",
                "option7" => "no-repeat fixed center",
                "option8" => "no-repeat fixed center / cover"
            )
        );
        $cs_options[] = array("name" => __("Custom favicon", 'uoc'),
            "desc" => "",
            "hint_text" => __("Custom favicon for your site", "uoc"),
            "id" => "cs_custom_favicon",
            "std" => get_template_directory_uri() . "/assets/images/Favicon.jpg",
            "type" => "upload logo"
        );

        $cs_options[] = array("name" => __("Responsive", 'uoc'),
            "desc" => "",
            "hint_text" => __("Set responsive design layout for mobile devices On/Off here", 'uoc'),
            "id" => "cs_responsive",
            "std" => "on",
            "type" => "checkbox",
            "options" => $on_off_option
        );



        if (class_exists('cs_framework')) {
            $cs_options[] = array("name" => "Language Settings",
                "id" => "tab-general-options",
                "std" => __("Language Settings", "uoc"),
                "type" => "section",
                "options" => ""
            );


            $dir = cs_framework::plugin_dir() . '/languages/';
            $cs_plugin_language[''] = __("Select Language File", 'uoc');
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    while (($file = readdir($dh)) !== false) {
                        $ext = pathinfo($file, PATHINFO_EXTENSION);
                        if ($ext == 'mo') {
                            $cs_plugin_language[$file] = $file;
                        }
                    }
                    closedir($dh);
                }
            }

            $cs_options[] = array("name" => __("Select Language", 'uoc'),
                "desc" => "",
                "hint_text" => "",
                "id" => "cs_language_file",
                "std" => "30",
                "type" => "select",
                "options" => $cs_plugin_language,
            );
        }
        // Header options start
        $cs_options[] = array("name" => __("header", 'uoc'),
            "id" => "tab-header-options",
            "type" => "sub-heading"
        );


        $cs_options[] = array("name" => __("Logo", 'uoc'),
            "desc" => "",
            "hint_text" => __("Upload your custom logo in .png .jpg .gif formats only.", 'uoc'),
            "id" => "cs_custom_logo",
            "std" => get_template_directory_uri() . "/assets/images/logo1.png",
            "type" => "upload logo"
        );
        $cs_options[] = array("name" => __("Logo Height", 'uoc'),
            "desc" => "",
            "hint_text" => __("Set exact logo height otherwise logo will not display normally.", 'uoc'),
            "id" => "cs_logo_height",
            "min" => '0',
            "max" => '100',
            "std" => "72",
            "type" => "range"
        );
        $cs_options[] = array("name" => __("logo width", 'uoc'),
            "desc" => "",
            "hint_text" => __("Set exact logo width otherwise logo will not display normally.", 'uoc'),
            "id" => "cs_logo_width",
            "min" => '0',
            "max" => '210',
            "std" => "275",
            "type" => "range"
        );

        $cs_options[] = array("name" => __("Logo margin top", 'uoc'),
            "desc" => "",
            "hint_text" => __("Logo spacing margin from top", 'uoc'),
            "id" => "cs_logo_margint",
            "min" => '0',
            "max" => '200',
            "std" => "28",
            "type" => "range"
        );
        $cs_options[] = array("name" => __("Logo margin bottom", 'uoc'),
            "desc" => "",
            "hint_text" => __("Logo spacing margin from bottom.", 'uoc'),
            "id" => "cs_logo_marginb",
            "min" => '-60',
            "max" => '200',
            "std" => "22",
            "type" => "range"
        );
        $cs_options[] = array("name" => __("Logo margin right", 'uoc'),
            "desc" => "",
            "hint_text" => __("Logo spacing margin from right.", 'uoc'),
            "id" => "cs_logo_marginr",
            "min" => '0',
            "max" => '200',
            "std" => "0",
            "type" => "range"
        );
        $cs_options[] = array("name" => __("Logo margin left", 'uoc'),
            "desc" => "",
            "hint_text" => __("Logo spacing margin from left", 'uoc'),
            "id" => "cs_logo_marginl",
            "min" => '-20',
            "max" => '200',
            "std" => "0",
            "type" => "range"
        );
        /* header element settings */

        $cs_options[] = array("name" => __("Header Elements", 'uoc'),
            "id" => "tab-header-options",
            "std" => __("Header Elements", 'uoc'),
            "type" => "section",
            "options" => ""
        );


        if (function_exists('is_woocommerce')) {
            $cs_options[] = array(
                "name" => __("Cart Count", 'uoc'),
                "desc" => "",
                "hint_text" => __("Enable/Disable Woocommerce Cart Count", 'uoc'),
                "id" => "cs_woocommerce_switch",
                "std" => "off",
                "type" => "checkbox",
                "options" => $on_off_option
            );
        }

        $cs_options[] = array("name" => __("Sticky Header On/Off", 'uoc'),
            "desc" => "",
            "id" => "cs_sitcky_header_switch",
            "hint_text" => __("If you enable this option , header will be fixed on top of your browser window.", 'uoc'),
            "std" => "",
            "type" => "checkbox",
            "options" => $on_off_option
        );

        $cs_options[] = array("name" => __("Sticky Logo", 'uoc'),
            "desc" => "",
            "hint_text" => __("Set sticky logo Image", 'uoc'),
            "id" => "cs_sticky_logo",
            "std" => get_template_directory_uri() . "/assets/images/logo1.png",
            "type" => "upload logo");

        $cs_options[] = array("name" => __("Header", 'uoc'),
            "id" => "tab-header-options",
            "std" => __("Header", 'uoc'),
            "type" => "section",
            "options" => ""
        );

        $cs_options[] = array("name" => __("Header Top Menu", 'uoc'),
            "desc" => "",
            "hint_text" => __("Enable/Disable header top strip", 'uoc'),
            "id" => "cs_header_menu_strip",
            "std" => "on",
            "type" => "checkbox",
            "options" => $on_off_option);

        $cs_options[] = array("name" => __("Header Top Search", 'uoc'),
            "desc" => "",
            "hint_text" => __("Header Top Search", 'uoc'),
            "id" => "cs_header_top_search",
            "std" => "on",
            "type" => "checkbox",
            "options" => $on_off_option);


        // start footer options    

        $cs_options[] = array("name" => __("footer options", 'uoc'),
            "id" => "tab-footer-options",
            "type" => "sub-heading"
        );
        $cs_options[] = array("name" => __("Footer section", 'uoc'),
            "desc" => "",
            "hint_text" => __("enable/disable footer area", 'uoc'),
            "id" => "cs_footer_switch",
            "std" => "on",
            "type" => "checkbox"
        );
        $cs_options[] = array("name" => __("Footer Widgets", 'uoc'),
            "desc" => "",
            "hint_text" => __("enable/disable footer widget area", 'uoc'),
            "id" => "cs_footer_widget",
            "std" => "on",
            "type" => "checkbox"
        );


        $cs_options[] = array("name" => __("Social Icons", 'uoc'),
            "desc" => "",
            "hint_text" => __("enable/disable Social Icons", 'uoc'),
            "id" => "cs_sub_footer_social_icons",
            "std" => "on",
            "type" => "checkbox");


        $cs_options[] = array("name" => __("Back to top", 'uoc'),
            "desc" => "",
            "hint_text" => __("enable/disable Back to top", 'uoc'),
            "id" => "cs_footer_back_to_top",
            "std" => "on",
            "type" => "checkbox");

        $cs_options[] = array("name" => __("Subscriber field", 'uoc'),
            "desc" => "",
            "hint_text" => __("enable/disable subscriber field", 'uoc'),
            "id" => "cs_footer_subscriber_field",
            "std" => "on",
            "type" => "checkbox");




        $cs_options[] = array("name" => __("Footer Logo", 'uoc'),
            "desc" => "",
            "hint_text" => __("Like footer logo or Credits Cards Images", 'uoc'),
            "id" => "cs_footer_logo",
            "std" => get_template_directory_uri() . "/assets/images/footer-log.png",
            "type" => "upload logo");



        $cs_options[] = array("name" => __("Footer Logo", 'uoc'),
            "desc" => "",
            "hint_text" => __("enable/disable footer logo", 'uoc'),
            "id" => "cs_footer_logo_on_off",
            "std" => "on",
            "type" => "checkbox");


        $cs_options[] = array("name" => __("Footer logo Link", 'uoc'),
            "desc" => "",
            "hint_text" => __("set custom footer logo link", 'uoc'),
            "id" => "cs_tripadvisor_logo_link",
            "std" => "",
            "type" => "text");

        $cs_options[] = array("name" => __("Copyright Text", 'uoc'),
            "desc" => "",
            "hint_text" => __("write your own copyright text", 'uoc'),
            "id" => "cs_copy_right",
            "std" => "&copy; 2014 Uoce Name All rights reserved.",
            "type" => "textarea"
        );
        $cs_options[] = array("name" => __("Footer Widgets", 'uoc'),
            "desc" => "",
            "hint_text" => __("Set footer widgets sidebar", 'uoc'),
            "id" => "cs_footer_widget_sidebar",
            "std" => "",
            "type" => "select_sidebar",
            "options" => $cs_sidebar,
        );
        // End footer tab setting
        /* general colors */
        $cs_options[] = array("name" => __("general colors", 'uoc'),
            "id" => "tab-general-color",
            "type" => "sub-heading"
        );
        $cs_options[] = array("name" => __("Theme Color", 'uoc'),
            "desc" => "",
            "hint_text" => __("Choose theme skin color", 'uoc'),
            "id" => "cs_theme_color",
            "std" => "#08387F",
            "type" => "color"
        );


        $cs_options[] = array("name" => __("Background Color", 'uoc'),
            "desc" => "",
            "hint_text" => __("Choose Body Background Color", 'uoc'),
            "id" => "cs_bg_color",
            "std" => "#d7dedc",
            "type" => "color"
        );

        $cs_options[] = array("name" => __("Body Text Color", 'uoc'),
            "desc" => "",
            "hint_text" => __("Choose text color", 'uoc'),
            "id" => "cs_text_color",
            "std" => "#555555",
            "type" => "color"
        );

        // start top strip tab options
        $cs_options[] = array("name" => __("header colors", 'uoc'),
            "id" => "tab-header-color",
            "type" => "sub-heading"
        );


        // start header color tab options
        $cs_options[] = array("name" => __("Header Colors", 'uoc'),
            "id" => "tab-header-color",
            "std" => __("Header Colors", 'uoc'),
            "type" => "section",
            "options" => ""
        );
        $cs_options[] = array("name" => __("Background Color", 'uoc'),
            "desc" => "",
            "hint_text" => __("Change Header background color", 'uoc'),
            "id" => "cs_header_bgcolor",
            "std" => "#ffffff",
            "type" => "color"
        );
        $cs_options[] = array("name" => __("Navigation Background Color", 'uoc'),
            "desc" => "",
            "hint_text" => __("Change Header Navigation Background color", 'uoc'),
            "id" => "cs_nav_bgcolor",
            "std" => "#08387f",
            "type" => "color"
        );



        $cs_options[] = array("name" => __("Menu Link color", 'uoc'),
            "desc" => "",
            "hint_text" => __("Change Header Menu Link color", 'uoc'),
            "id" => "cs_menu_color",
            "std" => "#ffffff",
            "type" => "color"
        );

        $cs_options[] = array("name" => __("Menu Active Link color", 'uoc'),
            "desc" => "",
            "hint_text" => __("Change Header Menu Active Link color", 'uoc'),
            "id" => "cs_menu_active_color",
            "std" => "#ffffff ",
            "type" => "color"
        );


        $cs_options[] = array("name" => __("Submenu Background", 'uoc'),
            "desc" => "",
            "hint_text" => __("Change Submenu Background color", 'uoc'),
            "id" => "cs_submenu_bgcolor",
            "std" => "#ffffff",
            "type" => "color",
        );

        $cs_options[] = array("name" => __("Submenu Link Color", 'uoc'),
            "desc" => "",
            "hint_text" => __("Change Submenu Link color", 'uoc'),
            "id" => "cs_submenu_color",
            "std" => "#000000",
            "type" => "color"
        );

        $cs_options[] = array("name" => __("Submenu Hover Link Color", 'uoc'),
            "desc" => "",
            "hint_text" => __("Change Submenu Hover Link color", 'uoc'),
            "id" => "cs_submenu_hover_color",
            "std" => "#ffffff",
            "type" => "color"
        );



        /* footer colors */
        $cs_options[] = array("name" => __("footer colors", 'uoc'),
            "id" => "tab-footer-color",
            "type" => "sub-heading"
        );
        $cs_options[] = array("name" => __("Footer Background Color", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_footerbg_color",
            "std" => "#ffffff",
            "type" => "color"
        );

        $cs_options[] = array("name" => __("Footer Title Color", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_title_color",
            "std" => "#111111",
            "type" => "color"
        );

        $cs_options[] = array("name" => __("Footer Text Color", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_footer_text_color",
            "std" => "#666666",
            "type" => "color"
        );

        $cs_options[] = array("name" => __("Footer Link Color", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_link_color",
            "std" => "#666666a",
            "type" => "color"
        );

        $cs_options[] = array("name" => __("Copyright Text", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_copyright_text_color",
            "std" => "#ffffff",
            "type" => "color"
        );

        $cs_options[] = array("name" => __("Copyright Background Color", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_copyright_bg_color",
            "std" => "#1f1f1f",
            "type" => "color"
        );
        /* heading colors */
        $cs_options[] = array("name" => __("heading colors", 'uoc'),
            "id" => "tab-heading-color",
            "type" => "sub-heading"
        );
        $cs_options[] = array("name" => __("heading h1", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_h1_color",
            "std" => "#111111",
            "type" => "color"
        );

        $cs_options[] = array("name" => __("heading h2", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_h2_color",
            "std" => "#111111",
            "type" => "color"
        );

        $cs_options[] = array("name" => __("heading h3", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_h3_color",
            "std" => "#111111",
            "type" => "color"
        );

        $cs_options[] = array("name" => __("heading h4", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_h4_color",
            "std" => "#111111",
            "type" => "color"
        );

        $cs_options[] = array("name" => __("heading h5", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_h5_color",
            "std" => "#111111",
            "type" => "color"
        );

        $cs_options[] = array("name" => __("heading h6", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_h6_color",
            "std" => "#111111",
            "type" => "color"
        );

        /* start custom font family */
        $cs_options[] = array("name" => __("Custom Font", 'uoc'),
            "id" => "tab-custom-font",
            "type" => "sub-heading"
        );

        $cs_options[] = array("name" => __("Custom Font .woff", 'uoc'),
            "desc" => "",
            "hint_text" => __("Custom font for your site upload .woff format file.", 'uoc'),
            "id" => "cs_custom_font_woff",
            "std" => "",
            "type" => "upload font"
        );

        $cs_options[] = array("name" => __("Custom Font .ttf", 'uoc'),
            "desc" => "",
            "hint_text" => __("Custom font for your site upload .ttf format file.", 'uoc'),
            "id" => "cs_custom_font_ttf",
            "std" => "",
            "type" => "upload font"
        );

        $cs_options[] = array("name" => __("Custom Font .svg", 'uoc'),
            "desc" => "",
            "hint_text" => __("Custom font for your site upload .svg format file.", 'uoc'),
            "id" => "cs_custom_font_svg",
            "std" => "",
            "type" => "upload font"
        );

        $cs_options[] = array("name" => __("Custom Font .eot", 'uoc'),
            "desc" => "",
            "hint_text" => __("Custom font for your site upload .eot format file.", 'uoc'),
            "id" => "cs_custom_font_eot",
            "std" => "",
            "type" => "upload font"
        );

        /* start font family */
        $cs_options[] = array("name" => __("font family", 'uoc'),
            "id" => "tab-font-family",
            "type" => "sub-heading"
        );
        $cs_options[] = array("name" => __("Content Font", 'uoc'),
            "desc" => "",
            "hint_text" => __("Set fonts for Body text", 'uoc'),
            "id" => "cs_content_font",
            "std" => "Oxygen",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $cs_options[] = array("name" => __("Content Font Attribute", 'uoc'),
            "desc" => "",
            "hint_text" => __("Set Font Attribute", 'uoc'),
            "id" => "cs_content_font_att",
            "std" => "regular",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $cs_options[] = array("name" => __("Main Menu Font", 'uoc'),
            "desc" => "",
            "hint_text" => __("Set font for main Menu. It will be applied to sub menu as well", 'uoc'),
            "id" => "cs_mainmenu_font",
            "std" => "Oxygen",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $cs_options[] = array("name" => __("Main Menu Font Attribute", 'uoc'),
            "desc" => "",
            "hint_text" => __("Set Font Attribute", 'uoc'),
            "id" => "cs_mainmenu_font_att",
            "std" => "regular",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $cs_options[] = array("name" => __("Headings Font", 'uoc'),
            "desc" => "",
            "hint_text" => __("Select font for Headings. It will apply on all posts and pages headings", 'uoc'),
            "id" => "cs_heading_font",
            "std" => "Source Sans Pro",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $cs_options[] = array("name" => __("Headings Font Attribute", 'uoc'),
            "desc" => "",
            "hint_text" => __("Set Font Attribute", 'uoc'),
            "id" => "cs_heading_font_att",
            "std" => "600",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $cs_options[] = array("name" => __("Widget Headings Font", 'uoc'),
            "desc" => "",
            "hint_text" => __("Set font for Widget Headings", 'uoc'),
            "id" => "cs_widget_heading_font",
            "std" => "Oxygen",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $cs_options[] = array("name" => __("Widget Headings Font Attribute", 'uoc'),
            "desc" => "",
            "hint_text" => __("Set Font Attribute", 'uoc'),
            "id" => "cs_widget_heading_font_att",
            "std" => "regular",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        /* start font size */
        $cs_options[] = array("name" => __("Font size", 'uoc'),
            "id" => "tab-font-size",
            "type" => "sub-heading"
        );

        $cs_options[] = array("name" => __("Content", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_content_size",
            "min" => '6',
            "max" => '50',
            "std" => "14",
            "type" => "range"
        );
        $cs_options[] = array("name" => __("Main Menu", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_mainmenu_size",
            "min" => '6',
            "max" => '50',
            "std" => "14",
            "type" => "range"
        );
        $cs_options[] = array("name" => __("Heading 1", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_1_size",
            "min" => '6',
            "max" => '50',
            "std" => "30",
            "type" => "range"
        );
        $cs_options[] = array("name" => __("Heading 2", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_2_size",
            "min" => '6',
            "max" => '50',
            "std" => "26",
            "type" => "range"
        );
        $cs_options[] = array("name" => __("Heading 3", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_3_size",
            "min" => '6',
            "max" => '50',
            "std" => "22",
            "type" => "range"
        );
        $cs_options[] = array("name" => __("Heading 4", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_4_size",
            "min" => '6',
            "max" => '50',
            "std" => "20",
            "type" => "range"
        );
        $cs_options[] = array("name" => __("Heading 5", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_5_size",
            "min" => '6',
            "max" => '50',
            "std" => "18",
            "type" => "range"
        );
        $cs_options[] = array("name" => __("Heading 6", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_6_size",
            "min" => '6',
            "max" => '50',
            "std" => "16",
            "type" => "range"
        );

        $cs_options[] = array("name" => __("Widget Heading", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_widget_heading_size",
            "min" => '6',
            "max" => '50',
            "std" => "16",
            "type" => "range"
        );
        $cs_options[] = array("name" => __("Section Heading", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_section_heading_size",
            "min" => '6',
            "max" => '50',
            "std" => "20",
            "type" => "range"
        );
        /* social icons setting */
        $cs_options[] = array("name" => __("social icons", 'uoc'),
            "id" => "tab-social-setting",
            "type" => "sub-heading"
        );
        $cs_options[] = array("name" => __("Social Network", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_social_network",
            "std" => "",
            "type" => "networks",
            "options" => $social_network
        );

        /* social Network setting */
        $cs_options[] = array("name" => __("social Sharing", 'uoc'),
            "id" => "tab-social-network",
            "type" => "sub-heading"
        );
        $cs_options[] = array("name" => __("Facebook", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_facebook_share",
            "std" => "on",
            "type" => "checkbox");

        $cs_options[] = array("name" => __("Twitter", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_twitter_share",
            "std" => "on",
            "type" => "checkbox");

        $cs_options[] = array("name" => __("Google Plus", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_google_plus_share",
            "std" => "off",
            "type" => "checkbox");
        $cs_options[] = array("name" => __("Tumblr", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_tumblr_share",
            "std" => "on",
            "type" => "checkbox");

        $cs_options[] = array("name" => __("Dribbble", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_dribbble_share",
            "std" => "on",
            "type" => "checkbox");

        $cs_options[] = array("name" => __("Instagram", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_instagram_share",
            "std" => "on",
            "type" => "checkbox");

        $cs_options[] = array("name" => __("StumbleUpon", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_stumbleupon_share",
            "std" => "on",
            "type" => "checkbox");

        $cs_options[] = array("name" => __("youtube", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_youtube_share",
            "std" => "on",
            "type" => "checkbox");

        $cs_options[] = array("name" => __("share more", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_share_share",
            "std" => "on",
            "type" => "checkbox");

        /* custom code setting */
        $cs_options[] = array("name" => __("custom code", 'uoc'),
            "id" => "tab-custom-code",
            "type" => "sub-heading"
        );
        $cs_options[] = array("name" => __("Custom Css", 'uoc'),
            "desc" => "",
            "hint_text" => __("write you custom css without style tag", 'uoc'),
            "id" => "cs_custom_style",
            "std" => "",
            "type" => "textarea"
        );

        $cs_options[] = array("name" => __("Custom JavaScript", 'uoc'),
            "desc" => "",
            "hint_text" => __("write you custom js without script tag", 'uoc'),
            "id" => "cs_custom_js",
            "std" => "",
            "type" => "textarea"
        );


        /* custom code setting */
        $cs_options[] = array("name" => __("Search Setting", 'uoc'),
            "id" => "tab-search-code",
            "type" => "sub-heading"
        );

        $cs_options[] = array("name" => __("Select Search Page", 'uoc'),
            "desc" => "",
            "hint_text" => __("Select search page from Dropdown", 'uoc'),
            "id" => "cs_custom_css",
            "std" => "",
            "type" => "select_dashboard"
        );




        //== Banner Fields
        $cs_options[] = array("name" => __("Ads Unit", 'uoc'),
            "id" => "banner-fields",
            "type" => "sub-heading"
        );
        $cs_options[] = array("name" => __("Ads Unit Settings", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_banner_fields",
            "std" => "",
            "type" => "banner_fields",
            "options" => $banner_fields
        );

        /* sidebar tab */
        $cs_options[] = array("name" => __("sidebar", 'uoc'),
            "id" => "tab-sidebar",
            "type" => "sub-heading"
        );
        $cs_options[] = array("name" => __("Sidebar", 'uoc'),
            "desc" => "",
            "hint_text" => __("Select a sidebar from the list already given. (Nine pre-made sidebars are given)", 'uoc'),
            "id" => "cs_sidebar",
            "std" => $sidebar,
            "type" => "sidebar",
            "options" => $sidebar
        );

        $cs_options[] = array("name" => __("post layout", 'uoc'),
            "id" => "cs_non_metapost_layout",
            "std" => __("single post layout", 'uoc'),
            "type" => "section",
            "options" => ""
        );
        $cs_options[] = array("name" => __("Single Post Layout", 'uoc'),
            "desc" => "",
            "hint_text" => __("Use this option to set default layout. It will be applied to all posts", 'uoc'),
            "id" => "cs_single_post_layout",
            "std" => "sidebar_right",
            "type" => "layout",
            "options" => array(
                "no_sidebar" => __("full width", 'uoc'),
                "sidebar_left" => __("sidebar left", 'uoc'),
                "sidebar_right" => __("sidebar right", 'uoc'),
            )
        );

        $cs_options[] = array("name" => __("Single Layout Sidebar", 'uoc'),
            "desc" => "",
            "hint_text" => __("Select Single Post Layout of your choice for sidebar layout. You cannot select it for full width layout", 'uoc'),
            "id" => "cs_single_layout_sidebar",
            "std" => "Blogs Sidebar",
            "type" => "select_sidebar",
            "options" => $cs_sidebar
        );

        $cs_options[] = array("name" => __("Single team", 'uoc'),
            "id" => "default_pages",
            "std" => __("Single team", 'uoc'),
            "type" => "section",
            "options" => ""
        );

        $cs_options[] = array("name" => __("Single Team Layout", 'uoc'),
            "desc" => "",
            "hint_text" => __("Use this option to set default layout. It will be applied to all posts", 'uoc'),
            "id" => "cs_single_team_layout",
            "std" => "sidebar_right",
            "type" => "layout",
            "options" => array(
                "no_sidebar" => __("full width", 'uoc'),
                "sidebar_right" => __("sidebar right", 'uoc'),
            )
        );

        $cs_options[] = array("name" => __("Single Layout Sidebar", 'uoc'),
            "desc" => "",
            "hint_text" => __("Select Single team Layout of your choice for sidebar layout. You cannot select it for full width layout", 'uoc'),
            "id" => "cs_team_layout_sidebar",
            "std" => "Blogs Sidebar",
            "type" => "select_sidebar",
            "options" => $cs_sidebar
        );

        $cs_options[] = array("name" => __("default pages", 'uoc'),
            "id" => "default_pages",
            "std" => __("Blogs Sidebar", 'uoc'),
            "type" => "section",
            "options" => ""
        );
        $cs_options[] = array("name" => __("Default Pages Layout", 'uoc'),
            "desc" => "",
            "hint_text" => __("Set Sidebar for all pages like Search, Author Archive, Category Archive etc", 'uoc'),
            "id" => "cs_default_page_layout",
            "std" => "sidebar_right",
            "type" => "layout",
            "options" => array(
                "sidebar_left" => __("sidebar left", 'uoc'),
                "sidebar_right" => __("sidebar right", 'uoc'),
                "no_sidebar" => __("full width", 'uoc'),
            )
        );
        $cs_options[] = array("name" => __("Title", 'uoc'),
            "desc" => "",
            "hint_text" => __("Turn Title On/Off for default pages.", 'uoc'),
            "id" => "cs_def_page_title",
            "std" => "off",
            "type" => "checkbox",
            "options" => $on_off_option
        );

        $cs_options[] = array("name" => __("Sidebar", 'uoc'),
            "desc" => "",
            "hint_text" => __("Select pre-made sidebars for default pages on sidebar layout. Full width layout cannot have sidebars", 'uoc'),
            "id" => "cs_default_layout_sidebar",
            "std" => "Blogs Sidebar",
            "type" => "select_sidebar",
            "options" => $cs_sidebar
        );
        $cs_options[] = array("name" => __("Excerpt", 'uoc'),
            "desc" => "",
            "hint_text" => __("Set excerpt length/limit from here. It controls text limit for post's content", 'uoc'),
            "id" => "cs_excerpt_length",
            "std" => "255",
            "type" => "text"
        );

        /* SEO */
        $cs_options[] = array("name" => __("Seo", 'uoc'),
            "id" => "tab-seo",
            "type" => "sub-heading"
        );
        $cs_options[] = array("name" => '<b>' . __("Attention for External Seo Plugins!", 'uoc') . '</b>',
            "id" => "header_postion_attention",
            "std" => '<strong>' . __("  If you are using any external Seo plugin, Turn Off these options.", 'uoc') . '</strong>',
            "type" => "announcement"
        );

        $cs_options[] = array("name" => __("Built-in Seo fields", 'uoc'),
            "desc" => "",
            "hint_text" => __("Turn Seo options On/Off", 'uoc'),
            "id" => "cs_builtin_seo_fields",
            "std" => "on",
            "type" => "checkbox");

        $cs_options[] = array("name" => __("Meta Description", 'uoc'),
            "desc" => "",
            "hint_text" => __("HTML attributes that explain the contents of web pages commonly used on search engine result pages (SERPs) for pages snippets", 'uoc'),
            "id" => "cs_meta_description",
            "std" => "",
            "type" => "text"
        );
        $cs_options[] = array("name" => __("Meta Style", 'uoc'),
            "desc" => "",
            "hint_text" => __("HTML attributes that explain the contents of web pages commonly used on search engine result pages (SERPs) for pages snippets", 'uoc'),
            "id" => "cs_meta_style",
            "std" => "",
            "type" => "text"
        );

        $cs_options[] = array("name" => __("Meta Keywords", 'uoc'),
            "desc" => "",
            "hint_text" => __("Attributes of meta tags, a list of comma-separated words included in the HTML of a Web page that describe the topic of that page", 'uoc'),
            "id" => "cs_meta_keywords",
            "std" => "",
            "type" => "text"
        );


        /* maintenance mode */
        $cs_options[] = array("name" => __("Maintenance Mode", 'uoc'),
            "fontawesome" => 'icon-tasks',
            "id" => "tab-maintenace-mode",
            "std" => "",
            "type" => "main-heading",
            "options" => ""
        );
        $cs_options[] = array("name" => __("Maintenance Mode", 'uoc'),
            "id" => "tab-maintenace-mode",
            "type" => "sub-heading"
        );
        $cs_options[] = array("name" => __("Maintenace Page", 'uoc'),
            "desc" => "",
            "hint_text" => __("Users will see Maintenance page & logged in Admin will see normal site.", 'uoc'),
            "id" => "cs_maintenance_page_switch",
            "std" => "off",
            "type" => "checkbox");

        $cs_options[] = array("name" => __("Show Logo", 'uoc'),
            "desc" => "",
            "hint_text" => __("Show/Hide logo on Maintenance. Logo can be uploaded from General > Header in CS Theme options.", 'uoc'),
            "id" => "cs_maintenance_logo_switch",
            "std" => "on",
            "type" => "checkbox");

        $cs_options[] = array("name" => __("Maintenance Page Logo", 'uoc'),
            "desc" => "",
            "hint_text" => __("Upload your maintenance page logo in .png .jpg .gif formats only", 'uoc'),
            "id" => "cs_maintenance_custom_logo",
            "std" => get_template_directory_uri() . "/assets/images/undr-logo.png",
            "type" => "upload logo"
        );


        $cs_options[] = array("name" => __("Maintenance Text", 'uoc'),
            "desc" => "",
            "hint_text" => __("Text for Maintenance page. Insert some basic HTML or use shortcodes here.", 'uoc'),
            "id" => "cs_maintenance_text",
            "std" => "<h1>Sorry, We are down for maintenance </h1><p>We're currently under maintenance, if all goas as planned we'll be back in</p>",
            "type" => "textarea"
        );

        $cs_options[] = array("name" => __("Launch Date", 'uoc'),
            "desc" => "",
            "hint_text" => __("Estimated date for completion of site on Maintenance page.", 'uoc'),
            "id" => "cs_launch_date",
            "std" => gmdate("dd/mm/yy"),
            "type" => "text"
        );


        /* api options tab */
        $cs_options[] = array("name" => __("Api settings", 'uoc'),
            "fontawesome" => 'icon-chain',
            "id" => "tab-api-options",
            "std" => "",
            "type" => "main-heading",
            "options" => ""
        );
        //Start Twitter Api    
        $cs_options[] = array("name" => __("All api settings", 'uoc'),
            "id" => "tab-api-options",
            "type" => "sub-heading"
        );

        $cs_options[] = array("name" => __("Attention for API Settings!", 'uoc'),
            "id" => "header_postion_attention",
            "std" => __("API Settings allows admin of the site to show their activity on site semi-automatically. Set your social account API once, it will be update your social activity automatically on your site.", 'uoc'),
            "type" => "announcement"
        );

        //start mailChimp api
        $cs_options[] = array("name" => __("Mail Chimp", 'uoc'),
            "id" => "mailchimp",
            "std" => __("Mail Chimp", 'uoc'),
            "type" => "section",
            "options" => ""
        );
        $cs_options[] = array("name" => __("Mail Chimp Key", 'uoc'),
            "desc" => __("Enter a valid Mail Chimp API key here to get started. Once you've done that, you can use the Mail Chimp Widget from the Widgets menu. You will need to have at least Mail Chimp list set up before the using the widget. You can get your mail chimp activation key", 'uoc'),
            "hint_text" => __("Get your mailchimp key by <a href='https://login.mailchimp.com/' target='_blank'>Clicking Here </a>", 'uoc'),
            "id" => "cs_mailchimp_key",
            "std" => "",
            "type" => "text"
        );

        $cs_options[] = array("name" => __("Mail Chimp List", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_mailchimp_list",
            "std" => "on",
            "type" => "mailchimp",
            "options" => $mail_chimp_list
        );
		/*
		
		google api
		*/
		
		
        //start mailChimp api
        $cs_options[] = array("name" => __("Google Api", 'uoc'),
            "id" => "googleapi",
            "std" => __("Google Api", 'uoc'),
            "type" => "section",
            "options" => ""
        );
        $cs_options[] = array("name" => __("Google Api Key", 'uoc'),
            "desc" => __("Enter a valid Google API key here to get started. ", 'uoc'),
            "hint_text" => '',
            "id" => "cs_google_key",
            "std" => "",
            "type" => "text"
        );

       
		
		
		
		
		
		
		
		
		/*
		google ends
		*/
        $cs_options[] = array("name" => __("Flickr API Setting", 'uoc'),
            "id" => "flickr_api_setting",
            "std" => __("Flickr API Setting", 'uoc'),
            "type" => "section",
            "options" => ""
        );
        $cs_options[] = array("name" => __("Flickr key", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "flickr_key",
            "std" => "",
            "type" => "text");
        $cs_options[] = array("name" => __("Flickr secret", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "flickr_secret",
            "std" => "",
            "type" => "text");
        $cs_options[] = array("name" => __("Twitter", 'uoc'),
            "id" => "Twitter",
            "std" => __("Twitter", 'uoc'),
            "type" => "section",
            "options" => ""
        );
        $cs_options[] = array("name" => __("Show Twitter", 'uoc'),
            "desc" => "",
            "hint_text" => __("Turn Twitter option On/Off", 'uoc'),
            "id" => "cs_twitter_api_switch",
            "std" => "on",
            "type" => "checkbox");
        $cs_options[] = array("name" => __("Cache Time Limit", 'dir'),
            "desc" => "",
            "hint_text" => "Please enter the time limit in minutes for refresh cache",
            "id" => "cs_cache_limit_time",
            "std" => "",
            "type" => "text");

        $cs_options[] = array("name" => __("Number of tweet", 'dir'),
            "desc" => "",
            "hint_text" => "Please enter number of tweet that you get from twitter for chache file.",
            "id" => "cs_tweet_num_post",
            "std" => "",
            "type" => "text");

        $cs_options[] = array("name" => __("Date Time Formate", 'dir'),
            "desc" => "",
            "hint_text" => __("Select date time formate for every tweet.", 'dir'),
            "id" => "cs_twitter_datetime_formate",
            "std" => "",
            "type" => "select_values",
            "options" => array(
                'default' => __('Displays November 06 2012', 'dir'),
                'eng_suff' => __('Displays 6th November', 'dir'),
                'ddmm' => __('Displays 06 Nov', 'dir'),
                'ddmmyy' => __('Displays 06 Nov 2012', 'dir'),
                'full_date' => __('Displays Tues 06 Nov 2012', 'dir'),
                'time_since' => __('Displays in hours, minutes etc', 'dir'),
            )
        );
        $cs_options[] = array("name" => __("Consumer Key", 'uoc'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_consumer_key",
            "std" => "",
            "type" => "text");

        $cs_options[] = array("name" => __("Consumer Secret", 'uoc'),
            "desc" => "",
            "hint_text" => __("Insert consumer key. To get your account key, <a href='https://dev.twitter.com/' target='_blank'>Click Here </a>", 'uoc'),
            "id" => "cs_consumer_secret",
            "std" => "",
            "type" => "text");

        $cs_options[] = array("name" => __("Access Token", 'uoc'),
            "desc" => "",
            "hint_text" => __("Insert Twitter Access Token for permissions. When you create your Twitter App, you get this Token", 'uoc'),
            "id" => "cs_access_token",
            "std" => "",
            "type" => "text");

        $cs_options[] = array("name" => __("Access Token Secret", 'uoc'),
            "desc" => "",
            "hint_text" => __("Insert Twitter Access Token Secret here. When you create your Twitter App, you get this Token", 'uoc'),
            "id" => "cs_access_token_secret",
            "std" => "",
            "type" => "text");
        //end Twitter Api
        #import and export theme options tab
        $cs_options[] = array("name" => __("import & export", 'uoc'),
            "fontawesome" => 'icon-database',
            "id" => "tab-import-export-options",
            "std" => "",
            "type" => "main-heading",
            "options" => ""
        );
        $cs_options[] = array("name" => __("import & export", 'uoc'),
            "id" => "tab-import-export-options",
            "type" => "sub-heading"
        );

        $cs_options[] = array("name" => __("Theme Backup Options", 'uoc'),
            "std" => __("Theme Backup Options", 'uoc'),
            "id" => "theme-bakups-options",
            "type" => "section"
        );
        $cs_options[] = array("name" => __("Backup", 'uoc'),
            "desc" => "",
            "hint_text" => __("", 'uoc'),
            "id" => "cs_backup_options",
            "std" => "",
            "type" => "generate_backup"
        );

        if (class_exists('cs_widget_data')) {

            $cs_options[] = array("name" => __("Widgets Backup Options", 'uoc'),
                "std" => __("Widgets Backup Options", 'uoc'),
                "id" => "widgets-bakups-options",
                "type" => "section"
            );

            $cs_options[] = array("name" => __("Widgets Backup", 'uoc'),
                "desc" => "",
                "hint_text" => '',
                "id" => "cs_widgets_backup",
                "std" => "",
                "type" => "widgets_backup"
            );
        }

        update_option('cs_theme_data', $cs_options);
    }

}

/**
 *
 *
 * Header Colors Setting
 */
function cs_header_setting() {
    global $cs_header_colors;
    $cs_header_colors = array();
    $cs_header_colors['header_colors'] = array(
        'header_1' => array(
            'color' => array(
                'cs_topstrip_bgcolor' => '#00799F',
                'cs_topstrip_text_color' => '#ffffff',
                'cs_topstrip_link_color' => '#ffffff',
                'cs_header_bgcolor' => '',
                'cs_nav_bgcolor' => '#00799F',
                'cs_menu_color' => '#ffffff',
                'cs_menu_active_color' => '#ffffff',
                'cs_submenu_bgcolor' => '#ffffff',
                'cs_submenu_color' => '#333333',
                'cs_submenu_hover_color' => '#00799F',
            ),
            'logo' => array(
                'cs_logo_with' => '210',
                'cs_logo_height' => '130',
                'cs_logo_margintb' => '0',
                'cs_logo_marginlr' => '0',
            )
        ),
    );
    return $cs_header_colors;
}
