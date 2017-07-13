var GetSearchUser = (function() {
	"use strict";

	var module = {};

	var loader = '';
	var users = '';
	var pageTotal = '';
	var avatarUrl = '';
	var searchKeyword = '';
	var searchForm = '';
	var searchKeywordVal = '';

	// Initialize Report
	module.init = function(){
		this.initSelector();
		this.initData();
	};

	// Init Selector
	module.initSelector = function () {
		loader = $('#loader');
		users =  $('#users');
		searchKeyword =  $('#search-keyword');
		searchForm =  $('#search-form');
	};

	// Init Data
	module.initData = function(){
		searchForm.on('submit', function (event) {
			event.preventDefault();

			// Set Variable
			searchKeywordVal = searchKeyword.val();

			// Loader Show
			loader.show();

			// Functions
			module.sendRequestData(0, searchKeywordVal);
			module.sendRequestPaginationData();
		})
	};

	module.sendRequestData = function (page, searchKeywordVal) {
		// Ajax API
		$.ajax({
			url: Incom.API.search.user+'/'+page+'/'+searchKeywordVal
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
		avatarUrl = response.avatarUrl;

		// Page Is Not Null
		if (response.total > 0) {
			// Append Comment to DOM
			$.each(response.users, function( index, value ){
				users.append('<div class="panel panel-default main-container"><div class="panel-body"><div class="media"><div class="media-left"><img class="media-object post-image" src="'+avatarUrl+value.avatar+'" alt="..."></div><div class="media-body"><h4 class="media-heading"><a href="'+Incom.baseURL+'/connection/profile/'+value.id+'") }}">'+value.name+'</a></h4>'+value.position+'</div></div></div></div>');
			});
		} else {
			users.html('<div class="panel panel-default main-container"><div class="panel-body"><span class="notification-info" id="notification-info">No connection available</span></div></div>');
		}
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
	};

	return module;
})();
