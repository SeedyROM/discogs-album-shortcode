<?php
//
// Shortcode to embed discogs albums
//
function shortcode_error($error) {
    return '[discogs-album]: Error "' . $error . '"';
}

function query_discogs_api($id) {
    // Build the uri for the api call
    $uri = 'https://api.discogs.com/releases/' . $id;

    // Setup the api client
    $client = curl_init($uri);
    curl_setopt_array($client, array (
        CURLOPT_USERAGENT => 'Discogs Album Shortcode',
        CURLOPT_FAILONERROR => true,
    ));

    // Get our response data or handle errors.
    $response = curl_exec($client);
    if (curl_error($client)) {
        $error = curl_error($client);
    }
    curl_close($client);
    
    // If the request failed, return null
    if (isset($error)) {
        return null;
    }

    // Parse out important information
    // TODO
    $album_data = array();

    return $album_data;
}

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

    return 'Discogs boys!';
}
?>