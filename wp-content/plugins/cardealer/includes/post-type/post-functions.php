<?php 
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_action('init', 'cardealerPosts');
function cardealerPosts () {
	register_post_type( 'cars', 
		array( 
			'labels' => array(
				'name' => __('Cars','cardealer'),
				'all_items' => 'All Cars',
				'singular_name' => 'Cars',
				'add_new_item' => 'Add Cars',
				'edit_item' => __('Edit Cars','cardealer'),
				'search_items' => __('Search Cars','cardealer'),
				'view_item' => 'View Cars',
				'not_found' => 'No Cars Found',
				'not_found_in_trash' => 'No Cars Found in Trash'
			),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'has_archive' => true,
			'show_in_menu' => false,
			'supports' => array (
				'title',
				'page-attributes',
				'editor',
				'thumbnail',
			),
			'taxonomies' => array( 'makes',
                'locations',
			),
			'exclude_from_search' => false,
			'_builtin' => false,
			'hierarchical' => false,
			'rewrite' => array("slug" => "car"),
		)
	);
};
add_action('init', 'CarDealer_taxonomies');
function CarDealer_taxonomies() { 
register_taxonomy( 'makes', 'cars', array(
			'labels' => array(
				// 'name' => _x('makes', 'taxonomy general name', 'cardealer'),
				'name' => __('Makes','cardealer'),
				'singular_name' => 'makes',
				'search_items' => __('Search makes','cardealer'),
				'popular_items' => 'Popular makes',
				'all_items' => __('All makes','cardealer'),
				'parent_item' => __( 'Parent makes', 'cardealer' ),
  				'parent_item_colon' => __( 'Parent makes:','cardealer'  ),
				'edit_item' => __( 'Edit makes', 'cardealer' ), 
				'update_item' => __( 'Update makes', 'cardealer' ),
				'add_new_item' => __( 'Add New makes', 'cardealer' ),
				'new_item_name' => __( 'New makes' , 'cardealer'),
				'separate_items_with_commas' => __( 'Separate makes with commas', 'cardealer' ),
				'add_or_remove_items' => __( 'Add or Remove makes' , 'cardealer'),
				'choose_from_most_used' => __( 'Choose from the most used makers', 'cardealer' ),
				'menu_name' => 'Makes',
			),
			'hierarchical' => true,
			'show_ui' => true, // esconde do menu e do edit
			'query_var' => true,
			'rewrite' => array( 'slug' => 'makes' ),
			'public' => true,
            // 'meta_box_cb' => false // show form edit 
            // 'show_in_nav_menus' => false
		)
	);
	
register_taxonomy( 'team', 'cars', array(
			'labels' => array(
				'name' => __('Team','cardealer'),
				'singular_name' => 'team',
				'search_items' => __('Search team','cardealer'),
				'popular_items' => 'Popular team',
				'all_items' => __('All Team','cardealer'),
				'parent_item' => __( 'Parent team', 'cardealer' ),
  				'parent_item_colon' => __( 'Parent team:', 'cardealer' ),
				'edit_item' => __( 'Edit team member', 'cardealer' ), 
				'update_item' => __( 'Update team', 'cardealer' ),
				'add_new_item' => __( 'Add New team member', 'cardealer' ),
				'new_item_name' => __( 'New team' , 'cardealer'),
				'separate_items_with_commas' => __( 'Separate team with commas', 'cardealer' ),
				'add_or_remove_items' => __( 'Add or Remove team' , 'cardealer'),
				'choose_from_most_used' => __( 'Choose from the most used makers', 'cardealer' ),
				'menu_name' => 'team',
			),
			'hierarchical' => true,
			'show_ui' => true, // Hide from menu
			'query_var' => true,
			'rewrite' => array( 'slug' => 'team' ),
			'public' => true,
		)
	);  
	 
   register_taxonomy( 'locations', 'cars', array(
			'labels' => array(
				// 'name' => _x('locations', 'taxonomy general name', 'cardealer'),
				'name' => __('Locations','cardealer'),
				'singular_name' => 'locations',
				'search_items' => __('Search Locations','cardealer'),
				'popular_items' => 'Popular locations',
				'all_items' => __('All Locations','cardealer'),
				'parent_item' => __( 'Parent locations', 'cardealer' ),
  				'parent_item_colon' => __( 'Parent locations:', 'cardealer'  ),
				'edit_item' => __( 'Edit locations', 'cardealer' ), 
				'update_item' => __( 'Update locations', 'cardealer' ),
				'add_new_item' => __( 'Add New locations', 'cardealer' ),
				'new_item_name' => __( 'New locations' , 'cardealer'),
				'separate_items_with_commas' => __( 'Separate locations with commas', 'cardealer' ),
				'add_or_remove_items' => __( 'Add or Remove locations' , 'cardealer'),
				'choose_from_most_used' => __( 'Choose from the most used locations', 'cardealer' ),
				'menu_name' => 'Locations',
			),
			'hierarchical' => true,
			'show_ui' => true, // hide from menu
			'query_var' => true,
			'rewrite' => array( 'slug' => 'location' ),
			'public' => true,
		)
	);
}
// Begin 2018
/////////////////////////
/* Add new Fields to team  Taxonomy */
function cardealer_add_team_fields() {
	?>
   	<div class="form-field">
		<label for="term_meta[myorder]"><?php _e( 'Order:', 'cardealer' ); ?></label></th>
		<input type="text" name="term_meta[myorder]" id="term_meta[myorder]" value="" >
        <p><?php _e( 'Order to display. For example: 1 (first), 2 (second) and so on ...', 'cardealer' ); ?></p>
    </div>    
	<div class="form-field">
		<label for="series_image"><?php _e( 'Profile Image:', 'cardealer' ); ?></label>
        <div class="image-preview"><img class="image-preview" style="max-width: 150px;"></div>
		<br /><br />
        <input type="text" name="term_meta[image]" id="term_meta[image]" class="term_meta_image" value="">
    	<br />
            <p><?php _e( 'Just click the Button to Select Upload Image', 'cardealer' ); ?></p>
        <input class="upload_image_button button" name="_add_series_image" id="_add_series_image" type="button" value="Select/Upload Image" />
		<input class="remove_image_button button" name="_remove_series_image" id="_remove_series_image" type="button" value="Remove Image" />
        <br /><br />
    </div>
  	<div class="form-field">
		<label for="term_meta[function]"><?php _e( 'Position:', 'cardealer' ); ?></label>
		<input type="text" name="term_meta[function]" id="term_meta[function]" value="" >
        <p><?php _e( 'For example: Sales Manager, Agent, and so on ...', 'cardealer' ); ?></p>
    </div> 
 	<div class="form-field">
		<label for="term_meta[phone]"><?php _e( 'Phone:', 'cardealer' ); ?></label>
		<input type="text" name="term_meta[phone]" id="term_meta[phone]" class="term_meta[phone]" value="">
    </div>   
 	<div class="form-field">
		<label for="term_meta[email]"><?php _e( 'Email address:', 'cardealer' ); ?></label>
		<input type="text" name="term_meta[email]" id="term_meta[email]" class="term_meta[email]" value="">
    </div>      
 	<div class="form-field">
		<label for="term_meta[skype]"><?php _e( 'Skype:', 'cardealer' ); ?></label>
		<input type="text" name="term_meta[skype]" id="term_meta[skype]" class="term_meta[skype]" value="">
    </div>     
 	<div class="form-field">
		<label for="term_meta[facebook]"><?php _e( 'Facebook URL:', 'cardealer' ); ?></label>
		<input type="text" name="term_meta[facebook]" id="term_meta[facebook]" class="term_meta[facebook]" value="">
    </div> 
  	<div class="form-field">
		<label for="term_meta[twitter]"><?php _e( 'Twitter URL:', 'cardealer' ); ?></label>
		<input type="text" name="term_meta[twitter]" id="term_meta[twitter]" class="term_meta[twitter]" value="">
    </div>
    <div class="form-field">
		<label for="term_meta[linkedin]"><?php _e( 'Linkedin URL:', 'cardealer' ); ?></label>
		<input type="text" name="term_meta[linkedin]" id="term_meta[linkedin]" class="term_meta[linkedin]" value="">
    </div>
    <div class="form-field">
		<label for="term_meta[youtube]"><?php _e( 'Youtube URL:', 'cardealer' ); ?></label>
		<input type="text" name="term_meta[youtube]" id="term_meta[youtube]" class="term_meta[youtube]" value="">
    </div>  
    <div class="form-field"
		<label for="term_meta[instagram]"><?php _e( 'Instagram URL:', 'cardealer' ); ?></label>
		<input type="text" name="term_meta[instagram]" id="term_meta[instagram]" class="term_meta[instazgram]" value="">
    </div>  
    <div class="form-field">
		<label for="term_meta[vimeo]"><?php _e( 'Vimeo URL:', 'cardealer' ); ?></label>
		<input type="text" name="term_meta[vimeo]" id="term_meta[vimeo]" class="term_meta[vimeo]" value="">
    </div>         
<script>
			jQuery(document).ready(function() {
				jQuery('#_add_series_image').click(function() {
					wp.media.editor.send.attachment = function(props, attachment) {
						jQuery('.term_meta_image').val(attachment.url);
                        jQuery('.image-preview').attr('style','display:block');  
                        jQuery('.image-preview').attr('style','width:150px'); 
                        jQuery('.image-preview').attr('src',attachment.url);  
					}
					wp.media.editor.open(this);
					return false;
				});
 				jQuery('#_remove_series_image').click(function() {
						jQuery('.term_meta_image').val('');
                        jQuery('.image-preview').attr('style','display:none');  
                        jQuery('.profile_old').attr('style','display:none');  
					return false;
				});
                 jQuery('#submit').click(function() {
                        jQuery('.image-preview').attr('style','display:none');  
                        jQuery('.profile_old').attr('style','display:none');  
					return false;
				}); 
			});
</script>            
<?php
}
add_action( 'team_add_form_fields', 'cardealer_add_team_fields', 10, 2 );
function cardealer_edit_team_fields($term) {
 $termMeta = get_option( 'team_' . $term->term_id );
	?>
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[myorder]"><?php _e( 'Order:', 'cardealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[myorder]" id="term_meta[myorder]" value="<?php if(!empty($termMeta['myorder'])){ esc_attr_e($termMeta['myorder']); } ?>" >
        <br /><i><?php _e( 'Order to display. For example: 1 (first), 2 (second) and so on ...', 'cardealer' ); ?></i>
        </td>
   	</tr>   
      <tr class="form-field">    
      <th scope="row" valign="top">      
		<label for="term_meta[image]"><?php _e( 'Profile Image:', 'cardealer' ); ?></label>
        <td>
        <div class="image-preview">
        <img class="image-preview" style="max-width: 150px;">
          <?php
           if(!empty($termMeta['image']))
            {
              $image_url = esc_url($termMeta['image']); 
              echo '<img class = "profile_old" src="'.$image_url.'" width="150px" />';
            }
          ?>      
        </div>
		<br /><br />
        <input type="text" name="term_meta[image]" id="term_meta[image]" class="term_meta_image" value="<?php if(!empty($termMeta['image'])){ esc_attr_e($termMeta['image']); } ?>">
    	<br /><br />
        <input class="upload_image_button button" name="_add_series_image" id="_add_series_image" type="button" value="Select/Upload Image" />
		<input class="remove_image_button button" name="_remove_series_image" id="_remove_series_image" type="button" value="Remove Image" />
        <br /><i><?php _e( 'Just click the Button to Select Upload Image', 'cardealer' ); ?></i>
        </td>
   	</tr> 
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[function]"><?php _e( 'Position:', 'cardealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[function]" id="term_meta[function]" value="<?php if(!empty($termMeta['function'])){ esc_attr_e($termMeta['function']); } ?>" >
        <br /><i><?php _e( 'For example: Sales Manager, Agent, and so on ...', 'cardealer' ); ?></i>
        </td>
   	</tr>
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[phone]"><?php _e( 'Phone:', 'cardealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[phone]" id="term_meta[phone]" value="<?php if(!empty($termMeta['phone'])){ esc_attr_e($termMeta['phone']); } ?>" >
        </td>
   	</tr>  
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[email]"><?php _e( 'Email address:', 'cardealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[email]" id="term_meta[email]" value="<?php if(!empty($termMeta['email'])){ esc_attr_e($termMeta['email']); } ?>" >
        </td>
   	</tr>     
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[skype]"><?php _e( 'Skype:', 'cardealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[skype]" id="term_meta[skype]" value="<?php if(!empty($termMeta['skype'])){ esc_attr_e($termMeta['skype']); } ?>" >
        </td>
   	</tr> 
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[facebook]"><?php _e( 'Facebook URL:', 'cardealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[facebook]" id="term_meta[facebook]" value="<?php if(!empty($termMeta['facebook'])){ esc_attr_e($termMeta['facebook']); } ?>" >
        </td>
   	</tr> 
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[twitter]"><?php _e( 'Twitter URL:', 'cardealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[twitter]" id="term_meta[twitter]" value="<?php if(!empty($termMeta['twitter'])){ esc_attr_e($termMeta['twitter']); } ?>" >
        </td>
   	</tr>
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[linkedin]"><?php _e( 'Linkedin URL:', 'cardealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[linkedin]" id="term_meta[linkedin]" value="<?php if(!empty($termMeta['linkedin'])){ esc_attr_e($termMeta['linkedin']); } ?>" >
        </td>
   	</tr>   
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[youtube]"><?php _e( 'Youtube URL:', 'cardealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[youtube]" id="term_meta[youtube]" value="<?php if(!empty($termMeta['youtube'])){ esc_attr_e($termMeta['youtube']); } ?>" >
        </td>
   	</tr>
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[instagram]"><?php _e( 'Instagram URL:', 'cardealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[instagram]" id="term_meta[instagram]" value="<?php if(!empty($termMeta['instagram'])){ esc_attr_e($termMeta['instagram']); } ?>" >
        </td>
   	</tr>
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[vimeo]"><?php _e( 'Vimeo URL:', 'cardealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[vimeo]" id="term_meta[vimeo]" value="<?php if(!empty($termMeta['vimeo'])){ esc_attr_e($termMeta['vimeo']); } ?>" >
        </td>
   	</tr>   
<script>
			jQuery(document).ready(function() {
				jQuery('#_add_series_image').click(function() {
					wp.media.editor.send.attachment = function(props, attachment) {
						jQuery('.term_meta_image').val(attachment.url);
                        jQuery('.image-preview').attr('src',attachment.url);  
                        jQuery('.profile_old').attr('style','display:none');  
                        jQuery('.image-preview').attr('style','display:block');  
                        jQuery('.image-preview').attr('style','width:150px'); 
                        jQuery('.image-preview').attr('src',attachment.url);  
                    }
					wp.media.editor.open(this);
					return false;
				});
 				jQuery('#_remove_series_image').click(function() {
						jQuery('.term_meta_image').val('');
                        jQuery('.image-preview').attr('style','display:none');  
                        jQuery('.profile_old').attr('style','display:none');  
					return false;
				}); 
			});
</script>  
<?php 
}
add_action( 'team_edit_form_fields', 'cardealer_edit_team_fields', 10, 2 );
/**
 * Save the taxonomy custom meta
 */
