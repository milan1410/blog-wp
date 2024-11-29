<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Posts grid base class.
 *
 * @package PressBook_Blog
 */

/**
 * Base class for posts grid service classes.
 */
abstract class PressBook_Blog_Posts_Grid extends PressBook\Options {
	/**
	 * Posts Source.
	 *
	 * @return array
	 */
	public function source() {
		return array(
			''           => esc_html__( 'All Posts', 'pressbook-blog' ),
			'categories' => esc_html__( 'Posts from Selected Categories', 'pressbook-blog' ),
			'tags'       => esc_html__( 'Posts from Selected Tags', 'pressbook-blog' ),
		);
	}

	/**
	 * Posts Count.
	 *
	 * @return array
	 */
	public function count() {
		return array(
			'1'  => esc_html_x( '1', 'Related Posts Count (Grid Layout)', 'pressbook-blog' ),
			'2'  => esc_html_x( '2', 'Related Posts Count (Grid Layout)', 'pressbook-blog' ),
			'3'  => esc_html_x( '3', 'Related Posts Count (Grid Layout)', 'pressbook-blog' ),
			'4'  => esc_html_x( '4', 'Related Posts Count (Grid Layout)', 'pressbook-blog' ),
			'5'  => esc_html_x( '5', 'Related Posts Count (Grid Layout)', 'pressbook-blog' ),
			'6'  => esc_html_x( '6', 'Related Posts Count (Grid Layout)', 'pressbook-blog' ),
			'7'  => esc_html_x( '7', 'Related Posts Count (Grid Layout)', 'pressbook-blog' ),
			'8'  => esc_html_x( '8', 'Related Posts Count (Grid Layout)', 'pressbook-blog' ),
			'9'  => esc_html_x( '9', 'Related Posts Count (Grid Layout)', 'pressbook-blog' ),
			'10' => esc_html_x( '10', 'Related Posts Count (Grid Layout)', 'pressbook-blog' ),
			'11' => esc_html_x( '11', 'Related Posts Count (Grid Layout)', 'pressbook-blog' ),
			'12' => esc_html_x( '12', 'Related Posts Count (Grid Layout)', 'pressbook-blog' ),
		);
	}

	/**
	 * Posts Order.
	 *
	 * @return array
	 */
	public function order() {
		return array(
			'desc' => esc_html__( 'Latest First', 'pressbook-blog' ),
			'asc'  => esc_html__( 'Oldest First', 'pressbook-blog' ),
		);
	}

	/**
	 * Posts Order By.
	 *
	 * @return array
	 */
	public function orderby() {
		return array(
			'rand'     => esc_html__( 'Random Order', 'pressbook-blog' ),
			'date'     => esc_html__( 'Post Date', 'pressbook-blog' ),
			'modified' => esc_html__( 'Last Modified Date', 'pressbook-blog' ),
		);
	}
}
