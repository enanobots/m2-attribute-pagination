define([
    'jquery'
], function ($) {
    "use strict";
    return function (config) {
        $("#attributeGrid_page-limit").on('change', function () {
            let option = $(this).find("option:selected");
            let redirect = $(option).data('url');
            if (redirect !== undefined) {
                window.location.href = redirect;
            }
        });

        $('.attribute-pager-btn').on('click', function() {
            let redirect = $(this).data('url');
            console.log(redirect);
            if (redirect !== undefined) {
                window.location.href = redirect;
            }
        });
    };
});

