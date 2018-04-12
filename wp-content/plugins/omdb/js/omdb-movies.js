( function( $ ){
	$( document ).ready(function() {
		$('#search-movie').on('submit', function(p_oEvent){
			p_oEvent.preventDefault();
			
			var sUrl, sMovie, setting, apiUrl, apiKey;
			
			sMovie = $('#search-movie').find('input').val();
			
			setting = movSettings();
			apiUrl = setting.api_url;
			apiKey = setting.api_key;	
			sUrl = apiUrl + '?type=movie&s=' + sMovie + '&apikey=' + apiKey;
			
			movies(sUrl);
		});

		function movies(sUrl) {
			var oData, output;
			var $movies = $('#movies');
			$movies.hide();

			$.ajax(sUrl, {
				beforeSend: function() {
					$movies.html('<div class="alert alert-info">Loading</div>');
					$movies.show();
				},
				complete: function(p_oXHR, p_sStatus){
					oData = $.parseJSON(p_oXHR.responseText);
					
					var qtd = Object.keys(oData.Search).length;
					
					if (oData.Response === "False") {
						output='<div class="alert alert-danger">Movie not Found!</div>';
					} else {
						output = '<ul class="none">';
						$.each(oData.Search, (index, movie) => {
							output += `
							  <li class="row well">
								<div class="col-md-3 text-center">
								  <img src="${movie.Poster}" class="movie-poster">
								</div>
								<div class="col-md-9">
								  <h3>${movie.Title}</h3>
								  <p>${movie.Year}</p>
								  <a onclick="addFavorite('${movie.imdbID}')" class="btn btn-primary favorite">Favorite</a>
								</div>
							  </li>
							`;
						});
						output += '</ul>';
					}

					$movies.html(output);
					$movies.append('<div class="qtd-total">Total Movies: '+qtd+'</div>');
					$movies.show();
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
		}
	});
})(jQuery);

function movSettings() {
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
		}
	});

	return callback[0];
}

function addFavorite(id) {
	var url = pluginUrl.dir+'add_favorite.php';
	
	jQuery.ajax({
		url: url,
		method: "GET",
		data: {imdbID:id},
		success: function(result){
			alert(result);
		},
		error: function(result) {
			alert("Error to insert");
		}
	});
	
	return false;
}
