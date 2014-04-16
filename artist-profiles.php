<?php
/*
Plugin Name: Artist Profiles
Plugin URI: https://github.com/flaminghakama/artist-profiles
Description: A plugin that creates custom post types for Artist Profiles and Affiliate Profiles with Taxonomies
Version: 1.0
Author: D. Elaine Alt
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
            'menu_position' => 6,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'revisions' ),
            'taxonomies' => array( 'artist_profile_location', 'artist_profile_ethnicity', 'artist_profile_medium', 'artist_profile_discipline' ), 
	    'register_meta_box_cb => 'when_rendering_artist_profile'
        )
    );
}

function create_affiliate_profile() {
    register_post_type( 'affiliate_profile',
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
            'taxonomies' => array( 'affiliate_profile_location', 'affiliate_profile_discipline' ),
	    'register_meta_box_cb => 'when_rendering_affiliate_profile'
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

function create_my_taxonomies() {
    register_taxonomy(
        'artist_profile_location',
        'artist_profile',
        array(
            'labels' => array(
                'name' => 'Location',
                'add_new_item' => 'Add Location',
                'new_item_name' => "New Location"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );

    register_taxonomy(
        'affiliate_profile_location',
        'affiliate_profile',
        array(
            'labels' => array(
                'name' => 'Location',
                'add_new_item' => 'Add Location',
                'new_item_name' => "New Location"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );

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

    register_taxonomy(
        'artist_profile_medium',
        'artist_profile',
        array(
            'labels' => array(
                'name' => 'Medium',
                'add_new_item' => 'Add Medium',
                'new_item_name' => "New Medium"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );

    register_taxonomy(
        'artist_profile_discipline',
        'artist_profile',
        array(
            'labels' => array(
                'name' => 'Artistic Discipline',
                'add_new_item' => 'Add Discipline',
                'new_item_name' => "New Discipline"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );

    register_taxonomy(
        'affiliate_profile_discipline',
        'affiliate_profile',
        array(
            'labels' => array(
                'name' => 'Affiliate Discipline',
                'add_new_item' => 'Add Discipline',
                'new_item_name' => "New Discipline"
            ),
            'show_ui' => true,
            'show_tagcloud' => true,
            'hierarchical' => true
        )
    );
}

/* Taxonomy terms */

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


/*
 * aawaa_insert_terms
 *  A front end to wp_insert_term that loops through the supplied terms and inserts them into the supplied taxonomy.
 *  @param array $terms A list of taxonomy terms to be added
 *  @param string $taxonomy The name of the taxonomy to which to add the terms
 *  @param array|string args (optional) Passed along to wp_insert_term just for compatability, 
 *         Change the values of the inserted term 
*/
function aawaa_insert_terms($terms, $taxonomy, $args='') { 
    foreach($terms as $term) {
        wp_insert_term($term, $taxonomy, $args) ; 
    }
}

aawaa_insert_terms($locations, 'artist_profile_location') ; 
aawaa_insert_terms($locations, 'affiliate_profile_location') ; 
aawaa_insert_terms($ethnicities, 'artist_profile_ethnicity') ; 
aawaa_insert_terms($mediums, 'artist_profile_medium'); 
aawaa_insert_terms($artistic_disciplines, 'artist_profile_discipline'); 
aawaa_insert_terms($affiliate_disciplines, 'affiliate_profile_discipline') ; 

/*
function format_checkbox($taxonomy, $term) { 
  return "<input type='checkbox' name='$taxonomy" . "_$term' value='$term'>$term</input>" ; 
}

function make_checkboxes($terms) { 

    $checkboxes = () ; 
    for term in terms {
      push checkboxes format_checkbox(term) ;
    }

}
*/

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function display_ethnicity_meta_box( $artist_profile ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'artist_ethnicity_meta_box', 'artist_ethnicity_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $ethnicity = get_post_meta( $artist_profile->ID, 'artist_profile_ethnicity', true );
    //echo esc_attr( $ethnicity )

}
function display_location_meta_box( $profile ) { }
function display_medium_meta_box( $artist_profile ) { }
function display_artistic_discipline_meta_box( $artist_profile ) { }
function display_affiliate_discipline_meta_box( $affiliate_profile ) { }
?>
