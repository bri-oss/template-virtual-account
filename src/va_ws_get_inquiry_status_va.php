<?php

use BRI\Util\GenerateRandomString;
use BRI\Util\VarNumber;

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

  // change variables accordingly
  $partnerId = 'feedloop'; //partner id
  $channelId = '12345'; // channel id

  $partnerServiceId = 'akllsklas'; // partner service id
  $customerNo = (new VarNumber())->generateVar(10); // customer no
  $inquiryRequestId = (new GenerateRandomString())->generate(5);

  $validateInputs = sanitizeInput([
    'partnerId' => $partnerId,
    'channelId' => $channelId,
    'partnerServiceId' => $partnerServiceId,
    'customerNo' => (string) $customerNo,
    'inquiryRequestId' => $inquiryRequestId
  ]);

  $response = fetchVAWSGetInquiryStatusVa(
    $clientSecret, 
    $validateInputs['partnerId'], 
    $baseUrl,
    $accessToken, 
    $validateInputs['channelId'],
    $timestamp,
    $validateInputs['partnerServiceId'],
    (int) $validateInputs['customerNo'],
    $validateInputs['inquiryRequestId']
  );

  echo $response;
} catch (Exception $e) {
  error_log('Error: ' . $e->getMessage());
  exit(1);
}
