<?php

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..' . '')->load();

require __DIR__ . '/../../briapi-sdk/autoload.php';

use BRI\Util\GenerateDate;
use BRI\Util\GetAccessToken;
use BRI\Util\VarNumber;
use BRI\VirtualAccount\BrivaWS;

// env values
$clientId = $_ENV['CONSUMER_KEY']; // customer key
$clientSecret = $_ENV['CONSUMER_SECRET']; // customer secret
$pKeyId = $_ENV['PRIVATE_KEY']; // private key

// url path values
$baseUrl = 'https://sandbox.partner.api.bri.co.id'; //base url

// change variables accordingly
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

if (!file_exists('customerNo.txt') || !file_exists('expiredDate.txt') || !file_exists('trxId.txt')) {
  echo "Please create VA first";
  return;
}

$partnerServiceId = '   55888'; // partner service id
$customerNo = trim(file_get_contents('customerNo.txt')); //(new VarNumber())->generateVar(10); // customer no
$virtualAccountName = 'John Doe'; // virtual account name
$total = 10000.00; // total
$expiredDate = trim(file_get_contents('expiredDate.txt')); //(new GenerateDate())->generate('+1 days');
$trxId = trim(file_get_contents('trxId.txt')); //(new GenerateRandomString())->generate();
$description = '';

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
