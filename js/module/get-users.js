var GetUsers = (function() {
	"use strict";

	var module = {};

	var loader = '';
	var users = '';
	var pageTotal = '';
	var avatar_url = '';

	// Initialize Report
	module.init = function(){
		this.initSelector();
		this.initData();
	};

	// Init Selector
	module.initSelector = function () {
		loader = $('#loader');
		users =  $('#users');
	};

	// Init Data
	module.initData = function(){
		module.sendRequestPaginationData(0);
	};

	// Send Request Data
	module.sendRequestData = function (page) {
		// Ajax API
		$.ajax({
			url: Incom.API.users.get+'/'+page
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

	// On Request Data to API is Success
	module.onRequestDataDone = function (response) {
		// Clear DOM
		users.html('');
		avatar_url = response.avatar_url;

		// Page Is Not Null
		if (response.total > 0) {
			// Append Comment to DOM
			$.each(response.users, function( index, value ){
				users.append('<div class="panel panel-default main-container"><div class="panel-body"><div class="media"><div class="media-left"><img class="media-object post-image" src="'+avatar_url+value.avatar+'" alt="..."></div><div class="media-body"><h4 class="media-heading"><a href="'+Incom.baseURL+'/connection/profile/'+value.id+'") }}">'+value.name+'</a></h4>'+value.position+'</div></div></div></div>');
			});
		} else {
			users.html('<div class="panel panel-default main-container"><div class="panel-body"><span class="notification-info" id="notification-info">No connection available</span></div></div>');
		}

		// Get Notifications
		GetNotifications.init();
	};

	// Send Request Data For Pagination
	module.sendRequestPaginationData = function (page) {
		// Ajax API
		$.ajax({
			url: Incom.API.users.get+'/'+page
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
			PaginationUsers.initPagination(pageTotal);
		}
		
		module.sendRequestData(0);
	};

	return module;
})();
