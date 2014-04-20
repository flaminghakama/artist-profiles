<?php
/*
Plugin Name: Artist Profiles
Plugin URI: https://github.com/flaminghakama/artist-profiles
Description: A plugin that creates custom post types for Artist Profiles and Affiliate Profiles;  with Taxonomies for Artist: Location, Ethnicity, Medium, Artistic Discipline, and Taxonomies for Affiliate: Location and Affiliate Discipline; with Terms for all taxonomies.
Version: 1.0
Author: D. Elaine Alt
Author URI: http://flaminghakama.com
License: GPLv2
*/

add_action( 'init', 'create_artist_profile' );
add_action( 'init', 'create_affiliate_profile' );

function create_artist_profile() {
    register_post_type( 'artist-profile',
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
            'menu_position' => 6,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'revisions' ),
            'taxonomies' => array( 'artist-profile-location', 'artist-profile-ethnicity', 'artist-profile-medium', 'artist-profile-discipline' ), 
	    'register_meta_box_cb' => 'when_rendering_artist_profile'
        )
    );
}

function create_affiliate_profile() {
    register_post_type( 'affiliate-profile',
        array(
            'labels' => array(
                'name' => 'Affiliate Profiles',
                'singular_name' => 'Affiliate Profile',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Affiliate Profile',
                'edit' => 'Edit',
                'edit_item' => 'Edit Affiliate Profile',
                'new_item' => 'New Affiliate Profile',
                'view' => 'View',
                'view_item' => 'View Affiliate Profile',
                'search_items' => 'Search Affiliate Profiles',
                'not_found' => 'No Affiliate Profiles found',
                'not_found_in_trash' => 'No Affiliate Profiles found in Trash',
                'parent' => ''
            ), 
            'description' => 'Your public profile on the AAWAA website',
            'public' => true,
	    'exclude_from_search' => false,
            'menu_position' => 8,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'revisions' ),
            'taxonomies' => array( 'affiliate-profile-location', 'affiliate-profile-discipline' ),
	    'register_meta_box_cb' => 'when_rendering_affiliate_profile'
        )
    );
}

/*
 *  Callback functions called when setting up meta boxes for the edit form. 
 *  Do remove_meta_box() and add_meta_box() calls here
 *
 *  @param post Contains the WP_Post object for the currently edited post. 
 *  
 */
function when_rendering_artist_profile($post) { 

    return ; 

    /*
     * Adds a box to the main column on the Artist Profile custom post type admin page
     */
    add_meta_box( 
        'ethnicity_meta_box',
        'Ethnicity',
        'display_ethnicity_meta_box',
        'artist-profile', 'normal', 'high'
    );
    add_meta_box( 
        'location_meta_box',
        'Location',
        'display_location_meta_box',
        'artist-profile', 'normal', 'high'
    );
    add_meta_box( 
        'medium_meta_box',
        'Medium',
        'display_medium_meta_box',
        'artist-profile', 'normal', 'high'
    );
    add_meta_box( 
        'artistic_discipline_meta_box',
        'Discipline',
        'display_artistic_discipline_meta_box',
        'artist-profile', 'normal', 'high'
    );
}

function when_rendering_affiliate_profile($post) { 

    return ; 

    add_meta_box( 
        'location_meta_box',
        'Location',
        'display_location_meta_box',
        'affiliate-profile', 'normal', 'high'
    );
    add_meta_box( 
        'affiliate_discipline_meta_box',
        'Discipline',
        'display_affiliate_discipline_meta_box',
        'affiliate-profile', 'normal', 'high'
    );
}

/*
   Taxonomies for Artist: Location, Ethnicity, Medium, Artistic Discipline
   Taxonomies for Affiliate: Location and Affiliate Discipline 
 */

add_action( 'init', 'create_artist_taxonomies' );
add_action( 'init', 'create_affiliate_taxonomies' );

/*
 * Front end to register_taxonomy
 * @param string taxonomy_name
 * @param string|array post_type
 * @param array labels
 */
function register_profile_taxonomy($taxonomy_name, $post_type, $labels) {

    $capabilities = array(
        'manage_terms' => true,
        'edit_terms' => true,
        'delete_terms' => true,
        'assign_terms' => true
    );

    register_taxonomy(
        $taxonomy_name, 
        $post_type,
        array(
            'labels' => $labels, 
	    'public' => true, 
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
            'capabilities' => $capabilities
        )
    );
}

function create_artist_taxonomies() {

    $post_type = 'artist-profile' ; 

    register_profile_taxonomy(
        'artist-profile-location',
        $post_type,
        array(
            'name' => 'Location',
            'add_new_item' => 'Add Location',
            'new_item_name' => "New Location"
        )
    ) ;

    register_profile_taxonomy(
        'artist-profile-location',
        $post_type,
        array(
            'name' => 'Location',
            'add_new_item' => 'Add Location',
            'new_item_name' => "New Location"
        )
    );

    register_profile_taxonomy(
        'artist-profile-ethnicity',
        $post_type,
        array(
            'name' => 'Ethnicity',
            'add_new_item' => 'Add Ethnicity',
            'new_item_name' => "New Ethnicity"
        )
    );

    register_profile_taxonomy(
        'artist-profile-medium',
        $post_type,
        array(
            'name' => 'Medium',
            'add_new_item' => 'Add Medium',
            'new_item_name' => "New Medium"
        )
    );

    register_profile_taxonomy(
        'artist-profile-discipline',
        $post_type,
        array(
            'name' => 'Artistic Discipline',
            'add_new_item' => 'Add Discipline',
            'new_item_name' => "New Discipline"
        )
    );
}

