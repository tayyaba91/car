<?php 
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
namespace cardealer\WP\Settings;
// http://autosellerplugin.com/wp-admin/tools.php?page=md_settings1
// $mypage = new Page('Settings', array('type' => 'submenu2', 'parent_slug' =>'admin.php?page=real_estate_plugin'));
// $mypage = new Page('md_settings', array('type' => 'submenu', 'parent_slug' =>'tools.php'));
  $mypage = new Page('cardealer_settings', array('type' => 'submenu2', 'parent_slug' =>'real_estate_plugin'));
 // $mypage = new Page('md_settings', array('type' => 'menu'));
$msg = 'This is a scction 1 ... ';
$settings = array();
//$settings['Mutidealer Settings']['Mutidealer Settings'] = array('info' => $msg );
$fields = array();
$settings['car Settings']['car Settings'] = array('info' => __('Choose your currency, metric system and so on.','cardealer'));
$fields = array();
$fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'CarDealercurrency',
	'label' => __('Currency', 'cardealer'),
	'select_options' => array(
		array('value'=>'Dollar', 'label' => 'Dollar'),
		array('value'=>'Euro', 'label' => 'Euro'),
		array('value'=>'AUD', 'label' => 'Australian Dollar'),
		array('value'=>'Forint', 'label' => 'Forint'),   
		array('value'=>'Indian', 'label' => 'Indian Rupees'),   
		array('value'=>'Krone', 'label' => 'Danish Krone'),
		array('value'=>'Kuna', 'label' => 'Croatian Kuna'),	
		array('value'=>'Naira', 'label' => 'Nigerian Naira'),		
		array('value'=>'Pound', 'label' => 'Pound'),
		array('value'=>'Philippine', 'label' => 'Philippine Peso'),		
		array('value'=>'Thai Bath', 'label' => 'Thai Bath-THB'),
		array('value'=>'Zar', 'label' => 'Zar'),     
  		array('value'=>'Malaysia', 'label' => 'Malaysia Ringgit'),      
   		array('value'=>'Swiss', 'label' => 'Swiss Franc'),
		array('value'=>'Yen', 'label' => 'Yen'),
		array('value'=>'Zar', 'label' => 'Zar'),        
		array('value'=>'Universal', 'label' => 'Universal')
		)			
	);
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'CarDealer_measure',
	'label' => __('Miles - Km','cardealer'),
	'select_options' => array(
		array('value'=>'Miles', 'label' => __('Miles', 'cardealer')),
		array('value'=>'Kms', 'label' => __('Kms', 'cardealer')),
		array('value'=>'Hours', 'label' => __('Hours', 'cardealer'))
		)			
	);
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'CarDealer_liter',
	'label' => __('Liters - Gallons','cardealer'),
	'select_options' => array(
		array('value'=>'Liters', 'label' => __('Liters', 'cardealer')),
		array('value'=>'Gallons', 'label' => __('Gallons', 'cardealer')),
		)			
	);
 /*   
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'CarDealer_lenght',
	'label' => __('Feet - Meters','cardealer'),
	'select_options' => array(
		array('value'=>'Feet', 'label' => __('Feet', 'cardealer')),
		array('value'=>'Meters', 'label' => __('Meters', 'cardealer') ),
		)			
	);
 */
	$fields[] =	array(
            	'type' 	=> 'select',
				'name' => 'CarDealer_quantity',
				'label' => __('How many cars would you like to display per page?', 'cardealer'),
				'select_options' => array (
                		array('value'=>'3', 'label' => '3'),
	                	array('value'=>'6', 'label' => '6'),
                		array('value'=>'9', 'label' => '9'),
                        array('value'=>'12', 'label' => '12'),
                        array('value'=>'15', 'label' => '15'),
                        array('value'=>'18', 'label' => '18'),
	         	)
 	); 
