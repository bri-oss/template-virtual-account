# Template-informasi-rekening-php

This is a simple template for Virtual Account SNAP BI using PHP.

module:
- [Virtual Account - Briva Online](https://developers.bri.co.id/en/snap-bi/apidocs-virtual-account-briva-online-snap-bi)
- [Virtual Account - Briva WS](https://developers.bri.co.id/en/snap-bi/apidocs-virtual-account-briva-ws-snap-bi)

## List of Content
- [Instalasi](#instalasi)
  - [Prerequisites](#prerequisites)
  - [How to Setup Project](#how-to-setup-project)
  - [Briva Online Inquiry](#briva-online-inquiry)
  - [Briva Online Payment](#briva-online-payment)
  - [Briva WS Create VA](#briva-ws-create-va)
  - [Briva WS Update VA](#briva-ws-update-va)
  - [Briva WS Update Status VA](#briva-ws-update-status-va)
  - [Briva WS Inquiry VA](#briva-ws-inquiry-va)
  - [Briva WS Delete VA](#briva-ws-delete-va)
  - [Briva WS Get Report](#briva-ws-get-report)
  - [Briva WS Inquiry Status VA](#briva-ws-inquiry-status-va)
- [Caution](#caution)
- [Disclaimer](#disclaimer)

## Instalasi

### Prerequisites
- php
- composer

### How to Setup Project

```bash
1. copy .env file by typing 'cp .env.example .env' in the terminal
2. fill the .env file with the required values
3. run composer install to install all dependencies
4. run command `php src/interbank_transfer_inquiry.php serve`
```

### Briva Online Inquiry
```bash
1. fill partnerId and channelId
2. fill partnerServiceId example '   55888'
3. fill customerNo by default this template give you utils that can generate customerNo
4. fill inquiryRequestId example 'e3bcb9a2-e253-40c6-aa77-d72cc138b744'
5. fill value example 100000.00
6. fill currency by default is IDR
7. fill trxDateInit by default this template give you utils that can generate it example 2021-11-25T15:01:07+07:00
8. fill sourceBankCode example 0002
9. fill passApp example 'b7aee423dc7489dfa868426e5c950c677925'
10. fill idApp example 'test'
11. run command `php src/va_online_inquiry.php serve`
```

### Briva Online Payment
```bash
1. fill partnerId and channelId
2. fill partnerServiceId example '   55888'
3. fill customerNo by default this template give you utils that can generate customerNo 
4. fill inquiryRequestId example 'e3bcb9a2-e253-40c6-aa77-d72cc138b744'
5. fill value example 100000.00
6. fill currency by default is IDR
7. fill trxDateInit by default this template give you utils that can generate it example 2021-11-25T15:01:07+07:00
8. fill sourceBankCode example 0002
9. fill passApp example 'b7aee423dc7489dfa868426e5c950c677925'
10. fill idApp example 'test'
11. run command `php src/va_online_payment.php serve`
```

### Briva WS Create VA
```bash
1. fill partnerId and channelId
2. fill partnerServiceId example '   55888'
3. fill customerNo by default this template give you utils that can generate customerNo 
4. fill virtualAccountName example John Doe
5. fill total example 10000.00
6. fill expiredDate by default this template give you utils that can generate example 2022-02-28T22:38:25+07:00
7. fill trxId is Transaction ID in Partner system example abcdefgh1234
8. fill description example 'terangkanlah'
9. run command `php src/va_ws_create_va.php serve`
```

### Briva WS Update VA
```bash
1. fill partnerId and channelId
2. fill partnerServiceId example '   55888'
3. fill customerNo by default this template give you utils that can generate customerNo example '9196308416'
4. fill virtualAccountName example John Doe
fill total example 10000.00
6. fill expiredDate by default this template give you utils that can generate example 2022-02-28T22:38:25+07:00
7. fill trxId is Transaction ID in Partner system example abcdefgh1234
8. fill description example 'terangkanlah'
9. run command `php src/va_ws_update_va.php serve`
```

### Briva WS Update Status VA
```bash
1. fill partnerId and channelId
2. fill partnerServiceId example '   55888'
3. fill customerNo by default this template give you utils that can generate customerNo example '4498466302'
4. fill virtualAccountName example John Doe
fill total example 10000.00
6. fill expiredDate by default this template give you utils that can generate example 2022-02-28T22:38:25+07:00
7. fill trxId is Transaction ID in Partner system example lvirQR
8. fill statusPaid with Y or N
9. run command `php src/va_ws_update_status_va.php serve`
```

### Briva WS Inquiry VA
```bash
1. fill partnerId and channelId
2. fill partnerServiceId example '   55888'
3. fill customerNo by default this template give you utils that can generate customerNo example '4498466302'
4. fill trxId is Transaction ID in Partner system example lvirQR
5. run command `php src/va_ws_inquiry_va.php serve`
```

### Briva WS Get Report
```bash
1. fill partnerId and channelId
2. fill partnerServiceId example '   55888'
3. fill startDate by default this template give you utils that can generate startDate example 2024-06-21
4. fill startTime example 00:00:00+07:00
5. fill endTime example 22:00:00+07:00
6. run command `php src/va_ws_get_report_va.php serve`
```

### Briva WS Delete VA
```bash
1. fill partnerId and channelId
2. fill partnerServiceId example '   55888'
3. fill customerNo by default this template give you utils that can generate customerNo example '4498466302'
4. fill total example 10000.00
5. fill trxId is Transaction ID in Partner system example lvirQR
6. run command `php src/va_ws_delete_va.php serve`
```

### Briva WS Inquiry Status VA
```bash
1. fill partnerId and channelId
2. fill partnerServiceId example '   12819'
3. fill customerNo by default this template give you utils that can generate customerNo example 801234567899
4. fill inquiryRequestId example '065ad3ca-2490-4432-8a29-0a9a7ce4904b'
6. run command `php src/va_ws_get_inquiry_status.php serve`
```

## Caution

Please delete the .env file before pushing to github or bitbucket

## Disclaimer

Please note that this project is just a template on the use of BRI-API php sdk and may have bugs or errors.
