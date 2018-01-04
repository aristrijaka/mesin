<?php
	// Gallery start
		//adding columns start
		add_filter('manage_cs_gallery_posts_columns', 'gallery_columns_add');
			function gallery_columns_add($columns) {
				$columns['author'] = 'Author';
				return $columns;
		}
		add_action('manage_cs_gallery_posts_custom_column', 'gallery_columns');
			function gallery_columns($name) {
				global $post;
				switch ($name) {
					case 'author':
						echo get_the_author();
						break;
				}
			}
		//adding columns end
		function cs_media_pagination(){
	foreach ( $_REQUEST as $keys=>$values) {
		$$keys = $values;
	}
	$records_per_page = 10;
	if ( empty($page_id) ) $page_id = 1;
	$offset = $records_per_page * ($page_id-1);
?>
	<ul class="gal-list">
      <?php
        $query_images_args = array('post_type' => 'attachment', 'post_mime_type' =>'image', 'post_status' => 'inherit', 'posts_per_page' => -1,);
        $query_images = new WP_Query( $query_images_args );
        if ( empty($total_pages) ) $total_pages = count( $query_images->posts );
		$query_images_args = array('post_type' => 'attachment', 'post_mime_type' =>'image', 'post_status' => 'inherit', 'posts_per_page' => $records_per_page, 'offset' => $offset,);
        $query_images = new WP_Query( $query_images_args );
        $images = array();
        foreach ( $query_images->posts as $image) { //echo "hellohkjh h";
        	$image_path = wp_get_attachment_image_src((int) $image->ID, array( get_option("thumbnail_size_w"),get_option("thumbnail_size_h") ) );
        ?>
        	<li style="cursor:pointer"><img src="<?php echo esc_url($image_path[0])?>" onclick="javascript:clone('<?php echo absint($image->ID)?>')" alt="" /></li>
         <?php
         }
         ?>
      </ul>
      <br />
      <div class="pagination-cus">
        	<ul>
				<?php
                if ( $page_id > 1 ) echo "<li><a href='javascript:show_next(".($page_id-1).",$total_pages)'>Prev</a></li>";
                    for ( $i = 1; $i <= ceil($total_pages/$records_per_page); $i++ ) {
                        if ( $i <> $page_id ) echo "<li><a href='javascript:show_next($i,$total_pages)'>" . $i . "</a></li> ";
                        else echo "<li class='active'><a>" . $i . "</a></li>";
                    }
                if ( $page_id < $total_pages/$records_per_page ) echo "<li><a href='javascript:show_next(".($page_id+1).",$total_pages)'>Next</a></li>";
                ?>
			</ul>
        </div>
<?php
	if ( isset($_POST['action']) ) die();
}
add_action('wp_ajax_cs_media_pagination', 'cs_media_pagination');
	function cs_gallery_register() {  
		$labels = array(
			'name' =>__('Galleries','cs_frame'),
			'add_new_item' =>__('Add New Gallery','cs_frame'),
			'edit_item' =>__('Edit Gallery','cs_frame'),
			'new_item' =>__('New Gallery Item','cs_frame'),
			'add_new' =>__('Add New Gallery','cs_frame'),
			'view_item' =>__('View Gallery Item','cs_frame'),
			'search_items' =>__('Search Gallery','cs_frame'),
			'not_found' =>__('Nothing found','cs_frame'),
			'not_found_in_trash' =>__('Nothing found in Trash','cs_frame'),
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon' => 'dashicons-format-gallery',
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title', 'thumbnail')
		); 
        register_post_type( 'cs_gallery' , $args );
	}
	
	add_action('init', 'cs_gallery_register');
	function cs_gallery_categories() 
	{
		  $labels = array(
			'name' =>__('Gallery Albums','cs_frame'),
			'search_items' =>__('Search Gallery Albums','cs_frame'),
			'edit_item' =>__('Edit Gallery Album','cs_frame'),
			'update_item' =>__('Update Gallery Album','cs_frame'),
			'add_new_item' =>__('Add New Album','cs_frame'),
			'menu_name' =>__('Gallery Albums','cs_frame'),
		  ); 	
		  register_taxonomy('cs_gallery-category',array('cs_gallery'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'cs_gallery-category' ),
		  ));
	}
	add_action( 'init', 'cs_gallery_categories');
