<?php
	/**
		* Page with Shortcodes
		*
		* @package     Shortcode Set
		* @subpackage  Admin
		* @copyright   Copyright (c) 2018, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
	// Enable shortdoces in sidebar default Text widget
	add_filter('widget_text', 'do_shortcode');
	
	// 	Include JS and CSS for Shortcodes
	function mystem_extra_scripts() {
		// include style
		wp_enqueue_script('mystem-extra', plugin_dir_url( __FILE__) . 'assets/js/frontend.js', array('jquery'), null, true );
		// include Font Awesome 5.0.6
		wp_enqueue_style( 'mystem-font-awesome', get_template_directory_uri() . '/font-awesome/css/fontawesome-all.min.css', array(), '5.0.11', 'all' );
		// include script
		wp_enqueue_style( 'mystem-extra', plugin_dir_url( __FILE__) . 'assets/css/frontend.css' );
		
		$color = get_theme_mod( 'mystem_color', '#02C285' );	
		$second_color = get_theme_mod( 'mystem_second_color', '#cccccc' );	
		$blocks_color = get_theme_mod( 'mystem_blocks_color', '#ffffff' );
		$text_color = get_theme_mod( 'mystem_text_color', '#363636' );
		
		
		// Custom Style
		$css ='
		.accordion-wrap .accordion-block, .accordion-wrap .accordion-block:last-child, .toggle, .tabs__caption li, .tabs__content {
		border-color: '.$second_color.';
		}
		.accordion-wrap .accordion-title, .tabs__caption .active {
		color: '.$color.';
		}
		.tabs__caption li, .tabs__caption .active:after, .tabs__content {
		background: '.$blocks_color.';			
		}
		.accordion-title .plus, .accordion-title .minus {
		color: '.$text_color.';
		}
		.btn-1, .btn-2, .btn-7, .btn-7:hover, .btn-8, .btn-8:before, .btn-9, .btn-10, .btn-11, .btn-12 {
		border-color: '.$text_color.';
		}
		.btn-1:hover, .btn-2:before, .btn-2:after, .btn-3:before, .btn-3:after, .btn-3 span:before, .btn-3 span:after, .btn-4:before, .btn-4:after, .btn-4 span:before, .btn-4 span:after, .btn-5:before, .btn-5:after, .btn-5 span:before, .btn-5 span:after, .btn-6:before, .btn-6:after, .btn-6 span:before, .btn-6 span:after, .btn-7:before, .btn-7:hover, .btn-8:hover, .btn-8:before, .btn-9:before, .btn-9:after, .btn-9:hover, .btn-10:before, .btn-10:after, .btn-10:hover, .btn-11:before, .btn-11:after, .btn-11:hover, .btn-12:after {
		background: '.$text_color.';					
		}		
		.btn-1:hover, .btn-7:hover, .btn-8:hover, .btn-9:hover, .btn-10:hover, .btn-11:hover, .btn-12:hover {
		color: '.$blocks_color.';
		}';
		$css = trim( preg_replace( '~\s+~s', ' ', $css ) );
		wp_add_inline_style('mystem-extra', $css);		
	}
	add_action( 'wp_enqueue_scripts', 'mystem_extra_scripts' );
	
	function mystem_extra_admin_scripts() {
		// include Font Awesome 5.0.11
		wp_enqueue_style( 'mystem-font-awesome', get_template_directory_uri() . '/font-awesome/css/fontawesome-all.min.css', array(), '5.0.11', 'all' );
		
		// include color picker
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');
		
		// include icon picker
		wp_enqueue_script('mystem-fonticonpicker', get_template_directory_uri() . '/inc/assets/fonticonpicker/js/fonticonpicker.min.js', array('jquery'));
		
		wp_enqueue_style('mystem-fonticonpicker', get_template_directory_uri() . '/inc/assets/fonticonpicker/css/fonticonpicker.min.css');
		
		wp_enqueue_style('mystem-fonticonpicker-darkgrey', get_template_directory_uri() . '/inc/assets/fonticonpicker/css/fonticonpicker.darkgrey.min.css');	
		
	}
	add_action( 'admin_enqueue_scripts', 'mystem_extra_admin_scripts' );
	
	/*-----------------------------------------------------------------------------------*/
	/*	Accordion
	/*-----------------------------------------------------------------------------------*/
	function mystem_extra_accordion( $atts, $content = null ) {
		$item = '<div class="accordion-wrap">'.do_shortcode($content).'</div>';
		return $item;
	}
	add_shortcode('accordion', 'mystem_extra_accordion');
	
	function mystem_extra_accordion_block( $atts, $content = null ) {
		extract(shortcode_atts(array(
		'title' => ''
		), $atts));
		$item = '<div class="accordion-block"><div class="accordion-title"><span class="plus">+</span><span class="minus">-</span>'.$title.'</div><div class="accordion-content">'.do_shortcode($content).'</div></div>';		
		return $item;		
	}
	add_shortcode('accordion_block', 'mystem_extra_accordion_block');
	
	/*-----------------------------------------------------------------------------------*/
	/*	Tabs
	/*-----------------------------------------------------------------------------------*/
	
	function mystem_extra_tabs( $atts, $content = null ) {
		global $shortcode_tabs;
		extract(shortcode_atts(array(
		'style' => ''
		), $atts));		
		do_shortcode($content);		
		$tab_items = '';
		$tab_content = '';
		$finished_tabs = '';
		$id = base_convert(microtime(), 10, 36);		
		if (is_array($shortcode_tabs)) {			
			for ($i = 0; $i < count($shortcode_tabs); $i++) {
				$active_class = ($i == 0) ? ' active' : '';
				$tab_items .= '<li class="'.$active_class.'">'.$shortcode_tabs[$i]['title'].'</li>';				
				$tab_content .= '<div class="tabs__content'.$active_class.'">'.do_shortcode($shortcode_tabs[$i]['content']).'</div>';
			}			
			$finished_tabs = '<div class="tabs '.$style.'"><ul class="tabs__caption">'.$tab_items.'</ul>'.$tab_content.'</div>';
		}
		$shortcode_tabs = '';
		return $finished_tabs;		
	}
	add_shortcode('tabs', 'mystem_extra_tabs');	
	
	// Single Tab
	function mystem_extra_shortcode_tab( $atts, $content = null ) {
		global $shortcode_tabs;
		extract(shortcode_atts(array(
		'title' => ''
		), $atts));
		
		$tab_elements['title'] = $title;
		$tab_elements['content'] = do_shortcode($content);		
		$shortcode_tabs[] = $tab_elements;	
	}
	add_shortcode('tab', 'mystem_extra_shortcode_tab');	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Toggle
	/*-----------------------------------------------------------------------------------*/
	function mystem_extra_toggle( $atts, $content = null ) {
		extract(shortcode_atts(array(
		'title' => ''
		), $atts));
		$id = base_convert(microtime(), 10, 36);		
		$item = '<div class="toggle"><div class="toggle-action"><span class="plus">+</span><span class="minus">-</span><a href="#'.sanitize_title($title).'">'.$title.'</a></div><div class="toggle-content">'.do_shortcode($content).'</div></div>';		
		return $item;		
	}
	add_shortcode('toggle', 'mystem_extra_toggle');
	
	/*-----------------------------------------------------------------------------------*/
	/*	Columns
	/*-----------------------------------------------------------------------------------*/
	function mystem_extra_column_row( $atts, $content = null ) {
		extract(shortcode_atts(array(
		'class' => '',		
		), $atts));
		$class = !empty( $class ) ? ' '.$class : '';
		return '<div class="row'.$class.'">'. do_shortcode($content) .'</div>';
	}
	add_shortcode('row', 'mystem_extra_column_row');
	
	function mystem_extra_column( $atts, $content = null ) {
		return '<div class="column">'. do_shortcode($content) .'</div>';
	}
	add_shortcode('column', 'mystem_extra_column');
	
	/*-----------------------------------------------------------------------------------*/
	/*	Alerts
	/*-----------------------------------------------------------------------------------*/
	
	function mystem_extra_alert( $atts, $content = null ) {
		extract(shortcode_atts(array(
		'type' => '',
		), $atts));
		$type = !empty($type) ? $type : 'info';
		switch ($type) {
			case 'info':
			$icon = '<i class="fas fa-info-circle"></i>';
			break;
			case 'success':
			$icon = '<i class="fas fa-check-circle"></i>';
			break;
			case 'warning':
			$icon = '<i class="fas fa-exclamation-circle"></i>';
			break;
			case 'error':
			$icon = '<i class="fas fa-times-circle"></i>';
			break;
		}
		return '<div class="message_'.$type.'">'.$icon. do_shortcode($content) . '</div>';
	}	
	add_shortcode('alert', 'mystem_extra_alert');
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Icons
	/*-----------------------------------------------------------------------------------*/
	
	function mystem_extra_icon( $atts, $content = null ) {
		extract(shortcode_atts(array(
		'name'          => '',
		'color'         => '',
		'size'          => '',
		'shape'         => '',
		'colorshape'    => '',
		'align'         => '',
		), $atts));
		
		if( $shape !== 'none' ) {
			$width = $size*2;
			if ( $shape == 'fas fa-ban' ) {
				$code = '<span class="fa-stack fa-2x" style="font-size:' . $size . 'px;"><i class="' . $name . ' fa-stack-1x fa-inverse" style="color:' . $color . ';"></i><i class="' . $shape . ' fa-stack-2x" style="color:' . $colorshape . ';"></i></span>';
			}
			else {
				$code = '<span class="fa-stack fa-2x" style="font-size:' . $size . 'px;"><i class="' . $shape . ' fa-stack-2x" style="color:' . $colorshape . ';"></i><i class="' . $name . ' fa-stack-1x fa-inverse" style="color:' . $color . ';"></i></span>';
			}
		}
		else {
			$width = $size;
			$code = '<i class="' . $name . '" style="color:' . $color . ';font-size:' . $size . 'px;"></i>';
		}		
		$code = '<span class="align'.$align.'" style="width:'.$width.'px;">'.$code.'</span>';		
		return $code;		
	}	
	add_shortcode('icon', 'mystem_extra_icon');
	
	/*-----------------------------------------------------------------------------------*/
	/*	Add button in Editor
	/*-----------------------------------------------------------------------------------*/
	
	function mystem_extras_add_button() {		
		if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
			return;
		}
		if ( 'true' == get_user_option( 'rich_editing' ) ) {
			add_filter( 'mce_external_plugins', 'mystem_extras_add_tinymce_script' );
			add_filter( 'mce_buttons_2', 'mystem_extras_register_button' );
		}
	}
	add_action('admin_head', 'mystem_extras_add_button');
	
	function mystem_extras_add_tinymce_script( $plugin_array ) {
		$plugin_array['mystem_extras_button'] = plugin_dir_url( __FILE__) . 'assets/js/admin-button.js';
		return $plugin_array;
	}
	
	function mystem_extras_register_button( $buttons ) {
		array_push( $buttons, 'mystem_extras_button' );
		return $buttons;
	}
	
	/*-----------------------------------------------------------------------------------*/
	/*	Add Icon button in Editor
	/*-----------------------------------------------------------------------------------*/
	
	function mystem_icon_picker_button() {		
		$img = plugin_dir_url( __FILE__) . 'assets/img/icon.png';
		$container_id = 'mystem-icons';
		$title = 'Icons';
		$context = '<a class="thickbox button" id="icon-picker-button" title="'.$title.'" style="outline: medium none !important; cursor: pointer;" ><img class="icon" src="'.$img.'" alt="Icons"/>Icons</a>';
		if(get_current_screen()->parent_base !== 'mystem-company') {
    	echo $context;
    	add_action('admin_footer', 'mystem_icon_picker_add');
		}
	}
	add_action('media_buttons', 'mystem_icon_picker_button', 15 );
	
	
	function mystem_icon_picker_add(){
		wp_enqueue_style( 'mystem-icon-button',  plugin_dir_url( __FILE__) . 'assets/css/admin.css');
		wp_enqueue_script( 'mystem-icon-button', plugin_dir_url( __FILE__) . 'assets/js/admin-icon.js', array( 'wp-color-picker' ));
		require_once plugin_dir_path( __FILE__ ). 'assets/php/button.php';
		if(get_current_screen()->parent_base == 'mystem-company') {
			wp_enqueue_style( 'mystem-extra',  plugin_dir_url( __FILE__) . 'assets/css/frontend.css');
		}
	}
	
	function mystem_tiny_mce_buttons( $buttons_array ){
		if ( !in_array( 'underline', $buttons_array ) && in_array( 'italic', $buttons_array ) ){
			$key = array_search( 'italic', $buttons_array );
			$inserted = array( 'underline' );
			array_splice( $buttons_array, $key + 1, 0, $inserted );
		}
		if ( !in_array( 'alignjustify', $buttons_array ) && in_array( 'alignright', $buttons_array ) ){
			$key = array_search( 'alignright', $buttons_array );
			$inserted = array( 'alignjustify' );
			array_splice( $buttons_array, $key + 1, 0, $inserted );
		}
		return $buttons_array;
	}
	
add_filter( 'mce_buttons', 'mystem_tiny_mce_buttons', 5 );