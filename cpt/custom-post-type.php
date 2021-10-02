<?php

/**

 * Security

 */

defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );



/**

 * Register Custom Taxonomies

 *

 * Taxonomy Key: type

 * For url rewriting taxonomy must be registered before CPT

 */

function create_theme_tax() {

	// Exemple d'ajout d'une taxonomie, ici assignée à un CPT emploi et aux pages

	$args = array(
		'labels'                => r1_labels_tax( 'bidouille', 'bidouilles', 'f'),
		'hierarchical'          => true,
		'public'                => true,
		'rewrite'               => array( 'slug' => 'bidouille' ),
		'show_in_rest'          => true, // Important ! pour avoir la taxonomie dans le nouvel éditeur.
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'show_ui'               => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => true,
		'show_tagcloud'         => false,
	);
	register_taxonomy( 'bidouille', array('page', 'test'), $args );

}

add_action( 'init', 'create_theme_tax', 0 );







/**

 * Register Customs Posts Types for Project

 */

function create_custom_cpt() {



	// Exemple d'ajout d'un CPT Emploi

	$args = array(

		'label'                 => __( 'Test', 'R1-starterchild' ),

		'description'           => __( 'Test', 'R1-starterchild' ),

		'labels'                => r1_labels_cpt( 'test', 'tests', 'm'),

		'public'                => true, // CPT Public

		'publicly_queryable'    => true,

		'show_ui'               => true,

		'show_in_menu'          => true,

		'menu_position'         => 5,

		'menu_icon'             => 'dashicons-admin-appearance',

		'rewrite'               => array('slug' => 'test'),

		'capability_type'       => 'page',

		'has_archive'           => true,

		'hierarchical'          => false,

		'show_in_rest'          => true, // Important ! pour avoir avoir le nouvel éditeur.

		'rest_base'             => 'test',

		'rest_controller_class' => 'WP_REST_Posts_Controller',

		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', 'excerpt' ),

	);

	register_post_type( 'test', $args );






}

add_action( 'init', 'create_custom_cpt', 0 );



/**

 * Générer les labels tax et cpt automatiquement

 * @param $singular

 * @param $plural

 * @param $genre

 * @return array

 */

function r1_labels_cpt( $singular, $plural, $genre ) {

	return array(

		'name' => ucfirst( $plural ),

		'singular_name' => ucfirst( $singular ),

		'menu_name' => ucfirst( $plural ),

		'all_items' => r1_label_genre( $singular, $genre, 'Tous', 'Toutes' ) . ' les ' . $plural,

		'add_new' => 'Ajouter ' . r1_label_genre( $singular, $genre, 'un', 'une' ) . ' ' . $singular,

		'add_new_item' => 'Ajouter ' . r1_label_genre( $singular, $genre, 'un', 'une' ) . ' ' . r1_label_genre( $singular, $genre, 'nouveau', 'nouvelle', 'nouvel' ) . ' ' . $singular,

		'edit_item' => 'Éditer ' . r1_label_genre( $singular, $genre, 'le ', 'la ', 'l\'' ) . $singular,

		'new_item' => r1_label_genre( $singular, $genre, 'Nouveau', 'Nouvelle', 'Nouvel' ) . ' ' . $singular,

		'view_item' => 'Voir ' . r1_label_genre( $singular, $genre, 'le ', 'la ', 'l\'' ) . $singular,

		'search_items' => 'Rechercher les ' . $plural,

		'not_found' => 'Pas ' . r1_label_genre( $singular, $genre, 'de ', 'de ', 'd\'' ) . $singular,

		'not_found_in_trash' => 'Pas ' . r1_label_genre( $singular, $genre, 'de ', 'de ', 'd\'' ) . $singular . ' dans la corbeille',

	);

}



function r1_labels_tax( $singular, $plural, $genre ) {

	return array(

		'name' => ucfirst( $plural ),

		'singular_name' => ucfirst( $singular ),

		'menu_name' => ucfirst( $plural ),

		'all_items' => r1_label_genre( $singular, $genre, 'Tous', 'Toutes' ) . ' les ' . $plural,

		'add_new' => 'Ajouter ' . r1_label_genre( $singular, $genre, 'un', 'une' ) . ' ' . $singular,

		'new_item_name' => 'Nouveau nom de ' . $singular,

		'update_item' => 'Mettre à jour ' . r1_label_genre( $singular, $genre, 'le ', 'la ', 'l\'' ) . $singular,

		'add_new_item' => 'Ajouter ' . r1_label_genre( $singular, $genre, 'un', 'une' ) . ' ' . r1_label_genre( $singular, $genre, 'nouveau', 'nouvelle', 'nouvel' ) . ' ' . $singular,

		'edit_item' => 'Éditer ' . r1_label_genre( $singular, $genre, 'le ', 'la ', 'l\'' ) . $singular,

		'new_item' => r1_label_genre( $singular, $genre, 'Nouveau', 'Nouvelle', 'Nouvel' ) . ' ' . $singular,

		'view_item' => 'Voir ' . r1_label_genre( $singular, $genre, 'le ', 'la ', 'l\'' ) . $singular,

		'search_items' => 'Rechercher les ' . $plural,

		'choose_from_most_used' => 'Choisir parmi les ' . $plural . ' les plus ' . r1_label_genre( $singular, $genre, 'utilisés', 'utilisées' ),

		'add_or_remove_items' => 'Ajouter ou supprimer ' . r1_label_genre( $singular, $genre, 'un', 'une' ) . ' ' . $singular,

		'separate_items_with_commas' => 'Séparer les ' . $plural . ' par des virgules',

		'popular_items' => $plural . ' populaires',

		'not_found' => 'Pas ' . r1_label_genre( $singular, $genre, 'de ', 'de ', 'd\'' ) . $singular,

		'not_found_in_trash' => 'Pas ' . r1_label_genre( $singular, $genre, 'de ', 'de ', 'd\'' ) . $singular . ' dans la corbeille',

	);

}



function r1_label_genre( $mot = '', $genre = 'm', $m, $f, $i = '' ) {

	$voyelles = array( 'a', 'e', 'i', 'o', 'u', 'y', 'h', 'à', 'â', 'é', 'è', 'ê', 'î', 'ï', 'ù', 'û', 'ô' );

	if ( '' != $i && in_array( $mot[0], $voyelles ) )

		return $i;

	else

		return ( 'm' == $genre ) ? $m : $f;

}

