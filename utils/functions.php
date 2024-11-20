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
function wppe_admin_style()
{
  wp_enqueue_style('faltpickrForPluginBackend', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', array(), false);
  wp_enqueue_script('flatpcikrScriptForBackend', 'https://cdn.jsdelivr.net/npm/flatpickr', array(), '1.0.0', true);
  wp_enqueue_style('backendStyle', plugins_url('../src/css/bck-style.css', __FILE__), array(), false);
  wp_enqueue_script('backendScript', plugins_url('../src//js/bck-script.js', __FILE__), array(), '1.0.0', true);
  wp_localize_script('backendScript', 'ajax_variables', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('my-ajax-nonce'),
  ));
}
add_action('admin_enqueue_scripts', 'wppe_admin_style');

// Frontend Scripts
function wppe_frontend_script()
{

  if (is_page('sample-page')) {
    wp_enqueue_style('bootstrapForPlugin', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), false);
  }

  wp_enqueue_script('flatpcikrScriptForFrontend', 'https://cdn.jsdelivr.net/npm/flatpickr', array(), '1.0.0', true);
  wp_enqueue_script('flatpcikrScriptForLanguage', 'https://npmcdn.com/flatpickr@4.6.13/dist/l10n/es.js', array(), '1.0.0', true);
  wp_enqueue_style('faltpickrForPlugin', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', array(), false);
  wp_enqueue_script('screencaptureOrder', 'https://cdn.jsdelivr.net/npm/html2canvas@1.3.2/dist/html2canvas.min.js', array(), '1.0.0', true);
  wp_enqueue_script('frontenScript', plugins_url('../src/js/script.js', __FILE__), ['jquery'], null, true);
  wp_enqueue_style('frontenStyle', plugins_url('../src/css/style.css', __FILE__), array(), false);

  wp_localize_script('frontenScript', 'ajax_variables', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('my-ajax-nonce')
  ));
}
add_action('wp_enqueue_scripts', 'wppe_frontend_script');


add_shortcode('photo-engraving', 'wppe_frontend');

// Hook to 'admin_menu' action to create menus.
add_action('admin_menu', 'custom_plugin_menu');


function custom_plugin_menu()
{
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