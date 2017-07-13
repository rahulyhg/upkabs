var DeactiveComment = (function() {
	"use strict";

	var module = {};

	var loader = '';
	var comment = '';
	var deactiveConfirmButton = '';
	var deactiveCancelButton = '';
	var post = '';
	var _token = '';
	var deactiveConfirmModal = '';
	var modalQuestion = '';
	var params = '';

	// Initialize Report
	module.init = function(){
		this.initSelector();
		this.initDeactive();
	};

	// Init Selector
	module.initSelector = function () {
		loader = $('#loader');	
		comment = $('#comments');
		deactiveConfirmButton = $('#deactive-confirm-button');
		deactiveCancelButton = $('#deactive-cancel-button');
		deactiveConfirmModal = $('#deactive-confirm-modal');
		modalQuestion = $('#deactive-question');
	};

	// init Deactive
	module.initDeactive = function () {
		// When Click deactive button
		comment.on('click', '#deactive-comment-button', function (e) {
			event.preventDefault();
			
			// Create Question In Modal
			modalQuestion.html('Deactive this comment?');
			
			// Get Id Of Comment
			comment = $(e.target).attr("comment-id");

			// Go To Deactive Confirmation Dialog
			module.deactiveConfirm();
		});
	};

	// Deactive Confirmation
	module.deactiveConfirm = function () {
		// Deactive
		deactiveConfirmButton.on('click', function (e) {
			event.preventDefault();

			// Show Loader
			loader.show();
			loader.html('Loading all comments...');

			// Send Request To Deactive Comment
			module.sendRequestData();
		});

		// Cancel
		deactiveCancelButton.on('click', function (e) {
			event.preventDefault();

			// Clear Event Click At  Deactive Confirmation
			deactiveConfirmButton.unbind( "click" );
		});
	};

	// Send Request Deactive To API
	module.sendRequestData = function () {
		// Set Variable
		post = window.location.pathname.split("/")[3];
		_token = Incom.token;

		// Params For API
		params = {
			comment: comment,
			_token: _token
		};

		// Ajax API
		$.ajax({
			url: Incom.API.post.get+'/'+post+'/comment/deactive',
			method: 'POST',
			data: params
		})
		.done( 
			module.onRequestDataDone
		)
		.fail(function() {
			loader.html('Ups! Something error');
		})
		.always(function() {
			loader.hide();
		});
	};

	// If Ajax Request Is Done
	module.onRequestDataDone = function (response) {		
		// Send Request Get Comment API
		GetComments.sendRequestData();	
	};

	return module;
})();
