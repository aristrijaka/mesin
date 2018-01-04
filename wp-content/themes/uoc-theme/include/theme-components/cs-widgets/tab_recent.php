<?php

/**
 * @Recent posts widget Class
 *
 *
 */
if ( ! class_exists( 'tabs' ) ) { 
    class tabs extends WP_Widget{    

    /**
     * @init Recent posts Module
     *
     *
     */
	 
 
	 
	  public function __construct() {
		
		parent::__construct(
			'tabs', // Base ID
			__( 'CS : Tab View','uoc' ), // Name
			array( 'classname' => 'widget_tabs', 'description' => 'Recent Tabs view from category.', ) // Args
		);
	   }   
     /**
     * @Recent posts html form
     *
     *
     */
     function form($instance){
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = $instance['title'];
        $select_category = isset( $instance['select_category'] ) ? esc_attr( $instance['select_category'] ) : '';
        $showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';  
			 
	?>
        <p>
        	<label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> <?php _e('Title:', 'uoc') ?>
          		<input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
          </label>
        </p>
 
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>"> <?php _e('Number of Posts To Display:', 'uoc') ?>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('showcount')); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />
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
              $select_category = empty($instance['select_category']) ? ' ' : apply_filters('widget_title', $instance['select_category']);               
               $showcount = empty($instance['showcount']) ? ' ' : apply_filters('widget_title', $instance['showcount']);    
              if($instance['showcount'] == ""){$instance['showcount'] = '-1';}   
			
		 
				 echo cs_allow_special_char($before_widget);        
               ?>   
	          
		<div class="widget element-size-100 widget_tabs">
               <?php  if (!empty($title) && $title <> ' '){  
			     echo ' 
				      '. cs_allow_special_char($before_title).'
						'. cs_allow_special_char($title).'
						'. cs_allow_special_char($after_title).'
				  ' ;
		    }
			?>
                <ul class="tab-nav">
                  <li class="active"><a href="#tab1"><i class="icon-user9"></i></a></li>
                  <li><a href="#tab2"><i class="icon-tag7"></i></a></li>
                  <li><a href="#tab3"><i class="icon-folder5"></i></a></li>
                </ul>
                <div class="tab-content">
                  <div class="tabs news" id="tab1" style="display: block;">
                    <ul>
                    <?php 	$args = array( 'post_type' => 'post','post_status' => 'publish','posts_per_page'=>$showcount);
					$custom_query = new WP_Query($args);
					 while ( $custom_query->have_posts()) : $custom_query->the_post();
					 ?>
                      <li>
                        <span class="cat"><?php cs_get_categories($cs_blog_cat); ?></span>
                        <a href="<?php esc_url(the_permalink());?>"><?php the_title();?></a>
                        <span class="info">
                         
                          <time datetime="2008-02-14"><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></time>
                       <?php
						   $coments = get_comments_number(__('0', 'uoc'), __('1', 'uoc'), __('%', 'uoc'));
							printf('%s', $coments);
							_e('Comments', 'uoc'); 
                            ?>
                            </span>
                      
                      </li>
                      
                      <?php endwhile;?>
                    
                    </ul>
                  </div>
                  <div class="tabs news" id="tab2" style="display: none;">
                    <ul>
                      <?php 
					  $args = array( 'post_type' => 'post','post_status' => 'publish','orderby' => "comment_count",'posts_per_page'=>$showcount);
					$custom_query = new WP_Query($args);
					 while ( $custom_query->have_posts()) : $custom_query->the_post();
					 ?>
                      <li>
                        <span class="cat"><?php cs_get_categories($cs_blog_cat); ?></span>
                        <a href="<?php esc_url(the_permalink());?>"><?php the_title();?> </a>
                        <span class="info">
                        <time datetime="2008-02-14"><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></time>
                         
                         <?php $coments = get_comments_number(__('0', 'uoc'), __('1', 'uoc'), __('%', 'uoc'));
                                    		printf('%s', $coments);
                                   			 _e('Comments', 'uoc'); 
                                    ?></span>
                       
                      </li>
                    <?php endwhile;
                     wp_reset_query();?>
                    </ul>
                  </div>
                  <div class="tabs news" id="tab3" style="display: none;">
                    <ul>
                      <?php 	$args = array( 'post_type' => 'post','post_status' => 'publish','orderby' => "DESC",'posts_per_page'=>$showcount);
					$custom_query = new WP_Query($args);
					 while ( $custom_query->have_posts()) : $custom_query->the_post();
					 ?>
                      <li>
                        <span class="cat"><?php cs_get_categories($cs_blog_cat); ?></span>
                        <a href="<?php esc_url(the_permalink());?>"><?php the_title();?></a>
                        <span class="info">    <time datetime="2008-02-14"><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></time>
                        
                             <?php $coments = get_comments_number(__('0', 'uoc'), __('1', 'uoc'), __('%', 'uoc'));
                                    		printf('%s', $coments);
                                   			 _e('Comments', 'uoc'); 
                                    ?>
                        </span>
                       </li>
                       <?php endwhile;?>
                   
                    </ul>
                  </div>
                </div>
              </div>	  
<?php echo cs_allow_special_char($after_widget);
              }
          }
}
add_action( 'widgets_init', create_function('', 'return register_widget("tabs");') );
?>