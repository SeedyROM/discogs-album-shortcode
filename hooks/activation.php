<?php
  include(plugin_dir_url(__FILE__) . 'shortcodes/album.php');

  function install_plugin() {
    add_shortcode('discogs-album', 'discogs_album_shortcode');
  }
?>