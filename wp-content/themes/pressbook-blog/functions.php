<?php
/**
 * This is the child theme for PressBook theme.
 *
 * (See https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 *
 * @package PressBook_Blog
 */

defined( 'ABSPATH' ) || die();

define( 'PRESSBOOK_BLOG_VERSION', '1.3.1' );

/**
 * Load child theme text domain.
 */
function pressbook_blog_setup() {
	load_child_theme_textdomain( 'pressbook-blog', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'pressbook_blog_setup', 11 );

/**
 * Set child theme services.
 *
 * @param  array $services Parent theme services.
 * @return array
 */
function pressbook_blog_services( $services ) {
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-blog-select-multiple.php';
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-blog-cssrules.php';
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-blog-scripts.php';
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-blog-editor.php';
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-blog-posts-grid.php';
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-blog-posts-grid-header.php';
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-blog-posts-grid-related.php';
	require get_stylesheet_directory() . '/inc/classes/class-pressbook-blog-upsell.php';

	foreach ( $services as $key => $service ) {
		if ( 'PressBook\Editor' === $service ) {
			$services[ $key ] = PressBook_Blog_Editor::class;
		} elseif ( 'PressBook\Scripts' === $service ) {
			$services[ $key ] = PressBook_Blog_Scripts::class;
		}
	}

	array_push( $services, PressBook_Blog_Posts_Grid_Header::class );
	array_push( $services, PressBook_Blog_Posts_Grid_Related::class );
	array_push( $services, PressBook_Blog_Upsell::class );

	return $services;
}
add_filter( 'pressbook_services', 'pressbook_blog_services' );

/**
 * Add grid posts section before the header ends.
 */
function pressbook_blog_header_posts_grid() {
	PressBook_Blog_Posts_Grid_Header::html();
}
add_action( 'pressbook_before_header_end', 'pressbook_blog_header_posts_grid', 15 );

/**
 * Change default background args.
 *
 * @param  array $args Custom background args.
 * @return array
 */
function pressbook_blog_custom_background_args( $args ) {
	return array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);
}
add_filter( 'pressbook_custom_background_args', 'pressbook_blog_custom_background_args' );

/**
 * Change default styles.
 *
 * @param  array $styles Default sttyles.
 * @return array
 */
function pressbook_blog_default_styles( $styles ) {
	$styles['top_navbar_bg_color_1']    = '#5d7994';
	$styles['top_navbar_bg_color_2']    = '#354a5f';
	$styles['primary_navbar_bg_color']  = '#4b6a88';
	$styles['button_bg_color_1']        = '#5d7994';
	$styles['button_bg_color_2']        = '#6f88a0';
	$styles['footer_bg_color']          = '#0e0e11';
	$styles['footer_credit_link_color'] = '#007a7c';

	return $styles;
}
add_filter( 'pressbook_default_styles', 'pressbook_blog_default_styles' );

/**
 * Change welcome page title.
 *
 * @param  string $page_title Welcome page title.
 * @return string
 */
function pressbook_blog_welcome_page_title( $page_title ) {
	return esc_html_x( 'PressBook Blog', 'page title', 'pressbook-blog' );
}
add_filter( 'pressbook_welcome_page_title', 'pressbook_blog_welcome_page_title' );

/**
 * Change welcome menu title.
 *
 * @param  string $menu_title Welcome menu title.
 * @return string
 */
function pressbook_blog_welcome_menu_title( $menu_title ) {
	return esc_html_x( 'PressBook Blog', 'menu title', 'pressbook-blog' );
}
add_filter( 'pressbook_welcome_menu_title', 'pressbook_blog_welcome_menu_title' );

/**
 * Recommended plugins.
 */
require get_stylesheet_directory() . '/inc/recommended-plugins.php';
