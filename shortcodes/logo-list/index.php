<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( ! class_exists( 'tnddns_logo_list_shortcode' ) ) {

	class tnddns_logo_list_shortcode {

		/**
		 * Main constructor
		 *
		 * @since 1.0.0
		 */
        
        
		public function __construct() {
			
			// Registers the shortcode in WordPress
			add_shortcode( 'tnddns_logo_list', array( 'tnddns_logo_list_shortcode', 'output' ) );
            
			// Map shortcode to Visual Composer
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'tnddns_logo_list', array( 'tnddns_logo_list_shortcode', 'map' ) );
			}

		}
        
        

		/**
		 * Shortcode output
		 *
		 * @since 1.0.0
		 */
		public static function output( $atts, $content = null ) {
                extract( vc_map_get_attributes( 'tnddns_logo_list', $atts ) );
                
                $css_class = vc_shortcode_custom_css_class( $css_main, 'container ' );

                $output = '';

                $output .='<ul class="tiny-logo-inline '. $css_class . '">';
                if($images != '') {
                    $images = explode(',', $images);
                }
                if(is_array($images)) {
                    $i = 0;
                    foreach ($images as $image) {
                        $image_url = wp_get_attachment_image_src($image, 'full');
                        $output .= '<li style="max-height:'.$image_url[2].'px; max-width:'.$image_url[1].'px">';
                        $output .= '<img src="'.$image_url[0].'"/>';
                        $output .= '</li>';
                        $i ++;
                    }
                }
                $output .= '</ul>';
                return $output;
		}
        
        
        

		/**
		 * Map shortcode to VC
		 */
        
		public static function map() {
            
			return array(
				'name' => esc_html__( 'Logo List', 'tiny-addons-page-builder' ),
                'base' => 'tnddns_logo_list',
                'description' => esc_html__( 'Logo List Description', 'tiny-addons-page-builder' ),
                'show_settings_on_create' => false,
                'category'    => esc_html__( 'Addons', 'tiny-addons-page-builder' ),
                "icon"        => plugins_url( 'logo-list.png', __FILE__ ),
                'params'        => array(
                array(
                  'type'        => 'attach_images',
                  'heading'     => esc_html__( 'Attach Image', 'tiny-addons-page-builder' ),
                  'param_name'  => 'images',
                  'description' => esc_html__( 'Select Images Upload', 'tiny-addons-page-builder' ),
                ),
                array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS Properties', 'tiny-addons-page-builder' ),
                        'param_name' => 'css_main',
                        'group' => __( 'CSS Properties', 'tiny-addons-page-builder' ),
                ),

			)
                );
		}
}
    }
new tnddns_logo_list_shortcode;