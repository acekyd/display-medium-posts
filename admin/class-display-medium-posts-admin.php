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

}
