<?php

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..' . '')->load();

require __DIR__ . '/../briapi-sdk/autoload.php';

use BRI\Util\GenerateDate;
use BRI\Util\GetAccessToken;
use BRI\Util\VarNumber;
use BRI\VirtualAccount\BrivaOnline;

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
$inquiryRequestId = '';
$value = '';
$currency = 'IDR';
$trxDateInit = (new GenerateDate())->generate($modify = null, $format = 'H:i:sP', 0, 0);
$channelCode = 8;
$sourceBankCode = '';
$passApp = '';
$idApp = 'test';

$getAccessToken = new GetAccessToken();

[$accessToken, $timestamp] = $getAccessToken->get(
  $clientId,
  $pKeyId,
  $baseUrl
);

$brivaOnline = new BrivaOnline();

/**
 * BRIVA Online - Payment
 */
$response = $brivaOnline->payment(
  $clientSecret,
  $partnerId,
  $baseUrl,
  $accessToken,
  $channelId,
  $timestamp,
  $partnerServiceId,
  $customerNo,
  $inquiryRequestId,
  $value,
  $currency,
  $trxDateInit,
  $channelCode,
  $sourceBankCode,
  $passApp,
  $idApp
);

echo $response;
