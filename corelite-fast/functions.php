<?php
/**
 * Theme functions for CoreLite Fast.
 *
 * @package CoreLiteFast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'clt_fast_setup' ) ) {
	/**
	 * Register theme support and menus.
	 *
	 * @return void
	 */
	function clt_fast_setup() {
		load_theme_textdomain( 'corelite-fast', get_template_directory() . '/languages' );

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
				'default-color' => 'ffffff',
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
				'primary' => __( 'Primary Menu', 'corelite-fast' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'clt_fast_setup' );

/**
 * Enqueue the public stylesheet and a tiny critical layer.
 *
 * @return void
 */
function clt_fast_enqueue_assets() {
	$theme = wp_get_theme();

	wp_enqueue_style(
		'clt-fast-style',
		get_stylesheet_uri(),
		array(),
		$theme->get( 'Version' )
	);

	wp_add_inline_style(
		'clt-fast-style',
		':root{color-scheme:light;}body{min-height:100vh;}main{display:block;}'
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'clt_fast_enqueue_assets' );

/**
 * Register a footer widget area.
 *
 * @return void
 */
function clt_fast_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer Widgets', 'corelite-fast' ),
			'id'            => 'footer-1',
			'description'   => __( 'Widgets displayed in the footer.', 'corelite-fast' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'clt_fast_widgets_init' );

/**
 * Register lightweight block assets.
 *
 * @return void
 */
function clt_fast_register_block_assets() {
	if ( function_exists( 'register_block_style' ) ) {
		register_block_style(
			'core/separator',
			array(
				'name'  => 'clt-fast-thin-rule',
				'label' => __( 'Thin Rule', 'corelite-fast' ),
			)
		);
	}

	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'corelite-fast',
			array(
				'label' => __( 'CoreLite Fast', 'corelite-fast' ),
			)
		);
	}

	if ( function_exists( 'register_block_pattern' ) ) {
		register_block_pattern(
			'corelite-fast/intro',
			array(
				'title'      => __( 'Fast Intro', 'corelite-fast' ),
				'categories' => array( 'corelite-fast' ),
				'content'    => sprintf(
					'<!-- wp:group {"layout":{"type":"constrained"}} --><div class="wp-block-group"><!-- wp:heading {"level":2} --><h2>%1$s</h2><!-- /wp:heading --><!-- wp:paragraph --><p>%2$s</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
					esc_html__( 'Fast, focused, and uncomplicated.', 'corelite-fast' ),
					esc_html__( 'Use this lightweight intro pattern to lead into content without extra visual weight.', 'corelite-fast' )
				),
			)
		);
	}
}
add_action( 'init', 'clt_fast_register_block_assets' );

/**
 * Render concise post meta output.
 *
 * @return void
 */
function clt_fast_post_meta() {
	printf(
		'<p class="entry-meta">%1$s</p>',
		esc_html(
			sprintf(
				/* translators: %s: published date. */
				__( 'Updated %s', 'corelite-fast' ),
				get_the_date()
			)
		)
	);
}
