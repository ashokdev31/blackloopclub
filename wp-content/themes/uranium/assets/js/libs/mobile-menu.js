(function ($) {
    "use strict";

    function uranium_get_scrollbar_width() {
        var $inner = jQuery('<div style="width:100%;height:200px;">test</div>'),
            $outer = jQuery('<div style="width:200px;height:150px;position:absolute;top:0;left:0;visibility:hidden;overflow:hidden;"></div>').append($inner),
            inner = $inner[ 0 ], outer = $outer[ 0 ];
        jQuery('body').append(outer);
        var width1 = inner.offsetWidth;
        $outer.css('overflow', 'scroll');
        var width2 = outer.clientWidth;
        $outer.remove();
        return (width1 - width2);
    }

    function uranium_menuclone_all_menus() {
        if ( !$('.uranium-menu-clone-wrap').length && $('.uranium-clone-mobile-menu').length > 0 ) {
            $('body').prepend('<div class="uranium-menu-clone-wrap">' + '<div class="uranium-menu-panels-actions-wrap"><a class="uranium-menu-close-btn uranium-menu-close-panels" href="#">x</a></div>' + '<div class="uranium-menu-panels"></div>' + '</div>');
        }
        var i = 0, panels_html_args = Array();
        if ( !$('.uranium-menu-clone-wrap .uranium-menu-panels #uranium-menu-panel-main').length ) {
            $('.uranium-menu-clone-wrap .uranium-menu-panels').append('<div id="uranium-menu-panel-main" class="uranium-menu-panel uranium-menu-panel-main"><ul class="depth-01"></ul></div>');
        }
        $('.uranium-clone-mobile-menu').each(function () {
            var $this = $(this), thisMenu = $this, this_menu_id = thisMenu.attr('id'),
                this_menu_clone_id = 'uranium-menu-clone-' + this_menu_id;
            if ( !$('#' + this_menu_clone_id).length ) {
                var thisClone = $this.clone(true);
                thisClone.find('.menu-item').addClass('clone-menu-item');
                thisClone.find('[id]').each(function () {
                    thisClone.find('.vc_tta-panel-heading a[href="#' + $(this).attr('id') + '"]').attr('href', '#' + uranium_menuadd_string_prefix($(this).attr('id'), 'uranium-menu-clone-'));
                    thisClone.find('.uranium-menu-tabs .tabs-link a[href="#' + $(this).attr('id') + '"]').attr('href', '#' + uranium_menuadd_string_prefix($(this).attr('id'), 'uranium-menu-clone-'));
                    $(this).attr('id', uranium_menuadd_string_prefix($(this).attr('id'), 'uranium-menu-clone-'));
                });
                thisClone.find('.uranium-menu-menu').addClass('uranium-menu-menu-clone');
                var thisMainPanel = $('.uranium-menu-clone-wrap .uranium-menu-panels #uranium-menu-panel-main ul');
                thisMainPanel.append(thisClone.html());
                uranium_menu_insert_children_panels_html_by_elem(thisMainPanel, i);
            }
        });
    }

    function uranium_menu_insert_children_panels_html_by_elem($elem, i) {
        if ( $elem.find('.menu-item-has-children').length ) {
            $elem.find('.menu-item-has-children').each(function () {
                var thisChildItem = $(this);
                uranium_menu_insert_children_panels_html_by_elem(thisChildItem, i);
                var next_nav_target = 'uranium-menu-panel-' + i;
                while ( $('#' + next_nav_target).length ) {
                    i++;
                    next_nav_target = 'uranium-menu-panel-' + i;
                }
                thisChildItem.prepend('<a class="uranium-menu-next-panel" href="#' + next_nav_target + '" data-target="#' + next_nav_target + '"></a>');
                var sub_menu_html = $('<div>').append(thisChildItem.find('> .sub-menu').clone()).html();
                thisChildItem.find('> .sub-menu').remove();
                $('.uranium-menu-clone-wrap .uranium-menu-panels').append('<div id="' + next_nav_target + '" class="uranium-menu-panel uranium-menu-sub-panel uranium-menu-hidden">' + sub_menu_html + '</div>');
            });
        }
    }

    function uranium_menuadd_string_prefix(str, prefix) {
        return prefix + str;
    }

    function uranium_menuget_url_var(key, url) {
        var result = new RegExp(key + "=([^&]*)", "i").exec(url);
        return result && result[ 1 ] || "";
    }

    $(document).ready(function () {
        $(document).on('click', '.menu-toggle', function () {
            $('.uranium-menu-clone-wrap').addClass('open');
            return false;
        });
        $(document).on('click', '.uranium-menu-clone-wrap .uranium-menu-close-panels', function () {
            $('.uranium-menu-clone-wrap').removeClass('open');
            return false;
        });
        $(document).on('click', function (event) {
            if ( event.offsetX > $('.uranium-menu-clone-wrap').width() )
                $('.uranium-menu-clone-wrap').removeClass('open');
        });
        $(document).on('click', '.uranium-menu-next-panel', function (e) {
            var $this = $(this), thisItem = $this.closest('.menu-item'),
                thisPanel = $this.closest('.uranium-menu-panel'), target_id = $this.attr('href');
            if ( $(target_id).length ) {
                thisPanel.addClass('uranium-menu-sub-opened');
                $(target_id).addClass('uranium-menu-panel-opened').removeClass('uranium-menu-hidden').attr('data-parent-panel', thisPanel.attr('id'));
                var item_title = thisItem.find('.uranium-menu-item-title').attr('title'), firstItemTitle = '';
                if ( $('.uranium-menu-panels-actions-wrap .uranium-menu-current-panel-title').length > 0 ) {
                    firstItemTitle = $('.uranium-menu-panels-actions-wrap .uranium-menu-current-panel-title').html();
                }
                if ( typeof item_title != 'undefined' && typeof item_title != false ) {
                    if ( !$('.uranium-menu-panels-actions-wrap .uranium-menu-current-panel-title').length ) {
                        $('.uranium-menu-panels-actions-wrap').prepend('<span class="uranium-menu-current-panel-title"></span>');
                    }
                    $('.uranium-menu-panels-actions-wrap .uranium-menu-current-panel-title').html(item_title);
                }
                else {
                    $('.uranium-menu-panels-actions-wrap .uranium-menu-current-panel-title').remove();
                }
                $('.uranium-menu-panels-actions-wrap .uranium-menu-prev-panel').remove();
                $('.uranium-menu-panels-actions-wrap').prepend('<a data-prenttitle="' + firstItemTitle + '" class="uranium-menu-prev-panel" href="#' + thisPanel.attr('id') + '" data-cur-panel="' + target_id + '" data-target="#' + thisPanel.attr('id') + '"></a>');
            }
            e.preventDefault();
        });
        $(document).on('click', '.uranium-menu-prev-panel', function (e) {
            var $this = $(this), cur_panel_id = $this.attr('data-cur-panel'), target_id = $this.attr('href');
            $(cur_panel_id).removeClass('uranium-menu-panel-opened').addClass('uranium-menu-hidden');
            $(target_id).addClass('uranium-menu-panel-opened').removeClass('uranium-menu-sub-opened');
            var new_parent_panel_id = $(target_id).attr('data-parent-panel');
            if ( typeof new_parent_panel_id == 'undefined' || typeof new_parent_panel_id == false ) {
                $('.uranium-menu-panels-actions-wrap .uranium-menu-prev-panel').remove();
                $('.uranium-menu-panels-actions-wrap .uranium-menu-current-panel-title').remove();
            }
            else {
                $('.uranium-menu-panels-actions-wrap .uranium-menu-prev-panel').attr('href', '#' + new_parent_panel_id).attr('data-cur-panel', target_id).attr('data-target', '#' + new_parent_panel_id);
                var item_title = $('#' + new_parent_panel_id).find('.uranium-menu-next-panel[data-target="' + target_id + '"]').closest('.menu-item').find('.uranium-menu-item-title').attr('data-title');
                item_title     = $(this).data('prenttitle');
                if ( typeof item_title != 'undefined' && typeof item_title != false ) {
                    if ( !$('.uranium-menu-panels-actions-wrap .uranium-menu-current-panel-title').length ) {
                        $('.uranium-menu-panels-actions-wrap').prepend('<span class="uranium-menu-current-panel-title"></span>');
                    }
                    $('.uranium-menu-panels-actions-wrap .uranium-menu-current-panel-title').html(item_title);
                }
                else {
                    $('.uranium-menu-panels-actions-wrap .uranium-menu-current-panel-title').remove();
                }
            }
            e.preventDefault();
        });
    });
    window.addEventListener('load',
        function (ev) {
            uranium_menuclone_all_menus();
        }, false);
})(jQuery);