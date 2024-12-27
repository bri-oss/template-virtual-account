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

if (!file_exists('customerNo.txt') || !file_exists('expiredDate.txt') || !file_exists('trxId.txt')) {
  echo "Please create VA first";
  return;
}

$partnerServiceId = ''; // partner service id
$customerNo = trim(file_get_contents('customerNo.txt')); //(new VarNumber())->generateVar(10); // customer no
$total = 10000.00; // total
$trxId = trim(file_get_contents('trxId.txt')); //(new GenerateRandomString())->generate();

$getAccessToken = new GetAccessToken();

[$accessToken, $timestamp] = $getAccessToken->get(
  $clientId,
  $pKeyId,
  $baseUrl
);

$brivaWs = new BrivaWS();

/**
 * Briva WS - Delete VA
 */
$response = $brivaWs->delete(
  $clientSecret,
  $partnerId,
  $baseUrl,
  $accessToken,
  $channelId,
  $timestamp,
  $partnerServiceId,
  $customerNo,
  $trxId
);

unlink('customerNo.txt');
unlink('expiredDate.txt');
unlink('trxId.txt');

echo $response;
