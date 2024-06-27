<?php

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..' . '')->load();

require __DIR__ . '/../briapi-sdk/autoload.php';

use BRI\Util\GenerateDate;
use BRI\Util\GenerateRandomString;
use BRI\Util\GetAccessToken;
use BRI\Util\VarNumber;
use BRI\VirtualAccount\BrivaOnline;
use BRI\VirtualAccount\BrivaWS;

// env values
$clientId = $_ENV['CONSUMER_KEY']; // customer key
$clientSecret = $_ENV['CONSUMER_SECRET']; // customer secret
$pKeyId = $_ENV['PRIVATE_KEY']; // private key

// url path values
$baseUrl = 'https://sandbox.partner.api.bri.co.id'; //base url

// change variables accordingly
$account = '111231271284142'; // account number
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$partnerServiceId = '   55888'; // partner service id
$customerNo = (new VarNumber())->generateVar(10); // customer no
$virtualAccountName = 'John Doe'; // virtual account name
$total = 10000.00; // total
$expiredDate = (new GenerateDate())->generate('+1 days');
$trxId = (new GenerateRandomString())->generate();
$description = 'terangkanlah';

$getAccessToken = new GetAccessToken();

[$accessToken, $timestamp] = $getAccessToken->get(
  $clientId,
  $pKeyId,
  $baseUrl
);

$brivaWs = new BrivaWS();
$brivaOnline = new BrivaOnline();

/**
 * Briva WS - Create VA
 */
// $response = $brivaWs->create(
//   $clientSecret = $clientSecret, 
//   $partnerId = $partnerId, 
//   $baseUrl,
//   $accessToken, 
//   $channelId,
//   $timestamp,
//   $partnerServiceId,
//   $customerNo,
//   $virtualAccountName,
//   $total,
//   $expiredDate,
//   $trxId,
//   $description // optional
// );

/**
 * Briva WS - Update VA
 */
// $response = $brivaWs->update(
//   $clientSecret = $clientSecret, 
//   $partnerId = $partnerId, 
//   $baseUrl,
//   $accessToken, 
//   $channelId,
//   $timestamp,
//   $partnerServiceId,
//   $customerNo = '9196308416',
//   $virtualAccountName,
//   $total,
//   $expiredDate,
//   $trxId = 'g5VTtU',
//   $description // optional
// );

/**
 * Briva WS - Update Status VA
 */
// $response = $brivaWs->updateStatus(
//   $clientSecret = $clientSecret, 
//   $partnerId = $partnerId, 
//   $baseUrl,
//   $accessToken, 
//   $channelId,
//   $timestamp,
//   $partnerServiceId,
//   $customerNo = '4498466302',
//   $trxId = 'lvirQR',
//   $statusPaid = 'Y'
// );

/**
 * Briva WS - Inquiry VA
 */
// $response = $brivaWs->inquiry(
//   $clientSecret = $clientSecret, 
//   $partnerId = $partnerId, 
//   $baseUrl,
//   $accessToken, 
//   $channelId,
//   $timestamp,
//   $partnerServiceId,
//   $customerNo = '4498466302',
//   $trxId = 'lvirQR',
// );

/**
 * Briva WS - Delete VA
 */
// $response = $brivaWs->delete(
//   $clientSecret = $clientSecret, 
//   $partnerId = $partnerId, 
//   $baseUrl,
//   $accessToken, 
//   $channelId,
//   $timestamp,
//   $partnerServiceId,
//   $customerNo = '4498466302',
//   $trxId = 'lvirQR',
// );

/**
 * Briva WS - Get Report VA
 */
// $response = $brivaWs->getReport(
//   $clientSecret = $clientSecret, 
//   $partnerId = $partnerId, 
//   $baseUrl,
//   $accessToken, 
//   $channelId,
//   $timestamp,
//   $partnerServiceId,
//   $startDate = (new GenerateDate())->generate($modify = '+1 days', $format = 'Y-m-d'),//'2024-01-19',
//   $startTIme = (new GenerateDate())->generate($modify = null, $format = 'H:i:sP', 0, 0),
//   $endTime = (new GenerateDate())->generate($modify = null, $format = 'H:i:sP', 23, 59),
// );

/**
 * Briva WS - Inquiry Status VA
 */
// $response = $brivaWs->inquiryStatus(
//   $clientSecret = $clientSecret, 
//   $partnerId = $partnerId, 
//   $baseUrl,
//   $accessToken, 
//   $channelId,
//   $timestamp,
//   $partnerServiceId,
//   $customerNo,
//   $inquiryRequestId = (new GenerateRandomString())->generate(5),
// );

/**
 * BRIVA Online - Inquiry
 */
// $response = $brivaOnline->inquiry(
//   $clientSecret,
//   $partnerId,
//   $baseUrl,
//   $accessToken,
//   $channelId = '00008',
//   $timestamp,
//   $partnerServiceId,
//   $customerNo,
//   $inquiryRequestId = 'e3bcb9a2-e253-40c6-aa77-d72cc138b744',
//   $value = '100000.00',
//   $currency = 'IDR',
//   $trxDateInit = (new GenerateDate())->generate($modify = null, $format = 'H:i:sP', 0, 0),
//   $channelCode = 8,
//   $sourceBankCode = '0002',
//   $passApp = 'b7aee423dc7489dfa868426e5c950c677925',
//   $idApp = 'test'
// );

/**
 * BRIVA Online - Payment
 */
// $response = $brivaOnline->payment(
//   $clientSecret,
//   $partnerId,
//   $baseUrl,
//   $accessToken,
//   $channelId = '00008',
//   $timestamp,
//   $partnerServiceId,
//   $customerNo,
//   $inquiryRequestId = 'e3bcb9a2-e253-40c6-aa77-d72cc138b744',
//   $value = '100000.00',
//   $currency = 'IDR',
//   $trxDateInit = (new GenerateDate())->generate($modify = null, $format = 'H:i:sP', 0, 0),
//   $channelCode = 8,
//   $sourceBankCode = '0002',
//   $passApp = 'b7aee423dc7489dfa868426e5c950c677925',
//   $idApp = 'test'
// );

// echo $response;
