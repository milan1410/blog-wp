<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * CSS Rules.
 *
 * @package PressBook_Blog
 */

/**
 * Generate dynamic CSS rules for theme.
 */
class PressBook_Blog_CSSRules extends PressBook\CSSRules {
	/**
	 * Top Navbar Background Color 1.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function top_navbar_bg_color_1( $value ) {
		$color_2 = self::saved_styles()['top_navbar_bg_color_2'];

		$rules = array(
			'.top-navbar'                                => array(
				'background' => array(
					'value'  => ( 'linear-gradient(0deg, ' . PressBook\Options\Sanitizer::sanitize_alpha_color( $value ) . ' 0%, ' . PressBook\Options\Sanitizer::sanitize_alpha_color( $color_2 ) . ' 100%)' ),
					'place'  => 'linear-gradient(0deg, _PLACE 0%, _EXTRA_COLOR_2 100%)',
					'extra'  => array(
						'top_navbar_bg_color_2' => '_EXTRA_COLOR_2',
					),
					'remove' => array(
						'top_navbar_bg_color_2',
					),
				),
			),
			'.top-navbar .social-navigation a .svg-icon' => array(
				'color' => array(
					'value' => PressBook\Options\Sanitizer::sanitize_alpha_color( $value ),
					'place' => '_PLACE',
				),
			),
		);

		if ( is_customize_preview() ) {
			$rules['.top-navbar .social-navigation a:active .svg-icon,.top-navbar .social-navigation a:focus .svg-icon,.top-navbar .social-navigation a:hover .svg-icon'] = array(
				'color' => array(
					'value'  => PressBook\Options\Sanitizer::sanitize_alpha_color( $color_2 ),
					'place'  => '_EXTRA_COLOR_2',
					'extra'  => array(
						'top_navbar_bg_color_2' => '_EXTRA_COLOR_2',
					),
					'remove' => array(
						'top_navbar_bg_color_2',
					),
				),
			);
		}

		return $rules;
	}

	/**
	 * Top Navbar Background Color 2.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function top_navbar_bg_color_2( $value ) {
		$color_1 = self::saved_styles()['top_navbar_bg_color_1'];

		$rules = array(
			'.top-navbar' => array(
				'background' => array(
					'skip'   => true,
					'value'  => ( 'linear-gradient(0deg, ' . PressBook\Options\Sanitizer::sanitize_alpha_color( $color_1 ) . ' 0%, ' . PressBook\Options\Sanitizer::sanitize_alpha_color( $value ) . ' 100%)' ),
					'place'  => 'linear-gradient(0deg, _EXTRA_COLOR_1 0%, _PLACE 100%)',
					'extra'  => array(
						'top_navbar_bg_color_1' => '_EXTRA_COLOR_1',
					),
					'remove' => array(
						'top_navbar_bg_color_1',
					),
				),
			),
			'.top-navbar .social-navigation a:active .svg-icon,.top-navbar .social-navigation a:focus .svg-icon,.top-navbar .social-navigation a:hover .svg-icon' => array(
				'color' => array(
					'value' => PressBook\Options\Sanitizer::sanitize_alpha_color( $value ),
					'place' => '_PLACE',
				),
			),
		);

		if ( is_customize_preview() ) {
			$rules['.top-navbar .social-navigation a .svg-icon'] = array(
				'color' => array(
					'value'  => PressBook\Options\Sanitizer::sanitize_alpha_color( $color_1 ),
					'place'  => '_EXTRA_COLOR_1',
					'extra'  => array(
						'top_navbar_bg_color_1' => '_EXTRA_COLOR_1',
					),
					'remove' => array(
						'top_navbar_bg_color_1',
					),
				),
			);
		}

		return $rules;
	}

	/**
	 * Footer Credit Link Color.
	 *
	 * @param string $value Color value.
	 * @return array
	 */
	public static function footer_credit_link_color( $value ) {
		return array(
			'.copyright-text a,.footer-widgets .widget li::before' => array(
				'color' => array(
					'value' => sanitize_hex_color( $value ),
					'place' => '_PLACE',
				),
			),
			'.footer-widgets .widget .widget-title::after,.footer-widgets .widget_block h1:first-child::after,.footer-widgets .widget_block h2:first-child::after,.footer-widgets .widget_block h3:first-child::after' => array(
				'background' => array(
					'value' => sanitize_hex_color( $value ),
					'place' => '_PLACE',
				),
			),
		);
	}
}
