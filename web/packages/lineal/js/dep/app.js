/* global Modernizr */
/* global FastClick */
/* global google */
(function(){

    // Bind FastClick
    FastClick.attach(document.body);

    /** requestAnimationFrame shim - use native/prefixed first, backup to setTimeout */
    window._requestAnimationFrame = Modernizr.prefixed('requestAnimationFrame', window) || function(callback){
        window.setTimeout(callback, 1000/ 60);
    };

    /** @var bool c5Toolbar Is the user logged in? */
    var c5Toolbar = (document.documentElement.className.indexOf('cms-admin') !== -1);

    /**
     * If any parallax elements are present on the page, and user is not
     * logged into the CMS, then init loop.
     */
    if( !c5Toolbar ){

    }


    /** @type {NodeList} Parallax elements */
    var parallaxNodes = document.querySelectorAll('[parallax]');

    if( parallaxNodes.length > 0 ){
        var _range      = document.body.scrollHeight - window.innerHeight,
            _percent    = 0,
            _nodeCache  = [];

        for(var i = 0; i < parallaxNodes.length; i++){
            _nodeCache.push({
                el: parallaxNodes[i],
                scale: +(parallaxNodes[i].getAttribute('data-scale')) || 25
            });
        }
    }

    var $navElement = $('nav'),
        /** @type number Threshold for when to dock the nav bar */
        navDockThreshold = +($navElement.attr('data-dock-threshold')) || 20,
        /** @type bool Last state of the navigation dock */
        navIsDocked = (window.pageYOffset > navDockThreshold);

    $navElement.toggleClass('docked', navIsDocked);

    /**
     * Anything related to scrolling (parallax, nav dock, etc).
     */
    (function _draw(lastScroll){
        if( lastScroll !== window.pageYOffset ){
            lastScroll = window.pageYOffset;

            // Dock the navigation bar?
            if( (lastScroll > navDockThreshold) !== navIsDocked ){
                navIsDocked = !navIsDocked;
                $navElement.toggleClass('docked', navIsDocked);
            }

            // Are we updating any parallax elements?
            if( _nodeCache && _nodeCache.length ){
                _percent   = (window.pageYOffset / _range) * 100;
                for( var i = 0, len = _nodeCache.length; i < len; i++ ){
                    _nodeCache[i].el.style.cssText += 'background-position:50% ' + Math.round(_percent + (((50 - _percent) / 50) * _nodeCache[i].scale)) + '%';
                }
            }
        }
        window._requestAnimationFrame(_draw.bind(null, lastScroll));
    })(window.pageYOffset);


    /**
     * Masthead slider
     */
    $(function(){
        $('aside', 'header').mastheader({
            transitionTime: 4500
        });

        $('.trigger', 'nav').on('click', function(){
            $(document.documentElement).toggleClass('sidebar-nav');
        });

        // Click/touch the overlay element when nav sidebar is opened and collapse sidebar
        $('nav').on('click touchend', function(event){
            if( $(document.documentElement).hasClass('sidebar-nav') && $(event.target).is('nav') ){
                $(document.documentElement).toggleClass('sidebar-nav', false);
            }
        });
    });

    /**
     * Temporary functions for showing differences in the design!
     * @todo: remove
     */
    window._temps = {
        mastheadGradients: function( _to ){
            $('body').toggleClass('masthead-gradientless', ! _to);
        }
    };
})();
(function( $ ){

    function MastHeader( $selector, _configs ){

        /**
         * Configurable options
         * @type {*|extend}
         */
        var options = $.extend({}, {
            nodeSelector        : 'figure',
            indicatorSelectors  : '.indicator',
            pauseOnHover        : ($selector.attr('data-pause-on-hover') !== undefined) || false,
            transitionTime      : +($selector.attr('data-transition-time')) || 2500
        }, _configs);

            /** @type {*|jQuery} */
        var $nodes          = $(options.nodeSelector),
            /** @type $indicators {*|jQuery} */
            $indicators     = $(options.indicatorSelectors),
            /** @type _nodeCount int */
            _nodeCount      = $nodes.length,
            /** @type _paused bool */
            _paused         = false;

        /**
         * Get the current index
         * @returns {number}
         * @private
         */
        function _currentIndex(){
            return + $nodes.filter('.active').index();
        }

        /**
         * Get the next index (eg. current index + 1, or first in a loop)
         * @returns {number}
         * @private
         */
        function _nextIndex(){
            var current = _currentIndex();
            return + (current + 1 < _nodeCount) ? current + 1 : 0;
        }

        /**
         * Get the previous index (eg. current index - 1, or last in a loop)
         * @returns {number}
         * @private
         */
        function _prevIndex(){
            var current = _currentIndex();
            return + (current === 0) ? _nodeCount - 1 : current - 1;
        }

        /**
         * Set a note and its indicator to active, by index
         * @param _index
         * @returns void
         * @private
         */
        function _activateByIndex( _index ){
            $nodes.removeClass('active').eq(_index).addClass('active');
            $indicators.removeClass('active').eq(_index).addClass('active');
        }

        /**
         * Click handler for indicators
         */
        $indicators.on('click', function(){
            _activateByIndex($(this).index());
            _paused = true;
            setTimeout(function(){
                _paused = false;
            }, options.transitionTime);
        });

        /**
         * If we should pause iteration while the masthead is hovered
         */
        if( options.pauseOnHover ){
            $selector
                .on('mouseenter', function(){ _paused = true; })
                .on('mouseleave', function(){ _paused = false; });
        }

        /**
         * Recursive iterator function
         */
        (function _iterator( _delay ){
            setTimeout(function(){
                if( ! _paused ){
                    _activateByIndex(_nextIndex());
                }
                _iterator(_delay);
            }, _delay);
        })( options.transitionTime );
    }


    /**
     * Setup jQuery binding
     * @param _configs
     * @returns {*|jQuery}
     */
    $.fn.mastheader = function( _configs ){
        return this.each(function( _index, _element ){
            var $selector = $(_element);
            if( ! ($selector.data('mastheader')) ){
                $selector.data('mastheader', new MastHeader($selector, _configs));
            }
        });
    };

})( jQuery );