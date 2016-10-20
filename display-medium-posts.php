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
 * Description:       Display Medium Posts is a wordpress plugin that allows users display posts from medium.com on any part of their website.
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

    // Example 1 : WP Shortcode to display form on any page or post.
    function posts_display($atts){
    	 $a = shortcode_atts(array('handle'=>'-1'), $atts);
        // No ID value
        if(strcmp($a['handle'], '-1') == 0){
                return "";
        }
        $handle=$a['handle'];

        $data = file_get_contents("https://medium.com/".$handle."/latest?format=json"); 
        $data = str_replace("])}while(1);</x>", "", $data);

        $json = json_decode($data, true);

        $json = json_decode($data);
		$posts = $json->payload->references->Post;
		$items = array();
		$count = 0;
		foreach($posts as $post)
		{
			$items[$count]['title'] = $post->title;
			$items[$count]['url'] = 'https://medium.com/'.$handle.'/'.$post->uniqueSlug;
			$items[$count]['subtitle'] = $post->virtuals->snippet; 
			$items[$count]['image'] = 'http://cdn-images-1.medium.com/max/500/'.$post->virtuals->previewImage->imageId;
			$items[$count]['duration'] = round($post->virtuals->readingTime);
			$items[$count]['date'] = $post->virtuals->createdAtRelative;

			$count++;
		}

    ?>
		<div id="display-medium-owl-demo" class="display-medium-owl-carousel">
			<?php foreach($items as $item) { ?>
		  	<div>
		  		<img data-src="<?php echo $item['image']; ?>" class="lazyOwl">
		  		<a href="<?php echo $item['url']; ?>">
		  			<p class="details-title"><?php echo $item['title']; ?></p>
		  		</a>
		        <p>
		            <?php echo $item['subtitle']; ?>
		        </p>
	            <p>
	            	<?php echo $item['date']; ?> / <?php echo $item['duration']; ?>min read.
		            <a href="<?php echo $item['url']; ?>" class="text-right">Read More</a>
		        </p>
		  	</div>

			<?php } ?>
		</div>
        <?php
    }
    add_shortcode('display_medium_posts', 'posts_display');

