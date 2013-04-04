<!doctype html>
<?
if(file_exists('../local.settings.php'))
    include '../local.settings.php'; 
?>
<html ng-app="AngularSFDemo">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.5/angular.js"></script>
    <script type="text/javascript">
		var app = angular.module('AngularSFDemo', ['AngularForce', 'AngularForceObjectFactory', 'Contact']);

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
<div class="container">
	<div class="navbar">
	  <div class="navbar-inner">
	    <a class="brand" href="#">Salesforce Contacts</a>
	  </div>
	</div>

<div ng-view></div>
</div>
</body>
</html>