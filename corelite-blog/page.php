<?php
/**
 * Page template for CoreLite Blog.
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
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
			wp_link_pages(
				array(
					'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page sections', 'corelite-blog' ) . '">',
					'after'  => '</nav>',
				)
			);
			?>
		</div>
	</article>

	<?php comments_template(); ?>
<?php endwhile; ?>

<?php
get_footer();
