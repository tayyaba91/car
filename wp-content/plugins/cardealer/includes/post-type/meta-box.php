<?php if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
$km_miles =  get_option("CarDealer_measure", "Miles");
if($km_miles == "Kms")
   $km_desc = __('The amount of Km', 'cardealer');
else
   $km_desc = __('The amount of Miles', 'cardealer');
$km_desc .=  ". ". __('Only numbers, no point, no comma.', 'cardealer');

$hp_desc = __('Engine','cardealer');
$hp_desc .= ' '.$CarDealer_hp_or_kw. '. ';
$hp_desc .= __('Only numbers, no point, no comma.', 'cardealer');



$afields = array(
    array(
        'name' => __('Featured', 'cardealer'),
        'desc' => __('Mark to show up at Featured Widget.', 'cardealer'),
        'id' => 'car-featured',
        'type' => 'checkbox'),
    array(
        'name' => __('Price', 'cardealer'),
        'desc' => __('No special characters here ("$" "," "."), the plugin will auto format the number.',
            'cardealer'),
        'id' => 'car-price',
        'type' => 'text',
        'default' => ''),
    array(
        'name' => __('Year', 'cardealer'),
        'desc' => __('The year of the product. Only numbers, no point, no comma.',
            'cardealer'),
        'id' => 'car-year',
        'type' => 'text',
        'default' => ''),
    array(
        'name' => get_option("CarDealer_measure", "Miles"),
        'desc' =>$km_desc,
        'id' => 'car-miles',
        'type' => 'text',
        'default' => ''),
    array(
        'name' => strtoupper($CarDealer_hp_or_kw),
        'desc' => $hp_desc,
        'id' => 'car-hp',
        'type' => 'text',
        'default' => ''),
	array(
                'name' => __('Condition', 'cardealer'),
                'desc' => __('Condition', 'cardealer'), 
				'id' => 'car-con',
				'type' => 'select',
				'options' => array (
				'New' => __('New',  'cardealer'),
				'Used' => __('Used',  'cardealer'),
				'Damaged' => __('Damaged',  'cardealer'), 
				),
				'default' => ''
			),
    array(
        'name' => __('Transmission', 'cardealer'),
        'desc' => __('What kind of Transmission is this', 'cardealer'),
        'id' => 'transmission-type',
        'type' => 'select',
        'options' => array(
            'Automatic' => __('Automatic', 'cardealer'),
            'Manual' => __('Manual', 'cardealer'),
            'Tiptronic' => __('Tiptronic', 'cardealer'))),
    array(
        'name' => __('Fuel Type.', 'cardealer'),
        'desc' => __('Fuel Type.', 'cardealer'),
        'id' => 'car-fuel',
        'type' => 'select',
        'options' => array(
            'Diesel' => __('Diesel', 'cardealer'),
            'Gasoline' => __('Gasoline', 'cardealer'),
            'Hybrid' => __('Hybrid', 'cardealer'),
            'Eletric' => __('Electric', 'cardealer'),
            'Biodiesel' => __('Biodiesel', 'cardealer'),
            'CNG' => __('CNG', 'cardealer'),
            'Ethanol' => __('Ethanol', 'cardealer'),
            'Other' => __('Other', 'cardealer'))));
