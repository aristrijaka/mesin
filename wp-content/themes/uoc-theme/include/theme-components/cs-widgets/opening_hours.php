<?php

/**
 * @ Contact info widget Class
 *
 *
 */
class opening_hours extends WP_Widget {
    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */

    /**
     * @init Contact Info Module
     *
     *
     */
   
	
  public function __construct() {
		
		parent::__construct(
			'opening_hours', // Base ID
			__( 'CS : Opening Hours','uoc' ), // Name
			array( 'classname' => 'widget_timing', 'description' => 'Footer Opening Hours Information.', ) // Args
		);
	   }

    /**
     * @Contact Info html form
     *
     *
     */
    function form($instance) {
        $instance = wp_parse_args((array) $instance);
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $monday = isset($instance['monday']) ? esc_attr($instance['monday']) : '';
        $monday_time = isset($instance['monday_time']) ? esc_attr($instance['monday_time']) : '';
        $tuesday = isset($instance['tuesday']) ? esc_attr($instance['tuesday']) : '';
        $tuesday_time = isset($instance['tuesday_time']) ? esc_attr($instance['tuesday_time']) : '';
        $wednesday = isset($instance['wednesday']) ? esc_attr($instance['wednesday']) : '';
        $wednesday_time = isset($instance['wednesday_time']) ? esc_attr($instance['wednesday_time']) : '';
        $thursday = isset($instance['thursday']) ? esc_attr($instance['thursday']) : '';
        $thursday_time = isset($instance['thursday_time']) ? esc_attr($instance['thursday_time']) : '';
        $friday = isset($instance['friday']) ? esc_attr($instance['friday']) : '';
        $friday_time = isset($instance['friday_time']) ? esc_attr($instance['friday_time']) : '';
        $saturday = isset($instance['saturday']) ? esc_attr($instance['saturday']) : '';
        $saturday_time = isset($instance['saturday_time']) ? esc_attr($instance['saturday_time']) : '';
        $sunday = isset($instance['sunday']) ? esc_attr($instance['sunday']) : '';
        $sunday_time = isset($instance['sunday_time']) ? esc_attr($instance['sunday_time']) : '';



        $randomID = rand(40, 9999999);
        ?>    
        <div style="margin-top:0px; float:left; width:100%;">
          <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> <span> <?php _e('Title:', 'uoc') ?></span>
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('monday')); ?>"> <span> <?php _e('Monday', 'uoc') ?></span>
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('monday')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('monday')); ?>" type="text" value="<?php echo esc_attr($monday); ?>" />
                </label>
            </p>

            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('monday_time')); ?>"> <span> <?php _e('Monday time', 'uoc') ?></span>
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('monday_time')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('monday_time')); ?>" type="text" value="<?php echo esc_attr($monday_time); ?>" />
                </label>
            </p>

        </div>
        <div style="margin-top:0px; float:left; width:100%;">
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('tuesday')); ?>"> <span><?php _e('Tuesday', 'uoc') ?></span>
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('tuesday')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('tuesday')); ?>" type="text" value="<?php echo esc_attr($tuesday); ?>" />
                </label>
            </p>

            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('tuesday_time')); ?>"> <span> <?php _e('Tuesday time', 'uoc') ?></span>
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('tuesday_time')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('tuesday_time')); ?>" type="text" value="<?php echo esc_attr($tuesday_time); ?>" />
                </label>
            </p>


        </div>
        <div style="margin-top:0px; float:left; width:100%;">
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('wednesday')); ?>"> <span><?php _e('Wednesday:', 'uoc') ?></span>
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('wednesday')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('wednesday')); ?>" type="text" value="<?php echo esc_attr($wednesday); ?>" />
                </label>
            </p>

            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('wednesday_time')); ?>"> <span> <?php _e('Wednesday time', 'uoc') ?></span>
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('wednesday_time')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('wednesday_time')); ?>" type="text" value="<?php echo esc_attr($wednesday_time); ?>" />
                </label>
            </p>

        </div>
        <div style="margin-top:0px; float:left; width:100%;">
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('thursday')); ?>"> <span><?php _e('Thursday:', 'uoc') ?></span>
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('thursday')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('thursday')); ?>" type="text" value="<?php echo esc_attr($thursday); ?>" />
                </label>
            </p>

            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('thursday_time')); ?>"> <span> <?php _e('Thursday time', 'uoc') ?></span>
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('thursday_time')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('thursday_time')); ?>" type="text" value="<?php echo esc_attr($thursday_time); ?>" />
                </label>
            </p>

        </div>
        <div style="margin-top:0px; float:left; width:100%;">
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('friday')); ?>"> <span><?php _e('Friday:', 'uoc') ?></span>
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('friday')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('friday')); ?>" type="text" value="<?php echo esc_attr($friday); ?>" />
                </label>
            </p>

            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('friday_time')); ?>"> <span> <?php _e('Friday time', 'uoc') ?></span>
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('friday_time')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('friday_time')); ?>" type="text" value="<?php echo esc_attr($friday_time); ?>" />
                </label>
            </p>
        </div>
        <div style="margin-top:0px; float:left; width:100%;">
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('saturday')); ?>"> <span><?php _e('Saturday:', 'uoc') ?></span>
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('saturday')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('saturday')); ?>" type="text" value="<?php echo esc_attr($saturday); ?>" />
                </label>
            </p>

            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('saturday_time')); ?>"> <span> <?php _e('Saturday time', 'uoc') ?></span>
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('saturday_time')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('saturday_time')); ?>" type="text" value="<?php echo esc_attr($saturday_time); ?>" />
                </label>
            </p>
        </div>
        <div style="margin-top:0px; float:left; width:100%;">
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('sunday')); ?>"> <span> <?php _e('Sunday:', 'uoc') ?></span>
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('sunday')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('sunday')); ?>" type="text" value="<?php echo esc_attr($sunday); ?>" />
                </label>
            </p>

            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('sunday_time')); ?>"> <span> <?php _e('Sunday time', 'uoc') ?></span>
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('sunday_time')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('sunday_time')); ?>" type="text" value="<?php echo esc_attr($sunday_time); ?>" />
                </label>
            </p>

        </div>
        <?php
    }

    /**
     * @Update Info html form
     *
     *
     */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
		$instance['title'] = $new_instance['title'];
        $instance['monday'] = $new_instance['monday'];
        $instance['monday_time'] = $new_instance['monday_time'];
        $instance['tuesday'] = $new_instance['tuesday'];
        $instance['tuesday_time'] = $new_instance['tuesday_time'];
        $instance['wednesday'] = $new_instance['wednesday'];
        $instance['wednesday_time'] = $new_instance['wednesday_time'];
        $instance['thursday'] = $new_instance['thursday'];
        $instance['thursday_time'] = $new_instance['thursday_time'];
        $instance['friday'] = $new_instance['friday'];
        $instance['friday_time'] = $new_instance['friday_time'];
        $instance['saturday'] = $new_instance['saturday'];
        $instance['saturday_time'] = $new_instance['saturday_time'];
        $instance['sunday'] = $new_instance['sunday'];
        $instance['sunday_time'] = $new_instance['sunday_time'];

        return $instance;
    }

    /**
     * @Widget Info html form
     *
     *
     */
    function widget($args, $instance) {
        global $cs_node;
        extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $monday = empty($instance['monday']) ? '' : apply_filters('widget_title', $instance['monday']);
        $monday_time = empty($instance['monday_time']) ? '' : apply_filters('widget_title', $instance['monday_time']);
        $tuesday = empty($instance['tuesday']) ? '' : apply_filters('widget_title', $instance['tuesday']);
        $tuesday_time = empty($instance['tuesday_time']) ? '' : apply_filters('widget_title', $instance['tuesday_time']);
        $wednesday = empty($instance['wednesday']) ? '' : apply_filters('widget_title', $instance['wednesday']);
        $wednesday_time = empty($instance['wednesday_time']) ? '' : apply_filters('widget_title', $instance['wednesday_time']);
        $thursday = empty($instance['thursday']) ? '' : apply_filters('widget_title', $instance['thursday']);
        $thursday_time = empty($instance['thursday_time']) ? '' : apply_filters('widget_title', $instance['thursday_time']);
        $friday = empty($instance['friday']) ? '' : apply_filters('widget_title', $instance['friday']);
        $friday_time = empty($instance['friday_time']) ? '' : apply_filters('widget_title', $instance['friday_time']);
        $saturday = empty($instance['saturday']) ? '' : apply_filters('widget_title', $instance['saturday']);
        $saturday_time = empty($instance['saturday_time']) ? '' : apply_filters('widget_title', $instance['saturday_time']);
        $sunday = empty($instance['sunday']) ? '' : apply_filters('widget_title', $instance['sunday']);

        $sunday_time = empty($instance['sunday_time']) ? '' : apply_filters('widget_title', $instance['sunday_time']);

        echo cs_allow_special_char($before_widget);
          ?> 
	        <div class="widget-section-title">
           <?php  if (!empty($title) && $title <> ' ') { ?>
						<h6><?php echo cs_allow_special_char($title); ?></h6> 
                         <?php } ?>
					</div>
					<div class="timing-details">
						<ul>
                         <?php  if (!empty($monday) && $monday <> ' ' and !empty($monday_time) && $monday_time <> '') { ?>
							<li>
								<span class="days"><?php echo cs_allow_special_char($monday); ?></span>
								<time datetime="2008-02-14"><?php echo cs_allow_special_char($monday_time); ?></time>
							</li>
                             <?php } ?>
                             <?php  if (!empty($tuesday) && $tuesday <> ' ' and !empty($tuesday_time) && $tuesday_time <> '') { ?>
							<li>
								<span class="days"><?php echo cs_allow_special_char($tuesday); ?></span>
								<time datetime="2008-02-14"><?php echo cs_allow_special_char($tuesday_time); ?></time>
							</li>
                             <?php } ?>
                             <?php  if (!empty($wednesday) && $wednesday <> ' ' and !empty($wednesday_time) && $wednesday_time <>'') { ?>
							<li>
								<span class="days"><?php echo cs_allow_special_char($wednesday);?></span>
								<time datetime="2008-02-14"><?php echo cs_allow_special_char($wednesday_time);?></time>
							</li>
                             <?php } ?>
                             <?php  if (!empty($thursday) && $thursday <> ' ' and !empty($thursday_time) && $thursday_time <> ' ') { ?>
							<li>
								<span class="days"><?php echo cs_allow_special_char($thursday); ?></span>
								<time datetime="2008-02-14"><?php echo cs_allow_special_char($thursday_time); ?></time>
							</li>
                             <?php } ?>
                             <?php  if (!empty($friday) && $friday <> ' ' and !empty($friday_time) && $friday_time <> ' ') { ?>
							<li>
								<span class="days"><?php echo cs_allow_special_char($friday); ?></span>
								<time datetime="2008-02-14"><?php echo cs_allow_special_char($friday_time); ?></time>
							</li>
                             <?php } ?>
                             <?php  if (!empty($saturday) && $saturday <> ' ' and !empty($saturday_time) && $saturday_time <>'') { ?>
							<li>
								<span class="days"><?php echo cs_allow_special_char($saturday); ?></span>
								<time datetime="2008-02-14"><?php echo cs_allow_special_char($saturday_time); ?></time>
							</li>
                             <?php } ?>
                             <?php  if (!empty($sunday) && $sunday <> ' ' and !empty($sunday_time) && $sunday_time <> ' ') { ?>
							<li>
								<span class="days"><?php echo cs_allow_special_char($sunday); ?></span>
								<time datetime="2008-02-14"><?php echo cs_allow_special_char($sunday_time); ?></time>
							</li>
                            <?php } ?>
						</ul>
					</div>
 
      <?php
	    echo cs_allow_special_char($after_widget);
    }

}

add_action('widgets_init', create_function('', 'return register_widget("opening_hours");'));
?>