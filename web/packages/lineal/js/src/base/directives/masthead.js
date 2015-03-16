angular.module('lineal.base').

    directive('masthead', function(){

        function _link( scope, $elem, attrs ){

            var $nodes          = angular.element($elem[0].querySelectorAll('figure')),
                nodeCount       = $nodes.length - 1,
                indicators      = $elem[0].querySelectorAll('.indicator'),
                $indicators     = angular.element(indicators),
                transitionTime  = +(attrs.transitionTime),
                pauseOnHover    = true,
                isPaused        = false,
                indexActive     = 0;

            function renderByIndex( _index ){
                $nodes.removeClass('active').eq(_index).addClass('active');
                $indicators.removeClass('active').eq(_index).addClass('active');
            }

            function next(){
                indexActive = (indexActive === nodeCount) ? 0 : indexActive + 1;
                renderByIndex(indexActive);
            }

            function prev(){
                indexActive = (indexActive === 0) ? nodeCount : indexActive - 1;
                renderByIndex(indexActive);
            }

            // Clicking an indicator
            $indicators.on('click touchend', function(){
                indexActive = Array.prototype.slice.call(indicators).indexOf(this);
                renderByIndex(indexActive);
            });

            if( pauseOnHover ){
                $elem.on('mouseenter', function(){ isPaused = true; })
                     .on('mouseleave', function(){ isPaused = false; });

            }

            (function _loop( _delay ){
                setTimeout(function(){
                    if( ! isPaused ){
                        next();
                    }
                    _loop(_delay);
                }, _delay);
            })(transitionTime);
        }

        return {
            restrict:   'A',
            link:       _link
        };
    });