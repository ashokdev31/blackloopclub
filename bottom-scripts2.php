<div id="yith-quick-view-modal">
    <div class="yith-quick-view-overlay"></div>
    <div class="yith-wcqv-wrapper">
        <div class="yith-wcqv-main">
            <div class="yith-wcqv-head">
                <a href="#" id="yith-quick-view-close" class="yith-wcqv-close">X</a>
            </div>
            <div id="yith-quick-view-content" class="woocommerce single-product"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var c = document.body.className;
    c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
    document.body.className = c;
</script>
<script type="text/javascript">
    function revslider_showDoubleJqueryError(sliderID) {
        var errorMessage = "Revolution Slider Error: You have some jquery.js library include that comes after the revolution files js include.";
        errorMessage += "<br> This includes make eliminates the revolution slider libraries, and make it not work.";
        errorMessage += "<br><br> To fix it you can:<br>&nbsp;&nbsp;&nbsp; 1. In the Slider Settings -> Troubleshooting set option:  <strong><b>Put JS Includes To Body</b></strong> option to true.";
        errorMessage += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jquery.js include and remove it.";
        errorMessage = "<span style='font-size:16px;color:#BC0C06;'>" + errorMessage + "</span>";
        jQuery(sliderID).show().html(errorMessage);
    }
</script>
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" aria-label="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" aria-label="Share"></button>
                <button class="pswp__button pswp__button--fs" aria-label="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" aria-label="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" aria-label="Previous (arrow left)"></button>
            <button class="pswp__button pswp__button--arrow--right" aria-label="Next (arrow right)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/template" id="tmpl-variation-template">
    <div class="woocommerce-variation-description">{{{ data.variation.variation_description }}}</div>
    <div class="woocommerce-variation-price">{{{ data.variation.price_html }}}</div>
    <div class="woocommerce-variation-availability">{{{ data.variation.availability_html }}}</div>
</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
    <p>Sorry, this product is unavailable. Please choose a different combination.</p>
</script>
<!-- <link rel='stylesheet' id='photoswipe-css'  href='https://uranium.famithemes.com/wp-content/plugins/woocommerce/assets/css/photoswipe/photoswipe.css?ver=1.0.7' type='text/css' media='all' /> -->
<!-- <link rel='stylesheet' id='photoswipe-default-skin-css'  href='https://uranium.famithemes.com/wp-content/plugins/woocommerce/assets/css/photoswipe/default-skin/default-skin.css?ver=1.0.7' type='text/css' media='all' /> -->
<link rel="stylesheet" type="text/css" href="wp-content\cache\wpfc-minified\2dz48bfw\613rg.css" media="all">
<script type='text/javascript'>
    /* <![CDATA[ */
    var wpcf7 = {
        "apiSettings": {
            "root": "https:\/\/uranium.famithemes.com\/wp-json\/contact-form-7\/v1",
            "namespace": "contact-form-7\/v1"
        },
        "recaptcha": {
            "messages": {
                "empty": "Please verify that you are not a robot."
            }
        }
    };
    /* ]]> */
</script>
<script type='text/javascript' src='wp-content\plugins\contact-form-7\includes\js\scripts.js?ver=5.0.3'></script>
<script type='text/javascript' src='wp-content\plugins\woocommerce\assets\js\jquery-blockui\jquery.blockUI.min.js?ver=2.70'></script>
<script type='text/javascript' src='wp-content\plugins\woocommerce\assets\js\js-cookie\js.cookie.min.js?ver=2.1.4'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var woocommerce_params = {
        "ajax_url": "\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/?wc-ajax=%%endpoint%%"
    };
    /* ]]> */
</script>
<script type='text/javascript' src='wp-content\plugins\woocommerce\assets\js\frontend\woocommerce.min.js?ver=3.4.4'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var wc_cart_fragments_params = {
        "ajax_url": "\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/?wc-ajax=%%endpoint%%",
        "cart_hash_key": "wc_cart_hash_0d45f865052158efd41fd06bc7a9cac6",
        "fragment_name": "wc_fragments_0d45f865052158efd41fd06bc7a9cac6"
    };
    /* ]]> */
