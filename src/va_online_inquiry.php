<?php

use BRI\Util\GetAccessToken;
use BRI\VirtualAccount\BrivaOnline;

require __DIR__ . '/../../briapi-sdk/autoload.php';

// env values
$clientId = 'YOWoKgXf5KcATtetyq7NbfxOz6FR65Un';
$clientSecret = 'super_secret';

// url path values
$baseUrl = 'https://api.bridex.qore.page/mock'; //base url

$getAccessToken = new GetAccessToken();

$accessToken = $getAccessToken->getMockOutbound(
  $clientId,
  $clientSecret,
  $baseUrl
);

$brivaOnline = new BrivaOnline();

$partnerId = 'YOWoKgXf5KcATtetyq7NbfxOz6FR65Un';

$response = $brivaOnline->inquiry(
  $partnerId,
  $clientId,
  $clientSecret,
  $baseUrl,
  $accessToken,
);

echo $response;