<?php
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("./libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("./config/db.php");

// load the login and registration classes
require_once("./classes/Login.php");
require_once("./classes/Registration.php");

// create a login and registration object. when this object is created, it will do all login/logout stuff
// automatically so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

// add and delete cycles post
if ($login->isUserLoggedIn() == true)
	include_once("./post.php");
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>dogecycle</title>
        <meta name="description" content="menstrual cycle tracker">
        <meta name="author" content="Persimmon Time" />
        <link rel="shortcut icon" href="./img/doge/favicon.png" type="image/png">
        <meta name="viewport" content="width=700">
        <meta property="og:title" content="dogecycle" />
        <meta property="og:url" content="http://dogecycle.com/" />
        <meta property="og:description" content="menstrual cycle tracker" />
        <meta property="og:image" content="http://dogecycle.com/img/fbdoge.png">
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="600">
        <meta property="og:image:height" content="600">
        <link href="styles.css" rel="stylesheet" text="text/css" />
    </head>
    <body class="bg">
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div class="suchlikes">
			<div class="fb-like much-like" style="position:relative;top:-5px;" data-href="http://dogecycle.com/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
			<div class="tw-like much-like"><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://dogecycle.com/" data-text="wow such period tracking" data-hashtags="dogecycle, doge"></a>
			</div>
		</div>
		<?php
			if ($login->isUserLoggedIn() == true)
				include("./views/logged_in.php");
			else {
				$registration = new Registration();
				include("./views/not_logged_in.php");
			}
		?>
        <div class="container">
            <div class="doge-image"></div>
            <div id="all-cycle">
                <div id="cycle-desc"></div>
                <div id="cycle-day"></div>
                <div id="cycle-avg"></div>
            </div>
        </div>
        <div class="ourinfo"> wow <a href="https://github.com/itdelatrisu/dogecycle" target="_blank">github</a> such <a href="http://dogeweather.com/" target="_blank">inspired</a>
        </div>
		<div id="suchsecrets"><?php include("cycle.php"); ?>
		</div>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="./jquery-1.9.0.min.js"><\/script>')</script>
        <script src="./main.js"></script>
	</body>
</html>