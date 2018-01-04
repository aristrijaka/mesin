<?php
if (!function_exists('cs_gallery_shortcode')) {
    function cs_gallery_shortcode( $atts ) {
        global $post,$wpdb,$cs_theme_options,$cs_counter_node,$column_attributes,$cs_blog_cat,$cs_blog_description,$cs_blog_excerpt,$post_thumb_view,$cs_gal_album,$cs_gal_desc_view,$cs_gal_media_per_page,$cs_gal_pagination;
         
		$defaults = array('cs_gal_header_title'=>'','cs_gal_layout'=>'','cs_gal_album'=>'','cs_gal_desc'=>'','cs_gal_pagination'=>'','cs_gal_media_per_page'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
        $cs_dataObject		= get_post_meta($post->ID,'cs_full_data');
		
		// Check Section or page layout
        $cs_sidebarLayout  = '';
        $section_cs_layout = '';
        $pageSidebar 	   = false;        
        $box_col_class 	   = 'col-md-3';        
        
		if(isset($cs_dataObject['cs_page_layout'])) $cs_sidebarLayout = $cs_dataObject['cs_page_layout'];
        
		if(isset($column_attributes->cs_layout)){
            $section_cs_layout = $column_attributes->cs_layout;
			if ( $section_cs_layout == 'left' || $section_cs_layout == 'right' ) {
				$pageSidebar = true;
			}
        }
        
        if ( $cs_sidebarLayout == 'left' || $cs_sidebarLayout == 'right') {
            $pageSidebar = true;
        }        
        
		if($pageSidebar == true) {
            $box_col_class = 'col-md-4';
        }
        
		// Check Section or page layout ends
        
        if ((isset($cs_dataObject['cs_page_layout']) && $cs_dataObject['cs_page_layout'] <> '' and $cs_dataObject['cs_page_layout'] <> "none") || $pageSidebar == true){           
                $cs_blog_grid_layout = 'col-md-4';
        }else{
                $cs_blog_grid_layout = 'col-md-3';    
        }        
        
		$CustomId    = '';
        
		if ( isset( $cs_blog_class ) && $cs_blog_class ) {
            $CustomId    = 'id="'.$cs_blog_class.'"';
        }        
        
		     
        
		$owlcount = rand(40, 9999999);
        $cs_counter_node++;
        ob_start();        
        
		//==Filters
        $filter_category = '';
        $filter_tag = '';
        $author_filter = '';
        $outerDivStart    = '';
        $outerDivEnd    = '';
        $section_title  = '';
        if(isset($cs_gal_header_title) && trim($cs_gal_header_title) <> '' ){ 
		
			$section_title = '	<div class="cs-heading-sec col-md-12">
					<div class="inner-sec">
					<h1>'.$cs_gal_header_title.'</h1>
						
					</div>
				</div> ';
		}
		
		 
		
        echo cs_allow_special_char($outerDivStart);
        echo cs_allow_special_char($section_title);	
         $args  = array();
		set_query_var( 'args', $args );
		
		if ( $cs_gal_layout == 'gallery-small' ) {
		   include('gallery-small.php');
		} else if ( $cs_gal_layout == 'gallery-medium' ) { 
			include('gallery-medium.php');
		}else if ( $cs_gal_layout == 'gallery-slider' ) { 
			include('gallery-slider.php');
		} else if ( $cs_gal_layout == 'gallery-video' ) {
			include('gallery-video.php');
		} 
		echo cs_allow_special_char($outerDivEnd);      
        wp_reset_postdata();    
            
        $post_data = ob_get_clean();
        return $post_data;
     }
	add_shortcode( 'cs_gallery', 'cs_gallery_shortcode' );
}

if (!function_exists('cs_get_categories')) {
	function cs_get_categories( $cs_blog_cat ) {             
		 global $post,$wpdb;                                 
		 if ( isset( $cs_blog_cat ) && $cs_blog_cat !='' && $cs_blog_cat !='0' ){ 
			$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $cs_blog_cat ));
			echo '<a href="'.esc_url( home_url('/') ).'?cat='.$row_cat->term_id.'">'.$row_cat->name.'</a>';
		 } else {
			 /* Get All Categories */
			  $before_cat = "";
			  $categories_list = get_the_term_list ( get_the_id(), 'category', $before_cat , ', ', '' );
			  if ( $categories_list ){
				printf( '%1$s', $categories_list );
			  } 
			 // End if Categories 
		 }
	}
}

/*----------------------------------------------------------------
// @ Post Likes Counter
/----------------------------------------------------------------*/
if(!function_exists('cs_post_likes_count')){
	function cs_post_likes_count(){		
		$cs_like_counter = get_post_meta( $_POST['post_id'] , "cs_post_like_counter", true);
		if ( !isset($_COOKIE["cs_post_like_counter".$_POST['post_id']]) ){
			setcookie("cs_post_like_counter".$_POST['post_id'], 'true', time()+86400, '/');
			update_post_meta( $_POST['post_id'], 'cs_post_like_counter', $cs_like_counter+1 );
		}
		$cs_like_counter = get_post_meta($_POST['post_id'], "cs_post_like_counter", true);
		if ( !isset($cs_like_counter) or empty($cs_like_counter) ) $cs_like_counter = 0;
		 
		echo cs_allow_special_char($cs_like_counter);
		die(0);
	}	
	add_action('wp_ajax_cs_post_likes_count', 'cs_post_likes_count');
	add_action('wp_ajax_nopriv_cs_post_likes_count', 'cs_post_likes_count');
}
