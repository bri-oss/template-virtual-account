<?php

require __DIR__ . '/../../briapi-sdk/autoload.php';

use BRI\Util\GetAccessToken;
use BRI\VirtualAccount\BrivaOnline;

// env values
$clientId = '';
$clientSecret = '';

// url path values
$baseUrl = 'https://api.bridex.qore.page/mock'; //base url

$getAccessToken = new GetAccessToken();

$accessToken = $getAccessToken->getMockOutbound(
  $clientId,
  $clientSecret,
  $baseUrl
);

$brivaOnline = new BrivaOnline();

$partnerId = '';

$response = $brivaOnline->payment(
  $partnerId,
  $clientId,
  $clientSecret,
  $baseUrl,
  $accessToken,
);

echo $response;
