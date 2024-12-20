<?php

require __DIR__ . '/../../briapi-sdk/autoload.php';

use BRI\Util\GetAccessToken;
use BRI\VirtualAccount\BrivaOnline;

require __DIR__ . '/../vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..' . '')->load();

// env values
$clientId = 'your_client_id';
$clientSecret = 'S7zgRMA0rUMf4ddkagpreoECgYEAxRkh';

$privateKey = $_ENV['PRIVATE_KEY'];

// url path values
$baseUrl = 'https://api.bridex.qore.page/mock'; //base url

$getAccessToken = new GetAccessToken();

$accessToken = $getAccessToken->getMockOutbound(
  $clientId,
  $baseUrl,
  $privateKey
);

$brivaOnline = new BrivaOnline();

$partnerId = 'YOWoKgXf5KcATtetyq7NbfxOz6FR65Un';

$response = $brivaOnline->payment(
  $partnerId,
  $clientId,
  $clientSecret,
  $baseUrl,
  $accessToken,
);

echo $response;
