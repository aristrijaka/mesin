<?php

	global $cs_node,$post,$cs_theme_option,$counter_node,$wpdb,$cs_gal_album,$cs_gal_media_per_page,$cs_gal_pagination;
	
	if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;
        $args = array('posts_per_page' => "-1", 'post_type' => 'cs_gallery','post_status' => 'publish','cs_gallery-category' => $cs_gal_album);
		$custom_query = new WP_Query($args);
		$post_count = $custom_query->post_count;
	  	
		$args = array('posts_per_page' => $cs_gal_media_per_page, 'post_type' => 'cs_gallery', 'paged' => $_GET['page_id_all'],'cs_gallery-category' => $cs_gal_album);
	    $query = new WP_Query($args);
		$width = '243';
		$height = '137';
		$post_count = $query->post_count;
		
	 ?>
     <div class="cs-gallery plain">
            <div class="row">
          <?php if($query->have_posts()):
				$qrystr= "";
				$width 	=764;
				$height	=440;
				
					if ( isset($_GET['page_id']) ) $qrystr = "&page_id=".$_GET['page_id'];
						while ($query->have_posts()) : $query->the_post();
							$pos_class = '';
							$image_url = cs_attachment_image_src(get_post_thumbnail_id($post->ID),$width,$height);
							if($image_url == ''){ 
								$pos_class = 'no-img';}else{ $pos_class = 'post-img';
							}
							
							$cs_meta_gallery_options = get_post_meta((int)$post->ID, "cs_meta_gallery_options", true);
							
							if ( $cs_meta_gallery_options <> "" ) {
								$cs_xmlObject = new SimpleXMLElement($cs_meta_gallery_options);
								$count_post_gallery = count($cs_xmlObject->gallery);
							}
							?>
							
							<article class="col-md-4">
                                <figure>
                                    <a href="<?php the_permalink();?>">
                                    	<img src="<?php echo esc_url($image_url);?>" alt="">
                                    </a>
                                    <figcaption>
                                   	 	<span><?php echo cs_allow_special_char($count_post_gallery);?> Photos</span>
                                    </figcaption>
                                </figure>
                                <h6><a href="<?php esc_url(the_permalink());?>" ><?php echo substr(get_the_title(), 0, 35); if(strlen(get_the_title())>35) echo '...'; ?></a></h6>
							</article>
						<?php endwhile; 
					endif;?>
           <?php
			$qrystr = '';
			if ( $cs_gal_pagination == "On" and $post_count > $cs_gal_media_per_page  and $cs_gal_media_per_page > 0 ) {
				$qrystr = '';
				if ( isset($_GET['page_id']) ) $qrystr = "&page_id=".$_GET['page_id'];						
				echo cs_pagination( $post_count, $cs_gal_media_per_page,$qrystr );
			}
		// pagination end
		?>
        
         <div class="clear"></div>   
     </div>
   </div>   
      <!-- Latest Video End -->
      <!--<div class="clear"></div>
	</div>-->      
                  