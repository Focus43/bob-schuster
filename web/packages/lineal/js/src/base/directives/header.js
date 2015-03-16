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