<?php
/**
 * Theme functions for CoreLite Dev.
 *
 * @package CoreLiteDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'clt_dev_setup' ) ) {
	/**
	 * Register core theme support.
	 *
	 * This theme intentionally keeps setup close to WordPress defaults so
	 * developers can add features gradually without removing opinions first.
	 *
	 * @return void
	 */
	function clt_dev_setup() {
		load_theme_textdomain( 'corelite-dev', get_template_directory() . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 120,
				'width'       => 320,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'f7f9fc',
			)
		);
		add_theme_support(
			'custom-header',
			array(
				'width'         => 1600,
				'height'        => 420,
				'flex-width'    => true,
				'flex-height'   => true,
				'header-text'   => false,
				'default-image' => '',
			)
		);

		add_editor_style( 'style.css' );

		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'corelite-dev' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'clt_dev_setup' );

/**
 * Enqueue the theme stylesheet.
 *
 * @return void
 */
function clt_dev_enqueue_assets() {
	$theme = wp_get_theme();

	wp_enqueue_style(
		'clt-dev-style',
		get_stylesheet_uri(),
		array(),
		$theme->get( 'Version' )
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'clt_dev_enqueue_assets' );

/**
 * Register a widget area for developers to use as needed.
 *
 * @return void
 */
function clt_dev_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer Widgets', 'corelite-dev' ),
			'id'            => 'footer-1',
			'description'   => __( 'Widgets displayed in the footer area.', 'corelite-dev' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'clt_dev_widgets_init' );

/**
 * Register starter block assets.
 *
 * @return void
 */
function clt_dev_register_block_assets() {
	if ( function_exists( 'register_block_style' ) ) {
		register_block_style(
			'core/group',
			array(
				'name'  => 'clt-dev-outline',
				'label' => __( 'Outline', 'corelite-dev' ),
			)
		);
	}

	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'corelite-dev',
			array(
				'label' => __( 'CoreLite Dev', 'corelite-dev' ),
			)
		);
	}

	if ( function_exists( 'register_block_pattern' ) ) {
		register_block_pattern(
			'corelite-dev/intro',
			array(
				'title'      => __( 'Developer Intro', 'corelite-dev' ),
				'categories' => array( 'corelite-dev' ),
				'content'    => sprintf(
					'<!-- wp:group {"layout":{"type":"constrained"}} --><div class="wp-block-group"><!-- wp:heading {"level":2} --><h2>%1$s</h2><!-- /wp:heading --><!-- wp:paragraph --><p>%2$s</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
					esc_html__( 'Start from a clear baseline.', 'corelite-dev' ),
					esc_html__( 'This pattern gives you a neutral intro section that can be extended however you like.', 'corelite-dev' )
				),
			)
		);
	}
}
add_action( 'init', 'clt_dev_register_block_assets' );

/**
 * Add modest body classes to help developers target layouts quickly.
 *
 * @param string[] $classes Existing body classes.
 * @return string[]
 */
function clt_dev_body_classes( $classes ) {
	if ( is_singular() ) {
		$classes[] = 'clt-dev-singular';
	}

	if ( has_nav_menu( 'primary' ) ) {
		$classes[] = 'clt-dev-has-menu';
	}

	return $classes;
}
add_filter( 'body_class', 'clt_dev_body_classes' );

/**
 * Render simple post metadata.
 *
 * @return void
 */
function clt_dev_post_meta() {
	printf(
		'<p class="entry-meta">%1$s</p>',
		esc_html(
			sprintf(
				/* translators: %s: published date. */
				__( 'Published %s', 'corelite-dev' ),
				get_the_date()
			)
		)
	);
}
