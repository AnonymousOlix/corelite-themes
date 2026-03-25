<?php
/**
 * Theme functions for CoreLite Blog.
 *
 * @package CoreLiteBlog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'clt_blog_setup' ) ) {
	/**
	 * Register theme supports and menus.
	 *
	 * @return void
	 */
	function clt_blog_setup() {
		load_theme_textdomain( 'corelite-blog', get_template_directory() . '/languages' );

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
				'default-color' => 'fcfaf7',
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
				'primary' => __( 'Primary Menu', 'corelite-blog' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'clt_blog_setup' );

/**
 * Enqueue front-end styles.
 *
 * @return void
 */
function clt_blog_enqueue_assets() {
	$theme = wp_get_theme();

	wp_enqueue_style(
		'clt-blog-style',
		get_stylesheet_uri(),
		array(),
		$theme->get( 'Version' )
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'clt_blog_enqueue_assets' );

/**
 * Register a footer widget area.
 *
 * @return void
 */
function clt_blog_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer Widgets', 'corelite-blog' ),
			'id'            => 'footer-1',
			'description'   => __( 'Widgets displayed below the main content.', 'corelite-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'clt_blog_widgets_init' );

/**
 * Register starter block assets for the classic theme.
 *
 * @return void
 */
function clt_blog_register_block_assets() {
	if ( function_exists( 'register_block_style' ) ) {
		register_block_style(
			'core/quote',
			array(
				'name'  => 'clt-blog-soft-quote',
				'label' => __( 'Soft Quote', 'corelite-blog' ),
			)
		);
	}

	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'corelite-blog',
			array(
				'label' => __( 'CoreLite Blog', 'corelite-blog' ),
			)
		);
	}

	if ( function_exists( 'register_block_pattern' ) ) {
		register_block_pattern(
			'corelite-blog/intro',
			array(
				'title'      => __( 'Blog Intro', 'corelite-blog' ),
				'categories' => array( 'corelite-blog' ),
				'content'    => sprintf(
					'<!-- wp:group {"layout":{"type":"constrained"}} --><div class="wp-block-group"><!-- wp:heading {"level":2} --><h2>%1$s</h2><!-- /wp:heading --><!-- wp:paragraph --><p>%2$s</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
					esc_html__( 'A quiet place for thoughtful writing.', 'corelite-blog' ),
					esc_html__( 'Use this area to introduce your publication, notebook, or essay archive.', 'corelite-blog' )
				),
			)
		);
	}
}
add_action( 'init', 'clt_blog_register_block_assets' );

/**
 * Print post meta for archive and singular views.
 *
 * @return void
 */
function clt_blog_post_meta() {
	$published = get_the_date();
	$author    = get_the_author();

	printf(
		'<p class="entry-meta">%1$s <span aria-hidden="true">&middot;</span> %2$s</p>',
		esc_html( $published ),
		esc_html(
			sprintf(
				/* translators: %s: post author name. */
				__( 'By %s', 'corelite-blog' ),
				$author
			)
		)
	);
}
