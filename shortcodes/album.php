<?php
//
// Shortcode to embed discogs albums
//
function shortcode_error($error) {
    return '[discogs-album]: Error "' . $error . '"';
}

function query_discogs_api($id) {
    $uri = 'https://api.discogs.com/releases/' . $id;

    $request = wp_remote_get($uri);
    if(is_wp_error($request)) {
        return null;
    }

    $response = wp_remote_retrieve_body($request);
    $release_data = json_decode($response);

    return $release_data;
}

function render_html($data) {
    return <<<HTML
        <div class="discogs-album">
            {$data->artists[0]->name}
        </div>
HTML;
}

function discogs_album_shortcode($_attributes) {
    // Set defaults
    $attributes = shortcode_atts(array(
        'id' => null,
        'size' => 'large'
    ), $_attributes);

    if($attributes['id'] == null) {
        return shortcode_error('ID required');
    }

    $album = query_discogs_api($attributes['id']);

    if($album == null) {
        return shortcode_error('Invalid discogs ID');
    }

    return render_html($album);
}
?>