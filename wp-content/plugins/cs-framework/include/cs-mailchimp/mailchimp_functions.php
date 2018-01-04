<?php


/** 
 * @Mailchimp List
 */
if ( ! function_exists( 'cs_mailchimp_list' ) ) {
	function cs_mailchimp_list($apikey){
		global $cs_theme_options;
		$MailChimp = new MailChimp($apikey);
		$mailchimp_list = $MailChimp->call('lists/list');
		return $mailchimp_list;
	}
}

/** 
 * @custom mail chimp form
 */
/*if ( ! function_exists( 'cs_custom_mailchimp' ) ) {
	function cs_custom_mailchimp($description = ''){
		global $cs_theme_options;
		$counter = rand(423,23343490);
		
		if(isset($description) and $description <> ''){
			echo '<p>'.$description.'</p>';
        }*/
		
   
  if ( ! function_exists( 'cs_custom_mailchimp' ) ) {
	function cs_custom_mailchimp(){
		global $cs_theme_options,$counter;
				$counter++;
				
      ?>
              
			<script>
				function cs_mailchimp_submit(theme_url,counter,admin_url){
				
				'use strict';
				$ = jQuery;
				//$('#btn_newsletter_'+counter).hide();
				$('#process_'+counter).html('<div id="process_newsletter_'+counter+'"><i class="icon-refresh icon-spin" style="float:right;margin:12px 0px 0px 0px;"></i></div>');
						$.ajax({
							type:'POST', 
							url: admin_url,
							data:$('#mcform_'+counter).serialize()+'&action=cs_mailchimp', 
							success: function(response) {
							$('#mcform_'+counter).get(0).reset();
							$('#newsletter_mess_'+counter).fadeIn(600);
							$('#newsletter_mess_'+counter).html(response);
							$('#btn_newsletter_'+counter).fadeIn(600);
							$('#process_'+counter).html('');
						}
					});
				}
            </script>
            
            
                <div id ="process_newsletter_<?php echo intval($counter);?>"  class="col-md-9">
                	<div id="process_<?php echo intval($counter);?>" class="cs-show-msg"> </div>
               		  <span class="newsletter-title"><?php echo  __('Subscribe Weekly Newsletter','cs_frame');?></span>     
               		  <div id="newsletter_mess_<?php echo intval($counter);?>" style="display:none" class="cs-error-msg"></div> 
                
                
                <form class="newsletter-from" action="javascript:cs_mailchimp_submit('<?php echo get_template_directory_uri()?>','<?php echo esc_js($counter); ?>','<?php echo admin_url('admin-ajax.php'); ?>')" id="mcform_<?php echo intval($counter);?>" method="post">
                


<i class="icon-envelope4"></i> 
<input id="cs_list_id" type="hidden" name="cs_list_id" value="<?php if(isset($cs_theme_options['cs_mailchimp_list'])){ echo esc_attr($cs_theme_options['cs_mailchimp_list']); }?>" />
<input type="text" id="mc_email"  name="mc_email" placeholder=" <?php _e('Enter Valid Email Address','cs_frame'); ?>"   >

<input type="submit" id="btn_newsletter_<?php echo intval($counter);?>"   value="<?php _e('Submit','cs_frame'); ?>">




                </form>
                </div>  
        <?php        
	}
}