<?php
/*
Plugin Name:    Discogs Album Shortcode
Plugin URI:     https://github.com/SeedyROM/discogs-album-shortcode
Description:    An easy to use shortcode to embed discogs albums into a page. 
Author:         Zack Kollar
Author URI:     http://seedyrom.io
License:        GPL2
*/

// Include the discogs-album shortcode
include('shortcodes/album.php');

// Add the shortcode to the plugin
add_shortcode('discogs-album', 'discogs_album_shortcode');

// Add the stylesheets
add_action('wp_enqueue_scripts', 'discogs_album_shortcode_stylesheets');
?>