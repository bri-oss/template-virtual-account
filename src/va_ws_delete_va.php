<?php

require 'utils.php';

header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
header("Content-Security-Policy: default-src 'self'; script-src 'self';");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("Referrer-Policy: no-referrer");

// url path values
$baseUrl = 'https://sandbox.partner.api.bri.co.id'; //base url

try {
  list($clientId, $clientSecret, $privateKey) = getCredentials();

  list($accessToken, $timestamp) = getAccessToken(
    $clientId,
    $privateKey,
    $baseUrl
  );

  // Validate required files
  $requiredFiles = ['customerNo.txt', 'expiredDate.txt', 'trxId.txt'];
  foreach ($requiredFiles as $file) {
    if (!file_exists($file)) {
      throw new Exception("Required file $file is missing.");
    }
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

  // Cleanup files
  foreach ($requiredFiles as $file) {
    if (file_exists($file)) {
      unlink($file);
    }
  }
  echo $response;
} catch (InvalidArgumentException $e) {
  error_log("Invalid argument: " . $e->getMessage());
} catch (RuntimeException $e) {
  error_log("Runtime exception: " . $e->getMessage());
} catch (Exception $e) {
  error_log("Unexpected error: " . $e->getMessage());
  exit(1);
}
