<?php
/**
 * Describe child theme functions
 *
 * @package News Portal
 * @subpackage Blogger Portal
 * @since 1.0.0
 */

/**
 * Set the theme version
 *
 * @global BLOGGER_PORTAL_VERSION
 * @since 1.0.0
 */

if ( ! defined( 'BLOGGER_PORTAL_VERSION' ) ) {
	$blogger_portal_theme_info = wp_get_theme();
	define( 'BLOGGER_PORTAL_VERSION', $blogger_portal_theme_info->get( 'Version' ) );
}

/*-------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Managed the theme customizer
 */
if ( ! function_exists( 'blogger_portal_customize_register' ) ) :

    function blogger_portal_customize_register( $wp_customize ) {

        global $wp_customize;

        /**
         * Ogma Blogger Default Primary Color.
         *
         * @since 1.0.0
         */
        $wp_customize->get_setting( 'news_portal_theme_color' )->default = '#cf2a88';
        $wp_customize->get_setting( 'news_portal_site_title_color' )->default = '#cf2a88';
        $wp_customize->get_setting( 'news_portal_archive_layout' )->default = 'list';

        $priority = 5;
        $categories = get_categories( array( 'hide_empty' => 1 ) );
        $wp_category_list = array();
        foreach ( $categories as $category_list ) {

            $wp_customize->get_setting( 'news_portal_category_color_'.esc_html( strtolower( $category_list->slug ) ) )->default = '#ad1457';

            $priority++;
        }
    }

endif;

add_action( 'customize_register', 'blogger_portal_customize_register', 20 );

/*-------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Blogger Poral Fonts
 */
