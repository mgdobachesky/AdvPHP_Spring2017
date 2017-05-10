/**
 * Service to handle data interactions
 */
(function() {
    'use strict';
    
    // Set the service in the app.address module
    angular
        .module('app.corporation')
        .factory('CorporationService', CorporationService);

    // Inject required parameters
    CorporationService.$inject = ['$http', 'REQUEST'];
    
    // Define the service
    function CorporationService($http, REQUEST) {
        // Save url to api
        var url = REQUEST.Corporation;
        
        // Define and return service functions in an object
        var service = {
            'getAllCorporations': getAllCorporations,
            'getCorporation': getCorporation,
            'postCorporation': postCorporation,
            'putCorporation': putCorporation,
            'deleteCorporation': deleteCorporation
        };
        return service;
        
        // Handle GET all requests
        function getAllCorporations() {
            return $http.get(url)
                .then(handleSuccess, handleFailed);
        
            function handleSuccess(response) {
                return response.data.data;
            }
            
            function handleFailed(error) {
                return [];
            }
        }
        
        // Handle GET specific requests
        function getCorporation(corp_id) {
            var _url = url + '/' + corp_id;
            
            return $http.get(_url)
                    .then(handleSuccess, handleFailed);
            
            function handleSuccess(response) {
                return response.data.data[0];
            }
            
            function handleFailed(error) {
                return [];
            }
        }
        
        // Handle POST requests
        function postCorporation(corp, incorp_dt, email, owner, phone, location) {
            var model = {};
            model.corp = corp;
            model.incorp_dt = incorp_dt;
            model.email = email;
            model.owner = owner;
            model.phone = phone;
            model.location = location;
            return $http.post(url, model);
        }
        
        // Handle PUT requests
        function putCorporation(corp_id, corp, incorp_dt, email, owner, phone, location) {
            var _url = url + '/' + corp_id;
            var model = {};
            model.corp = corp;
            model.incorp_dt = incorp_dt;
            model.email = email;
            model.owner = owner;
            model.phone = phone;
            model.location = location;
            return $http.put(_url, model);
        }
        
        // Handle DELETE requests
        function deleteCorporation(corp_id) {
            var _url = url + '/' + corp_id;
            return $http.delete(_url);
        }
    }
})();