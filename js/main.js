var Incom = {

	baseURL: 'https://upkabs.com',

	token: $('input[name="_token"]').val(),

	openSideNav: '',
	closeSideNav: '',

	selectAdAccounts: '',

	API: {
		user: {
			posts: Laravel.url + '/connection/profile',
			myPosts: Laravel.url + '/profile/posts',
			password: Laravel.url + '/profile/password',
		},
		users: {
			get: Laravel.url + '/connection',
		},
		post: {
			get: Laravel.url + '/timeline/post',
		},
		posts: {
			get: {
				newest: Laravel.url + '/timeline',
				hot: Laravel.url + '/hot',
			}
		},
		trending: {
			get: Laravel.url + '/trending',
			allCategories: Laravel.url + '/trending/categories/all',
			categoryPosts: Laravel.url + '/trending/category'
		},
		notifications: {
			get: Laravel.url + '/notification/get',	
			deactive: Laravel.url + '/notification/deactive',			
		},
		search: {
			user: Laravel.url + '/search/user',
		},
		auth: {
			signin: Laravel.url + '/auth/signin',
		}
	},

    init: function() {
    	this.initSelector();
    	this.initSideNav();
    },

    initSelector: function () {
    	openSideNav = $('#open-side-nav');
		closeSideNav = $('#close-side-nav');
		sideNav = $('.sidenav');
    },

    initSideNav: function () {
    	// Expand Side Menu
        openSideNav.on('click', function (event) {
        	event.preventDefault();

        	sideNav.css('left', '0');
        });

        // Collapse Side Menu
        closeSideNav.on('click', function (event) {
        	event.preventDefault();

        	sideNav.css('left', '-250px');
        });
    }
}

jQuery(document).ready(function() {
	Incom.init();
	jQuery("time.timeago").timeago();
	jQuery.timeago.settings.allowFuture = true;
});