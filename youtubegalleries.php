<?php
/**
 *
 * @wordpress-plugin
 * Plugin Name:           Youtube Gallery
 * Plugin URI:            
 * Description:           YouTube Gallery plugin for Wordpress to display YouTube Channel or Playlist videos at your site.
 * Version:               1.0
 * Author:                Anshul
 */

/**
 * Defining constants
*/
if( ! defined( 'YOUTUBEGALLERIES_VERSION' ) ) define( 'YOUTUBEGALLERIES_VERSION', '1.0' );
if( ! defined( 'YOUTUBEGALLERIES_MENU_POSITION' ) ) define( 'YOUTUBEGALLERIES_MENU_POSITION', '31' );
if( ! defined( 'YOUTUBEGALLERIES_PLUGIN_DIR' ) ) define( 'YOUTUBEGALLERIES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
if( ! defined( 'YOUTUBEGALLERIES_PLUGIN_URI' ) ) define( 'YOUTUBEGALLERIES_PLUGIN_URI', plugins_url( '', __FILE__ ) );
if( ! defined( 'YOUTUBEGALLERIES_FILES_DIR' ) ) define( 'YOUTUBEGALLERIES_FILES_DIR', YOUTUBEGALLERIES_PLUGIN_DIR . 'youtubegalleries-files' );
if( ! defined( 'YOUTUBEGALLERIES_FILES_URI' ) ) define( 'YOUTUBEGALLERIES_FILES_URI', YOUTUBEGALLERIES_PLUGIN_URI . '/youtubegalleries-files' );

/**
 * require_once
*/
require_once YOUTUBEGALLERIES_FILES_DIR . '/includes/youtubegalleries_shortcode.php';
require_once YOUTUBEGALLERIES_FILES_DIR . '/youtubegalleries_scripts.php';
require_once YOUTUBEGALLERIES_FILES_DIR . '/admin/class.settings-api.php';
require_once YOUTUBEGALLERIES_FILES_DIR . '/admin/youtubegalleries_options_config.php';