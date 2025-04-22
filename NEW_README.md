# Template Virtual Account PHP

Template PHP untuk mengintegrasikan layanan **Virtual Account SNAP BI (BRIVA)**.

### Modul yang Didukung:

- [Virtual Account – BRIVA Online](https://developers.bri.co.id/en/snap-bi/apidocs-virtual-account-briva-online-snap-bi)
- [Virtual Account – BRIVA Web Service (WS)](https://developers.bri.co.id/en/snap-bi/apidocs-virtual-account-briva-ws-snap-bi)

---

## 📁 Daftar Isi

- [Instalasi](#instalasi)
  - [Prasyarat](#prasyarat)
  - [Setup Project](#setup-project)
- [Contoh Penggunaan](#contoh-penggunaan)
  - [BRIVA Online Inquiry](#briva-online-inquiry)
  - [BRIVA Online Payment](#briva-online-payment)
  - [BRIVA WS – Create VA](#briva-ws--create-va)
  - [BRIVA WS – Update VA](#briva-ws--update-va)
  - [BRIVA WS – Update Status VA](#briva-ws--update-status-va)
  - [BRIVA WS – Inquiry VA](#briva-ws--inquiry-va)
  - [BRIVA WS – Delete VA](#briva-ws--delete-va)
  - [BRIVA WS – Get Report](#briva-ws--get-report)
  - [BRIVA WS – Inquiry Status VA](#briva-ws--inquiry-status-va)
- [Cara Mendapatkan Credential](#cara-mendapatkan-credential)
  - [Consumer Key & Secret](#consumer-key--secret)
  - [Setup Private Key](#setup-private-key)
- [.env Example](#env-example)
- [Peringatan](#peringatan)
- [Disclaimer](#disclaimer)

---

## 🚀 Instalasi

### Prasyarat

- PHP (disarankan v7.4 ke atas)
- Composer

### Setup Project

```bash
cd template-virtual-account
cp .env.example .env
# Edit file .env dan isi kredensial yang dibutuhkan
composer install
```

---

## 📌 Contoh Penggunaan

### BRIVA Online Inquiry
Endpoint ini digunakan untuk melakukan inquiry VA ke rekanan BRI

**Variable wajib**
```php
$partnerId = 'YOWoKgXf5KcATtetyq7NbfxOz6FR65Un';
$passApp = '123456';
```

**Jalankan Program**
```bash
php src/va_online_inquiry.php serve
```

**Debug**
1. **Unexpected error: Invalid input parameter for partnerId, You Should:**
   - **Do**: Cek variable partnerId, harus diisi
   ```php
    $partnerId = 'YOWoKgXf5KcATtetyq7NbfxOz6FR65Un';
   ```

2. **Unexpected error: Invalid input parameter for passApp, You Should:**
   - **Do**: Cek variable passApp, harus diisi
   ```php
    $passApp = '123456';
   ```

3. **Invalid argument: Invalid passApp. If provided, it must be at least 6 characters, You Should:**
   - **Do**: Cek variable passApp, minimal 6 karakter
   ```php
    $passApp = '123456';
   ```

---
### BRIVA Online Payment
Endpoint ini digunakan untuk menandai pembayaran VA ke mitra BRI

**Variable wajib**
```php
$partnerId = 'YOWoKgXf5KcATtetyq7NbfxOz6FR65Un';
$passApp = '123456';
```

**Jalankan Program**
```bash
php src/va_online_payment.php serve
```

**Debug**
1. **Unexpected error: Invalid input parameter for partnerId, You Should:**
   - **Do**: Cek variable partnerId, harus diisi
   ```php
    $partnerId = 'YOWoKgXf5KcATtetyq7NbfxOz6FR65Un';
   ```

2. **Unexpected error: Invalid input parameter for passApp, You Should:**
   - **Do**: Cek variable passApp, harus diisi
   ```php
    $passApp = '123456';
   ```

3. **Invalid argument: Invalid passApp. If provided, it must be at least 6 characters, You Should:**
   - **Do**: Cek variable passApp, minimal 6 karakter
   ```php
    $passApp = '123456';
   ```

---

### BRIVA WS – Create VA
Endpoint ini digunakan untuk membuat virtual account BRI baru

**Variable wajib**
```php
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$partnerServiceId = '   55888'; // partner service id
$customerNo = (new VarNumber())->generateVar(10); // customer no
$virtualAccountName = 'John Doe'; // virtual account name
$total = '10000.00'; // total
$expiredDate = (new GenerateDate())->generate('+1 days'); // generate from function
$trxId = (new GenerateRandomString())->generate(); // generate from function
$description = 'test';
```

**Jalankan Program**
```bash
php src/va_ws_create_va.php serve
```

**Debug**
1. **Runtime exception: Failed to fetch access token: Invalid response: {"responseCode": "4017300","responseMessage": "Unauthorized. stringToSign"}, You Should:**
   - **Do**: Cek file .env, pastikan CONSUMER_KEY, CONSUMER_SECRET, dan PRIVATE_KEY benar
   - **Do**: Hapus accessToken.txt dan timestamp.txt
   ```bash
    rm .\accessToken.txt
    rm .\timestamp.txt
   ```

2. **Unexpected error: Invalid input parameter for partnerId, You Should:**
   - **Do**: Cek variable partnerId, harus diisi
   ```php
    $partnerId = 'feedloop';
   ```

3. **Unexpected error: Invalid input parameter for channelId, You Should:**
   - **Do**: Cek variable channelId, harus diisi
   ```php
    $channelId = '12345';
   ```

4. **Unexpected error: Invalid input parameter for partnerServiceId, You Should:**
   - **Do**: Cek variable partnerServiceId, harus diisi
   ```php
    $partnerServiceId = '   55888';
   ```

5. **Unexpected error: Invalid input parameter for customerNo, You Should:**
   - **Do**: Cek variable customerNo, harus diisi
   ```php
    $customerNo = (new VarNumber())->generateVar(10);
   ```

5. **Unexpected error: Invalid input parameter for virtualAccountName, You Should:**
   - **Do**: Cek variable virtualAccountName, harus diisi
   ```php
    $virtualAccountName = 'John Doe';
   ```

6. **Unexpected error: Invalid input parameter for total, You Should:**
   - **Do**: Cek variable total, harus diisi
   ```php
    $total = '10000.00';
   ```

7. **Unexpected error: Invalid input parameter for expiredDate, You Should:**
   - **Do**: Cek variable expiredDate, harus diisi
   ```php
    $expiredDate = (new GenerateDate())->generate('+1 days');
   ```

8. **Unexpected error: Invalid input parameter for trxId, You Should:**
   - **Do**: Cek variable trxId, harus diisi
   ```php
    $trxId = (new GenerateRandomString())->generate();
   ```

9. **Unexpected error: Invalid input parameter for description, You Should:**
   - **Do**: Cek variable description, harus diisi
   ```php
    $description = 'test';
   ```

---

### BRIVA WS – Update VA
Endpoint ini digunakan untuk mengupdate detail akun BRIVA yang sudah ada

*Note: Harus bikin VA dulu dari module va_ws_create_va.php

**Variable wajib**
```php
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$partnerServiceId = '   55888'; // partner service id
$customerNo = trim(file_get_contents('customerNo.txt')); //(new VarNumber())->generateVar(10); // customer no
$virtualAccountName = 'John Doe'; // virtual account name
$total = 10000; // total
$expiredDate = trim(file_get_contents('expiredDate.txt')); //(new GenerateDate())->generate('+1 days');
$trxId = trim(file_get_contents('trxId.txt')); //(new GenerateRandomString())->generate();
$description = 'test';
```

**Jalankan Program**
```bash
php src/va_ws_update_va.php serve
```

**Debug**
1. **Runtime exception: Failed to fetch access token: Invalid response: {"responseCode": "4017300","responseMessage": "Unauthorized. stringToSign"}, You Should:**
   - **Do**: Cek file .env, pastikan CONSUMER_KEY, CONSUMER_SECRET, dan PRIVATE_KEY benar
   - **Do**: Hapus accessToken.txt dan timestamp.txt
   ```bash
    rm .\accessToken.txt
    rm .\timestamp.txt
   ```

2. **Unexpected error: Invalid input parameter for partnerId, You Should:**
   - **Do**: Cek variable partnerId, harus diisi
   ```php
    $partnerId = 'feedloop';
   ```

3. **Unexpected error: Invalid input parameter for channelId, You Should:**
   - **Do**: Cek variable channelId, harus diisi
   ```php
    $channelId = '12345';
   ```

4. **Unexpected error: Invalid input parameter for customerNo, You Should:**
   - **Do**: pastikan ada file customerNo.txt, atau jalankan lagi module va_ws_create_va.php
   ```php
    $customerNo = trim(file_get_contents('customerNo.txt'));
   ```

5. **Unexpected error: Invalid input parameter for virtualAccountName, You Should:**
   - **Do**: cek variable virtualAccountName, harus diisi
   ```php
    $virtualAccountName = 'John Doe';
   ```

6. **Unexpected error: Invalid input parameter for total, You Should:**
   - **Do**: cek variable total, harus diisi
   ```php
    $total = 10000;
   ```

7. **Unexpected error: Invalid input parameter for expiredDate , You Should:**
   - **Do**: pastikan ada file expiredDate.txt, atau jalankan lagi module va_ws_create_va.php
   ```php
     $expiredDate = trim(file_get_contents('expiredDate.txt'));
   ```

8. **Unexpected error: Invalid input parameter for trxId , You Should:**
   - **Do**: pastikan ada file trxId.txt, atau jalankan lagi module va_ws_create_va.php
   ```php
     $trxId = trim(file_get_contents('trxId.txt'));
   ```

9. **Unexpected error: Invalid input parameter for description, You Should:**
   - **Do**: cek variable description, harus diisi
   ```php
    $description = 'test';
   ```

---

### BRIVA WS – Update Status VA
Endpoint ini digunakan untuk mengelola status pembayaran rekening BRIVA yang ada

*Note: Harus bikin VA dulu dari module va_ws_create_va.php

**Variable wajib**
```php
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$partnerServiceId = '   55888'; // partner service id
$customerNo = trim(file_get_contents('customerNo.txt')); //(new VarNumber())->generateVar(10); // customer no
$trxId = trim(file_get_contents('trxId.txt')); //(new GenerateRandomString())->generate();
$statusPaid = 'N'; // Y or N
```

**Jalankan Program**
```bash
php src/va_ws_update_status_va.php serve
```

**Debug**
1. **Runtime exception: Failed to fetch access token: Invalid response: {"responseCode": "4017300","responseMessage": "Unauthorized. stringToSign"}, You Should:**
   - **Do**: Cek file .env, pastikan CONSUMER_KEY, CONSUMER_SECRET, dan PRIVATE_KEY benar
   - **Do**: Hapus accessToken.txt dan timestamp.txt
   ```bash
    rm .\accessToken.txt
    rm .\timestamp.txt
   ```

2. **Unexpected error: Invalid input parameter for partnerId, You Should:**
   - **Do**: Cek variable partnerId, harus diisi
   ```php
    $partnerId = 'feedloop';
   ```

3. **Unexpected error: Invalid input parameter for channelId, You Should:**
   - **Do**: Cek variable channelId, harus diisi
   ```php
    $channelId = '12345';
   ```

4. **Unexpected error: Invalid input parameter for partnerServiceId, You Should:**
   - **Do**: Cek variable partnerServiceId, harus diisi
   ```php
    $partnerServiceId = '   55888'; // partner service id
   ```

5. **Unexpected error: Invalid input parameter for customerNo, You Should:**
   - **Do**: pastikan ada file customerNo.txt, atau jalankan lagi module va_ws_create_va.php
   ```php
    $customerNo = trim(file_get_contents('customerNo.txt'));
   ```

6. **Unexpected error: Invalid input parameter for trxId, You Should:**
   - **Do**: pastikan ada file trxId.txt, atau jalankan lagi module va_ws_create_va.php
   ```php
    $trxId = trim(file_get_contents('trxId.txt'));
   ```

7. **Unexpected error: Invalid input parameter for statusPaid, You Should:**
   - **Do**: pastikan variable statusPaid harus berisi Y atau N
   ```php
     $statusPaid = 'N'; // Y or N
   ```

---

### BRIVA WS – Inquiry VA
Endpoint ini digunakan untuk mendapatkan informasi virtual account yang telah dibuat

*Note: Harus bikin VA dulu dari module va_ws_create_va.php

**Variable wajib**
```php
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$partnerServiceId = '   55888'; // partner service id
$customerNo = trim(file_get_contents('customerNo.txt'));//(new VarNumber())->generateVar(10); // customer no
$trxId = trim(file_get_contents('trxId.txt')); //(new GenerateRandomString())->generate();
```

**Jalankan Program**
```bash
php src/va_ws_inquiry_va.php serve
```

**Debug**
1. **Runtime exception: Failed to fetch access token: Invalid response: {"responseCode": "4017300","responseMessage": "Unauthorized. stringToSign"}, You Should:**
   - **Do**: Cek file .env, pastikan CONSUMER_KEY, CONSUMER_SECRET, dan PRIVATE_KEY benar
   - **Do**: Hapus accessToken.txt dan timestamp.txt
   ```bash
    rm .\accessToken.txt
    rm .\timestamp.txt
   ```

2. **Unexpected error: Invalid input parameter for partnerId, You Should:**
   - **Do**: Cek variable partnerId, harus diisi
   ```php
    $partnerId = 'feedloop';
   ```

3. **Unexpected error: Invalid input parameter for channelId, You Should:**
   - **Do**: Cek variable channelId, harus diisi
   ```php
    $channelId = '12345';
   ```

4. **Unexpected error: Invalid input parameter for partnerServiceId, You Should:**
   - **Do**: Cek variable partnerServiceId, harus diisi
   ```php
    $partnerServiceId = '   55888'; // partner service id
   ```

5. **Unexpected error: Invalid input parameter for customerNo, You Should:**
   - **Do**: pastikan ada file customerNo.txt, atau jalankan lagi module va_ws_create_va.php
   ```php
    $customerNo = trim(file_get_contents('customerNo.txt'));
   ```

6. **Unexpected error: Invalid input parameter for trxId, You Should:**
   - **Do**: pastikan ada file trxId.txt, atau jalankan lagi module va_ws_create_va.php
   ```php
    $trxId = trim(file_get_contents('trxId.txt'));
   ```

---

### BRIVA WS – Delete VA
Endpoint ini digunakan untuk menghapus data BRIVA yang ada

*Note: Harus bikin VA dulu dari module va_ws_create_va.php

**Variable wajib**
```php
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$partnerServiceId = '   55888'; // partner service id
$customerNo = trim(file_get_contents('customerNo.txt')); //(new VarNumber())->generateVar(10); // customer no
$trxId = trim(file_get_contents('trxId.txt')); //(new GenerateRandomString())->generate();
```

**Jalankan Program**
```bash
php src/va_ws_delete_va.php serve
```

**Debug**
1. **Runtime exception: Failed to fetch access token: Invalid response: {"responseCode": "4017300","responseMessage": "Unauthorized. stringToSign"}, You Should:**
   - **Do**: Cek file .env, pastikan CONSUMER_KEY, CONSUMER_SECRET, dan PRIVATE_KEY benar
   - **Do**: Hapus accessToken.txt dan timestamp.txt
   ```bash
    rm .\accessToken.txt
    rm .\timestamp.txt
   ```

2. **Unexpected error: Invalid input parameter for partnerId, You Should:**
   - **Do**: Cek variable partnerId, harus diisi
   ```php
    $partnerId = 'feedloop';
   ```

3. **Unexpected error: Invalid input parameter for channelId, You Should:**
   - **Do**: Cek variable channelId, harus diisi
   ```php
    $channelId = '12345';
   ```

4. **Unexpected error: Invalid input parameter for partnerServiceId, You Should:**
   - **Do**: Cek variable partnerServiceId, harus diisi
   ```php
    $partnerServiceId = '   55888'; // partner service id
   ```

5. **Unexpected error: Invalid input parameter for customerNo, You Should:**
   - **Do**: pastikan ada file customerNo.txt, atau jalankan lagi module va_ws_create_va.php
   ```php
    $customerNo = trim(file_get_contents('customerNo.txt'));
   ```

6. **Unexpected error: Invalid input parameter for trxId, You Should:**
   - **Do**: pastikan ada file trxId.txt, atau jalankan lagi module va_ws_create_va.php
   ```php
    $trxId = trim(file_get_contents('trxId.txt'));
   ```

---

### BRIVA WS – Get Report

```bash
php src/va_ws_get_report_va.php serve
```

> **Field wajib**: `startDate`, `startTime`, `endTime`

---

### BRIVA WS – Inquiry Status VA
Endpoint ini digunakan untuk mendapatkan history transaksi semua rekening BRIVA yang terdaftar di nomor BRIVA pengguna

**Variable wajib**
```php
$partnerId = 'feedloop'; //partner id
$channelId = '12345'; // channel id

$partnerServiceId = '   12819'; // partner service id
$customerNo = '801234567899';//(new VarNumber())->generateVar(10); // customer no
$inquiryRequestId = '065ad3ca-2490-4432-8a29-0a9a7ce4904b';
```

**Jalankan Program**
```bash
php src/va_ws_get_inquiry_status.php serve
```

**Debug**
1. **Runtime exception: Failed to fetch access token: Invalid response: {"responseCode": "4017300","responseMessage": "Unauthorized. stringToSign"}, You Should:**
   - **Do**: Cek file .env, pastikan CONSUMER_KEY, CONSUMER_SECRET, dan PRIVATE_KEY benar
   - **Do**: Hapus accessToken.txt dan timestamp.txt
   ```bash
    rm .\accessToken.txt
    rm .\timestamp.txt
   ```

2. **Unexpected error: Invalid input parameter for partnerId, You Should:**
   - **Do**: Cek variable partnerId, harus diisi
   ```php
    $partnerId = 'feedloop';
   ```

3. **Unexpected error: Invalid input parameter for channelId, You Should:**
   - **Do**: Cek variable channelId, harus diisi
   ```php
    $channelId = '12345';
   ```

4. **Unexpected error: Invalid input parameter for partnerServiceId, You Should:**
   - **Do**: Cek variable partnerServiceId, harus diisi
   ```php
    $partnerServiceId = '   12819';
   ```

5. **Unexpected error: Invalid input parameter for customerNo, You Should:**
   - **Do**: Cek variable customerNo, harus diisi
   ```php
    $customerNo = '801234567899'
   ```

6. **Unexpected error: Invalid input parameter for inquiryRequestId, You Should:**
   - **Do**: Cek variable inquiryRequestId, harus diisi
   ```php
    $inquiryRequestId = '065ad3ca-2490-4432-8a29-0a9a7ce4904b';
   ```

---

## 🔐 Cara Mendapatkan Credential

### Consumer Key & Secret

1. Kunjungi [https://developers.bri.co.id/en](https://developers.bri.co.id/en)
2. Login dan buka halaman **My Apps**
3. Pilih aplikasi yang sudah terdaftar
4. Salin **Consumer Key** dan **Consumer Secret**

### Setup Private Key

1. Masuk ke halaman **My Apps > Manage Snap Key > Add Snap Key**
2. Buat key pair RSA menggunakan [https://cryptotools.net/rsagen](https://cryptotools.net/rsagen)
3. Salin **public key** ke kolom Snap Key di halaman tersebut
4. Simpan **private key** di lokal dan masukkan ke `.env`

---

## 🧪 .env Example

```env
CONSUMER_KEY=your_consumer_key_here
CONSUMER_SECRET=your_consumer_secret_here
PRIVATE_KEY="-----BEGIN RSA PRIVATE KEY-----
... your key ...
-----END RSA PRIVATE KEY-----"
```

---

## ⚠️ Peringatan

Jangan pernah commit file `.env` ke repositori publik (GitHub, Bitbucket, dsb.) untuk menjaga keamanan data kredensial Anda.

---

## 📝 Disclaimer

Template ini dibuat untuk mempermudah developer menggunakan SDK PHP dari BRI-API. Tidak menjamin bebas dari bug/kesalahan dan penggunaannya sepenuhnya tanggung jawab Anda.
