<?php
//
// Shortcode to embed discogs albums
//

function shortcode_error($error) {
    return '[discogs-album]: Error "' . $error . '"';
}

function query_discogs_api($id) {
    $uri = 'https://api.discogs.com/releases/' . $id;
    $token = 'RWqNCECRMOOEGGqrvhHxoYDmIWCqRVEbuNTJyMgG'; // Replace me!

    $request = wp_remote_get($uri, array(
        'headers' => array(
            'Authorization' => 'Discogs token=' . $token
        )
    ));
    if(is_wp_error($request)) {
        return null;
    }

    $response = wp_remote_retrieve_body($request);
    $release_data = json_decode($response);

    return $release_data;
}

function render_html($attributes, $album) {
    $album_heading = $album->title . ' by ' . $album->artists[0]->name;
    
    if($attributes['size'] == null) {
        $width = 'inherit';
    } else {
        $width = $attributes['size'];
    }

    return <<<HTML
        <div class="discogs-album" style="width: {$width};">
            <a href="{$album->uri}" target="_blank">
                <img src="{$album->images[0]->uri}" alt="{$album_heading}">
                <div class="heading">
                    <strong>{$album_heading}</strong>
                </div>
            </a>
        </div>
HTML;
}

function discogs_album_shortcode($_attributes) {
    // Set defaults
    $attributes = shortcode_atts(array(
        'id' => null,
        'size' => null
    ), $_attributes);

    if($attributes['id'] == null) {
        return shortcode_error('ID required');
    }

    $album = query_discogs_api($attributes['id']);

    if($album == null) {
        return shortcode_error('Invalid discogs ID');
    }

    return render_html($attributes, $album);
}

function discogs_album_shortcode_stylesheets() {
    $plugin_url = plugin_dir_url(__FILE__);

    wp_register_style('discogs-album-shortcode-style', $plugin_url . '../stylesheets/default-discogs-album.css');
    wp_enqueue_style('discogs-album-shortcode-style');
}
?>