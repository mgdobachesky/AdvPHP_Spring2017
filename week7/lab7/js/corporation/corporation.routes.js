/**
 * Set up routes for the app.corporation module
 */
(function() {
    'use strict';
    
    // Add configuration to the app.corporation module
    angular
        .module('app.corporation')
        .config(config);

    // Inject required parameters
    config.$inject = ['$routeProvider'];
    
    // Define the module configuration
    function config($routeProvider) {
        $routeProvider.
            when('/corporation', {
                templateUrl: 'js/corporation/corporation.template.html',
                controller: 'CorporationController',
                controllerAs: 'vm'
            }).
            when('/corporation/:corporationId', {
                templateUrl: 'js/corporation/corporation-detail.template.html',
                controller: 'CorporationDetailController',
                controllerAs: 'vm'
            }).
            otherwise({redirectTo: '/corporation'});
    }
})();