<?php
/**
 * This page shows the procedural or functional example
 * OOP way example is given on the main plugin file.
 */

/**
 * WordPress settings API demo class
 */

if ( !class_exists('Youtubegalleries_Settings_Config' ) ):
class Youtubegalleries_Settings_Config {
    private $settings_api;
    function __construct() {
        $this->settings_api = new Youtubegalleries_WeDevs_Settings_API;
        add_action( 'admin_init', array($this, 'admin_init') ); //display options
        add_action( 'admin_menu', array($this, 'admin_menu') ); //display the page of options.
    }

    function admin_init() {
        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }
    function admin_menu() {
        add_menu_page(
            'YouTube Gallery',
            'YouTube Gallery',
            'manage_options',
            'youtube-gallery-setting',
            array( $this, 'plugin_page' ),
            '',
            YOUTUBEGALLERIES_MENU_POSITION
        );
    }
    function get_settings_sections() {
        $sections = array(
            array(
                'id'     => 'youtubegalleries_settings',
                'title' => __( 'Youtube Gallery Settings', 'youtubegalleries' )
            )
        );
        return $sections;
    }

    //start all options of "GS Youtube settings" and "Style Settings" under nav
    /*
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            // Start of Youtube settings nav,
            'youtubegalleries_settings' => array(
                // api id
                array(
                    'name'      => 'youtube_apikey_id',
                    'label'     => __( 'Your Youtube API KEY', 'youtubegalleries' ),
                    'desc'      => __( 'Enter Your Youtube API KEY', 'youtubegalleries' ),
                    'type'      => 'text',
                    'default'   => ''
                ),

                // channel id
                array(
                    'name'      => 'youtube_channel_id',
                    'label'     => __( 'Channel ID', 'youtubegalleries' ),
                    'desc'      => __( 'Enter Youtube channel ID', 'youtubegalleries' ),
                    'type'      => 'text',
                    'default'   => ''
                ),
                  // Playlist id
                array(
                    'name'      => 'youtube_playlist_id',
                    'label'     => __( 'Playlist ID', 'youtubegalleries' ),
                    'desc'      => __( 'Enter Youtube playlist ID', 'youtubegalleries' ),
                    'type'      => 'text',
                    'default'   => ''
                ),

                // Number of shots to display
                array(
                    'name'  => 'youtube_count',
                    'label' => __( 'Total Videos', 'youtubegalleries' ),
                    'desc'  => __( 'Set 1-50 number of videos to display ', 'youtubegalleries' ),
                    'type'  => 'number',
                    'min'   => 1,
                    'max'   => 50, // youtube referance value.
                    'default' => 6
                ),

                array(
                    'name'      => 'youtube_orderby',
                    'label'     => __( 'OrderBy', 'youtubegalleries' ),
                    'desc'      => __( 'Select Videos orderby, Default : Date', 'youtubegalleries' ),
                    'type'      => 'select',
                    'default'   => 'date',
                    'options'   => array(
                        'date'          => 'Date',
                        'rating'        => 'Rating',
                        'title'         => 'Title',
                        'videoCount'    => 'VideoCount',
                        'viewCount'     => 'ViewCount'
                    )
                ),
                // Front page display Columns
                array(
                    'name'      => 'youtubegalleries_cols',
                    'label'     => __( 'Page Columns', 'youtubegalleries' ),
                    'desc'      => __( 'Select number of Youtube Showcase columns', 'youtubegalleries' ),
                    'type'      => 'select',
                    'default'   => '4',
                    'options'   => array(
                        '6'    => '2 Columns',
                        '4'      => '3 Columns',
                        '3'      => '4 Columns'
                    )
                ),
                // properties theme
                array(
                    'name'  => 'youtubegalleries_theme',
                    'label' => __( 'Style & Theming', 'youtubegalleries' ),
                    'desc'  => __( 'Select preffered Style & Theme', 'youtubegalleries' ),
                    'type'  => 'select',
                    'default'   => 'ytgal_grid',
                    'options'   => array(
                        'ytgal_grid'         => 'Grid'
                    )
                ),

                // Youtube Detail Description character control
                array(
                    'name'  => 'youtubegallery_youtube_height',
                    'label' => __( 'Youtube Video Height', 'youtubegalleries' ),
                    'desc'  => __( 'Define Youtube video height.', 'youtubegalleries' ),
                    'type'  => 'number',
                    'min'   => 50,
                    'max'   => 1000,
                    'default' => 350
                ),
                // Title character control
                array(
                    'name'  => 'yt_title_contl',
                    'label' => __( 'Title Character control', 'youtubegalleries' ),
                    'desc'  => __( 'Set maximum number of characters in Youtube Video Title. Default 40', 'youtubegalleries' ),
                    'type'  => 'number',
                    'min'   => 1,
                    'max'   => 300,
                    'default' => 40
                ),
                // Title character control
                array(
                    'name'  => 'yt_desc_contl',
                    'label' => __( 'Desc Character control', 'youtubegalleries' ),
                    'desc'  => __( 'Set maximum number of characters in Youtube Video Description. Default 120. Max 150', 'youtubegalleries' ),
                    'type'  => 'number',
                    'min'   => 1,
                    'max'   => 150,
                    'default' => 120
                ),
                
            ), // end of Youtube Settings nav'

        ); //end of $settings_fields = array()
        return $settings_fields;
    } // end of function get_settings_fields()

    function plugin_page() {
        // settings_errors();
        echo '<div class="wrap ytgallery_wrap" style="width: 845px; float: left;">';        
            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();
        echo '</div>';
        ?>
        <div class="wps-admin-sidebar" style="width: 277px; float: left; margin-top: 62px;">
            <div class="postbox">
                <div class="inside centered">
                    <p>Display YouTube videos anywhere with the shortcode <h3>[youtube_gallery]</h3
                        > </p>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }
}
endif;

$settings = new Youtubegalleries_Settings_Config();
