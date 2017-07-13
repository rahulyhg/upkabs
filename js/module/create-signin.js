var CreateSignin = (function() {
	"use strict";

	var module = {};

	var state = '';

	var loginForm = '';
	var token = '';
	var email = '';
	var password = '';
	var signinSubmit = '';
	var emailVal = '';
	var passwordVal = '';
	var errorInfo = '';
	var params = '';

	// Initialize Report
	module.init = function(){
		this.initSelector();
		this.initData();
		this.initHideError();
	};

	// Init Selector
	module.initSelector = function () {
		loginForm = $('#login-form');	
		email = $('#login-form input[type=email]');	
		password = $('#login-form input[type=password]');
		signinSubmit = $('#login-form input[type=submit]');
		errorInfo = $('#error-info');
	};

	// Init Data
	module.initData = function () {
		loginForm.on('submit', function(event) {
			event.preventDefault();

			// Disable Form
			email.prop('disabled', true);
			password.prop('disabled', true);
			signinSubmit.prop('disabled', true);

			// Set Value
			emailVal = email.val();
			passwordVal = password.val();

			// Request to API
			module.sendRequestData();
		});
	};

	// Send Request Data
	module.sendRequestData = function () {
		// Set Token
		token = Incom.token;

		// Params For API
		params = {
			email: emailVal,
			password: passwordVal,
			_token: token
		};

		// Ajax API
		$.ajax({
			url: Incom.API.auth.signin,
			method: 'POST',
			data: params
		})
		.done( 
			module.onRequestDataDone
		)
		.fail(function() {
			module.onRequestDataFail();
		})
		.always(function() {
			// Enable Form
			email.prop('disabled', false);
			password.prop('disabled', false);
			signinSubmit.prop('disabled', false);
		});
	};

	// If Ajax Request Is Done
	module.onRequestDataDone = function (response) {
		window.location = 'timeline';
	};

	// If Ajax Request Is Fail
	module.onRequestDataFail = function () {
		errorInfo.show();

		// Push Down Card
		$('body').css('padding-top', '102px');
	};

	// Init Hide Error
	module.initHideError = function () {
		errorInfo.on('click', function(event) {
			event.preventDefault();

			// Push Down Card
			$('body').css('padding-top', '60px');
			
			// Hide Error
			errorInfo.hide();
		});
	}

	return module;
})();
