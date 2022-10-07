<?php
/*
	Plugin Name: Custom woo Add-On
	Description: A add-on for WP All Import!
	Version: 1.0
	Author: Admin
*/

include "wp-addon.php";

$my_addon = new RapidAddon('Price Add-On', 'price_addon');

$my_addon->add_field('_price_USD', 'Цена для валюты [USD]', 'text'); 
$my_addon->add_field('_price_EUR', 'Цена для валюты [EUR]', 'text');
$my_addon->add_field('_price_GBP', 'Цена для валюты [GBP]', 'text');


$my_addon->set_import_function('my_addon_import_function');

function my_addon_import_function( $post_id, $data, $import_options, $article ) {
  global $my_addon;

  $fields = array(
    '_price_USD',
    '_price_EUR',
    '_price_GBP',
  );

  foreach ( $fields as $field ) {
    if ( empty( $article['ID'] ) or $my_addon->can_update_meta( $field, $import_options ) ) {
		update_post_meta( $post_id, $field, $data[ $field ] );      
    }    
  }  
}


$my_addon->run(
	array(
		"themes" => array("Avada", "Avada Child Theme", "Woodmart", "Woodmart Child")
	)
);




