<?php
if (!function_exists('cs_team_post_shortcode')) {
    function cs_team_post_shortcode( $atts ) {
		global $post,$wp_query,$wpdb,$cs_theme_options,$cs_counter_node,$column_attributes,$cs_team_post_description,$cs_team_post_excerpt;
		$defaults = array('cs_team_post_section_title'=>'','cs_team_post_orderby'=>'DESC','cs_team_post_description'=>'','cs_team_post_excerpt'=>'255','cs_team_post_num_post'=>'10','cs_team_style'=>'', 'team_post_pagination'=>'');
        extract( shortcode_atts( $defaults, $atts ) );
    	$cs_dataObject = get_post_meta($post->ID,'cs_full_data');
	 	$cs_team_style = isset($cs_team_style) ? $cs_team_style : '';
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
                $cs_team_post_grid_layout = 'col-md-4';
        }else{
                $cs_team_post_grid_layout = 'col-md-3';    
        }        
        
		$CustomId    = '';
        
		if ( isset( $cs_team_post_class ) && $cs_team_post_class ) {
            $CustomId    = 'id="'.$cs_team_post_class.'"';
        }        
        
        $cs_counter_node++;
        ob_start();        
             
        if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;
        $cs_team_post_num_post    = $cs_team_post_num_post ? $cs_team_post_num_post : '-1';        
        $args = array('posts_per_page' => "-1", 'post_type' => 'teams', 'order' => $cs_team_post_orderby, 'orderby' => 'ID', 'post_status' => 'publish');
    
    
		$query = new WP_Query( $args );
        $count_post = $query->post_count;
        $cs_team_post_num_post    = $cs_team_post_num_post ? $cs_team_post_num_post : '-1';
        $args = array('posts_per_page' => "$cs_team_post_num_post", 'post_type' => 'teams', 'paged' => $_GET['page_id_all'], 'order' => $cs_team_post_orderby, 'orderby' => 'ID', 'post_status' => 'publish');
        
        $outerDivStart		= '';
        $outerDivEnd		= '';
        $section_title		= '';
        
        if(isset($cs_team_post_section_title) && trim($cs_team_post_section_title) <> ''){
            $section_title = '<div class="main-title col-md-12"><div class="cs-section-title"><h2>'.$cs_team_post_section_title.'</h2></div></div>';
        }
		global $cs_team_post_section_title;
        echo cs_allow_special_char($outerDivStart);
        echo cs_allow_special_char($section_title);	
		
		set_query_var( 'args', $args );
 
		if(isset($cs_team_style) and $cs_team_style == "grid") {
		 
	 	include('team-grid.php');
		
		} elseif(isset($cs_team_style) and $cs_team_style == "listing") {
			
		 include('team-list.php');
		
		} elseif(isset($cs_team_style) and $cs_team_style == "color") {
			
		 include('team-listing.php');
		
		} elseif(isset($cs_team_style) and $cs_team_style == "modern") {
	 	include('team-modern.php');
		
		}elseif(isset($cs_team_style) and $cs_team_style == "simple") {
	 	include('simple.php');
		
		} elseif(isset($cs_team_style) and $cs_team_style == "slider") {
			
	     include('team-slider.php');
		
		}
echo cs_allow_special_char($outerDivEnd);      
		//==Pagination Start
		if ( $team_post_pagination == "Show Pagination" && $count_post > $cs_team_post_num_post && $cs_team_post_num_post > 0 ) {
			$qrystr = '';
			if ( isset($_GET['page_id']) ) $qrystr .= "&amp;page_id=".$_GET['page_id'];               
			echo cs_pagination($count_post, $cs_team_post_num_post,$qrystr,'Show Pagination');
		}
		//==Pagination End
           
        wp_reset_postdata();    
            
        $post_data = ob_get_clean();
        return $post_data;
     }
    add_shortcode( 'cs_team_post', 'cs_team_post_shortcode' );
}