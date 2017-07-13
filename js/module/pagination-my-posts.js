var PaginationMyPosts = (function() {
	"use strict";

	var module = {};

	var loader = '';
	var pagination = '';

	// Initialize Report
	module.init = function(){
		this.initSelector();
	};

	// Init Selector
	module.initSelector = function(){
		loader = $('#loader');
		pagination = $('#pagination-my-posts');
	};

	// Init Pagination
	module.initPagination = function( page_total ){
		// Show Loader
		loader.show();

		pagination.bootpag({
		   total: page_total,
		   page: 1,
		   maxVisible: 10
		}).on('page', function( event, num ){
			// Go To Top Page
			$("html, body").animate({ scrollTop: 0 }, "fast");

			// Send Request API To Get Next Posts
			GetMyPosts.sendRequestData(num-1);
		});
	};

	return module;
})();
