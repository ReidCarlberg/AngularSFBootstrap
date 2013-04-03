<!doctype html>
<?
if(file_exists('local.settings.php'))
    include 'local.settings.php'; 
?>
<html ng-app="project">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.5/angular.js"></script>
    <script type="text/javascript">
		var app = angular.module('project', ['AngularForce', 'AngularForceObjectFactory', 'Contact']);

		app.constant('SFConfig', {'sfLoginURL': 'https://login.salesforce.com/',
	    'consumerKey': '<?= $_ENV['client_id'] ?>',
	    'oAuthCallbackURL': '<?= $_ENV['redirect_uri'] ?>',
	    'proxyUrl': '<?= $_ENV['proxy_url'] ?>'
		});    	

    </script>
    <script src="js/app.js"></script>
    <script src="js/angular-force.js"></script>
    <script src="js/forcetk.js"></script>
    <script src="js/forcetk.ui.js"></script>
</head>
<body>
<h1>Salesforce Contacts</h1>

<div ng-view></div>
</body>
</html>