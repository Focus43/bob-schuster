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