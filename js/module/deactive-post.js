var DeactivePost = (function() {
	"use strict";

	var module = {};

	var state = '';

	var deactiveConfirmButton = '';
	var deactiveCancelButton = '';
	var post = '';
	var postContainer = '';
	var _token = '';
	var deactiveConfirmModal = '';
	var modalQuestion = '';
	var success = '';
	var postContainer = '';
	var params = '';

	// Initialize Report
	module.init = function(){
		this.initSelector();
		this.initDeactive();

		// Change Side Menu To Back To Timeline On Navbar
		$('#open-side-nav').addClass('hide');
		$('#back-to-timeline').removeClass('hide');
		$('#back-to-timeline').css('color', '#fff');
	};

	// Init Selector
	module.initSelector = function () {
		success = '<div class="panel panel-default main-container"><div class="panel-body">Success! Post has been deactivated</div></div>';
		postContainer = $('#post');
		deactiveConfirmButton = $('#deactive-confirm-button');
		deactiveCancelButton = $('#deactive-cancel-button');
		deactiveConfirmModal = $('#deactive-confirm-modal');
		modalQuestion = $('#deactive-question');
	};

	// init Deactive
	module.initDeactive = function () {		
		// When Click deactive button
		postContainer.on('click', '#deactive-post-button', function (e) {
			event.preventDefault();

			// Create Question In Modal
			modalQuestion.html('Deactive this post?');
			
			// Get Id Of Post
			post = $(e.target).attr("post-id");

			// Go To Deactive Confirmation Dialog
			module.deactiveConfirm(post);
		});
	};

	// Deactive Confirmation
	module.deactiveConfirm = function (post) {
		// Deactive
		deactiveConfirmButton.on('click', function (e) {
			event.preventDefault();

			// Send Request To Deactive Post
			module.sendRequestData();
		})

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
		_token = Incom.token;

		// Params For API
		params = {
			post: post,
			_token: _token
		};

		// Ajax API
		$.ajax({
			url: Incom.API.post.get+'/'+post+'/deactive',
			method: 'POST',
			data: params
		})
		.done( 
			module.onRequestDataDone
		)
		.fail(function() {
			postContainer.html('Ups! Something error');
		})
		.always(function() {
		});
	};

	// If Ajax Request Is Done
	module.onRequestDataDone = function (response) {
		// Success Alert
		postContainer.html(success);
		
		DeactivePost.init();
	};

	return module;
})();
