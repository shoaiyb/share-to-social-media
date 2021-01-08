<?php
/**
 * Plugin Name: Share To SM
 * Plugin URI: https://shoaiybsysa.ga/
 * Description: A simple social sharing plugin for displaying social media icons on your website to share Post/Page content
 * Version: 1.0
 * Author: shoaiyb sysa
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

class share_to_social_media{

	public function __construct() {

		// register our settings page
		add_action( 'admin_menu', array( $this, 'stsm_register_submenu' ) );
		
		// register setting
		add_action( 'admin_init', array( $this, 'stsm_register_settings' ) );	

		add_action( 'wp_enqueue_scripts', array( $this,'stsm_load_styles_scripts' ) );	
		add_action( 'admin_enqueue_scripts', array( $this,'stsm_load_admin_styles_scripts' ) );
		add_action('wp_footer', array($this,'stsm_scripts_footer'));

		add_filter( 'the_content', array( $this, 'append_stsm_html' ) );

		add_shortcode('stsm-share', array($this,'stsm_html_markup' ));

		register_activation_hook( __FILE__, array( $this, 'stsm_load_defaults' ) );

	}

	public function stsm_load_admin_styles_scripts(){

		wp_enqueue_style( 'stsm-share-admin', plugins_url('css/admin.css',__FILE__) );
		wp_enqueue_script( 'stsm-admin-js', plugins_url('js/admin.js',__FILE__) );

	}

	public function stsm_load_styles_scripts(){

		$stsm_options = get_option('stsm_options');

		wp_enqueue_style( 'stsm-share-main', plugins_url('css/style.css',__FILE__) );
		
		if( !empty($stsm_options['stsm-select-animations']) && in_array('360-rotation', $stsm_options['ss-select-animations']) && $stsm_options['ss-select-style'] != 'horizontal-with-count' )
		wp_enqueue_style( '360-rotation', plugins_url('css/360-rotate.css',__FILE__) );
		
		if( !empty($stsm_options['stsm-select-animations']) && in_array('tooltip', $stsm_options['ss-select-animations']) && $stsm_options['ss-select-style'] != 'horizontal-with-count' ){
			wp_enqueue_style( 'tooltipster-css', plugins_url('css/tooltipster.css',__FILE__) );
			wp_enqueue_script( 'tooltipster-js', plugins_url('js/jquery.tooltipster.js',__FILE__), array('jquery') );
		}		

	}

	public function stsm_scripts_footer() {

		$stsm_options = get_option('stsm_options');
		if( ($stsm_options['stsm-select-style'] == 'horizontal-with-count') || ($stsm_options['stsm-select-style'] == 'small-buttons')){
		
			$services_scripts_arr = get_services_js_arr($stsm_options);
			if( !empty($stsm_options['stsm-selected-services']) ){
				foreach ($stsm_options['stsm-selected-services'] as $service) {
					echo $services_scripts_arr[$service];
				}
			}

		}

		if( !empty($stsm_options['stsm-select-animations']) && in_array('tooltip', $stsm_options['stsm-select-animations']) && $stsm_options['stsm-select-style'] != 'horizontal-with-count' && $stsm_options['stsm-select-style'] != 'small-buttons' ){
			?>
			<script>
				jQuery(document).ready(function($) {
	            $(".hint--top").tooltipster({animation: "grow",});
	        	});
			</script>
			<?php
		}	
	}
	
	public function stsm_get_services() {
		return array('facebook', 'twitter', 'googleplus', 'digg', 'reddit', 'linkedin', 'stumbleupon', 'tumblr', 'pinterest', 'email' );
	}

	public function stsm_load_defaults(){

		update_option( 'stsm_options', $this->get_defaults() );

	}

	public function append_stsm_html( $content ) {

		$stsm_options = $this->get_stsm_options('stsm_options');
		
		// get current post's id
		global $post;
		$post_id = $post->ID;
		
		if( in_array($post_id,explode(',',$stsm_options['stsm-exclude-on'])) )
			return $content;
		if( is_home() && !in_array( 'home', (array)$stsm_options['stsm-show-on'] ) )
			return $content;
		if( is_single() && !in_array( 'posts', (array)$stsm_options['stsm-show-on'] ) )
			return $content;
		if( is_page() && !in_array( 'pages', (array)$stsm_options['stsm-show-on'] ) )
			return $content;
		if( is_archive() && !in_array( 'archive', (array)$stsm_options['stsm-show-on'] ) )
			return $content;
		
		$stsm_html_markup = $this->stsm_html_markup();
		
		if( is_array($stsm_options['stsm-select-position']) && in_array('before-content', $stsm_options['stsm-select-position']) )
			$content = $stsm_html_markup.$content;
		if( is_array($stsm_options['stsm-select-position']) && in_array('after-content', (array)$stsm_options['stsm-select-position']) )
			$content .= $stsm_html_markup;
		return $content;

	}
	
	public function get_defaults($preset=true) {
		return array(
				'stsm-select-style' => 'horizontal-w-c-circular',
				'stsm-available-services' => $this->ss_get_services(),
				'stsm-selected-services' => $preset ? $this->ss_get_services() : array(),
				'stsm-select-position' => $preset ? array('before-content') : array(),
				'stsm-show-on' => $preset ? array('pages', 'posts') : array(),
				'stsm-select-animations' => $preset ? array('tooltip') : array(),
				'stsm-exclude-on' => '',
				);
		
	}
	
	public function get_stsm_options() {
		return array_merge( $this->get_defaults(false), get_option('stsm_options') );
	}

	public function stsm_html_markup() {
		
		$stsm_options = $this->get_stsm_options('stsm_options');
		
		if( $stsm_options['stsm-select-style'] == 'horizontal-with-count' ){
			
			$class = '';
			$service_markup_arr = get_buttons_with_c_markup_arr();			

		}
		elseif( $stsm_options['stsm-select-style'] == 'small-buttons' ){
			
			$class = '';
			$service_markup_arr = get_small_buttons_markup_arr();			

		}
		else{

			$class = '';
			if ( $stsm_options['stsm-select-style'] == 'horizontal-w-c-square' )
				$class = 'horizontal-w-c-square';
			elseif( $stsm_options['stsm-select-style'] == 'horizontal-w-c-r-border' )
				$class = 'horizontal-w-c-r-border';
			elseif( $stsm_options['stsm-select-style'] == 'horizontal-w-c-circular' )
				$class = 'horizontal-w-c-circular';	
			$class .= ' s-share-w-c';

			$service_markup_arr = get_buttons_w_c_markup_arr();			
					
		}

		$html_markup = '';
		foreach ($service_markup_arr as $key => $value) {
			if( in_array($key, (array)$stsm_options['stsm-selected-services']) ){
				$html_markup .= $value;
			}
		}
		return '<div id="s-share-buttons" class="'.$class.'">'.$html_markup.'</div>';
		
	}

	public function stsm_register_settings(){

		register_setting( 'stsm_options', 'stsm_options' );

	}
	
	/*
	 * Add sub menu page in Settings for configuring plugin
	 */
	public function stsm_register_submenu(){

		add_submenu_page( 'options-general.php', 'Share To Social Media Settings', 'Share To Social Media', 'activate_plugins', 'stsm-share-settings', array( $this, 'stsm_submenu_page' ) );

	}

	/*
	 * Callback for add_submenu_page for generating markup of page
	 */
	public function stsm_submenu_page() {
		?>
		<div class="wrap">
			<h2>Settings</h2>
			<form method="POST" action="options.php">
			<?php settings_fields('stsm_options'); ?>
			<?php
			$stsm_options = get_option('stsm_options');
			$stsm_options['stsm-available-services'] = $this->stsm_get_services();
			?>
			<?php admin_form($stsm_options); ?>
		</div>
		<?php
	}

}
new share_to_social_media;
?>
