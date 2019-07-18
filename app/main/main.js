'use strict';

angular.module('toDoApp.main', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/main', {
    templateUrl: 'main/main.html',
    controller: 'mainCtrl'
  });
}])

.controller('mainCtrl', [function() {

}])

.controller('InscriptionCtrl', ['$scope', '$http', function ($scope, $http) {
    $scope.users = [];
    $scope.save = function () {
        $http.post('scripts/create_user.php', {
            user: $scope.user
        })
            .then(function success(e) {

                $scope.errors = [];

                $scope.users.push(e.data.user);
                $('#inscription').modal('hide');

            }, function error(e) {
                $scope.errors = e.data.errors;
            });
    };
}]);
