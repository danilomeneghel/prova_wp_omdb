<?php 
include "../../../wp-config.php";

global $table_prefix, $wpdb;	
$table_name = $table_prefix.'omdb_favorites';

$idUser = get_current_user_id();

$rows = $wpdb->get_results( "SELECT imdbID FROM " . $table_name . " WHERE idUser = " . $idUser );

echo json_encode($rows);
?>