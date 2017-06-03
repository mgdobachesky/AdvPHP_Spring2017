/**
 * Set up the corporations module on the main app
 */
(function() {
    'use strict';
    
    angular.module('app.corporation', []);
    angular.module('app').requires.push('app.corporation');
})();