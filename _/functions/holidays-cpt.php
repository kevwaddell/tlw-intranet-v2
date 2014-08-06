<?php 
add_action( 'init', 'register_cpt_tlw_holiday' );

function register_cpt_tlw_holiday() {

    $labels = array( 
        'name' => _x( 'Holidays', 'tlw_holiday' ),
        'singular_name' => _x( 'Holiday', 'tlw_holiday' ),
        'add_new' => _x( 'Add New', 'tlw_holiday' ),
        'add_new_item' => _x( 'Add New Holiday', 'tlw_holiday' ),
        'edit_item' => _x( 'Edit Holiday', 'tlw_holiday' ),
        'new_item' => _x( 'New Holiday', 'tlw_holiday' ),
        'view_item' => _x( 'View Holiday', 'tlw_holiday' ),
        'search_items' => _x( 'Search Holidays', 'tlw_holiday' ),
        'not_found' => _x( 'No holidays found', 'tlw_holiday' ),
        'not_found_in_trash' => _x( 'No holidays found in Trash', 'tlw_holiday' ),
        'parent_item_colon' => _x( 'Parent Holiday:', 'tlw_holiday' ),
        'menu_name' => _x( 'Holidays', 'tlw_holiday' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'TLW Intranet Holiday CPT.',
        'supports' => array( 'title', 'author' ),
        
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-calendar',
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => false,
        'capability_type' => 'post'
    );

    register_post_type( 'tlw_holiday', $args );
    
    remove_post_type_support( 'tlw_holiday', 'title' );
	
	add_filter('bulk_actions-edit-tlw_holiday','tlw_custom_bulk_actions');
	 
	 function tlw_custom_bulk_actions($actions){
		 //echo '<pre>';print_r($actions);echo '</pre>';
       	unset( $actions['edit'] );
        return $actions;
    }
    
}
?>