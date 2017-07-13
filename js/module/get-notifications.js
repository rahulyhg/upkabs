var GetNotifications = (function() {
	"use strict";

	var module = {};

	var notifications = '';
	var userId = '';
	var post = '';
	var countNotif = '';
	var deactiveNotif = '';
	var notifInfo = '';

	// Initialize Report
	module.init = function(){
		this.initSelector();
		this.initDeactiveData();
		this.sendRequestData();
	};

	// Init Selector
	module.initSelector = function () {
		notifications = $('#notifications');
		countNotif = $('#count-notification');
		deactiveNotif = $('#deactive-notification');
		notifInfo = $('#notification-info');
	};

	// Send Request Data
	module.sendRequestData = function () {
		userId = $('#user-id').attr('user-id');

		// Ajax API
		$.ajax({
			url: Incom.API.notifications.get
		})
		.done(
			module.onRequestDataDone
		)
		.fail(function() {
		})
		.always(function() {
		});
	};

	// If Ajax Request Is Done
	module.onRequestDataDone = function (response) {
		// Check Response Is Empty Or Not
		if (jQuery.isEmptyObject(response) === false) {	
			// Show Notifications Number On Navbar
			if (response.total > 0) {
				// Show Number Bubble On Navbar
				countNotif.html(response.total);
	
				// Choose Info Sentences
				if (response.total > 1) {
					notifInfo.html('You have '+response.total+' notifications');
					deactiveNotif.removeClass('hidden');
				} else if (response.total == 1) {
					notifInfo.html('You have '+response.total+' notification');			
					deactiveNotif.removeClass('hidden');
				}
				
				// Clear DOM
				notifications.html('');
		
				// Append Comment to DOM
				$.each(response.comments.data, function( index, value ){
					notifications.append('<div class="panel panel-default main-container"><div class="panel-body"><p><strong><a href="'+Incom.baseURL+'/connection/profile/'+value.commentator+'">'+value.name+'</a></strong> comment on your post <strong><a href="'+Incom.baseURL+'/timeline/post/'+value.id+'?'+value.comment+'">'+value.title+'</a></strong>: '+value.text+'</p><small>'+jQuery.timeago(value.date)+'</small></div></div>');
				});
			} else {
				notifInfo.html('You do not have notification');
			}
		}	
	};

	// Init Deactive Data Notification Comments To User
	module.initDeactiveData = function () {
		// If Notification Page is Show
		deactiveNotif.on('click', function (e) {			
			// Clear DOM
			notifications.html('');
			countNotif.html('');
			notifInfo.html('You have no notification');

			module.sendRequestDeactiveData();
		})
	}

	// Send Request To Deactive Notification Comments To User
	module.sendRequestDeactiveData = function () {
		// Ajax API
		$.ajax({
			url: Incom.API.notifications.deactive
		})
		.done(
			module.sendRequestData
		)
		.fail(function() {
		})
		.always(function() {
		});
	};

	return module;
})();
