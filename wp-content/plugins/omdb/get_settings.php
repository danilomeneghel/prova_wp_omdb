<?php 
include "../../../wp-config.php";

global $table_prefix, $wpdb;	
$table_name = $table_prefix.'omdb_settings';

$rows = $wpdb->get_results( "SELECT api_url, api_key FROM " . $table_name );

echo json_encode($rows);
?>