<?php
/*
Plugin Name:       Tiny Addons for WPBakery Page Builder
Description:       Adds useful elements to WPBakery Page Builder
Version:           0.5
Plugin URI:        http://nakamurasei.com/tiny
Author:            Sei Nakamura
Author URI:        http://nakamurasei.com/
License:           GPLv2 or later
Text Domain:       tiny-addons-page-builder
Domain Path:       /languages
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


//Load Translation files
function tnddns_load_translation_files() {
  load_plugin_textdomain('tiny-addons-page-builder', false, basename( dirname( __FILE__ ) ) . '/languages');
 }
 //add action to load my plugin files
 add_action('plugins_loaded', 'tnddns_load_translation_files');


//Enqueue CSS
function tnddns_load_css_scripts_page_builder() {
    wp_enqueue_style( 'tnddns_options_style', plugins_url( 'css/general.css', __FILE__ ) );
}add_action( 'wp_enqueue_scripts', 'tnddns_load_css_scripts_page_builder' );


//Enqueue Shortcodes
function tnddns_include_shortcodes() {
    include 'shortcodes/card/index.php';
    include 'shortcodes/facebook/index.php';
    include 'shortcodes/image-box/index.php';
    include 'shortcodes/logo-list/index.php';
}add_action( 'vc_after_init', 'tnddns_include_shortcodes');


//Check if WPBakery Page Builder is installed
function tnddns_check_wpb_page_builder_installed(){
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            add_action('admin_notices', array( $this, 'tnddns_show_notice_wpb_page_builder_install' ));
            return;
        }			
	}add_action( 'init', 'tnddns_check_wpb_page_builder_installed' );

function tnddns_show_notice_wpb_page_builder_install(){
	    ?>
	    <div class="notice notice-warning is-dismissible">
        <p>
            <?php
            $url = 'https://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431';
            $link = sprintf( wp_kses( __( 'Please install WPBakery', 'my-text-domain' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $url ) );
            echo $link;
            ?>
        </p>
	    </div>
	    <?php
	}
?>