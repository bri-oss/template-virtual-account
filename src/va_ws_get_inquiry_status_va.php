<?php

use BRI\Util\GenerateRandomString;
use BRI\Util\GetAccessToken;
use BRI\Util\VarNumber;
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
$partnerId = ''; //partner id
$channelId = ''; // channel id

$partnerServiceId = ''; // partner service id
$customerNo = ''; //(new VarNumber())->generateVar(10); // customer no
$inquiryRequestId = (new GenerateRandomString())->generate(5);

$getAccessToken = new GetAccessToken();

[$accessToken, $timestamp] = $getAccessToken->get(
  $clientId,
  $pKeyId,
  $baseUrl
);

$brivaWs = new BrivaWS();

/**
 * Briva WS - Inquiry Status VA
 */
$response = $brivaWs->inquiryStatus(
  $clientSecret, 
  $partnerId, 
  $baseUrl,
  $accessToken, 
  $channelId,
  $timestamp,
  $partnerServiceId,
  $customerNo,
  $inquiryRequestId,
);

echo $response;