if ( ! function_exists( 'blogger_portal_fonts_url' ) ) :

    /**
     * Register Google fonts
     *
     * @return string Google fonts URL for the theme.
     */
    function blogger_portal_fonts_url() {

        $fonts_url = '';
        $font_families = array();

        /*
         * Translators: If there are characters in your language that are not supported
         * by Roboto, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Be Vietnam Pro: on or off', 'blogger-portal' ) ) {
            $font_families[] = 'Be Vietnam Pro:400,600,700';
        }

        if( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }

endif;

/*-------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue child theme styles and scripts
 */
add_action( 'wp_enqueue_scripts', 'blogger_portal_scripts', 99 );

function blogger_portal_scripts() {

    wp_enqueue_style( 'blogger-portal-google-font', blogger_portal_fonts_url(), array(), null );

    wp_dequeue_style( 'news-portal-style' );

    wp_dequeue_style( 'news-portal-responsive-style' );

    wp_enqueue_style( 'news-portal-parent-style', get_template_directory_uri() . '/style.css', array(), BLOGGER_PORTAL_VERSION );

    wp_enqueue_style( 'news-portal-parent-responsive', get_template_directory_uri() . '/assets/css/np-responsive.css', array(), BLOGGER_PORTAL_VERSION );

    wp_enqueue_style( 'blogger-portal-style', get_stylesheet_uri(), array(), BLOGGER_PORTAL_VERSION );

    wp_enqueue_style( 'blogger-portal-responsive', get_stylesheet_directory_uri() . '/assets/css/bp-responsive.css', array(), BLOGGER_PORTAL_VERSION );


}

/*-----------------------------------------------------------------------------------------------------------------------*/

add_action( 'wp_head', 'blogger_portal_dynamic_styles', 99999 );

if ( ! function_exists( 'blogger_portal_dynamic_styles' ) ) :

    /**
     * Dynamic style about template
     *
     * @since 1.0.0
     */
    function blogger_portal_dynamic_styles() {

        $blogger_portal_theme_color = get_theme_mod( 'news_portal_theme_color', '#cf2a88' );
        $blogger_portal_site_title_color = get_theme_mod( 'news_portal_site_title_color', '#cf2a88' );


        $blogger_portal_theme_hover_color = news_portal_hover_color( $blogger_portal_theme_color, '-50' );

        $output_css = '';

        $output_css .= ".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.navigation .nav-links a:hover,.bttn:hover,button,input[type='button']:hover,input[type='reset']:hover,input[type='submit']:hover,.widget_search .search-submit,.edit-link .post-edit-link,.reply .comment-reply-link,.np-top-header-wrap,.np-header-menu-wrapper,#site-navigation ul.sub-menu, #site-navigation ul.children,.np-header-menu-wrapper::before, .np-header-menu-wrapper::after,.np-header-search-wrapper .search-form-main .search-submit,.news_portal_slider .lSAction > a:hover,.news_portal_default_tabbed ul.widget-tabs li,.np-full-width-title-nav-wrap .carousel-nav-action .carousel-controls:hover,.news_portal_social_media .social-link a,.np-archive-more .np-button:hover,.error404 .page-title,#np-scrollup,.news_portal_featured_slider .slider-posts .lSAction > a:hover,div.wpforms-container-full .wpforms-form input[type='submit'], div.wpforms-container-full .wpforms-form button[type='submit'],div.wpforms-container-full .wpforms-form .wpforms-page-button,div.wpforms-container-full .wpforms-form input[type='submit']:hover, div.wpforms-container-full .wpforms-form button[type='submit']:hover,div.wpforms-container-full .wpforms-form .wpforms-page-button:hover,.widget.widget_tag_cloud a:hover,.ticker-caption,.wp-block-search__button { background: ". esc_attr( $blogger_portal_theme_color ) ."}\n";

        $output_css .= ".home .np-home-icon a, .np-home-icon a:hover,#site-navigation ul li:hover > a, #site-navigation ul li.current-menu-item > a,#site-navigation ul li.current_page_item > a,#site-navigation ul li.current-menu-ancestor > a,#site-navigation ul li.focus > a, .news_portal_default_tabbed ul.widget-tabs li.ui-tabs-active, .news_portal_default_tabbed ul.widget-tabs li:hover,.menu-toggle:hover,.menu-toggle:focus{ background: ". esc_attr( $blogger_portal_theme_hover_color ) ."}\n";

        $output_css .= ".np-header-menu-block-wrap::before, .np-header-menu-block-wrap::after { border-right-color: ". esc_attr( $blogger_portal_theme_hover_color ) ."}\n";

        $output_css .= "a,a:hover,a:focus,a:active,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.entry-footer a:hover,.comment-author .fn .url:hover,#cancel-comment-reply-link,#cancel-comment-reply-link:before,.logged-in-as a,.np-slide-content-wrap .post-title a:hover,#top-footer .widget a:hover,#top-footer .widget a:hover:before,#top-footer .widget li:hover:before,.news_portal_featured_posts .np-single-post .np-post-content .np-post-title a:hover,.news_portal_fullwidth_posts .np-single-post .np-post-title a:hover,.news_portal_block_posts .layout3 .np-primary-block-wrap .np-single-post .np-post-title a:hover,.news_portal_featured_posts .layout2 .np-single-post-wrap .np-post-content .np-post-title a:hover,.np-block-title,.widget-title,.page-header .page-title,.np-related-title,.np-post-meta span:hover,.np-post-meta span a:hover,.news_portal_featured_posts .layout2 .np-single-post-wrap .np-post-content .np-post-meta span:hover,.news_portal_featured_posts .layout2 .np-single-post-wrap .np-post-content .np-post-meta span a:hover,.np-post-title.small-size a:hover,#footer-navigation ul li a:hover,.entry-title a:hover,.entry-meta span a:hover,.entry-meta span:hover,.np-post-meta span:hover, .np-post-meta span a:hover, .news_portal_featured_posts .np-single-post-wrap .np-post-content .np-post-meta span:hover, .news_portal_featured_posts .np-single-post-wrap .np-post-content .np-post-meta span a:hover,.news_portal_featured_slider .featured-posts .np-single-post .np-post-content .np-post-title a:hover,.site-title a,.np-archive-more .np-button,.site-mode--dark .news_portal_featured_posts .np-single-post-wrap .np-post-content .np-post-title a:hover, .site-mode--dark .np-post-title.large-size a:hover, .site-mode--dark .np-post-title.small-size a:hover, .site-mode--dark .news-ticker-title > a:hover, .site-mode--dark .np-archive-post-content-wrapper .entry-title a:hover, .site-mode--dark h1.entry-title:hover, .site-mode--dark .news_portal_block_posts .layout4 .np-post-title a:hover{ color: ". esc_attr( $blogger_portal_theme_color ) ."}\n";

        $output_css .= ".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.widget_search .search-submit,.np-archive-more .np-button:hover,.widget.widget_tag_cloud a:hover { border-color: ". esc_attr( $blogger_portal_theme_color ) ."}\n";

        $output_css .= ".comment-list .comment-body,.np-header-search-wrapper .search-form-main { border-top-color: ". esc_attr( $blogger_portal_theme_color ) ."}\n";

        $output_css .= ".np-header-search-wrapper .search-form-main:before { border-bottom-color: ". esc_attr( $blogger_portal_theme_color ) ."}\n";

        $output_css .= "@media (max-width: 768px) { #site-navigation,.main-small-navigation li.current-menu-item > .sub-toggle i { background: ". esc_attr( $blogger_portal_theme_color ) ." !important } }\n";

        // header text color

        $output_css .= ".np-block-title, .widget-title, .page-header .page-title, .np-related-title, .widget_block .wp-block-group__inner-container>h1, .widget_block .wp-block-group__inner-container>h2, .widget_block .wp-block-group__inner-container>h3, .widget_block .wp-block-group__inner-container>h4, .widget_block .wp-block-group__inner-container>h5, .widget_block .wp-block-group__inner-container>h6 { color: ". esc_attr(  $blogger_portal_site_title_color ) ." }\n";

        // categories color
        $get_categories = get_categories( array( 'hide_empty' => 1 ) );
        foreach( $get_categories as $category ) {

            $cat_color          = get_theme_mod( 'news_portal_category_color_'.strtolower( $category->slug ), '#ad1457' );

            $cat_hover_color    = news_portal_hover_color( $cat_color, '-50' );
            $cat_id             = $category->term_id;

            if ( ! empty( $cat_color ) ) {
                $output_css .= ".category-button.np-cat-". esc_attr( $cat_id ) ." a { background: ". esc_attr( $cat_color ) ."}";

                $output_css .= ".category-button.np-cat-". esc_attr( $cat_id ) ." a:hover { background: ". esc_attr( $cat_hover_color ) ."}";

                $output_css .= ".np-block-title .np-cat-". esc_attr( $cat_id ) ." { color: ". esc_attr( $cat_color ) ."}";
            }
        }




        $refine_output_css = news_portal_css_strip_whitespace( $output_css );

        echo "<!--Blogger Portal CSS -->\n<style type=\"text/css\">\n". $refine_output_css ."\n</style>";
    }

endif;


/*------------------------- Footer --------------------------------------------*/

if ( !function_exists ( 'blogger_portal_footer_background_animation' ) ):

    /**
     * Footer Hook Handling
     *
     */
    function blogger_portal_footer_background_animation() {

        echo '
        <div class="blogger-portal-background-animation" >
        <div class="blogger-portal-circles">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        </div>
        </div > <!-- area -->
        ';
    }

endif;

add_action ( 'news_portal_after_page', 'blogger_portal_footer_background_animation', 10 );

function blogger_portal_body_classes( $classes ) {

    /**
     * Class for archive
     */
    if ( is_home() ) {
        $blogger_portal_archive_layout = get_theme_mod( 'news_portal_archive_layout', 'list' );
        if ( !empty( $blogger_portal_archive_layout ) ) {
            $classes[] = 'home-'.$blogger_portal_archive_layout;
        }
    }

    return $classes;

}
add_filter( 'body_class', 'blogger_portal_body_classes' );


if ( ! function_exists( 'news_portal_archive_layout_choices' ) ) :

        /**
         * function to return choices of archive layout.
         *
         * @since 1.5.0
         */
        function news_portal_archive_layout_choices() {

            $archive_layout_choices = apply_filters( 'news_portal_archive_layout_choices',
                array(
                   'classic' => array(
                        'title' => esc_html__( 'Classic', 'blogger-portal' ),
                        'src'   => get_template_directory_uri() . '/assets/images/archive-layout1.png'
                    ),
                    'grid' => array(
                        'title' => esc_html__( 'Grid', 'blogger-portal' ),
                        'src'   => get_template_directory_uri() . '/assets/images/archive-layout2.png'
                    ),
                    'list' => array(
                        'title' => esc_html__( 'List', 'blogger-portal' ),
                        'src'   => get_stylesheet_directory_uri() . '/assets/images/archive-layout3.png'
                    )
                )
            );

            return $archive_layout_choices;

        }

    endif;
