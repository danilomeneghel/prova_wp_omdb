( function( $ ){
	$( document ).ready(function() {
		var fav = getFavorites();		
		var qtd = Object.keys(fav).length;
		
		if(qtd!=0){
			//Pagination
			$('#pagination-container').pagination({
				dataSource: getFavorites(),
				pageSize: 5, //Items per Page
				callback: function(data, pagination) {
					$('#data-container').hide();
					var sUrl, oData, setting, apiUrl, apiKey, output;
					
					setting = getSettings();
					apiUrl = setting.api_url;
					apiKey = setting.api_key;
					
					if (data == "") {
						output = '<div class="alert alert-info">No Favorite!</div>';
					} else {
						output = '<ul class="none">';
						$.each(data, (index, movie) => {
							sUrl = apiUrl + '?type=movie&i=' + movie.imdbID + '&apikey=' + apiKey;
													
							$.ajax(sUrl, {
								async: false,
								complete: function(p_oXHR, p_sStatus){
									oData = $.parseJSON(p_oXHR.responseText);
								
									if (oData.Response === "False") {
										output += '<div class="alert alert-danger">Movie not Found!</div>';
									} else {
									  output += `
										  <li class="row well movie">
											<div class="col-md-3 text-center">
											  <img src="${oData.Poster}" class="movie-poster">
											</div>
											<div class="col-md-9">
											  <h3>${oData.Title}</h3>
											  <p>${oData.Year}</p>
											  <a onclick="removeFavorite('${oData.imdbID}')" class="btn btn-primary favorite">Remove</a>
											</div>
										  </li>
										`;
									}
								},
								error: function(jqXHR, exception) {
									if (jqXHR.status === 0) {
										alert('Not connect.\n Verify Network.');
									} else if (jqXHR.status == 404) {
										alert('Requested page not found. [404]');
									} else if (jqXHR.status == 500) {
										alert('Internal Server Error [500].');
									} else if (exception === 'parsererror') {
										alert('Requested JSON parse failed.');
									} else if (exception === 'timeout') {
										alert('Time out error.');
									} else if (exception === 'abort') {
										alert('Ajax request aborted.');
									} else {
										alert(jqXHR.responseText);
									}
									return false;
								}
							});
						});
						output += '</ul>';
					}
					
					$('#data-container').html(output);
					$('#data-container').append('<div class="qtd-total">Total Favorites: '+qtd+'</div>');
					$('#data-container').show();					
				}
			})
		}
	});
})(jQuery);

function getFavorites() {
	var callback;
	var url = pluginUrl.dir+'get_favorites.php';
	
	jQuery.ajax({
		url: url,
		async: false,
		success: function(result){	
			callback = jQuery.parseJSON(result);
		},
		error: function(result) {
			callback = 0;
		}
	});

	return callback;
}

function getSettings() {
	var callback;
	var url = pluginUrl.dir+'get_settings.php';

	jQuery.ajax({
		url: url,
		async: false,
		success: function(result){
			callback = jQuery.parseJSON(result);
		},
		error: function(result) {
			alert("Settings not found");
			return false;
		}
	});

	return callback[0];
}

function removeFavorite(id) {
    var url = pluginUrl.dir+'remove_favorite.php';
		
	jQuery.ajax({
	  url: url,
	  method: "GET",
	  data: {imdbID:id},
		success: function(result){
			alert(result);
			location.reload();
		},
		error: function(result) {
			alert("Error to delete");
			return false;
		}
	});
	
	return false;
}
