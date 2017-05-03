// Service for phones
(function() {
    // Use strict JavaScript
    'use strict';
    
    // Define the service for the main module
    angular
        .module('app')
        .factory('PhonesService', PhonesService);

    // Inject required parameters
    PhonesService.$inject = ['$http', 'REQUEST'];
    
    // Define the phones service
    function PhonesService($http, REQUEST) {
        var url = REQUEST.Phones;
        var service = {
            'getPhones': getPhones,
            'findPhone': findPhone
        };
        return service;
        
        // Define the function that gets phones
        function getPhones() {
            // Promise on the url get
            return $http.get(url)
                    .then(getPhonesComplete, getPhonesFailed);
            
            // Promise fulfillment
            function getPhonesComplete(response) {
                return response.data;
            }
            
            function getPhonesFailed(error) {
                return [];
            }
        }
        
        // Define the function that will find individual phones
        function findPhone(id) {
            return getPhones()
                .then(function(data) {
                   return findPhoneComplete(data); 
                });
                
            // Function that looks for a specific phone
            function findPhoneComplete(data) {
                var results = {};
                
                angular.forEach(data, function(value, key) {
                    if(!results.length) {
                        if(value.hasOwnProperty('id') && value.id === id) {
                            results = angular.copy(value);
                        }
                    } 
                }, results);
                
                return results;
            }
        }
    }
})();