$afieldsId = cardealer_get_fields('all');
$totfields = count($afieldsId);
$ametadataoptions = array();
for ($i = 0; $i < $totfields; $i++) {
    $post_id = $afieldsId[$i];
    $ametadata = cardealer_get_meta($post_id);
    $field_value = array(
        'field_label', // 0
        'field_typefield', // 1
        'field_drop_options', // 2
        'field_searchbar', // 3
        'field_searchwidget', //4
        'field_rangemin', // 5
        'field_rangemax', //6
        'field_rangestep', // 7
        'field_slidemin', // 8
        'field_slidemax', // 9
        'field_slidestep', // 10
        'field_order', // 11
        'field_name'); // 12
    if (!empty($ametadata[0]))
        $label = $ametadata[0];
    else
        $label = $ametadata[12];
    if ($ametadata[1] == 'checkbox') {
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'car-' . $ametadata[12],
            'type' => $ametadata[1],
            );
    } elseif ($ametadata[1] == 'text') {
       // if($ametadata[12] != 'body_color')
       //   $ametadata[12] = 'car-'.$ametadata[12];
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'car-'.$ametadata[12],
            'type' => $ametadata[1],
            'default' => '');
    } elseif ($ametadata[1] == 'dropdown') {
        $arr = explode("\n", $ametadata[2]);
        $options = array();
        for ($z = 0; $z < count($arr); $z++) {
            // $options[$arr[$z]] = $arr[$z];
            $options[$z] = $arr[$z];
        }
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'car-' . $ametadata[12],
            'type' => 'select',
            'options' => $options,
            'default' => '');
    } elseif ($ametadata[1] == 'rangeselect') {
        $init = $ametadata[5];
        $max = $ametadata[6];
        $step = $ametadata[7];
        if (empty($init))
            $init = 0;
        $options = array();
        if (!empty($max) and !empty($step)) {
            for ($z = $init; $z <= $max; $z += $step) {
                $options[$z] = $z;
            }
        }
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'car-' . $ametadata[12],
            'type' => 'select',
            'options' => $options,
            'default' => '');
    } elseif ($ametadata[1] == 'rangeslider') {
        $init = $ametadata[8];
        $max = $ametadata[9];
        $step = $ametadata[10];
        $options = array();
        for ($z = $init; $z <= $max; $z += $step) {
            $options[$z] = $z;
        }
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'car-' . $ametadata[12],
            'type' => 'select',
            'options' => $options,
            'default' => '');
    } elseif ($ametadata[1] == 'rangeselect') {
        $init = $ametadata[5];
        $max = $ametadata[6];
        $step = $ametadata[7];
        $options = array();
        for ($z = $init; $z <= $max; $z += $step) {
            $options[$z] = $z;
        }
    }
}
$meta_box['cars'] = array(
    'id' => 'listing-details',
    'title' => __('Details', 'cardealer'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => $afields);
add_action('admin_menu', 'cardealer_listing_add_box');
update_option('meta_boxes', $meta_box);
function cardealer_listing_add_box()
{
    global $meta_box;
    foreach ($meta_box as $post_type => $value) {
        add_meta_box($value['id'], $value['title'], 'cardealer_listing_format_box', $post_type,
            $value['context'], $value['priority']);
    }
}
function cardealer_listing_format_box()
{
    global $meta_box, $acardealer_features, $post;
    wp_enqueue_style('meta', CARDEALERURL . 'includes/post-type/meta.css');
            /*
            Convenience
            Confort
            Entertainement
            */
            	 ?>
    		<div class="metabox-tabs-div">
			<ul class="metabox-tabs" id="metabox-tabs">
				<li class="active Specs"><a class="active" href="javascript:void(null);"><?php echo __('Specs', 'cardealer') ?></a></li>
				<li class="Features"><a href="javascript:void(null);"><?php echo __('Features', 'cardealer') ?></a></li>
			</ul>
			<div class="Specs">
				<h4 class="heading"><?php echo __('Specs', 'cardealer') ?></h4> 
    <?php
    echo '<input type="hidden" name="listing_meta_box_nonce" value="',
        wp_create_nonce(basename(__file__)), '" />';
    foreach ($meta_box[$post->post_type]['fields'] as $field) {
        $meta = get_post_meta($post->ID, $field['id'], true);
        $title = $field['name'];
        switch ($field['type']) {
            case 'text':
                echo '<div class="boxes-small">';
                echo '<div class="box-label"><label for="' . $field['id'] . '">' . $title =
                    str_replace("_", " ", $title) . '</label></div>';
                echo '<div class="box-content"><p>';
                echo '<input type="text" name="' . $field['id'] . '" class="' . $field['name'] .
                    '" id="' . $field['id'] . '" value="' . ($meta ? $meta : $field['default']) .
                    '" size="30" style="width:97%" />' . '<br />' . $field['desc'];
                echo '</div></div>';
                break;
            case 'select':
                echo '<div class="boxes-small">' . '<div class="box-label"><label for="' . $field['id'] .
                    '">' . $title = str_replace("_", " ", $title) . '</label></div>' .
                    '<div class="box-content"><p>';
                echo '<select name="' . $field['id'] . '" id="' . $field['id'] . '" class="' . $field['name'] .
                    '">';
                foreach ($field['options'] as $option100) {
                    echo '<option ' . ($meta == $option100 ? ' selected="selected"' : '') . '>' . $option100 .
                        '</option>';
                }
                echo '</select>';
                echo '<br />';
                echo $field['desc'];
                echo '</div></div>';
                break;
            case 'checkbox':
                echo '<div class="boxes-small">' . '<div class="box-label"><label for="' . $field['id'] .
                    '">' . $title = str_replace("_", " ", $title) . '</label></div>' .
                    '<div class="box-content"><p>';
                echo '<div class = "checkboxSlide">';
                echo '<input type="checkbox" class="' . $field['name'] .
                    '" value="enabled" name="' . $field['id'] . '" id="CheckboxSlide"' . ($meta ?
                    ' checked="checked"' : '') . '<br />' . $field['desc'];
                echo '</div>';
                echo '</div></div>';
                break;
        } // end Switch
        //   echo '</div></div>';
    }
     echo '<div class="clear"> </div></div>';
  $cardealer_features = trim(get_option( 'cardealer_fieldfeatures' ));
  if( empty($cardealer_features))
    {
       echo '<br />';
       echo '<br />';
       echo  __('Add any Feature Field (Settings => Field Features)', 'cardealer');
       echo '<br />';
        echo '<br />';    
   }
    else
    {
        $acardealer_features = explode(PHP_EOL, $cardealer_features);
        $qnew = count($acardealer_features);
        echo '<div class="Features">';
        echo '<h4 class="heading">'.__('Features', 'cardealer').'</h4>';
        $post_id = trim($post->ID);
    	for($i=0; $i < $qnew; $i++)
        {
    		$title = $acardealer_features[$i];
            $field_name =  trim($acardealer_features[$i]);
            $field_name = str_replace(' ','_',$field_name);
            if(empty($field_name))
                continue;
            $field_id = 'car_'.$field_name;
            $meta = trim(get_post_meta($post_id, $field_id, true));
    		echo '<div class="boxes">'.
    		'<div class="box-label"><label for="'. $field_name .'">'. $title = str_replace("_", " ",$title) . '</label></div>'.
    		'<div class="box-content"><p>';
            echo '<input type="text" name="'. $field_id. '" class="'. $field_name .'" id="'. $field_id .'" value="'. $meta. '" size="30" style="width:97%" />'. '<br />'. '';
            echo '</div> </div>';
	}
        echo '<div class="clear"> </div>';
        ?>
        			</div>
        		</div>
        <?php
  } // not empty ... 
} // end function listing_format_box
add_action('save_post', 'CarDealer_listing_save_data');
function CarDealer_listing_save_data($post_id)
{
    global $current_post_id, $meta_box, $post, $acardealer_features;
    $current_post_id = $post_id;
    if (!is_object($post))
        return;
    if (!isset($meta_box[$post->post_type]['fields'])) {
        return;
    }
    //Verify nonce
    if (isset($_POST['listing_meta_box_nonce'])) {
        if (!wp_verify_nonce($_POST['listing_meta_box_nonce'], basename(__file__))) {
            return $post_id;
        }
    }
    //Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    //Check permissions
    if (isset($_POST['post_type'])) {
        if ('page' == sanitize_text_field($_POST['post_type'])) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    } else
        return;
    foreach ($meta_box[$post->post_type]['fields'] as $field)
     {
        $old = get_post_meta($post_id, $field['id'], true);
        if (isset($_POST[$field['id']])) {
            $new = sanitize_text_field($_POST[$field['id']]);
        } else {
            $new = '';
        }
        if($field['id'] == 'car-price' )
          { 
            if($new == '')
              $new = '0';    
         }
        if($field['id'] != 'car-price' )
        {
            if ($new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        } 
         else
           update_post_meta($post_id, $field['id'], $new);
        //  }
    } // end loop
    //Save Features
    $cardealer_features = trim(get_option( 'cardealer_fieldfeatures' ));
    if(empty($cardealer_features))
      return;
    $acardealer_features = explode(PHP_EOL, $cardealer_features);
    $qnew = count($acardealer_features);
    for($i=0; $i < $qnew; $i++)
    {
        $field_name =  trim($acardealer_features[$i]);
        $field_name = str_replace(' ','_',$field_name);
        $field_id = 'car_'.$field_name;
        $old = get_post_meta($post_id, $field_id, true); 
        $new = sanitize_text_field($_POST[$field_id]);
        if ($new && $new != $old) {
            update_post_meta($post_id, $field_id, $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field_id, $old);
        }  
    }  // end fornext
} // end Function Save Data