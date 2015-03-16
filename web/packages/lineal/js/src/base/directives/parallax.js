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