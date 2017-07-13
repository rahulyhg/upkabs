var UpdatePassword = (function() {
	"use strict";

	var module = {};

	var state = '';

	// Alert
	var loader = '';
	var errorInfo = '';

	// Form
	var changePasswordForm = '';
	var currentPassword = '';
	var newPassword = '';
	var _token = '';
	var params = '';

	// Initialize Report
	module.init = function(){
		this.initSelector();
		this.initChangePassword();
	};

	// Init Selector
	module.initSelector = function () {
		loader = $('#loader');	
		changePasswordForm = $('#change-password-form');
		currentPassword = $('#current-password');
		newPassword = $('#new-password');
		errorInfo = $('#error-info');
	};

	// init Deactive
	module.initChangePassword = function () {
		// When Click deactive button
		changePasswordForm.on('submit', function (e) {
			event.preventDefault();
			
			// Show Loader 
			loader.show();

			// Set Variable
			currentPassword = currentPassword.val();
			newPassword = newPassword.val();

			// Go To Deactive Confirmation Dialog
			module.sendRequestData();
		});
	};

	// Send Request Deactive To API
	module.sendRequestData = function () {
		// Set Variable
		_token = Incom.token;

		// Params For API
		params = {
			current_password: currentPassword,
			new_password: newPassword,
			_token: _token,
		};

		// Ajax API
		$.ajax({
			url: Incom.API.user.password,
			method: 'POST',
			data: params
		})
		.done( 
			module.onRequestDataDone
		)
		.fail(function() {
			errorInfo.show();
			errorInfo.html('Error Connetion');
		})
		.always(function() {
			loader.hide();
		});
	};

	// If Ajax Request Is Done
	module.onRequestDataDone = function (response) {
		// Check Error
		if (response.error == 0) {
			// Go To My Profile Page
			window.location = 'profile';
		} else if (response.error == 2) {
			// Show error
			errorInfo.show();
			loader.html(response.message);
		} else {
			window.location = '';
		}
	};

	return module;
})();
