<?php 
global $table_prefix, $wpdb;

$table_name1 = $table_prefix . 'omdb_favorites';
$table_name2 = $table_prefix . 'omdb_settings';
$sql = "";

#Check to see if the table exists already, if not, then create it

if($wpdb->get_var( "show tables like '$table_name1'" ) != $table_name1) 
{
	$sql .= "CREATE TABLE `". $table_name1 . "` ( ";
	$sql .= "  `id`  int(11)   NOT NULL auto_increment, ";
	$sql .= "  `idUser`  int(11)   NOT NULL, ";
	$sql .= "  `imdbID`  varchar(20)   NOT NULL, ";
	$sql .= "  `created_at` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL, ";
	$sql .= "  PRIMARY KEY (`id`) "; 
	$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
}

if($wpdb->get_var( "show tables like '$table_name2'" ) != $table_name2) 
{
	$sql .= "CREATE TABLE `". $table_name2 . "` ( ";
	$sql .= "  `id`  int(11)   NOT NULL auto_increment, ";
	$sql .= "  `api_url`  varchar(255)   NOT NULL, ";
	$sql .= "  `api_key` varchar(50)   NOT NULL, ";
	$sql .= "  PRIMARY KEY (`id`) "; 
	$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
}

require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
dbDelta($sql);
?>