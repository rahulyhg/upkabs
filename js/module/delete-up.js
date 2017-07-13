var DeleteUp = (function() {
	"use strict";

	var module = {};

	var loader = '';
	var upDeleteButton = '';
	var post = '';
	var _token = '';
	var params = '';

	// Initialize Report
	module.init = function(){
		this.initSelector();
		this.initDelete();
	};

	// Init Selector
	module.initSelector = function () {
		loader = $('#loader');	
	};

	// init Delete
	module.initDelete = function (up) {
		upDeleteButton = $('#up-delete-button');

		// Delete When Button Clicked
		upDeleteButton.on('click', function (e) {
			event.preventDefault();

			// Show Loader
			loader.show();
			loader.html('Loading all ups...');

			upDeleteButton.unbind( "click" );

			// Reset Button
			upDeleteButton.removeClass('btn-acted');
			upDeleteButton.attr('id', 'up-create-button');			

			// Send Request Data
			module.sendRequestData(up);
		});
	};

	// Send Request Delete To API
	module.sendRequestData = function (up) {
		// Set Variable
		post = window.location.pathname.split("/")[3];

		// Ajax API
		$.ajax({
			url: Incom.API.post.get+'/'+post+'/up/delete/'+up
		})
		.done( 
			module.onRequestDataDone
		)
		.fail(function() {
			loader.html('Ups! Cannot delete a up');
		})
		.always(function() {
			loader.hide();
		});
	};

	// If Ajax Request Is Done
	module.onRequestDataDone = function (response) {		
		// Send Request Get Comment API
		GetUps.sendRequestData();
	};

	return module;
})();
