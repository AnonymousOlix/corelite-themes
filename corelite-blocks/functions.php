<?php
/**
 * Theme functions for CoreLite Blocks.
 *
 * @package CoreLiteBlocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'clt_blocks_setup' ) ) {
	/**
	 * Set up theme supports for the block theme.
	 *
	 * @return void
	 */
	function clt_blocks_setup() {
		load_theme_textdomain( 'corelite-blocks', get_template_directory() . '/languages' );

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
		add_theme_support( 'editor-styles' );

		add_editor_style( 'style.css' );

		if ( function_exists( 'register_block_pattern_category' ) ) {
			register_block_pattern_category(
				'corelite-blocks-sections',
				array(
					'label' => __( 'CoreLite Sections', 'corelite-blocks' ),
				)
			);
		}
	}
}
add_action( 'after_setup_theme', 'clt_blocks_setup' );

/**
 * Enqueue the front-end stylesheet.
 *
 * @return void
 */
function clt_blocks_enqueue_assets() {
	$theme = wp_get_theme();

	wp_enqueue_style(
		'clt-blocks-style',
		get_stylesheet_uri(),
		array(),
		$theme->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'clt_blocks_enqueue_assets' );

/**
 * Register a simple block style for editor customization.
 *
 * @return void
 */
function clt_blocks_register_block_styles() {
	if ( function_exists( 'register_block_style' ) ) {
		register_block_style(
			'core/group',
			array(
				'name'  => 'clt-surface-panel',
				'label' => __( 'Surface Panel', 'corelite-blocks' ),
			)
		);
	}
}
add_action( 'init', 'clt_blocks_register_block_styles' );
