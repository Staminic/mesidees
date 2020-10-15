<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/mesidees.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/mesidees.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'mesidees', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

// Enqueue Google Fonts
function add_google_fonts() {
	wp_enqueue_style( 'add_google_fonts', 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

// Register Widget positions
add_action( 'widgets_init', 'mesidees_widgets_init' );
if ( ! function_exists( 'mesidees_widgets_init' ) ) {
	function mesidees_widgets_init() {
		register_sidebar(
			array(
                'id' => 'header_above',
                'name' => __( 'Header above', 'mesidees' ),
                'description' => __( 'Zone de widgets au dessus du Header', 'mesidees' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widgettitle">',
                'after_title' => '</h4>',			
            )
        );

        register_sidebar(
            array(
                'id' => 'ocs_btn',
                'name' => __( 'Offcanvas button', 'mesidees' ),
                'description' => __( 'Bouton du menu mobile', 'mesidees' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widgettitle">',
                'after_title' => '</h4>',
            )
        );

        register_sidebar(
            array(
                'id' => 'footer_above_left',
                'name' => __( 'Footer above left', 'mesidees' ),
                'description' => __( 'Pied de page gauche', 'mesidees' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widgettitle">',
                'after_title' => '</h4>',
            )
        );

        register_sidebar(
            array(
                'id' => 'footer_above_right',
                'name' => __( 'Footer above right', 'mesidees' ),
                'description' => __( 'Pied de page droite', 'mesidees' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widgettitle">',
                'after_title' => '</h4>',
            )
        );

        register_sidebar(
            array(
                'id' => 'hero_widget',
                'name' => __( 'Hero', 'mesidees' ),
                'description' => __( 'Hero', 'mesidees' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widgettitle">',
                'after_title' => '</h4>',
            )
        );

        register_sidebar(
            array(
                'id' => 'entry_above',
                'name' => __( 'Entry above', 'mesidees' ),
                'description' => __( 'Au dessus de l\'article', 'mesidees' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widgettitle">',
                'after_title' => '</h4>',
            )
        );
    }
}

// IdeaPush
add_filter( "idea_push_change_author_link", "idea_push_change_author_link_callback", 10, 1 );
function idea_push_change_author_link_callback( $userId ) { 
    return "#"; 
}