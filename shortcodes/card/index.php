<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( ! class_exists( 'tnddns_card_shortcode' ) ) {

	class tnddns_card_shortcode {

		/**
		 * Main constructor
		 *
		 * @since 1.0.0
		 */
        
        
		public function __construct() {
			
			// Registers the shortcode in WordPress
			add_shortcode( 'tnddns_card', array( 'tnddns_card_shortcode', 'output' ) );
            
			// Map shortcode to Visual Composer
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'tnddns_card', array( 'tnddns_card_shortcode', 'map' ) );
			}

		}
        
        

		/**
		 * Shortcode output
		 *
		 * @since 1.0.0
		 */
		public static function output( $atts, $content ) {
               extract( vc_map_get_attributes( 'tnddns_card', $atts ) );

                  if ( is_numeric( $image ) ){
                  $image_src  = wp_get_attachment_image_src( $image, 'large' );
                  $image = $image_src[0];
                }
                $parse_args     = vc_parse_multi_attribute( $href );
                $href           = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : $href;
                $css_class = vc_shortcode_custom_css_class( $css_main, 'container ' );
            
            $output = '';
            
            $bottom_text = apply_filters('the_content',$content);
            
            ob_start(); ?>
            
            <div class="tiny-card">
                <div class="tiny-card-top <?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $top_style ); ?> <?php echo esc_attr( $top_background ); ?>">
                 
                 <?php if($image){?>
                  <div class="tiny-card-top-icon">
                       <img src='<?php echo $image ?>'/>
                    </div>
                <?php
                           }
                    ?>
                   <div class="tiny-card-top-title">
                       <h5><?php echo $h5;?></h5>
                    </div>
                </div>
            <div class="tiny-card-bottom<?php if(empty($content)){ echo ' no-text'; }?>">
                <?php echo $bottom_text; ?>
                <?php if($button_name&&$href){?>
                <div class="tiny-card-button <?php echo esc_attr( $button_align ); ?>">
                    <a href="<?php echo esc_attr( $href ); ?>"><?php echo esc_attr( $button_name ); ?></a>
                </div>
                <?php }?>
            </div>
			</div>
				
                <?php $output .= ob_get_clean();
                return $output;
		}
        
        
        

		/**
		 * Map shortcode to VC
		 */
        
		public static function map() {
            
			return array(
				'name'          => esc_html__( 'Card', 'tiny-addons-page-builder' ),
                  'base'          => 'tnddns_card',
                  'description'   => esc_html__( 'Card Description', 'tiny-addons-page-builder' ),
                  'category'      => esc_html__( 'Addons', 'tiny-addons-page-builder' ),
                  "icon"          => plugins_url( 'card.png', __FILE__ ),
                  'params'        => array(
                    array(
                      'type'        => 'attach_image',
                      'heading'     => esc_html__( 'Attach Icon Card', 'tiny-addons-page-builder' ),
                      'param_name'  => 'image',
                    ),
                    array(
                      'type'        => 'textarea',
                      'heading'     => esc_html__( 'Title', 'tiny-addons-page-builder' ),
                      'param_name'  => 'h5',
                      'admin_label' => true,
                    ),
                    array(
                        "type" => "textarea_html",
                        "class" => "",
                        "heading" => __( "Content Bottom", "tiny-addons-page-builder" ),
                        "param_name" => "content",
                        "admin_label" => false,
				    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => __( 'Top Style', 'tiny-addons-page-builder' ),
                        'param_name'  => 'top_style',
                        'value'       => array(
                            __( 'Default', 'tiny-addons-page-builder' )       => '',
                            __( 'Shadow', 'tiny-addons-page-builder' )         => 'tiny-shadow',
                        ),
                        'group' => __( 'Top Section', 'tiny-addons-page-builder' ),
                    ),
                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'Top CSS Properties', 'tiny-addons-page-builder' ),
                        'param_name' => 'css_main',
                        'group' => __( 'Top Section', 'tiny-addons-page-builder' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => __( 'Background Position', 'tiny-addons-page-builder' ),
                        'param_name'  => 'top_background',
                        'value'       => array(
                            __( 'Align Center', 'tiny-addons-page-builder' )       => '',
                            __( 'Align Top', 'tiny-addons-page-builder' )         => 'tiny-align-bg-top',
                            __( 'Align Bottom', 'tiny-addons-page-builder' )         => 'tiny-align-bg-bottom',
                        ),
                        'group' => __( 'Top Section', 'tiny-addons-page-builder' ),
                    ),
                    array(
                      'type'        => 'textfield',
                      'heading'     => esc_html__( 'Button Title', 'tiny-addons-page-builder' ),
                      'param_name'  => 'button_name',
                      'admin_label' => false,
                      'group' => __( 'Button', 'tiny-addons-page-builder' ),
                    ),
                    array(
                      'type'        => 'vc_link',
                      'heading'     => esc_html__( 'Link', 'tiny-addons-page-builder' ),
                      'param_name'  => 'href',
                      'admin_label' => false,
                      'group' => __( 'Button', 'tiny-addons-page-builder' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => __( 'Align', 'tiny-addons-page-builder' ),
                        'param_name'  => 'button_align',
                        'value'       => array(
                            __( 'Align Left', 'tiny-addons-page-builder' )       => '',
                            __( 'Align Center', 'tiny-addons-page-builder' )         => 'tiny-align-text-center',
                            __( 'Align Right', 'tiny-addons-page-builder' )         => 'tiny-align-text-right',
                        ),
                        'group' => __( 'Button', 'tiny-addons-page-builder' ),
                    ),
                  )

			);
		}
}
    }
new tnddns_card_shortcode;