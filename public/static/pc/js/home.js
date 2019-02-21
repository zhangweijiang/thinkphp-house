$(function () {
    // 缩略图点击事件
    $('.overview #thumbnail2 .smallpic li').on('click', function () {
        var that = $(this),
            length = $('.overview #thumbnail2 .smallpic li').length,
            first = $('.overview #thumbnail2 .smallpic li:first-child'),
            prevAllLength = that.prevAll().length,
            nextAllLength = that.nextAll().length,
            img = that.find('img').attr('src'),
            container = $('.overview .imgContainer img'),
            moveWidth = 0;
        if (length > 5 && prevAllLength > 2) {
            if (nextAllLength > 2) {
                moveWidth = (prevAllLength - 2) * (120 + 8);
            } else {
                moveWidth = (length - 5) * (120 + 8);
            }
        }
        first.animate({marginLeft: 8 - moveWidth + "px"}, "fast");
        that.addClass('selected').siblings().removeClass('selected');
        container.attr('src', img);
    });
    $('.overview #thumbnail2 .smallpic li.selected').trigger('click');

    // 上一张
    $('#thumbnail2 .pre').on('click', function () {
        var current = $('.overview #thumbnail2 .smallpic li.selected'),
            last = $('.overview #thumbnail2 .smallpic li:last-child'),
            newEl = current.prev();
        if (current.prevAll().length === 0) {
            newEl = last;
        }
        newEl.trigger('click');
    });

    // 下一张
    $('#thumbnail2 .next').on('click', function () {
        var current = $('.overview #thumbnail2 .smallpic li.selected'),
            first = $('.overview #thumbnail2 .smallpic li:first-child'),
            newEl = current.next();
        if (current.nextAll().length === 0) {
            newEl = first;
        }
        newEl.trigger('click');
    });
});