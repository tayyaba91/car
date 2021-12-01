<?php /**
 * @author Bill Minozzi
 * @copyright 2016
 */
if(isset($_GET['meta_make']))     
 $make = sanitize_text_field($_GET['meta_make']);
else
 $make = '';
 if(isset($_GET['meta_fuel']))  
 $fuel = sanitize_text_field($_GET['meta_fuel']);
else
 $fuel = '';
if(isset($_GET['meta_year']))
  $year = sanitize_text_field($_GET['meta_year']);
else
  $year = '';
if (isset($_GET['meta_type']))
    $typecar = sanitize_text_field($_GET['meta_type']);
else
    $typecar = ''; 
if(isset($_GET['meta_price']))  
   $price = sanitize_text_field($_GET['meta_price']);
else
  $price = '';
if(isset($_GET['meta_price2']))  
   $price = sanitize_text_field($_GET['meta_price2']);
if(isset($_GET['meta_trans']))  
 $trans = sanitize_text_field($_GET['meta_trans']);
else
 $trans = '';
if(isset($_GET['meta_fuel']))  
 $fuel = sanitize_text_field($_GET['meta_fuel']);
else
 $fuel = '';
$pos = strpos($price, '-');
if($pos !== false)
 {
    $priceMin = trim(substr($price, 0, $pos-1));
    $priceMax = trim(substr($price, $pos+1));
 }
 else
 {
    $priceMax = 9999999999;
    $priceMin = '';
 }  
$priceMin = (int)$priceMin;
$priceMax = (int)$priceMax;
if ($year != '') {
    $yearKey = 'key';
    $yearVal = 'value';
    $yearName = 'car-year';
    $year = $year;
}
else
{
    $yearKey = '';
    $yearVal = '';
    $yearName = '';
    $year = '';
}
if ($typecar != '') {
    $typeKey = 'key';
    $typeVal = 'value';
    $typeName = 'car-type';
    $typecar = $typecar;
} else {
    $typeKey = '';
    $typeVal = '';
    $typeName = '';
    $typecar = '';
}
if ($make != '') {
    $makeKey = 'key';
    $makeVal = 'value';
    $makeName = 'car-make';
    $meta_make = $make;
} else {
    $makeKey = '';
    $makeVal = '';
    $makeName = '';
    $make = '';
}
if ($year != '') {
    $yearKey = 'key';
    $yearVal = 'value';
    $yearName = 'car-year';
    $meta_year = $year;
} else {
    $yearKey = '';
    $yearVal = '';
    $yearName = '';
    $year = '';
}
if ($trans != '') {
    $transKey = 'key';
    $transVal = 'value';
    $transName = 'transmission-type';
    $trans = $trans;
} else {
    $transKey = '';
    $transVal = '';
    $transName = '';
    $trans = '';
}
if ($fuel != '') {
    $fuelKey = 'key';
    $fuelVal = 'value';
    $fuelName = 'car-fuel';
    $fuel = $fuel;
} else {
    $fuelKey = '';
    $fuelVal = '';
    $fuelName = '';
    $fuel = '';
}