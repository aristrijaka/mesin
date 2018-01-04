

var contheight;
function cs_amimate(id){
	var $ = jQuery;
	$("#"+id).animate({
		height: 'toggle'
		}, 1000, function() {
		// Animation complete.
	});
}

	function hide_all(id){
		var $ = jQuery;
		var itemmain=$("#"+id);
		$("#add_page_builder_item > div") .css({"transition":"none","-moz-transition":"none","-webkit-transition":"none","-o-transition":"none","-ms-transition":"none"});
		itemmain.css({"padding":0});
		itemmain.parent('.column') .css({"width":"100%"});
		var showdiv =itemmain.parents(".column"); 
		$(".column,.column-in,.page-builder,.elementhidden") .not(showdiv) .hide();
		itemmain.slideDown(600);
			$('html, body').animate({ scrollTop: itemmain.offset().top - 50}, 600);
		
		

 };
 function show_all(id){
   var $ = jQuery;
  var itemmain=$("#"+id);
    itemmain.slideUp(800);
	 setTimeout( function(){
	itemmain.parent('.column').css({"width":""});
	itemmain.css({"padding":""}); 
    },800);
		$(".column-in,.column,.page-builder,.elementhidden") .delay(800) .fadeIn(400,function(){
		
		$("#add_page_builder_item > div") .css({"transition":"width 500ms ease","-moz-transition":"width 500ms ease","-webkit-transition":"width 500ms ease","-o-transition":"width 500ms ease","-ms-transition":"width 500ms ease"}); 
	 });
	


 };
 
 function openpopedup(id){
  var $ = jQuery;
	$(".elementhidden,.opt-head,.option-sec,.to-table thead,.to-table tr")  .hide();
	$("#"+id) .parents("tr") .show();
	$("#"+id) .parents("td") .css("width","100%");
	$("#"+id) .parents("td") .prev() .hide();
	$("#"+id) .parents("td") .find("a.actions") .hide();
	$("#"+id).children(".opt-head") .show();
  $("#"+id).slideDown();
   
  $("#"+id).animate({
   top: 0,
  }, 400, function() {
   // Animation complete.
  });
  $.scrollTo( '#normal-sortables', 800, {easing:'swing'} );
 };
 
 function closepopedup(id){
  var $ = jQuery;
  $("#"+id).slideUp(800);

	$(".to-table tr") .css("width","");
	$(".elementhidden,.opt-head,.option-sec,.to-table thead,.to-table tr,a.actions,.to-table tr td").delay(600)  .fadeIn(200);
	
	$.scrollTo( '.elementhidden', 800, {easing:'swing'} );
 };

	function update_port_other(id){
		var val;
		val = jQuery('#port_other_info_title'+id).val();
		jQuery('#port-title'+id).html(val);
	}

	function update_title(id){
		var val;
		val = jQuery('#album_track_title'+id).val();
		jQuery('#album-title'+id).html(val);
	}
	function gll_search_map(){
		var vals;
		vals = jQuery('#loc_address').val();
		vals = vals + ", " + jQuery('#loc_city').val();
		vals = vals + ", " + jQuery('#loc_postcode').val();
		vals = vals + ", " + jQuery('#loc_region').val();
		vals = vals + ", " + jQuery('#loc_country').val();
		jQuery('.gllpSearchField').val(vals);
	}
	function hide_custom_color_scheme(id){
		if (id == "custom") {
			jQuery("#cs_color_scheme").slideDown("slow");
		}
		else jQuery("#cs_color_scheme").slideUp("slow");
	}
	function remove_image(id){
		var $ = jQuery;
		$('#'+id).val('');
		$('#'+id+'_img_div').hide();
		//$('#'+id+'_div').attr('src', '');
	}
	function track_toggle(id){
		title = jQuery('#album_track_title'+id).val();
		jQuery('#album-title'+id).html(title);
		jQuery('#edit_track_form'+id).toggle("slow");
	}
	function tab_close(){
		jQuery(".form-msgs").slideUp("slow");
	}
	function slideout(){
		setTimeout(function(){
			jQuery(".form-msg").slideUp("slow", function () {
			});
		}, 5000);
	}
	function slideout_msgs(){
		setTimeout(function(){
			jQuery("#newsletter_mess").slideUp("slow", function () {
			});
		}, 5000);
	}	
	function cs_div_remove(id){
		jQuery("#"+id).remove();
	}
	function cs_toggle(id){
		jQuery("#"+id).slideToggle("slow");
	}
	function toggle_with_value(id, value){
		if ( value == 0 ) jQuery("#"+id).hide("slow");
		else  jQuery("#"+id).show("slow");
	}
	function cs_toggle_tog(id){
		jQuery("#"+id).toggle();

	}
	function cs_toggle_height(value,id){
		var $ = jQuery;
		if (value == "Nivo Slider" || value == "Flex Slider"){
			jQuery("#"+id).addClass("no-display");
			jQuery("#choose_slider").show();
			jQuery("#layer_slider").hide();
		}
		else {
			jQuery("#"+id).removeClass("no-display");
			jQuery("#choose_slider").hide();
			jQuery("#layer_slider").show();
		}
	}
	function cs_toggle_class_page_element(id, counter){
		var $ = jQuery;
		if ( id == 'Home View'){
			jQuery("#var_pb_class_filterable").hide();
			jQuery("#var_pb_class_excerpt").hide();
		} else if ( id == 'Grid View'){
			jQuery("#var_pb_class_filterable").show();
			jQuery("#var_pb_class_excerpt").hide();
		} else {
			jQuery("#var_pb_class_excerpt").show();
			jQuery("#var_pb_class_filterable").show();
		}
		
		
	}
	
	function cs_toggle_timetable_meta(id){
		var $ = jQuery;
		if(id.length>0){
			jQuery(".timetablesec").hide();
			jQuery("#tab-"+id).show();
		}
		
	}
	
	function show_sidebar(id){
		var $ = jQuery;
		jQuery('input[name="cs_layout"]').change(function(){
			jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
			jQuery(this).siblings("label").children("#check-list").addClass("check-list");
		});
		if ( id == 'left'){
			jQuery("#sidebar_right").hide();
			jQuery("#sidebar_left").show();
		}
		else if ( id == 'right'){
			jQuery("#sidebar_left").hide();
			jQuery("#sidebar_right").show();
		}
		else if ( id == 'both'){
			jQuery("#sidebar_left").show();
			jQuery("#sidebar_right").show();
		}
		else if ( id == 'none'){
			jQuery("#sidebar_left").hide();
			jQuery("#sidebar_right").hide();
		}
	}
	function select_bg(){
		var $ = jQuery;
		jQuery('input[name="bg_img"]').change(function(){
			jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
			jQuery(this).siblings("label").children("#check-list").addClass("check-list");
		});
	}
	function select_bg2(){
		var $ = jQuery;
		jQuery('input[name="default_header"]').change(function(){
			jQuery(this).parents(".to-field").find("span").removeClass("check-list");
			jQuery(this).siblings("label").children("#check-list").addClass("check-list");
		});
	}
	function select_pattern(){
		var $ = jQuery;
		jQuery('input[name="pattern_img"]').change(function(){
			jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
			jQuery(this).siblings("label").children("#check-list").addClass("check-list");
		});
	}
	function fun_header_styles(id,url){
		var $ = jQuery;
                var imgUrl = url+'/images/admin/'+id+'.png';
		if ( id == "header1" ){
			$("#header_banner1, #header_banner2, #header_banner3, #header_banner4, #header_banner5, #header_banner6, #header_banner7, #header_banner8, #header_banner9, #header_banner10, #header_banner11, #header_banner12").fadeOut(200);
			$("#header_banner1").fadeIn(200);
                        $("#header_preview_img").html("<img src='"+imgUrl+"'/>");
		}
		else if ( id == "header2" ){
			$("#header_banner1, #header_banner2, #header_banner3, #header_banner4, #header_banner5, #header_banner6, #header_banner7, #header_banner8, #header_banner9, #header_banner10, #header_banner11, #header_banner12").fadeOut(200);
			$("#header_banner2").fadeIn(200);
                        $("#header_preview_img").html("<img src='"+imgUrl+"'/>");
		}
		else if ( id == "header3" ){
			$("#header_banner1, #header_banner2, #header_banner3, #header_banner4, #header_banner5, #header_banner6, #header_banner7, #header_banner8, #header_banner9, #header_banner10, #header_banner11, #header_banner12").fadeOut(200);
			$("#header_banner3").fadeIn(200);
                        $("#header_preview_img").html("<img src='"+imgUrl+"'/>");
		}
		else if ( id == "header4" ){
			$("#header_banner1, #header_banner2, #header_banner3, #header_banner4, #header_banner5, #header_banner6, #header_banner7, #header_banner8, #header_banner9, #header_banner10, #header_banner11, #header_banner12").fadeOut(200);
			$("#header_banner4").fadeIn(200);
                        $("#header_preview_img").html("<img src='"+imgUrl+"'/>");
		}
        else if ( id == "header5" ){
			$("#header_banner1, #header_banner2, #header_banner3, #header_banner4, #header_banner5, #header_banner6, #header_banner7, #header_banner8, #header_banner9, #header_banner10, #header_banner11, #header_banner12").fadeOut(200);
			$("#header_banner5").fadeIn(200);
                        $("#header_preview_img").html("<img src='"+imgUrl+"'/>");
		}
        else if ( id == "header6" ){
			$("#header_banner1, #header_banner2, #header_banner3, #header_banner4, #header_banner5, #header_banner6, #header_banner7, #header_banner8, #header_banner9, #header_banner10, #header_banner11, #header_banner12").fadeOut(200);
			$("#header_banner6").fadeIn(200);
                        $("#header_preview_img").html("<img src='"+imgUrl+"'/>");
		}
		 else if ( id == "header7" ){
			$("#header_banner1, #header_banner2, #header_banner3, #header_banner4, #header_banner5, #header_banner6, #header_banner7, #header_banner8, #header_banner9, #header_banner10, #header_banner11, #header_banner12").fadeOut(200);
			$("#header_banner7").fadeIn(200);
                        $("#header_preview_img").html("<img src='"+imgUrl+"'/>");
		}
                else if ( id == "header8" ){
			$("#header_banner1, #header_banner2, #header_banner3, #header_banner4, #header_banner5, #header_banner6, #header_banner7, #header_banner8, #header_banner9, #header_banner10, #header_banner11, #header_banner12").fadeOut(200);
			$("#header_banner8").fadeIn(200);
                        $("#header_preview_img").html("<img src='"+imgUrl+"'/>");
		}
		else if ( id == "header9" ){
			$("#header_banner1, #header_banner2, #header_banner3, #header_banner4, #header_banner5, #header_banner6, #header_banner7, #header_banner8, #header_banner9, #header_banner10, #header_banner11, #header_banner12").fadeOut(200);
			$("#header_banner9").fadeIn(200);
                        $("#header_preview_img").html("<img src='"+imgUrl+"'/>");
		}
		else if ( id == "header10" ){
			$("#header_banner1, #header_banner2, #header_banner3, #header_banner4, #header_banner5, #header_banner6, #header_banner7, #header_banner8, #header_banner9, #header_banner10, #header_banner11, #header_banner12").fadeOut(200);
			$("#header_banner10").fadeIn(200);
                        $("#header_preview_img").html("<img src='"+imgUrl+"'/>");
		}
                else if ( id == "header11" ){
			$("#header_banner1, #header_banner2, #header_banner3, #header_banner4, #header_banner5, #header_banner6, #header_banner7, #header_banner8, #header_banner9, #header_banner10, #header_banner11, #header_banner12").fadeOut(200);
			$("#header_banner11").fadeIn(200);
                        $("#header_preview_img").html("<img src='"+imgUrl+"'/>");
		}
                else if ( id == "header12" ){
			$("#header_banner1, #header_banner2, #header_banner3, #header_banner4, #header_banner5, #header_banner6, #header_banner7, #header_banner8, #header_banner9, #header_banner10, #header_banner11, #header_banner12").fadeOut(200);
			$("#header_banner12").fadeIn(200);
                        $("#header_preview_img").html("<img src='"+imgUrl+"'/>");
		}

		jQuery('input[name="header_styles"]').change(function(){
			jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
			jQuery(this).siblings("label").children("#check-list").addClass("check-list");
		});
	}
	function cs_toggle_gal(id, counter){
		if (id==0){
			jQuery("#link_url"+counter).hide();
			jQuery("#video_code"+counter).hide();
		}
		else if (id==1){
			jQuery("#link_url"+counter).hide();
			jQuery("#video_code"+counter).show();
		}
		else if (id==2){
			jQuery("#link_url"+counter).show();
			jQuery("#video_code"+counter).hide();
		}
	}

	function toggle_header_banner(id){
		if (id=="Default Image"){
			jQuery("#default_image, #custom_image, #layer_slider").hide();
			jQuery("#default_image").show();
		}
		else if(id=="Slider"){
			jQuery("#default_image, #custom_image, #layer_slider").hide();
			jQuery("#layer_slider").show();
		}
		else if(id=="Custom Image"){
			jQuery("#default_image, #custom_image, #layer_slider").hide();
			jQuery("#custom_image").show();
		}
		else {
			jQuery("#default_image, #custom_image, #layer_slider").hide();
			
		}
	}
	function toggle_pricetable_style(id){
		if (id=="style3"){
			jQuery("ul#price_pakage").show();
		}
		else {
			jQuery("ul#price_pakage").hide();
			
		}
	}
	function parallax_element(id,counter){
		jQuery("#map_form"+counter+", #custom_form"+counter+ ", #twitter_form"+counter + ", #album_form"+counter + ", #photo_album_form"+counter + ", #gallery_form"+counter ).hide();
  		if (id=="twitter"){
			jQuery("#twitter_form"+counter).show();
		}
		else if (id=="map"){
			jQuery("#map_form"+counter).show();
		}
		else if (id=="custom"){
			jQuery("#custom_form"+counter).show();
		}
		else if (id=="album"){
			jQuery("#album_form"+counter).show();
		}
		else if (id=="photo_album"){
			jQuery("#photo_album_form"+counter).show();
		}
		else if (id=="gallery"){
			jQuery("#gallery_form"+counter).show();
		}

	}

	function new_toggle(id){
		if (id=="Single Image"){
			jQuery("#post_thumb_image, #post_thumb_audio, #post_thumb_video, #post_thumb_slider, #post_thumb_map").hide();
			jQuery("#post_thumb_image").show();
		}
		else if (id=="Audio"){
			jQuery("#post_thumb_image, #post_thumb_audio, #post_thumb_video, #post_thumb_slider, #post_thumb_map").hide();
			jQuery("#post_thumb_audio").show();
		}
		else if (id=="Video"){
			jQuery("#post_thumb_image, #post_thumb_audio, #post_thumb_video, #post_thumb_slider, #post_thumb_map").hide();
			jQuery("#post_thumb_video").show();
		}
		else if (id=="Slider"){
			jQuery("#post_thumb_image, #post_thumb_audio, #post_thumb_video, #post_thumb_slider, #post_thumb_map").hide();
			jQuery("#post_thumb_slider").show();
		}
		else if (id=="Map"){
			jQuery("#post_thumb_image, #post_thumb_audio, #post_thumb_video, #post_thumb_slider, #post_thumb_map").hide();
			jQuery("#post_thumb_map").show();
		}
		else jQuery("#post_thumb_image, #post_thumb_audio, #post_thumb_video, #post_thumb_slider, #post_thumb_map").hide();
	}
	function new_toggle_inside_post(id){
		if (id=="Single Image"){
			jQuery("#inside_post_thumb_image, #inside_post_thumb_audio, #inside_post_thumb_video, #inside_post_thumb_slider, #inside_post_thumb_map").hide();
			jQuery("#inside_post_thumb_image").show();
		}
		else if (id=="Audio"){
			jQuery("#inside_post_thumb_image, #inside_post_thumb_audio, #inside_post_thumb_video, #inside_post_thumb_slider, #inside_post_thumb_map").hide();
			jQuery("#inside_post_thumb_audio").show();
		}
		else if (id=="Video"){
			jQuery("#inside_post_thumb_image, #inside_post_thumb_audio, #inside_post_thumb_video, #inside_post_thumb_slider, #inside_post_thumb_map").hide();
			jQuery("#inside_post_thumb_video").show();
		}
		else if (id=="Slider"){
			jQuery("#inside_post_thumb_image, #inside_post_thumb_audio, #inside_post_thumb_video, #inside_post_thumb_slider, #inside_post_thumb_map").hide();
			jQuery("#inside_post_thumb_slider").show();
		}
		else if (id=="Map"){
			jQuery("#inside_post_thumb_image, #inside_post_thumb_audio, #inside_post_thumb_video, #inside_post_thumb_slider, #inside_post_thumb_map").hide();
			jQuery("#inside_post_thumb_map").show();
		}
		else jQuery("inside_post_thumb_image, #inside_post_thumb_audio, #inside_post_thumb_video, #inside_post_thumb_slider, #inside_post_thumb_map").hide();
	}

		var counter = 0;
		function delete_this(id){
				jQuery('#'+id).remove();
				jQuery('#'+id+'_del').remove();
				count_widget--;
				if (count_widget < 1)jQuery("#add_page_builder_item").addClass("hasclass");
				}

		var Data = [
			{ "Class" : "column_100" , "title" : "100" , "element" : ["gallery", "slider", "blog", "news", "event", "album", "review", "recipe", "testimonial", "team", "client", "contact", "column", "divider", "message_box", "image_frame", "map", "video", "quote", "dropcap", "pricetable","services", "tabs", "accordion", "prayer", "advance_search", "parallax", "now_playing"] },
			{ "Class" : "column_75" , "title" : "75" , "element" : ["gallery", "slider", "blog", "news", "event", "album", "review", "recipe", "testimonial", "team", "client", "contact", "column", "divider", "message_box", "image_frame", "map", "video", "quote", "dropcap", "pricetable","services", "tabs", "accordion", "advance_search", "prayer", "now_playing"] },
			{ "Class" : "column_50" , "title" : "50" , "element" : ["gallery", "slider", "blog", "news", "event", "album", "review", "recipe", "testimonial", "team", "client", "contact", "column", "divider", "message_box", "image_frame", "map", "video", "quote", "dropcap", "pricetable","services", "tabs", "accordion", "advance_search", "prayer", "now_playing"] },
			{ "Class" : "column_33" , "title" : "33" , "element" : ["column", "blog"] },
			{ "Class" : "column_25" , "title" : "25" , "element" : ["column", "divider", "message_box", "image_frame", "map", "video", "quote", "dropcap","pricetable","services","pastor", "now_playing"] },
			
		];
		function decrement(id){
			var $ = jQuery;
			var parent,ColumnIndex,CurrentWidget,CurrentColumn,module;
			parent = $(id).parent('.column-in');
			parent = $(parent).parent('.column');
			CurrentColumn = parseInt($(parent).attr('data'));
			CurrentWidget = $(parent).attr('widget');
			ColumnIndex = parseInt($(parent).attr('data'));
			module = $(parent).attr('item').toString();
			for(i = ColumnIndex + 1; i < Data.length; i++){
				for(c = 0; c <= Data[i].element.length; c++){
					if(Data[i].element[c] == module ){
						$(parent).removeClass(Data[ColumnIndex].Class)
						$(parent).addClass(Data[i].Class)
						$(parent).find('.ClassTitle').text(Data[i].title);
						$(parent).find('.item').val(Data[i].title);
						$(parent).find('.columnClass').val(Data[i].Class)
						$(parent).attr('data',i);
						return false;
					}
				}
			}
		}
        function increment(id){
			var $ = jQuery;
            var parent,ColumnIndex,CurrentWidget,CurrentColumn,module;
			parent = $(id).parent('.column-in');
			parent = $(parent).parent('.column');
            CurrentColumn = parseInt($(parent).attr('data'));
            CurrentWidget = $(parent).attr('widget');
            ColumnIndex = parseInt($(parent).attr('data'));
            module = $(parent).attr('item').toString();
				if(ColumnIndex > 0){
				for(i = ColumnIndex - 1; i < Data.length; i--){//
					for(c = 0; c <= Data[i].element.length; c++){
						if(Data[i].element[c] == module ){
							$(parent).removeClass(Data[ColumnIndex].Class)
							$(parent).addClass(Data[i].Class)
							$(parent).find('.ClassTitle').text(Data[i].title);
							$(parent).find('.item').val(Data[i].title);
							$(parent).attr('data',i);
							return false;
						}
					}
				}
			}
        }
		 function cs_to_restore_default(admin_url, theme_url){
			//jQuery(".loading_div").show('');
			var var_confirm = confirm("You current theme options will be replaced with the default theme activation options.");
			if ( var_confirm == true ){
				var dataString = 'action=cs_theme_option_restore_default';
				jQuery.ajax({
					type:"POST",
					url: admin_url+"/admin-ajax.php",
					data: dataString,
					success:function(response){
						jQuery(".form-msg").show();
						jQuery(".form-msg").html(response);
						jQuery(".loading_div").hide();
						window.location.reload();
						slideout();
					}
				});
			}
            //return false;
		}

        function cs_to_backup(admin_url, theme_url){
			//jQuery(".loading_div").show('');
			var var_confirm = confirm("Are you sure! you want to take your current theme option backup?");
			if ( var_confirm == true ){
				var dataString = 'action=cs_theme_option_backup';
				jQuery.ajax({
					type:"POST",
					url: admin_url+"/admin-ajax.php",
					data: dataString,
					success:function(response){
						parts = response.split("@");
						jQuery("#last_backup_taken").html(parts[1]);
						jQuery(".form-msg").show();
						jQuery(".form-msg").html(parts[0]);
						jQuery(".loading_div").hide();
						window.location.reload();
						slideout();
					}
				});
			}
            //return false;
		}

        function cs_to_backup_restore(admin_url, theme_url){
			//jQuery(".loading_div").show('');
			var var_confirm = confirm("Are you sure! you want to replace your current theme options with your last backup?");
			if ( var_confirm == true ){
				var dataString = 'action=cs_theme_option_backup_restore';
				jQuery.ajax({
					type:"POST",
					url: admin_url+"/admin-ajax.php",
					data: dataString,
					success:function(response){
						jQuery(".form-msg").show();
						jQuery(".form-msg").html(response);
						jQuery(".loading_div").hide();
						window.location.reload();
						slideout();
					}
				});
			}
            //return false;
		}

        function cs_to_import_export(admin_url, theme_url){
			//jQuery(".loading_div").show('');
			var var_confirm = confirm("Are you sure! you want to import this theme options?");
			if ( var_confirm == true ){
				var theme_option_data = jQuery("#theme_option_data").val();
				var dataString = 'action=cs_theme_option_import_export&theme_option_data=' + theme_option_data;
				jQuery.ajax({
					type:"POST",
					url: admin_url+"/admin-ajax.php",
					data: dataString,
					success:function(response){
						jQuery(".form-msg").show();
						jQuery(".form-msg").html(response);
						jQuery(".loading_div").hide();
						window.location.reload();
						slideout();
					}
				});
				//return false;
			}
        }
		
        function cs_theme_option_save(admin_url, theme_url){
			jQuery(".loading_div").show('');
            jQuery.ajax({
                type:"POST",
                url: admin_url+"/admin-ajax.php",
				data:jQuery('#frm').serialize(), 
                success:function(response){
                    jQuery(".form-msg").show();
                    jQuery(".form-msg").html(response);
                    jQuery(".loading_div").hide();
					window.location.reload();
                    slideout();
                }
            });
            //return false;
        }

		var counter_subject = 0;
        function cs_add_item_to_list(admin_url, theme_url){
			counter_subject++;
			var dataString = 'counter_subject=' + counter_subject + 
							'&subject_title=' + jQuery("#subject_title_dummy").val() +
							//'&subject_instructor=' + jQuery("#subject_instructor").val() +
							//'&subject_credit=' + jQuery("#subject_credit").val() + 
							//'&subject_class_timing=' + jQuery("#subject_class_timing").val() +
							'&rating_value=' + jQuery("#rating_value").val() +
							'&action=cs_add_item_to_list';
			jQuery("#loading").html("<img src='"+theme_url+"/images/admin/ajax_loading.gif' />");
            jQuery.ajax({
                type:"POST",
                url: admin_url+"/admin-ajax.php",
				data: dataString,
                success:function(response){
					jQuery("#total_tracks").append(response);
					jQuery("#loading").html("");
					closepopedup('add_item');
						jQuery("#subject_title_dummy").val("Item Title");
						//jQuery("#subject_instructor").val("");
						//jQuery("#subject_credit").val("");
						//jQuery("#subject_class_timing").val("");
						jQuery("#rating_value").val("");
                }
            });
            //return false;
        }

		var counter_port_project = 0;
		var count_port_project_js = 0;
        function cs_add_port_project(admin_url, theme_url){
			counter_port_project++;
			count_port_project_js++;
			if ( count_port_project_js > 0 ) jQuery("#port_project_header").show("");
			var dataString = 'counter_port_project=' + counter_port_project + 
							'&port_other_info_title=' + jQuery("#port_other_info_title_dummy").val() +
							'&port_other_info_desc=' + jQuery("#port_other_info_desc").val() +
							'&port_other_info_icon=' + jQuery("#port_other_info_icon").val() +
							'&action=cs_add_port_project';
			jQuery("#loading").html("<img src='"+theme_url+"/images/admin/ajax_loading.gif' />");
            jQuery.ajax({
                type:"POST",
                url: admin_url+"/admin-ajax.php",
				data: dataString,
                success:function(response){
					jQuery("#port_other_info_title_dummy").val("");
					jQuery("#port_other_info_desc").val("");
					jQuery("#port_other_info_icon").val("");
					jQuery("#total_port_project").append(response);
					jQuery("#loading").html("");
					closepopedup('add_port_other');
                }
            });
            //return false;
        }

		var counter_ingredient = 0;
					jQuery("a.add_accordion") .live('click',function(){
						var mainConitem=jQuery(this) .parents(".wrapptabbox");
						var appendtoItem=mainConitem.find(".clone_append") ;
						var newElement =jQuery("<div class='clone_form'> \
								<a href='#' class='deleteit_node'>Delete it</a> \
								<label>Tab Title:</label> <input class='txtfield' type='text' name='accordion_title[]' /> \
								<label>Tab Text:</label> <textarea class='txtfield' name='accordion_text[]'></textarea> \
								<label>Title Icon:</label> <input class='txtfield' type='text' name='accordion_title_icon[]' /> \
								<label>Active</label> <select name='accordion_active[]'><option>no</option><option>yes</option></select> \
							</div>")
						appendtoItem.append(newElement);
						newElement.focus();
						newElement.hide().fadeIn(300);
						var totalItemCon = mainConitem.find(".clone_form") .size();
						mainConitem.find(".fieldCounter") .val(totalItemCon);
						return false;
					
					});

					jQuery("a.addedtab") .live('click',function(){
						var mainConitem=jQuery(this) .parents(".wrapptabbox");
						var appendtoItem=mainConitem.find(".clone_append") ;
						var newElement =jQuery("<div class='clone_form'> \
								<a href='#' class='deleteit_node'>Delete it</a> \
								<label>Tab Title:</label> <input class='txtfield' type='text' name='tab_title[]' /> \
								<label>Tab Text:</label> <textarea class='txtfield' name='tab_text[]'></textarea> \
								<label>Title Icon:</label> <input class='txtfield' type='text' name='tab_title_icon[]' /> \
								<label>Active</label> <select name='tab_active[]'><option>no</option><option>yes</option></select> \
							</div>")
						appendtoItem.append(newElement);
						newElement.focus();
						newElement.hide().fadeIn(300);
						var totalItemCon = mainConitem.find(".clone_form") .size();
						mainConitem.find(".fieldCounter") .val(totalItemCon);
						return false;
					
					});

					// services start
					jQuery("a.add_services") .live('click',function(){
						var mainConitem=jQuery(this) .parents(".wrapptabbox");
						var appendtoItem=mainConitem.find(".clone_append") ;
						var newElement =jQuery("<div class='clone_form'> \
								<a href='#' class='deleteit_node'>Delete it</a> \
								<label>Service Title:</label> <input class='txtfield' type='text' name='service_title[]' /> \
								<label>Service Icon:</label> <input class='txtfield' type='text' name='service_icon[]' /> \
								<label>Link URL:</label> <input class='txtfield' type='text' name='service_url[]' /> \
								<label>Service Text:</label> <textarea class='txtfield' name='service_text[]'></textarea> \
								<label>Style:</label> <select name='service_style[]'><option>service1</option><option>service2</option><option>service3</option><option>service4</option></select> \
							</div>")
						appendtoItem.append(newElement);
						newElement.focus();
						newElement.hide().fadeIn(300);
						var totalItemCon = mainConitem.find(".clone_form") .size();
						mainConitem.find(".fieldCounter") .val(totalItemCon);
						return false;
					
					});
					// services end
					
					// testimonial start
					jQuery("a.added_testimonial") .live('click',function(){
						var mainConitem=jQuery(this) .parents(".wrapptabbox");
						var appendtoItem=mainConitem.find(".clone_append") ;
						var newElement =jQuery("<div class='clone_form'> \
								<a href='#' class='deleteit_node'>Delete it</a> \
								<label>Title:</label> <input class='txtfield' type='text' name='testimonial_title[]' /> \
								<label>Text:</label> <textarea class='txtfield' name='testimonial_text[]'></textarea> \
								<label>Company:</label> <input class='txtfield' type='text' name='testimonial_company[]' /> \
								<label>Image:</label> <input class='txtfield' type='text' name='testimonial_img[]' /> \
							</div>")
						appendtoItem.append(newElement);
						newElement.focus();
						newElement.hide().fadeIn(300);
						var totalItemCon = mainConitem.find(".clone_form") .size();
						mainConitem.find(".fieldCounter") .val(totalItemCon);
						return false;
					
					});
					// testimonial end

					// team start
					jQuery("a.added_team") .live('click',function(){
						var mainConitem=jQuery(this) .parents(".wrapptabbox");
						var appendtoItem=mainConitem.find(".clone_append") ;
						var newElement =jQuery("<div class='clone_form'> \
								<a href='#' class='deleteit_node'>Delete it</a> \
								<label>Name:</label> <input class='txtfield' type='text' name='team_name[]' /> \
								<label>Image URL:</label> <input class='txtfield' type='text' name='team_image_url[]' /> \
								<label>Designation:</label> <input class='txtfield' type='text' name='team_designation[]' /> \
								<label>Facebook:</label> <input class='txtfield' type='text' name='team_fb[]' /> \
								<label>Twitter:</label> <input class='txtfield' type='text' name='team_twitter[]' /> \
								<label>LinkedIn:</label> <input class='txtfield' type='text' name='team_in[]' /> \
							</div>")
						appendtoItem.append(newElement);
						newElement.focus();
						newElement.hide().fadeIn(300);
						var totalItemCon = mainConitem.find(".clone_form") .size();
						mainConitem.find(".fieldCounter") .val(totalItemCon);
						return false;
					
					});
					// team end

					// deleting the accordion start
					jQuery("a.deleteit_node") .live('click',function(){
							var mainConitem=jQuery(this) .parents(".wrapptabbox");
							jQuery(this).parent() .append("<div id='confirmOverlay' style='display:block'> \
								<div id='confirmBox'><div id='confirmText'>Are you sure to do this?</div> \
								<div id='confirmButtons'><div class='button confirm-yes'>Delete</div>\
								<div class='button confirm-no'>Cancel</div><br class='clear'></div></div></div>");
								jQuery(this) .parents(".clone_form").addClass("warning");
						jQuery(".confirm-yes").click(function(){
							var totalItemCon = mainConitem.find(".clone_form").size();
							mainConitem.find(".fieldCounter") .val(totalItemCon-1);
							jQuery(this) .parents(".clone_form").fadeOut(400,function(){
									jQuery(this).remove();								
								});
							
							jQuery("#confirmOverlay") .remove();
						});
				
					jQuery(".confirm-no") .click(function(){
						jQuery(".clone_form") .removeClass("warning");
						jQuery("#confirmOverlay") .remove();	
					});
						return false;
					});

					//page Builder items delete start
					jQuery(".btndeleteit") .live("click",function(){
					jQuery(this) .parents(".parentdelete") .addClass("warning");
							jQuery(this).parent() .append("<div id='confirmOverlay' style='display:block'> \
								<div id='confirmBox'><div id='confirmText'>Are you sure to delete?</div> \
								<div id='confirmButtons'><div class='button confirm-yes'>Delete</div>\
								<div class='button confirm-no'>Cancel</div><br class='clear'></div></div></div>");
								
						jQuery(".confirm-yes").click(function(){
							jQuery(this) .parents(".parentdelete").fadeOut(400,function(){
									jQuery(this).remove();								
								});
							jQuery("#confirmOverlay") .remove();
							count_widget--;
							if (count_widget == 0) jQuery("#add_page_builder_item").removeClass("hasclass");
						});
					jQuery(".confirm-no") .click(function(){
					jQuery(this) .parents(".parentdelete") .removeClass("warning");	
					jQuery("#confirmOverlay") .remove();	
					});
					return false;
					});
					//page Builder items delete end
					

