<?php
/**
 * Single post template for CoreLite Dev.
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
		<?php do_action( 'clt_dev_entry_top' ); ?>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php clt_dev_post_meta(); ?>
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
					'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Post pages', 'corelite-dev' ) . '">',
					'after'  => '</nav>',
				)
			);
			?>
		</div>

		<?php the_tags( '<p class="entry-taxonomy">' . esc_html__( 'Tags: ', 'corelite-dev' ), esc_html_x( ', ', 'list item separator', 'corelite-dev' ), '</p>' ); ?>

		<?php do_action( 'clt_dev_entry_bottom' ); ?>
	</article>
	<?php do_action( 'clt_dev_after_entry' ); ?>

	<?php the_post_navigation(); ?>
	<?php comments_template(); ?>
<?php endwhile; ?>

<?php
get_footer();
