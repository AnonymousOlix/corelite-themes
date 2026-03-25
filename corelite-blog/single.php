<?php
/**
 * Single post template for CoreLite Blog.
 *
 * @package CoreLiteBlog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php clt_blog_post_meta(); ?>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'large' ); ?>
			</div>
		<?php endif; ?>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
			wp_link_pages(
				array(
					'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Post pages', 'corelite-blog' ) . '">',
					'after'  => '</nav>',
				)
			);
			?>
		</div>

		<?php the_tags( '<p class="entry-taxonomy">' . esc_html__( 'Tags: ', 'corelite-blog' ), esc_html_x( ', ', 'list item separator', 'corelite-blog' ), '</p>' ); ?>
	</article>

	<nav class="post-navigation" aria-label="<?php esc_attr_e( 'Post navigation', 'corelite-blog' ); ?>">
		<?php the_post_navigation(); ?>
	</nav>

	<?php comments_template(); ?>
<?php endwhile; ?>

<?php
get_footer();
