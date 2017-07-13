var CreateUp = (function() {
	"use strict";

	var module = {};

	var state = '';

	var loader = '';
	var upCreateButton = ''
	var _token = '';
	var post = '';

	// Initialize Report
	module.init = function(){
		this.initSelector();
		this.initCreate();
	};

	// Init Selector
	module.initSelector = function () {
		loader = $('#loader');
	};

	// Init Data
	module.initCreate = function () {
		upCreateButton = $('#up-create-button');

		// Create When Button Clicked
		upCreateButton.on('click', function(event) {
			event.preventDefault();
			
			upCreateButton.unbind( "click" );

			// Show Loader
			loader.show();
			loader.html('Loading all ups...');
			
			module.sendRequestData();
		});
	};

	module.sendRequestData = function () {
		// Set Variable
		post = window.location.pathname.split("/")[3];
		_token = Incom.token;

		// Params For API
		var params = {
			post: post,
			_token: _token
		};

		// Ajax API
		$.ajax({
			url: Incom.API.post.get+'/'+post+'/up/create',
			method: 'POST',
			data: params
		})
		.done( 
			module.onRequestDataDone
		)
		.fail(function() {
			loader.html('Ups! Cannot create a up');
		})
		.always(function() {
		});
	};

	// If Ajax Request Is Done
	module.onRequestDataDone = function (response) {
		GetUps.sendRequestData();	
	};

	return module;
})();