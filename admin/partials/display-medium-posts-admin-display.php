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

    <div class="metabox-holder">
        <div class="postbox-container" style="width: 55%;margin-right: 10px;">
            <div class="postbox">
                <h3 class="hndle ui-sortable-handle"><span>How to use</span></h3>
                <div class="inside">
                    <p>WordPress Display Medium Posts plugin displays the latests posts from a specified user or publication.</p>

                    <h4>For users</h4>

                    <p>To use this plugin on any page/post, add shortcode with <strong>user</strong> handle e.g <br><span style="color:red">[display_medium_posts handle="@username"]</span></p>

                    <h4>For Publications</h4>
                    <p>To use this plugin to fetch publication posts, you'd have to get the publication handle from the url as shown https://medium.com/<strong>devcenter</strong>. <strong>devcenter</strong> is the publication's handle. If you are using a custom domain, you should still be able to look up your unique handle in settings.</p>
                    <p>To use this plugin on any page/post, add shortcode with <strong>publication</strong> handle and set "publication" to true e.g<br> <span style="color:red">[display_medium_posts handle="username" publication=true]</span></p>

                    <i>NB: Do not add "@" for publication handles</i>

                    <h4>Advanced Usage and Customization</h4>
                    <p>There are additional features that can be implemented using Display Medium Posts : </p>
                    <ul>
                        <li><b>handle:</b> This is the user's medium handle e.g <strong>@acekyd</strong> or publication handle e.g <strong>devcenter</strong> <i>(Required)</i></li>
                        <li><b>publication:</b> If you would like to show the posts of a publication's specified handle, set this value to true. Default value is false</li>
                        <li><b>default_image:</b> This is the url of default image that should show when post doesn't have a featured image e.g http://i.imgur.com/p4juyuT.png</li>
                        <li><b>display:</b> This is the amount of posts that should be displayed at a time e.g display=3</li>
                        <li><b>offset:</b> This is used when you don't want to display the most recent posts. You can specify the offset to skip the first number of items specified. Default is 0 e.g offset=2</li>
                        <li><b>total:</b> This is used to specify the amount of posts to fetch. Maximum is 10. This is also useful if you just want to display a single item e.g total=1</li>
                        <li><b>list:</b> If you would like to show the posts in a list instead of a carousel, set this value to true. Default value is false</li>
                        <li><b>title_tag:</b> This is used to set a custom tag for the article titles, such as H2, H3, etc. Default value is 'p' e.g title_tag="p"</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="postbox-container" style="width: 44%;">
            <div class="postbox">
                <h3 class="hndle ui-sortable-handle"><span>More!</span></h3>
                <div class="inside">
                    <p>
                        An example of a full use of the plugin is as follows:<br><br>
                        <strong>User - </strong><br><br>

                            [display_medium_posts handle="@acekyd" default_image="http://www.acekyd.com/wp-content/uploads/2014/11/IMG_20150731_220116.png" display=4 offset=2 total=10 list=false title_tag="h2"]

                        <br><br>
                        <strong>Publication - </strong><br><br>

                            [display_medium_posts handle="devcenter" publication=true default_image="http://www.acekyd.com/wp-content/uploads/2014/11/IMG_20150731_220116.png" display=4 offset=2 total=10 list=false title_tag="h2"]

                    </p>
                    <br><br>
                    <p>
                        <h4 style="color:red">If this plugin has helped you, don't hesitate to star the <a href="http://www.github.com/acekyd/display-medium-posts/" target="_blank">Github repo</a>. If you'd like to reach out to me or donate to this plugin, send me a tweet at <a href="http://twitter.com/ace_kyd">@Ace_KYD</a>. Cheers :)</h4>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>