function create_affiliate_taxonomies() {

    $post_type = 'affiliate-profile' ; 

    register_profile_taxonomy(
        'affiliate-profile-location',
        $post_type,
        array(
            'name' => 'Location',
            'add_new_item' => 'Add Location',
            'new_item_name' => "New Location"
        )
    );

    register_profile_taxonomy(
        'affiliate-profile-discipline',
        $post_type,
        array(
            'name' => 'Affiliate Discipline',
            'add_item' => 'Add Discipline',
            'newm_name' => "New Discipline"
        )
    );
}

/*
 * insert_artist_affilaite_terms
 * Combining artists and affiliates here since they share the same list of locations
 */
function insert_artist_affiliate_terms() {

    /*
     * _insert_terms
     *  A front end to wp_insert_term that loops through the supplied terms and inserts them into the supplied taxonomy.
     *  @param array $terms A list of taxonomy terms to be added
     *  @param string $taxonomy The name of the taxonomy to which to add the terms
     *  @param array|string args (optional) Passed along to wp_insert_term just for compatability, 
     *         Change the values of the inserted term 
    */
    function _insert_terms($terms, $taxonomy, $args='') { 
        foreach($terms as $term) {
            wp_insert_term($term, $taxonomy, $args) ; 
        }
    }

    $locations = array(
        'New York City, NY' => 'New York City, NY',
        'Los Angeles, CA' => 'Los Angeles, CA',
        'Chicago, MI' => 'Chicago, MI',
        'Washington D.C.' => 'Washington D.C.',
        'San Francisco Bay Area' => 'San Francisco Bay Area',
        'Boston, MS' => 'Boston, MS',
        'Philadelphia, PN' => 'Philadelphia, PN',
        'Dallas, TX' => 'Dallas, TX',
        'Houston, TX' => 'Houston, TX',
        'Miami, FL' => 'Miami, FL',
        'Atlanta, GA' => 'Atlanta, GA',
        'Detroit, MI' => 'Detroit, MI',
        'Seattle, WA' => 'Seattle, WA',
        'Portland, OR' => 'Portland, OR',
        'Riverside, CA' => 'Riverside, CA',
        'Phoenix, AZ' => 'Phoenix, AZ',
        'Minneapolis, MN' => 'Minneapolis, MN',
        'Cleveland, OH' => 'Cleveland, OH',
        'Denver, CO' => 'Denver, CO',
        'San Diego, CA' => 'San Diego, CA',
        'Orlando, FL' => 'Orlando, FL',
        'St. Louis, MO' => 'St. Louis, MO',
        'Tampa, FL' => 'Tampa, FL',
        'Sacramento, CA' => 'Sacramento, CA',
        'Charlotte, NC' => 'Charlotte, NC',
        'Kansas City, MO' => 'Kansas City, MO',
        'Salt Lake City, UT' => 'Salt Lake City, UT',
        'Columbus, OH' => 'Columbus, OH',
        'Indianapolis, IN' => 'Indianapolis, IN',
        'Las Vegas, NV' => 'Las Vegas, NV',
        'San Antonio, TX' => 'San Antonio, TX',
        'Cincinnati, OH' => 'Cincinnati, OH',
        'Milwaukee, WI' => 'Milwaukee, WI',
        'Raleigh, NC' => 'Raleigh, NC',
        'Nashville, TN' => 'Nashville, TN',
        'Austin, TX' => 'Austin, TX',
        'Virginia Beach, VA' => 'Virginia Beach, VA',
        'Greensboro, NC' => 'Greensboro, NC',
        'Providence, RI' => 'Providence, RI',
        'Jacksonville, FL' => 'Jacksonville, FL',
        'Hartford, CT' => 'Hartford, CT',
        'Louisville, KY' => 'Louisville, KY',
        'New Orleans, LA' => 'New Orleans, LA',
        'Grand Rapids, MI' => 'Grand Rapids, MI',
        'Greenville, SC' => 'Greenville, SC',
        'Memphis, TN' => 'Memphis, TN',
        'Oklahoma City, OK' => 'Oklahoma City, OK',
        'Birmington, AL' => 'Birmington, AL',
        'Richmond, VA' => 'Richmond, VA',
        'Harrisburg, PA' => 'Harrisburg, PA',
        'Buffalo, NY' => 'Buffalo, NY',
        'Rochester, NY' => 'Rochester, NY',
        'Albany, NY' => 'Albany, NY',
        'Albuquerque, NM' => 'Albuquerque, NM',
        'Tulsa, OK' => 'Tulsa, OK',
        'Fresno, CA' => 'Fresno, CA',
        'Knoxville, TN' => 'Knoxville, TN',
        'Dayton, OH' => 'Dayton, OH',
        'El Paso, TX' => 'El Paso, TX',
        'Tucson, AZ' => 'Tucson, AZ',
        'Cape Coral, FL' => 'Cape Coral, FL',
        'Honolulu, HI' => 'Honolulu, HI',
        'Chattanooga, TN' => 'Chattanooga, TN'
    ); 
	
    $ethnicities = array(
        'South Asian' => 'South Asian',
        'Southeast Asian' => 'Southeast Asian',
        'East Asian' => 'East Asian',
        'Middle Eastern' => 'Middle Eastern',
        'Pacific Islander' => 'Pacific Islander'
    );
	
    $artistic_disciplines = array(
        'Visual Arts' => 'Visual Arts',
        'Performing Arts' => 'Performing Arts',
        'Literature' => 'Literature',
        'Book Arts' => 'Book Arts',
        'Film/Video' => 'Film/Video',
        'Music' => 'Music',
        'New Media' => 'New Media',
        'Mixed Media' => 'Mixed Media',
        'Music ' => 'Music'
    );
 
    $mediums = array(
        'Painting' => 'Painting',
        'Drawing' => 'Drawing',
        'Photography' => 'Photography',
        'Watercolor' => 'Watercolor',
        'Illustration' => 'Illustration',
        'Design' => 'Design',
        'Video' => 'Video',
        'Non-fiction' => 'Non-fiction',
        'Fiction' => 'Fiction',
        'Poetry' => 'Poetry',
        'Dance' => 'Dance',
        'Performance Art' => 'Performance Art',
        'Mixed Media' => 'Mixed Media',
        'Noise/Sound' => 'Noise/Sound',
        'Sculpture' => 'Sculpture',
        'Conceptual' => 'Conceptual',
        'Landscape' => 'Landscape',
        'Digital' => 'Digital',
        'Abstract' => 'Abstract',
        'Realism' => 'Realism',
        'Figurative' => 'Figurative',
        'Installation' => 'Installation',
        'Graffiti/Street Art' => 'Graffiti/Street Art',
        'Narrative ' => 'Narrative',
        'Experimental ' => 'Experimental'
    );

    $affiliate_disciplines = array(
        'Educator' => 'Educator',
        'Curator' => 'Curator',
        'Writer' => 'Writer',
        'Journalist' => 'Journalist',
        'Arts Professionals' => 'Arts Professionals',
        'Arts Organizations' => 'Arts Organizations',
        'Collector' => 'Collector',
        'Scholar' => 'Scholar'
    );

    _insert_terms($locations, 'artist-profile-location') ; 
    _insert_terms($ethnicities, 'artist-profile-ethnicity') ; 
    _insert_terms($mediums, 'artist-profile-medium'); 
    _insert_terms($artistic_disciplines, 'artist-profile-discipline'); 
    _insert_terms($locations, 'affiliate-profile-location') ; 
    _insert_terms($affiliate_disciplines, 'affiliate-profile-discipline') ; 
}

