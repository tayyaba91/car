<?php add_action('init', 'cardealerAddFieldsPost');
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function cardealerAddFieldsPost() {
	register_post_type( 'cardealerfields', 
		array( 
			'labels' => array(
				'name' => 'Fields',
				'all_items' => 'Fields Table',
				'singular_name' => 'Fields',
				'add_new_item' => 'Add Fields',
				'edit_item' => 'Edit Fields',
				'search_items' => __('Search Fields', 'cardealer'),
				'not_found' => 'No Fields Found',
				'not_found_in_trash' => 'No Fields Found in Trash',
				'menu_name' => 'Car Dealer'
			),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
             'show_in_menu' => false, //'multi-dealer',
			'exclude_from_search' => false,
			'rewrite' => array("slug" => "cardealerfields"),
		)
	);
};
function CarDealer_fields_columns_head($defaults) {
    $defaults['field-order'] = __('Order', 'cardealer');
    $defaults['field-typefield'] = __('Type Field', 'cardealer');
    $defaults['field-label'] = __('Label', 'cardealer');
    $defaults['field-searchbar'] = __('Search Bar', 'cardealer');
    $defaults['field-searchwidget'] = __('Widget', 'cardealer');
    return $defaults;
}
function CarDealer_fields_columns_content($column_name, $post_ID) {
    if ($column_name == 'field-order'){
         echo get_post_meta( $post_ID, 'field-order', true ); 
    }  
    if ($column_name == 'field-typefield'){
         echo get_post_meta( $post_ID, 'field-typefield', true ); 
    }
    elseif ($column_name == 'field-label'){
         echo get_post_meta( $post_ID, 'field-label', true ); 
    }
    elseif ($column_name == 'field-searchbar'){
            if(get_post_meta( $post_ID, 'field-searchbar', true ) == '1')
             echo 'Ok';
            else
             echo 'No';
    }
    elseif ($column_name == 'field-searchwidget'){
        if(get_post_meta( $post_ID, 'field-searchwidget', true ) == '1')
             echo 'Ok';
            else
             echo 'No';      
        }
}
add_filter( 'manage_edit-cardealerfields_sortable_columns', 'cardealer_fields_sortable_column' );
function cardealer_fields_sortable_column( $columns ) {
    $columns['field-label'] = 'Label';
    $columns['field-searchwidget'] = 'Widget';
    $columns['field-typefield'] = 'Type Field';
    $columns['field-searchbar'] = 'Search Bar';
    $columns['field-order'] = 'Order';   
    return $columns;
}
function cardealer_multifields_list($query) {
    if( is_admin()) {
        return;
    }
        $query->set('orderby', 'meta_value');
        $query->set('meta_key', "field-order");
        $query->set('order', 'ASC');
}
if(isset($_GET['post_type'])){
    if (sanitize_text_field($_GET['post_type']) == 'cardealerfields')
      {
        // add_action('pre_get_posts', 'cardealer_multifields_list');
        add_filter('manage_cardealerfields_posts_columns', 'CarDealer_fields_columns_head');
        add_action('manage_cardealerfields_posts_custom_column', 'CarDealer_fields_columns_content', 10, 2);
     }
}?>