/*
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'sidebar_search_page_result',
	'label' => __('Use dedicated Search Results Page').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
*/




 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_overwrite_gallery',
	'label' => __('Replace the Wordpress Gallery with Flexslider Gallery','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);   
  $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_thumbs_format',
	'label' => __('Use thumbnails size 2:1 or 4:3 ?','cardealer'),
	'radio_options' => array(
		array('value'=>'1', 'label' => '2 : 1'),
		array('value'=>'2', 'label' => '4 : 3'),
		)			
	);
  $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_enable_contact_form',
	'label' => __('Enable Contact Form in Single Product Page?' ,'cardealer'),
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
$fields[] = array(
	'type' 	=> 'text',
	'name' 	=> 'CarDealer_recipientEmail',
	'label' => __('Fill out your contact email to receive email from your Contact Form at bottom of the individual car page.' ,'cardealer')
	);
	

		
	$fields[] = array(
		'type' 	=> 'radio',
		'name' 	=> 'CarDealer_hp_or_kw',
		'label' => __('Do you use HP or KW?','cardealer').'?',
		'radio_options' => array(
			array('value'=>'hp', 'label' => 'HP'),
			array('value'=>'kw', 'label' => 'KW'),
			)			
		);  


		$fields[] = array(
			'type' 	=> 'radio',
			'name' 	=> 'CarDealer_template_gallery',
			'label' => __('In Show Room Page, use Gallery, List View or Grid Template', 'cardealer') . '?',
			'radio_options' => array(
				array('value' => 'yes', 'label' => 'Gallery'),
				array('value' => 'list', 'label' => 'List View'),
				array('value' => 'grid', 'label' => 'Grid (Works only in Premium Version)'),
			)
		);
		
		$fields[] = array(
			'type' 	=> 'radio',
			'name' 	=> 'CarDealer_image_size',
			'label' => __('In Show Room Page, Template List View or Grid, Choose the thumbnail image size - width (Works only in Premium Version)', 'cardealer') . ':',
			'radio_options' => array(
				array('value' => '300', 'label' =>'300px'),
				array('value' => '350', 'label' =>'350px'),
				array('value' => '400', 'label' =>'400px'),
			)
		);
		
		

		$fields[] = array(
			'type' 	=> 'radio',
			'name' 	=> 'CarDealer_template_single',
			'label' => __('In Single Car Page, Template (Model 2 e 3 works only in Premium Version)', 'cardealer') . ':',
			'radio_options' => array(
				array('value' => '1', 'label' => 'Model 1'),
				array('value' => '4', 'label' => 'Pop Up Modal '),
				array('value' => '2', 'label' => 'Model 2 (with sidebar)'),
				array('value' => '3', 'label' => 'Model 3 '),
			)
		);
		
		
		$fields[] = array(
			'type' 	=> 'radio',
			'name' 	=> 'CarDealer_modal_size',
			'label' => __('Single Car Pop UP Width (Works only in Premium Version)', 'cardealer') . ':',
			'radio_options' => array(
				array('value' => '800', 'label' =>'800px'),
				array('value' => '900', 'label' =>'900px'),
				array('value' => '1000', 'label' =>'1000px'),
			)
		);


		$fields[] = array(
			'type' 	=> 'radio',
			'name' 	=> 'sidebar_search_page_result',
			'label' => __('Add Right Sidebar to Search Result Page (Premium Version)','cardealer').'?',
			'radio_options' => array(
				array('value'=>'yes', 'label' => 'Yes'),
				array('value'=>'no', 'label' => 'No'),
				)			
	   );


		
		$settings['car Settings']['car Settings']['fields'] = $fields;
		
		/* --------------- Fim Car Settings -------- */








$notificatin_msg = __('Here you can manage the car features/equipments fields to your car form.', 'cardealer');
$notificatin_msg .= '<br /><strong>';
$notificatin_msg .= __('Just add one or more field names - one for each line -', 'cardealer');
$notificatin_msg .= '</strong>';
$notificatin_msg .= '<br />';
$notificatin_msg .= __('For example: GPS, DVD, and so on... ', 'cardealer');
$notificatin_msg .= '<br />';
$notificatin_msg .= __('Don\'t use special characters.', 'cardealer');
$settings['Field Features']['Field Features'] = array('info' => $notificatin_msg );
$fields = array();  
$fields[] = array(
	'type' 	=> 'textarea',
	'name' 	=> 'cardealer_fieldfeatures',
 	'label' => __('Add this fields to Car Form. Only one field each line:', "cardealer"),
	);
