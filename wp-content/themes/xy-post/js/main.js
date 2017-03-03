var main; // Declare main variable in global scope

;(function($, undefined){

	function Main(){
		var This = this;

		this.home = null;
		this.explainer = null;
		this.search = null;
		this.post = null;


		this.init = function(){
            $(document).ready(This.onDocumentReady);
        };

        this.onDocumentReady = function(){

        	if ( $('.the-home').length ){
        		This.home = new Home();
        	}

        	if ( $('.page-xplainer').length ){
        		This.explainer = new Explainer();
        	}

        	if ( $('.page-nota').length ){
        		This.post = new Post();
        	}

        	This.search = new Search();

        	This.addMenuItemAttrs();
			
        };

        this.addMenuItemAttrs = function(){
        	$('.menu-item-newsletter').attr('data-toggle', 'modal');
        	$('.menu-item-newsletter').attr('data-target', '.modal-newsletter');
        };

        this.init();
	}

	function Home(){
		var This = this;

		this.init = function(){
			This.initCarousel();
			This.initCarouselPager();
			This.attachCarouselEvents();
		};

		this.initCarousel = function(){
			$('#cycle-ultimo').cycle({
			    speed: 600,
			    manualSpeed: 600,
			    fx: 'scrollHorz',
			    slides : '> div',
			    next : '.next',
			    prev : '.prev'
			});
		};

		this.initCarouselPager = function(){
        	$('.pager-item').click( function(e){
        		e.preventDefault();
        		var index = $(this).attr('data-index');
        		$('#cycle-ultimo').cycle('goto', index);
        		$('.pager-item').removeClass('active');
        		$(this).addClass('active');
        	});
        };

		this.attachCarouselEvents = function(){

        	$( '#cycle-ultimo' ).on( 'cycle-after', function( event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag ) {
            	var slideIndex = optionHash.slideNum - 1;
            	$('.pager-item').removeClass('active');
			   	$('.pager-item-' + slideIndex).addClass('active');
			});

        };

		this.init();
	}

	function Post(){
		var This = this;

		this.lastScrollTop = 0;
		this.onScrollDown = new Array();
		this.onScrollUp = new Array();
		this.scrollUpCount = 0;
		this.scrollDownCount = 0;
		this.currentState = {
			postID: 0,
            permalink: '',
            title: ''
		};

		this.init = function(){
			This.initCurrentState();
			
			This.onScrollDown[This.scrollCount++] = This.evalUpdateUrl;
			This.onScrollUp[This.scrollDownCount++] = This.evalUpdateUrl;

			setInterval(This.scrollMonitor, 10);

			
		};

		this.initCurrentState = function(){
			$('.page-nota').each(function(index){
				This.currentState = {
					postID: $(this).attr('data-post-id'),
		            permalink: $(this).attr('data-post-permalink'),
		            title: $(this).attr('data-post-title')
				};
				return false;
			});
		};

		this.evalUpdateUrl = function(st, forward){
			var state = {
                postID: 0,
                permalink: '',
                title: ''
            };

            

			$('.page-nota').each(function(index){
				var offset = $(this).offset();
				var postId = $(this).attr('data-post-id');
				var permalink = $(this).attr('data-post-permalink');
		        var title = $(this).attr('data-post-title');
				if ( st > offset.top ){
					
					state = {
		                postID: postId,
		                permalink: permalink,
		                title: title
		            }
				}else{
					if (!index){
						state = {
			                postID: postId,
			                permalink: permalink,
		                	title: title
			            }
					}
					return false;
				}
			});
			
			if ( state.postID != This.currentState.postID ){
				This.currentState = state;
				history.pushState(state, state.title, state.permalink);
				This.trackPageview();
			}
			
		};

		this.trackPageview = function(){
			var location = window.location.href,
                path = '/' + window.location.pathname;
            if (typeof ga !== 'undefined' && $.isFunction(ga)) {
                ga('send', 'pageview', path);
            }
            if (typeof __gaTracker !== 'undefined' && $.isFunction(__gaTracker)) {
                __gaTracker('send', 'pageview', path);
            }
		};

		this.scrollMonitor = function(){
			
				var st = $(window).scrollTop();
				var forward = false;

				if (st > This.lastScrollTop){
			    	forward = true; 
			    	for (var x in This.onScrollDown){
			       		if (typeof This.onScrollDown[x] == 'function'){
			       			This.onScrollDown[x](st,forward);
			       		}
			       	}
			   	}else if (st < This.lastScrollTop){
			   		for (var x in This.onScrollUp){
			       		if (typeof This.onScrollUp[x] == 'function'){
			       			This.onScrollUp[x](st,forward);
			       		}
			       	}
			   	}

			   This.lastScrollTop = st;
			

		};

		this.init();
	}

	function Explainer(){
		var This = this;

		this.carousel = null;

		this.init = function(){
            This.initCarousel();
            This.initCarouselPager();
            This.attachCarouselEvents();
        };

        this.initCarousel = function(){

        	$('#xplainer-carousel').cycle({
			    timeout: 0,
			    speed: 600,
			    manualSpeed: 600,
			    fx: 'scrollHorz',
			    slides : '> article',
			    next : '.cycle-next',
			    prev : '.cycle-prev'
			});

        };

        this.initCarouselPager = function(){
        	$('.pager-item').click( function(e){
        		e.preventDefault();
        		var index = $(this).attr('data-index');
        		$('#xplainer-carousel').cycle('goto', index);
        		$('.pager-item').removeClass('active');
        		$(this).addClass('active');
        	});
        };

        this.attachCarouselEvents = function(){

        	$( '#xplainer-carousel' ).on( 'cycle-after', function( event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag ) {
            	var slideIndex = optionHash.slideNum - 1;
            	$('.pager-item').removeClass('active');
			   	$('.pager-item-' + slideIndex).addClass('active');
			});

        };

        this.init();
	}

	function Search(){
		var This = this;
		this.canSearch = false;

		this.init =  function(){

			This.bindInputHandlers();
			This.bindSubmitButtonHandlers();
			This.evalCanSearchFlag();

		};

		this.evalCanSearchFlag = function(){
			var searchTerm = $('#search-term-input').val();
			if ( searchTerm.length > 2 ){
				This.canSearch = true;
			}else{
				This.canSearch = false;
			}
		};

		this.bindInputHandlers = function(){

			$('#search-term-input').keyup(function(){
				This.evalCanSearchFlag();
			});

			$('#search-term-input').keypress(function(e){
				if( e.which == 13 ) {
					This.evalSubmit();
        		}
			});

		};

		this.bindSubmitButtonHandlers = function(){

			$('#search-submit').click(function(){
				This.evalSubmit();
			});

		};

		this.evalSubmit = function(){

			if ( This.canSearch ){
				var searchTerm = $('#search-term-input').val();
				This.submit( searchTerm );
			}

		};

		this.submit = function( searchTerm ){

			$.post( xyGlobal.ajaxurl, {
				'action':'xy_ajax_search',
				'term' : searchTerm
			}, function(data){
				This.updateResults(data);
			}, 'html');

		};

		this.updateResults = function( content ){
			$('#search-results').html(content);
		};

		this.init();
	}

	main = new Main(); // Crate instance of Main

})(jQuery);	
