<?php
/**
 * 
 * @package WP Photo Engraving
 * @subpackage M. Sufyan Shaikh
 * 
 */

//Frontend Templates
require_once plugin_dir_path(__DIR__) . '/frontend/customizer/customizer.php';

//Backend Templates
require_once plugin_dir_path(__DIR__) . '/admin/templates/orders.php';

// Actions
// require_once plugin_dir_path(__DIR__) . '/utils/formsubmission/form.php';

// Backend Scripts
function wppe_admin_style() {
  wp_enqueue_style( 'backendStyle', plugins_url( '../src/css/bck-style.css', __FILE__ ), array(), false );
  wp_enqueue_script( 'backendScript', plugins_url( '../src//js/bck-script.js', __FILE__ ), array(), '1.0.0', true ); 
  wp_localize_script( 'backendScript', 'ajax_variables', array(
    'ajax_url'    => admin_url( 'admin-ajax.php' ),
    'nonce'  => wp_create_nonce( 'my-ajax-nonce' ),
  ));
}
add_action('admin_enqueue_scripts', 'wppe_admin_style');

// Frontend Scripts
function wppe_frontend_script() { 
    wp_enqueue_script( 'frontenScript', plugins_url( '../src/js/script.js', __FILE__ ), ['jquery'], null, true ); 
    wp_enqueue_style( 'frontenStyle', plugins_url( '../src/css/style.css', __FILE__ ), array(), false );
   
    wp_localize_script( 'frontenScript', 'ajax_variables', array(
      'ajax_url'       => admin_url( 'admin-ajax.php' ),
      'nonce'          => wp_create_nonce( 'my-ajax-nonce' )
    ));
  }
  add_action( 'wp_enqueue_scripts', 'wppe_frontend_script' ); 


add_shortcode( 'photo-engraving', 'wppe_frontend' );

// Hook to 'admin_menu' action to create menus.
add_action('admin_menu', 'custom_plugin_menu');


function custom_plugin_menu() {
    add_menu_page(
        'WP Photo Engraving',         
        'WP Photo Engraving',         
        'manage_options',        
        'wppe-plugin',       
        'custom_plugin_page',     
        'dashicons-admin-generic',
        6                         
    );

    // Add submenu pages
    add_submenu_page(
        'wppe-plugin',        
        'Settings Page',         
        'Settings',              
        'manage_options',        
        'wppe-plugin-payment',
        'custom_plugin_settings'  
    );
}