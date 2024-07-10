<?php

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..' . '')->load();

require __DIR__ . '/../../briapi-sdk/autoload.php';

use BRI\Util\GenerateDate;
use BRI\Util\GenerateRandomString;
use BRI\Util\GetAccessToken;
use BRI\Util\VarNumber;
use BRI\VirtualAccount\BrivaWS;

$clientId = $_ENV['CONSUMER_KEY']; // customer key
$clientSecret = $_ENV['CONSUMER_SECRET']; // customer secret
$pKeyId = $_ENV['PRIVATE_KEY']; // private key

// url path values
$baseUrl = 'https://sandbox.partner.api.bri.co.id'; //base url

// change variables accordingly
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$partnerServiceId = '   55888'; // partner service id
$customerNo = (new VarNumber())->generateVar(10); // customer no
$virtualAccountName = 'John Doe'; // virtual account name
$total = 10000.00; // total
$expiredDate = '2024-07-11T17:01:10+07:00';//(new GenerateDate())->generate('+1 days');
$trxId = (new GenerateRandomString())->generate();
$description = '';

$getAccessToken = new GetAccessToken();

[$accessToken, $timestamp] = $getAccessToken->get(
  $clientId,
  $pKeyId,
  $baseUrl
);

$brivaWs = new BrivaWS();

/**
 * Briva WS - Create VA
 */
$response = $brivaWs->create(
  $clientSecret = $clientSecret, 
  $partnerId = $partnerId, 
  $baseUrl,
  $accessToken, 
  $channelId,
  $timestamp,
  $partnerServiceId,
  $customerNo,
  $virtualAccountName,
  $total,
  $expiredDate,
  $trxId,
  $description // optional
);

echo $response;
