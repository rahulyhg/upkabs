var GetUserPosts = (function() {
	"use strict";

	var module = {};

	var loader = '';
	var userPosts = '';
	var user = '';
	var pageTotal = '';
	var media = '';

	// Initialize Report
	module.init = function(){
		this.initSelector();
		this.initData();
	};

	// Init Selector
	module.initSelector = function(){
		loader = $('#loader');
		userPosts = $('#user-posts');
	};

	// Init Data
	module.initData = function(){
		module.sendRequestPaginationData(0);
	};

	// Send Reques Data to API
	module.sendRequestData = function (page) {
		// Get User Id
		user = window.location.pathname.split("/")[3];

		// Ajax API
		$.ajax({
			url: Incom.API.user.posts+'/'+user+'/posts/'+page
		})
		.done(
			module.onRequestDataDone
		)
		.fail(function() {
			loader.html('Ups! Something error');
		})
		.always(function() {
			loader.hide();
			// userPosts.html('no post here...');
		});
	};

	// On Request Data to API is Success
	module.onRequestDataDone = function (response) {
		// Clear DOM
		userPosts.html('');

		// Page Is Not Null
		if (response.total > 0) {
			// Append User's Post to DOM
			$.each(response.posts, function(index, value){
				// Check Image Is Link Or Not
				value.type != 0 ? media = value.media : media = response.media_url+value.media;

				userPosts.append('<div class="panel panel-default main-container"><div class="panel-body" id="posts"><div class="media"><div class="media-left"><img class="media-object post-image" src="'+media+'" alt="..."></div><div class="media-body"><h4 class="media-heading"><a href="'+Incom.baseURL+'/timeline/post/'+value.id+'") }}">'+value.title+'</a></h4>'+jQuery.timeago(value.date)+' '+value.name+'</div></div></div></div>');
			});
		} else {
			userPosts.html('<div class="panel panel-default main-container"><div class="panel-body"><span class="notification-info">No post available</span></div></div>');
		}

		// Get Notifications
		GetNotifications.init();
	};

	// Send Request Data For Pagination
	module.sendRequestPaginationData = function (page) {
		// Get User Id
		user = window.location.pathname.split("/")[3];

		// Ajax API
		$.ajax({
			url: Incom.API.user.posts+'/'+user+'/posts/'+page
		})
		.done(
			module.onRequestPaginationDataDone
		)
		.fail(function() {
			loader.html('Ups! Something error');
		})
		.always(function() {
			loader.hide();
		});
	};

	// Create Page
	module.onRequestPaginationDataDone = function (response) {		
		// Count Page
		pageTotal = Math.ceil(response.total/10);
		
		// Total Page Must Be > 1
		if (pageTotal > 1) {
			// Send Total Posts To Page Creator
			PaginationUserPosts.initPagination(pageTotal);
		}

		module.sendRequestData(0);
	};

	return module;
})();
