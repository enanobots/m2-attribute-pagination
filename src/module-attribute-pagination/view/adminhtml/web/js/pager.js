define([
    'jquery'
], function ($) {
    "use strict";
    return function (config) {
        $(".attribute-pager-limit").on('change', function () {
            let option = $(this).find("option:selected");
            let redirect = $(option).data('url');
            if (redirect !== undefined) {
                window.location.href = redirect;
            }
        });

        $(".attribute-pager-current").on('blur', function () {
            let page = $(this).val();
            if (page < $(this).attr('min')) {
                page = $(this).attr('min');
            }
            if (page > $(this).attr('max')) {
                page = $(this).attr('max');
            }
            let redirect = $(this).data('url').replace('page/0', 'page/' + page)
            if (redirect !== undefined && redirect != window.location.href) {
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

