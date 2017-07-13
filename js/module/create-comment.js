var CreateComment = (function() {
	"use strict";

	var module = {};

	var state = '';

	var loader = '';
	var comment = '';
	var commentText = '';
	var commentTextTmp = '';
	var commentForm = '';
	var _token = '';
	var post = '';

	// Initialize Report
	module.init = function(){
		this.initSelector();
		this.initData();
	};

	// Init Selector
	module.initSelector = function () {
		loader = $('#loader');	
		comment = $('#comment');
		commentForm = $('#comment-form');
		commentText = $('#comment-text');
	};

	// Init Data
	module.initData = function () {
		commentForm.on('submit', function(event) {
			event.preventDefault();
			
			// Get Input Comment Value
			commentTextTmp = commentText.val();
			commentText.val('');
			
			// Show Loader
			loader.show();
			loader.html('Loading all comments');
			
			//Send Request Data
			module.sendRequestData();
		});
	};

	module.sendRequestData = function () {

		// Set Variable
		post = window.location.pathname.split("/")[3];
		_token = Incom.token;

		// Params For API
		var params = {
			text: commentTextTmp,
			post: post,
			_token: _token
		};

		// Ajax API
		$.ajax({
			url: Incom.API.post.get+'/'+post+'/comment/create',
			method: 'POST',
			data: params
		})
		.done( 
			module.onRequestDataDone
		)
		.fail(function() {
			loader.html('Ups! Can not create a comment');
		})
		.always(function() {
		});
	};

	// If Ajax Request Is Done
	module.onRequestDataDone = function (response) {
		GetComments.sendRequestData();	
	};

	return module;
})();