

<div class="tab-content-iw">
    <ul style="list-style: none outside;margin-left: 0px;">
        <li><strong><span><?php _e('Your ID:', 'iw-profile'); ?></span> <?php
                $id = get_current_user_id();
                echo '' . the_author_meta('ID', $id) . '';
                ?></strong></li>
        <li><strong><span><?php _e('First joined here:', 'iw-profile'); ?></span> <?php
                $id = get_current_user_id();
                echo '' . the_author_meta('user_registered', $id) . '';
                ?></strong></li>
        <li><strong><span><?php _e('Total posts of yours:', 'iw-profile'); ?></span></strong> <?php
            $id = get_current_user_id();
            echo '<strong>' . count_user_posts($id) . '</strong>';
            ?></li>
        <li><strong><span><?php _e('Total comments of yours:', 'iw-profile'); ?></span></strong> <?php
            global $wpdb, $current_user;
            get_currentuserinfo();
            $userId = $current_user->ID;
            $where = 'WHERE comment_approved = 1 AND user_id = ' . $userId;
            $comment_count = $wpdb->get_var("SELECT COUNT( * ) AS total
                                 FROM {$wpdb->comments}
                                 {$where}");
            echo '<strong>' . $comment_count . '</strong>';
            ?></li>
        <li><strong><span><?php _e('Your level:', 'iw-profile'); ?></span> <?php
                $id = get_current_user_id();
                echo '' . the_author_meta('user_level', $id) . '';
                ?></strong></li>
        <li><strong><span><?php _e('Your posts feed:', 'iw-profile'); ?></span> <a
                    style="color:#222;"
                    href="/author/<?php the_author_meta('user_login'); ?>/feed"><?php _e('Author Feed', 'iw-profile'); ?></a></strong>
        </li>
        <li><strong><span><?php _e('All comments feed:', 'iw-profile'); ?></span> <a
                    style="color:#222;" href="/comments/feed"><?php _e('Comments Feed', 'iw-profile'); ?></a></strong>
        </li>
    </ul>

</div>