<?php 
include "../../../wp-config.php";

global $table_prefix, $wpdb;	
$table_name = $table_prefix.'omdb_favorites';
$imdbID = $_GET['imdbID'];
$idUser = get_current_user_id();

$query = $wpdb->get_results( "SELECT COUNT(imdbID) AS cont FROM " . $table_name . " WHERE idUser = " . $idUser . " AND imdbID = '" . $imdbID . "'" );
$favorite = (int) $query[0]->cont;

if(empty($favorite)) {
	$insert = $wpdb->insert($table_name, [
		'idUser' => $idUser,
		'imdbID' => $imdbID,
		'created_at' => date('Y-m-d H:i:s')
	]);
	
	if($insert)
		echo "Add with success!";
	else
		echo "Error adding!";
} else {
	echo "Favorite already add!";
}
?>