/**
 * Controller to manage app.corporation details
 */
(function() {
    'use strict';
    
    // Add controller to app.corporation module
    angular
        .module('app.corporation')
        .controller('CorporationDetailController', CorporationDetailController);

    // Inject required parameters
    CorporationDetailController.$inject = ['$routeParams', 'CorporationService'];
    
    // Define the controller function
    function CorporationDetailController($routeParams, CorporationService) {
        var vm = this;
        vm.corporation = {};
        var corporationId = $routeParams.corporationId;
        
        activate();
        
        ////////////
        
        function activate() {
            CorporationService.getCorporation(corporationId).then(function(response) {
                // Save and format data
                vm.corporation = response;
                if(vm.corporation.hasOwnProperty('incorp_dt')) {
                    vm.corporation.incorp_dt = new Date(vm.corporation.incorp_dt);
                }
                // Load GoogleMaps map
                loadMap(vm.corporation.location);
            });
        }
        
        // Method to load a GoogleMaps map
        function loadMap(location) {
            var lat = location.split(',')[0];
            var long = location.split(',')[1];
            
            var myCenter = new google.maps.LatLng(lat, long);
            
            var mapProp = {
              center: myCenter,
              zoom: 10,
              mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.querySelector('.googleMap'), mapProp);
            var marker = new google.maps.Marker({
                position: myCenter
            });
            marker.setMap(map);
        }
    }
})();