</script>
<script type='text/javascript' src='wp-content\plugins\woocommerce\assets\js\frontend\cart-fragments.min.js?ver=3.4.4'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var yith_woocompare = {
        "ajaxurl": "\/?wc-ajax=%%endpoint%%",
        "actionadd": "yith-woocompare-add-product",
        "actionremove": "yith-woocompare-remove-product",
        "actionview": "yith-woocompare-view-table",
        "actionreload": "yith-woocompare-reload-product",
        "added_label": "Added",
        "table_title": "Product Comparison",
        "auto_open": "yes",
        "loader": "https:\/\/uranium.famithemes.com\/wp-content\/plugins\/yith-woocommerce-compare\/assets\/images\/loader.gif",
        "button_text": "Compare",
        "cookie_name": "yith_woocompare_list",
        "close_label": "Close"
    };
    /* ]]> */
</script>
<script type='text/javascript' src='wp-content\plugins\yith-woocommerce-compare\assets\js\woocompare.min.js?ver=2.3.1'></script>
<script type='text/javascript' src='wp-content\plugins\yith-woocommerce-compare\assets\js\jquery.colorbox-min.js?ver=1.4.21'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var yith_qv = {
        "ajaxurl": "\/wp-admin\/admin-ajax.php",
        "loader": "https:\/\/uranium.famithemes.com\/wp-content\/plugins\/yith-woocommerce-quick-view\/assets\/image\/qv-loader.gif",
        "is2_2": "",
        "lang": ""
    };
    /* ]]> */
</script>
<script type='text/javascript' src='wp-content\plugins\yith-woocommerce-quick-view\assets\js\frontend.min.js?ver=1.3.1'></script>
<script type='text/javascript' src='wp-content\plugins\woocommerce\assets\js\prettyPhoto\jquery.prettyPhoto.min.js?ver=3.1.6'></script>
<script type='text/javascript' src='wp-content\plugins\yith-woocommerce-wishlist\assets\js\jquery.selectBox.min.js?ver=1.2.0'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var yith_wcwl_l10n = {
        "ajax_url": "\/wp-admin\/admin-ajax.php",
        "redirect_to_cart": "no",
        "multi_wishlist": "",
        "hide_add_button": "1",
        "is_user_logged_in": "",
        "ajax_loader_url": "https:\/\/uranium.famithemes.com\/wp-content\/plugins\/yith-woocommerce-wishlist\/assets\/images\/ajax-loader.gif",
        "remove_from_wishlist_after_add_to_cart": "yes",
        "labels": {
            "cookie_disabled": "We are sorry, but this feature is available only if cookies are enabled on your browser.",
            "added_to_cart_message": "<div class=\"woocommerce-message\">Product correctly added to cart<\/div>"
        },
        "actions": {
            "add_to_wishlist_action": "add_to_wishlist",
            "remove_from_wishlist_action": "remove_from_wishlist",
            "move_to_another_wishlist_action": "move_to_another_wishlsit",
            "reload_wishlist_and_adding_elem_action": "reload_wishlist_and_adding_elem"
        }
    };
    /* ]]> */
