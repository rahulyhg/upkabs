var GetHeadMostCategories = (function() {
	"use strict";

	var module = {};

	var categories = '';
	var pageTotal = '';

	// Initialize Report
	module.init = function () {
		this.initSelector();
		this.initData();
	};

	// Init Selector
	module.initSelector = function () {
		categories =  $('#categories');
	};

	// Init Data
	module.initData = function () {
		module.sendRequestData(0);
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
			categories.html('Ups! Something error');
		})
		.always(function() {
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
				categories.append('<a href="'+Incom.baseURL+'/trending/category/'+value.category+'/posts") }}">'+value.category+'</a>');
			});
			categories.append('<a href="'+Incom.baseURL+'/trending/categories") }}">More</a>');
		} else {
			categories.html('No category available');
		}

		// Get Notifications
		GetNotifications.init();
	};

	return module;
})();
