<?php
/**
 * File Type: Events Page Builder Element
 */
if (!function_exists('cs_pb_course')) {

    function cs_pb_course($die = 0) {
        global $cs_node, $post;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $counter = $_POST['counter'];
        $cs_counter = $_POST['counter'];
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $PREFIX = 'cs_course';
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array('column_size' => '1/1', 'section_title' => '', 'view' => '', 'category' => '', 'post_order' => 'DESC', 'course_type' => '', 'orderby' => 'ID', 'course_excerpt' => '255', 'pagination' => '10', 'filterable' => '', 'display_pagination' => '');
        if (isset($output['0']['atts']))
            $atts = $output['0']['atts'];
        else
            $atts = array();
        $course_element_size = '50';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key]))
                $$key = $atts[$key];
            else
                $$key = $values;
        }
        $name = 'cs_pb_course';
        $coloumn_class = 'column_' . $course_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter); ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="events" data="<?php echo element_size_data_array_index($course_element_size) ?>">
        <?php cs_element_setting($name, $cs_counter, $course_element_size); ?>
            <div class="cs-wrapp-class-<?php echo intval($cs_counter); ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter); ?>" data-shortcode-template="[cs_course {{attributes}}]"  style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php _e('Edit Course Options', 'cs_frame') ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_attr($name . $cs_counter) ?>','<?php echo esc_attr($filter_element); ?>')" class="cs-btnclose"><i class="fa fa-times"></i></a> </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp">
                        <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                            cs_shortcode_element_size();
                        } ?>
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Section Title', 'cs_frame') ?></label></li>
                            <li class="to-field">
                                <input  name="section_title[]" type="text"  value="<?php echo esc_attr($section_title); ?>"   />
                            </li>                  
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Course Design Views', 'cs_frame') ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <div class="select-style">
                                        <select name="view[]" class="dropdown">
                                            <option value="course-simple" <?php if ($view == 'course-simple') {
                            echo 'selected="selected"';
                        } ?>><?php _e('Simple', 'cs_frame') ?></option>
                                            <option value="course-classic" <?php if ($view == 'course-classic') {
                            echo 'selected="selected"';
                        } ?>><?php _e('Classic', 'cs_frame') ?></option>
                                            <option value="course-modern" <?php if ($view == 'course-modern') {
                            echo 'selected="selected"';
                        } ?>><?php _e('Modern', 'cs_frame') ?></option>
                                        </select>

                                    </div>
                                </div>
                                <div class="left-info">
                                    <p><?php _e('Please select category to show posts. If you dont select category it will display all posts', 'cs_frame') ?></p>
                                </div>
                            </li>
                        </ul>


                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Choose Category', 'cs_frame') ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <div class="select-style">
                                        <select name="category[]" class="dropdown">
                                            <option value="0"><?php _e('--Select Category--', 'cs_frame') ?></option>
        <?php show_all_cats('', '', $category, "course-category"); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="left-info">
                                    <p><?php _e('Please select category to show posts. If you dont select category it will display all posts', 'cs_frame') ?></p>
                                </div>
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Post Order', 'cs_frame') ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <div class="select-style">
                                        <select name="post_order[]" class="dropdown" >
                                            <option <?php if ($post_order == "ASC") echo "selected"; ?> value="ASC"><?php _e('Asc', 'cs_frame') ?></option>
                                            <option <?php if ($post_order == "DESC") echo "selected"; ?> value="DESC"><?php _e('DESC', 'cs_frame') ?></option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Display Pagination', 'cs_frame') ?> </label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <div class="select-style">
                                        <select class="dropdown" name="display_pagination[]">
                                            <option <?php if ($display_pagination == "Yes") echo "selected"; ?> value="Yes"><?php _e('Yes', 'cs_frame') ?></option>
                                            <option <?php if ($display_pagination == "No") echo "selected"; ?> value="No"> <?php _e('No', 'cs_frame') ?></option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Length of Excerpt', 'cs_frame') ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <input type="text" name="course_excerpt[]" class="txtfield" value="<?php echo intval($course_excerpt); ?>" />
                                </div>
                                <div class="left-info">
                                    <p><?php _e('Enter number of character for short description text, excerpt length will work only in list view.', 'cs_frame') ?></p>
                                </div>
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('No. of Post Per Page', 'cs_frame') ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <input type="text" name="pagination[]" class="txtfield" value="<?php echo intval($pagination); ?>" />
                                </div>
                                <div class="left-info">
                                    <p><?php _e('To display all the records, leave this field blank', 'cs_frame') ?></p>
                                </div>
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Filterable', 'cs_frame') ?></label>
                            </li>
                            <li class="to-field select-style">
                                <select name="filterable[]" class="dropdown">
                                    <option <?php if ($filterable == "Yes") echo "selected"; ?> value="Yes"><?php _e('Yes', 'cs_frame') ?></option>
                                    <option <?php if ($filterable == "No") echo "selected"; ?> value="No" ><?php _e('No', 'cs_frame') ?></option>
                                </select>
                            </li>
                        </ul>

        <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                            <ul class="form-elements insert-bg">
                                <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('cs_pb_', '', $name)); ?>', '<?php echo esc_js($name . $cs_counter); ?>', '<?php echo esc_js($filter_element); ?>')" ><?php _e('Insert', 'cs_frame') ?></a> </li>
                            </ul>
                            <div id="results-shortocde"></div>
                        <?php } else { ?>
                            <ul class="form-elements">
                                <li class="to-label"></li>
                                <li class="to-field">
                                    <input type="hidden" name="cs_orderby[]" value="course" />
                                    <input type="button" value="<?php _e('Save', 'cs_frame'); ?>" style="margin-right:10px;" onclick="javascript:_removerlay(jQuery(this))" />
                                </li>
                            </ul>
        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($die <> 1)
            die();
    }

    add_action('wp_ajax_cs_pb_course', 'cs_pb_course');
}