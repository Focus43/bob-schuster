angular.module('lineal.base').

    controller('CtrlDocument', ['$window', 'FastClick',
        function( $window, FastClick ){

            // Initialize FastClick handler
            FastClick.attach(document.body);

        }
    ]);