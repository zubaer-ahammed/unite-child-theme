<?php
function my_theme_enqueue_styles() {

    $parent_style = 'unite-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'unite-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

if ( ! function_exists('film_post_type') ) {

	// Register Custom Post Type
	function film_post_type() {

		$labels = array(
			'name'                  => _x( 'Films', 'Post Type General Name', 'unite-child' ),
			'singular_name'         => _x( 'Film', 'Post Type Singular Name', 'unite-child' ),
			'menu_name'             => __( 'Films', 'unite-child' ),
			'name_admin_bar'        => __( 'Film', 'unite-child' ),
			'archives'              => __( 'Item Archives', 'unite-child' ),
			'attributes'            => __( 'Item Attributes', 'unite-child' ),
			'parent_item_colon'     => __( 'Parent Item:', 'unite-child' ),
			'all_items'             => __( 'All Films', 'unite-child' ),
			'add_new_item'          => __( 'Add New Film', 'unite-child' ),
			'add_new'               => __( 'Add New Film', 'unite-child' ),
			'new_item'              => __( 'New Film', 'unite-child' ),
			'edit_item'             => __( 'Edit Film', 'unite-child' ),
			'update_item'           => __( 'Update Film', 'unite-child' ),
			'view_item'             => __( 'View Film', 'unite-child' ),
			'view_items'            => __( 'View Flims', 'unite-child' ),
			'search_items'          => __( 'Search Film', 'unite-child' ),
			'not_found'             => __( 'Not found', 'unite-child' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'unite-child' ),
			'featured_image'        => __( 'Featured Image', 'unite-child' ),
			'set_featured_image'    => __( 'Set featured image', 'unite-child' ),
			'remove_featured_image' => __( 'Remove featured image', 'unite-child' ),
			'use_featured_image'    => __( 'Use as featured image', 'unite-child' ),
			'insert_into_item'      => __( 'Insert into film', 'unite-child' ),
			'uploaded_to_this_item' => __( 'Uploaded to this film', 'unite-child' ),
			'items_list'            => __( 'Flims list', 'unite-child' ),
			'items_list_navigation' => __( 'Films list navigation', 'unite-child' ),
			'filter_items_list'     => __( 'Filter films list', 'unite-child' ),
		);
		$args = array(
			'label'                 => __( 'Film', 'unite-child' ),
			'description'           => __( 'Films Description', 'unite-child' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'            => array( 'film_genre', 'film_country', 'film_year', 'film_actors' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
		);
		register_post_type( 'film', $args );

	}
	add_action( 'init', 'film_post_type', 0 );

}

// hook into the init action and call create_film_taxonomies when it fires
add_action( 'init', 'create_film_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "film"
function create_film_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Genres', 'taxonomy general name', 'unite-child' ),
		'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'unite-child' ),
		'search_items'      => __( 'Search Genres', 'unite-child' ),
		'all_items'         => __( 'All Genres', 'unite-child' ),
		'parent_item'       => __( 'Parent Genre', 'unite-child' ),
		'parent_item_colon' => __( 'Parent Genre:', 'unite-child' ),
		'edit_item'         => __( 'Edit Genre', 'unite-child' ),
		'update_item'       => __( 'Update Genre', 'unite-child' ),
		'add_new_item'      => __( 'Add New Genre', 'unite-child' ),
		'new_item_name'     => __( 'New Genre Name', 'unite-child' ),
		'menu_name'         => __( 'Genre', 'unite-child' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'film_genre' ),
	);

	register_taxonomy( 'film_genre', array( 'film' ), $args );


	$labels = array(
		'name'              => _x( 'Countries', 'taxonomy general name', 'unite-child' ),
		'singular_name'     => _x( 'Country', 'taxonomy singular name', 'unite-child' ),
		'search_items'      => __( 'Search Countries', 'unite-child' ),
		'all_items'         => __( 'All Countries', 'unite-child' ),
		'parent_item'       => __( 'Parent Country', 'unite-child' ),
		'parent_item_colon' => __( 'Parent Country:', 'unite-child' ),
		'edit_item'         => __( 'Edit Country', 'unite-child' ),
		'update_item'       => __( 'Update Country', 'unite-child' ),
		'add_new_item'      => __( 'Add New Country', 'unite-child' ),
		'new_item_name'     => __( 'New Country Name', 'unite-child' ),
		'menu_name'         => __( 'Country', 'unite-child' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'film_country' ),
	);

	register_taxonomy( 'film_country', array( 'film' ), $args );

	$labels = array(
		'name'              => _x( 'Years', 'taxonomy general name', 'unite-child' ),
		'singular_name'     => _x( 'Year', 'taxonomy singular name', 'unite-child' ),
		'search_items'      => __( 'Search Years', 'unite-child' ),
		'all_items'         => __( 'All Years', 'unite-child' ),
		'parent_item'       => __( 'Parent Year', 'unite-child' ),
		'parent_item_colon' => __( 'Parent Year:', 'unite-child' ),
		'edit_item'         => __( 'Edit Year', 'unite-child' ),
		'update_item'       => __( 'Update Year', 'unite-child' ),
		'add_new_item'      => __( 'Add New Year', 'unite-child' ),
		'new_item_name'     => __( 'New Year Name', 'unite-child' ),
		'menu_name'         => __( 'Year', 'unite-child' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'film_year' ),
	);

	register_taxonomy( 'film_year', array( 'film' ), $args );


	$labels = array(
		'name'              => _x( 'Actors', 'taxonomy general name', 'unite-child' ),
		'singular_name'     => _x( 'Actor', 'taxonomy singular name', 'unite-child' ),
		'search_items'      => __( 'Search Actors', 'unite-child' ),
		'all_items'         => __( 'All Actors', 'unite-child' ),
		'parent_item'       => __( 'Parent Actor', 'unite-child' ),
		'parent_item_colon' => __( 'Parent Actor:', 'unite-child' ),
		'edit_item'         => __( 'Edit Actor', 'unite-child' ),
		'update_item'       => __( 'Update Actor', 'unite-child' ),
		'add_new_item'      => __( 'Add New Actor', 'unite-child' ),
		'new_item_name'     => __( 'New Actor Name', 'unite-child' ),
		'menu_name'         => __( 'Actor', 'unite-child' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'film_actors' ),
	);

	register_taxonomy( 'film_actors', array( 'film' ), $args );


}