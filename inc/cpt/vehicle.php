<?php
/**
 * Vehicle Custom Post Type
 *
 * @package vroomqc
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'init', function() {
    register_post_type( 'vehicle', array(
        'labels' => array(
            'name' => 'Vehicles',
            'singular_name' => 'Vehicle',
            'menu_name' => 'Vehicles',
            'all_items' => 'All Vehicles',
            'edit_item' => 'Edit Vehicle',
            'view_item' => 'View Vehicle',
            'view_items' => 'View Vehicles',
            'add_new_item' => 'Add New Vehicle',
            'add_new' => 'Add New Vehicle',
            'new_item' => 'New Vehicle',
            'parent_item_colon' => 'Parent Vehicle:',
            'search_items' => 'Search Vehicles',
            'not_found' => 'No vehicles found',
            'not_found_in_trash' => 'No vehicles found in Trash',
            'archives' => 'Vehicle Archives',
            'attributes' => 'Vehicle Attributes',
            'insert_into_item' => 'Insert into vehicle',
            'uploaded_to_this_item' => 'Uploaded to this vehicle',
            'filter_items_list' => 'Filter vehicles list',
            'filter_by_date' => 'Filter vehicles by date',
            'items_list_navigation' => 'Vehicles list navigation',
            'items_list' => 'Vehicles list',
            'item_published' => 'Vehicle published.',
            'item_published_privately' => 'Vehicle published privately.',
            'item_reverted_to_draft' => 'Vehicle reverted to draft.',
            'item_scheduled' => 'Vehicle scheduled.',
            'item_updated' => 'Vehicle updated.',
            'item_link' => 'Vehicle Link',
            'item_link_description' => 'A link to a vehicle.',
        ),
        'description' => 'A vehicle in our inventory',
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-car',
        'supports' => array(
            0 => 'title',
            1 => 'revisions',
            2 => 'thumbnail',
            3 => 'custom-fields',
        ),
        'has_archive' => 'vehicles',
        'rewrite' => array(
            'feeds' => false,
        ),
        'delete_with_user' => false,
    ) );
} );