<?php

/**
 * @Recent posts widget Class
 *
 *
 */
if ( ! class_exists( 'teams' ) ) { 
    class teams extends WP_Widget{    

    /**
     * @init Recent posts Module
     *
     *
     */
	 
 
	   public function __construct() {
		
		parent::__construct(
			'teams', // Base ID
			__( 'CS : Team','uoc' ), // Name
			array( 'classname' => 'widget-team', 'description' => 'Recent Posts from category.', ) // Args
		);
	   }      
     /**
     * @Recent posts html form
     *
     *
     */
     function form($instance){
		 global $post;
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = $instance['title'];
        $select_category = isset( $instance['select_category'] ) ?  $instance['select_category']  : '';
        $showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';  
			  wp_reset_postdata();
	?>
        <p>
        	<label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> <?php _e('Title:', 'uoc') ?>
          		<input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
          </label>
        </p>
            <p>
        	<label for="<?php echo esc_html($this->get_field_id('select_category')) ?>"> <?php _e('Select Teams:', 'uoc') ?>
              
              <?php
			  printf (
				  '<select multiple="multiple" name="%s[]" id="%s" class="widefat" style="width:225px">',
				  $this->get_field_name('select_category'),
				  $this->get_field_id('select_category')
			  );
			  
                  $args = array('post_type' => 'teams');
				  $custom_query = new WP_Query($args);
               if(!is_array($select_category)) {
				$select_category = array();   
			   }
			     while ( $custom_query->have_posts()) : $custom_query->the_post();
						printf(
							'<option value="%s" %s>%s</option>',
							$post->ID,
							in_array( $post->ID, $select_category) ? 'selected="selected"' : '',
							get_the_title($post->ID)
						);
                   endwhile;
             
            echo '</select>';
			?>
          </label>
        </p>
        
   
    
        <?php
        }        
        /**
         * @Recent posts update form data
         *
         *
         */
         function update($new_instance, $old_instance){
              $instance = $old_instance;
              $instance['title'] = $new_instance['title'];
              $instance['select_category'] = $new_instance['select_category'];
	 
              $instance['showcount'] = $new_instance['showcount'];
              return $instance;
         }
         /**
         * @Display Recent posts widget
         *
         *
         */
         function widget($args, $instance){
              global $cs_node,$wpdb, $post,$cs_blog_cat;        
              extract($args, EXTR_SKIP);
              $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			  $title = htmlspecialchars_decode(stripslashes($title));
              $select_category = empty($instance['select_category']) ? ' ' :  $instance['select_category'] ; 
		     $showcount = empty($instance['showcount']) ? ' ' : apply_filters('widget_title', $instance['showcount']);    
              if($instance['showcount'] == ""){$instance['showcount'] = '-1';}   
			
		 
				 echo cs_allow_special_char($before_widget);        
              if (!empty($title) && $title <> ' '){  
			     echo cs_allow_special_char($before_title)
						. cs_allow_special_char($title)
					  .	cs_allow_special_char($after_title);
		    }    
	  
		 echo '	<div class="cs-unistaff">  ';
		 
			if ( is_array( $select_category ) ) { 
 	foreach( $select_category as $cs_cat ) {
		$width = 150;
		$height = 150;
					   $cs_thumbnail = cs_get_post_img_src($cs_cat, $width, $height);	
                       $cs_team_email = get_post_meta($cs_cat, 'cs_team_email', true);
 	                   $cs_team_position = get_post_meta($cs_cat, 'cs_team_position', true);
				 
				 		   $post_thumbnail_id = wp_get_attachment_url(get_post_thumbnail_id( $cs_cat ));
               ?>
                <article>
                  <figure><a href="<?php echo esc_url(get_permalink($cs_cat)); ?>"><img src="<?php echo esc_url($post_thumbnail_id) ?>" alt="image"></a></figure>
                  <div class="cs-text">
                    <h5><a href="<?php echo esc_url(get_permalink($cs_cat)); ?>"><?php echo get_the_title($cs_cat); ?></a></h5>
                    <span><?php echo esc_attr( $cs_team_position ); ?></span>
                    <?php if( $cs_team_email <> '' ) { ?>
                                	<a href="mailto:<?php echo sanitize_email( $cs_team_email ); ?>" class="emaildiv"><i class="icon-envelope4"></i><?php  echo sanitize_email( $cs_team_email ); ?></a>
                                    <?php } ?>   
                  </div>
                </article>
             
		<?php	
			 }
				echo '</div>';
				} else {
				echo 'No post Found';
				
			}
			  
                echo cs_allow_special_char($after_widget);
              }
          }
}
add_action( 'widgets_init', create_function('', 'return register_widget("teams");') );
?>