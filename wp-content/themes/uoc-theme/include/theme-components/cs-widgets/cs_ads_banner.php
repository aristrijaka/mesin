<?php
/**
 * @Ads Banners Widget Class
 */
if ( ! class_exists( 'cs_ads_banner' ) ) {
    class cs_ads_banner extends WP_Widget {
    /**
     * Outputs the content of the widget
     * @param array $args
     * @param array $instance
     */
         
    /**
     * @init User list Module */
   
	 public function __construct() {
		
		parent::__construct(
			'cs_ads_banner', // Base ID
			__( 'CS : Ads Banners','uoc' ), // Name
			array( 'classname' => 'cs_ads_banner', 'description' => 'Set Banners option in widget.', ) // Args
		);
	}


    /**
     * @Ads Banners html form
             */
     function form($instance) {             
            $cs_rand_id = rand(23789,934578930);            
            $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'banner_code' => '' ) );
            $title = $instance['title'];
            $banner_style = isset( $instance['banner_style'] ) ? esc_attr( $instance['banner_style'] ) : '';
            $banner_code = $instance['banner_code'];
            $banner_view = isset( $instance['banner_view'] ) ? esc_attr( $instance['banner_view'] ) : '';
            $showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';    
            ?>
            <p>
              <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> Title:
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
              </label>
            </p>
            <p>
              <label for="<?php echo cs_allow_special_char($this->get_field_id('banner_view')); ?>"> Banner View:
                <select onchange="cs_banner_widget_toggle(this.value, '<?php echo cs_allow_special_char($cs_rand_id) ?>')" id="<?php echo cs_allow_special_char($this->get_field_id('banner_view')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('banner_view')); ?>" style="width:225px">
                  <option value="single" <?php if(cs_allow_special_char($banner_view) == 'single'){echo 'selected';}?>>Single Banner</option>
                  <option value="random" <?php if(cs_allow_special_char($banner_view) == 'random'){echo 'selected';}?>>Random Banners</option>
                </select>
              </label>
            </p>
            <p id="cs_banner_code_field_<?php echo cs_allow_special_char($cs_rand_id) ?>" style="display:<?php echo cs_allow_special_char($banner_view) == 'single' ? 'block' : 'none'; ?>;">
              <label for="<?php echo cs_allow_special_char($this->get_field_id('banner_code')); ?>"> Banner Code:
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('banner_code')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('banner_code')); ?>" type="text" value="<?php echo htmlspecialchars($banner_code); ?>" />
              </label>
            </p>
            <p id="cs_banner_style_field_<?php echo cs_allow_special_char($cs_rand_id) ?>" style="display:<?php echo cs_allow_special_char($banner_view) == 'random' ? 'block' : 'none'; ?>;">
              <label for="<?php echo cs_allow_special_char($this->get_field_id('banner_style')); ?>"> Banner Style:
                <select id="<?php echo cs_allow_special_char($this->get_field_id('banner_style')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('banner_style')); ?>" style="width:225px">
                  <option value="top_banner" <?php if(cs_allow_special_char($banner_style) == 'top_banner'){echo 'selected';}?>>Top Banner</option>
                  <option value="bottom_banner" <?php if(cs_allow_special_char($banner_style) == 'bottom_banner'){echo 'selected';}?>>Bottom Banner</option>
                  <option value="sidebar_banner" <?php if(cs_allow_special_char($banner_style) == 'sidebar_banner'){echo 'selected';}?>>Sidebar Banner</option>
                  <option value="vertical_banner" <?php if(cs_allow_special_char($banner_style) == 'vertical_banner'){echo 'selected';}?>>Vertical Banner</option>
                </select>
              </label>
            </p>
            <p id="cs_banner_number_field_<?php echo cs_allow_special_char($cs_rand_id) ?>" style="display:<?php echo cs_allow_special_char($banner_view) == 'random' ? 'block' : 'none'; ?>;">
              <label for="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>"> Number of Banners:
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>" size="2" name="<?php echo cs_allow_special_char($this->get_field_name('showcount')); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />
                  <br />
                <span><i>Set maximum number of Banners upto 10.</i></span>
              </label>
            </p>
        <?php
        }
        /**
         * @Ads Banners update data*/
         function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['banner_style'] = esc_sql($new_instance['banner_style']);
            $instance['banner_code'] = $new_instance['banner_code'];
            $instance['banner_view'] = esc_sql($new_instance['banner_view']);
            $instance['showcount'] = esc_sql($new_instance['showcount']);
              return $instance;
         }
        /**
         * @Ads Banners list widget */
         function widget($args, $instance) {
            extract($args, EXTR_SKIP);
            global $wpdb, $post, $cs_theme_options;
            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			$title = htmlspecialchars_decode(stripslashes($title));
            $banner_style = empty($instance['banner_style']) ? ' ' : apply_filters('widget_title', $instance['banner_style']);
            $banner_code = empty($instance['banner_code']) ? ' ' : $instance['banner_code'];
            $banner_view = empty($instance['banner_view']) ? ' ' : apply_filters('widget_title', $instance['banner_view']);
            $showcount = $instance['showcount'];
            // WIDGET display CODE Start
            echo balanceTags($before_widget,false);        
			    
            if (!empty($title) && $title <> ' ') {
				echo cs_allow_special_char($before_title) . $title . $after_title;
			}
			
            $showcount = ( $showcount <> '' || !is_integer($showcount) ) ? $showcount : 2;
            
            if($banner_view == 'single'){
                echo do_shortcode($banner_code);
            }
            else {
                $cs_total_banners = ( is_integer($showcount) && $showcount > 10) ? 10 : $showcount;                
                if( isset($cs_theme_options['banner_field_title']) ) {                    
                    $i = 0;
                    $d = 0;
                    $cs_banner_array = array();
                    foreach($cs_theme_options['banner_field_title'] as $banner) :
                        if($cs_theme_options['banner_field_style'][$i] == $banner_style){
                            $cs_banner_array[] = $i;
                            $d++;
                        }
                        if($cs_total_banners == $d){
                            break;
                        }
                        $i++;
                    endforeach;
                    if(sizeof($cs_banner_array) > 0){
                        $cs_act_size = sizeof($cs_banner_array)-1;
                        $cs_rand_banner = rand(0, $cs_act_size);
                        
                        $cs_rand_banner = $cs_banner_array[$cs_rand_banner];
                        echo do_shortcode('[cs_ads id="'.$cs_theme_options['banner_field_code_no'][$cs_rand_banner].'"]');
                    }
                }
            }
              
             echo balanceTags($after_widget,false); 
        }
    }
}
add_action('widgets_init', create_function('', 'return register_widget("cs_ads_banner");'));