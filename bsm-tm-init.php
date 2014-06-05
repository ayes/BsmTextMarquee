<?php
/*
Plugin Name: BSM Text Marquee
Plugin URI: http://bsmsite.com
Description: Text Marquee. sebuah plugin untuk text berjalan yang dapat diletakan dimanapun pada halaman frontend Wordpress Anda.
Author: Irfan Mahfudz Guntur
Version: 1.0
Author URI: http://bsmsite.com
*/

add_action('admin_menu', bsmtextmarquee_admin_actions);

global $wpdb;
$table_name = $wpdb->prefix . "tbbsmtextmarquee";
if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name)
	$sql = "CREATE TABLE " . $table_name . " (
			id int(11) NOT NULL AUTO_INCREMENT,
			text_slide VARCHAR(200) NOT NULL,
			UNIQUE KEY id (id)
		);";

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($sql);

function bsmtextmarquee_admin_actions() {
	
	add_menu_page('Bsm Text Marquee',
	'BsmTextMarquee', 
	'manage_options',
	'bsmtextmarquee-list', 
	bsmtextmarquee_list
	);

	add_submenu_page(null,
	'Create BTM',
	'Create',
	'manage_options',
	'bsm-tm-create',
	'bsm_tm_create');

	add_submenu_page(null,
	'Update BTM',
	'Update',
	'manage_options',
	'bsm-tm-update',
	'bsm_tm_update');
	

}
define('BSMTMDIR', plugin_dir_path(__FILE__));
require_once(BSMTMDIR . 'bsm-tm-list.php');
require_once(BSMTMDIR . 'bsm-tm-create.php');
require_once(BSMTMDIR . 'bsm-tm-update.php');

function bsmtmshow( $atts ){
	global $wpdb;
	$table_name = $wpdb->prefix . "tbbsmtextmarquee";
	$bsmdatatexts = $wpdb->get_results(
			"
				SELECT text_slide
				FROM " . $table_name . "
			"
		);

	foreach ($bsmdatatexts as $bsmdatatext)
	{
		$bsmstream.= $bsmdatatext->text_slide;
	}
	return "<marquee behavior='scroll' scrollamount='3' direction='left' style='color:#ffffff;background-color:#ff6c00;'>" . $bsmstream . "</marquee>";

}
add_shortcode( 'bsmtextmarquee', 'bsmtmshow' );
?>