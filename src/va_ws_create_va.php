<?php

require 'utils.php';

use BRI\Util\GenerateDate;
use BRI\Util\GenerateRandomString;
use BRI\Util\VarNumber;

// url path values
$baseUrl = 'https://sandbox.partner.api.bri.co.id'; //base url

try {
  list($clientId, $clientSecret, $privateKey) = getCredentials();

  list($accessToken, $timestamp) = getAccessToken(
    $clientId,
    $privateKey,
    $baseUrl
  );

  // change variables accordingly
  $partnerId = ''; //partner id
  $channelId = ''; // channel id

  $partnerServiceId = ''; // partner service id
  $customerNo = (new VarNumber())->generateVar(10); // customer no
  $virtualAccountName = ''; // virtual account name
  $total = '10000.00'; // total
  $expiredDate = (new GenerateDate())->generate('+1 days');
  $trxId = (new GenerateRandomString())->generate();
  $description = '';

  $validateInputs = sanitizeInput([
    'partnerId' => $partnerId,
    'channelId' => $channelId,
    'partnerServiceId' => $partnerServiceId,
    'customerNo' => $customerNo,
    'virtualAccountName' => $virtualAccountName,
    'total' => $total,
    'expiredDate' => $expiredDate,
    'trxId' => $trxId,
    'description' => $description
  ]);

  file_put_contents('customerNo.txt', $customerNo);
  file_put_contents('expiredDate.txt', $expiredDate);
  file_put_contents('trxId.txt', $trxId);

  $response = fetchVAWSCreate(
    $clientSecret,
    $validateInputs['partnerId'],
    $baseUrl,
    $accessToken,
    $validateInputs['channelId'],
    $timestamp,
    $validateInputs['partnerServiceId'],
    $validateInputs['customerNo'],
    $validateInputs['virtualAccountName'],
    $validateInputs['total'],
    $validateInputs['expiredDate'],
    $validateInputs['trxId'],
    $validateInputs['description']
  );

  echo $response;
} catch (Exception $e) {
  error_log('Error: ' . $e->getMessage());
  exit(1);
}