$settings['Field Features']['Field Features']['fields'] = $fields;
$settings['Search']['Search'] = array('info' => __('Customize your Search Options. Choose the fields to show on the front end search bar.','cardealer'));
$fields = array();
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_show_make',
	'label' => __('Show the Make control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);   
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_show_fuel',
	'label' => __('Show the Fuel type control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	); 
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_show_year',
	'label' => __('Show the Year control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_show_transmission',
	'label' => __('Show the Transmission control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);    
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_show_price',
	'label' => __('Show the Price slider','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);   
    $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_show_orderby',
	'label' => __('Show the Order By Control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
$settings['Search']['Search']['fields'] = $fields;
$settings['Widget']['Widget'] = array('info' => __('Customize your Search Widget Options. Choose the fields to show on the Search Widget.','cardealer'));
$fields = array(); 
    $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_widget_show_make',
	'label' => __('Show the Make control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);   
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_widget_show_fuel',
	'label' => __('Show the Fuel type control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	); 
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_widget_show_year',
	'label' => __('Show the Year control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_widget_show_price',
	'label' => __('Show the Price control','cardealer').'?',
	'radio_options' => array(
  		array('value'=>'yes', 'label' => 'Yes '),
		array('value'=>'no', 'label' => 'No'),
		)			
	);   
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_widget_show_transmission',
	'label' => __('Show the Transmission control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_widget_show_orderby',
	'label' => __('Show the Order By Control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);  
$settings['Widget']['Widget']['fields'] = $fields;

$info = '<strong>';
$info .= __('This TAB works only in Premium Version', 'cardealer');
$info .= '</strong>';

$info .= '<br />';
$info .=  __('Choose colours and so on', 'cardealer');



$settings['Car Design']['Car Design'] = array('info' => $info);
$fields = array();

$fields[] = array(
'type' 	=> 'color',
'name' 	=> 'car_search_bt_bk_color',
'label' => __('Search Button Background Color', 'cardealer')
);

$fields[] = array(
'type' 	=> 'color',
'name' 	=> 'car_search_bt_color',
'label' => __('Search Button Color', 'cardealer')
);  

$fields[] = array(
'type' => 'color',
'name' => 'car_background_color',
'label' => __('Background Color', 'cardealer'));


$fields[] = array(
'type' => 'color',
'name' => 'car_foreground_color',
'label' => __('Foreground Text Color', 'cardealer'));

$fields[] = array(
'type' => 'color',
'name' => 'car_foreground_label_color',
'label' => __('Label Color', 'cardealer'));


$fields[] = array(
'type' => 'color',
'name' => 'car_select_border_color',
'label' => __('Select Border Color', 'cardealer'));


$fields[] = array(
'type' => 'color',
'name' => 'car_page_background_color',
'label' => __('car Background Page Color', 'cardealer'));

$fields[] = array(
'type' => 'color',
'name' => 'car_cars_box_border_color',
'label' => __('car Box Border Color', 'cardealer'));


$fields[] = array(
'type' 	=> 'color',
'name' 	=> 'car_title_color',
'label' =>  __('Select Title Color', 'cardealer')
);

$fields[] = array(
'type' => 'color',
'name' => 'car_individual_cars_page_background',
'label' => __('Single car Page Background Color', 'cardealer'));


$fields[] = array(
'type' => 'color',
'name' => 'car_individual_page_foreground_color',
'label' => __('Single car Page Foreground Text Color', 'cardealer'));


$fields[] = array(
'type' => 'textarea',
'name' => 'car_my_css',
'label' => __('Customized CSS', 'cardealer'));


$settings['Car Design']['Car Design']['fields'] = $fields;
new OptionPageBuilderTabbed($mypage, $settings);