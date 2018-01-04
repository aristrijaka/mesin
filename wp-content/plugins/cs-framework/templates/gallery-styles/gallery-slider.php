<?php

	global $cs_node,$post,$cs_theme_option,$counter_node,$wpdb,$cs_gal_album,$cs_gal_media_per_page,$cs_gal_pagination;
	$post_ID = get_the_ID();
 
 $args = array('posts_per_page' => $cs_gal_media_per_page, 'post_type' => 'cs_gallery','cs_gallery-category' => $cs_gal_album);
  $query = new WP_Query($args);
 	while ($query->have_posts()) : $query->the_post();
	$cs_meta_gallery_options = get_post_meta((int)$post->ID, "cs_meta_gallery_options", true);
	endwhile;
  	
    $cs_xmlObject = new SimpleXMLElement($cs_meta_gallery_options);
	cs_enqueue_flexslider_script();
	?>
      <div class="col-md-12">
     <div class="flexslider cs-loading">
     	<div class="loader">Loading ...</div>
                <ul class="slides">
              <?php 
			  $counter_gal = 0;
			   foreach ( $cs_xmlObject->children() as $cs_node ){
							if ( $cs_node->getName() == "gallery" ) {
								$counter_gal++;
								$counter = $post->ID.$counter_gal;
								$title = $cs_node[0]->title;
								$description = $cs_node[0]->description;
								$readmore	= '';
								if(isset($cs_node[0]->readmore_link_url) && $cs_node[0]->readmore_link_url <> ""){
									
									 $readmore =  $cs_node[0]->readmore_link_url;
								}
								
								if(isset($cs_node[0]->image_link_url) && $cs_node[0]->image_link_url <> ""){
									    $imgLink= true;
									    $image_link_url = $cs_node[0]->image_link_url ;
								}else{
										$imgLink= false;
									    $image_link_url ='';
								}
								 
								if ( isset($_POST['counter']) ) $counter = $_POST['counter'];
								if ( isset($_POST['path']) ) $cs_node->path = $_POST['path'];
								if ( isset($_POST['description']) ) $cs_node->description = $_POST['description'];
								
								$video_width_large = 1060;
								$video_height_large = 460;
						 
						$image_path = wp_get_attachment_image_src( (int)$cs_node->path, array( $video_width_large,$video_height_large ) );?>
                      <li>
                        <img src="<?php echo esc_url($image_path[0])?>" alt="image"/>
                        <div class="slider-caption">
                        <?php if($title <> '') { ?>
                          <h1 style="color:#fff !important;"><?php echo cs_allow_special_char($title)?></h1>
                          <?php } ?>
                          <p><?php echo esc_html($description);?></p>
                          <a href="<?php echo esc_url($readmore);?>" target="_blank"><?php _e('Read More','uoce');?></a>
                        </div>
                      </li>
               	<?php			
					}
				}
			?>
                </ul>
              </div>
              </div>
 
	
							 
							
						
						
		 
	 