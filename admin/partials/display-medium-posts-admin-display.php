<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.acekyd.com
 * @since      1.0.0
 *
 * @package    Display_Medium_Posts
 * @subpackage Display_Medium_Posts/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

    <h3>How to use</h3>

    <p>WordPress Display Medium Posts plugin displays the latests posts from a specified user.</p>

    <p>To use this plugin on any page/post, add shortcode with user handle e.g <span style="color:red">[display_medium_posts handle="@username"]</span></p>

    <h4>Advanced Usage and Customization</h4>
    <p>There are additional features that can be implemented using Display Medium Posts : </p>
    <ul>	
    	<li><b>handle:</b> This is the user's medium handle e.g @acekyd <i>(Required)</i></li>
    	<li><b>default_image:</b> This is the url of default image that should show when post doesn't have a featured image e.g http://i.imgur.com/p4juyuT.png</li>
    	<li><b>display:</b> This is the amount of posts that should be displayed at a time e.g display=3</li>
    	<li><b>offset:</b> This is used when you don't want to display the most recent posts. You can specify the offset to skip the first number of items specified. Default is 0 e.g offset=2</li>
    	<li><b>total:</b> This is used to specify the amount of posts to fetch. Maximum is 10. This is also useful if you just want to display a single item e.g total=1</li>
    </ul>

    <p>
    	An example of a full use of the plugin is as follows:<br>
    	<b>
    		[display_medium_posts handle="@acekyd" default_image="http://www.acekyd.com/wp-content/uploads/2014/11/IMG_20150731_220116.png" display=4 offset=2 total=10]
    	</b>
    </p>

</div>