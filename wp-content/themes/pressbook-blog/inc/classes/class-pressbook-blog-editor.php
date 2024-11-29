<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Editor service.
 *
 * @package PressBook_Blog
 */

/**
 * Editor setup.
 */
class PressBook_Blog_Editor extends PressBook\Editor {
	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'after_setup_theme', array( $this, 'support_editor_styles' ) );

		add_action( 'enqueue_block_assets', array( $this, 'enqueue_block_assets' ) );
	}

	/**
	 * Enqueue block assets.
	 */
	public function enqueue_block_assets() {
		if ( $this->is_block_screen() ) {
			$this->enqueue_assets();
		}
	}

	/**
	 * Enqueue assets.
	 */
	public function enqueue_assets() {
		// Enqueue fonts.
		wp_enqueue_style( 'pressbook-blog-editor-fonts', PressBook_Blog_Scripts::fonts_url(), array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

		// Add inline style for fonts in the block editor.
		$this->load_editor_fonts_css();

		// Enqueue the block editor stylesheet.
		wp_enqueue_style( 'pressbook-blog-block-editor-style', get_theme_file_uri( 'assets/css/block-editor.css' ), array(), PRESSBOOK_BLOG_VERSION );

		// Add output of customizer settings as inline style.
		wp_add_inline_style( 'pressbook-blog-block-editor-style', PressBook_Blog_CSSRules::output_editor() );
	}

	/**
	 * Check if block editor screen, but not widgets or nav-menus screen.
	 *
	 * @return bool
	 */
	public function is_block_screen() {
		if ( function_exists( '\get_current_screen' ) ) {
			$current_screen = get_current_screen();
			if ( $current_screen ) {
				if ( \in_array( $current_screen->id, array( 'widgets', 'nav-menus' ), true ) ) {
					return false;
				}

				if ( \method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Add inline style for fonts in the block editor.
	 */
	public function load_editor_fonts_css() {
		$fonts_css = '';

		/* translators: If there are characters in your language that are not supported by Raleway, translate this to 'off'. Do not translate into your own language. */
		$raleway = _x( 'on', 'Raleway font (in the editor): on or off', 'pressbook-blog' );
		if ( 'off' !== $raleway ) {
			$fonts_css .= ( '.editor-styles-wrapper.editor-styles-wrapper{font-family:\'Raleway\', sans-serif;}' );
		}

		/* translators: If there are characters in your language that are not supported by Source Sans Pro, translate this to 'off'. Do not translate into your own language. */
		$source_sans_pro = _x( 'on', 'Source Sans Pro font (in the editor): on or off', 'pressbook-blog' );
		if ( 'off' !== $source_sans_pro ) {
			$fonts_css .= ( '.editor-styles-wrapper .editor-post-title__input,.editor-styles-wrapper .editor-post-title .editor-post-title__input,.editor-styles-wrapper h1,.editor-styles-wrapper h2,.editor-styles-wrapper h3,.editor-styles-wrapper h4,.editor-styles-wrapper h5,.editor-styles-wrapper h6{font-family:\'Source Sans Pro\', sans-serif;}' );
		}

		if ( '' !== $fonts_css ) {
			wp_add_inline_style( 'pressbook-blog-editor-fonts', $fonts_css );
		}
	}
}
