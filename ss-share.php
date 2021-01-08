<?php
/**
 * Plugin Name: Ss share
 * Plugin URI: https://shoaiybsysa.ga/
 * Description: A simple plugin for displaying social media icons to share Post/Page content
 * Version: 1.0
 * Author: shoaiyb
 * Author URI: https://shoaiybsysa.ga
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) 
die("You don't have sufficient permission to access this page");

require_once('includes/admin-form.php');
require_once('includes/template-buttons-w-c.php');
require_once('includes/template-buttons-with-count.php');
require_once('includes/small-buttons.php');
require_once('includes/services-js-array.php');

class ss_share{

	public function __construct() {

		// register our settings page
		add_action( 'admin_menu', array( $this, 'ss_register_submenu' ) );
		
		// register setting
		add_action( 'admin_init', array( $this, 'ss_register_settings' ) );	

		add_action( 'wp_enqueue_scripts', array( $this,'ss_load_styles_scripts' ) );	
		add_action( 'admin_enqueue_scripts', array( $this,'ss_load_admin_styles_scripts' ) );
		add_action('wp_footer', array($this,'ss_scripts_footer'));

		add_filter( 'the_content', array( $this, 'append_ss_html' ) );

		add_shortcode('ss-share', array($this,'ss_html_markup' ));

		register_activation_hook( __FILE__, array( $this, 'ss_load_defaults' ) );

	}

	public function ss_load_admin_styles_scripts(){

		wp_enqueue_style( 'ss-share-admin', plugins_url('css/admin.css',__FILE__) );
		wp_enqueue_script( 'ss-admin-js', plugins_url('js/admin.js',__FILE__) );

	}

	public function ss_load_styles_scripts(){

		$ss_options = get_option('ss_options');

		wp_enqueue_style( 'ss-share-main', plugins_url('css/style.css',__FILE__) );
		
		if( !empty($ss_options['ss-select-animations']) && in_array('360-rotation', $ss_options['ss-select-animations']) && $ss_options['ss-select-style'] != 'horizontal-with-count' )
		wp_enqueue_style( '360-rotation', plugins_url('css/360-rotate.css',__FILE__) );
		
		if( !empty($ss_options['ss-select-animations']) && in_array('tooltip', $ss_options['ss-select-animations']) && $ss_options['ss-select-style'] != 'horizontal-with-count' ){
			wp_enqueue_style( 'tooltipster-css', plugins_url('css/tooltipster.css',__FILE__) );
			wp_enqueue_script( 'tooltipster-js', plugins_url('js/jquery.tooltipster.js',__FILE__), array('jquery') );
		}		

	}

	public function ss_scripts_footer() {

		$ss_options = get_option('ss_options');
		if( ($ss_options['ss-select-style'] == 'horizontal-with-count') || ($ss_options['ss-select-style'] == 'small-buttons')){
		
			$services_scripts_arr = get_services_js_arr($ss_options);
			if( !empty($ss_options['ss-selected-services']) ){
				foreach ($ss_options['ss-selected-services'] as $service) {
					echo $services_scripts_arr[$service];
				}
			}

		}

		if( !empty($ss_options['ss-select-animations']) && in_array('tooltip', $ss_options['ss-select-animations']) && $ss_options['ss-select-style'] != 'horizontal-with-count' && $ss_options['ss-select-style'] != 'small-buttons' ){
			?>
			<script>
				jQuery(document).ready(function($) {
	            $(".hint--top").tooltipster({animation: "grow",});
	        	});
			</script>
			<?php
		}	
	}
	
	public function ss_get_services() {
		return array('facebook', 'twitter', 'googleplus', 'digg', 'reddit', 'linkedin', 'stumbleupon', 'tumblr', 'pinterest', 'email' );
	}

	public function ss_load_defaults(){

		update_option( 'ss_options', $this->get_defaults() );

	}

	public function append_ss_html( $content ) {

		$ss_options = $this->get_ss_options('ss_options');
		
		// get current post's id
		global $post;
		$post_id = $post->ID;
		
		if( in_array($post_id,explode(',',$ss_options['ss-exclude-on'])) )
			return $content;
		if( is_home() && !in_array( 'home', (array)$ss_options['ss-show-on'] ) )
			return $content;
		if( is_single() && !in_array( 'posts', (array)$ss_options['ss-show-on'] ) )
			return $content;
		if( is_page() && !in_array( 'pages', (array)$ss_options['ss-show-on'] ) )
			return $content;
		if( is_archive() && !in_array( 'archive', (array)$ss_options['ss-show-on'] ) )
			return $content;
		
		$ss_html_markup = $this->ss_html_markup();
		
		if( is_array($ss_options['ss-select-position']) && in_array('before-content', $ss_options['ss-select-position']) )
			$content = $ss_html_markup.$content;
		if( is_array($ss_options['ss-select-position']) && in_array('after-content', (array)$ss_options['ss-select-position']) )
			$content .= $ss_html_markup;
		return $content;

	}
	
	public function get_defaults($preset=true) {
		return array(
				'ss-select-style' => 'horizontal-w-c-circular',
				'ss-available-services' => $this->ss_get_services(),
				'ss-selected-services' => $preset ? $this->s3_get_services() : array(),
				'ss-select-position' => $preset ? array('before-content') : array(),
				'ss-show-on' => $preset ? array('pages', 'posts') : array(),
				'ss-select-animations' => $preset ? array('tooltip') : array(),
				'ss-exclude-on' => '',
				);
		
	}
	
	public function get_ss_options() {
		return array_merge( $this->get_defaults(false), get_option('ss_options') );
	}

	public function ss_html_markup() {
		
		$ss_options = $this->get_ss_options('ss_options');
		
		if( $ss_options['ss-select-style'] == 'horizontal-with-count' ){
			
			$class = '';
			$service_markup_arr = get_buttons_with_c_markup_arr();			

		}
		elseif( $ss_options['ss-select-style'] == 'small-buttons' ){
			
			$class = '';
			$service_markup_arr = get_small_buttons_markup_arr();			

		}
		else{

			$class = '';
			if ( $ss_options['ss-select-style'] == 'horizontal-w-c-square' )
				$class = 'horizontal-w-c-square';
			elseif( $s3_options['ss-select-style'] == 'horizontal-w-c-r-border' )
				$class = 'horizontal-w-c-r-border';
			elseif( $s3_options['ss-select-style'] == 'horizontal-w-c-circular' )
				$class = 'horizontal-w-c-circular';	
			$class .= ' s-share-w-c';

			$service_markup_arr = get_buttons_w_c_markup_arr();			
					
		}

		$html_markup = '';
		foreach ($service_markup_arr as $key => $value) {
			if( in_array($key, (array)$s3_options['ss-selected-services']) ){
				$html_markup .= $value;
			}
		}
		return '<div id="s-share-buttons" class="'.$class.'">'.$html_markup.'</div>';
		
	}

	public function ss_register_settings(){

		register_setting( 'ss_options', 'ss_options' );

	}
	
	/*
	 * Add sub menu page in Settings for configuring plugin
	 */
	public function ss_register_submenu(){

		add_submenu_page( 'options-general.php', 'Ss Share settings', 'Ss Share', 'activate_plugins', 'ss-share-settings', array( $this, 'ss_submenu_page' ) );

	}

	/*
	 * Callback for add_submenu_page for generating markup of page
	 */
	public function ss_submenu_page() {
		?>
		<div class="wrap">
			<h2>Settings</h2>
			<form method="POST" action="options.php">
			<?php settings_fields('ss_options'); ?>
			<?php
			$ss_options = get_option('ss_options');
			$ss_options['ss-available-services'] = $this->ss_get_services();
			?>
			<?php admin_form($ss_options); ?>
		</div>
		<?php
	}

}
new ss_share;
?>
