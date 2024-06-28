<?php

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..' . '')->load();

require __DIR__ . '/../briapi-sdk/autoload.php';

use BRI\Util\GenerateDate;
use BRI\Util\GetAccessToken;
use BRI\VirtualAccount\BrivaWS;

// env values
$clientId = $_ENV['CONSUMER_KEY']; // customer key
$clientSecret = $_ENV['CONSUMER_SECRET']; // customer secret
$pKeyId = $_ENV['PRIVATE_KEY']; // private key

// url path values
$baseUrl = 'https://sandbox.partner.api.bri.co.id'; //base url

// change variables accordingly
$partnerId = ''; //partner id
$channelId = ''; // channel id

$partnerServiceId = '   55888'; // partner service id
$customerNo = '9196308416'; // (new VarNumber())->generateVar(10); // customer no
$virtualAccountName = 'John Doe'; // virtual account name
$total = 10000.00; // total
$expiredDate = (new GenerateDate())->generate('+1 days');
$trxId = 'g5VTtU'; //(new GenerateRandomString())->generate();
$description = 'terangkanlah';

$getAccessToken = new GetAccessToken();

[$accessToken, $timestamp] = $getAccessToken->get(
  $clientId,
  $pKeyId,
  $baseUrl
);

$brivaWs = new BrivaWS();

/**
 * Briva WS - Update VA
 */
$response = $brivaWs->update(
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
