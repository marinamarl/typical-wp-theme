<?php

// add portfolio post type
if ( ! function_exists( 'works_custom_type' ) ) {
	function works_custom_type() {
		$labels = array(
			'name'               => __( 'Works' ),
			'singular_name'      => __( 'Project' ),
			'add_new'            => __( 'Add New' ),
			'add_new_item'       => __( 'Add New Project' ),
			'edit_item'          => __( 'Edit Project' ),
			'new_item'           => __( 'New Project' ),
			'all_items'          => __( 'All Projects' ),
			'view_item'          => __( 'View Project' ),
			'search_items'       => __( 'Search Works' ),
			'not_found'          => __( 'No Project found' ),
			'not_found_in_trash' => __( 'No Project found in the Trash' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Works' )
		);
		$args = array(
			'labels'        => $labels,
			'description'   => 'Holds our Works specific data',
			'public'        => true,
			'menu_icon'     => 'dashicons-portfolio',
			'menu_position' => 5,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'has_archive'   => true,
		);
		register_post_type( 'portfolio', $args );
	}
	add_action( 'init', 'works_custom_type' );
}


if ( ! function_exists( 'portfolio_custom_taxonomies' ) ) {
	function portfolio_custom_taxonomies() {
		$labels = array(
			'name'              => __( 'Categories' ),
			'singular_name'     => __( 'Category' ),
			'search_items'      => __( 'Search Categories' ),
			'all_items'         => __( 'All Categories' ),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'         => __( 'Edit Category' ),
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category' ),
			'menu_name'         => __( 'Categories' )
		);
		$args = array(
			'labels' => $labels,
			'hierarchical' => true,
		);
		register_taxonomy( 'works', 'portfolio', $args );
	}
	add_action( 'init', 'portfolio_custom_taxonomies', 0 );
}

if ( !function_exists( 'get_project_categories' ) ) {
	function get_project_categories($id = NULL, $single = FALSE) {
		$id = $id ? $id : get_the_ID();

		$results = array();
		$categories = get_the_terms(get_the_ID(), 'works');

		if($categories && count($categories)){
			$results = array_map(
				function($row) { return $row->name; },
				$categories
			);
		}

		return count($results) ? ($single ? $results[0] : implode(', ', $results)) : NULL;
	}
}

if ( !function_exists( 'the_primary_category' ) ) {
	function the_primary_category($id = NULL, $type = 'category', $link = FALSE) {
		$id = $id ? $id : get_the_id();
		$terms = get_the_terms($id, $type);

		if ($terms){
			$category_display = '';
			$category_link = '';
			if ( class_exists('WPSEO_Primary_Term') ) {
				// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
				$wpseo_primary_term = new WPSEO_Primary_Term( $type , $id );
				$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
				$term = get_term( $wpseo_primary_term );
				if (is_wp_error($term)) {
					// Default to first category (not Yoast) if an error is returned
					$category_display = $terms[0]->name;
					$category_link = get_category_link( $terms[0]->term_id );
				} else {
					// Yoast Primary category
					$category_display = $term->name;
					$category_link = get_category_link( $term->term_id );
				}
			}
			else {
				// Default, display the first category in WP's list of assigned categories
				$category_display = $terms[0]->name;
				$category_link = get_category_link( $terms[0]->term_id );
			}

			if($link) echo '<a href="'.$category_link.'">'.__($category_display).'</a>';
			else _e($category_display);
		}

	}
}

