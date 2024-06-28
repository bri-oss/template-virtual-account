<?php

use BRI\Util\GenerateDate;
use BRI\Util\GetAccessToken;
use BRI\Util\VarNumber;
use BRI\VirtualAccount\BrivaOnline;

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..' . '')->load();

require __DIR__ . '/../briapi-sdk/autoload.php';

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
$customerNo = (new VarNumber())->generateVar(10); // customer no

$getAccessToken = new GetAccessToken();

[$accessToken, $timestamp] = $getAccessToken->get(
  $clientId,
  $pKeyId,
  $baseUrl
);

$brivaOnline = new BrivaOnline();

/**
 * BRIVA Online - Inquiry
 */
$response = $brivaOnline->inquiry(
  $clientSecret,
  $partnerId,
  $baseUrl,
  $accessToken,
  $channelId = '00008',
  $timestamp,
  $partnerServiceId,
  $customerNo,
  $inquiryRequestId = 'e3bcb9a2-e253-40c6-aa77-d72cc138b744',
  $value = '100000.00',
  $currency = 'IDR',
  $trxDateInit = (new GenerateDate())->generate($modify = null, $format = 'H:i:sP', 0, 0),
  $channelCode = 8,
  $sourceBankCode = '0002',
  $passApp = 'b7aee423dc7489dfa868426e5c950c677925',
  $idApp = 'test'
);

echo $response;
