// Create the app module
(function() {
    // Use strict JavaScript
    'use strict';
    
    // Create the angular module and attach options
    angular
        .module('app', ['ngRoute'])
        .config(config);

    // Inject te parameter used in the config function
    config.$inject = ['$routeProvider'];
    
    // The configuration function for this module
    function config($routeProvider) {
        $routeProvider.
                when('/', {
                    templateUrl: 'js/phone-list.template.html',
                    controller: 'PhoneListController',
                    controllerAs: 'vm'
                }).
                when('/phones/:phoneId', {
                    templateUrl: 'js/phone-detail.template.html',
                    controller: 'PhoneDetailController',
                    controllerAs: 'vm'
                }).
                otherwise({
                    redirectTo: '/'
                });
    }
})();