<?php

require 'utils.php';

// url path values
$baseUrl = 'https://api.bridex.qore.page/mock'; //base url

try {
  list($clientId, $clientSecret, $privateKey) = getCredentials();

  $accessToken = getMockAccessToken(
    $clientId,
    $baseUrl,
    $privateKey
  );

  $partnerId = 'YOWoKgXf5KcATtetyq7NbfxOz6FR65Un';

  $validateInputs = sanitizeInput([
    'partnerId' => $partnerId
  ]);

  $response = fetchVAOnlineInquiry(
    $validateInputs['partnerId'],
    $clientId,
    $clientSecret,
    $baseUrl,
    $accessToken,
  );

  echo $response;
} catch (Exception $e) {
  error_log('Error: ' . $e->getMessage());
  exit(1);
}
