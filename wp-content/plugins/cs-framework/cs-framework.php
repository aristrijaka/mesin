<?php
/*
Plugin Name: CS Framework
Plugin URI: http://themeforest.net/user/Chimpstudio/
Description: Custom Post Types Management
Version: 1.1
Author: ChimpStudio
Author URI: http://themeforest.net/user/Chimpstudio/
License: GPL2
Copyright 2015  chimpgroup  (email : info@chimpstudio.co.uk)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, United Kingdom
*/

if(!class_exists('cs_framework'))
{
    class cs_framework
    {
		public $plugin_url;
		
        //=====================================================================
		// Construct
		//=====================================================================
        public function __construct()
        {
			global $post, $wp_query, $cs_frame_options;
			require_once('include/global-variables.php');
			$cs_frame_options = get_option('cs_frame_options');
			
			add_filter('template_include', array(&$this, 'cs_single_template'));
			add_action('wp_enqueue_scripts', array(&$this, 'cs_plugin_files_enqueue'));
			add_action('admin_enqueue_scripts', array(&$this, 'cs_plugin_files_enqueue'));
			
			add_action('init', array($this, 'load_plugin_textdomain'));	
			
			require_once('include/meta-boxes/form_meta_fields.php');
		  
			//Campus
			require_once('include/post-types/campus.php');	
		    require_once('include/meta-boxes/campus_meta.php');
		  
			//courses
			require_once('include/post-types/course.php');	
		    require_once('include/meta-boxes/course_meta.php');
			require_once('templates/course/course_element.php');
			require_once('templates/course/course_functions.php');
			
			// Events
			require_once('include/post-types/events.php');	
			require_once('include/meta-boxes/event_meta.php');
			require_once('templates/events/event_element.php');
			require_once('templates/events/event_functions.php');
			
			// Team
			require_once('include/post-types/teams.php');	
			require_once('include/meta-boxes/team_meta.php');
			require_once('templates/teams/team_element.php');
			require_once('templates/teams/team_functions.php');	
			 
		 	// Gallery
			require_once('include/post-types/gallery.php');	
			require_once('templates/gallery-styles/gallery_element.php');	
		 	require_once('templates/gallery-styles/gallery_functions.php');
			
			// Calander
			require_once('include/ical/iCalcreator.class.php');
			
			// Theme Importer
			require_once('include/cs-importer/theme_importer.php');
			require_once('include/cs-importer/class-widget-data.php');
			
			// Mailchimp Functions
			require_once('include/cs-mailchimp/mailchimp.class.php');
			require_once('include/cs-mailchimp/mailchimp_functions.php');
			
	    }
		
		/**
		 *
		 * @Text Domain
		 */
		public function load_plugin_textdomain() {
			
 			$cs_theme_options = get_option('cs_theme_options');	
			$languageFile = isset( $cs_theme_options['cs_language_file'] ) ? $cs_theme_options['cs_language_file'] : '';
			
			$locale	= apply_filters( 'plugin_locale', get_locale(), 'cs_frame' );
			$dir	= trailingslashit( WP_LANG_DIR );
 			
			if( isset( $languageFile ) && $languageFile != '' ) {
				load_textdomain( 'cs_frame',plugin_dir_path( __FILE__ ) . "languages/".$cs_theme_options['cs_language_file'] );
			} else {
				//load_textdomain( 'cs_frame', $dir . 'cs_frame-en_US.mo' );
			}
		}	
		
		/**
		 *
		 * @PLugin URl
		 */
		public static function plugin_url(){
			return plugin_dir_url( __FILE__ );
		}
				
		/**
		 *
		 * @Plugin Path
		 */
		public static function plugin_dir(){
			return plugin_dir_path( __FILE__ );
		}

        /**
		 *
		 * @Activate the plugin
		 */
		public static function activate()
        {	
			add_option( 'cs_frame_plugin_activation', 'installed' );
			add_option( 'cs_frame', '1' );
			add_action('init', 'cs_activation_data');
        } 
		
		/**
		 *
		 * @Deactivate the plugin
		 */
		static function deactivate()
        {
           delete_option( 'cs_frame_plugin_activation');
		   delete_option( 'cs_frame', false ); 
        } 

		/**
		 *
		 * @ Include Template
		 */
		public function cs_single_template( $single_template )
		{
			global $post;
			if ( is_single() ) {
				
				if ( get_post_type() == 'portfolios' ) { // for Portfolio single page
					$single_template = plugin_dir_path( __FILE__ ) . '/templates/portfolios/single-portfolio.php';
				}
				if ( get_post_type() == 'teams' ) { // for Team single page
					$single_template = plugin_dir_path( __FILE__ ) . '/templates/teams/single-team.php';
				}
				
				if ( get_post_type() == 'cs_gallery' ) { // for Gallery single page
					
					$single_template = plugin_dir_path( __FILE__ ) . '/templates/gallery-styles/single-gallery.php';
				}
				
				if ( get_post_type() == 'events' ) { // for events
					$single_template = plugin_dir_path( __FILE__ ) . '/templates/events/single-events.php';
				}
				if ( get_post_type() == 'course' ) { // for COURSE
					$single_template = plugin_dir_path( __FILE__ ) . '/templates/course/single-course.php';
				}
				
				
				
			}
			return $single_template;
		}
		
		/**
		 *
		 * @ Include Default Scripts and styles
		 */
		public function cs_plugin_files_enqueue(){
			wp_enqueue_media();
			wp_enqueue_script('my-upload', '', array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));
			
			if( ! is_admin()) {
				wp_enqueue_script('cs_frame_functions_js', plugins_url( '/assets/js/cs_frame_functions.js' , __FILE__ ), '', '', true );
			}
		}
		
		public static function cs_enqueue_timepicker_script() {
			
			if(is_admin()){
				wp_enqueue_script('cs_datetimepicker_js', plugins_url( '/assets/js/jquery_datetimepicker.js' , __FILE__ ), '', '', true);
				wp_enqueue_style('cs_datetimepicker_css', plugins_url( '/assets/css/jquery_datetimepicker.css' , __FILE__ ));
			}
		}
		
		
		 public static function cs_enqueue_gallery_script() {
			
			if(! is_admin()){
				wp_enqueue_script('cs_jquery_isotope_min_js', plugins_url( '/assets/js/jquery.isotope.min.js' , __FILE__ ), '', '', true );
				wp_enqueue_script('cs_frame_functions_js', plugins_url( '/assets/js/cs_frame_functions.js' , __FILE__ ), '', '', true );
				
			}
		}
		
		
		 public static function cs_enqueue_video_gallery_script() {
			
			if(! is_admin()){
				wp_enqueue_script('cs_jquery_flexslider_min_js', plugins_url( '/assets/js/jquery.flexslider-min.js' , __FILE__ ), '', '', true );
				wp_enqueue_style('cs_flexslider_css', plugins_url( '/assets/css/flexslider.css' , __FILE__ ));
				
			}
		}
		
		 public static function cs_enqueue_prettyphoto_script() {
			
			if(! is_admin()){
				wp_enqueue_script('cs_jquery_prettyPhoto_js', plugins_url( '/assets/js/jquery.prettyPhoto.js' , __FILE__ ), '', '', false );
				wp_enqueue_style('cs_prettyPhoto_script_css', plugins_url( '/assets/css/prettyPhoto.css' , __FILE__ ), '', '', false);
				wp_enqueue_script('cs_frame_functions_js', plugins_url( '/assets/js/cs_frame_functions.js' , __FILE__ ), '', '', true );
				
			}
		}
		
		 public static function cs_enqueue_full_calender_script() {
			
			if(! is_admin()){
				wp_enqueue_script('cs_jquery_prettyPhoto_js', plugins_url( '/assets/js/fullcalendar.min.js' , __FILE__ ), '', '', true );
				wp_enqueue_style('cs_prettyPhoto_script_css', plugins_url( '/assets/css/fullcalendar.css' , __FILE__ ), '', '', false);
			}
		}
		
		public static function cs_enqueue_countdown_script() {
			
			if(! is_admin()){
				wp_enqueue_script('cs_countdown_js', plugins_url( '/assets/js/jquery.countdown.js' , __FILE__ ), '', '', true );
			}
		  }
		}
	}

/**
 *
 * @Create Object of class To Activate Plugin
 */
 

if(class_exists('cs_framework'))
{
	$cs_frame = new cs_framework();
	register_activation_hook( __FILE__, array( 'cs_framework', 'activate' ));
	register_deactivation_hook( __FILE__, array('cs_framework', 'deactivate'));
}