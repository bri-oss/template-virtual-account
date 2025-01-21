<?php

require 'utils.php';

// url path values
$baseUrl = 'https://sandbox.partner.api.bri.co.id'; //base url

try {
  list($clientId, $clientSecret, $privateKey) = getCredentials();

  list($accessToken, $timestamp) = getAccessToken(
    $clientId,
    $privateKey,
    $baseUrl
  );

  if (!file_exists('customerNo.txt') || !file_exists('expiredDate.txt') || !file_exists('trxId.txt')) {
    throw new Exception("Please create VA first", 1);
  }

  // change variables accordingly
  $partnerId = ''; //partner id
  $channelId = ''; // channel id

  $partnerServiceId = ''; // partner service id
  $customerNo = trim(file_get_contents('customerNo.txt')); //(new VarNumber())->generateVar(10); // customer no
  $trxId = trim(file_get_contents('trxId.txt')); //(new GenerateRandomString())->generate();

  $validateInputs = sanitizeInput([
    'partnerId' => $partnerId,
    'channelId' => $channelId,
    'partnerServiceId' => $partnerServiceId,
    'customerNo' => $customerNo,
    'trxId' => $trxId
  ]);

  $response = fetchVAWSDelete(
    $clientSecret,
    $validateInputs['partnerId'],
    $baseUrl,
    $accessToken,
    $validateInputs['channelId'],
    $timestamp,
    $validateInputs['partnerServiceId'],
    $validateInputs['customerNo'],
    $validateInputs['trxId']
  );

  unlink('customerNo.txt');
  unlink('expiredDate.txt');
  unlink('trxId.txt');

  echo $response;
} catch (Exception $e) {
  error_log('Error: ' . $e->getMessage());
  exit(1);
}
