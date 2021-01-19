<?php
/*
Plugin Name: Jay_book_review_Plugin
Plugin URI: https://bookreviews.com
Description: create a book review post type
Version: 1.0.0
Author: Jay Luong
Author URI: 
license: GPL2
*/

// Register Book Review Post Type
//Hooking up our function to theme setup
add_action( 'init', 'book_review_post_type', 0 );
//Our custom post type function
function book_review_post_type() {

	$labels = array(
		'name'                  => _x( 'Book Reviews', 'Post Type General Name', 'Jay_book_review_Plugin' ),
		'singular_name'         => _x( 'Book Reviews', 'Post Type Singular Name', 'Jay_book_review_Plugin' ),
		'menu_name'             => _x( 'Book Reviews', 'Jay_book_review_Plugin' ),
		'name_admin_bar'        => _x( 'Book Reviews', 'Jay_book_review_Plugin' ),
		'archives'              => _x( 'Book Review Archives', 'Jay_book_review_Plugin' ),
		'attributes'            => __( 'Book Review Attributes', 'Jay_book_review_Plugin' ),
		'parent_item_colon'     => __( 'Parent Book Reviews:', 'Jay_book_review_Plugin' ),
		'all_items'             => __( 'All Book Review', 'Jay_book_review_Plugin' ),
		'add_new_item'          => __( 'Add New Item', 'Jay_book_review_Plugin' ),
		'add_new'               => __( 'Add New', 'Jay_book_review_Plugin' ),
		'new_item'              => __( 'New Book Item', 'Jay_book_review_Plugin' ),
		'edit_item'             => __( 'Edit Book Review', 'Jay_book_review_Plugin' ),
		'update_item'           => __( 'Update Item', 'Jay_book_review_Plugin' ),
		'view_item'             => __( 'View Book Review', 'Jay_book_review_Plugin' ),
		'view_items'            => __( 'View Book Items', 'Jay_book_review_Plugin' ),
		'search_items'          => __( 'Search Book Item', 'Jay_book_review_Plugin' ),
		'not_found'             => __( 'No Book Reviews found', 'Jay_book_review_Plugin' ),
		'not_found_in_trash'    => __( 'No Book Reviews Found in Trash', 'Jay_book_review_Plugin' ),
		'featured_image'        => __( 'Featured Image', 'Jay_book_review_Plugin' ),
		'set_featured_image'    => __( 'Set featured image', 'Jay_book_review_Plugin' ),
		'remove_featured_image' => __( 'Remove featured image', 'Jay_book_review_Plugin' ),
		'use_featured_image'    => __( 'Use as featured image', 'Jay_book_review_Plugin' ),
		'insert_into_item'      => __( 'Insert into item', 'Jay_book_review_Plugin' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'Jay_book_review_Plugin' ),
		'items_list'            => __( 'Items list', 'Jay_book_review_Plugin' ),
		'items_list_navigation' => __( 'Items list navigation', 'Jay_book_review_Plugin' ),
		'filter_items_list'     => __( 'Filter items list', 'Jay_book_review_Plugin' ),
	);
	
	//Set other options for book review post type
	$args = array(
		'labels'                => $labels,
		'description'           => __( 'Book review for our site.', 'Jay_book_review_Plugin' ),
	
	//Features this book review post type support in Post editor 
		'supports'              => array( 'title', 'editor', 'revision', 'thumbnail', 'ecerpt', 'comments', 'custom-fields'),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'rewrite'				=> array( 'slug' => 'book_review' ),
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
		'capability_type'       =>'post',
		'menu_icon'				=>'dashicons-book-alt',
	);
	//Register book review post type
	register_post_type( 'book_review', $args );

}


//Display the content at the bottom of the post
add_filter( 'the_content', 'prepend_book_data' );
function prepend_book_data ( $content ) {
	
	if ( is_singular ('book_review') ) {

		$author = get_post_meta( get_the_ID(), 'author', true);
		$score = get_post_meta( get_the_ID(), 'score', true);
		$publish_date = get_post_meta( get_the_ID(), 'publish date', true);

		$html = '
			<div class="book-meta">
				<strong>Author: </strong> '.$author.'<br>
				<strong>Score: </strong> '.$score.'<br>
				<strong>Publish Date: </strong> '.$publish_date.'<br>
			</div>	 

		';
			
		return $content . $html;
	}
		
	return $content;
}
