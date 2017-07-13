var GetCategoryPosts = (function() {
	"use strict";

	var module = {};

	var loader = '';
	var posts = '';
	var pageTotal = '';
	var media = '';
	var selectedCategory = '';
	var category = '';

	// Initialize Report
	module.init = function () {
		this.initSelector();
		this.initData();
	};

	// Init Selector
	module.initSelector = function () {
		loader = $('#loader');
		posts =  $('#posts');
		selectedCategory = $('#selected-category');
	};

	// Init Data
	module.initData = function () {
		category = $('#selected-category').text();
		module.sendRequestPaginationData(0);
	};

	// Send Request Data
	module.sendRequestData = function (page) {
		loader.show();

		// Ajax API
		$.ajax({
			url: Incom.API.trending.categoryPosts+'/'+category+'/posts/'+page
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
			url: Incom.API.trending.categoryPosts+'/'+category+'/posts/'+page
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
		posts.html('');

		// Page Is Not Null
		if (response.total > 0) {
			// Append Post to DOM
			$.each(response.posts, function( index, value ){
				// Check Image Is Link Or Not
				value.type != 0 ? media = value.media : media = response.media_url+value.media;

				posts.append('<div class="panel panel-default main-container"><div class="panel-body"><div class="media"><div class="media-left"><img class="media-object post-image" src="'+media+'" alt="..."></div><div class="media-body"><h4 class="media-heading"><a href="'+Incom.baseURL+'/timeline/post/'+value.id+'">'+value.title+'</a></h4>'+jQuery.timeago(value.date)+' '+value.name+'</div></div></div></div>');
			});
		} else {
			posts.html('<div class="panel panel-default main-container"><div class="panel-body"><span class="notification-info">No post available</span></div></div>');
		}

		// Get Head MOst Category
		GetHeadMostCategories.init();
	};

	// Create Page
	module.onRequestPaginationDataDone = function( response ){
		// Count Page
		pageTotal = Math.ceil(response.total/10);

		// Total Page Must Be > 1
		if (pageTotal > 1) {
			// Send Total Posts To Page Creator
			PaginationCategoryPosts.initPagination(pageTotal);
		}

		module.sendRequestData(0);
	};

	return module;
})();
