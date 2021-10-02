<?php
/*
 * Plugin Name:r1 more fields cpt and blocks
 * Description: générateur de cpt, constructeur de blocks et de page d'options sur une base Carbon fields (https://docs.carbonfields.net)
 * Author: Erwan RIVET
 */
/**
 * Security
 */
defined('ABSPATH') or die('Cheatin&#8217; uh?');


/**
 * Namespaces
 */

use Carbon_Fields\Field;
use Carbon_Fields\Container;

/**
 * Carbon fields init.
 */
add_action('after_setup_theme', 'thfo_load');
function thfo_load()
{
    require_once('vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}

/**
 * CPT and taxonomies
 */
require_once('cpt/custom-post-type.php');

/**
 * Option Page
 */
add_action('carbon_fields_register_fields', 'r1_theme_options');
function r1_theme_options()
{
    Container::make('theme_options', __('Theme Options'))
        ->add_tab(__('Test'), array(
            Field::make('text', 'metier_subtitle', 'subtitle'),
            Field::make('rich_text', 'metier_archive_desc', 'archive description'),
        ))
        ->add_tab(__('Réalisations'), array(
            //Field::make('text', 'realisation_subtitle', 'subtitle'),
            //Field::make('rich_text', 'realisation_archive_desc', 'archive description'),
        ));

}

/**
 * BLOCKS
 */

/* Block Exemple */
require_once('blocks/r1-block-example.php');
add_action('carbon_fields_register_fields', 'signature_block');


/**
 * Style and scripts
 * */
function r1_more_fields_add_scripts()
{
    wp_register_script('testing_carbon_script', plugins_url('assets/r1_more_fields_more_blocks.js', __FILE__), array('jquery'), '1.0', true);
    wp_enqueue_script('testing_carbon_script');

    wp_enqueue_style('testing_carbon_styles', plugins_url('assets/r1_more_fields_more_blocks.css', __FILE__), '', '1.0');

}

add_action('wp_enqueue_scripts', 'r1_more_fields_add_scripts');


function single_block_r1_more_blocks_editor_assets()
{
    wp_enqueue_style('testing_carbon_styles', plugins_url('assets/r1_more_fields_more_blocks.css', __FILE__), '', '1.0');

}

// Hook: Editor assets.
add_action('enqueue_block_editor_assets', 'single_block_r1_more_blocks_editor_assets');


/**
 * Tailles d'images
 */
add_image_size('middle', '250', '250', true);


//ADMIN

add_action('admin_enqueue_scripts', 'r1_more_fields');
function r1_more_fields()
{
    wp_enqueue_script('r1_admin_more_fields', plugins_url('assets/r1_admin_more_fields_more_blocks.js', __FILE__),
        array('jquery'
        ), '1.0', true);

    wp_localize_script('r1_admin_more_fields', 'ajaxurl', admin_url('admin-ajax.php'));


}

add_action('admin_menu', 'r1_more_fields_blocks_and_cpt');


function r1_more_fields_blocks_and_cpt()
{
    add_menu_page('More fields blocks and CPT\'s', 'R1 More fields', 'manage_options', 'r1-more-fields', 'r1_more_init', '', 4);


    add_submenu_page(
        'r1-more-fields',
        'Submenu Page',
        'My Custom Submenu Page',
        'manage_options',
        'R1_blocks',
        'R1_blocks_menu');

    add_submenu_page(
        'r1-more-fields',
        'Submenu Page',
        'Mes CPT\'s',
        'manage_options',
        'R1_CPTS',
        'R1_cpts_menu');

    add_submenu_page(
        'r1-more-fields',
        'Submenu Page',
        'Mes taxo\'s',
        'manage_options',
        'R1_taxos',
        'R1_taxos_menu');
}

function r1_more_init()
{
    if (is_admin()):
        echo "<H1>Faire une jolie page d'accueil du plugin  </H1>";
    endif;
}

function R1_blocks_menu()
{
    if (is_admin()):
        echo '<h2>Ici je voudrai éditer les champs de mes blocks gutenberg fais avec Carbon</h2>';
    endif;
}

function R1_cpts_menu()
{
    if (is_admin()):
        echo '<h2>Ici je voudrai Editer les customs Post types  </h2>';
    endif;
}

function R1_taxos_menu()
{
    if (is_admin()):
        echo '<h2>Ici je voudrai  diter les taxonomies </h2>';
    endif;
}