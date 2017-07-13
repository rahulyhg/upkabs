var PaginationUsers = (function() {
	"use strict";

	var module = {};

	var state = '';

	var loader = '';
	var pagination = '';

	// Initialize Report
	module.init = function () {
		this.initSelector();
	};

	// Init Selector
	module.initSelector = function () {
		loader = $('#loader');
		pagination = $('#pagination-users');
	};

	// Init Pagination
	module.initPagination = function (page_total) {
		pagination.bootpag({
		   total: page_total,
		   page: 1,
		   maxVisible: 10
		}).on('page', function( event, num ){
			// Go To Top Page
			$("html, body").animate({ scrollTop: 0 }, "fast");

			// Show Loader
			loader.show();

			// Send Request API To Get Next Posts
			GetUsers.sendRequestData(num-1);
		});
	};

	return module;
})();