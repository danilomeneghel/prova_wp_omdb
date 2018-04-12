<?php 
global $table_prefix, $wpdb;	
$table_name = $table_prefix.'omdb_settings';

if(isset($_POST['wphw_submit'])) {
	$query = $wpdb->get_results( "SELECT COUNT(*) AS cont FROM " . $table_name );
	$cont = (int) $query[0]->cont;
		
	if(empty($cont)) {
		$result = $wpdb->insert($table_name, [
			'api_url' => $_POST['api_url'], 
			'api_key' => $_POST['api_key']
		]);
	} else {
		$result = $wpdb->update($table_name, [
			'api_url' => $_POST['api_url'], 
			'api_key' => $_POST['api_key']
		], ['id' => 1]);
	}
	
	if($result)
	  $msg = "Updated with success!";
	else
	  $msg = "Error, data not changed.";
}

$omdb_api = $wpdb->get_results( "SELECT api_url, api_key FROM " . $table_name );
?>

<div class="wrap">
	<h1>OMDB API</h1>

	<?php if(isset($_POST['wphw_submit'])): ?>
		<div id="message" class="updated below-h2">
			<p><?php echo $msg; ?></p>
		</div>
	<?php endif; ?>

	<p>Enter the values below to update the OMDB API.</p>
	<div class="card">
		<form id="setting-movie" method="post">
			<table class="form-table">
			  <tr>
				<th scope="row">API URL</th>
				<td><input type="text" class="regular-text" name="api_url" value="<?php echo $omdb_api[0]->api_url;?>" maxlength="255" /></td>
			  </tr>
			  <tr>
				<th scope="row">API KEY</th>
				<td><input type="text" class="regular-text" name="api_key" value="<?php echo $omdb_api[0]->api_key;?>" maxlength="50" /></td>
			  </tr>
			  <tr>
				<th scope="row">&nbsp;</th>
				<td>
					<input type="submit" name="wphw_submit" value="Save changes" class="button-primary" />
				</td>
			  </tr>
			</table>
		</form>
	</div>
</div>