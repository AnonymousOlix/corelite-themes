<?php
/**
 * Fallback index template for CoreLite Blocks.
 *
 * @package CoreLiteBlocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php the_excerpt(); ?>
		</article>
	<?php endwhile; ?>
<?php endif; ?>

<?php
get_footer();
