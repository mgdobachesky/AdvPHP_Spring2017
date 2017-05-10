(function () {

    'use strict';
    angular
        .module('app.address')
        .controller('AddressDeleteController', AddressDeleteController);

    AddressDeleteController.$inject = ['$routeParams','AddressService'];

    /*
     * This controller will find the details of an address from the address service.
     */
    function AddressDeleteController($routeParams, AddressService) {
        var vm = this;

        vm.address = {};
        vm.message = '';
        vm.addressId = $routeParams.addressId;

        activate();

        ////////////

        function activate() {
          AddressService.deleteAddress(vm.addressId).then(function(){
            vm.message = ' Address Deleted';
          },
          function() {
            vm.message = ' Address Not Deleted';
          });
        }

    }

})();
