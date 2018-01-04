<?php
/**
 * @Add Meta Box For Teams
 * @return
 *
 */
if (!class_exists('cs_team_meta')) {

    class cs_team_meta {

        public function __construct() {
            add_action('add_meta_boxes', array($this, 'cs_meta_team_add'));
            //add_action('wp_ajax_add_proc_to_list', array($this, 'add_proc_to_list'));
            
             add_action('wp_ajax_add_exp_to_list', array($this, 'add_exp_to_list'));
            add_action('wp_ajax_add_skill_to_list', array($this, 'add_skill_to_list'));
            add_action('wp_ajax_add_testimonial_to_list', array($this, 'add_testimonial_to_list'));
        }

        function cs_meta_team_add() {
            add_meta_box('cs_meta_team', __('Team Options', 'cs_frame'), array($this, 'cs_meta_team'), 'teams', 'normal', 'high');
        }

        function cs_meta_team($post) {
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
                                    <li><a href="javascript:;" name="#tab-teams-settings-cs-teams"><i class="icon-briefcase"></i><?php _e('Team Options', 'cs_frame'); ?></a></li>
                                </ul>
                            </nav>
                            <div id="tabbed-content">
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
                                <div id="tab-teams-settings-cs-teams">
            <?php $this->cs_post_team_fields(); ?>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <?php
        }

        /**
         * @Team Custom Fileds Function
         * @return
         *
         */
        function cs_post_team_fields() {
            global $post, $cs_theme_options, $page_option, $cs_form_meta;

            $cs_form_meta->cs_form_checkbox_render(
                    array('name' => __('Contact Us Switch', 'cs_frame'),
                        'id' => 'contact_tests',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );


            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Department', 'cs_frame'),
                        'id' => 'team_position',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );


            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Position', 'cs_frame'),
                        'id' => 'team_position_department',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Phone', 'cs_frame'),
                        'id' => 'team_phone',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );
            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Address', 'cs_frame'),
                        'id' => 'team_address',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );
            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Email', 'cs_frame'),
                        'id' => 'team_email',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Facebook', 'cs_frame'),
                        'id' => 'team_facebook',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );
            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Twitter', 'cs_frame'),
                        'id' => 'team_twitter',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );
            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Google Plus', 'cs_frame'),
                        'id' => 'team_google',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );
            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Linkedin', 'cs_frame'),
                        'id' => 'team_linkedin',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Job Specifications', 'cs_frame'),
                        'id' => 'team_specs_title',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $cs_form_meta->cs_form_checkbox_render(
                    array('name' => __('Job Specifications Switch', 'cs_frame'),
                        'id' => 'team_specs',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Sub Title', 'cs_frame'),
                        'id' => 'team_specs_subtitle',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );
            $cs_form_meta->cs_form_textarea_render(
                    array('name' => __('Description', 'cs_frame'),
                        'id' => 'team_specs_desc',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );


            $cs_form_meta->cs_form_textarea_list(
                    array('name' => __('List', 'cs_frame'),
                        'id' => 'team_specs_list',
                        'classes' => '',
                        'std' => '',
                        'description' => __('Press enter after entering a list item', 'cs_frame'),
                        'hint' => ''
                    )
            );


            $cs_form_meta->cs_heading_render(
                    array('name' => __('Experience and Expertise', 'cs_frame'),
                        'id' => 'expertise_section',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                    )
            );

            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Title', 'cs_frame'),
                        'id' => 'team_specs_experience',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $cs_form_meta->cs_form_checkbox_render(
                    array('name' => __('Experience Switch', 'cs_frame'),
                        'id' => 'team_experience_switch',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $this->cs_port_exp();

            $cs_form_meta->cs_heading_render(
                    array('name' => __('Skills', 'cs_frame'),
                        'id' => 'skil_area_section',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                    )
            );

            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Skills', 'cs_frame'),
                        'id' => 'team_exp_title',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $cs_form_meta->cs_form_checkbox_render(
                    array('name' => __('Skills Switch', 'cs_frame'),
                        'id' => 'team_exp',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );



            $this->cs_port_skills();


            $cs_form_meta->cs_heading_render(
                    array('name' => __('Testimonials', 'cs_frame'),
                        'id' => 'testimonials_section',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                    )
            );

            $cs_form_meta->cs_form_text_render(
                    array('name' => __('Testimonials', 'cs_frame'),
                        'id' => 'team_tests_title',
                        'classes' => '',
                        'std' => 'Testimonials',
                        'description' => '',
                        'hint' => ''
                    )
            );

            $cs_form_meta->cs_form_checkbox_render(
                    array('name' => __('Testimonials Switch', 'cs_frame'),
                        'id' => 'team_tests',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'hint' => ''
                    )
            );



            $this->cs_port_testimonials();
        }
        
 public function cs_port_exp() {

            global $post, $cs_form_meta;
            $cs_get_exp = get_post_meta($post->ID, 'cs_exp_array', true);
            $cs_exp_names = get_post_meta($post->ID, 'cs_exp_name_array', true);
            $cs_exp_descs = get_post_meta($post->ID, 'cs_exp_desc_array', true);

            $html = '
			<script>
				jQuery(document).ready(function($) {
					$("#total_exp").sortable({
						cancel : \'td div.table-form-elem\'
					});
				});
			</script>
			  <ul class="form-elements">
					<li class="to-button"><a href="javascript:_createpop(\'add_exp_title\',\'filter\')" class="button">' . __("Add Experience", "cs_frame") . '</a> </li>
			   </ul>
			  <div class="cs-list-table">
			  <table class="to-table" border="0" cellspacing="0">
				<thead>
				  <tr>
					<th style="width:100%;">' . __("Title", "cs_frame") . '</th>
					<th style="width:20%;" class="right">' . __("Actions", "cs_frame") . '</th>
				  </tr>
				</thead>
				<tbody id="total_exp">';
            if (isset($cs_get_exp) && is_array($cs_get_exp) && count($cs_get_exp) > 0) {
                $cs_exp_counter = 0;
                foreach ($cs_get_exp as $exp) {
                    if (isset($exp) && $exp <> '') {

                        $counter_exp = $exp_id = $exp;
                        $cs_exp_name = isset($cs_exp_names[$cs_exp_counter]) ? $cs_exp_names[$cs_exp_counter] : '';
                        $cs_exp_desc = isset($cs_exp_descs[$cs_exp_counter]) ? $cs_exp_descs[$cs_exp_counter] : '';

                        $cs_exp_array = array(
                            'counter_exp' => $counter_exp,
                            'exp_id' => $exp_id,
                            'cs_exp_name' => $cs_exp_name,
                            'cs_exp_desc' => $cs_exp_desc,
                        );

                        $html .= $this->add_exp_to_list($cs_exp_array);
                    }
                    $cs_exp_counter++;
                }
            }
            $html .= '
				</tbody>
			  </table>
			
			  </div>
			  <div id="add_exp_title" style="display: none;">
				<div class="cs-heading-area">
				  <h5><i class="icon-plus-circle"></i> ' . __('Experiences Setting', 'cs_frame') . '</h5>
				  <span class="cs-btnclose" onClick="javascript:removeoverlay(\'add_exp_title\',\'append\')"> <i class="icon-times"></i></span> 	
				</div>';
            $html .= $cs_form_meta->cs_form_text_render(
                    array('name' => __('Title', 'cs_frame'),
                        'id' => 'exp_name',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'return' => true,
                        'hint' => ''
                    )
            );

            $html .=$cs_form_meta->cs_form_textarea_render(
                    array('name' => __('Description', 'cs_frame'),
                        'id' => 'exp_desc',
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
					<input type="button" value="' . __("Add Experience", "cs_frame") . '" onClick="add_exp_list(\'' . esc_js(admin_url('admin-ajax.php')) . '\', \'' . esc_js(get_template_directory_uri()) . '\')" />
					<div class="feature-loader"></div>
				  </li>
				</ul>
			  </div>';

            echo force_balance_tags($html, true);
        }

        public function add_exp_to_list($cs_atts) {
            global $post, $cs_form_meta;

            $cs_defaults = array(
                'counter_exp' => '',
                'exp_id' => '',
                'cs_exp_name' => '',
                'cs_exp_desc' => '',
            );
            extract(shortcode_atts($cs_defaults, $cs_atts));

            foreach ($_POST as $keys => $values) {
                $$keys = $values;
            }

            if (isset($_POST['cs_exp_name']) && $_POST['cs_exp_name'] <> '')
                $cs_exp_name = $_POST['cs_exp_name'];
            if (isset($_POST['cs_exp_desc']) && $_POST['cs_exp_desc'] <> '')
                $cs_exp_desc = $_POST['cs_exp_desc'];

            if ($exp_id == '' && $counter_exp == '') {
                $counter_exp = $exp_id = time();
            }

            $html = '
				<tr class="parentdelete" id="edit_track' . absint($counter_exp) . '">
				  <td id="subject-title' . absint($counter_exp) . '" style="width:100%;">' . esc_attr($cs_exp_name) . '</td>
				  
				  <td class="centr" style="width:20%;"><a href="javascript:_createpop(\'edit_track_form' . absint($counter_exp) . '\',\'filter\')" class="actions edit">&nbsp;</a> <a href="#" class="delete-it btndeleteit actions delete">&nbsp;</a></td>
				  <td style="width:0"><div id="edit_track_form' . esc_attr($counter_exp) . '" style="display: none;" class="table-form-elem">
					<input type="hidden" name="cs_exp_array[]" value="' . absint($exp_id) . '" />
					  <div class="cs-heading-area">
						<h5 style="text-align: left;">' . __('Experiences Settings', 'cs_frame') . '</h5>
						<span onclick="javascript:removeoverlay(\'edit_track_form' . esc_js($counter_exp) . '\',\'append\')" class="cs-btnclose"> <i class="icon-times"></i></span>
						<div class="clear"></div>
					  </div>';
            $html .= $cs_form_meta->cs_form_text_render(
                    array('name' => __('Title', 'cs_frame'),
                        'id' => 'exp_name',
                        'classes' => '',
                        'std' => $cs_exp_name,
                        'description' => '',
                        'return' => true,
                        'array' => true,
                        'force_std' => true,
                        'hint' => ''
                    )
            );

            $html .= $cs_form_meta->cs_form_textarea_render(
                    array('name' => __('Description', 'cs_frame'),
                        'id' => 'exp_desc',
                        'classes' => '',
                        'std' => $cs_exp_desc,
                        'description' => '',
                        'return' => true,
                        'array' => true,
                        'force_std' => true,
                        'hint' => ''
                    )
            );

            $html .= '
					  <ul class="form-elements noborder">
						<li class="to-label">
						  <label></label>
						</li>
						<li class="to-field">
						  <input type="button" value="' . __('Update Experience', 'cs_frame') . '" onclick="removeoverlay(\'edit_track_form' . esc_js($counter_exp) . '\',\'append\')" />
						</li>
					  </ul>
					</div></td>
				</tr>';

            if (isset($_POST['cs_exp_name']) && isset($_POST['cs_exp_desc'])) {
                echo force_balance_tags($html);
            } else {
                return $html;
            }

            if (isset($_POST['cs_exp_name']) && isset($_POST['cs_exp_desc']))
                die();
        }


        public function cs_port_skills() {

            global $post, $cs_form_meta;
            $cs_get_skills = get_post_meta($post->ID, 'cs_skills_array', true);
            $cs_skill_names = get_post_meta($post->ID, 'cs_skill_name_array', true);
            $cs_skill_percs = get_post_meta($post->ID, 'cs_skill_perc_array', true);

            $html = '
			<script>
				jQuery(document).ready(function($) {
					$("#total_skills").sortable({
						cancel : \'td div.table-form-elem\'
					});
				});
			</script>
			  <ul class="form-elements">
					<li class="to-button"><a href="javascript:_createpop(\'add_skill_title\',\'filter\')" class="button">' . __("Add Skill", "cs_frame") . '</a> </li>
			   </ul>
			  <div class="cs-list-table">
			  <table class="to-table" border="0" cellspacing="0">
				<thead>
				  <tr>
					<th style="width:100%;">' . __("Title", "cs_frame") . '</th>
					<th style="width:20%;" class="right">' . __("Actions", "cs_frame") . '</th>
				  </tr>
				</thead>
				<tbody id="total_skills">';
            if (isset($cs_get_skills) && is_array($cs_get_skills) && count($cs_get_skills) > 0) {
                $cs_skill_counter = 0;
                foreach ($cs_get_skills as $skills) {
                    if (isset($skills) && $skills <> '') {

                        $counter_skill = $skill_id = $skills;
                        $cs_skill_name = isset($cs_skill_names[$cs_skill_counter]) ? $cs_skill_names[$cs_skill_counter] : '';
                        $cs_skill_perc = isset($cs_skill_percs[$cs_skill_counter]) ? $cs_skill_percs[$cs_skill_counter] : '';

                        $cs_skills_array = array(
                            'counter_skill' => $counter_skill,
                            'skill_id' => $skill_id,
                            'cs_skill_name' => $cs_skill_name,
                            'cs_skill_perc' => $cs_skill_perc,
                        );

                        $html .= $this->add_skill_to_list($cs_skills_array);
                    }
                    $cs_skill_counter++;
                }
            }
            $html .= '
				</tbody>
			  </table>
			
			  </div>
			  <div id="add_skill_title" style="display: none;">
				<div class="cs-heading-area">
				  <h5><i class="icon-plus-circle"></i> ' . __('Skills Setting', 'cs_frame') . '</h5>
				  <span class="cs-btnclose" onClick="javascript:removeoverlay(\'add_skill_title\',\'append\')"> <i class="icon-times"></i></span> 	
				</div>';
            $html .= $cs_form_meta->cs_form_text_render(
                    array('name' => __('Title', 'cs_frame'),
                        'id' => 'skill_name',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'return' => true,
                        'hint' => ''
                    )
            );

            $html .=$cs_form_meta->cs_form_text_render(
                    array('name' => __('Percentage', 'cs_frame'),
                        'id' => 'skill_perc',
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
					<input type="button" value="' . __("Add Skill", "cs_frame") . '" onClick="add_skill_list(\'' . esc_js(admin_url('admin-ajax.php')) . '\', \'' . esc_js(get_template_directory_uri()) . '\')" />
					<div class="feature-loader"></div>
				  </li>
				</ul>
			  </div>';

            echo force_balance_tags($html, true);
        }

        public function add_skill_to_list($cs_atts) {
            global $post, $cs_form_meta;

            $cs_defaults = array(
                'counter_skill' => '',
                'skill_id' => '',
                'cs_skill_name' => '',
                'cs_skill_perc' => '',
            );
            extract(shortcode_atts($cs_defaults, $cs_atts));

            foreach ($_POST as $keys => $values) {
                $$keys = $values;
            }

            if (isset($_POST['cs_skill_name']) && $_POST['cs_skill_name'] <> '')
                $cs_skill_name = $_POST['cs_skill_name'];
            if (isset($_POST['cs_skill_perc']) && $_POST['cs_skill_perc'] <> '')
                $cs_skill_perc = $_POST['cs_skill_perc'];

            if ($skill_id == '' && $counter_skill == '') {
                $counter_skill = $skill_id = time();
            }

            $html = '
				<tr class="parentdelete" id="edit_track' . absint($counter_skill) . '">
				  <td id="subject-title' . absint($counter_skill) . '" style="width:100%;">' . esc_attr($cs_skill_name) . '</td>
				  
				  <td class="centr" style="width:20%;"><a href="javascript:_createpop(\'edit_track_form' . absint($counter_skill) . '\',\'filter\')" class="actions edit">&nbsp;</a> <a href="#" class="delete-it btndeleteit actions delete">&nbsp;</a></td>
				  <td style="width:0"><div id="edit_track_form' . esc_attr($counter_skill) . '" style="display: none;" class="table-form-elem">
					<input type="hidden" name="cs_skills_array[]" value="' . absint($skill_id) . '" />
					  <div class="cs-heading-area">
						<h5 style="text-align: left;">' . __('Skills Settings', 'cs_frame') . '</h5>
						<span onclick="javascript:removeoverlay(\'edit_track_form' . esc_js($counter_skill) . '\',\'append\')" class="cs-btnclose"> <i class="icon-times"></i></span>
						<div class="clear"></div>
					  </div>';
            $html .= $cs_form_meta->cs_form_text_render(
                    array('name' => __('Title', 'cs_frame'),
                        'id' => 'skill_name',
                        'classes' => '',
                        'std' => $cs_skill_name,
                        'description' => '',
                        'return' => true,
                        'array' => true,
                        'force_std' => true,
                        'hint' => ''
                    )
            );

            $html .= $cs_form_meta->cs_form_text_render(
                    array('name' => __('Percentage', 'cs_frame'),
                        'id' => 'skill_perc',
                        'classes' => '',
                        'std' => $cs_skill_perc,
                        'description' => '',
                        'return' => true,
                        'array' => true,
                        'force_std' => true,
                        'hint' => ''
                    )
            );

            $html .= '
					  <ul class="form-elements noborder">
						<li class="to-label">
						  <label></label>
						</li>
						<li class="to-field">
						  <input type="button" value="' . __('Update Skill', 'cs_frame') . '" onclick="removeoverlay(\'edit_track_form' . esc_js($counter_skill) . '\',\'append\')" />
						</li>
					  </ul>
					</div></td>
				</tr>';

            if (isset($_POST['cs_skill_name']) && isset($_POST['cs_skill_perc'])) {
                echo force_balance_tags($html);
            } else {
                return $html;
            }

            if (isset($_POST['cs_skill_name']) && isset($_POST['cs_skill_perc']))
                die();
        }

        public function cs_port_testimonials() {

            global $post, $cs_form_meta;
            $cs_get_testimonials = get_post_meta($post->ID, 'cs_testimonials_array', true);
            $cs_testimonial_names = get_post_meta($post->ID, 'cs_testimonial_name_array', true);
            $cs_testimonial_poss = get_post_meta($post->ID, 'cs_testimonial_pos_array', true);
            $cs_testimonial_imgs = get_post_meta($post->ID, 'cs_testimonial_img_array', true);
            $cs_testimonial_descs = get_post_meta($post->ID, 'cs_testimonial_desc_array', true);

            $html = '
			<script>
				jQuery(document).ready(function($) {
					$("#total_testimonials").sortable({
						cancel : \'td div.table-form-elem\'
					});
				});
			</script>
			  <ul class="form-elements">
					<li class="to-button"><a href="javascript:_createpop(\'add_testimonial_title\',\'filter\')" class="button">' . __("Add Testimonial", "cs_frame") . '</a> </li>
			   </ul>
			  <div class="cs-list-table">
			  <table class="to-table" border="0" cellspacing="0">
				<thead>
				  <tr>
					<th style="width:100%;">' . __("Title", "cs_frame") . '</th>
					<th style="width:20%;" class="right">' . __("Actions", "cs_frame") . '</th>
				  </tr>
				</thead>
				<tbody id="total_testimonials">';
            if (isset($cs_get_testimonials) && is_array($cs_get_testimonials) && count($cs_get_testimonials) > 0) {
                $cs_testimonial_counter = 0;
                foreach ($cs_get_testimonials as $testimonials) {
                    if (isset($testimonials) && $testimonials <> '') {

                        $counter_testimonial = $testimonial_id = $testimonials;
                        $cs_testimonial_name = isset($cs_testimonial_names[$cs_testimonial_counter]) ? $cs_testimonial_names[$cs_testimonial_counter] : '';
                        $cs_testimonial_pos = isset($cs_testimonial_poss[$cs_testimonial_counter]) ? $cs_testimonial_poss[$cs_testimonial_counter] : '';
                        $cs_testimonial_img = isset($cs_testimonial_imgs[$cs_testimonial_counter]) ? $cs_testimonial_imgs[$cs_testimonial_counter] : '';
                        $cs_testimonial_desc = isset($cs_testimonial_descs[$cs_testimonial_counter]) ? $cs_testimonial_descs[$cs_testimonial_counter] : '';

                        $cs_testimonials_array = array(
                            'counter_testimonial' => $counter_testimonial,
                            'testimonial_id' => $testimonial_id,
                            'cs_testimonial_name' => $cs_testimonial_name,
                            'cs_testimonial_pos' => $cs_testimonial_pos,
                            'cs_testimonial_img' => $cs_testimonial_img,
                            'cs_testimonial_desc' => $cs_testimonial_desc,
                        );

                        $html .= $this->add_testimonial_to_list($cs_testimonials_array);
                    }
                    $cs_testimonial_counter++;
                }
            }
            $html .= '
				</tbody>
			  </table>
			
			  </div>
			  <div id="add_testimonial_title" style="display: none;">
				<div class="cs-heading-area">
				  <h5><i class="icon-plus-circle"></i> ' . __('Testimonials Setting', 'cs_frame') . '</h5>
				  <span class="cs-btnclose" onClick="javascript:removeoverlay(\'add_testimonial_title\',\'append\')"> <i class="icon-times"></i></span> 	
				</div>';
            $html .= $cs_form_meta->cs_form_text_render(
                    array('name' => __('Title', 'cs_frame'),
                        'id' => 'testimonial_name',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'return' => true,
                        'hint' => ''
                    )
            );

            $html .= $cs_form_meta->cs_form_text_render(
                    array('name' => __('Position', 'cs_frame'),
                        'id' => 'testimonial_pos',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'return' => true,
                        'hint' => ''
                    )
            );

            $html .= $cs_form_meta->cs_form_fileupload_render(
                    array('name' => __('Image', 'cs_frame'),
                        'id' => 'testimonial_img',
                        'classes' => '',
                        'std' => '',
                        'description' => '',
                        'return' => true,
                        'hint' => ''
                    )
            );

            $html .= $cs_form_meta->cs_form_textarea_render(
                    array('name' => __('Description', 'cs_frame'),
                        'id' => 'testimonial_desc',
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
					<input type="button" value="' . __("Add Testimonial", "cs_frame") . '" onClick="add_testimonial_list(\'' . esc_js(admin_url('admin-ajax.php')) . '\', \'' . esc_js(get_template_directory_uri()) . '\')" />
					<div class="feature-loader"></div>
				  </li>
				</ul>
			  </div>';

            echo force_balance_tags($html, true);
        }

        public function add_testimonial_to_list($cs_atts) {
            global $post, $cs_form_meta;

            $cs_defaults = array(
                'counter_testimonial' => '',
                'testimonial_id' => '',
                'cs_testimonial_name' => '',
                'cs_testimonial_pos' => '',
                'cs_testimonial_img' => '',
                'cs_testimonial_desc' => '',
            );
            extract(shortcode_atts($cs_defaults, $cs_atts));

            foreach ($_POST as $keys => $values) {
                $$keys = $values;
            }

            if (isset($_POST['cs_testimonial_name']) && $_POST['cs_testimonial_name'] <> '')
                $cs_testimonial_name = $_POST['cs_testimonial_name'];
            if (isset($_POST['cs_testimonial_pos']) && $_POST['cs_testimonial_pos'] <> '')
                $cs_testimonial_pos = $_POST['cs_testimonial_pos'];
            if (isset($_POST['cs_testimonial_img']) && $_POST['cs_testimonial_img'] <> '')
                $cs_testimonial_img = $_POST['cs_testimonial_img'];
            if (isset($_POST['cs_testimonial_desc']) && $_POST['cs_testimonial_desc'] <> '')
                $cs_testimonial_desc = $_POST['cs_testimonial_desc'];

            if ($testimonial_id == '' && $counter_testimonial == '') {
                $counter_testimonial = $testimonial_id = time();
            }

            $html = '
				<tr class="parentdelete" id="edit_track' . absint($counter_testimonial) . '">
				  <td id="subject-title' . absint($counter_testimonial) . '" style="width:100%;">' . esc_attr($cs_testimonial_name) . '</td>
				  
				  <td class="centr" style="width:20%;"><a href="javascript:_createpop(\'edit_track_form' . absint($counter_testimonial) . '\',\'filter\')" class="actions edit">&nbsp;</a> <a href="#" class="delete-it btndeleteit actions delete">&nbsp;</a></td>
				  <td style="width:0"><div id="edit_track_form' . esc_attr($counter_testimonial) . '" style="display: none;" class="table-form-elem">
					<input type="hidden" name="cs_testimonials_array[]" value="' . absint($testimonial_id) . '" />
					  <div class="cs-heading-area">
						<h5 style="text-align: left;">' . __('Testimonials Settings', 'cs_frame') . '</h5>
						<span onclick="javascript:removeoverlay(\'edit_track_form' . esc_js($counter_testimonial) . '\',\'append\')" class="cs-btnclose"> <i class="icon-times"></i></span>
						<div class="clear"></div>
					  </div>';
            $html .= $cs_form_meta->cs_form_text_render(
                    array('name' => __('Title', 'cs_frame'),
                        'id' => 'testimonial_name',
                        'classes' => '',
                        'std' => $cs_testimonial_name,
                        'description' => '',
                        'return' => true,
                        'array' => true,
                        'force_std' => true,
                        'hint' => ''
                    )
            );

            $html .= $cs_form_meta->cs_form_text_render(
                    array('name' => __('Position', 'cs_frame'),
                        'id' => 'testimonial_pos',
                        'classes' => '',
                        'std' => $cs_testimonial_pos,
                        'description' => '',
                        'return' => true,
                        'array' => true,
                        'force_std' => true,
                        'hint' => ''
                    )
            );

            $html .= $cs_form_meta->cs_form_fileupload_render(
                    array('name' => __('Image', 'cs_frame'),
                        'id' => 'testimonial_img',
                        'classes' => '',
                        'std' => $cs_testimonial_img,
                        'description' => '',
                        'return' => true,
                        'array' => true,
                        'force_std' => true,
                        'hint' => ''
                    )
            );

            $html .= $cs_form_meta->cs_form_textarea_render(
                    array('name' => __('Description', 'cs_frame'),
                        'id' => 'testimonial_desc',
                        'classes' => '',
                        'std' => $cs_testimonial_desc,
                        'description' => '',
                        'return' => true,
                        'array' => true,
                        'force_std' => true,
                        'hint' => ''
                    )
            );

            $html .= '
					  <ul class="form-elements noborder">
						<li class="to-label">
						  <label></label>
						</li>
						<li class="to-field">
						  <input type="button" value="' . __('Update Testimonial', 'cs_frame') . '" onclick="removeoverlay(\'edit_track_form' . esc_js($counter_testimonial) . '\',\'append\')" />
						</li>
					  </ul>
					</div></td>
				</tr>';

            if (isset($_POST['cs_testimonial_name']) && isset($_POST['cs_testimonial_desc'])) {
                echo force_balance_tags($html);
            } else {
                return $html;
            }

            if (isset($_POST['cs_testimonial_name']) && isset($_POST['cs_testimonial_desc']))
                die();
        }

    }

    return new cs_team_meta();
}
