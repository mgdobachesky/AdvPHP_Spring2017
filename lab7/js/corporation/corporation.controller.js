/**
 * Controller to manage app.corporation
 */
(function() {
    'use strict';
    
    // Add controller to module
    angular
        .module('app.corporation')
        .controller('CorporationController', CorporationController);

    // Include required parameters
    CorporationController.$inject = ['CorporationService'];
    
    // Define the controller
    function CorporationController(CorporationService) {
        var vm = this;
        vm.corporations = [];
        vm.deleteCorporation = deleteCorporation;
        vm.message = '';
        
        activate();
        
        ////////////
        
        function activate() {
            CorporationService.getAllCorporations().then(function(response) {
                vm.corporations = response;
            });
        }
        
        // Method used to delete a corporation
        function deleteCorporation(corp_id) {
            CorporationService.deleteCorporation(corp_id).then(function(response) {
                vm.message = 'Corporation deleted successfully';
                activate();
            }, function(error) {
                vm.message = 'There was a problem deleting the corporation';
            });
        }
    }
})();