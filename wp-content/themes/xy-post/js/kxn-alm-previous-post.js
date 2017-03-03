var almPreviousPost = {};

jQuery(document).ready(function($) {
    if (typeof window.history.pushState == 'function') {
        almPreviousPost.init = true;
        almPreviousPost.initPageTitle = document.title;
        almPreviousPost.titleTemplate = '';
        almPreviousPost.pageview = true;
        almPreviousPost.animating = false;
        almPreviousPost.scroll = true;
        almPreviousPost.speed = 500;
        almPreviousPost.offset = 30;
        almPreviousPost.popstate = false;
        almPreviousPost.active = false;
        if ($('.alm-listing').attr('data-previous-post') === 'true') {
            almPreviousPost.active = true;
        }
        var almPreviousPostTimer, almPreviousPostFirst = $('.alm-previous-post').eq(0);
        $(window).bind('scroll touchstart', function() {
            var scrollTop = $(this).scrollTop();
            if (almPreviousPost.active && !almPreviousPost.popstate && scrollTop > 1) {
                almPreviousPostTimer = window.setTimeout(function() {
                    var fromTop = scrollTop + almPreviousPost.offset,
                        posts = $('.alm-previous-post'),
                        url = window.location.href;
                    var cur = posts.map(function() {
                        if ($(this).offset().top < fromTop)
                            return this;
                    });
                    cur = cur[cur.length - 1];
                    var id = $(cur).data('id'),
                        permalink = $(cur).data('url'),
                        title = $(cur).data('title');
                    if (id === undefined) {
                        id = almPreviousPostFirst.data('id');
                        permalink = almPreviousPostFirst.data('url');
                        title = almPreviousPostFirst.data('title');
                    }
                    if (url !== permalink) {
                        almPreviousPost.setURL(id, permalink, title);
                    }
                }, 200);
            }
        });
        $.fn.almSetPreviousPost = function(alm, id, permalink, title) {
            almPreviousPost.titleTemplate = alm.previous_post_title_template;
            if (almPreviousPost.init) {
                almPreviousPost.siteTitle = alm.siteTitle;
                almPreviousPost.siteTagline = alm.siteTagline;
                almPreviousPost.pageview = alm.previous_post_pageview;
                almPreviousPost.scroll = alm.previous_post_scroll;
                almPreviousPost.speed = alm.previous_post_scroll_speed;
                almPreviousPost.offset = parseInt(alm.previous_post_scroll_top);
                if (almPreviousPost.scroll === 'true') {
                    almPreviousPost.scroll = true;
                } else {
                    almPreviousPost.scroll = false;
                }
                almPreviousPost.init = false;
            } else {
                if (almPreviousPost.scroll) {
                    almPreviousPost.scrollToPost(id);
                }
            }
        }
        window.addEventListener('popstate', function(event) {
            if (!almPreviousPost.init) {
                if (almPreviousPost.active) {
                    almPreviousPost.popstate = true;
                    var id;
                    if (event.state) {
                        id = event.state.postID;
                        almPreviousPost.setPageTitle(event.state.title);
                    } else {
                        id = $('.alm-reveal').eq(0).data('id');
                        document.title = almPreviousPost.initPageTitle;
                    }
                    var top = $('.alm-reveal.alm-previous-post.post-' + id).offset().top - almPreviousPost.offset + 5;
                    $('html, body').animate({
                        scrollTop: top + 'px'
                    }, 1, function() {
                        almPreviousPost.popstate = false;
                    });
                }
            }
        });
        almPreviousPost.setURL = function(id, permalink, title) {
            almPreviousPost.setPageTitle(title);
            var state = {
                postID: id,
                permalink: permalink,
                title: title
            };
            history.pushState(state, title, permalink);
            if ($.isFunction($.fn.almUrlUpdate)) {
                $.fn.almUrlUpdate(permalink, 'previous-post');
            }
            if (almPreviousPost.pageview === 'true') {
                var location = window.location.href,
                    path = '/' + window.location.pathname;
                if (typeof ga !== 'undefined' && $.isFunction(ga)) {
                    ga('send', 'pageview', path);
                }
                if (typeof __gaTracker !== 'undefined' && $.isFunction(__gaTracker)) {
                    __gaTracker('send', 'pageview', path);
                }
            }
        }
        almPreviousPost.scrollToPost = function(id) {
            var top = $('.alm-reveal.alm-previous-post.post-' + id).offset().top - almPreviousPost.offset + 5;
            $('html, body').animate({
                scrollTop: top + 'px'
            }, almPreviousPost.speed, "alm_easeInOutQuad", function() {
                almPreviousPost.animating = false;
            });
        }
        almPreviousPost.setPageTitle = function(title) {
            if (almPreviousPost.titleTemplate === '') {
                document.title = document.title;
            } else {
                var str = almPreviousPost.titleTemplate;
                str = str.replace('{site-title}', almPreviousPost.siteTitle);
                str = str.replace('{tagline}', almPreviousPost.siteTagline);
                str = str.replace('{post-title}', title);
                document.title = str;
            }
        }
        $.easing.alm_easeInOutQuad = function(x, t, b, c, d) {
            if ((t /= d / 2) < 1) return c / 2 * t * t + b;
            return -c / 2 * ((--t) * (t - 2) - 1) + b;
        };
    }
});