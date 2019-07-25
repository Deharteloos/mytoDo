'use strict';

angular.module('toDoApp.main', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/main', {
    templateUrl: 'main/main.html',
    controller: 'mainCtrl'
  });
}])

.controller('mainCtrl', ['$scope', '$location', function($scope, $location) {
    $scope.connServ = sessionStorage.getItem('isConnected');
    $scope.dashboard = function () {
        if(sessionStorage.getItem('user') !== null)
            $location.path('/users/'+sessionStorage.getItem('username'));
        if(sessionStorage.getItem('admin') !== null)
            $location.path('/admin/'+sessionStorage.getItem('username'));
    };

}])

.controller('navCtrl', ['$scope', '$location', function ($scope, $location) {
    $scope.connServ = sessionStorage.getItem('isConnected');
    $scope.user = JSON.parse(sessionStorage.getItem('user'));
    $scope.admin = JSON.parse(sessionStorage.getItem('admin'));
    if($scope.connServ)
        $scope.name = (sessionStorage.getItem('user') === null) ? $scope.admin.name : $scope.user.name;
    $scope.deconnect = function () {
        sessionStorage.clear();
        $location.path('/');
    };

    $scope.profil = function () {
        console.log('users/'+sessionStorage.getItem('username')+'/profil');
        $location.path('users/'+sessionStorage.getItem('username')+'/profil');
    };
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
}])

.controller('ConnectionCtrl', ['$scope', '$http', '$location', 'connService', function ($scope, $http, $location, connService) {
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
                    //connService.user = $scope.user;
                    sessionStorage.setItem('isConnected', true);
                    $location.path('users/' + $scope.user.username )/*.search('user', $scope.user)*/;
                    sessionStorage.setItem('user', JSON.stringify($scope.user));
                    sessionStorage.setItem('username', $scope.user.username);
                }
            }, function error(e, status) {
                console.log(status);
            });
    };

    $scope.admin_connect = function () {
        $http.post('scripts/connection_admin.php', {
            pseudo: $scope.pseudo_admin,
            password: $scope.password_admin
        })
            .then(function success(response) {
                $scope.result = response.data.result;
                $scope.admin = response.data.admin;
                //console.log(response.data.user);
                $('#connexion').modal('hide');
                if(angular.equals('Authentification réussie', $scope.result)) {
                    //connService.user = $scope.user;
                    sessionStorage.setItem('isConnected', true);
                    $location.path('admin/' + $scope.admin.username );
                    sessionStorage.setItem('admin', JSON.stringify($scope.admin));
                    sessionStorage.setItem('username', $scope.admin.username);
                }
            }, function error(e, status) {
                console.log(status);
            });
    }

}])

.service('connService', function () {
    this.isConnected = false;
    this.user = {};
});

