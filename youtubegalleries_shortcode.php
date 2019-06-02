<?php
// -- Getting values from setting panel
function youtubegalleries_getoption( $option, $section, $default = '' ) {
    $options = get_option( $section );
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
    return $default;
}

add_shortcode('youtube_gallery','ytgal_shortcode');
function ytgal_shortcode( $atts ) {
    $ytgal_op_youtubegalleries_cols        = youtubegalleries_getoption('youtubegalleries_cols', 'youtubegalleries_settings', 3);
    $ytgal_op_youtubegalleries_theme       = youtubegalleries_getoption('youtubegalleries_theme', 'youtubegalleries_settings', 'ytgal_popup');
    $ytgal_op_channel_profile              = youtubegalleries_getoption('youtube_channel_profile', 'youtubegalleries_settings', ' ');
    $ytgal_op_video_height                 = youtubegalleries_getoption('youtubegallery_youtube_height', 'youtubegalleries_settings', 350);
    $yt_title_contl                       = youtubegalleries_getoption('yt_title_contl', 'youtubegalleries_settings', 40);
    $yt_desc_contl                        = youtubegalleries_getoption('yt_desc_contl', 'youtubegalleries_settings', 120);
    $ytgal_op_orderby                      = youtubegalleries_getoption('youtube_orderby', 'youtubegalleries_settings', 'date');
    $ytgal_op_apikey_id                    = youtubegalleries_getoption('youtube_apikey_id', 'youtubegalleries_settings', '');
    $ytgal_op_channel_id                   = youtubegalleries_getoption('youtube_channel_id', 'youtubegalleries_settings', '');
    $ytgal_op_palylist_id                  = youtubegalleries_getoption('youtube_playlist_id', 'youtubegalleries_settings', '');
    $ytgal_op_count                        = youtubegalleries_getoption('youtube_count', 'youtubegalleries_settings', 6);

   extract(shortcode_atts(
        array(
        'api_key'       => $ytgal_op_apikey_id,
        'channel_id'    => $ytgal_op_channel_id,
        'playlist_id'   => $ytgal_op_palylist_id,
        'count'         => $ytgal_op_count,
        'orderby'       => $ytgal_op_orderby,
        'theme'         => $ytgal_op_youtubegalleries_theme,
        'cols'          => $ytgal_op_youtubegalleries_cols,
        'video_height'  => $ytgal_op_video_height,
        'title_limit'   => $yt_title_contl,
        'desc_limit'    => $yt_desc_contl
        ), $atts
    ));

if(empty($ytgal_op_apikey_id)){
    return '<h1>Please Insert - "API Key" in Settings Options.<h1>';
}
elseif (empty($ytgal_op_channel_id) && empty($ytgal_op_palylist_id)){
    return '<h1>Please Insert - "Channel ID or Playlist ID" in Settings Options.<h1>';
}
else{
    if(!empty($ytgal_op_channel_id)){
        $ytv_url = 'https://www.googleapis.com/youtube/v3/search';
        $ytv_url .= '?part=snippet';
        $ytv_url .= '&channelId='.$channel_id.'';
        $ytv_url .= '&maxResults='.$count.'';
        $ytv_url .= '&order='.$orderby.'';  // orderby work only in channel id
        $ytv_url .= '&type=video';
        $ytv_url .= '&key='.$api_key.'';
    }
    if(!empty($ytgal_op_palylist_id)){
        $ytv_url = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,contentDetails&maxResults=".$count."&playlistId=".$playlist_id."&key=".$api_key."";
    }
}

    $ytv_response = wp_remote_get( $ytv_url, array( 'sslverify' => false ) );
    $ytv_xml      = wp_remote_retrieve_body( $ytv_response );
    $ytgal_json   = json_decode( $ytv_xml ,true );

        $output = '';
        $output = '<div class="wrap ytgallery_area '.$ytgal_op_youtubegalleries_theme.'">';

            if ( $ytgal_op_youtubegalleries_theme == 'ytgal_grid') {
                include YOUTUBEGALLERIES_FILES_DIR . '/includes/templates/theme_grid.php';
            }
       
        $output .= '</div>'; // end wrap
             
    return $output;
}

// -- CSS values
if ( !function_exists( 'youtubegalleries_setting_styles' )) {
    function youtubegalleries_setting_styles() {
        //this variable hold user input data/settings from style settings
        $ytgal_fz          = youtubegalleries_getoption('youtubegallery_fz', 'youtubegalleries_style_settings', 18);
        $ytgal_fntw        = youtubegalleries_getoption('youtubegallery_fntw', 'youtubegalleries_style_settings', 'normal');
        $ytgal_fnstyl      = youtubegalleries_getoption('youtubegallery_fnstyl', 'youtubegalleries_style_settings', 'normal');
        $ytgal_name_color  = youtubegalleries_getoption('youtubegallery_name_color', 'youtubegalleries_style_settings', '#141412');

    ?>
    <style>
        .items .ytgal-name,
        .items .ytgal-name a,
        .item-details .ytgal-name,
        .widget-yt-videos .ytgal-name {
            font-size: <?php echo $ytgal_fz;?>px;
            font-weight: <?php echo $ytgal_fntw; ?>;
            font-style: <?php echo $ytgal_fnstyl; ?>;
            color: <?php echo $ytgal_name_color; ?>;
            text-transform: capitalize;
        }

    </style>
    <?php
    }
}
add_action('wp_head', 'youtubegalleries_setting_styles' );