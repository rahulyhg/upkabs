var GetUps = (function() {
	"use strict";

	var module = {};

	var loader = '';
	var post = '';
	var upNumber = '';
	var upTotal = '';
	var upButton = '';
	var up = '';
	var active = '';
	var userId = '';

	// Initialize Report
	module.init = function () {
		this.initSelector();
		this.sendRequestData();

		// First State
		active = false;
	};

	// Init Selector
	module.initSelector = function () {
		loader = $('#loader');	
		upNumber = $('#up-number');
		upButton = $('#up-button');
	};

	// Send Request Data
	module.sendRequestData = function () {
		// Declare Id User
		userId = '';

		// Get Post Id
		post = window.location.pathname.split("/")[3];

		// Ajax API
		$.ajax({
			url: Incom.API.post.get+'/'+post+'/ups'
		})
		.done( 
			module.onRequestDataDone
		)
		.fail(function() {
			loader.html('Ups! Cannot load all ups...');
		})
		.always(function() {
			loader.hide();
		});
	};

	// If Ajax Request Is Done
	module.onRequestDataDone = function (response) {
		// Clear DOM
		upNumber.html('');
		
		// Check Response Is Empty Or Not
		if (jQuery.isEmptyObject(response) === false) {
			// Check Total For Accurating Format Numberin
			if (response.total.ups > 0) {
				upTotal = response.total.ups;
							
				if (upTotal == 10000 || upTotal == 100000 || upTotal == 1000000) {
					upTotal = numeral(upTotal).format('0a');
				} else if (upTotal > 9999) {
					upTotal = numeral(upTotal).format('0.0a');
				}
	
				// Write Number Comment
				upNumber.html(upTotal+' ups');
			} else if (response.total.ups == 0) {
				// Write Number Comment
				upNumber.html('0 up');

				// Unup Or Have Not Bookmark
				upButton.attr('id', 'up-create-button');

				// Init Create
				CreateUp.initCreate();
			}
		}

		// Get Id User
		userId = $('#user-id').attr('user-id');

		// Check If Bookmarked
		$.each(response.data, function( index, value ){
			if (active === false) {
				if (userId == value.upper) {
					// Bookmarked
					upButton.addClass('btn-acted');
					upButton.attr('id', 'up-delete-button');

					// Init Delete
					DeleteUp.initDelete(value.id);

					active = true;
				}
				else{
					// Unup Or Have Not Bookmark
					upButton.attr('id', 'up-create-button');
		
					// Init Create
					CreateUp.initCreate();
				}
			}
		});

		active = false;

		// Get Notification
		GetNotifications.init();
	};

	return module;
})();
