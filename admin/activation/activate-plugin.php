<?php
/**
 * 
 * @package WP Photo Engraving
 * @subpackage M. Sufyan Shaikh
 * 
 */

function createAllTables()
{
    global $wpdb;
    $wppe_registered = "wppe_registered";

    if (!get_option($wppe_registered)) {
        try {
            $table_plugin = $wpdb->prefix . "wp_photo_engraving";
            $charset_collate = $wpdb->get_charset_collate();

            $createTablePlugin = "CREATE TABLE $table_plugin  (
                id int(11) NOT NULL AUTO_INCREMENT,
                task varchar(150) NOT NULL,
                selectedDate date NOT NULL,
                selectedTime time NOT NULL,
                userAddress varchar(150) NOT NULL,
                email varchar(150) NOT NULL,
                phone varchar(15) NOT NULL,
                googleLocation varchar(150) NOT NULL,
                nonce varchar(50) NOT NULL,
                paymentStatus varchar(50) NOT NULL DEFAULT 'pending',
                currentDate timestamp NOT NULL DEFAULT current_timestamp(),
                price decimal(10,2) NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";

            require_once ABSPATH . "wp-admin/includes/upgrade.php";
            dbDelta($createTablePlugin);

            add_option($wppe_registered, true);

        } catch (\Throwable $erro) {
            error_log("Error creating table: " . $erro->getMessage());
        }
    }
}

function removeAllTables()
{
    $optionsToDelete = [
        "wppe_registered"
    ];

    global $wpdb;
    $table_plugin = $wpdb->prefix . "wp_photo_engraving";

    try {
        $removal_pluginDatabase = "DROP TABLE IF EXISTS {$table_plugin}";
        $wpdb->query($removal_pluginDatabase);

        foreach ($optionsToDelete as $option_value) {
            delete_option($option_value);
        }

    } catch (\Throwable $erro) {
        error_log("Error removing table: " . $erro->getMessage());
    }
}
