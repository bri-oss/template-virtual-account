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

  // change variables accordingly
  $partnerId = ''; //partner id
  $channelId = ''; // channel id

  $partnerServiceId = ''; // partner service id
  $startDate = '';//(new GenerateDate())->generate('+1 days', 'Y-m-d'); //'2024-06-21';
  $startTime = ''; // format H:i:sP
  $endTime = ''; // format H:i:sP

  $validateInputs = sanitizeInput([
    'partnerId' => $partnerId,
    'channelId' => $channelId,
    'partnerServiceId' => $partnerServiceId,
    'startDate' => $startDate,
    'startTime' => $startTime,
    'endTime' => $endTime
  ]);

  $response = fetchVAWSGetReportVa(
    $clientSecret, 
    $validateInputs['partnerId'], 
    $baseUrl,
    $accessToken,
    $validateInputs['channelId'],
    $timestamp,
    $validateInputs['partnerServiceId'],
    $validateInputs['startDate'],
    $validateInputs['startTime'],
    $validateInputs['endTime']
  );

  echo $response;
} catch (Exception $e) {
  error_log('Error: ' . $e->getMessage());
  exit(1);
}
