<?php
/**
 * Footer template for CoreLite Blog.
 *
 * @package CoreLiteBlog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
</main>
<footer class="site-footer">
	<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
		<div class="footer-widgets">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>
	<?php endif; ?>
	<p>
		<?php
		printf(
			esc_html__( '%1$s %2$s', 'corelite-blog' ),
			esc_html( wp_date( 'Y' ) ),
			esc_html( get_bloginfo( 'name' ) )
		);
		?>
	</p>
</footer>
<?php wp_footer(); ?>
</body>
</html>
