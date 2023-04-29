<?php
require_once __DIR__ . '/vendor/autoload.php';

use IndieAuth\Client\Client;

$domain = $_POST['domain'];

$client = new Client($domain);

$authorizationURL = $client->getAuthorizationURL('https://lifeofpablo.com/callback.php');

header('Location: ' . $authorizationURL);
exit;