function cardealer_save_team_fields($termId)
{
    if ( !empty( $_POST['term_meta'] ) )
    {
        $term_meta = get_option( 'team_' . $termId );
        foreach ( $_POST['term_meta'] as $key => $val )
        {
            $term_meta[$key] = sanitize_text_field($val);
        }
        update_option( 'team_' . $termId, $term_meta );
    }
}
/**
* Save the category data
*/
add_action( 'edited_team', 'cardealer_save_team_fields');
add_action( 'create_team', 'cardealer_save_team_fields');
//End 2018
/////////////////////////
function cardealer_custom_listing_save_data($post_id) {
    global $meta_box,  $post;
    if( isset($_POST['listing_meta_box_nonce']))
    {
        if (!wp_verify_nonce($_POST['listing_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    if ( isset($_POST['post_type']))
     { 
        if ('page' == sanitize_text_field($_POST['post_type'])) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    }
}
add_action('save_post', 'cardealer_custom_listing_save_data');
add_image_size('featured_preview', 55, 55, true);
 // GET FEATURED IMAGE
function CarDealer_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
        return $post_thumbnail_img[0];
    }
}
// ADD NEW COLUMN
add_action('admin_head', 'CarDealer_my_admin_custom_styles');
function CarDealer_my_admin_custom_styles() {
    $output_css = '<style type="text/css">
        .featured_image { width:150px !important; overflow:hidden }
    </style>';
    echo $output_css;
}
function CarDealer_columns_head($defaults) {
    $defaults['car-price'] = __('Price', 'cardealer');
    $defaults['featured_image'] = __('Featured Image', 'cardealer' );
    $defaults['car-featured'] = __('Featured', 'cardealer' );
    $defaults['car-year'] = __('Year','cardealer' );
    return $defaults;
}
// SHOW THE FEATURED IMAGE
function CarDealer_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = CarDealer_get_featured_image($post_ID);
 		$image_id = get_post_thumbnail_id($post_ID);
		$image_url = wp_get_attachment_image_src($image_id,'medium', true);	
		$image = str_replace("-".$image_url[1]."x".$image_url[2], "", $image_url[0]);
        $thumb = CarDealer_theme_thumb($image, 150, 75, 'br'); // Crops from bottom right
        if ($post_featured_image) {
            echo '<img src="' . $thumb . '" width="150px" height="75px" />';
        }
        else
          {
            echo '<img src="'.CARDEALERURL.'assets/images/image-no-available.jpg" width="100px" />';}
    }
    elseif ($column_name == 'car-year'){
         echo get_post_meta( $post_ID, 'car-year', true ); 
    }
    elseif ($column_name == 'car-price'){
         $price = get_post_meta( $post_ID, 'car-price', true );
         if(! empty($price)) 
            echo  cardealer_currency() . $price ; 
         else
            echo  __('Call For Price', 'cardealer', 'cardealer');
    }
    elseif ($column_name == 'car-featured'){
         $r = get_post_meta( $post_ID, 'car-featured', true ); 
         if($r == 'enabled')
           {echo 'Yes';}
         else
           {echo 'No';}
    }
}
if(isset($_GET['post_type'])){
    if (sanitize_text_field($_GET['post_type']) == 'cars')
      {
        add_filter('manage_posts_columns', 'CarDealer_columns_head');
        add_action('manage_posts_custom_column', 'CarDealer_columns_content', 10, 2);
      }
  }