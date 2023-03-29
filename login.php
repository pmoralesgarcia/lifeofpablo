<?php

if(!isset($_POST['url'])) {
  die('Missing URL');
}

// Start a session for the library to be able to save state between requests.
session_start();

// You'll need to set up two pieces of information before you can use the client,
// the client ID and and the redirect URL.

// The client ID should be the home page of your app.
IndieAuth\Client::$clientID = 'https://lifeofpablo.com/';

// The redirect URL is where the user will be returned to after they approve the request.
IndieAuth\Client::$redirectURL = 'https://lifeofpablo.com/redirect.php';

// Pass the user's URL and your requested scope to the client.
// If you are writing a Micropub client, you should include at least the "create" scope.
// If you are just trying to log the user in, you can omit the second parameter.

list($authorizationURL, $error) = IndieAuth\Client::begin($_POST['url'], 'create');
// or list($authorizationURL, $error) = IndieAuth\Client::begin($_POST['url']);

// Check whether the library was able to discover the necessary endpoints
if($error) {
  echo "<p>Error: ".$error['error']."</p>";
  echo "<p>".$error['error_description']."</p>";
} else {
  // Redirect the user to their authorization endpoint
  header('Location: '.$authorizationURL);
}