add_action( 'init', 'insert_artist_affiliate_terms' );


/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function display_ethnicity_meta_box( $artist_profile ) {

    // Add an nonce field so we can check for it later.
    //wp_nonce_field( 'artist_ethnicity_meta_box', 'artist_ethnicity_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    //$ethnicity = get_post_meta( $artist_profile->ID, 'artist-profile-ethnicity', true );
    //echo esc_attr( $ethnicity )

}
function display_location_meta_box( $profile ) { echo "display_location_meta_box" ; }
function display_medium_meta_box( $artist_profile ) { }
function display_artistic_discipline_meta_box( $artist_profile ) { }
function display_affiliate_discipline_meta_box( $affiliate_profile ) { }


/*
    Gallery
 */
add_image_size( 'artist-profile-picture', 280, 280, true );
add_image_size( 'artist-profile-gallery-thumbnail', 229, 256, true );

add_action( 'init', 'create_artwork' );

function create_artwork() {
    register_post_type( 'work-of-art',
        array(
            'labels' => array(
                'name' => 'Artwork',
                'singular_name' => 'Work of Art',
                'add_new' => 'Add New Art',
                'add_new_item' => 'Add New Work of Art',
                'edit' => 'Edit',
                'edit_item' => 'Edit Work of Art',
                'new_item' => 'New Work of Art',
                'view' => 'View',
                'view_item' => 'View Work of Art',
                'search_items' => 'Search Artwork',
                'not_found' => 'No Artwork found',
                'not_found_in_trash' => 'No Artwork found in Trash',
                'parent' => ''
            ), 
            'description' => 'Your Gallery of Artwork on the AAWAA website',
            'public' => true,
	    'exclude_from_search' => false,
            'menu_position' => 9,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', ),
            'taxonomies' => array( 'artwork-genre', 'artwork-medium'), 
	    'register_meta_box_cb' => 'when_rendering_artwork'
        )
    );
}

/*
 *  Callback functions called when setting up meta boxes for the edit form. 
 *  @param post Contains the WP_Post object for the currently edited post. 
 */
function when_rendering_artwork($work_of_art) { 
    return ; 
}
?>
