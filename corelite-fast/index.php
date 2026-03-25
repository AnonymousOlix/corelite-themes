<?php
/**
 * Main template file for CoreLite Fast.
 *
 * @package CoreLiteFast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
			<header class="entry-header">
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<?php clt_fast_post_meta(); ?>
			</header>

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div>
		</article>
	<?php endwhile; ?>

	<?php the_posts_navigation(); ?>
<?php else : ?>
	<article class="entry">
		<header class="entry-header">
			<h1 class="entry-title"><?php esc_html_e( 'Nothing found', 'corelite-fast' ); ?></h1>
		</header>
		<div class="entry-content">
			<p><?php esc_html_e( 'Publish a post to populate this theme.', 'corelite-fast' ); ?></p>
		</div>
	</article>
<?php endif; ?>

<?php
get_footer();
