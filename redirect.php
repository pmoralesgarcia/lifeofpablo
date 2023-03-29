<?php
session_start();
IndieAuth\Client::$clientID = 'https://lifeofpablo.com/';
IndieAuth\Client::$redirectURL = 'https://lifeofpablo.com/redirect.php';

list($response, $error) = IndieAuth\Client::complete($_GET);

if($error) {
  echo "<p>Error: ".$error['error']."</p>";
  echo "<p>".$error['error_description']."</p>";
} else {
  // Login succeeded!
  // The library will return the user's profile URL in the property "me"
  // It will also return the full response from the authorization or token endpoint, as well as debug info
  echo "URL: ".$response['me']."<br>";
  if(isset($response['response']['access_token'])) {
    echo "Access Token: ".$response['response']['access_token']."<br>";
    echo "Scope: ".$response['response']['scope']."<br>";
  }

  // The full parsed response from the endpoint will be available as:
  // $response['response']

  // The raw response:
  // $response['raw_response']

  // The HTTP response code:
  // $response['response_code']

  // You'll probably want to save the user's URL in the session
  $_SESSION['user'] = $user['me'];
}
