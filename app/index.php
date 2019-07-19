<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" ng-app="toDoApp" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" ng-app="toDoApp" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" ng-app="toDoApp" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" ng-app="toDoApp" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My toDo App</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/icon_home-10.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="lib/MDBootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="lib/MDBootstrap/css/mdb.min.css" />
    <!--<link rel="stylesheet" href="lib/html5-boilerplate/dist/css/normalize.css">-->
    <!--<link rel="stylesheet" href="lib/html5-boilerplate/dist/css/main.css">-->
    <link rel="stylesheet" href="app.css">
    <!--<script src="lib/html5-boilerplate/dist/js/vendor/modernizr-2.8.3.min.js"></script>-->
</head>
<body>
    <!--<ul class="menu">
        <li><a href="#!/main">main</a></li>
        <li><a href="#!/user">user</a></li>
    </ul>-->

    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <header>
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark light-green">

            <!-- Navbar brand -->
            <a class="navbar-brand" href="#"><img src="images/Icon.png" height="40" class="d-inline-block align-top" alt="toDoIcon"></a>

            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible content -->
            <div class="collapse navbar-collapse" id="basicExampleNav">

                <!-- Links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#connexion">Se Connecter</a>
                    </li>
                </ul>
                <!-- Links -->

            </div>
            <!-- Collapsible content -->

        </nav>
        <!--/.Navbar-->
        <div class="view" ></div>
    </header>

    <main class="container-fluid">
        <div ng-view></div>
    </main>

    <div class="footer">
        <div class="container">
            <p><span class="glyphicon glyphicon-heart"></span> from the Yeoman team</p>
        </div>
    </div>

    <!--<div>AngularJS seed app: v<span app-version></span></div>-->

    <!-- In production use:
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/x.x.x/angular.min.js"></script>
    -->
    <script src="lib/angular/angular.js"></script>
    <script src="lib/angular-route/angular-route.js"></script>
    <script src="lib/MDBootstrap/js/jquery-3.4.1.min.js"></script>
    <script src="lib/MDBootstrap/js/popper.min.js"></script>
    <script src="lib/MDBootstrap/js/bootstrap.min.js"></script>
    <script src="lib/MDBootstrap/js/mdb.min.js"></script>
    <script src="app.js"></script>
    <script src="main/main.js"></script>
    <script src="user/user.js"></script>
    <script src="core/version/version.js"></script>
    <script src="core/version/version-directive.js"></script>
    <script src="core/version/interpolate-filter.js"></script>
</body>
</html>
