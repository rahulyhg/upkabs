var GetLinkPreview = (function() {
    "use strict";

    var module = {};

    var loader = '';

    // Initialize Report
    module.init = function () {
        $(function() {
            loader = $("#loader");
            $("input").linkpreview({
                previewContainer: "#link-preview-container",
                refreshButton: "#link",
                errorMessage: "Invalid URL",
                preProcess: function() {
                    console.log("preProcess");
                    loader.show();
                },
                onSuccess: function() {
                    console.log("onSuccess");
                },
                onError: function() {
                    console.log("onError");
                },
                onComplete: function() {
                    // Check If Preview Is Empty
                    if ($("#link-preview-container").text() == "") {
                        $("#link-preview-container").text("No content available");      
                        $("button[type=submit]").attr('disabled', true);                 
                    } else {
                        $("button[type=submit]").attr('disabled', false);
                    }

                    loader.hide();
                }
            });
        });
    };

    return module;
})();