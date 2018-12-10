<?php
//
// Shortcode to embed discogs albums
//
function shortcode_error($error) {
    return '[discogs-album]: Error "' . $error . '"';
}

function query_discogs_api($id) {
    $uri = 'https://api.discogs.com/releases/' . $id;

    $request = wp_remote_get($id);
    if(is_wp_error($request)) {
        return null;
    }

    $response = wp_remote_retrieve_body($request);
    $album_data = json_decode($response);

    return $album_data;
}

// The actual shortcode
function discogs_album_shortcode($_attributes) {
    // Set defaults
    $attributes = shortcode_atts(array(
        'id' => null,
        'size' => 'large'
    ), $_attributes);

    // Make sure an id is given.
    if($attributes['id'] == null) {
        return shortcode_error('ID required');
    }

    $album_data = query_discogs_api($attributes['id']);

    if($album_data == null) {
        return shortcode_error('Invalid discogs ID');
    }

    return $album_data['description'];
}
?>