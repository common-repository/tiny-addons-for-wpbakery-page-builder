<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( ! class_exists( 'tnddns_facebook_shortcode' ) ) {

	class tnddns_facebook_shortcode {

		/**
		 * Main constructor
		 *
		 * @since 1.0.0
		 */
        
        
		public function __construct() {
			
			// Registers the shortcode in WordPress
			add_shortcode( 'tnddns_facebook', array( 'tnddns_facebook_shortcode', 'output' ) );

			// Map shortcode to Visual Composer
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'tnddns_facebook', array( 'tnddns_facebook_shortcode', 'map' ) );
			}

		}
        
        

		/**
		 * Shortcode output
		 *
		 * @since 1.0.0
		 */
		public static function output( $atts, $content = null ) {
                        
			// Extract shortcode attributes (based on the vc_lean_map function - see next function)
			extract( vc_map_get_attributes( 'tnddns_facebook', $atts ) );
            
                $output = '';
            ob_start(); ?>
            
               
               
               <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=<?php echo $fb_app ?>&autoLogAppEvents=1';
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>

                <div id="pagePlugin">
                    <div class="fb-page" data-href=<?php echo $fb_url ?> data-width="500" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote class="fb-xfbml-parse-ignore" cite=<?php echo $fb_url ?>><a href=<?php echo $fb_url ?>><?php echo $fb_name ?></a></blockquote></div>
                </div>
              
                <?php $output .= ob_get_clean();
            
            

			// Return output
			return $output;

		}
        
        
        

		/**
		 * Map shortcode to VC
		 */
        
		public static function map() {
        
            
			return array(
				'name'        => esc_html__( 'Facebook Embed Page', 'tiny-addons-page-builder' ),
				'description' => esc_html__( 'Facebook Embed Page Description', 'tiny-addons-page-builder' ),
				'base'        => 'tnddns_facebook',
                'category'    => esc_html__( 'Addons', 'tiny-addons-page-builder' ),
                "icon"        => plugins_url( 'facebook.png', __FILE__ ),
				'params' => array(
                    array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'Facebook Page Name', 'tiny-addons-page-builder' ),
                            'param_name' => 'fb_name',
                            'admin_label' => true,
                        ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Facebook Page URL', 'tiny-addons-page-builder' ),
                        'param_name' => 'fb_url',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'App ID', 'tiny-addons-page-builder' ),
                        'param_name' => 'fb_app',
                        'admin_label' => true,
                    ),
                ),
			);
		}

	}

}
new tnddns_facebook_shortcode;