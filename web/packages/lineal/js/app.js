/* global FastClick */
;(function( window, angular, undefined ){ 'use strict';

    angular.module('lineal', ['lineal.base']).

    /**
     * @description App configuration
     * @param $provide
     * @param $locationProvider
     */
        config(['$provide', '$locationProvider',
            function( $provide, $locationProvider ){

                $locationProvider.html5Mode(false);

                // Applications paths
                (function( head ){
                    $provide.value('ApplicationPaths', {
                        images  : head.getAttribute('data-image-path'),
                        tools   : head.getAttribute('data-tools-path')
                    });
                })( document.querySelector('head') );

                // Provide the breakpoints from Bootstrap as values
                $provide.value('Breakpoints', {
                    xs: 480,
                    sm: 768,
                    md: 992,
                    lg: 1200
                });
            }
        ]);

})(window, window.angular);
angular.module('lineal.base', []);
angular.module('lineal.base').

    directive('header', ['$document', 'Tween', function( $document, Tween ){

        function _link( scope, $elem, attrs ){

            var mainElement     = document.querySelector('main'),
                scrollPercent   = 0,
                scrollRange     = document.body.scrollHeight - window.innerHeight,
                lastScroll      = window.pageYOffset;

            Tween.ticker.addEventListener('tick', function(){
                if( lastScroll !== window.pageYOffset ){
                    lastScroll = window.pageYOffset;
                    scrollPercent = (window.pageYOffset / scrollRange);
//                    Tween.set($elem, {marginTop:-(scrollPercent * 200)});
//                    Tween.set(mainElement, {y:-(scrollPercent * 400)});
                }
            });
        }

        return {
            restrict:   'E',
            link:       _link
        };
    }]);
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
angular.module('lineal.base').

    directive('nav', ['$document', 'Tween', function( $document, Tween ){

        function _link( scope, $elem, attrs ){

            var $documentElement    = angular.element($document[0].documentElement),
                dockThreshold       = +(attrs.dockThreshold),
                isDocked            = (window.pageYOffset > dockThreshold),
                lastScroll          = window.pageYOffset;

            $elem.toggleClass('docked', isDocked);

            Tween.ticker.addEventListener('tick', function(){
                if( lastScroll !== window.pageYOffset ){
                    lastScroll = window.pageYOffset;
                    if( (lastScroll > dockThreshold) !== isDocked ){
                        isDocked = !isDocked;
                        $elem.toggleClass('docked', isDocked);
                    }
                }
            });

            // When in sidebar format
            $elem.on('click', function(event){
                if( angular.element(event.target).hasClass('trigger') ){
                    $documentElement.toggleClass('sidebar-nav');
                    return;
                }
                $documentElement.toggleClass('sidebar-nav', !$documentElement.hasClass('sidebar-nav'));
            });
        }

        return {
            restrict:   'E',
            link:       _link
        };
    }]);
angular.module('lineal.base').

    directive('parallax', ['Tween', function( Tween ){

        var parallaxers     = [],
            scrollPercent   = 0,
            scrollRange     = document.body.scrollHeight - window.innerHeight,
            lastScroll      = window.pageYOffset;

        Tween.ticker.addEventListener('tick', function(){
            if( lastScroll !== window.pageYOffset ){
                lastScroll = window.pageYOffset;
                // Update Parallax Elements
                if( parallaxers.length ){
                    scrollPercent = (window.pageYOffset / scrollRange) * 100;
                    for(var i = 0, len = parallaxers.length; i < len; i++){
                        Tween.to(parallaxers[i].node, 0.18, {backgroundPosition:'50% ' + Math.round(scrollPercent + (((50 - scrollPercent) / 50) * parallaxers[i].scale)) + '%'});
                    }
                }
            }
        });

        function _link( scope, $elem, attrs ){
            parallaxers.push({
                node: $elem[0],
                scale: +(attrs.scale)
            });
        }

        return {
            restrict:   'A',
            link:       _link
        };
    }]);
/* global Modernizr */
/* global FastClick */
angular.module('lineal.base').

    /**
     * @description Modernizr provider
     * @param $window
     * @param $log
     * @returns Modernizr | false
     */
    provider('Modernizr', function(){
        this.$get = ['$window', '$log',
            function( $window, $log ){
                return $window['Modernizr'] || ($log.warn('Modernizr unavailable!'), false);
            }
        ];
    }).

    /**
     * @description TweenLite OR TweenMax provider
     * @param $window
     * @param $log
     * @returns TweenMax | TweenLite | false
     */
    provider('Tween', function(){
        this.$get = ['$window', '$log',
            function( $window, $log ){
                return $window['TweenMax'] || $window['TweenLite'] || ($log.warn('Tween library unavailable!'), false);
            }
        ];
    }).

    /**
     * @description FastClick provider
     * @param $window
     * @param $log
     * @returns FastClick | false
     */
    provider('FastClick', function(){
        this.$get = ['$window', '$log',
            function( $window, $log ){
                return $window['FastClick'] || ($log.warn('FastClick unavailable!'), false);
            }
        ];
    });
angular.module('lineal.base').

    controller('CtrlDocument', ['$window', 'FastClick',
        function( $window, FastClick ){

            // Initialize FastClick handler
            FastClick.attach(document.body);

        }
    ]);