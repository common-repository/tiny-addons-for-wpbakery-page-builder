<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( ! class_exists( 'tnddns_image_box_shortcode' ) ) {

	class tnddns_image_box_shortcode {

		/**
		 * Main constructor
		 *
		 * @since 1.0.0
		 */
        
        
		public function __construct() {
			
			// Registers the shortcode in WordPress
			add_shortcode( 'tnddns_image_box', array( 'tnddns_image_box_shortcode', 'output' ) );
            
			// Map shortcode to Visual Composer
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'tnddns_image_box', array( 'tnddns_image_box_shortcode', 'map' ) );
			}

		}
        
        

		/**
		 * Shortcode output
		 *
		 * @since 1.0.0
		 */
		public static function output( $atts, $content = null ) {
                extract( vc_map_get_attributes( 'tnddns_image_box', $atts ) );

                  if ( is_numeric( $image ) ){
                  $image_src  = wp_get_attachment_image_src( $image, 'large' );
                  $image = $image_src[0];
                }

                  $parse_args     = vc_parse_multi_attribute( $href );
                  $href           = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : $href;
                  $css_class = vc_shortcode_custom_css_class( $css_main, 'container ' );

                // begin output
                $output   = '';
                $output  .= ( $href ) ? '<a class="tiny-image-box-link" href="'. $href .'">' : '';
                $output  .= '<div class="tiny-image-box '. $css_class .'">';
                $output  .= '<div class="tiny-image-box-bg" style="background-image: url('. $image .')"></div>';
                $output  .= '<div class="tiny-image-box-container">';
                $output  .= ( $h5 ) ? '<h5>' . $h5 . '</h5>' : '';
                $output  .= ( $p ) ? '<p>' . $p . '</p>' : '';
                $output  .= '</div></div>';
                $output  .= ( $href ) ? '</a>' : '';
                // end output

                return $output;
		}
        
        
        

		/**
		 * Map shortcode to VC
		 */
        
		public static function map() {
            
			return array(
				'name'          => esc_html__( 'Image Box', 'tiny-addons-page-builder' ),
                  'base'          => 'tnddns_image_box',
                  'description'   => esc_html__( 'Image Box Description', 'tiny-addons-page-builder' ),
                  'category'      => esc_html__( 'Addons', 'tiny-addons-page-builder' ),
                  "icon"          => plugins_url( 'image-box.png', __FILE__ ),
                  'params'        => array(
                    array(
                      'type'                => 'vc_link',
                      'heading'             => esc_html__( 'Link', 'tiny-addons-page-builder' ),
                      'param_name'          => 'href',
                    ),
                    array(
                      'type'        => 'attach_image',
                      'heading'     => esc_html__( 'Attach Image', 'tiny-addons-page-builder' ),
                      'param_name'  => 'image',
                    ),
                    array(
                      'type'        => 'textarea',
                      'heading'     => esc_html__( 'Title', 'tiny-addons-page-builder' ),
                      'param_name'  => 'h5',
                      'admin_label' => true,
                    ),
                    array(
                      'type'        => 'textarea',
                      'heading'     => esc_html__( 'Subtitle', 'tiny-addons-page-builder' ),
                      'param_name'  => 'p',
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
new tnddns_image_box_shortcode;