// media pop-up start
jQuery(document).ready(function(){
var count_widget = jQuery("#add_page_builder_item > .column").length;
	if (count_widget > 0) {
		jQuery("#add_page_builder_item").addClass("hasclass");
	}
	jQuery('input[type=file].file') .bind('change focus click',function(){
     var a =jQuery(this).val();
     jQuery(this).next(".fakefile").find("input[type='text']").val(a);
    });
     jQuery(".uploadfile").live('click',function(){
      jQuery(".loadClass").trigger('click');
      jQuery(this).prev().addClass('pathlink');
      setInterval(watchTextbox, 100); 
     });
     function watchTextbox() {
      var txtInput = jQuery('.headerClass');
      var lastValue = jQuery("input[type=text].pathlink") .val();;
      var currentValue = txtInput.val();
      var popup = jQuery('#TB_overlay') .length;
      if(popup == 0){
       jQuery("input.testing") .removeClass('pathlink');
       return false;  
      }
      if(currentValue == 0){
       return false; 
      }
      if (lastValue != currentValue) {
       jQuery("input[type=text].pathlink") .val(currentValue);
      
      if(currentValue != ""){
       jQuery("input.testing") .removeClass('pathlink');
      }
       jQuery('.headerClass').val(''); 
       clearInterval(setInterval(watchTextbox, 100));
      }
     }
    });
