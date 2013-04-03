var app = angular.module('project', ['AngularForce', 'AngularForceObjectFactory', 'Contact']);

//localhost
app.constant('SFConfig', {'sfLoginURL': 'https://login.salesforce.com/',
    'consumerKey': '3MVG9y6x0357HlefwuOOB3c0LW3fdpFZd6WcFrl4NaWJaAjeB3XAFjSBa5yYdYjp_.pvBWIuVJN2YUWg.Yh9s',
    'oAuthCallbackURL': 'https://localhost/AngularSFBootstrap/oauthcallback.html',
    'proxyUrl': 'https://localhost/AngularSFBootstrap/proxy.php?mode=native'
});
//heroku-1
app.constant('SFConfig', {'sfLoginURL': 'https://login.salesforce.com/',
    'consumerKey': '3MVG9y6x0357HlefwuOOB3c0LW3fdpFZd6WcFrl4NaWJaAjeB3XAFjSBa5yYdYjp_.pvBWIuVJN2YUWg.Yh9s',
    'oAuthCallbackURL': 'https://murmuring-sands-5964.herokuapp.com/oauthcallback.html',
    'proxyUrl': 'https://murmuring-sands-5964.herokuapp.com/proxy.php?mode=native'
});


app.config(function ($routeProvider) {
    $routeProvider.
        when('/', {controller: ListCtrl, templateUrl: 'list.html'}).
        when('/edit/:contactId', {controller: EditCtrl, templateUrl: 'detail.html'}).
        when('/new', {controller: CreateCtrl, templateUrl: 'detail.html'}).
        otherwise({redirectTo: '/'});
});

/**
 * Describe Salesforce object to be used in the app. For example: Below AngularJS factory shows how to describe and
 * create an 'Contact' object. And then set its type, fields, where-clause etc.
 *
 *  PS: This module is injected into ListCtrl, EditCtrl etc. controllers to further consume the object.
 */
angular.module('Contact', []).factory('Contact', function (AngularForceObjectFactory) {
    var Contact = AngularForceObjectFactory({type: 'Contact', fields: ['FirstName', 'LastName', 'Title','Phone','Email', 'Id'], where: ''});
    return Contact;
});

function ListCtrl($scope, AngularForce, Contact) {
    AngularForce.login(function () {
        Contact.query(function (data) {
            $scope.contacts = data.records;
            $scope.$apply();//Required coz sfdc uses jquery.ajax
        });
    });
}

function CreateCtrl($scope, $location, Contact) {
    $scope.save = function () {
        Contact.save($scope.contact, function (contact) {
            var p = contact;
            $scope.$apply(function () {
                $location.path('/edit/' + p.id);
            });
        });
    }
}

function EditCtrl($scope, AngularForce, $location, $routeParams, Contact) {
    var self = this;

    AngularForce.login(function () {
        Contact.get({id: $routeParams.contactId}, function (contact) {
            self.original = contact;
            $scope.contact = new Contact(self.original);
            $scope.$apply();//Required coz sfdc uses jquery.ajax
        });
    });

    $scope.isClean = function () {
        return angular.equals(self.original, $scope.contact);
    };

    $scope.destroy = function () {
        self.original.destroy(function () {
            $scope.$apply(function () {
                $location.path('/list');
            });
        });
    };

    $scope.save = function () {
        $scope.contact.update(function () {
            $scope.$apply(function () {
                $location.path('/');
            });

        });
    };
}
