<?php

// Our custom post type function
function RpCustomPost() {

	/**
	 * Post Type: products.
	 */

	$labels = [
		"name" => __( "Products", "twentytwenty" ),
		"singular_name" => __( "Product", "twentytwenty" ),
	];

	$args = [
		"label" => __( "products", "twentytwenty" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "products", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "comments", "author" ],
		"show_in_graphql" => false,
        'menu_icon'           => 'dashicons-products'
	];

	register_post_type( "products", $args );
}

add_action( 'init', 'RpCustomPost' );


?>