// media pop-up end
// layer slider show / hide
function home_slider_toggle(id){
		if ( id == "") {
			jQuery("#other_sliders, #layer_slider").hide();
		}
		else if ( id == "Revolution Slider") {
			jQuery("#other_sliders").hide();
			jQuery("#layer_slider").show("");
		}
		else {
			jQuery("#layer_slider").hide();
			jQuery("#other_sliders").show("");
		}
	}
// related title on/off start
function related_title_toggle_inside_post(id){
	if(id.checked == true){
		jQuery("#related_post").show();
	}
 	else {
		jQuery("#related_post").hide();
	}
}
// realated title on/off end

		var counter_track = 0;
        function add_track_to_list(admin_url, theme_url){
			counter_track++;
			var dataString = 'counter_track=' + counter_track + 
							'&var_cp_title=' + jQuery("#var_cp_title").val() +
							'&var_cp_image_url=' + jQuery("#var_cp_image_url").val() +
							'&var_cp_url=' + jQuery("#var_cp_url").val() + 
					
							'&action=cs_add_track_to_list';
			jQuery("#loading").html("<img src='"+theme_url+"/images/admin/ajax_loading.gif' />");
            jQuery.ajax({
                type:"POST",
                url: admin_url+"/admin-ajax.php",
				data: dataString,
                success:function(response){
					jQuery("#total_tracks").append(response);
					jQuery("#loading").html("");
					closepopedup('add_track');
						jQuery("#var_cp_title").val("Title");
						jQuery("#var_cp_image_url").val("");
						jQuery("#var_cp_url").val("");
						
                }
            });
            //return false;
        }
		var counter_times = 0;
             function add_time_to_list(admin_url, theme_url){
			
			counter_track++;
			var timetable_class = jQuery("#var_cp_timetable_class_value").val();
			var timetable_day = jQuery("#var_cp_timetable_day").val();
			var timetable_start_tim = jQuery("#var_cp_timetable_start_time").val();
			var timetable_end_tim = jQuery("#var_cp_timetable_end_time").val();
			
			var timetable_start_tim_compare_value = timetable_start_tim.replace(":", ""); // value = 9:61
			var timetable_end_tim_compare_value = timetable_end_tim.replace(":", "");
			
			var timetable_start_tim_value = timetable_start_tim.substr(0, 2);
			var timetable_end_tim_value = timetable_end_tim.substr(0, 2);
			
			var timetable_start_tim_value = timetable_start_tim_value + '00';
			var timetable_end_tim_value = timetable_end_tim_value + '00';
			
			/*var timetable_start_tim_value = timetable_start_tim.replace(":", ""); // value = 9:61
			 var timetable_end_tim_value = timetable_end_tim.replace(":", "");*/
			//alert(timetable_start_tim+'======'+timetable_end_tim);
			var timedifferance = calculateTime(timetable_start_tim, timetable_end_tim)
			
			//var diff =  new Date(timetable_start_tim) - new Date(timetable_end_tim);
			
			//alert(diff);
			
			if(timetable_start_tim_compare_value>timetable_end_tim_compare_value){
				alert('Please enter differant timings');
				return false;
			}
			// can then use it as
			var dataString = 'counter_times=' + counter_times + 
							'&var_cp_timetable_class=' + jQuery("#var_cp_timetable_class_value").val() +
							'&var_cp_timetable_day=' + jQuery("#var_cp_timetable_day").val() +
							'&var_cp_timetable_start_time=' + jQuery("#var_cp_timetable_start_time").val() +
							'&var_cp_timetable_end_time=' + jQuery("#var_cp_timetable_end_time").val() + 
							'&action=cs_add_time_to_list';
			jQuery("#loading").html("<img src='"+theme_url+"/images/admin/ajax_loading.gif' />");
            jQuery.ajax({
                type:"POST",
                url: admin_url+"/admin-ajax.php",
				data: dataString,
                success:function(response){
					
					var hours = ["00:00","01:00","02:00","03:00","04:00","05:00","06:00","07:00","08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"];
					
					if(timetable_start_tim_value=="2300"){
							var next_hour = "0000";
							var tr_id = timetable_start_tim_value+"-"+next_hour;
							var td_id = timetable_start_tim_value+"-"+next_hour+"-"+timetable_day;
					} else {
						for ( var i = 0; i < hours.length; i++ ) {
							
							
							if(hours[ i ].replace(":", "")==timetable_start_tim_value && hours[i+1].replace(":", "")==timetable_end_tim_value){
								var tr_id = timetable_start_tim_value+"-"+timetable_end_tim_value;
								var td_id = timetable_start_tim_value+"-"+timetable_end_tim_value+"-"+timetable_day;
								break;
							} else if(hours[ i ].replace(":", "")==timetable_start_tim_value) {
								var next_hour = hours[i+1].replace(":", "");
								var tr_id = timetable_start_tim_value+"-"+next_hour;
								var td_id = timetable_start_tim_value+"-"+next_hour+"-"+timetable_day;
								
							}
	
						}
					}
					
					if(jQuery("#timetable #row-"+td_id).length<1){
					var d = timetable_start_tim.substr(0, 2);
					var e = timetable_end_tim.substr(0, 2);
					var f = timetable_day;
					jQuery(".timetablesec td[data-weekday='"+f+"']") .each(function(){
							var a = jQuery(this) .data("start");
							var b = jQuery(this) .data("end");
							var c = jQuery(this) .data("weekday");
							if (a!="" && b!=""){
							if (d >= a.substr(0, 2) && e<=b.substr(0, 2) ){
							jQuery(this).append(response);
							return false;
							}
							 else if (d >= a.substr(0, 2) && e>=b.substr(0, 2)){
							
								jQuery(".timetablesec td[data-weekday='"+f+"']") .each(function(){
									var h = jQuery(this) .data("end");
									if (h !="") {
										if (h < b){
										return false;
									}
									}
									return false;
								});
								jQuery(this).append(response);
								return false;
								
							}
							}
							
						});						

						//return false;
					}
					
					jQuery(".timetablesec").show();
					jQuery("#timetable").show();
					jQuery("#timetable #row-"+tr_id).show();
					//jQuery("#timetable #row-"+td_id).val("");
						
					jQuery("#timetable #row-"+td_id).append(response);
					jQuery("#loading").html("");
					//closepopedup('add_track');

                }
            });
            //return false;
        }
	 function calculateTime(valuestart, valuestop) {
       
             var timeStart = new Date("01/01/2007 " + valuestart).getMinutes();
             var timeEnd = new Date("01/01/2007 " + valuestop).getMinutes();
			
             	return hourDiff = timeEnd - timeStart;    
         
             
    }
	function cs_table_td_remove(id ){
			jQuery("#"+id ).html("");
	}

