<?php
/**
 * 
 * Plugin Name: WP Photo Engraving
 * plugin URI: https://souloftware.com/
 * version:1.0.0
 * Text Domain: M Sufyan Shaikh 
 * Description: This plugin allows users to upload their photos and instantly preview how they will look when engraved on wood. It provides a realistic simulation of the final product, enabling users to visualize their design before making a purchase. With an intuitive interface and seamless integration with your eCommerce platform, customers can customize, preview, and order their engraved wooden products with ease.
 * Author: Souloftware
 * Author URI: https://souloftware.com/
 */


require_once plugin_dir_path(__FILE__) . './admin/activation/activate-plugin.php';
// ACTIIVATION PLUGIN FUNCTION -CREATE TABLES -
register_activation_hook(__FILE__, 'createAllTables');

register_uninstall_hook(__FILE__, 'removeAllTables');



// Include functions.php, use require_once to stop the script if functions.php is not found
require_once plugin_dir_path(__FILE__) . 'utils/functions.php';