<?php $cdap_settings = get_option('cdap_settings'); ?>
<div class="wrap">
    <!-- Settings Header -->
    <?php include('head.php'); ?>
    <!-- Settings Header -->
    <?php if (isset($_SESSION['cdap_message'])) { ?><div class="cdap-message"><p><?php
        echo $_SESSION['cdap_message'];
        unset($_SESSION['cdap_message']);
        ?>
            </p>
        </div><?php } ?>
    <div class="cdap-tabs">
        <ul>
            <li class="cdap-active-tab"><a href="javascript:void(0);" class="cdap-tabs-trigger" id="cdap-settings"><?php _e('Settings', CDAP_TD); ?></a></li>
            <li><a href="javascript:void(0);" class="cdap-tabs-trigger" id="cdap-about"><?php _e('About', CDAP_TD); ?></a></li>
        </ul>
    </div>
    <div class="cdap-tabs-sections">
        <form method="post" action="<?php echo admin_url() . 'admin-post.php' ?>">
            <input type="hidden" name="action" value="cdap_settings_save"/>
            <?php
            /**
             * Nonce field
             * */
            wp_nonce_field('cdap_settings_save', 'cdap_settings_nonce');
            ?>
            <div class="cdap-settings cdap-inner-section">
                <div class="cdap-option-wrapper">
                    <label><input type="radio" name="all" value="1" <?php checked($cdap_settings['all'], true); ?>/> <?php _e('Disable on all post types', CDAP_TD); ?></label>
                </div>
                <div class="cdap-option-wrapper">
                    <label><input type="radio" name="all" value="0" <?php checked($cdap_settings['all'], 0); ?>/> <?php _e('Disable on certain post types', CDAP_TD); ?></label>
                    <div class="cdap-post-types-wrapper">
                        <?php
                        $post_types = $this->get_registered_post_types();
                        foreach ($post_types as $post_type) {
                            $post_type_object = get_post_type_object($post_type);
                            //$this->print_array($post_type_object);
                            ?>
                            <label><input type="checkbox" name="post_types[]" value="<?php echo $post_type; ?>" <?php echo ( in_array($post_type, $cdap_settings['post_types']) ) ? 'checked="checked"' : ''; ?> <?php echo ( $cdap_settings['all'] == 1 ) ? 'disabled="disabled"' : ''; ?> class="cdap-post-types"/><?php echo $post_type_object->labels->name; ?></label>
                            <?php
                        }
                        ?>
                    </div><!--cdap-post-type-wrapper-->
                </div><!--cdap-option-wrapper-->
                <div class="cdap-note"><p><?php _e('Note: Disabling comments will also disable trackbacks and pingbacks. All the fields related with comments from the edit/quick-edit screens of the selected post types will also be hidden .', CDAP_TD) ?></p></div>
                <div class="cdap-option-wrapper">
                    <input type="submit" value="<?php _e('Save Changes', CDAP_TD); ?>" name="save_btn"/>
                </div><!--cdap-option-wrapper-->
            </div><!--cdap-settings-->
            <div class="cdap-about cdap-inner-section" style="display:none">
                <?php include(plugin_dir_path(__FILE__) .'/about.php');?>
            </div>
        </form>

    </div>
</div><!--wrap-->