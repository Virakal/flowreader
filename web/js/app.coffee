"use strict";

app = angular.module 'flow', ['ui']

# Since we're using Twig and it conflicts with Angular's curly braces
# we need to change Angular's interpolation symbols
app.config ($interpolateProvider) ->
    $interpolateProvider.startSymbol '{['
    $interpolateProvider.endSymbol ']}'

app.run ($rootScope) ->
    $ ()->
        # Allow selective CSS depending on whether JS is enabled
        $('body').removeClass('no-js').addClass('js')

app.factory 'KeyHandler', ($rootScope) ->
    _keyMap:
        'enter': 13
        'space': 32
        'up': 38
        'down': 40
        'left': 37
        'right': 39

    add: (spec) ->
        selector = spec.selector or null
        eventName = spec.eventName or 'keyup'

        $('body').on eventName, spec.selector, (e) =>
            key = this._keyMap[spec.key] || spec.key.charCodeAt(0)

            if key is e.which
                cb = false
                $rootScope.$apply () ->
                    cb = spec.callback(e)

            return cb


class Chapter
    constructor: (prototype) ->
        this.__proto__ = prototype

class Series
    constructor: (prototype) ->
        this.__proto__ = prototype

class PageList
    @_pageNoRegex: /\/(\d+)\/?$/

    # Figure out the current page from the URL
    _currentPage: parseInt document.location.pathname.match(@_pageNoRegex)?[1] - 1

    constructor: (list) ->
        this.list = list

    getCurrent: () =>
        this.list[this._currentPage]

    getPage: (id) =>
        this.list[id]

    setPage: (id) =>
        this._currentPage = id

        return this

    nextPage: () =>
        this._currentPage++;

        return this.getCurrent()

    prevPage: () =>
        this._currentPage--;

        return this.getCurrent()

class PageCtrl
    constructor: ($scope, $rootScope, $http, KeyHandler) ->
        $scope.nextPage = ($event) ->
            $event.preventDefault()
            $scope.pages.nextPage()

            return true

        $scope.prevPage = ($event) ->
            $event.preventDefault()
            $scope.pages.prevPage()

            return true

        KeyHandler.add
            key: 'right'
            callback: $scope.nextPage

        KeyHandler.add
            key: 'left'
            callback: $scope.prevPage

        $scope.url = document.location.pathname

        $http.get($scope.url).success (data, status, headers, config) ->
            $scope.chapter = new Chapter data.chapter
            $scope.series = new Series data.series
            $scope.pages = new PageList data.pages
            $scope.page = $scope.pages.getCurrent()

            $scope.$watch 'pages._currentPage', () ->
                $scope.page = $scope.pages?.getCurrent()

