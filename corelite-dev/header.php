<?php
/**
 * Header template for CoreLite Dev.
 *
 * @package CoreLiteDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php do_action( 'clt_dev_site_before' ); ?>
<a class="screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'corelite-dev' ); ?></a>
<div class="site-shell">
	<header class="site-header">
		<?php do_action( 'clt_dev_before_site_header' ); ?>
		<div class="site-header__inner">
			<div class="site-branding">
				<?php the_custom_logo(); ?>
				<p class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
				</p>
				<?php if ( get_bloginfo( 'description' ) ) : ?>
					<p class="site-description"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
				<?php endif; ?>
			</div>

			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav class="primary-navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'corelite-dev' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'depth'          => 1,
						)
					);
					?>
				</nav>
			<?php endif; ?>
		</div>
		<?php do_action( 'clt_dev_after_site_header' ); ?>
	</header>

	<main id="content" class="site-main">
		<?php do_action( 'clt_dev_before_content' ); ?>
