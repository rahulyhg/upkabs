var GetMostCategories = (function() {
	"use strict";

	var module = {};

	var loader = '';
	var categories = '';
	var pageTotal = '';
	var media_url = '';

	// Initialize Report
	module.init = function () {
		this.initSelector();
		this.initData();
	};

	// Init Selector
	module.initSelector = function () {
		loader = $('#loader');
		categories =  $('#categories');
	};

	// Init Data
	module.initData = function () {
		// Show Loader
		loader.html('Loading categories...');
		loader.show();

		module.sendRequestPaginationData(0);
	};

	// Send Request Data
	module.sendRequestData = function (page) {
		// Ajax API
		$.ajax({
			url: Incom.API.trending.get+'/categories/'+page
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

	// Send Request Data For Pagination
	module.sendRequestPaginationData = function(page){
		// Ajax API
		$.ajax({
			url: Incom.API.trending.get+'/categories/'+page
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

	// On Request Data to API is Success
	module.onRequestDataDone = function (response) {
		// Clear DOM
		categories.html('');

		// Page Is Not Null
		if (response.total > 0) {
			// Append Post to DOM
			$.each(response.categories, function( index, value ){
				categories.append('<div class="panel panel-default main-container"><div class="panel-body"><a href="'+Incom.baseURL+'/trending/category/'+value.category+'/posts") }}">'+value.category+'</a></div></div>');
			});
		} else {
			categories.html('<div class="panel panel-default main-container"><div class="panel-body"><span class="notification-info">No category available</span></div></div>');
		}
	};

	// Create Page
	module.onRequestPaginationDataDone = function( response ){
		// Count Page
		pageTotal = Math.ceil(response.total/10);
		
		// Total Page Must Be > 1
		if (pageTotal > 1) {
			// Send Total Posts To Page Creator
			PaginationPosts.initPagination(pageTotal);
		}

		module.sendRequestData(0);
	};

	return module;
})();
