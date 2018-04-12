<?php 
include "../../../wp-config.php";

global $table_prefix, $wpdb;	
$table_name = $table_prefix.'omdb_favorites';
$imdbID = $_GET['imdbID'];
$idUser = get_current_user_id();

$delete = $wpdb->delete($table_name, [
	'idUser' => $idUser,
	'imdbID' => $imdbID
]);

if($delete)
  echo "Deleted with success!";
else
  echo "Error deleting!";
?>