<?php
/**
 * Theme functions for CoreLite Base.
 *
 * @package CoreLiteBase
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'clt_base_setup' ) ) {
	/**
	 * Set up the internal starter theme defaults.
	 *
	 * @return void
	 */
	function clt_base_setup() {
		load_theme_textdomain( 'corelite-base', get_template_directory() . '/languages' );

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
				'primary' => __( 'Primary Menu', 'corelite-base' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'clt_base_setup' );

/**
 * Enqueue starter theme styles.
 *
 * @return void
 */
function clt_base_enqueue_assets() {
	$theme = wp_get_theme();

	wp_enqueue_style(
		'clt-base-style',
		get_stylesheet_uri(),
		array(),
		$theme->get( 'Version' )
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'clt_base_enqueue_assets' );

/**
 * Register a basic widget area.
 *
 * @return void
 */
function clt_base_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer Widgets', 'corelite-base' ),
			'id'            => 'footer-1',
			'description'   => __( 'Widgets displayed in the site footer.', 'corelite-base' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'clt_base_widgets_init' );

/**
 * Register starter block styles and patterns.
 *
 * @return void
 */
function clt_base_register_block_assets() {
	if ( function_exists( 'register_block_style' ) ) {
		register_block_style(
			'core/group',
			array(
				'name'  => 'clt-base-panel',
				'label' => __( 'Base Panel', 'corelite-base' ),
			)
		);
	}

	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'corelite-base',
			array(
				'label' => __( 'CoreLite Base', 'corelite-base' ),
			)
		);
	}

	if ( function_exists( 'register_block_pattern' ) ) {
		register_block_pattern(
			'corelite-base/intro',
			array(
				'title'      => __( 'Simple Intro', 'corelite-base' ),
				'categories' => array( 'corelite-base' ),
				'content'    => sprintf(
					'<!-- wp:group {"layout":{"type":"constrained"}} --><div class="wp-block-group"><!-- wp:heading --><h2>%1$s</h2><!-- /wp:heading --><!-- wp:paragraph --><p>%2$s</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
					esc_html__( 'Start with a simple introduction.', 'corelite-base' ),
					esc_html__( 'Use this lightweight pattern to introduce a page or section.', 'corelite-base' )
				),
			)
		);
	}
}
add_action( 'init', 'clt_base_register_block_assets' );
