<?php
// Google_API_client
require_once './vendor/autoload.php';

$clientid = '';
$clientSecret = '';
$redirectUri = 'http://localhost/PHP_Login_System/';
// $redirectUri = 'https://php-login-system.herokuapp.com/';


$client = new Google_Client();
$client->setClientId($clientid);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);

$client->addScope('email');
$client->addScope('profile');

if(isset($_GET['code'])){
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // echo "<pre>";
    // print_r($token);
    // echo "</pre>";

    // Get Profile info
    $G_oauth = new Google_Service_Oauth2($client);
    $G_aInfo = $G_oauth->userinfo->get();

    // echo "<pre>";
    // print_r($G_aInfo);
    // echo "</pre>";

    $G_email = $G_aInfo['email'];
    $G_name = $G_aInfo['name'];
    $G_picture = $G_aInfo['picture'];

    $_SESSION['Gname'] = $G_aInfo['name'];
    $_SESSION['Gemail'] = $G_aInfo['email'];
    $_SESSION['Gdp'] = $G_aInfo['picture'];

    // echo "<img src='$G_picture'><br>";
    // echo "$G_email"."<br>";
    // echo "$G_name"."<br>";
}
// Google_API_client