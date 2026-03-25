<?php
/**
 * Main template file for CoreLite Dev.
 *
 * @package CoreLiteDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<?php do_action( 'clt_dev_before_entry' ); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
			<?php do_action( 'clt_dev_entry_top' ); ?>
			<header class="entry-header">
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<?php clt_dev_post_meta(); ?>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
						<?php the_post_thumbnail( 'large' ); ?>
					</a>
				</div>
			<?php endif; ?>

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div>
			<?php do_action( 'clt_dev_entry_bottom' ); ?>
		</article>
		<?php do_action( 'clt_dev_after_entry' ); ?>
	<?php endwhile; ?>

	<?php the_posts_navigation(); ?>
<?php else : ?>
	<article class="entry">
		<header class="entry-header">
			<h1 class="entry-title"><?php esc_html_e( 'Nothing found', 'corelite-dev' ); ?></h1>
		</header>
		<div class="entry-content">
			<p><?php esc_html_e( 'Create content to see the theme structure in action.', 'corelite-dev' ); ?></p>
		</div>
	</article>
<?php endif; ?>

<?php
get_footer();
