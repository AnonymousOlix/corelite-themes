<?php
/**
 * Main template file for CoreLite Blog.
 *
 * @package CoreLiteBlog
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
				<?php clt_blog_post_meta(); ?>
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
		</article>
	<?php endwhile; ?>

	<div class="posts-navigation">
		<?php the_posts_navigation(); ?>
	</div>
<?php else : ?>
	<article class="entry">
		<header class="entry-header">
			<h1 class="entry-title"><?php esc_html_e( 'Nothing found', 'corelite-blog' ); ?></h1>
		</header>
		<div class="entry-content">
			<p><?php esc_html_e( 'There are no posts to display yet.', 'corelite-blog' ); ?></p>
		</div>
	</article>
<?php endif; ?>

<?php
get_footer();
