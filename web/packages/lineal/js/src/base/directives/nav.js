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