</script>
<script type='text/javascript' src='wp-content\plugins\yith-woocommerce-wishlist\assets\js\jquery.yith-wcwl.js?ver=2.2.3'></script>
<script type='text/javascript' src='wp-includes\js\imagesloaded.min.js?ver=3.2.0'></script>
<script type='text/javascript' src='wp-content\plugins\js_composer\assets\lib\bower\isotope\dist\isotope.pkgd.min.js?ver=5.5.2'></script>
<script type='text/javascript' src='wp-content\themes\uranium\assets\js\libs\packery-mode.pkgd.min.js?ver=3.0.6'></script>
<script type='text/javascript' src='wp-content\themes\uranium\assets\js\libs\bootstrap.min.js?ver=3.3.7'></script>
<script type='text/javascript' src='wp-content\themes\uranium\assets\js\libs\mobile-menu.js?ver=1.0.0'></script>
<script type='text/javascript' src='wp-content\themes\uranium\assets\js\libs\jquery.history.min.js?ver=1.0.0'></script>
<script type='text/javascript' src='wp-content\themes\uranium\assets\js\libs\autotype.js?ver=1.0.0'></script>
<script type='text/javascript' src='wp-content\themes\uranium\assets\js\libs\slick.min.js?ver=3.3.7'></script>
<script type='text/javascript' src='wp-content\themes\uranium\assets\js\libs\lazyload.min.js?ver=1.7.6'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var uranium_ajax_frontend = {
        "ajaxurl": "https:\/\/uranium.famithemes.com\/wp-admin\/admin-ajax.php",
        "security": "4907eb3db3"
    };
    var uranium_global_frontend = {
        "uranium_sticky_menu": null
    };
    /* ]]> */
</script>
<script type='text/javascript' src='wp-content\themes\uranium\assets\js\functions.js?ver=1.0'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var toolkit_mailchimp = {
        "ajaxurl": "https:\/\/uranium.famithemes.com\/wp-admin\/admin-ajax.php",
        "security": "33900ac4b3"
    };
    /* ]]> */
</script>
<script type='text/javascript' src='wp-content\plugins\uranium-toolkit\includes\admin\mailchimp\mailchimp.min.js?ver=1.0'></script>
<script type='text/javascript' src='wp-includes\js\wp-embed.min.js?ver=4.9.8'></script>
<script type='text/javascript' src='wp-content\plugins\js_composer\assets\js\dist\js_composer_front.min.js?ver=5.5.2'></script>
<script type='text/javascript' src='wp-includes\js\underscore.min.js?ver=1.8.3'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var _wpUtilSettings = {
        "ajax": {
            "url": "\/wp-admin\/admin-ajax.php"
        }
    };
    /* ]]> */
</script>
<script type='text/javascript' src='wp-includes\js\wp-util.min.js?ver=4.9.8'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var wc_add_to_cart_variation_params = {
        "wc_ajax_url": "\/?wc-ajax=%%endpoint%%",
        "i18n_no_matching_variations_text": "Sorry, no products matched your selection. Please choose a different combination.",
        "i18n_make_a_selection_text": "Please select some product options before adding this product to your cart.",
        "i18n_unavailable_text": "Sorry, this product is unavailable. Please choose a different combination."
    };
    /* ]]> */
</script>
<script type='text/javascript' src='wp-content\plugins\woocommerce\assets\js\frontend\add-to-cart-variation.min.js?ver=3.4.4'></script>
<script type='text/javascript' src='wp-content\plugins\woocommerce\assets\js\zoom\jquery.zoom.min.js?ver=1.7.21'></script>
<script type='text/javascript' src='wp-content\plugins\woocommerce\assets\js\photoswipe\photoswipe.min.js?ver=4.1.1'></script>
<script type='text/javascript' src='wp-content\plugins\woocommerce\assets\js\photoswipe\photoswipe-ui-default.min.js?ver=4.1.1'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var wc_single_product_params = {
        "i18n_required_rating_text": "Please select a rating",
        "review_rating_required": "yes",
        "flexslider": {
            "rtl": false,
            "animation": "slide",
            "smoothHeight": true,
            "directionNav": false,
            "controlNav": "thumbnails",
            "slideshow": false,
            "animationSpeed": 500,
            "animationLoop": false,
            "allowOneSlide": false
        },
        "zoom_enabled": "1",
        "zoom_options": [],
        "photoswipe_enabled": "1",
        "photoswipe_options": {
            "shareEl": false,
            "closeOnScroll": false,
            "history": false,
            "hideAnimationDuration": 0,
            "showAnimationDuration": 0
        },
        "flexslider_enabled": "1"
    };
    /* ]]> */
</script>
<script type='text/javascript' src='wp-content\plugins\woocommerce\assets\js\frontend\single-product.min.js?ver=3.4.4'></script>