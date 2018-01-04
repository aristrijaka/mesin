<?php


//======================================================================
// Blog html form for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_gallery' ) ) { 
    function cs_pb_gallery($die = 0){
        global $cs_node, $post;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $counter = $_POST['counter'];
        $cs_counter = $_POST['counter'];
        if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes ($shortcode_element_id);
            $PREFIX = 'cs_gallery';
            $parseObject     = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX ); 
        }
      
		$defaults = array('cs_gal_header_title'=>'','cs_gal_layout'=>'','cs_gal_album'=>'','cs_gal_desc'=>'','cs_gal_pagination'=>'','cs_gal_media_per_page'=>'');
		
            if(isset($output['0']['atts']))
                $atts = $output['0']['atts'];
            else 
                $atts = array();
            $gallery_element_size = '50';
            foreach($defaults as $key=>$values){
                if(isset($atts[$key]))
                    $$key = $atts[$key];
                else 
                    $$key =$values;
             }
            $name = 'cs_pb_gallery';
            $coloumn_class = 'column_'.$gallery_element_size;
        	if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
				$shortcode_element = 'shortcode_element_class';
				$shortcode_view = 'cs-pbwp-shortcode';
				$filter_element = 'ajax-drag';
				$coloumn_class = '';
       		}
    ?>
    <div id="<?php echo esc_attr( $name.$cs_counter );?>_del" class="column  parentdelete <?php echo esc_attr( $coloumn_class );?> <?php echo esc_attr( $shortcode_view );?>" item="blog" data="<?php echo cs_element_size_data_array_index($gallery_element_size)?>">
      <?php cs_element_setting($name,$cs_counter,$gallery_element_size);?>
      <div class="cs-wrapp-class-<?php echo intval( $cs_counter )?> <?php echo esc_attr( $shortcode_element );?>" id="<?php echo esc_attr( $name.$cs_counter )?>" data-shortcode-template="[cs_gallery {{attributes}}]"  style="display: none;">
            <div class="cs-heading-area">
              <h5><?php _e('Edit Gallery Options', 'cs_frame') ?></h5>
              <a href="javascript:removeoverlay('<?php echo esc_js( $name.$cs_counter );?>','<?php echo esc_js( $filter_element );?>')" class="cs-btnclose"><i class="icon-times"></i></a>
          </div>
          
          
        
          
            <div class="cs-pbwp-content">
              <div class="cs-wrapp-clone cs-shortcode-wrapp">
                <?php
                 if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
                    <ul class="form-elements">
                        <li class="to-label"><label><?php _e('Header Title','cs_frame');?></label></li>
                        <li class="to-field">
                            <input  name="cs_gal_header_title[]" type="text"  value="<?php echo esc_attr( $cs_gal_header_title )?>"   />
                        </li>                  
                     </ul>
                     
                    
                       
                 <ul class="form-elements">
                      <li class="to-label">
                        <label><?php _e('Choose Gallery Layout','cs_frame');?></label>
                      </li>
                      <li class="to-field">
                        <div class="input-sec">
                          <div class="select-style"> 
                            <select name="cs_gal_layout[]" class="dropdown">
                                <option value="gallery-small" <?php if($cs_gal_layout=="gallery-small")echo "selected";?> ><?php _e('Small Gallery','cs_frame');?></option>
                                <option value="gallery-medium" <?php if($cs_gal_layout=="gallery-medium")echo "selected";?> ><?php _e('Medium Gallery','cs_frame');?></option>
                                 <option value="gallery-slider" <?php if($cs_gal_layout=="gallery-slider")echo "selected";?> ><?php _e('Gallery Slider','cs_frame');?></option>
                              
                           </select>
                          </div>
                        </div>
                        <div class="left-info">
                          <p><?php _e('Please select Gallery Layout. If you dont select category it will display all posts','cs_frame');?></p>
                        </div>
                      </li>
                    </ul>
                       
                       
                    <ul class="form-elements">
                      <li class="to-label">
                        <label><?php _e('Choose Gallery Album','cs_frame');?></label>
                      </li>
                      <li class="to-field">
                        <div class="input-sec">
                          <div class="select-style">
                           
                           
                                <select name="cs_gal_album[]" class="dropdown">
                                <option value="0"><?php _e('Select Gallery Album','cs_frame');?></option>
                                <?php
                                $categories = get_categories( array('taxonomy' => 'cs_gallery-category', 'hide_empty' => 0) );
									foreach ($categories as $category) {
									?>
										<option <?php if($category->slug==$cs_gal_album)echo "selected";?> value="<?php echo esc_html($category->slug); ?>">
											<?php echo esc_html($category->cat_name)?>
										</option>
									<?php
									}
                                ?>
                                </select>
                           
                           </div>
                        </div>
                        <div class="left-info">
                          <p><?php _e('Please select Gallery.','cs_frame');?></p>
                        </div>
                      </li>
                   </ul>
                       
                    <ul class="form-elements">
                      <li class="to-label">
                        <label><?php _e('Gallery Pagination','cs_frame');?></label>
                      </li>
                      <li class="to-field">
                        <div class="input-sec">
                          <div class="select-style">
                            <select name="cs_gal_pagination[]" class="dropdown">
                            <option <?php if($cs_gal_pagination=="On")echo "selected";?> ><?php _e('On','cs_frame');?></option>
                            <option <?php if($cs_gal_pagination=="Off")echo "selected";?> ><?php _e('Off','cs_frame');?></option>
                        </select>
                          </div>
                        </div>
                        <div class="left-info">
                          <p><?php _e('Please Select Discription.','cs_frame');?></p>
                        </div>
                      </li>
                   </ul>
                     
                   
                   
                   <ul class="form-elements">
                        <li class="to-label"> <label><?php _e('No. of Post Per Page','cs_frame');?></label></li>
                        <li class="to-field">
                            <input  name="cs_gal_media_per_page[]" type="text"  value="<?php echo esc_attr( $cs_gal_media_per_page )?>"   />
                        </li>                  
                     </ul>
                   
                <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
                    <ul class="form-elements insert-bg">
                      <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js( str_replace('cs_pb_','',$name) );?>','<?php echo esc_js( $name.$cs_counter )?>','<?php echo esc_js( $filter_element );?>')" ><?php _e('Insert','cs_frame');?></a> </li>
                    </ul>
                    <div id="results-shortocde"></div>
                    <?php } else {?>
                    
                    
                    
                    <ul class="form-elements">
                        <li class="to-label"></li>
                        <li class="to-field">
                        	<input type="hidden" name="cs_orderby[]" value="gallery" />
                            <input type="button" value="<?php _e('Save','cs_frame');?>" style="margin-right:10px;" onclick="javascript:_removerlay(jQuery(this))" />
                        </li>
                    </ul>
                <?php }?>
              </div>
        </div>
        
        
        
        
        
      </div>
    </div>
<?php
        if ( $die <> 1 ) die();
    }
    add_action('wp_ajax_cs_pb_gallery', 'cs_pb_gallery');
}