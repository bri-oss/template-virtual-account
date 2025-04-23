# PHP Virtual Account Template

A comprehensive PHP template for integrating with Bank Rakyat Indonesia (BRI) Virtual Account services through SNAP BI.

## Supported Modules
- [Virtual Account - BRIVA Online](https://developers.bri.co.id/en/snap-bi/apidocs-virtual-account-briva-online-snap-bi)
- [Virtual Account - BRIVA Web Service (WS)](https://developers.bri.co.id/en/snap-bi/apidocs-virtual-account-briva-ws-snap-bi)

## Table of Contents
- [General Issue](#general-issue)
- [Credentials Setup](#credentials-setup)
  - [Consumer Key & Secret](#consumer-key--secret)
  - [Private Key Setup](#private-key-setup)
- [Installation](#installation)
  - [Prerequisites](#prerequisites)
  - [Project Setup](#project-setup)
- [Usage Guide](#usage-guide)
  - [BRIVA Online Inquiry](#briva-online-inquiry)
  - [BRIVA Online Payment](#briva-online-payment)
  - [BRIVA WS - Create VA](#briva-ws---create-va)
  - [BRIVA WS - Update VA](#briva-ws---update-va)
  - [BRIVA WS - Update Status VA](#briva-ws---update-status-va)
  - [BRIVA WS - Inquiry VA](#briva-ws---inquiry-va)
  - [BRIVA WS - Delete VA](#briva-ws---delete-va)
  - [BRIVA WS - Get Report](#briva-ws---get-report)
  - [BRIVA WS - Inquiry Status VA](#briva-ws---inquiry-status-va)
- [Environment Configuration](#environment-configuration)
- [Security Considerations](#security-considerations)
- [Disclaimer](#disclaimer)

## General Issue
**Unauthorized. Signature**
1. Check the .env file, make sure CONSUMER_KEY, CONSUMER_SECRET, and PRIVATE_KEY are correct.
2. Delete accessToken.txt and timestamp.txt.

## Credentials Setup

### Consumer Key & Secret

1. Visit [BRI Developer Portal](https://developers.bri.co.id/en)
2. Log in and navigate to "My Apps"
3. Select your registered application
4. Copy the "Consumer Key" and "Consumer Secret"

### Private Key Setup

1. Visit [BRI Developer Portal](https://developers.bri.co.id/en) and log in
2. Navigate to "My Apps" > "Manage Snap Key" > "Add Snap Key"
3. Generate an RSA key pair using [Crypto Tools](https://cryptotools.net/rsagen)
4. Copy the public key into the "Snap Key" field and save
5. Save the private key securely and add it to your `.env` file

## Environment Configuration

Create a `.env` file with the following structure:

```
CONSUMER_KEY=your_consumer_key_here
CONSUMER_SECRET=your_consumer_secret_here
PRIVATE_KEY="-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQCOkAAcgCOTpZPgmxQKovWho6G3GJmxet6kYqi1wj5jTFuB8lLe
...your full private key here...
-----END RSA PRIVATE KEY-----"
```

## Installation

### Prerequisites
- PHP 7.4 or higher
- Composer package manager

### Project Setup

```bash
# Navigate to project directory
cd template-virtual-account

# Create environment file
cp .env.example .env

# Fill the .env file with required credentials
# See Environment Configuration section

# Install dependencies
composer install
```

## Usage Guide

### BRIVA Online Inquiry

Implements the BRIVA Online Inquiry service to check virtual account details.

**Description:** Allows you to verify virtual account information before payment.

**How to use:**
1. Edit the variables in `src/va_online_inquiry.php`
2. Run the script with `php src/va_online_inquiry.php serve`

**Required Variables:**
```php
// Partner and authentication details
$partnerId = 'YOWoKgXf5KcATtetyq7NbfxOz6FR65Un'; // Your unique partner ID from BRI
$passApp = '123456'; // Security passphrase

// The base URL is already set to development mode in the script
// $baseUrl = 'https://api.briapidevstudio.dev.bbri.io/mock';
```

**Example Response:**
```json
{
  "responseCode": "2002400",
  "responseMessage": "Successful",
  "virtualAccountData": {
    "partnerServiceId": "   77777",
    "customerNo": "0000000000001",
    "virtualAccountNo": "          777770000000000001",
    "virtualAccountName": "John Doe",
    "inquiryRequestId": "e3bcb9a2-e253-40c6-aa77-d72cc138b744",
    "totalAmount": {
      "value": "200000.00",
      "currency": "IDR"
    },
    "inquiryStatus": "00",
    "inquiryReason": {
      "english": "Success",
      "indonesia": "Sukses"
    }
  },
  "additionalInfo": {
    "idApp": "TEST1234"
  }
}
```

**Debugging:**
If you encounter issues with the Online Inquiry:

```php
// For empty or unexpected responses
try {
  $response = fetchVAOnlineInquiry(
    $validateInputs['partnerId'],
    $clientId,
    $clientSecret,
    $baseUrl,
    $accessToken,
    $validateInputs['passApp']
  );
  
  // Debug the response
  error_log("API Response: " . $response);
  
  // Check if response is empty
  if (empty($response)) {
    error_log("Empty response received");
  }
} catch (Exception $e) {
  error_log("Error: " . $e->getMessage());
  
  // Additional debugging for connection issues
  error_log("Request details: partnerId=" . $partnerId . ", baseUrl=" . $baseUrl);
}
```

### BRIVA Online Payment

Implements the BRIVA Online Payment service to process virtual account payments.

**Description:** Allows you to process payments for an existing virtual account.

**How to use:**
1. Edit the variables in `src/va_online_payment.php`
2. Run the script with `php src/va_online_payment.php serve`

**Required Variables:**
```php
// Same variables as BRIVA Online Inquiry
$partnerId = 'YOWoKgXf5KcATtetyq7NbfxOz6FR65Un'; // Your unique partner ID from BRI
$passApp = '123456'; // Security passphrase
```

**Example Response:**
```json
{
  "responseCode": "2002500",
  "responseMessage": "Successful",
  "virtualAccountData": {
    "partnerServiceId": "   77777",
    "customerNo": "0000000000001",
    "virtualAccountNo": "          777770000000000001",
    "virtualAccountName": "John Doe",
    "paymentRequestId": "e3bcb9a2-e253-40c6-aa77-d72cc138b744",
    "totalAmount": {
      "value": "200000.2",
      "currency": "IDR"
    },
    "paymentFlagStatus": "00",
    "paymentFlagReason": {
      "english": "Success",
      "indonesia": "Sukses"
    }
  },
  "additionalInfo": {
    "idApp": "TEST",
    "passApp": "123456"
  }
}
```

**Debugging:**
Follow the same debugging approach as Online Inquiry.

### BRIVA WS - Create VA

Creates a new virtual account using the BRIVA Web Service.

**Description:** Generates a new virtual account with customizable parameters.

**How to use:**
1. Edit the variables in `src/va_ws_create_va.php`
2. Run the script with `php src/va_ws_create_va.php serve`

**Required Variables:**
```php
// Partner identification
$partnerId = 'feedloop'; // Your partner ID
$channelId = '12345'; // Your channel ID

$partnerServiceId = '   55888'; // Service ID (usually padded with spaces)
$customerNo = (new VarNumber())->generateVar(10); // Auto-generated 10-digit number
$virtualAccountName = 'John Doe'; // Name associated with the VA
$total = '10000.00'; // Amount in IDR
$expiredDate = (new GenerateDate())->generate('+1 days'); // Expires in 1 day
$trxId = (new GenerateRandomString())->generate(); // Auto-generated transaction ID
$description = 'Payment for Invoice #12345'; // Transaction description
```

**Example Response:**
```json
{
  "responseCode": "2002700",
  "responseMessage": "Successful",
  "virtualAccountData": {
    "partnerServiceId": "   55888",
    "customerNo": "8567788863",
    "virtualAccountNo": "   558888567788863",
    "virtualAccountName": "John Doe",
    "trxId": "9ffe26",
    "totalAmount": {
      "value": "10000.00",
      "currency": "IDR"
    },
    "expiredDate": "2025-04-23T13:37:02+07:00",
    "additionalInfo": {
      "description": "test"
    }
  }
}
```

**Debugging:**
For Create VA issues:

```php
// Debug input validation
error_log("Validating inputs: " . json_encode([
  'partnerId' => $partnerId,
  'channelId' => $channelId,
  'partnerServiceId' => $partnerServiceId,
  'customerNo' => $customerNo,
  'virtualAccountName' => $virtualAccountName,
  'total' => $total,
  'expiredDate' => $expiredDate,
]));

try {
  $response = fetchVAWSCreate(/* params */);
  $responseObj = json_decode($response, true);
  
  // Check for error codes in response
  if (isset($responseObj['responseCode']) && $responseObj['responseCode'] !== '00') {
    error_log("API Error: " . $responseObj['responseMessage']);
  }
} catch (Exception $e) {
  error_log("Exception: " . $e->getMessage());
}
```

### BRIVA WS - Update VA

Updates an existing virtual account using the BRIVA Web Service.

**Description:** Modifies details of an existing virtual account.

**How to use:**
1. Edit the variables in `src/va_ws_update_va.php`
2. Run the script with `php src/va_ws_update_va.php serve`

**Required Variables:**
```php
// Same variables as Create VA, but customerNo must be an existing VA number
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$partnerServiceId = '   55888'; // partner service id
$customerNo = trim(file_get_contents('customerNo.txt')); //(new VarNumber())->generateVar(10); // customer no
$virtualAccountName = 'John Doe'; // Name associated with the VA
$total = '10000.00'; // Amount in IDR
$expiredDate = trim(file_get_contents('expiredDate.txt')); //(new GenerateDate())->generate('+1 days');
$trxId = trim(file_get_contents('trxId.txt')); //(new GenerateRandomString())->generate();
$description = 'Updated payment for Invoice #12345'; // Updated description
```

**Example Response:**
```json
{
  "responseCode": "2002800",
  "responseMessage": "Successful",
  "virtualAccountData": {
    "partnerServiceId": "   55888",
    "customerNo": "8567788863",
    "virtualAccountNo": "   558888567788863",
    "virtualAccountName": "John Doe",
    "trxId": "9ffe26",
    "totalAmount": {
      "value": "10000",
      "currency": "IDR"
    },
    "expiredDate": "2025-04-23T13:37:02+07:00",
    "additionalInfo": {
      "description": "test"
    }
  }
}
```

**Debugging:**
Follow the same debugging approach as Briva WS Create.

### BRIVA WS - Update Status VA

Updates the payment status of an existing virtual account.

**Description:** Marks a virtual account as paid or unpaid.

**How to use:**
1. Edit the variables in `src/va_ws_update_status_va.php`
2. Run the script with `php src/va_ws_update_status_va.php serve`

**Required Variables:**
```php
// Basic identification variables as in other methods
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$partnerServiceId = '   55888'; // partner service id

// Target VA and status
$customerNo = trim(file_get_contents('customerNo.txt')); //(new VarNumber())->generateVar(10); // customer no
$trxId = trim(file_get_contents('trxId.txt')); // Original transaction ID
$statusPaid = 'Y'; // 'Y' for paid, 'N' for unpaid
```

**Example Response:**
```json
{
  "responseCode": "2002900",
  "responseMessage": "Successful",
  "virtualAccountData": {
    "partnerServiceId": "   55888",
    "customerNo": "8567788863",
    "virtualAccountNo": "   558888567788863",
    "virtualAccountName": "John Doe",
    "trxId": "9ffe26",
    "additionalInfo": {
      "paidStatus": "N"
    }
  }
}
```

**Debugging:**
```php
// Debug the status update
try {
  $response = fetchVAWSUpdateStatusVa(/* params */);
  $responseObj = json_decode($response, true);
  
  if (!isset($responseObj['status']) || $responseObj['status'] !== true) {
    error_log("Status update failed: " . ($responseObj['responseMessage'] ?? 'Unknown error'));
    error_log("Request details: customerNo=" . $customerNo . ", status=" . $paidStatus);
  }
} catch (Exception $e) {
  error_log("Exception during status update: " . $e->getMessage());
}
```

### BRIVA WS - Inquiry VA

Retrieves details of an existing virtual account.

**Description:** Gets the current information and status of a virtual account.

**How to use:**
1. Edit the variables in `src/va_ws_inquiry_va.php`
2. Run the script with `php src/va_ws_inquiry_va.php serve`

**Required Variables:**
```php
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$partnerServiceId = '   55888'; // partner service id
$customerNo = trim(file_get_contents('customerNo.txt'));//(new VarNumber())->generateVar(10); // customer no
$trxId = trim(file_get_contents('trxId.txt')); //(new GenerateRandomString())->generate();
```

**Example Response:**
```json
{
  "responseCode": "2003000",
  "responseMessage": "Successful",
  "virtualAccountData": {
    "partnerServiceId": "   55888",
    "customerNo": "8567788863",
    "virtualAccountNo": "   558888567788863",
    "virtualAccountName": "John Doe",
    "trxId": "9ffe26",
    "totalAmount": {
      "value": "10000",
      "currency": "IDR"
    },
    "expiredDate": "2025-04-23T13:37:02+07:00",
    "additionalInfo": {
      "description": "test"
    }
  }
}
```

**Debugging:**
Follow the same debugging approach as Briva WS Create.

### BRIVA WS - Delete VA

Deletes an existing virtual account.

**Description:** Permanently removes a virtual account from the system.

**How to use:**
1. Edit the variables in `src/va_ws_delete_va.php`
2. Run the script with `php src/va_ws_delete_va.php serve`

**Required Variables:**
```php
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$partnerServiceId = '   55888'; // partner service id
$customerNo = trim(file_get_contents('customerNo.txt')); //(new VarNumber())->generateVar(10); // customer no
$trxId = trim(file_get_contents('trxId.txt')); //(new GenerateRandomString())->generate();
```

**Example Response**
```json
{
  "responseCode": "2003100",
  "responseMessage": "Successful",
  "virtualAccountData": {
    "partnerServiceId": "   55888",
    "customerNo": "8205315565",
    "virtualAccountNo": "   558888205315565",
    "trxId": "6729fa"
  }
}
```

**Debugging:**
Follow the same debugging approach as Briva WS Create.

### BRIVA WS - Get Report

Retrieves transaction reports for a specified time period.

**Description:** Generates a report of transactions within a date/time range.

**How to use:**
1. Edit the variables in `src/va_ws_get_report_va.php`
2. Run the script with `php src/va_ws_get_report_va.php serve`

**Required Variables:**
```php
// Time period for the report
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$partnerServiceId = '   22124'; // partner service id
$startDate = '2025-02-20'; //(new GenerateDate())->generate(null, 'Y-m-d');
$startTime = '00:00:00+07:00'; // format H:i:sP
$endTime = '15:03:00+07:00'; // format H:i:sP
```

### BRIVA WS - Inquiry Status VA

Checks the current status of a virtual account payment.

**Description:** Determines whether a virtual account has been paid.

**How to use:**
1. Edit the variables in `src/va_ws_get_inquiry_status_va.php`
2. Run the script with `php src/va_ws_get_inquiry_status_va.php serve`

**Required Variables:**
```php
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$partnerServiceId = '   12819'; // partner service id
$customerNo = '801234567899';//(new VarNumber())->generateVar(10); // customer no
$inquiryRequestId = '065ad3ca-2490-4432-8a29-0a9a7ce4904b';
```

**Example Response**
```json
{
  "responseCode": "2002600",
  "responseMessage": "Successful",
  "virtualAccountData": {
    "partnerServiceId": "   12819",
    "customerNo": "801234567899",
    "virtualAccountNo": "   12819801234567899",
    "inquiryRequestId": "065ad3ca-2490-4432-8a29-0a9a7ce4904b"
  },
  "additionalInfo": {
    "paidStatus": "N"
  }
}
```

## Security Considerations

- **NEVER** commit your `.env` file to a public repository
- Ensure all inputs are properly validated and sanitized
- Keep your private key confidential
- Use HTTPS for all API communications
- Monitor API responses for unexpected errors
- Implement proper error handling for all API calls

## Disclaimer

This template is provided to help developers integrate with BRI-API PHP SDK. While we strive for accuracy and reliability, it may contain bugs or errors. Usage is at your own risk, and you should thoroughly test the integration before deploying to production.