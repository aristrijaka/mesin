<?php
/**
 * @Add Meta Box For Events
 * @return
 *
 */
if (!class_exists('cs_course_meta')) {

    class cs_course_meta {

        public function __construct() {
            add_action('add_meta_boxes', array($this, 'cs_meta_course_add'));
            add_action('wp_ajax_add_port_proc_to_list', array($this, 'add_port_proc_to_list'));
            add_action('create_course-category', array($this, 'cs_save_course_spec_fields'));
            add_action('edited_course-category', array($this, 'cs_save_course_spec_fields'));
            add_action('course-category_edit_form_fields', array($this, 'cs_edit_course_spec_fields'));
            add_action('course-category_add_form_fields', array($this, 'cs_course_spec_fields'));
        }

        function cs_meta_course_add() {
            add_meta_box('cs_meta_course', __('Course Options', 'cs_frame'), array($this, 'cs_meta_course'), 'course', 'normal', 'high');
        }

        function cs_meta_course($post) {
            global $post, $cs_theme_options, $page_option, $cs_form_meta;
            $cs_theme_options = get_option('cs_theme_options');
            $cs_builtin_seo_fields = isset($cs_theme_options['cs_builtin_seo_fields']) ? $cs_theme_options['cs_builtin_seo_fields'] : '';
            $cs_header_position = isset($cs_theme_options['cs_header_position']) ? $cs_theme_options['cs_header_position'] : '';
            ?>		
            <div class="page-wrap page-opts left" style="overflow:hidden; position:relative; height: 1432px;">
                <div class="option-sec" style="margin-bottom:0;">
                    <div class="opt-conts">
                        <div class="elementhidden">
                            <nav class="admin-navigtion">
                                <ul id="cs-options-tab">
                                    <li><a href="javascript:;" name="#tab-general-settings"><i class="icon-cog3"></i><?php _e('General', 'cs_frame'); ?></a></li>
                                    <?php
                                    if (function_exists('cs_header_postition_element') && function_exists('cs_seo_settitngs_element')) {
                                        if ($cs_header_position == 'absolute') {
                                            ?>
                                            <li><a href="javascript:;" name="#tab-header-position-settings"><i class="icon-forward"></i><?php _e('Header Absolute', 'cs_frame'); ?></a></li>
                                        <?php } ?>
                                        <?php if ($cs_builtin_seo_fields == 'on') { ?>
                                            <li><a href="javascript:;" name="#tab-seo-advance-settings"><i class="icon-dribbble"></i> <?php _e('Seo Options', 'cs_frame'); ?></a></li>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <li><a href="javascript:void(0);" name="#tab-course-settings-cs-course"><i class="icon-briefcase"></i><?php _e('Course Options', 'cs_frame'); ?></a></li>
                                </ul>
                            </nav>
                            <div id="tabbed-content">
                                <div id="tab-general-settings">
                                    <?php
                                    // $this->cs_course_general_settings();
                                    if (function_exists('cs_sidebar_layout_options')) {
                                        cs_sidebar_layout_options();
                                    }
                                    ?>
                                </div>
                                <?php
                                if (function_exists('cs_header_postition_element') && function_exists('cs_seo_settitngs_element')) {
                                    if ($cs_header_position == 'absolute') {
                                        ?>
                                        <div id="tab-header-position-settings">
                                            <?php cs_header_postition_element(); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($cs_builtin_seo_fields == 'on') { ?>
                                        <div id="tab-seo-advance-settings">
                                            <?php cs_seo_settitngs_element(); ?>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                                <div id="tab-course-settings-cs-course">
                                    <?php $this->cs_post_course_fields(); ?>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <?php
        }

        function cs_course_general_settings() {
            global $post, $cs_form_meta;
            $cs_form_meta->cs_form_checkbox_render(
                    array('name' => __('Social Sharing', 'cs_frame'),
                        'id' => 'post_social_sharing',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => '',
                    )
            );
            $cs_form_meta->cs_form_checkbox_render(
                    array('name' => __('Tags', 'cs_frame'),
                        'id' => 'post_tags_show',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => '',
                    )
            );
        }

        function cs_location_fields() {
            global $post, $cs_form_meta;

            if (function_exists('cs_enqueue_location_gmap_script')) {
                cs_enqueue_location_gmap_script();
            }

            $cs_form_meta->cs_form_checkbox_with_field_render(
                    array('name' => __('Location Map', 'cs_frame'),
                        'id' => 'map_switch',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => '',
                        'field' => array('field_name' => __('', 'cs_frame'),
                            'field_id' => 'map_heading',
                            'field_std' => __('Event Location', 'cs_frame'),
                        )
                    )
            );
            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Address', 'cs_frame'),
                        'id' => 'location_address',
                        'classes' => 'gllpSearchButton',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );
            $cs_form_meta->cs_form_text_render(
                    array('name' => __('City / Town', 'cs_frame'),
                        'id' => 'loc_city',
                        'classes' => 'gllpSearchButton',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );
            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Post Code', 'cs_frame'),
                        'id' => 'loc_postcode',
                        'classes' => 'gllpSearchButton',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );
            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Region', 'cs_frame'),
                        'id' => 'loc_region',
                        'classes' => 'gllpSearchButton',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );


            if (function_exists('cs_get_countries')) {
                foreach (cs_get_countries() as $key => $val):
                    $countries_list[$val] = $val;
                endforeach;
                $cs_form_meta->cs_form_select_render(
                        array('name' => __('Country', 'cs_frame'),
                            'id' => 'loc_country',
                            'classes' => 'gllpSearchButton',
                            'std' => '',
                            'onclick' => '',
                            'status' => '',
                            'description' => '',
                            'options' => $countries_list,
                        )
                );
            }

            $cs_form_meta->cs_location_map_render(
                    array('name' => __('Search This Location on Map', 'cs_frame'),
                        'id' => 'event_map',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );
        }

        /**
         * @Event Custom Fileds Function
         * @return
         *
         */
        function cs_post_course_fields() {
            global $post, $cs_theme_options, $page_option, $cs_form_meta;
            $course_repeat = get_post_meta($post->ID, 'cs_course_repeat', true);
            $course_all_day = get_post_meta($post->ID, 'cs_course_all_day', true);
            $all_day_status = 'show';
            if (isset($course_all_day) && $course_all_day == 'on') {
                $all_day_status = 'hide';
            }
            $cs_repeat_time = 'hide';

            if (isset($course_repeat) && $course_repeat != '0' && $course_repeat != '') {
                $cs_repeat_time = 'show';
            }

            $cs_repeated = 'no';

            if (isset($_GET['post']) && $_GET['post'] != '') {
                $cs_repeated = 'yes';
            }

            cs_framework::cs_enqueue_timepicker_script();
            ?>
            <script>

                jQuery(function () {
                    jQuery('#cs_course_start_time').datetimepicker({
                        datepicker: false,
                        format: 'H:i',
                        formatTime: 'H:i',
                        step: 30,
                        onShow: function (at) {
                            this.setOptions({
                                maxTime: jQuery('#cs_course_end_time').val() ? jQuery('#cs_course_end_time').val() : false
                            })
                        }
                    });
                    jQuery('#cs_course_end_time').datetimepicker({
                        datepicker: false,
                        format: 'H:i',
                        formatTime: 'H:i',
                        step: 30,
                        onShow: function (at) {
                            this.setOptions({
                                minTime: jQuery('#cs_course_start_time').val() ? jQuery('#cs_course_start_time').val() : false
                            })
                        }
                    });

                    jQuery('#cs_course_from_date').datetimepicker({
                        format: 'd-m-y',
                        timepicker: false,
                        onSelectDate: function (selectedDate) {
                            jQuery("#cs_course_to_date").datetimepicker({minDate: selectedDate});
                        }
                    });
                    jQuery('#cs_course_to_date').datetimepicker({
                        format: 'd-m-y',
                        timepicker: false,
                        onSelectDate: function (selectedDate) {
                            jQuery("#cs_course_from_date").datetimepicker({maxDate: selectedDate});
                        }
                    });


                    jQuery('.is_course_allday').change(function () {
                        var checkbox = jQuery('.is_course_allday');
                        if (checkbox.attr('checked') == 'checked') {
                            jQuery("#wrapper_allday_course_wrap").hide();
                        } else {
                            jQuery("#wrapper_allday_course_wrap").show();
                        }
                    });

                });
            </script>


            <?php
            $cs_form_meta->cs_heading_render(
                    array('name' => __('Course Schedule', 'cs_frame'),
                        'id' => 'course_Schedule_wrap',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                    )
            );

            $cs_form_meta->cs_form_date_render(
                    array('name' => __('Course Start Date', 'cs_frame'),
                        'id' => 'course_from_date',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );
            $cs_form_meta->cs_form_date_render(
                    array('name' => __('Course End Date', 'cs_frame'),
                        'id' => 'course_to_date',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $cs_form_meta->cs_wrapper_start_render(
                    array('name' => __('Wrapper', 'cs_frame'),
                        'id' => 'allday_course_wrap',
                        'status' => $all_day_status,
                    )
            );
            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Course Start Time', 'cs_frame'),
                        'id' => 'course_start_time',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Course End Time', 'cs_frame'),
                        'id' => 'course_end_time',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $cs_form_meta->cs_heading_render(
                    array('name' => __('Course Descriptions', 'cs_frame'),
                        'id' => 'course_descriptions_wrap',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                    )
            );

            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Course Duration', 'cs_frame'),
                        'id' => 'course_duration_period',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );
            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Course Code', 'cs_frame'),
                        'id' => 'course_code',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );


            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Degree Level', 'cs_frame'),
                        'id' => 'degree_levels',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $cs_form_meta->cs_form_color_render(
                    array('name' => __('Degree Level Background Color', 'cs_frame'),
                        'id' => 'degree_level_bg_color',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );


            // get all Instrcutor Users
            $args = array('role' => 'Instructor');
            $user_information = array();
            $user_information[''] = __('Select Instructor', 'cs_frame');
            $user_query = new WP_User_Query($args);
            if (!empty($user_query->results)) {
                foreach ($user_query->results as $user) {
                    $user_information[$user->ID] = $user->display_name;
                }
            }
            $cs_form_meta->cs_form_select_render(
                    array('name' => __('Instructors', 'cs_frame'),
                        'id' => 'user_instructors',
                        'classes' => '',
                        'std' => '',
                        'status' => '',
                        'description' => '',
                        'options' => $user_information
                    )
            );

            $campus_data = array();
            $campus_data[''] = __('Select Campus', 'cs_frame');
            $cs_args = array('posts_per_page' => "-1", 'post_type' => 'campus', 'post_status' => 'publish', 'order' => 'DESC');
            $custom_query = get_posts($cs_args);
            foreach ($custom_query as $campus) {
                $campus_data[$campus->ID] = $campus->post_title;
            }


            $cs_form_meta->cs_form_select_render(
                    array('name' => __('Campus', 'cs_frame'),
                        'id' => 'course_campus_id',
                        'classes' => '',
                        'std' => '',
                        'status' => '',
                        'description' => '',
                        'options' => $campus_data
                    )
            );


            $cs_form_meta->cs_heading_render(
                    array('name' => __('Price Option', 'cs_frame'),
                        'id' => 'course_options_wrap',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                    )
            );
            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Title', 'cs_frame'),
                        'id' => 'price_title',
                        'classes' => '',
                        'std' => __('Apply Now ', 'cs_frame'),
                        'description' => '',
                        'hint' => ''
                    )
            );
            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Url', 'cs_frame'),
                        'id' => 'buy_url',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );
            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Course Price', 'cs_frame'),
                        'id' => 'course_price',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );


            /*             * ************************************* */

            $cs_form_meta->cs_heading_render(
                    array('name' => __('Tabs Shortcode', 'cs_frame'),
                        'id' => 'tabs_options_wrap',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                    )
            );

            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Title', 'cs_frame'),
                        'id' => 'tabs_title',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $cs_form_meta->cs_form_textarea_render(
                    array('name' => __('Add Tab Shortcode', 'cs_frame'),
                        'id' => 'tab_option_shortcode',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );
            /*             * ************************************* */
            $cs_form_meta->cs_heading_render(
                    array('name' => __('Team Slider Title', 'cs_frame'),
                        'id' => 'ticket_options_wrap',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                    )
            );
            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Title', 'cs_frame'),
                        'id' => 'team_shortcode_title',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $team_data = array();
            $cs_args = array('posts_per_page' => "-1", 'post_type' => 'teams', 'post_status' => 'publish', 'order' => 'DESC');
            $custom_query = get_posts($cs_args);
            foreach ($custom_query as $team) {
                $team_data[$team->ID] = $team->post_title;
            }


            $cs_form_meta->cs_form_multiselect_render(
                    array('name' => __('Team', 'cs_frame'),
                        'id' => 'course_team_ids',
                        'classes' => '',
                        'std' => '',
                        'status' => '',
                        'description' => '',
                        'options' => $team_data
                    )
            );


            $cs_form_meta->cs_heading_render(
                    array('name' => __('Attachments', 'cs_frame'),
                        'id' => 'gallery_section',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                    )
            );

            $cs_form_meta->cs_form_checkbox_render(
                    array('name' => __('Attachments', 'cs_frame'),
                        'id' => 'port_gallery',
                        'field_id' => 'port_gallery_title',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => '',
                    )
            );

            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Title', 'cs_frame'),
                        'id' => 'attachments_title',
                        'classes' => '',
                        'std' => 'Title',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $cs_form_meta->cs_gallery_render(
                    array('name' => __('Attachments', 'cs_frame'),
                        'id' => 'port_list_gallery',
                        'classes' => '',
                        'std' => 'gallery_meta_form',
                    )
            );

            $cs_form_meta->cs_heading_render(
                    array('name' => __('Course Features', 'cs_frame'),
                        'id' => '',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                    )
            );

            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Title', 'cs_frame'),
                        'id' => 'port_proc_title',
                        'classes' => '',
                        'std' => __('Course Feature', 'cs_frame'),
                        'description' => '',
                        'hint' => ''
                    )
            );

            $this->cs_port_proc_list();
        }

        public function cs_port_proc_list() {

            global $post, $cs_form_fields, $cs_theme_options, $page_option, $cs_form_meta;
            $cs_get_proc_list = get_post_meta($post->ID, 'cs_proc_list_array', true);
            $cs_proc_names = get_post_meta($post->ID, 'cs_proc_name_array', true);
            $cs_proc_descs = get_post_meta($post->ID, 'cs_proc_description_array', true);
            $cs_proc_icons = get_post_meta($post->ID, 'cs_proc_icon_array', true);


            $html = '
			<script>
				jQuery(document).ready(function($) {
					$("#total_proc_list").sortable({
						cancel : \'td div.table-form-elem\'
					});
				});
			</script>
			  <ul class="form-elements">
					<li class="to-button"><a href="javascript:_createpop(\'add_proc_title\',\'filter\')" class="button">' . __("Add Course Feature", "cs_frame") . '</a> </li>
			   </ul>
			  <div class="cs-list-table">
			  <table class="to-table" border="0" cellspacing="0">
				<thead>
				  <tr>
					<th style="width:100%;">' . __("Title", "cs_frame") . '</th>
					<th style="width:20%;" class="right">' . __("Actions", "cs_frame") . '</th>
				  </tr>
				</thead>
				<tbody id="total_proc_list">';
            if (isset($cs_get_proc_list) && is_array($cs_get_proc_list) && count($cs_get_proc_list) > 0) {
                $cs_proc_counter = 0;
                foreach ($cs_get_proc_list as $proc_list) {
                    if (isset($proc_list) && $proc_list <> '') {

                        $counter_extra_feature = $extra_feature_id = $proc_list;
                        $cs_proc_name = isset($cs_proc_names[$cs_proc_counter]) ? $cs_proc_names[$cs_proc_counter] : '';
                        $cs_proc_description = isset($cs_proc_descs[$cs_proc_counter]) ? $cs_proc_descs[$cs_proc_counter] : '';
                        $cs_proc_icon = isset($cs_proc_icons[$cs_proc_counter]) ? $cs_proc_icons[$cs_proc_counter] : '';


                        $ca_awards_array = array(
                            'counter_extra_feature' => $counter_extra_feature,
                            'extra_feature_id' => $extra_feature_id,
                            'cs_proc_name' => $cs_proc_name,
                            'cs_proc_description' => $cs_proc_description,
                            'cs_proc_icon' => $cs_proc_icon,
                        );

                        $html .= $this->add_port_proc_to_list($ca_awards_array);
                    }
                    $cs_proc_counter++;
                }
            }
            $html .= '
				</tbody>
			  </table>
			  </div>
			  <div id="add_proc_title" style="display: none;">
				<div class="cs-heading-area">
				  <h5><i class="icon-plus-circle"></i> ' . __('Course Feature Setting', 'cs_frame') . '</h5>
				  <span class="cs-btnclose" onClick="javascript:removeoverlay(\'add_proc_title\',\'append\')"> <i class="icon-times"></i></span> 	
				</div>';
            $html .= $cs_form_meta->cs_form_text_render(
                    array(
                        'name' => __('Title', 'cs_frame'),
                        'id' => 'proc_name',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'return' => true,
                        'hint' => ''
                    )
            );

            $html .=$cs_form_meta->cs_form_textarea_render(
                    array(
                        'name' => __('Description', 'cs_frame'),
                        'id' => 'proc_description',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'return' => true,
                        'hint' => ''
                    )
            );
            // for font awesome	
            $html .= $cs_form_meta->cs_form_icon_render(
                    array(
                        'name' => __('Select icon', 'cs_frame'),
                        'id' => 'proc_icon',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'return' => true,
                        'hint' => ''
                    )
            );


            $html .= '
				<ul class="form-elements noborder">
				  <li class="to-label"></li>
				  <li class="to-field">
					<input type="button" value="' . __('Add Course Feature', 'cs_frame') . '" 
					 onClick="add_proc_to_list(\'' . esc_js(admin_url('admin-ajax.php')) . '\', \'' . esc_js(get_template_directory_uri()) . '\')" />
					<div class="feature-loader"></div>
				  </li>
				</ul>
			  </div>';
            echo force_balance_tags($html, true);
        }

        function add_port_proc_to_list($cs_atts) {
            global $post, $cs_form_fields, $cs_form_meta;

            $cs_defaults = array(
                'counter_extra_feature' => '',
                'extra_feature_id' => '',
                'cs_proc_name' => '',
                'cs_proc_description' => '',
                'cs_proc_icon' => '',
            );
            extract(shortcode_atts($cs_defaults, $cs_atts));

            foreach ($_POST as $keys => $values) {
                $$keys = $values;
            }

            if (isset($_POST['cs_proc_name']) && $_POST['cs_proc_name'] <> '')
                $cs_proc_name = $_POST['cs_proc_name'];
            if (isset($_POST['cs_proc_description']) && $_POST['cs_proc_description'] <> '')
                $cs_proc_description = $_POST['cs_proc_description'];
            if (isset($_POST['cs_proc_icon']) && $_POST['cs_proc_icon'] <> '')
                $cs_proc_icon = $_POST['cs_proc_icon'];
            if ($extra_feature_id == '' && $counter_extra_feature == '') {
                $counter_extra_feature = $extra_feature_id = time();
            }

            $html = '
				<tr class="parentdelete" id="edit_track' . absint($counter_extra_feature) . '">
				  <td id="subject-title' . absint($counter_extra_feature) . '" style="width:100%;">' . esc_attr($cs_proc_name) . '</td>
				  
				  <td class="centr" style="width:20%;"><a href="javascript:_createpop(\'edit_track_form' . absint($counter_extra_feature) . '\',\'filter\')" class="actions edit">&nbsp;</a> <a href="#" class="delete-it btndeleteit actions delete">&nbsp;</a></td>
				  <td style="width:0"><div id="edit_track_form' . esc_attr($counter_extra_feature) . '" style="display: none;" class="table-form-elem">
					<input type="hidden" name="cs_proc_list_array[]" value="' . absint($extra_feature_id) . '" />
					  <div class="cs-heading-area">
						<h5 style="text-align: left;">' . __('Course Feature Settings', 'cs_frame') . '</h5>
						<span onclick="javascript:removeoverlay(\'edit_track_form' . esc_js($counter_extra_feature) . '\',\'append\')" class="cs-btnclose"> <i class="icon-times"></i></span>
						<div class="clear"></div>
					  </div>';
            $html .= $cs_form_meta->cs_form_text_render(
                    array('name' => __('Title', 'cs_frame'),
                        'id' => 'proc_name',
                        'classes' => '',
                        'std' => $cs_proc_name,
                        'description' => '',
                        'return' => true,
                        'array' => true,
                        'force_std' => true,
                        'hint' => ''
                    )
            );

            $html .= $cs_form_meta->cs_form_textarea_render(
                    array('name' => __('Description', 'cs_frame'),
                        'id' => 'proc_description',
                        'classes' => '',
                        'std' => $cs_proc_description,
                        'description' => '',
                        'return' => true,
                        'array' => true,
                        'force_std' => true,
                        'hint' => ''
                    )
            );

            $html .= $cs_form_meta->cs_form_icon_render(
                    array('name' => __('Select icon', 'cs_frame'),
                        'id' => 'proc_icon',
                        'classes' => '',
                        'std' => $cs_proc_icon,
                        'description' => '',
                        'return' => true,
                        'array' => true,
                        'force_std' => true,
                        'hint' => ''
                    )
            );

            $html .= '<ul class="form-elements noborder">
                                      <li class="to-label">
                                        <label></label>
                                      </li>
                                      <li class="to-field">
                                        <input type="button" 
                                        value="' . __('Update Course Feature', 'cs_frame') . '" 
                                        onclick="removeoverlay(\'edit_track_form' . esc_js($counter_extra_feature) . '\',\'append\')" />
                                      </li>
                                </ul>
                              </div></td>
                      </tr>';

            // if ( isset($_POST['cs_proc_name']) && isset($_POST['cs_proc_description'] ) && isset($_POST['cs_proc_icon'] ) ) {
            if (isset($_POST['cs_proc_name']) && isset($_POST['cs_proc_description']) && isset($_POST['cs_proc_icon'])) {
                echo force_balance_tags($html);
            } else {
                return $html;
            }

            // if ( isset($_POST['cs_proc_name']) && isset($_POST['cs_proc_description'])) die();
            if (isset($_POST['cs_proc_name']) && isset($_POST['cs_proc_description']) && isset($_POST['cs_proc_icon']))
                die();
        }

        // Add Category Fields
        public function cs_course_spec_fields($tag) {    //check for existing featured ID
            if (isset($tag->term_id)) {
                $t_id = $tag->term_id;
            } else {
                $t_id = "";
            }
            $spec_color = '';
            ?>

            <div class="form-field">
                <ul class="form-elements" style="margin:0; padding:0;">
                    <li class="to-label">
                        <label><?php _e('Choose Color', 'cs_frame') ?></label>
                    </li>
                    <li class="to-field">
                        <input type="text" name="spec_color" class="bg_color" value="" />
                    </li>
                </ul>
            </div>
            <input type="hidden" name="spec_ext_meta" value="1" />
            <?php
        }

        // Edit Category Fields
        public function cs_edit_course_spec_fields($tag) {    //check for existing featured ID
            if (isset($tag->term_id)) {
                $t_id = $tag->term_id;
            } else {
                $t_id = "";
            }
            $cs_counter = $tag->term_id;
            $cat_meta = get_option("spec_ext_$t_id");
            $spec_color = isset($cat_meta['color']) ? $cat_meta['color'] : '';
            ?>
            <tr>
                <th><label><?php _e('Choose Color', 'cs_frame') ?></label></th>
                <td>
                    <input type="text" name="spec_color" class="bg_color" value="<?php echo esc_attr($spec_color) ?>" />
                </td>
            </tr>
            <input type="hidden" name="spec_ext_meta" value="1" />
            <?php
        }

        // save extra category extra fields callback function
        public function cs_save_course_spec_fields($term_id) {
            if (isset($_POST['spec_ext_meta']) and $_POST['spec_ext_meta'] == '1') {
                $t_id = $term_id;
                get_option("spec_ext_$t_id");
                $spec_ext_color = '';
                if (isset($_POST['spec_color'])) {
                    $spec_ext_color = $_POST['spec_color'];
                }
                $cat_meta = array(
                    'color' => $spec_ext_color,
                );

                //save the option array

                update_option("spec_ext_$t_id", $cat_meta);
            }
        }

    }

    return new cs_course_meta();
}  


