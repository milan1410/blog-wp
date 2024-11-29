<?php
/**
 * News Portal functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

if ( ! function_exists( 'news_portal_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function news_portal_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on News Portal, use a find and replace
	 * to change 'news-portal' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'news-portal', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'news-portal-block-medium', 305, 207, true );
	add_image_size( 'news-portal-block-thumb', 136, 102, true );
	add_image_size( 'news-portal-slider-medium', 622, 420, true );
	add_image_size( 'news-portal-carousel-portrait', 400, 600, true );
	add_image_size( 'news-portal-alternate-grid', 340, 316, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'news_portal_top_menu' 		=> esc_html__( 'Top Menu', 'news-portal' ),
		'news_portal_primary_menu' 	=> esc_html__( 'Primary Menu', 'news-portal' ),
		'news_portal_footer_menu' 	=> esc_html__( 'Footer Menu', 'news-portal' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 300,
		'height'      => 45,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'news_portal_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_theme_support( 'starter-content', array(
			'theme_mods' =>  array(
				'news_portal_top_header_option'	=> 'show',
				'news_portal_copyright_text'	=> __( 'News Portal', 'news-portal' )
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// WooCommerce Support
	if ( class_exists( 'WooCommerce' ) ) {
		add_theme_support( 'woocommerce' );
	}

	/**
     * Restoring the classic Widgets Editor
     * 
     * @since 1.3.0
     */
    $np_block_base_widget_editor_option = news_portal_get_customizer_option_value( 'np_block_base_widget_editor_option' );
    if ( false === $np_block_base_widget_editor_option ) {
        remove_theme_support( 'widgets-block-editor' );
    }

}
endif;
add_action( 'after_setup_theme', 'news_portal_setup' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function news_portal_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'news_portal_content_width', 640 );
}
add_action( 'after_setup_theme', 'news_portal_content_width', 0 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * re setup the social_media_icons value according to the new fontawesome version
 */
function news_portal_upgrade_social_icons() {

	$get_old_icons 			= get_theme_mod( 'social_media_icons' );
	$get_decode_old_icons	= json_decode( $get_old_icons );

	if ( ! empty( $get_decode_old_icons ) ) {
		$icon_class_new = array();
		foreach ( $get_decode_old_icons as $key => $single_icon ) {
			$icon_class = $single_icon->social_icon_class;
			$icon_url 	= $single_icon->social_icon_url;
			$check_icon = explode( " ", $icon_class );
			if ( 'fa' == $check_icon[0] ) {
				$icon_class_new[$key]['social_icon_class'] = str_replace( "fa ", "fab ", $icon_class );
				$icon_class_new[$key]['social_icon_url'] = $icon_url;
			}
		}

		if ( ! empty( $icon_class_new ) ) {
			$setting_new_value = json_encode( $icon_class_new );
			set_theme_mod( 'social_media_icons', $setting_new_value );
		}
	}

}
add_action( 'after_setup_theme', 'news_portal_upgrade_social_icons' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Set the theme version
 *
 * @global NEWS_PORTAL_VERSION
 * @since 1.0.0
 */

if ( ! defined( 'NEWS_PORTAL_VERSION' ) ) {
	$news_portal_theme_info = wp_get_theme();
	define( 'NEWS_PORTAL_VERSION', $news_portal_theme_info->get( 'Version' ) );
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function news_portal_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'news_portal_pingback_header' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load theme's preloader styles
 */
require get_template_directory() . '/inc/np-preloader.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Widget function file
 */
require get_template_directory() . '/inc/widgets/np-widget-functions.php';

/**
 * Custom files for hook
 */
require get_template_directory() . '/inc/hooks/np-header-hooks.php';
require get_template_directory() . '/inc/hooks/np-widget-hooks.php';
require get_template_directory() . '/inc/hooks/np-custom-hooks.php';
require get_template_directory() . '/inc/hooks/np-footer-hooks.php';

/**
 * Custom files for post metabox
 */

require get_template_directory() . '/inc/metaboxes/np-post-metabox.php';
require get_template_directory() . '/inc/metaboxes/np-page-metabox.php';

/**
* Load theme dashboard
*/
require get_template_directory() . '/inc/admin/class-news-portal-admin.php';
require get_template_directory() . '/inc/admin/class-news-portal-notice.php';
require get_template_directory() . '/inc/admin/class-news-portal-dashboard.php';

/**
 * Load TGM
 */
require get_template_directory() . '/inc/tgm/np-recommended-plugins.php';

