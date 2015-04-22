<?php

function baby_add_cpt() {

	$args = array(
		'label'        => __( 'Baby Action', 'babytracker' ),
		'public'       => true,
		'hierarchical' => false,
		'rewrite'      => false,
		'supports'     => array( 'editor' ),
	);
	register_post_type( 'baby_action', $args );

}
add_action( 'init', 'baby_add_cpt' );

function baby_add_tax() {

	$args = array(
		'label'        => __( 'Baby Action Type', 'babytracker' ),
		'hierarchical' => false,
		'public'       => true,
		'rewrite'      => false,
	);
	register_taxonomy( 'baby_action_type', 'baby_action', $args );

	if ( ! term_exists( 'poo', 'baby_action_type' ) ) {
		wp_insert_term( 'Poo', 'baby_action_type', array( 'slug' => 'poo' ) );
	}
	if ( ! term_exists( 'pee', 'baby_action_type' ) ) {
		wp_insert_term( 'Pee', 'baby_action_type', array( 'slug' => 'pee' ) );
	}
	if ( ! term_exists( 'eat', 'baby_action_type' ) ) {
		wp_insert_term( 'Eat', 'baby_action_type', array( 'slug' => 'eat' ) );
	}

}
add_action( 'init', 'baby_add_tax' );

function baby_json_query_vars( $vars ) {
	var_dump($vars);
	return $vars;
}
//add_filter( 'query_vars', 'baby_json_query_vars' );