// adding social network start
	function social_icon_del(id){
		jQuery("#del_"+id).remove();
		jQuery("#"+id).remove();
	}

	var counter_social_network = 0;
	function cs_add_social_icon(admin_url){
		counter_social_network++;
		var social_net_icon_path = jQuery("#social_net_icon_path_input").val();
		var social_net_awesome = jQuery("#social_net_awesome_input").val();
		var social_net_url = jQuery("#social_net_url_input").val();
		var social_net_tooltip = jQuery("#social_net_tooltip_input").val();
		if ( social_net_url != "" && (social_net_icon_path != "" || social_net_awesome != "" ) ) {
			var dataString = 'social_net_icon_path=' + social_net_icon_path + 
							'&social_net_awesome=' + social_net_awesome +
							'&social_net_url=' + social_net_url +
							'&social_net_tooltip=' + social_net_tooltip +
							'&counter_social_network=' + counter_social_network +
							'&action=cs_add_social_icon';
			//jQuery("#loading").html("<img src='"+theme_url+"/images/admin/ajax_loading.gif' />");
            jQuery.ajax({
                type:"POST",
                url: admin_url+"/admin-ajax.php",
				data: dataString,
                success:function(response){
					jQuery("#social_network_area").append(response);
					jQuery("#social_net_icon_path_input").val("");
					jQuery("#social_net_awesome_input").val("");
					jQuery("#social_net_url_input").val("");
					jQuery("#social_net_tooltip_input").val("");
                }
            });
            //return false;
		}
	}
	var counter_opening_timming = 0;
	function cs_add_timing(admin_url){
		counter_opening_timming++;
		var var_to_day = jQuery("#var_to_day_input").val();
 		var var_to_time = jQuery("#var_to_time_input").val();
		if ( var_to_day != "" && (var_to_time != "" ) ) {
			var dataString = 'var_to_day=' + var_to_day + 
							'&social_net_awesome=' + social_net_awesome +
							'&var_to_time=' + var_to_time +
							'&counter_opening_timming=' + counter_opening_timming +
  							'&action=cs_add_timing';
			//jQuery("#loading").html("<img src='"+theme_url+"/images/admin/ajax_loading.gif' />");
            jQuery.ajax({
                type:"POST",
                url: admin_url+"/admin-ajax.php",
				data: dataString,
                success:function(response){
					jQuery("#cs_opening_timing").append(response);
					jQuery("#var_to_day_input").val("");
					jQuery("#var_to_time_input").val("");
                 }
            });
            //return false;
		}
	}
	// shortcode
