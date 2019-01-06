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

                    <h2>For user accounts</h2>

                    <p>To use this plugin on any page/post, add shortcode with <strong>user</strong> handle e.g <br><span style="color:red">[display_medium_posts handle="@username"]</span></p>

                    <h4>For Publications</h4>
                    <p>To use this plugin to fetch publication posts, you'd have to get the publication handle from the url as shown https://medium.com/<strong>devcenter</strong>. <strong>devcenter</strong> is the publication's handle. If you are using a custom domain, you should still be able to look up your unique handle in settings.</p>
                    <p>To use this plugin on any page/post, add shortcode with <strong>publication</strong> handle and set "publication" to true e.g<br> <span style="color:red">[display_medium_posts handle="username" publication=true]</span></p>

                    <i>NB: Do not add "@" for publication handles</i>

                    <h2>Advanced Usage and Customization</h2>
                    <p>There are additional features that can be implemented using Display Medium Posts : </p>
                    <table class="usage">
                        <tr>
                            <td>
                                Attribute
                            </td>
                            <td>
                                Description
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>handle</b>
                            </td>
                            <td>
                                This is the user's medium handle e.g <strong>@acekyd</strong> or publication handle e.g <strong>devcenter</strong> <i>(Required)</i>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>publication</b>
                            </td>
                            <td>
                                If you would like to show the posts of a publication's specified handle, set this value to true. Default value is false
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>default_image</b>
                            </td>
                            <td>
                                This is the url of default image that should show when post doesn't have a featured image e.g http://i.imgur.com/p4juyuT.png
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>display</b>
                            </td>
                            <td>
                                This is the amount of posts that should be displayed at a time e.g display=3
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>offset</b>
                            </td>
                            <td>
                                This is used when you don't want to display the most recent posts. You can specify the offset to skip the first number of items specified. Default is 0 e.g offset=2
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>total</b>
                            </td>
                            <td>
                                This is used to specify the amount of posts to fetch. Maximum is 10. This is also useful if you just want to display a single item e.g total=1
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>list</b>
                            </td>
                            <td>
                                If you would like to show the posts in a list instead of a carousel, set this value to true. Default value is false
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>title_tag</b>
                            </td>
                            <td>
                                This is used to set a custom tag for the article titles, such as H2, H3, etc. Default value is 'p' e.g title_tag="p"
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>tag</b>
                            </td>
                            <td>
                                This is used to filter Medium posts by tag. E.g tag=learning. A user <b>handle</b> is still required for generating the link but the posts are fetched globally from Medium.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>date_format</b>
                            </td>
                            <td>
                                This is only for advanced users or developers. The date format has been updated to reflect exactly as it is shown on medium - <b>Jan 1, 2019</b> using the <b>'M d, Y'</b> format. Pass on custom format to this attribute to change.
                            </td>
                        </tr>
                    </table>
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
                        <h4 style="color:red">If this plugin has helped you, don't hesitate to star the <a href="http://www.github.com/acekyd/display-medium-posts/" target="_blank">Github repo</a> as we continue to ensure this plugin remains free. </h4>
                    </p>
                    <hr>
                    <p>
                        <h4 style="color:red">
                            Submit feature requests here or see upcoming features on <a href="https://github.com/acekyd/display-medium-posts/issues/24" target="_blank">GitHub</a>
                        </h4>
                    </p>
                    <hr>
                    <p>
                        <h4 style="color:red">
                        If you'd like to reach out to me or donate to this plugin, send me a tweet at <a href="http://twitter.com/ace_kyd">@Ace_KYD</a> or donate via <a href="https://www.paypal.me/adewaleabati" target="_blank">PayPal</a>. Cheers :)</h4>

                        <a href="https://www.paypal.me/adewaleabati" target="_blank">
                            <img src="https://miamibaysidefoundation.org/wp-content/uploads/2016/07/donate-paypal-1x.png">
                        </a>


                    </p>
                </div>
            </div>
        </div>
    </div>
</div>