'use strict';

angular.module('linkR', [
  'ngRoute'
]).config(['$routeProvider', function($routeProvider) {
  $routeProvider.otherwise({redirectTo: '/'});
}]);