function cs_shortocde_selection(){
	
	jQuery("#sc_select").change(function() {
	var v = jQuery("#sc_select :selected").val();
	if(v == 'toogle'){
			  send_to_editor('[toggle active="yes" title="Toggle Title 1"]Toggle Content 1[/toggle]<br /><br />');
	  }
	else if(v == 'tabs'){
			  send_to_editor('[tab] <br />\
				  [tab_item active="yes" icon="fa-twitter" title="Tab Title 1" tabs="tabs"]Tab Content 1[/tab_item]<br />\
				  [tab_item icon="" title="Tab Title 2" tabs="tabs"]Tab Content 2[/tab_item]<br />\
				  [tab_item icon="" title="Tab Title 3" tabs="tabs"]Tab Content 3[/tab_item]<br />\
				  [/tab]<br /><br />');
	  }
	else if(v == 'accordion'){
			  send_to_editor('[accordion] <br />\
				  [accordion_item active="yes" icon="fa-twitter" title="Accordion Title 1" accordion="accordion"]Accordion Content 1[/accordion_item] <br />\
				  [accordion_item title="Accordion Title 2" accordion="accordion"]Accordion Content 2[/accordion_item] <br />\
				  [accordion_item title="Accordion Title 3" accordion="accordion"]Accordion Content 3[/accordion_item] <br />\
				  [/accordion]<br /><br />');
	  }
	else if(v == 'divider'){
			  send_to_editor('[divider style="divider1" backtotop="yes" top_margin="20" bottom_margin="20"]<br /><br />');
	  }
	
	else if(v == 'quote'){
			  send_to_editor('[quote align="center" color="#COLOR_CODE"]Quote Content[/quote]<br /><br />');
	  }
	else if(v == 'button'){
			  send_to_editor('[button style="medium" type="rounded" color="#COLOR_CODE" background="#COLOR_CODE" src="LINK_URL" target="_blank"]Button Content[/button]<br /><br />');
	  }
	else if(v == 'column'){
			  send_to_editor('[column size="1/2"]Column Content[/column]<br /><br />');
	  }
	else if(v == 'dropcap'){
			  send_to_editor('[dropcap style="1"]Dropcap Content[/dropcap]<br /><br />');
	  }
	else if(v == 'message_box'){
			  send_to_editor('[message_box type="info/warning" align="left" icon="fa-check-circle" close="yes" color="#COLOR_CODE" background="#COLOR_CODE" border_color="#COLOR_CODE" box_shadow_color="#COLOR_CODE" title="Message Title"]Message Content[/message_box]');
	  }
	
	
	else if(v == 'table'){
			  send_to_editor('[table color="#Color_Code"]<br />\
					  [thead]<br />\
						[tr]<br />\
						  [th]Column 1[/th]<br />\
						  [th]Column 2[/th]<br />\
						  [th]Column 3[/th]<br />\
						  [th]Column 4[/th]<br />\
						[/tr]<br />\
					  [/thead]<br />\
					  [tbody]<br />\
						[tr]<br />\
						  [td]Item 1[/td]<br />\
						  [td]Item 2[/td]<br />\
						  [td]Item 3[/td]<br />\
						  [td]Item 4[/td]<br />\
						[/tr]<br />\
						[tr]<br />\
						  [td]Item 11[/td]<br />\
						  [td]Item 22[/td]<br />\
						  [td]Item 33[/td]<br />\
						  [td]Item 44[/td]<br />\
						[/tr]<br />\
					  [/tbody]<br />\
			   [/table]<br /><br />');
	  }
	else if(v == 'heading'){
			  send_to_editor('[heading size="1" color="#fff000"]Heading Text[/heading]<br /><br />');
	  }
	else if(v == 'highlight'){
			  send_to_editor('[hightlight background="#e32028" color="#fff"]Highlight text[/hightlight]<br /><br />');
	  }
	
	else if(v == 'video'){
			  send_to_editor('[video-item url="" width="400" height="250"][/video-item]<br /><br />');
	  }
	
	else if(v == 'testimonials'){
			  send_to_editor('[testimonials]<br />\
			  [testimonial_item time="22 August 2013" image="image-url" name="John Deo" testimonial="testimonial"]Content 1[/testimonial_item]<br />\
			  [testimonial_item time="22 August 2013" image="image-url" name="John Deo" testimonial="testimonial"]Content 2[/testimonial_item]<br />\
			  [testimonial_item time="22 August 2013" image="image-url" name="John Deo" testimonial="testimonial"]Content 3[/testimonial_item]<br />\
			  [/testimonials]<br /><br />');
	}
	else if(v == 'team'){
			  send_to_editor('[team-sec]<br />\
			  [team name="JOHN DOE" job="CEO" email="abc@example.com" image=""]<br />\
			  [content]Team content 1[/content]<br />\
			  [social_links]<br />\
			  [social link="#" target="_blank" icon="fa-facebook-square" tabs="tabs"]<br />\
			  [social link="#" target="_blank" icon="fa-twitter-square" tabs="tabs"]<br />\
			  [/social_links]<br />\
			  [/team]<br />\
			  [team name="JOHN DOE" job="CEO" image=""]<br />\
			  [content]Team content 2[/content]<br />\
			  [social_links]<br />\
			  [social link="#" target="_blank" icon="fa-facebook-square" tabs="tabs"]<br />\
			  [social link="#" target="_blank" icon="fa-twitter-square" tabs="tabs"]<br />\
			  [/social_links]<br />\
			  [/team]<br />\
			  [/team-sec]<br /><br />');
	}
	
	else if(v == 'opening_time'){
			  send_to_editor('[opening_time][/opening_time]<br /><br />');
	}
	else if(v == 'price_tables'){
			  send_to_editor('[price-tables view="price-style1"]<br />\
			  [price-item title="Basic" price="49" currency="$" footer_text=""]<br />\
			  [content]Price Table Detail[/content]<br />\
			  [/price-item]<br />\
			  [price-item title="Monthly" price="149" currency="$" footer_text=""]<br />\
			  [content]Price Table Detail[/content]<br />\
			  [/price-item]<br />\
			  [price-item title="Advance" price="249" currency="$" footer_text=""]<br />\
			  [content]Price Table Detail[/content]<br />\
			  [/price-item]<br />\
			  [price-item title="Yearly" price="649" currency="$" footer_text=""]<br />\
			  [content]Price Table Detail[/content]<br />\
			  [/price-item]<br />\
			  [/price-tables]<br /><br />');
	}
	return false;
	});
}