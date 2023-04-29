<?php
require_once __DIR__ . '/vendor/autoload.php';

use IndieAuth\Client\Client;

$client = new Client();

$me = $client->verifyIndieAuth();

if ($me) {
  // The user is authenticated, do something here
} else {
  // The user is not authenticated, handle the error here
}

