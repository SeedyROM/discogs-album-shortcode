<?php
/*
Plugin Name:    Discogs Album Shortcode
Author:         Zack Kollar (github.com/SeedyROM || me@seedyrom.io)
License:        GPL2
*/

// Register the plugin's activation hook.
register_activation_hook(plugin_dir_url(__FILE__) . 'hooks/activation.php', 'install_plugin');

?>