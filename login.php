<!doctype html>
<html >
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap.min.css" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="jquery191/jquery.popup.js"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.5/angular.js"></script>
    <script src="app.js"></script>
    <script src="angular-force.js"></script>

    <script src="forcetk.js"></script>
    <script src="forcetk.ui.js"></script>
    <script type="text/javascript">
/* Heroku */
var loginUrl    = 'https://login.salesforce.com/';
var clientId    = '3MVG9y6x0357HlefwuOOB3c0LW2ekPHWaGrokYkQsf5rnZQsw.pL8xHe.e1BVEin52JTot4yZDbw5SiJwM0P9';
var redirectUri = 'https://murmuring-sands-5964.herokuapp.com/oauthcallback.html';
var proxyUrl    = 'https://murmuring-sands-5964.herokuapp.com/proxy.php?mode=native';

// We'll get an instance of the REST API client in a callback after we do 
// OAuth
// We'll get an instance of the REST API client in a callback after we do 
// OAuth
var client = new forcetk.Client(clientId, loginUrl, proxyUrl);;

// We use $j rather than $ for jQuery
if (window.$j === undefined) {
    $j = $;
}

$j(document).ready(function() {
	$j('#login').popupWindow({ 
		windowURL: getAuthorizeUrl(loginUrl, clientId, redirectUri),
		windowName: 'Connect',
		centerBrowser: 0,
		height:480, 
		width:320
	});
});

function getAuthorizeUrl(loginUrl, clientId, redirectUri){
    return loginUrl+'services/oauth2/authorize?display=touch'
        +'&response_type=token&client_id='+escape(clientId)
        +'&redirect_uri='+escape(redirectUri);
}

function sessionCallback(oauthResponse) {
	console.log(oauthResponse);
    if (typeof oauthResponse === 'undefined'
        || typeof oauthResponse['access_token'] === 'undefined') {
        //$j('#prompt').html('Error - unauthorized!');
        errorCallback({
            status: 0, 
            statusText: 'Unauthorized', 
            responseText: 'No OAuth response'
        });
    } else {
    	console.log('1');
        client.setSessionToken(oauthResponse.access_token, null,
            oauthResponse.instance_url);

		addClickListeners();

		$j('#results').text="in callback";

	    //$j.mobile.changePage('#mainpage',"slide",false,true);
	    //$j.mobile.pageLoading();
	    //$j.mobile.loading();
	    //getAccounts(function(){
	    //    $j.mobile.loading(true);
	    //});
    }
}
    </script>

</head>
<body>
<h2>Salesforce Login</h2>
<div id="results" ></div>
</body>
</html>