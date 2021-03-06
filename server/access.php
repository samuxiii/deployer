<?php

define("BLOCKTIME", 3000);

//Stevenmaguire lib dependency
require __DIR__."/vendor/autoload.php";

$config = include('config.php');
$url_client = $config->url_home;

$provider = new Stevenmaguire\OAuth2\Client\Provider\Bitbucket([
    'clientId'          => $config->bitbucket['clientId'],
    'clientSecret'      => $config->bitbucket['clientSecret'],
    'redirectUri'       => $config->bitbucket['redirectUri']
]);

/* administering session vars */
session_start();
$timeslot_now = round(time()/BLOCKTIME);

if (isset($_SESSION['token']) && ($_SESSION['timeslot'] == $timeslot_now)) {
    echo $_SESSION['token'];
    return;
}
elseif (isset($_SESSION['token'])) {
    unset($_SESSION['token']);
    unset($_SESSION['timeslot']);
}

/* retrieving token procedure */
if (!isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: '.$authUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {

    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    $_SESSION['token'] = $token->getToken();
    $_SESSION['timeslot'] = round(time()/BLOCKTIME);
    
    echo "<a href='$backURL'>back</a>";
    header('Location: '.$url_client);
    return;
}
?>