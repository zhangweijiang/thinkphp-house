$(function () {
    $('.tab li').on('click', function () {
        var that = $(this),
            target = that.data('target'),
            pane = $('.tab-pane[data-target="'+ target +'"]');

        if(pane) {
            that.addClass('active').siblings().removeClass('active');
            pane.addClass('active').siblings().removeClass('active');
        }
    });
    $('.tab li.active').trigger('click');

});