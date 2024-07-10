<?php

use BRI\Util\GenerateDate;
use BRI\Util\GetAccessToken;
use BRI\VirtualAccount\BrivaWS;

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..' . '')->load();

require __DIR__ . '/../../briapi-sdk/autoload.php';

// env values
$clientId = $_ENV['CONSUMER_KEY']; // customer key
$clientSecret = $_ENV['CONSUMER_SECRET']; // customer secret
$pKeyId = $_ENV['PRIVATE_KEY']; // private key

// url path values
$baseUrl = 'https://sandbox.partner.api.bri.co.id'; //base url

// change variables accordingly
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$partnerServiceId = '   77777'; // partner service id
$startDate = '2024-06-21';//(new GenerateDate())->generate('+1 days', 'Y-m-d'); //'2024-06-21';
$startTime = '00:00:00+07:00';
$endTime = '22:00:00+07:00';

$getAccessToken = new GetAccessToken();

[$accessToken, $timestamp] = $getAccessToken->get(
  $clientId,
  $pKeyId,
  $baseUrl
);

$brivaWs = new BrivaWS();

/**
 * Briva WS - Get Report VA
 */
$response = $brivaWs->getReport(
  $clientSecret = $clientSecret, 
  $partnerId = $partnerId, 
  $baseUrl,
  $accessToken,
  $channelId,
  $timestamp,
  $partnerServiceId,
  $startDate,//(new GenerateDate())->generate($modify = '+1 days', $format = 'Y-m-d'),//'2024-01-19',
  $startTime, //(new GenerateDate())->generate($modify = null, $format = 'H:i:sP', 0, 0),
  $endTime // (new GenerateDate())->generate($modify = null, $format = 'H:i:sP', 23, 59),
);

echo $response;