function cs_gallery_uoc(){
	global $cs_node, $counter;
	if( isset($_POST['action']) ) {
		$cs_node = new stdClass();
		$cs_node->title = "";
		$cs_node->description = "";
		$cs_node->image_link_url = "";
		$cs_node->readmore_link_url = "";
		$cs_node->use_image_as = "";
		
		//$cs_node->description_view_layout = "";
		
		//echo "i am here in funtion  = ".$description_view_layout = get_post_meta( $post->ID, 'cs_description_view_layout', true);
		
		$cs_node->video_code = "";
		$cs_node->link_url = "";
		$cs_node->use_image_as_db = "";
		$cs_node->link_url_db = '';
	}
	if ( isset($_POST['counter']) ) $counter = $_POST['counter'];
	if ( isset($_POST['path']) ) $cs_node->path = $_POST['path'];
	//if ( isset($_POST['cs_description_view_layout']) ) $cs_node->cs_description_view_layout = $_POST['cs_description_view_layout'];
?>
    <li class="ui-state-default" id="<?php echo esc_attr($counter)?>">
        <div class="thumb-secs">
            <?php  
			 
			$image_path = wp_get_attachment_image_src( (int) $cs_node->path, array( get_option("thumbnail_size_w"),get_option("thumbnail_size_h") ) );?>
            <img src="<?php echo esc_url($image_path[0])?>" alt="">
            <div class="gal-edit-opts">
                <!--<a href="#" class="resize"></a>-->  
                
                <a href="javascript:galedit(<?php echo esc_attr($counter)?>)" class="edit" style="float: left;left: 64px; position: absolute;"></a>
                <a href="javascript:del_this(<?php echo esc_attr($counter)?>)" class="delete"></a>
            </div>
        </div>
        
        <div class="poped-up" id="edit_<?php echo esc_attr($counter)?>">
            <div class="opt-head">
                <h5>Edit Options</h5>
                <a href="javascript:galclose(<?php echo esc_attr($counter)?>)" class="closeit">&nbsp;</a>
            </div>
            <div class="opt-conts">
                <ul class="form-elements">
                    <li class="to-label"><label><?php _e('Image Title','cs_frame')?></label></li>
                    <li class="to-field"><input type="text" name="title[]" value="<?php echo htmlspecialchars($cs_node->title)?>" class="txtfield" /></li>
                </ul>
              
                <ul class="form-elements">
                    <li class="to-label"><label><?php _e('Image Description','cs_frame')?></label></li>
                    <li class="to-field"><textarea class="txtarea" name="description[]"><?php echo htmlspecialchars($cs_node->description)?></textarea></li>
                </ul>
                
                 <ul class="form-elements">
                    <li class="to-label"><label><?php _e('Video Link','cs_frame')?></label></li>
                    <li class="to-field"><textarea class="txtarea" name="image_link_url[]"><?php echo htmlspecialchars($cs_node->image_link_url)?></textarea></li>
                </ul>
                
                 <ul class="form-elements">
                    <li class="to-label"><label><?php _e('Read more','cs_frame')?></label></li>
                    <li class="to-field"><textarea class="txtarea" name="readmore_link_url[]"><?php echo htmlspecialchars($cs_node->readmore_link_url)?></textarea></li>
                </ul>
                
                
                
                <ul class="form-elements">
                    <li class="to-label"></li>
                    <li class="to-field">
                        <input type="hidden" name="path[]" value="<?php echo cs_allow_special_char($cs_node->path)?>" />
                        <input type="button" onclick="javascript:galclose(<?php echo esc_attr($counter)?>)" value="Submit" class="close-submit" />
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </li>
<?php
	if ( isset($_POST['action']) ) die();
}
add_action('wp_ajax_gallery_clone', 'cs_gallery_uoc');
		// adding Gallery meta info start  
			add_action( 'add_meta_boxes', 'cs_meta_gallery_add' );
			function cs_meta_gallery_add()
			{  
				add_meta_box( 'cs_meta_gallery', __('Gallery Options','cs_frame'), 'cs_meta_gallery', 'cs_gallery', 'normal', 'high' );  
			}
			
			
			function cs_meta_gallery( $post ) {
				$cs_meta_gallery_meta_dec_view = get_post_meta( (int)$post->ID, 'cs_meta_gallery_meta_dec_view', true); // description layout
				$cs_meta_gallery_meta_video_dec = get_post_meta((int) $post->ID, 'cs_meta_gallery_meta_video_dec', true); // description layout
				$cs_pagination_display = get_post_meta( (int)$post->ID, 'cs_pagination_display', true); // cs_pagination_display
				$cs_meta_field_pagination_per_page = get_post_meta( (int)$post->ID, 'cs_meta_field_pagination_per_page', true); // cs_pagination_display
				
				
				?>
					<div class="page-wrap" style="overflow:hidden;">
					<div class="option-sec">
                            <div class="opt-conts-in">
                                <div class="to-social-network">
                                    <div class="gal-active">
                                        <div class="clear"></div>
                                        <div class="dragareamain">
                                        <div class="placehoder"><?php _e('Gallery is Empty. Please Select Media','cs_frame')?>
                                         <img src="<?php echo esc_url(get_template_directory_uri())?>/assets/images/admin/bg-arrowdown.png" alt="" /></div>
										<ul id="gal-sortable">
											<?php 
												global $cs_node, $counter;
												$counter_gal = 0;
                                                $cs_meta_gallery_options = get_post_meta((int)$post->ID, "cs_meta_gallery_options", true);
												
                                                if ( $cs_meta_gallery_options <> "" ) {
                                                    $cs_xmlObject = new SimpleXMLElement($cs_meta_gallery_options);
                                                        foreach ( $cs_xmlObject->children() as $cs_node ){
															if ( $cs_node->getName() == "gallery" ) {
																$counter_gal++;
																$counter = $post->ID.$counter_gal;
																cs_gallery_uoc();
															}
                                                        }
                                                }
                                            ?>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="to-social-list">
                                        <div class="soc-head">
                                            <h5><?php _e('Select Media','uoce');?></h5>
                                            <div class="right">
                                                <input type="button" class="button reload" value="Reload" onclick="refresh_media()" />
                                                <input id="cs_log" name="cs_logo" type="button" class="uploadfile button" value="Upload Media" />
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="clear"></div>
                                        <script type="text/javascript">
											function show_next(page_id, total_pages){
												var dataString = 'action=cs_media_pagination&page_id='+page_id+'&total_pages='+total_pages;
												jQuery("#pagination").html("<img src='<?php echo esc_url(get_template_directory_uri())?>/assets/images/admin/ajax_loading.gif' />");
												jQuery.ajax({
													type:'POST', 
													url: "<?php echo admin_url()?>/admin-ajax.php",
													data: dataString,
													success: function(response) {
														jQuery("#pagination").html(response);
													}
												});
											}
											function refresh_media(){
												var dataString = 'action=cs_media_pagination';
												jQuery("#pagination").html("<img src='<?php echo esc_url(get_template_directory_uri())?>/assets/images/admin/ajax_loading.gif' />");
												jQuery.ajax({
													type:'POST', 
													url: "<?php echo admin_url()?>/admin-ajax.php",
													data: dataString,
													success: function(response) {
														jQuery("#pagination").html(response);
													}
												});
											}
										</script>
        <script type="text/javascript" src="<?php echo esc_url(get_template_directory_uri())?>/assets/scripts/admin/prettyCheckable.js"></script>
                    <script type="text/javascript" src="<?php echo esc_url(get_template_directory_uri())?>/assets/scripts/admin/jquery.scrollTo-min.js"></script>
					<script>
                        jQuery(document).ready(function($) {
							$("#gal-sortable").sortable({
								cancel:'li div.poped-up',
							});
							//$(this).append("#gal-sortable").clone() ;
                            });
                            var counter = 0;
							var count_items = <?php echo esc_attr($counter_gal)?>;
							if ( count_items > 0 ) {
								jQuery(".dragareamain") .addClass("noborder");	
							}
							function clone(path){
								counter = counter + 1;
								var dataString = 'path='+path+'&counter='+counter+'&action=gallery_clone';
								
								jQuery("#gal-sortable").append("<li id='loading'><img src='<?php echo esc_url(get_template_directory_uri())?>/assets/images/admin/ajax_loading.gif' /></li>");
								jQuery.ajax({
									type:'POST', 
									url: "<?php echo admin_url()?>/admin-ajax.php",
									data: dataString,
									success: function(response) {
										jQuery("#loading").remove();
										jQuery("#gal-sortable").append(response);
										count_items = jQuery("#gal-sortable li") .length;
											if ( count_items > 0 ) {
												jQuery(".dragareamain") .addClass("noborder");	
											}
									}
								});
							}
                            function del_this(id){
                                jQuery("#"+id).remove();
								count_items = jQuery("#gal-sortable li") .length;
									if ( count_items == 0 ) {
										jQuery(".dragareamain") .removeClass("noborder");	
									}
                            }
                    </script>
					<script type="text/javascript">
                     var contheight;
                          function galedit(id){
                      var $ = jQuery;
                      $(".to-social-list,.gal-active h4.left,#gal-sortable li,#gal-sortable .thumb-secs") .not("#"+id) .fadeOut(200);
                      $.scrollTo( '.page-wrap', 400, {easing:'swing'} );
                            $('.poped-up').animate({
                             top: 0,
                            }, 300, function() {
                      $("#edit_" + id+" li")  .show(); 
                            $("#edit_" + id)   .slideDown(300); 
                            });
                           };
                           function galclose(id){
                      var $ = jQuery;
                      $("#edit_" + id) .slideUp(300);
                      $(".to-social-list,.gal-active h4.left,#gal-sortable li,#gal-sortable .thumb-secs")  .fadeIn(300);
                      };
                    
                    </script>                    
										<div id="pagination"><?php cs_media_pagination();?></div>
	                                    <input type="hidden" name="gallery_meta_form" value="1" />
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        
                    </div>
                    
                    
                       <div class="postbox " id="slugdiv_">
                        <div title="Click to toggle" class="handlediv"><br></div>
                        	<h3 class="hndle ui-sortable-handle"><span><?php _e('Description view layout','cs_frame')?></span></h3>
                        <div class="inside">
                        <label for="post_name" class="screen-reader-text"><?php _e('Description view layout','cs_frame')?></label>
                        	 &nbsp;&nbsp;
                                <select name="cs_description_view_layout" class="select_dropdown" >
                                    <option <?php if($cs_meta_gallery_meta_dec_view =="images_view")echo "selected";?> value="images_view"><?php _e('Images View','cs_frame')?></option>
                                    <option <?php if($cs_meta_gallery_meta_dec_view =="video_view")echo "selected";?> value="video_view"><?php _e('Carousel View','cs_frame')?></option>
                                </select>
                                <p><?php _e('Please select Gallery Description style layout.','cs_frame')?></p>        
                            
                        	</div>
                        </div>
                        
                        
                        <div class="postbox " id="slugdiv_">
                        	<div title="Click to toggle" class="handlediv"><br></div>
                        		<h3 class="hndle ui-sortable-handle"><span><?php _e('Pagination','cs_frame')?></span></h3>
                               
                               <div class="inside">
                                  <label for="post_name" class="screen-reader-text"><?php _e('Pagination','cs_frame')?>  </label>
                                	&nbsp;&nbsp;
                                    <select name="cs_pagination_display" class="select_dropdown" >
                                        <option <?php if($cs_pagination_display =="yes")echo "selected";?>  value="yes"><?php _e('Yes','cs_frame')?></option>
                                        <option <?php if($cs_pagination_display =="no")echo "selected";?>  value="no"><?php _e('No','cs_frame')?></option>
                                    </select>
                            	</div>
                               <h3 class="hndle ui-sortable-handle"><span><?php _e('Record per page','cs_frame')?> </span></h3>
                               <div class="inside">
                                	<label for="post_name" class="screen-reader-text"><?php _e('Record per page','cs_frame')?> </label>
                                    &nbsp;&nbsp;
                                    <input type="text" value="<?php echo esc_attr($cs_meta_field_pagination_per_page);?>" 
                                    id="cs_meta_field_pagination_per_page" size="13" name="cs_meta_field_pagination_per_page">
                            	</div>
                                
                                
                                
                                
                        </div>
                        
                        
                        
                        
                        
                        
                      
                <?php
			}
			// adding Gallery meta info end
			// saving Gallery meta start
			if ( isset($_POST['gallery_meta_form']) and $_POST['gallery_meta_form'] == 1 ) {
				add_action( 'save_post', 'cs_meta_gallery_options' );
				function cs_meta_gallery_options( $cs_post_id )
				{
					
					$counter = 0;
					$sxe = new SimpleXMLElement("<gallery_options></gallery_options>");
						if ( isset($_POST['path']) ) {
							
							foreach ( $_POST['path'] as $count ) {
								//die("in loop");
								$gallery = $sxe->addChild('gallery');
									$gallery->addChild('path', $_POST['path'][$counter] );
									$gallery->addChild('title', htmlspecialchars($_POST['title'][$counter]) );
									$gallery->addChild('description', htmlspecialchars($_POST['description'][$counter]) );
									$gallery->addChild('image_link_url', htmlspecialchars($_POST['image_link_url'][$counter]) );
									$gallery->addChild('readmore_link_url', htmlspecialchars($_POST['readmore_link_url'][$counter]) );
									$gallery->addChild('use_image_as', $_POST['use_image_as'][$counter] );
									$gallery->addChild('video_code', htmlspecialchars($_POST['video_code'][$counter]) );
									$gallery->addChild('link_url', htmlspecialchars($_POST['link_url'][$counter]) );
									$counter++;
							}
							
						
						}
						
						 
					update_post_meta( $cs_post_id, 'cs_meta_gallery_options', $sxe->asXML() );
					update_post_meta( $cs_post_id, 'cs_meta_gallery_meta_dec_view', $_POST['cs_description_view_layout'] );
					update_post_meta( $cs_post_id, 'cs_meta_field_pagination_per_page', $_POST['cs_meta_field_pagination_per_page'] ); // record per page
					update_post_meta( $cs_post_id, 'cs_pagination_display', $_POST['cs_pagination_display'] ); // paging display or not
					
				}
			}
			// saving Gallery meta end
	// Gallery end
?>