var GetComments = (function() {
	"use strict";

	var module = {};

	var loader = '';
	var comments = '';
	var userId = '';
	var post = '';
	var comment = '';
	var commentNumber = '';
	var commentTotal = '';

	// Initialize Report
	module.init = function(){
		this.initSelector();
		this.sendRequestData();
	};

	// Init Selector
	module.initSelector = function () {
		loader = $('#loader');	
		comments = $('#comments');
		commentNumber = $('#comment-number');
	};

	//  Send Request Data
	module.sendRequestData = function () {
		// Get Post Id
		post = window.location.pathname.split("/")[3];

		// Ajax API
		$.ajax({
			url: Incom.API.post.get+'/'+post+'/comments'
		})
		.done( 
			module.onRequestDataDone
		)
		.fail(function() {
			loader.html('Ups! Can not loading all comments');
		})
		.always(function() {
			loader.hide();
		});
	};

	// If Ajax Request Is Done
	module.onRequestDataDone = function (response) {
		// Clear DOM
		comments.html('');
		commentNumber.html('');

		// Check Response Is Empty Or Not
		if (jQuery.isEmptyObject(response) === false) {
			// Check Total For Accurating Format Numberin
			if (response.total.comments > 0) {	
				commentTotal = response.total.comments;
				
				if (commentTotal == 10000 || commentTotal == 100000 || commentTotal == 1000000) {
					commentTotal = numeral(commentTotal).format('0a');
				} else if (commentTotal > 9999) {
					commentTotal = numeral(commentTotal).format('0.0a');
				}
	
				// Write Number Comment
				commentNumber.html(commentTotal+' comments');
			} else {
				// Write Number Comment
				commentNumber.html('0 comment');
			}
		}

		// Get Id User
		userId = $('#user-id').attr('user-id');
		
		// Append Comment to DOM
		$.each(response.data, function( index, value ){
			if (userId == value.commentator) {
				comments.append('<div class="panel-body" id="'+value.id+'"><p><a href="'+Incom.baseURL+'/connection/profile/'+value.commentator+'">'+value.name+'</a> '+value.text+'</p><p><small>'+jQuery.timeago(value.date)+'</small></p><span class="btn btn-default btn-sm" id="deactive-comment-button" comment-id="'+value.id+'" data-toggle="modal" data-target="#deactive-confirm-modal">Delete</span></div>');
			}else{
				comments.append('<div class="panel-body" id="'+value.id+'"><p><a href="'+Incom.baseURL+'/connection/profile/'+value.commentator+'">'+value.name+'</a> '+value.text+'</p><small>'+jQuery.timeago(value.date)+'</small></div>');
			}
		});

		module.goToComment();

		GetUps.init();
	};

	// Go To A Comment
	module.goToComment = function () {
		// Get Comment Id
		comment = window.location.search.slice(1);

		if (comment) {
	        $('html, body').animate({
			    scrollTop: $("#"+comment).offset().top
			}, 1000);			
		}
	}

	return module;
})();
