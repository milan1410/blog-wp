<?php
/**
 * Add Panels/Sections to the Customizer.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */ 

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'news_portal_register_customizer_panels_sections' );

if ( ! function_exists( 'news_portal_register_customizer_panels_sections' ) ) :
    
    /**
     * Implement the Theme Customizer for Theme Settings.
     *
     * @param WP_Customize_Manager $wp_customize Theme Customizer object.
     */
    function news_portal_register_customizer_panels_sections( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

    /*--------------------------- Add Panels -------------------------------------*/
        
        /**
         * Add Panel for General Settings
         * 
         * Customize > General Settings
         * 
         * @uses $wp_customize->add_panel() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_panel/
         */
        $wp_customize->add_panel(
            'news_portal_general_settings_panel',
            array(
                'priority'          => 5,
                'title'             => __( 'General Settings', 'news-portal' )
            )
        );

        /**
         * Add Panel for Header Settings
         * 
         * Customize > Header Settings
         * 
         * @uses $wp_customize->add_panel() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_panel/
         */
        $wp_customize->add_panel(
            'news_portal_header_settings_panel',
            array(
                'priority'       => 10,
                'capability'     => 'edit_theme_options',
                'theme_supports' => '',
                'title'          => __( 'Header Settings', 'news-portal' ),
            )
        );

        /**
         * Add Panel for Innerpage Settings
         * 
         * Customize > Innerpage Settings
         * 
         * @uses $wp_customize->add_panel() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_panel/
         */
        $wp_customize->add_panel(
            'news_portal_design_settings_panel',
            array(
                'priority'       => 15,
                'capability'     => 'edit_theme_options',
                'theme_supports' => '',
                'title'          => __( 'Innerpage Settings', 'news-portal' ),
            )
        );

        /**
         * Add Panel for Footer Settings
         * 
         * Customize > Footer Settings
         * 
         * @uses $wp_customize->add_panel() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_panel/
         */
        $wp_customize->add_panel(
            'news_portal_footer_settings_panel',
            array(
                'priority'       => 20,
                'capability'     => 'edit_theme_options',
                'theme_supports' => '',
                'title'          => __( 'Footer Settings', 'news-portal' ),
            )
        );

    }

endif;