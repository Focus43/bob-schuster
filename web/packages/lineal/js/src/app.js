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