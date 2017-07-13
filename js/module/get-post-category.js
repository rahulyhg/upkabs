var GetPostCategory = (function() {
	"use strict";

	var module = {};

	var categories = [];
	var matches = [];

	var loader = '';
	var inputUser = '';
	var substringMatcher = '';
	var substrRegex = '';
    var substringMatcher = '';

	// Initialize Report
	module.init = function () {
		this.initSelector();
        this.sendRequestData();
        // this.initSearchCategory();
	};

    // Init Selector
    module.initSelector = function () {
        loader = $('#loader');  
        inputUser = $('#post-category .typeahead');
    };

    // // Send Request Data
    module.sendRequestData = function () {
        // Ajax API
        $.ajax({
            url: Incom.API.trending.allCategories
        })
        .done(
            module.initSearchCategory
        )
        .fail(function() {
            loader.html('Ups! Something error');
        })
        .always(function() {
            loader.hide();
        });
    };

    module.initSearchCategory = function (response) {
        // Defining The JSON Data
        $.each(response.categories, function(index, val) {
        	 categories.push(val['category'])
        });
        
        // Constructing the suggestion engine
        categories = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: categories
        });
        
        // Initializing the typeahead
        inputUser.typeahead({
            hint: true,
            highlight: true, /* Enable substring highlighting */
            minLength: 1 /* Specify minimum characters required for showing result */
        },
        {
            name: 'categories',
            source: categories
        });

        // Link Preview
        GetLinkPreview.init();
        ProxyAjax.init();
    };

	return module;
})();
