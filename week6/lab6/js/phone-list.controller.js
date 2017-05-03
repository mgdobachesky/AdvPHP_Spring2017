// Controller for the phone-list view
(function() {
    // Use strict JavaScript
    'use strict';
    
    // Create the PhoneListController on the app module
    angular
        .module('app')
        .controller('PhoneListController', PhoneListController);

    // Inject parameters to be used in controller
    PhoneListController.$inject = ['PhonesService'];
    
    // Define the controller for the PhoneList
    function PhoneListController(PhonesService) {
        var vm = this;
        vm.phones = [];
        
        activate();
        function activate() {
            PhonesService.getPhones().then(function(response) {
                vm.phones = response;
            });
        }
    }
})();