;(function ($, window, document, undefined) {
    'use strict';
    var $body   = $('body'),
        has_rtl = $body.hasClass('rtl');

    function uranium_force_vc_full_width_row_rtl() {
        var _elements = $('[data-vc-full-width="true"]');
        $.each(_elements, function (key, item) {
            var $this = $(this);
            if ( $this.parent('[data-vc-full-width="true"]').length > 0 ) {
                return;
            } else {
                var this_left  = $this.css('left'),
                    this_child = $this.find('[data-vc-full-width="true"]');

                if ( this_child.length > 0 ) {
                    $this.css({
                        'left': '',
                        'right': this_left
                    });
                    this_child.css({
                        'left': 'auto',
                        'padding-left': this_left.replace('-', ''),
                        'padding-right': this_left.replace('-', ''),
                        'right': this_left
                    });
                } else {
                    $this.css({
                        'left': 'auto',
                        'right': this_left
                    });
                }
            }
        }), $(document).trigger('uranium-force-vc-full-width-row-rtl', _elements);
    };

    function uranium_fix_full_width_row_rtl() {
        if ( has_rtl ) {
            console.log('Right To Left');
            $('.chosen-container').each(function () {
                $(this).addClass('chosen-rtl');
            });
            $(document).on('vc-full-width-row', function () {
                console.log('Start Full Width Row');
                uranium_force_vc_full_width_row_rtl();
            });
        }
    };
    function uranium_fixed_footer() {
        var menuType = 'desktop';

        $(window).on('load resize', function () {
            var currMenuType = 'desktop';

            if ( matchMedia('only screen and (max-width: 1024px)').matches ) {
                currMenuType = 'mobile';
            }
            var height_footer = $('.footer').outerHeight();
            if ( currMenuType !== menuType ) {
                menuType = currMenuType;

                if ( currMenuType === 'mobile' ) {
                    $('.footer').removeClass('footer-fixed');
                    $('#wapper').css({'margin-bottom': '0'});
                }
            } else {
                $('#wapper').css({'margin-bottom': height_footer});
                $('.footer').addClass('footer-fixed');
            }
        });
    }

    $.fn.uranium_sticky_menu    = function () {
        if ( $(window).width() > 1199 ) {
            var previousScroll  = 0,
                headerPosition  = $(this).find('.header-position'),
                headerOrgOffset = headerPosition.offset().top;

            $(window).scroll(function () {
                var currentScroll = $(this).scrollTop();
                if ( currentScroll > headerOrgOffset ) {
                    if ( currentScroll > previousScroll ) {
                        headerPosition.addClass('hide-header');
                    } else {
                        headerPosition.removeClass('hide-header');
                        headerPosition.addClass('fixed');
                    }
                } else {
                    headerPosition.removeClass('fixed');
                }
                previousScroll = currentScroll;
            });
        } else {
            $(this).css("height", "auto");
        }
    };
    $.fn.uranium_isotope_grid   = function () {
        var _this = $(this);

        function uranium_cols($masonry) {
            var t = $masonry.attr("data-cols");
            if ( t == "1" ) {
                var n = $masonry.width();
                var r = 1;
                return r
            }
            if ( t == "2" ) {
                var n = $masonry.width();
                var r = 2;
                if ( n < 600 ) r = 1;
                return r
            } else if ( t == "3" ) {
                var n = $masonry.width();
                var r = 3;
                if ( n < 600 ) r = 1;
                else if ( n >= 600 && n < 768 ) r = 2;
                else if ( n >= 768 && n < 992 ) r = 3;
                else if ( n >= 992 ) r = 3;
                return r
            } else if ( t == "4" ) {
                var n = $masonry.width();
                var r = 4;
                if ( n < 600 ) r = 1;
                else if ( n >= 600 && n < 768 ) r = 2;
                else if ( n >= 768 && n < 992 ) r = 3;
                else if ( n >= 992 ) r = 4;
                return r
            } else if ( t == "5" ) {
                var n = $masonry.width();
                var r = 5;
                if ( n < 600 ) r = 1;
                else if ( n >= 600 && n < 768 ) r = 2;
                else if ( n >= 768 && n < 992 ) r = 3;
                else if ( n >= 992 && n < 1140 ) r = 4;
                else if ( n >= 1140 ) r = 5;
                return r
            } else if ( t == "6" ) {
                var n = $masonry.width();
                var r = 5;
                if ( n < 600 ) r = 1;
                else if ( n >= 600 && n < 768 ) r = 2;
                else if ( n >= 768 && n < 992 ) r = 3;
                else if ( n >= 992 && n < 1160 ) r = 4;
                else if ( n >= 1160 ) r = 6;
                return r
            } else if ( t == "8" ) {
                var n = $masonry.width();
                var r = 5;
                if ( n < 600 ) r = 1;
                else if ( n >= 600 && n < 768 ) r = 2;
                else if ( n >= 768 && n < 992 ) r = 3;
                else if ( n >= 992 && n < 1160 ) r = 4;
                else if ( n >= 1160 ) r = 8;
                return r
            }
        }

        function uranium_grid($masonry) {
            var t = uranium_cols($masonry);
            var n = $masonry.width();
            var r = n / t;
            r     = Math.floor(r);
            $masonry.find('.isotope-item').each(function (t) {
                $(this).css({
                    width: r + 'px'
                });
            });
        }

        _this.on('uranium_isotope_grid', function () {
            _this.each(function () {
                var $this   = $(this),
                    $layout = $this.data('layout'),
                    $grid   = $this.isotope({
                        percentPosition: true,
                        itemSelector: '.isotope-item',
                        layoutMode: $layout
                    });
                if ( $layout != 'packery' )
                    uranium_grid($this);
                $grid.imagesLoaded().progress(function () {
                    $grid.isotope('layout');
                });
                $(document).on('click', '.filter-button-group a', function (e) {
                    e.preventDefault();
                    var filterValue = $(this).data('filter');
                    $grid.isotope({filter: filterValue});
                    $(this).addClass('active').siblings().removeClass('active');
                });
            });
        }).trigger('uranium_isotope_grid');
    };
    $.fn.uranium_init_carousel  = function () {
        $(this).on('uranium_init_carousel', function () {
            $(this).not('.slick-initialized').each(function () {
                var _this       = $(this),
                    _responsive = _this.data('responsive'),
                    _config     = [];

                if ( has_rtl ) {
                    _config.rtl = true;
                }
                if ( _this.hasClass('slick-vertical') ) {
                    _config.prevArrow = '<span class="fa fa-angle-up prev"></span>';
                    _config.nextArrow = '<span class="fa fa-angle-down next"></span>';
                } else {
                    _config.prevArrow = '<span class="fa fa-angle-left prev"></span>';
                    _config.nextArrow = '<span class="fa fa-angle-right next"></span>';
                }
                _config.responsive = _responsive;

                _this.on('init', function (event, slick, direction) {
                    _this.find('.equal-container.better-height').uranium_better_equal_elems();
                });
                _this.slick(_config);
                _this.on('afterChange', function (event, slick, direction) {
                    _this.find('.lazy').uranium_init_lazy_load();
                });
            });
        }).trigger('uranium_init_carousel');
    };
    $.fn.uranium_init_lazy_load = function () {
        var _this = $(this);
        _this.each(function () {
            var _config = [];

            _config.beforeLoad     = function (element) {
                if ( element.is('div') == true ) {
                    element.addClass('loading-lazy');
                } else {
                    element.parent().addClass('loading-lazy');
                }
            };
            _config.afterLoad      = function (element) {
                if ( element.is('div') == true ) {
                    element.removeClass('loading-lazy');
                } else {
                    element.parent().removeClass('loading-lazy');
                }
            };
            _config.effect         = "fadeIn";
            _config.enableThrottle = true;
            _config.throttle       = 250;
            _config.effectTime     = 600;
            if ( $(this).closest('.megamenu').length > 0 )
                _config.delay = 0;
            $(this).lazy(_config);
        });
    };
    /* uranium_init_dropdown */
    $(document).on('click', function (event) {
        var _target = $(event.target).closest('.uranium-dropdown'),
            _parent = $('.uranium-dropdown');

        if ( _target.length > 0 ) {
            _parent.not(_target).removeClass('open');
            if (
                $(event.target).is('[data-uranium="uranium-dropdown"]') ||
                $(event.target).closest('[data-uranium="uranium-dropdown"]').length > 0
            ) {
                _target.toggleClass('open');
                event.preventDefault();
            }
        } else {
            $('.uranium-dropdown').removeClass('open');
        }
    });
    /* uranium_better_equal_elems */
    $.fn.uranium_better_equal_elems = function () {
        var _this = $(this);
        _this.on('uranium_better_equal_elems', function () {
            $(this).each(function () {
                if ( $(this).find('.equal-elem').length ) {
                    $(this).find('.equal-elem').css({
                        'height': 'auto'
                    });
                    var _height = 0;
                    $(this).find('.equal-elem').each(function () {
                        if ( _height < $(this).height() ) {
                            _height = $(this).height();
                        }
                    });
                    $(this).find('.equal-elem').height(_height);
                }
            });
        }).trigger('uranium_better_equal_elems');
        $(window).on('resize', function () {
            _this.trigger('uranium_better_equal_elems');
        });
    };

    $(document).on('click', 'a.backtotop', function (e) {
        $('html, body').animate({scrollTop: 0}, 800);
        e.preventDefault();
    });
    $(document).on('scroll', function () {
        if ( $(window).scrollTop() > 200 ) {
            $('.backtotop').addClass('active');
        } else {
            $('.backtotop').removeClass('active');
        }
    });
    $.fn.uranium_google_map = function () {
        var _this = $(this);
        _this.each(function () {
            var $id              = $(this).data('id'),
                $latitude        = $(this).data('latitude'),
                $longitude       = $(this).data('longitude'),
                $zoom            = $(this).data('zoom'),
                $map_type        = $(this).data('map_type'),
                $title           = $(this).data('title'),
                $address         = $(this).data('address'),
                $phone           = $(this).data('phone'),
                $email           = $(this).data('email'),
                $hue             = '',
                $saturation      = '',
                $modify_coloring = true,
                $coinpo_map      = {
                    lat: $latitude,
                    lng: $longitude
                };

            if ( $modify_coloring === true ) {
                var $styles = [
                    {
                        stylers: [
                            {hue: $hue},
                            {invert_lightness: false},
                            {saturation: $saturation},
                            {lightness: 1},
                            {
                                featureType: "landscape.man_made",
                                stylers: [ {
                                    visibility: "on"
                                } ]
                            }
                        ]
                    }, {
                        "featureType": "all",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "saturation": 36
                            },
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 40
                            }
                        ]
                    },
                    {
                        "featureType": "all",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 16
                            }
                        ]
                    },
                    {
                        "featureType": "all",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 20
                            }
                        ]
                    },
                    {
                        "featureType": "administrative",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 17
                            },
                            {
                                "weight": 1.2
                            }
                        ]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 20
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 21
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 17
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 29
                            },
                            {
                                "weight": 0.2
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 18
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 16
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 19
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#000000"
                            },
                            {
                                "lightness": 17
                            }
                        ]
                    }
                ];
            }
            var map = new google.maps.Map(document.getElementById($id), {
                zoom: $zoom,
                center: $coinpo_map,
                mapTypeId:
                google.maps.MapTypeId.$map_type,
                styles: $styles
            });

            var contentString = '<div style="background-color:#fff; padding: 30px 30px 10px 25px; width:290px;line-height: 22px" class="coinpo-map-info">' +
                '<h4 class="map-title">' + $title + '</h4>' +
                '<div class="map-field"><i class="fa fa-map-marker"></i><span>&nbsp;' + $address + '</span></div>' +
                '<div class="map-field"><i class="fa fa-phone"></i><span>&nbsp;<a href="tel:' + $phone + '">' + $phone + '</a></span></div>' +
                '<div class="map-field"><i class="fa fa-envelope"></i><span><a href="mailto:' + $email + '">&nbsp;' + $email + '</a></span></div> ' +
                '</div>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            var marker = new google.maps.Marker({
                position: $coinpo_map,
                map: map
            });
            marker.addListener('click', function () {
                infowindow.open(map, marker);
            });
        });
    };

    /* Animate */
    $.fn.uranium_animation_tabs = function (_tab_animated) {
        $(this).on('uranium_animation_tabs', function () {
            _tab_animated = (_tab_animated == undefined || _tab_animated == "") ? '' : _tab_animated;
            if ( _tab_animated == "" ) {
                return;
            }
            $(this).find('.owl-slick .slick-active, .product-list-grid .product-item').each(function (i) {
                var _this  = $(this),
                    _style = _this.attr('style'),
                    _delay = i * 200;

                _style = (_style == undefined) ? '' : _style;
                _this.attr('style', _style +
                    ';-webkit-animation-delay:' + _delay + 'ms;'
                    + '-moz-animation-delay:' + _delay + 'ms;'
                    + '-o-animation-delay:' + _delay + 'ms;'
                    + 'animation-delay:' + _delay + 'ms;'
                ).addClass(_tab_animated + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    _this.removeClass(_tab_animated + ' animated');
                    _this.attr('style', _style);
                });
            });
        }).trigger('uranium_animation_tabs');
    };

    /* Ecome Ajax Tabs */
    $(document).on('click', '.uranium-tabs .tab-link a, .uranium-accordion .panel-heading a', function (e) {
        e.preventDefault();
        var _this         = $(this),
            _ID           = _this.data('id'),
            _tabID        = _this.attr('href'),
            _ajax_tabs    = _this.data('ajax'),
            _sectionID    = _this.data('section'),
            _tab_animated = _this.data('animate'),
            _loaded       = _this.closest('.tab-link,.uranium-accordion').find('a.loaded').attr('href');

        if ( _ajax_tabs == 1 && !_this.hasClass('loaded') ) {
            $(_tabID).closest('.tab-container,.uranium-accordion').addClass('loading');
            _this.parent().addClass('active').siblings().removeClass('active');
            $.ajax({
                type: 'POST',
                url: uranium_ajax_frontend.ajaxurl,
                data: {
                    action: 'uranium_ajax_tabs',
                    security: uranium_ajax_frontend.security,
                    id: _ID,
                    section_id: _sectionID,
                },
                success: function (response) {
                    if ( response[ 'success' ] == 'ok' ) {
                        $(_tabID).html($(response[ 'html' ]).find('.vc_tta-panel-body').html());
                        $(_tabID).closest('.tab-container,.uranium-accordion').removeClass('loading');
                        $('[href="' + _loaded + '"]').removeClass('loaded');
                        $(_tabID).find('.owl-slick').uranium_init_carousel();
                        $(_tabID).find('.equal-container.better-height').uranium_better_equal_elems();
                        _this.addClass('loaded');
                        $(_loaded).html('');
                    } else {
                        $(_tabID).closest('.tab-container,.uranium-accordion').removeClass('loading');
                        $(_tabID).html('<strong>Error: Can not Load Data ...</strong>');
                    }
                    /* for accordion */
                    _this.closest('.panel-default').addClass('active').siblings().removeClass('active');
                    _this.closest('.uranium-accordion').find(_tabID).slideDown(400);
                    _this.closest('.uranium-accordion').find('.panel-collapse').not(_tabID).slideUp(400);
                },
                complete: function () {
                    $(_tabID).addClass('active').siblings().removeClass('active');
                    if ( $(_tabID).find('.uranium-isotope').length > 0 ) {
                        $(_tabID).find('.uranium-isotope').uranium_isotope_grid();
                    }
                    setTimeout(function (args) {
                        $(_tabID).uranium_animation_tabs(_tab_animated);
                    }, 10);
                }
            });
        } else {
            _this.parent().addClass('active').siblings().removeClass('active');
            $(_tabID).addClass('active').siblings().removeClass('active');
            /* for accordion */
            _this.closest('.panel-default').addClass('active').siblings().removeClass('active');
            _this.closest('.uranium-accordion').find(_tabID).slideDown(400);
            _this.closest('.uranium-accordion').find('.panel-collapse').not(_tabID).slideUp(400);
            $(_tabID).uranium_animation_tabs(_tab_animated);
        }
    });


    $(document).ajaxComplete(function (event, xhr, settings) {
        if ( $('.lazy').length > 0 ) {
            $('.lazy').uranium_init_lazy_load();
        }
        uranium_title_tooltip();
    });
    $(document).ready(function () {
        uranium_fixed_footer();
    });
    $(document).on('resize', function () {
        uranium_fixed_footer();
    });

    /* MOUSE TOOLTIP */
    function uranium_title_tooltip() {
        if ( $('.uranium-tooltip').length > 0 ) {
            var tooltips = document.querySelectorAll('.uranium-tooltip .uranium-tooltip-inner');

            window.onmousemove = function (e) {
                var x = (e.clientX + 20) + 'px',
                    y = (e.clientY + 20) + 'px';
                for ( var i = 0; i < tooltips.length; i++ ) {
                    tooltips[ i ].style.top  = y;
                    tooltips[ i ].style.left = x;
                }
            };
        }
    }

    $.fn.uranium_scroll_background = function () {
        if ( $(window).width() > 1024 ) {
            $(window).scroll(function () {
                var currentScroll = $(this).scrollTop();

                if ( currentScroll <= 200 ) {
                    $(this).removeClass('bgrelative');
                } else {
                    $('.hero-image').addClass('bgrelative');
                }
                $('.hero-image .image-border-left').css({
                    'transform': 'translate3d(-' + currentScroll + 'px, 0px, 0px)'
                });
                $('.hero-image .image-border-right').css({
                    'transform': 'translate3d(' + currentScroll + 'px, 0px, 0px)'
                });
            });
        }
    };
    $(window).on('resize', function () {
        $('body').uranium_scroll_background();
    });
    /* ======== Preloader ======== */
    document.addEventListener("DOMContentLoaded", function (event) {
        setTimeout(function () {
            $('.preloader').css('left', '100%');
        }, 1000);
    });
    $(document).on('click', '.burger-menu-js', function () {
        $('body').toggleClass('open-burger-menu');
    });

    $(document).on('click', '.burger-menu-js-meetus', function () {
        $('body').toggleClass('open-burger-menu-meetus');
        $('.uranium-menu-clone-wrap').removeClass('open');
    });

    $(document).on('click', '.burger-menu-js-howweserve', function () {
        $('body').toggleClass('open-burger-menu-howweserve');
    });

    $(document).on('click', '.burger-menu-js-howitworks', function () {
        $('body').toggleClass('open-burger-menu-howitworks');
        $('.uranium-menu-clone-wrap').removeClass('open');
    });

    $(document).on('click', '.burger-menu-js-joincrusade', function () {
        $('body').toggleClass('open-burger-menu-joincrusade');
    });

    $(document).on('click', '.burger-menu-js-whatwenot', function () {
        $('body').toggleClass('open-burger-menu-whatwenot');
    });

    $(document).on('click', '.burger-menu-js-newonblc', function () {
        $('body').toggleClass('open-burger-menu-newonblc');
        $('.uranium-menu-clone-wrap').removeClass('open');
    });


    window.addEventListener('load',
        function (ev) {
            if ( $('.uranium-isotope').length > 0 ) {
                $('.uranium-isotope').uranium_isotope_grid();
            }
            if ( $('.lazy').length > 0 ) {
                $('.lazy').uranium_init_lazy_load();
            }
            if ( $('.owl-slick').length > 0 ) {
                $('.owl-slick').uranium_init_carousel();
            }
            if ( $('.equal-container.better-height').length > 0 ) {
                $('.equal-container.better-height').uranium_better_equal_elems();
            }
            if ( $('.uranium-google-maps').length > 0 ) {
                $('.uranium-google-maps').uranium_google_map();
            }
            if ( $('.header-sticky .header-wrap-stick').length > 0 ) {
                $('.header-sticky .header-wrap-stick').uranium_sticky_menu();
            }
            if ( $('.hero-image').length > 0 ) {
                $('body').uranium_scroll_background();
            }
            uranium_title_tooltip();
            uranium_fixed_footer();
            uranium_fix_full_width_row_rtl();
        }, false);
})(jQuery, window, document);