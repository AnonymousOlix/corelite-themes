<?php
/**
 * Footer template for CoreLite Dev.
 *
 * @package CoreLiteDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
		<?php do_action( 'clt_dev_after_content' ); ?>
	</main>

	<footer class="site-footer">
		<?php do_action( 'clt_dev_before_site_footer' ); ?>
		<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
			<div class="footer-widgets">
				<?php dynamic_sidebar( 'footer-1' ); ?>
			</div>
		<?php endif; ?>
		<p>
			<?php
			printf(
				esc_html__( '%1$s %2$s', 'corelite-dev' ),
				esc_html( wp_date( 'Y' ) ),
				esc_html( get_bloginfo( 'name' ) )
			);
			?>
		</p>
		<?php do_action( 'clt_dev_after_site_footer' ); ?>
	</footer>
</div>
<?php do_action( 'clt_dev_site_after' ); ?>
<?php wp_footer(); ?>
</body>
</html>
