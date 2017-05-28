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
 * Version:           3.0
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
    	ob_start();
    	 $a = shortcode_atts(array('handle'=>'-1', 'default_image'=>'http://i.imgur.com/p4juyuT.png', 'display' => 3, 'offset' => 0, 'total' => 10, 'list' => false, 'publication' => false), $atts);
        // No ID value
        if(strcmp($a['handle'], '-1') == 0){
                return "";
        }
        $handle=$a['handle'];
        $default_image = $a['default_image'];
        $display = $a['display'];
        $offset = $a['offset'];
        $total = $a['total'];
        $list = $a['list'] =='false' ? false: $a['list'];
        $publication = $a['publication'] =='false' ? false: $a['publication'];

        $data = file_get_contents("https://medium.com/".$handle."/latest?format=json");
        $data = str_replace("])}while(1);</x>", "", $data);
        if($publication) {
        	//If handle provided is specified as a publication
	        $json = json_decode($data, true);

	        $json = json_decode($data);
			$posts = $json->payload->posts;
			$items = array();
			$count = 0;
			foreach($posts as $post)
			{
				$items[$count]['title'] = $post->title;
				$items[$count]['url'] = 'https://medium.com/'.$handle.'/'.$post->uniqueSlug;
				$items[$count]['subtitle'] = isset($post->virtuals->subtitle) ? $post->virtuals->subtitle : "";
				if(!empty($post->virtuals->previewImage->imageId))
				{
					$image = 'http://cdn-images-1.medium.com/max/500/'.$post->virtuals->previewImage->imageId;
				}
				else {
					$image = $default_image;
				}
				$items[$count]['image'] = $image;
				$items[$count]['duration'] = round($post->virtuals->readingTime);
				$items[$count]['date'] = isset($post->firstPublishedAt) ? date('Y.m.d', $post->firstPublishedAt/1000): "";

				$count++;
			}
			if($offset)
			{
				$items = array_slice($items, $offset);  
			}

			if(count($items) > $total)
			{
				$items = array_slice($items, 0, $total); 
			}
        }
        else {
	        $json = json_decode($data, true);

	        $json = json_decode($data);
			$posts = $json->payload->references->Post;
			$items = array();
			$count = 0;
			foreach($posts as $post)
			{
				$items[$count]['title'] = $post->title;
				$items[$count]['url'] = 'https://medium.com/'.$handle.'/'.$post->uniqueSlug;
				$items[$count]['subtitle'] = isset($post->content->subtitle) ? $post->content->subtitle : "";
				if(!empty($post->virtuals->previewImage->imageId))
				{
					$image = 'http://cdn-images-1.medium.com/max/500/'.$post->virtuals->previewImage->imageId;
				}
				else {
					$image = $default_image;
				}
				$items[$count]['image'] = $image;
				$items[$count]['duration'] = round($post->virtuals->readingTime);
				$items[$count]['date'] = isset($post->firstPublishedAt) ? date('Y.m.d', $post->firstPublishedAt/1000): "";

				$count++;
			}
			if($offset)
			{
				$items = array_slice($items, $offset);  
			}

			if(count($items) > $total)
			{
				$items = array_slice($items, 0, $total); 
			}
        }
    	?>
		<div id="display-medium-owl-demo" class="display-medium-owl-carousel">
			<?php foreach($items as $item) { ?>
		  	<div class="display-medium-item">
		  		<a href="<?php echo $item['url']; ?>" target="_blank">
		  			<img data-src="<?php echo $item['image']; ?>" class="lazyOwl">
		  			<?php 
		  				if($list)
		  				{
		  					echo '<img src="'.$item['image'].'" class="display-medium-img">';
		  				}
		  			?>
		  			<p class="display-medium-title details-title"><?php echo $item['title']; ?></p>
		  		</a>
		        <p class="display-medium-subtitle">
		            <?php echo $item['subtitle']; ?>
		        </p>
	            <p class="display-medium-date-read">
	            	<?php echo "<span class='display-medium-date'>".$item['date']."</span>"; ?> / <?php echo "<span class='display-medium-readtime'>".$item['duration']."min read</span>"; ?>.
		            <a href="<?php echo $item['url']; ?>" target="_blank" class="text-right display-medium-readmore">Read More</a>
		        </p>
		  	</div>

			<?php } ?>
		</div>
		<script type="text/javascript">
				function initializeOwl(count) {
					 jQuery(".display-medium-owl-carousel").owlCarousel({
					 	items: count,
					    lazyLoad : true,
					  });
				}
		</script>
		<?php
			if(!$list)
			{
				echo '<script>initializeOwl('.$display.');</script>';
			}
		?>
        <?php
        return ob_get_clean();
    }
    add_shortcode('display_medium_posts', 'posts_display');

