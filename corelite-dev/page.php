<?php
/**
 * Page template for CoreLite Dev.
 *
 * @package CoreLiteDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>
	<?php do_action( 'clt_dev_before_entry' ); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
			wp_link_pages(
				array(
					'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page sections', 'corelite-dev' ) . '">',
					'after'  => '</nav>',
				)
			);
			?>
		</div>
	</article>
	<?php do_action( 'clt_dev_after_entry' ); ?>

	<?php comments_template(); ?>
<?php endwhile; ?>

<?php
get_footer();
