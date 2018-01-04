<?php


//======================================================================
// Team html form for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_team_post' ) ) {
    function cs_pb_team_post($die = 0){
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
            $PREFIX = 'cs_team_post';
            $parseObject     = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
        }
        $defaults = array('cs_team_post_section_title'=>'','cs_team_post_orderby'=>'DESC','cs_team_post_description'=>'yes','cs_team_post_excerpt'=>'255','cs_team_post_num_post'=>'10','cs_team_style' =>'','team_post_pagination'=>'');
            if(isset($output['0']['atts']))
                $atts = $output['0']['atts'];
            else 
                $atts = array();
            $team_post_element_size = '50';
            foreach($defaults as $key=>$values){
                if(isset($atts[$key]))
                    $$key = $atts[$key];
                else 
                    $$key =$values;
             }
            $name = 'cs_pb_team_post';
            $coloumn_class = 'column_'.$team_post_element_size;
        	if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
				$shortcode_element = 'shortcode_element_class';
				$shortcode_view = 'cs-pbwp-shortcode';
				$filter_element = 'ajax-drag';
				$coloumn_class = '';
       		}
    ?>
    <div id="<?php echo esc_attr( $name.$cs_counter );?>_del" class="column parentdelete <?php echo esc_attr( $coloumn_class );?> <?php echo esc_attr( $shortcode_view );?>" item="team_post" data="<?php echo cs_element_size_data_array_index($team_post_element_size)?>">
      <?php cs_element_setting($name,$cs_counter,$team_post_element_size);?>
      <div class="cs-wrapp-class-<?php echo intval( $cs_counter )?> <?php echo esc_attr( $shortcode_element );?>" id="<?php echo esc_attr( $name.$cs_counter )?>" data-shortcode-template="[cs_team_post {{attributes}}]"  style="display: none;">
        <div class="cs-heading-area">
              <h5><?php _e('Edit Team Options', 'cs_frame') ?></h5>
              <a href="javascript:removeoverlay('<?php echo esc_js( $name.$cs_counter );?>','<?php echo esc_js( $filter_element );?>')" class="cs-btnclose"><i class="icon-times"></i></a>
          </div>
        <div class="cs-pbwp-content">
              <div class="cs-wrapp-clone cs-shortcode-wrapp">
                <?php
                 if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
                    <ul class="form-elements">
                        <li class="to-label"><label><?php _e('Section Title','cs_frame');?></label></li>
                        <li class="to-field">
                            <input  name="cs_team_post_section_title[]" type="text"  value="<?php echo esc_attr( $cs_team_post_section_title )?>"   />
                        </li>                  
                     </ul>
                   <ul class="form-elements">
                        <li class="to-label">
                          <label><?php _e('Team Styles','cs_frame');?></label>
                        </li>
                        <li class="to-field">
                          <div class="input-sec">
                            <div class="select-style">
        <select name="cs_team_style[]" class="dropdown" >
     <option <?php if($cs_team_style=="grid")echo "selected";?> value="grid"><?php _e('Grid','cs_frame');?></option>
     <option <?php if($cs_team_style=="modern")echo "selected";?> value="modern"><?php _e('Modern','cs_frame');?></option>
     <option <?php if($cs_team_style=="listing")echo "selected";?> value="listing"><?php _e('Listing','cs_frame');?></option>
     <option <?php if($cs_team_style=="color")echo "selected";?> value="color"><?php _e('Color Listing','cs_frame');?></option><option <?php if($cs_team_style=="slider")echo "selected";?> value="slider"><?php _e('slider','cs_frame');?></option>
      <option <?php if($cs_team_style=="simple")echo "selected";?> value="simple"><?php _e('simple','cs_frame');?></option>
    </select>
                            </div>
                          </div>
                        </li>
                      </ul>
                      <ul class="form-elements">
                        <li class="to-label">
                          <label><?php _e('Post Order','cs_frame');?></label>
                        </li>
                        <li class="to-field">
                          <div class="input-sec">
                            <div class="select-style">
                              <select name="cs_team_post_orderby[]" class="dropdown" >
                                <option <?php if($cs_team_post_orderby=="ASC")echo "selected";?> value="ASC"><?php _e('Asc','cs_frame');?></option>
                                <option <?php if($cs_team_post_orderby=="DESC")echo "selected";?> value="DESC"><?php _e('DESC','cs_frame');?></option>
                              </select>
                            </div>
                          </div>
                        </li>
                      </ul>
                      <ul class="form-elements">
                        <li class="to-label">
                          <label><?php _e('Post Description','cs_frame');?></label>
                        </li>
                        <li class="to-field">
                          <div class="input-sec">
                            <div class="select-style">
                              <select name="cs_team_post_description[]" class="dropdown" >
                                <option <?php if($cs_team_post_description=="yes")echo "selected";?> value="yes"><?php _e('Yes','cs_frame');?></option>
                                <option <?php if($cs_team_post_description=="no")echo "selected";?> value="no"><?php _e('No','cs_frame');?></option>
                              </select>
                            </div>
                          </div>
                        </li>
                      </ul>
                      
                      <ul class="form-elements">
                        <li class="to-label">
                          <label><?php _e('Length of Excerpt','cs_frame');?></label>
                        </li>
                        <li class="to-field">
                          <div class="input-sec">
                            <input type="text" name="cs_team_post_excerpt[]" class="txtfield" value="<?php echo esc_attr( $cs_team_post_excerpt );?>" />
                          </div>
                          <div class="left-info">
                            <p><?php _e('Enter number of character for short description text.','cs_frame');?></p>
                          </div>
                        </li>
                      </ul>

                    <ul class="form-elements">
                      <li class="to-label">
                        <label><?php _e('No. of Post Per Page','cs_frame');?></label>
                      </li>
                      <li class="to-field">
                        <div class="input-sec">
                          <input type="text" name="cs_team_post_num_post[]" class="txtfield" value="<?php echo esc_attr( $cs_team_post_num_post ); ?>" />
                        </div>
                        <div class="left-info">
                          <p><?php _e('To display all the records, leave this field blank.','cs_frame');?></p>
                        </div>
                      </li>
                    </ul>
                    <ul class="form-elements">
                      <li class="to-label">
                        <label><?php _e('Pagination','cs_frame');?></label>
                      </li>
                      <li class="to-field select-style">
                        <select name="team_post_pagination[]" class="dropdown">
                          <option <?php if($team_post_pagination=="Show Pagination")echo "selected";?> ><?php _e('Show Pagination','cs_frame');?></option>
                          <option <?php if($team_post_pagination=="Single Page")echo "selected";?> ><?php _e('Single Page','cs_frame');?></option>
                        </select>
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
                        	<input type="hidden" name="cs_orderby[]" value="team_post" />
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
    add_action('wp_ajax_cs_pb_team_post', 'cs_pb_team_post');
}