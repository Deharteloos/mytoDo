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
                console.log($scope.users);
            }, function error(e) {
                $scope.errors = e.data.errors;
            });
    };
}])

.controller('ConnectionCtrl', ['$scope', '$http', '$location', function ($scope, $http, $location) {
    // Récupération de l'utilisateur
    $scope.user = [];
    $scope.result = "res";
    $scope.user_connect = function () {
        $http.post('scripts/connection_user.php', {
            pseudo: $scope.pseudo_user,
            password: $scope.password_user
        })
            .then(function success(response) {
                $scope.result = response.data.result;
                $scope.user = response.data.user;
                //console.log(response.data.user);
                $('#connexion').modal('hide');
                if(angular.equals('Authentification réussie', $scope.result)) {
                    $location.path('users/' + $scope.user.username ).search('user', $scope.user);
                    console.log('ok');
                }
            }, function error(e, status) {
                console.log(status);
            });
    };

    /*$scope.listTasks = function () {
        $http.get('script/list.php', {})
            .then(function success(e) {
                $scope.tasks = e.data.tasks;
            }, function error(e) {

            });
    };
    $scope.listTasks();*/
}]);
