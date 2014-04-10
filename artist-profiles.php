<?php
/*
Plugin Name: Artist Profiles
Plugin URI: https://github.com/flaminghakama/artist-profiles
Description: A plugin that creates custom post types for Artist Profiles, Affiliate Profiles and 
Version: 1.0
Author: D. Elaine AltK
Author URI: http://flaminghakama.com
License: GPLv2
*/

add_action( 'init', 'create_artist_profile' );
add_action( 'init', 'create_affiliate_profile' );

function create_artist_profile() {
    register_post_type( 'artist_profile',
        array(
            'labels' => array(
                'name' => 'Artist Profiles',
                'singular_name' => 'Artist Profile',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Artist Profile',
                'edit' => 'Edit',
                'edit_item' => 'Edit Artist Profile',
                'new_item' => 'New Artist Profile',
                'view' => 'View',
                'view_item' => 'View Artist Profile',
                'search_items' => 'Search Artist Profiles',
                'not_found' => 'No Artist Profiles found',
                'not_found_in_trash' => 'No Artist Profiles found in Trash',
                'parent' => ''
            ), 
            'description' => 'Your public profile on the AAWAA website',
            'public' => true,
	    'exclude_from_search' => false,
            'menu_position' => 5,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'revisions' ),
            'taxonomies' => array( '' )
        )
    );
}


function create_my_taxonomies() {
    register_taxonomy(
        'artist_profile_ethnicity',
        'artist_profile',
        array(
            'labels' => array(
                'name' => 'Ethnicity',
                'add_new_item' => 'Add Ethnicity',
                'new_item_name' => "New Ethnicity"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}
?>

