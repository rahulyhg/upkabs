var validateFormatImage = (function() {
	"use strict";

	var module = {};

	var image = '';
	var extention = '';
	var imageValidatorAlert = '';
	var errorInfo = '';
	var imageSize = '';
	var imageResize = '';
	var errorContainer = '';

	// Initialize Report
	module.init = function(){
		this.initSelector();
		this.initValidator();
		this.initHideError();
	};

	// Init Selector
	module.initSelector = function(){
		image = $("#image");
		errorInfo = $("#error-info");
		imageValidatorAlert = $("#image-validator-alert");
	};

	// Init Data
	module.initValidator = function () {
		image.bind('change', function(event) {		
			event.preventDefault();

			// Set Exstention And Image Size 
			extention = this.files[0].type;
			imageSize=this.files[0].size/1024;
			
			// Check Format Image
			if($.inArray(extention, ["image/png","image/jpg","image/jpeg"]) == -1) {
				// Show Error Message
		    	errorInfo.show();
		    		
		    	// Push Down Card
				$('body').css('padding-top', '102px');

				// Error Message
		    	errorInfo.html('Invalid image format, please upload another image [x]');

				// Reset Input Image
		    	image.val('');			    
			} else {				
				// Check Image Size More Than 700 KB Or Less Than
				if (imageSize > 700) {
					// Show Error Message
			    	errorInfo.show();
			    		
			    	// Push Down Card
					$('body').css('padding-top', '102px');

					// Error Message
			    	errorInfo.html('Max. 700 KB, please upload another image [x]');

					// Reset Input Image
			    	image.val('');			
				} else {
					errorInfo.hide();
					imageValidatorAlert.html("");
				}
			}
		});
	};

	// Init Hide Error
	module.initHideError = function () {
		errorInfo.on('click', function(event) {
			event.preventDefault();

			// Push Down Card
			$('body').css('padding-top', '60px');
			
			// Hide Error
			errorInfo.hide();
		});
	}

	return module;
})();
