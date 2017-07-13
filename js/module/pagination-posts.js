var PaginationPosts = (function() {
	"use strict";

	var module = {};

	var pagination = '';

	// Initialize Report
	module.init = function(){
		this.initSelector();
	};

	// Init Selector
	module.initSelector = function(){
		pagination = $('#pagination-posts');
	};

	// Init Pagination
	module.initPagination = function( page_total ){
		pagination.bootpag({
		   total: page_total,
		   page: 1,
		   maxVisible: 10
		}).on('page', function( event, num ){
			// Go To Top Page
			$("html, body").animate({ scrollTop: 0 }, "fast");

			// Send Request API To Get Next Posts
			GetPosts.sendRequestData(num-1);
		});
	};

	return module;
})();
