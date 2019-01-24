<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../helpers.php";

use HMRC\Oauth2\Provider;


if (!isset($_GET[ 'client_id' ]) || !isset($_GET[ 'client_secret' ])) {
    die ("Error: Please fill both client id and client secret before test again.");
}

session_start();

$baseURL = baseURL();

$provider = new Provider(
    Provider::ENV_SANDBOX,
    $_GET[ 'client_id' ],
    $_GET[ 'client_secret' ],
    "{$baseURL}/examples/oauth2/callback.php",
    "/examples/index.php"
);
$scope = [ 'hello' ];
$provider->redirectToAuthorizationURL($scope);