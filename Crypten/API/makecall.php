<?php
// Require the bundled autoload file - the path may need to change
// based on where you downloaded and unzipped the SDK
require __DIR__ . '/twilio-php-master/Twilio/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = 'AC922112696fc8d06df2a04b8e172221b5';
$token = '882711a56ff0b0da6c8ed0e94ac46a0f';
$client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
$call = $client->calls->create(
  '8968894728', // Call this number
  '7402004697 ', // From a valid Twilio number
  array(
      'url' => 'https://twimlets.com/holdmusic?Bucket=com.twilio.music.ambient'
  )
);