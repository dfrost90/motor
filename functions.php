<?php

add_action( 'after_setup_theme', 'motor_setup' );
if ( ! function_exists( 'motor_setup' ) ) :
	/**
	 * Setup theme.
	 */
	function motor_setup() {
		load_theme_textdomain( 'motor', get_template_directory() . '/languages' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 800, 600, true );

		register_nav_menus( array(
			'primary' => __( 'Primary Menu',      'motor' ),
			'social'  => __( 'Social Links Menu', 'motor' ),
			'sidebar' => __( 'Sidebar Menu',      'motor' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif;

add_action( 'wp_enqueue_scripts', 'motor_assets' );
if ( ! function_exists( 'motor_assets' ) ) :
	/**
	 * Register and enqueue all our assets.
	 */
	function motor_assets() {
		// Register our styles.
		wp_register_style(
			'motor-main',
			get_template_directory_uri() . '/assets/styles/dist/main.css',
			array(),
			'0.0.1'
		);

		// Register all fonts.
		wp_register_style(
			'motor-font-droid-serif',
			'https://fonts.googleapis.com/css?family=Droid+Serif:400,700',
			array(),
			null
		);

		wp_register_style(
			'motor-font-roboto',
			'https://fonts.googleapis.com/css?family=Roboto:400,700,300',
			array(),
			null
		);

		wp_register_style(
			'motor-font-oswald',
			'https://fonts.googleapis.com/css?family=Oswald',
			array(),
			null
		);

		// Register our scripts.
		wp_register_script(
			'motor-main',
			get_template_directory_uri() . '/assets/scripts/dist/main.js',
			array( 'jquery' ),
			'0.0.1',
			$in_footer = true
		);

		// Enqueue all assets.
		wp_enqueue_style( 'motor-main' );
		wp_enqueue_style( 'motor-font-droid-serif' );
		wp_enqueue_style( 'motor-font-roboto' );
		wp_enqueue_style( 'motor-font-oswald' );
		wp_enqueue_script( 'motor-main' );
	}
endif;
