<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.acekyd.com
 * @since      1.0.0
 *
 * @package    Display_Medium_Posts
 * @subpackage Display_Medium_Posts/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Display_Medium_Posts
 * @subpackage Display_Medium_Posts/admin
 * @author     AceKYD <acekyd01@gmail.com>
 */
class Display_Medium_Posts_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->display_medium_posts_options = get_option($this->plugin_name);

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Display_Medium_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Display_Medium_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( 'settings_page_display-medium-posts' == get_current_screen() -> id ) {
             // CSS stylesheet for Color Picker
             wp_enqueue_style( 'wp-color-picker' );            
             wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/display-medium-posts-admin.css', array( 'wp-color-picker' ), $this->version, 'all' );
         }


	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Display_Medium_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Display_Medium_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( 'settings_page_display-medium-posts' == get_current_screen() -> id ) {
            wp_enqueue_media();   
            wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/display-medium-posts-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );         
        }

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	 
	public function add_plugin_admin_menu() {

	    /*
	     * Add a settings page for this plugin to the Settings menu.
	     *
	     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
	     *
	     *        Administration Menus: http://codex.wordpress.org/Administration_Menus
	     *
	     */
	    add_options_page( 'Display Medium Posts', 'Medium Posts', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
	    );
	}

	 /**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	 
	public function add_action_links( $links ) {
	    /*
	    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
	    */
	   $settings_link = array(
	    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	 
	public function display_plugin_setup_page() {
	    include_once( 'partials/display-medium-posts-admin-display.php' );
	}

	public function options_update() {
	    register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	 }

	public function validate($input) {
	    // All checkboxes inputs        
	    $valid = array();

	    //Cleanup
	    $valid['cleanup'] = (isset($input['cleanup']) && !empty($input['cleanup'])) ? 1 : 0;
	    $valid['comments_css_cleanup'] = (isset($input['comments_css_cleanup']) && !empty($input['comments_css_cleanup'])) ? 1: 0;
	    $valid['gallery_css_cleanup'] = (isset($input['gallery_css_cleanup']) && !empty($input['gallery_css_cleanup'])) ? 1 : 0;
	    $valid['body_class_slug'] = (isset($input['body_class_slug']) && !empty($input['body_class_slug'])) ? 1 : 0;
	    $valid['jquery_cdn'] = (isset($input['jquery_cdn']) && !empty($input['jquery_cdn'])) ? 1 : 0;
	    $valid['cdn_provider'] = esc_url($input['cdn_provider']);

	    // Login Customization
       //First Color Picker
       $valid['login_background_color'] = (isset($input['login_background_color']) && !empty($input['login_background_color'])) ? sanitize_text_field($input['login_background_color']) : '';

       if ( !empty($valid['login_background_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['login_background_color']  ) ) { // if user insert a HEX color with #
           add_settings_error(
                   'login_background_color',                     // Setting title
                   'login_background_color_texterror',            // Error ID
                   'Please enter a valid hex value color',     // Error message
                   'error'                         // Type of message
           );
       }

       //Second Color Picker
       $valid['login_button_primary_color'] = (isset($input['login_button_primary_color']) && !empty($input['login_button_primary_color'])) ? sanitize_text_field($input['login_button_primary_color']) : '';
       
       if ( !empty($valid['login_button_primary_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['login_button_primary_color']  ) ) { // if user insert a HEX color with #
           add_settings_error(
                   'login_button_primary_color',                     // Setting title
                   'login_button_primary_color_texterror',            // Error ID
                   'Please enter a valid hex value color',     // Error message
                   'error'                         // Type of message
           );
       }


       //Logo image id
       $valid['login_logo_id'] = (isset($input['login_logo_id']) && !empty($input['login_logo_id'])) ? absint($input['login_logo_id']) : 0;


	    
	    return $valid;
	 }

	 /**
	      * Login page customizations Functions
	      *
	      * @since    1.0.0
	      */
	      private function display_medium_posts_login_logo_css(){
	          if(isset($this->display_medium_posts_options['login_logo_id']) && !empty($this->display_medium_posts_options['login_logo_id'])){
	              $login_logo = wp_get_attachment_image_src($this->display_medium_posts_options['login_logo_id'], 'thumbnail');
	              $login_logo_url = $login_logo[0];
	              $login_logo_css  = "body.login h1 a {background-image: url(".$login_logo_url."); width:253px; height:102px; background-size: contain;}";
	              return $login_logo_css;
	          }
	      }

	      
	      // Get Background color is set and different from #fff return it's css
	      private function display_medium_posts_login_background_color(){
	          if(isset($this->display_medium_posts_options['login_background_color']) && !empty($this->display_medium_posts_options['login_background_color']) ){
	              $background_color_css  = "body.login{ background:".$this->display_medium_posts_options['login_background_color']."!important;}";
	              return $background_color_css;
	          }
	      }
	      // Get Button and links color is set and different from #00A0D2 return it's css
	      private function display_medium_posts_login_button_color(){
	          if(isset($this->display_medium_posts_options['login_button_primary_color']) && !empty($this->display_medium_posts_options['login_button_primary_color']) ){
	              $button_color = $this->display_medium_posts_options['login_button_primary_color'];
	              $border_color = $this->sass_darken($button_color, 10);
	              $message_color = $this->sass_lighten($button_color, 10);
	              $button_color_css = "body.login #nav a, body.login #backtoblog a {
	                                    color: ".$button_color." !important;
	                   }
	                   .login .message {
	                    border-left: 4px solid ".$message_color.";
	                   }
	                   body.login #nav a:hover, body.login #backtoblog a:hover {
	                         color: ". $border_color." !important;
	                   }

	                   body.login .button-primary {
	                          background: ".$button_color."; /* Old browsers */
	                          background: -moz-linear-gradient(top, ".$button_color." 0%, ". $border_color.", 10%) 100%); /* FF3.6+ */
	                          background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,".$button_color."), color-stop(100%, ". $border_color.", 10%))); /* Chrome,Safari4+ */
	                          background: -webkit-linear-gradient(top, ".$button_color." 0%, ". $border_color.", 10%) 100%); /* Chrome10+,Safari5.1+ */
	                          background: -o-linear-gradient(top, ".$button_color." 0%, ". $border_color.", 10%) 100%); /* Opera 11.10+ */
	                          background: -ms-linear-gradient(top, ".$button_color." 0%, ". $border_color.", 10%) 100%); /* IE10+ */
	                          background: linear-gradient(to bottom, ".$button_color." 0%, ". $border_color.", 10%) 100%); /* W3C */

	                          -webkit-box-shadow: none!important;
	                          box-shadow: none !important;

	                          border-color:". $border_color."!important;
	                     }
	                     body.login .button-primary:hover, body.login .button-primary:active {
	                          background: ". $border_color."; /* Old browsers */
	                          background: -moz-linear-gradient(top, ". $border_color." 0%, ". $border_color.", 10%) 100%); /* FF3.6+ */
	                          background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,". $border_color."), color-stop(100%,". $border_color.", 10%))); /* Chrome,Safari4+ */
	                          background: -webkit-linear-gradient(top, ". $border_color." 0%,". $border_color.", 10%) 100%); /* Chrome10+,Safari5.1+ */
	                          background: -o-linear-gradient(top, ". $border_color." 0%,". $border_color.", 10%) 100%); /* Opera 11.10+ */
	                          background: -ms-linear-gradient(top, ". $border_color." 0%,". $border_color.", 10%) 100%); /* IE10+ */
	                          background: linear-gradient(to bottom, ". $border_color." 0%,". $border_color.", 10%) 100%); /* W3C */
	                     }
	  
	                     body.login input[type=checkbox]:checked:before{
	                           color:".$button_color."!important;
	                     }

	                     body.login input[type=checkbox]:focus,
	                     body.login input[type=email]:focus,
	                     body.login input[type=number]:focus,
	                     body.login input[type=password]:focus,
	                     body.login input[type=radio]:focus,
	                     body.login input[type=search]:focus,
	                     body.login input[type=tel]:focus,
	                     body.login input[type=text]:focus,
	                     body.login input[type=url]:focus,
	                     body.login select:focus,
	                     body.login textarea:focus {
	                     border-color: ".$button_color."!important;
	                     -webkit-box-shadow: 0 0 2px ".$button_color."!important;
	                     box-shadow: 0 0 2px ".$button_color."!important;
	              }";

	              return $button_color_css;
	          }
	      }

	      // Write the actually needed css for login customizations
	      public function display_medium_posts_login_css(){
	          if( !empty($this->display_medium_posts_options['login_logo_id']) || $this->display_medium_posts_login_background_color() != null || $this->display_medium_posts_login_button_color() != null){
	              echo '<style>';
	              if( !empty($this->display_medium_posts_options['login_logo_id'])){
	                    echo $this->display_medium_posts_login_logo_css();
	              }
	              if($this->display_medium_posts_login_background_color() != null){
	                    echo $this->display_medium_posts_login_background_color();
	              }
	              if($this->display_medium_posts_login_button_color() != null){
	                    echo $this->display_medium_posts_login_button_color();
	              }
	              echo '</style>';
	          }
	      }



	     /**
	      * Utility functions
	      *
	      * @since    1.0.0
	      */

	      private function sass_darken($hex, $percent) {
	          preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors);
	          str_replace('%', '', $percent);
	          $color = "#";
	          for($i = 1; $i <= 3; $i++) {
	              $primary_colors[$i] = hexdec($primary_colors[$i]);
	              $primary_colors[$i] = round($primary_colors[$i] * (100-($percent*2))/100);
	              $color .= str_pad(dechex($primary_colors[$i]), 2, '0', STR_PAD_LEFT);
	          }
	  
	          return $color;
	      }
	  
	      private function sass_lighten($hex, $percent) {
	          preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors);
	          str_replace('%', '', $percent);
	          $color = "#";
	          for($i = 1; $i <= 3; $i++) {
	              $primary_colors[$i] = hexdec($primary_colors[$i]);
	              $primary_colors[$i] = round($primary_colors[$i] * (100+($percent*2))/100);
	              $color .= str_pad(dechex($primary_colors[$i]), 2, '0', STR_PAD_LEFT);
	          }

	          return $color;
	      }



}
