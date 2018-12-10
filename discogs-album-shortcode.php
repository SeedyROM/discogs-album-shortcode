<?php
/*
Plugin Name:    Discogs Album Shortcode
Plugin URI:     https://github.com/SeedyROM/discogs-album-shortcode
Description:    An easy to use shortcode to embed discogs album components into a page. 
Author:         Zack Kollar
Author URI:     http://seedyrom.io
License:        GPL2
*/

// Include the discogs-album shortcode.
include('shortcodes/album.php');
add_shortcode('discogs-album', 'discogs_album_shortcode');

?>