<?php

/**
 * @Recent posts widget Class
 *
 *
 */
if ( ! class_exists( 'recentposts' ) ) { 
    class recentposts extends WP_Widget{    

    /**
     * @init Recent posts Module
     *
     *
     */
	 
   
	 
	  public function __construct() {
		
		parent::__construct(
			'recentposts', // Base ID
			__( 'CS : Recent Posts','uoc' ), // Name
			array( 'classname' => 'cs-campunews', 'description' => 'Recent Posts from category.', ) // Args
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
        	<label for="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>"> <?php _e('Select Category:', 'uoc') ?>
            	<select id="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('select_category')); ?>" style="width:225px">
              <option value="" ><?php _e('All', 'uoc') ?></option>
              <?php
                $categories = get_categories();
                if($categories <> ""){
                    foreach ( $categories as $category ) {?>
                      <option <?php if($select_category == $category->slug){echo 'selected';}?> value="<?php echo cs_allow_special_char($category->slug);?>" ><?php echo cs_allow_special_char($category->name);?></option>
                    <?php 
                    }
                }?>
            </select>
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
              if (!empty($title) && $title <> ' '){  
			     echo ' 
				      '. cs_allow_special_char($before_title).'
						'. cs_allow_special_char($title).'
						'. cs_allow_special_char($after_title).'
				 ' ;
		    }    
	          if(isset($select_category) and $select_category <> ' ' and $select_category <> ''){
				$args = array( 'posts_per_page' => "$showcount",'post_type' => 'post','category_name' => "$select_category");
			}else{
				$args = array( 'posts_per_page' => "$showcount",'post_type' => 'post');
			}
			$title_limit = 6;
			$custom_query = new WP_Query($args);
			if ( $custom_query->have_posts() <> "" ) {
				echo '<div class="cs-campunews custom-fig">
                      <ul>';
				  while ( $custom_query->have_posts()) : $custom_query->the_post();
				  $width = 150;
                  $height = 150;
                  $image_id = get_post_thumbnail_id( $post->ID );
                  $image_url = cs_get_post_img_src($post->ID, $width, $height);
			 
				  $category_id = get_query_var('cat');
				  $categories = get_the_category($post->ID );
 
				 ?> 
                 
                     
                        <li>
                          <figure><a href="<?php echo esc_url($image_url)?>"><img src="<?php echo esc_url($image_url)?>" alt=""></a>
                          
                          <figcaption>
                   <a href="<?php echo esc_url($image_url)?>" rel="prettyPhoto[gallery2]" title=""><i class="icon-plus8"></i></a>
                  </figcaption>
                          
                          </figure>
                          <div class="cs-campus-info">
                            <div class="cs-newscategorie">  <?php cs_get_categories($cs_blog_cat); ?>  </div>
                            <h6><a href="<?php esc_url(the_permalink());?>"><?php the_title();?>  </a></h6>
                            <time datetime="2008-02-14 20:00"><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?> </time>
                            <a href="<?php esc_url(the_permalink());?>" class="cmp-comment"><?php $coments = get_comments_number(__('0', 'uoc'), __('1', 'uoc'), __('%', 'uoc'));
                                    		printf('%s', $coments);
                                   			 _e('Comments', 'uoc'); 
                                    ?></a>
                            </div>
                        </li>
                    
				<?php  endwhile;
                                 wp_reset_query();
				echo '  </ul>
                      <a href="'.esc_url(get_category_link( $category_id) ).'" class="viewall-btn csbg-hovercolor"><i class="icon-angle-double-right"></i> '.__('View All Blogs','uoc').'</a>
                    </div>';
				}else{
				echo 'No post Found';
				
			}
			  
                echo cs_allow_special_char($after_widget);
              }
          }
}
add_action( 'widgets_init', create_function('', 'return register_widget("recentposts");') );
?>