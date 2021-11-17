// require('./bootstrap');
$(function(){
    $('[required]').each(function () {
        $(this).closest('.form-group')
            .find('label')
            .append('<sup class="text-danger mx-1">*</sup>');
    });

    $('body').tooltip({
        selector: '[data-toggle="tooltip"]',
        html : true,
    }).on('click', '[data-toggle="tooltip"]', function () {
        // hide tooltip when you click on it
        $(this).tooltip('hide');
    });
});


