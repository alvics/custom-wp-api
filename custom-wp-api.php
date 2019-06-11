<?php
/**
 * Plugin Name: Custom WP API
 * Plugin URI: http://allenpavic.ga
 * Description: Custom endpoints for the WordPress API
 * Version: 1.0
 * Author: Allen Pavic
 * Author URI: http://allenpavic.ga
 * Custom end points examples -
 * eg. <your domain>wp-json/api/v1/posts
 * eg. <your domain>wp-json/api/v1/pages
 * eg. <your domain>/wp-json/api/v1/product
 */

/* ================================================================================================
---------------------------- Returns Posts API -----------------------------------------------------
==================================================================================================*/
function api_posts() {
	$args = [
		'numberposts' => 99999,
		'post_type'   => 'post'
	];

	$posts = get_posts( $args );

	$data = [];
	$i    = 0;

	foreach ( $posts as $post ) {
		$data[ $i ]['id']                          = $post->ID;
		$data[ $i ]['title']                       = $post->post_excerpt,
		$data[ $i ]['excerpt']                     = $post->post_title;
		$data[ $i ]['content']                     = $post->post_content;
		$data[ $i ]['slug']                        = $post->post_name;
		$data[ $i ]['featured_image']['thumbnail'] = get_the_post_thumbnail_url( $post->ID, 'thumbnail' );
		$data[ $i ]['featured_image']['medium']    = get_the_post_thumbnail_url( $post->ID, 'medium' );
		$data[ $i ]['featured_image']['large']     = get_the_post_thumbnail_url( $post->ID, 'large' );
		$i ++;
	}

	return $data;
}

/* ================================================================================================
---------------------------- Returns Pages API --------------------------------------------------
==================================================================================================*/

function api_pages() {
	$args = [
		'numberposts' => 99999,
		'post_type'   => 'page'
	];

	$pages = get_posts( $args );

	$data = [];
	$i    = 0;

	foreach ( $pages as $post ) {
		$data[ $i ]['id']                          = $post->ID;
		$data[ $i ]['title']                       = $post->post_title;
		$data[ $i ]['content']                     = $post->post_content;
		$data[ $i ]['slug']                        = $post->post_name;
		$data[ $i ]['featured_image']['thumbnail'] = get_the_post_thumbnail_url( $post->ID, 'thumbnail' );
		$data[ $i ]['featured_image']['medium']    = get_the_post_thumbnail_url( $post->ID, 'medium' );
		$data[ $i ]['featured_image']['large']     = get_the_post_thumbnail_url( $post->ID, 'large' );
		$i ++;
	}

	return $data;
}



/* ================================================================================================
---------------------------- Returns Products API --------------------------------------------------
==================================================================================================*/

function api_products() {
	$args = [
		'numberposts' => 99999,
		'post_type'   => 'product'
	];

	$products = get_posts( $args );

	$data = [];
	$i    = 0;

	foreach ( $products as $post ) {
		$data[ $i ]['id']                          = $post->ID;
		$data[ $i ]['title']                       = $post->post_title;
		$data[ $i ]['content']                     = $post->post_content;
		$data[ $i ]['slug']                        = $post->post_name;
		$data[ $i ]['featured_image']['thumbnail'] = get_the_post_thumbnail_url( $post->ID, 'thumbnail' );
		$data[ $i ]['featured_image']['medium']    = get_the_post_thumbnail_url( $post->ID, 'medium' );
		$data[ $i ]['featured_image']['large']     = get_the_post_thumbnail_url( $post->ID, 'large' );
		$i ++;
	}

	return $data;
}


/*==================================================================================================
------------ Access the endpoint by slug -----------------------------------------------------------
----------------------------------------------------------------------------------------------------
---- eg. <your domain name>/wp-json/api/v1/posts/test  (slug-name for a single post) ---------------
===================================================================================================*/
function api_post( $slug ) {
	$args = [
		'name'      => $slug['slug'],
		'id'        => $slug['slug'],
		'post_type' => 'post'
	];

	$post = get_posts( $args );


	$data['id']                          = $post[0]->ID;
	$data['title']                       = $post[0]->post_title;
	$data['content']                     = $post[0]->post_content;
	$data['slug']                        = $post[0]->post_name;
	$data['featured_image']['thumbnail'] = get_the_post_thumbnail_url( $post[0]->ID, 'thumbnail' );
	$data['featured_image']['medium']    = get_the_post_thumbnail_url( $post[0]->ID, 'medium' );
	$data['featured_image']['large']     = get_the_post_thumbnail_url( $post[0]->ID, 'large' );

	return $data;
}

/* ================================================================================================
---------------------------- Custom Post Types API  (ACF) -----------------------------------------
==================================================================================================*/
//function api_acf( $slug ) {
//	$args = [
//		'name'      => $slug['slug'],
//		'post_type' => 'post'
//	];
//
//	$post = get_posts( $args );
//
//	get_field('name_of_field', $post[0]->ID);
//
//
//	$data['id']                          = $post[0]->ID;
//	$data['title']                       = $post[0]->post_title;
//	$data['content']                     = $post[0]->post_content;
//	$data['slug']                        = $post[0]->post_name;
//	$data['featured_image']['thumbnail'] = get_the_post_thumbnail_url( $post[0]->ID, 'thumbnail' );
//	$data['featured_image']['medium']    = get_the_post_thumbnail_url( $post[0]->ID, 'medium' );
//	$data['featured_image']['large']     = get_the_post_thumbnail_url( $post[0]->ID, 'large' );
//
//	return $data;
//}

/*=======================================================================================================
-------------- Set Methods and Routes -------------------------------------------------------------------
========================================================================================================*/
add_action( 'rest_api_init', function () {
	register_rest_route( 'api/v1', 'posts', [
		'methods'  => 'GET',
		'callback' => 'api_posts',

	] );


	register_rest_route( 'api/v1', 'posts/(?P<slug>[a-zA-Z0-9-]+)', array(
		'methods'  => 'GET',
		'callback' => 'api_post',
	) );
} );


add_action( 'rest_api_init', function () {
	register_rest_route( 'api/v1', 'product', [
		'methods'  => 'GET',
		'callback' => 'api_products',

	] );

	register_rest_route( 'api/v1', 'product/(?P<slug>[a-zA-Z0-9-]+)', array(
		'methods'  => 'GET',
		'callback' => 'api_products',
	) );
} );

add_action( 'rest_api_init', function () {
	register_rest_route( 'api/v1', 'pages', [
		'methods'  => 'GET',
		'callback' => 'api_pages',

	] );


	register_rest_route( 'api/v1', 'pages/(?P<slug>[a-zA-Z0-9-]+)', array(
		'methods'  => 'GET',
		'callback' => 'api_pages',
	) );
} );
