<?php
//
// Shortcode to embed discogs albums
//
function discogs_album_shortcode($attributes) {
    // Set defaults
    $default_attributes = shortcode_atts(array(
        'size' => 'large'
    ));

    return 'Discogs boys!';
}
?>