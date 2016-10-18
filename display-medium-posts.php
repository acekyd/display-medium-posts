<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.acekyd.com
 * @since             1.0.0
 * @package           Display_Medium_Posts
 *
 * @wordpress-plugin
 * Plugin Name:       Display Medium Posts
 * Plugin URI:        https://github.com/acekyd/display-medium-posts
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            AceKYD
 * Author URI:        http://www.acekyd.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       display-medium-posts
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-display-medium-posts-activator.php
 */
function activate_display_medium_posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-display-medium-posts-activator.php';
	Display_Medium_Posts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-display-medium-posts-deactivator.php
 */
function deactivate_display_medium_posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-display-medium-posts-deactivator.php';
	Display_Medium_Posts_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_display_medium_posts' );
register_deactivation_hook( __FILE__, 'deactivate_display_medium_posts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-display-medium-posts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_display_medium_posts() {

	$plugin = new Display_Medium_Posts();
	$plugin->run();

}
run_display_medium_posts();
