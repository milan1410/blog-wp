<?php
/**
 * Template part for displaying posts in list layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package News Portal
 * @subpackage Blogger Portal
 * @since 1.0.0
 */

$extra_post_class = '';
if ( ! has_post_thumbnail() ) {
	$extra_post_class = 'no-image';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr( $extra_post_class ) ); ?>>

	<div class="np-article-thumb">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'news-portal-list-medium' ); ?>
		</a>
	</div><!-- .np-article-thumb -->

	<div class="np-archive-post-content-wrapper">

		<header class="entry-header">
			<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

				if ( 'post' === get_post_type() ) :
			?>
					<div class="entry-meta">
						<?php news_portal_inner_posted_on(); ?>
					</div><!-- .entry-meta -->
			<?php
				endif;
			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_excerpt();
				news_portal_archive_read_more_button();
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php news_portal_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .np-archive-post-content-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->