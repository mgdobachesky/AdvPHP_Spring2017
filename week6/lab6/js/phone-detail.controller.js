// Phone detail controller
(function() {
    // Use strict JavaScript
    'use strict';
    
    // Add the controller to the main module
    angular
        .module('app')
        .controller('PhoneDetailController', PhoneDetailController);

    // Inject parameters to be used in controller
    PhoneDetailController.$inject = ['$routeParams', 'PhonesService'];
    
    // Define the controller function
    function PhoneDetailController($routeParams, PhonesService) {
        var vm = this;
        vm.phone = {};
        var id = $routeParams.phoneId;
        
        activate();
        function activate() {
            PhonesService.findPhone(id).then(function(response) {
                vm.phone = response;
            });
        }
    }
})();