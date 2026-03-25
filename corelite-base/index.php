<?php
/**
 * Main template file for CoreLite Base.
 *
 * @package CoreLiteBase
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
				<?php if ( is_singular() ) : ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php else : ?>
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
				<?php endif; ?>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
						<?php the_post_thumbnail( 'large' ); ?>
					</a>
				</div>
			<?php endif; ?>

			<div class="entry-content">
				<?php
				if ( is_singular() ) {
					the_content();
				} else {
					the_excerpt();
				}
				?>
			</div>
		</article>
	<?php endwhile; ?>

	<?php the_posts_navigation(); ?>
<?php else : ?>
	<article class="entry">
		<header class="entry-header">
			<h1 class="entry-title"><?php esc_html_e( 'Nothing found', 'corelite-base' ); ?></h1>
		</header>
		<div class="entry-content">
			<p><?php esc_html_e( 'Add some content or publish your first post to get started.', 'corelite-base' ); ?></p>
		</div>
	</article>
<?php endif; ?>

<?php
get_footer();
