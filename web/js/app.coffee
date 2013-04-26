"use strict";

app = angular.module 'flow', ['ui']

app.config ($interpolateProvider) ->
    $interpolateProvider.startSymbol '{['
    $interpolateProvider.endSymbol ']}'

app.run ['$rootScope', ($rootScope) ->


]

class PageCtrl
    constructor: ($scope, $rootScope, $http) ->
        $scope.loading = true
        $scope.url = document.location.pathname

        $http.get($scope.url).success (data, status, headers, config) ->
            $scope.loading = false
            $rootScope.$broadcast 'loadComplete'

            $scope.chapter = new Chapter data.chapter
            $scope.series = new Series data.series
            $scope.pages = new PageList data.pages
            $scope.page = data.pages.getCurrent()