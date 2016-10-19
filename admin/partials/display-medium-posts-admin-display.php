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

</div>