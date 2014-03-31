<?php

/**
 * A simple, clean and secure PHP Login Script / MINIMAL VERSION
 * For more versions (one-file, advanced, framework-like) visit http://www.php-login.net
 *
 * Uses PHP SESSIONS, modern password-hashing and salting and gives the basic functions a proper login system needs.
 *
 * @author Panique
 * @link https://github.com/panique/php-login-minimal/
 * @license http://opensource.org/licenses/MIT MIT License
 */

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
        <link href="styles.css" rel="stylesheet" text="text/css" />
    </head>
    <body class="bg">
		<div id="suchsecrets"><?php include("cycle.php"); ?></div>
        <div id="login">
		<?php
			if ($login->isUserLoggedIn() == true)
				include("./views/user_logged_in.php");
			else {
				$registration = new Registration();
				include("./views/user_not_logged_in.php");
			}
		?>
        </div>
        <div id="such_options">
		<?php
			if ($login->isUserLoggedIn() == true)
				include("./views/options_logged_in.php");
			else
				include("./views/options_not_logged_in.php");
		?>
        </div>
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
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="./jquery-1.9.0.min.js"><\/script>')</script>
        <script src="./main.js"></script>
    </body>
</html>