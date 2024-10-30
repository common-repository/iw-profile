<div class="wrap"><h2><img src="<?php echo WP_PLUGIN_URL; ?>/iw-profile/img/icon2.png" alt="i"> iw profile Plugin</h2>
    <br/>
    <div style="width: 65%; float: left;">
        <div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
            <h3 class="hndle" style="padding:5px;"><span>About "iw profile" Plugin</span></h3>
            <div class="inside"><p align="justify">"IW profile" is a simple, smart and easy to use wordpress plugin.
                    Using
                    this very simple plugin on your wordpress blog/site you can show a login form, a registration form
                    and a password reset form in the same place using Ajax functionality. User can easily Login,
                    Register and Reset their password without leaving the page. After login there is a profile, the
                    special one that
                    works great for woocommerce too.
                    users can edit their information,track orders and see what they ordered in stylish tabbed pages.
                    uploading their avatar.
                    It's a complete needed profile for wordpress which is great with woocommerce. also developers can
                    make child page for developing themes.</p></div>
        </div>

        <div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
            <h3 class="hndle" style="padding:5px;"><span>Widget Usage Instructions</span></h3>
            <div class="inside">
                <p align="justify">Go to <strong>Appearance > Widgets</strong>. Then drag and drop the <strong>iw
                        profile</strong> widget on your theme's sidebar to activate it.</p>
            </div>
        </div>


        <div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
            <h3 class="hndle" style="padding:5px;"><span>Shortcode Usage Instructions</span></h3>
            <div class="inside">
                <p><b>Put this shortcode in your blog post/page/widget:</b><br/>

                    Just copy it: <code><span style="color: #000000"><span
                                style="color: #0000BB"> &#91;iwprofile&#93;</span></span></code><br/>
                </p>
                <p>
                    <b> Or, insert this php code in your theme or any other template file:</b><br/>
                    <br/>
                    Just copy it: <code><span style="color: #000000"><span style="color: #0000BB">   &#60;&#63;php echo do_shortcode&#40;&#39;&#91;iwprofile&#93;&#39;&#41;; </span><span
                                style="color: #0000BB">&#63;&#62;</span></span>
                    </code>
                </p></div>
        </div>


        <div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
            <h3 class="hndle" style="padding:5px;"><span>F.A.Q.</span></h3>
            <div class="inside">
                <p><b>Q: Tabs Not Working</b><br/>
                    <b>A:</b> Most probably Java Script problem. If you are using any plugin that minify Java script
                    which is causing the problem. Don't enable Java Script Minification.
                <p><b>Q: Widget not working</b><br/>
                    <b>A:</b> Most good themes contain the required wp_head/wp_footer hooks - if yours does not you will
                    need to slap your developer on the back of the head and add them to your theme's header and
                    footer.php files.

                <p><b>Q: Where is registration tab?</b><br/>
                    <b>A:</b> You haven't enable registration from your site yet. Go to Settings than check anyone can
                    register
                <p><b>Q: Where is order and order tracking tab?</b><br/>
                    <b>A:</b> You haven't enable woocommerce plugin yet. it works when woocommerce is activated.
                <p><b>Q: How to show Captcha?</b><br/>
                    <b>A:</b> Install and active <a href="http://wordpress.org/plugins/captcha"
                                                    target="_blank">Captcha</a> plugin. Than go to SB Login plugin's
                    settings page and enable "Show Captcha In Login", "Show Show Captcha In Registration".
                <p><b>Q: Where is Activity and Info tab?</b><br/>
                    <b>A:</b> Go to SB Login's settings page and enable them.
                <p><b>Q: Facing Captcha problem?</b><br/>
                    <b>A:</b> If you are facing any Captcha problem please contact with the <a
                        href="http://wordpress.org/plugins/captcha" target="_blank">Captcha</a> plugin team. We are just
                    using their Captcha system in SB Login plugin. We have nothing to do with their Captcha system.

            </div>
        </div>
        <div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
            <h3 class="hndle" style="padding:5px;"><span>Currently Available Translations</span></h3>
            <div class="inside">
                <p align="justify">Currently available translation files are:<br><br>
                    nothing yet
                    My mail: <a href="mailto:a.goodlookingboy@gmail.com">a.goodlookingboy@gmail.com</a></p>
            </div>
        </div>


        <div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
            <h3 class="hndle" style="padding:5px;"><span>About the team</span></h3>
            <div class="inside">
                <p align="justify">
                <p style="text-align: center;"><a href="http://idehweb.com" target="_blank"><img
                            src="<?php echo WP_PLUGIN_URL; ?>/iw-profile/img/idehweb-logo.png"></a></p>
                This great plugin is written by IdehWeb team. IdehWeb is one of the most leading Web Design
                & Development company in Iran. Their services are: Website Design, Domain & Hosting, Logo Design,
                Search Engine Optimization, Website Security, Website Speed Optimization, mobile application and many
                more. In recent years they started to contribute in WordPress. If you need any of these service feel
                free to contact with us. We are always ready to give you our best.<br>
                <b>Mobile:</b> +98 901 040 0740<br>
                <b>Mail:</b> info@idehweb.com , a.goodlookingboy@gmail.com <br>
                <b>Web:</b> <a href="http://idehweb.com" target="_blank">www.idehweb.com</a></p>
            </div>
        </div>
    </div>

    <?php echo iwl_sidebar(); ?>

</div>
