# ip2geo — PHP SDK

Official PHP SDK for the **Ip2Geo API** — fast IP geolocation, network intelligence, and security risk detection.

---

## 🚀 Get an API Key (Free)

You need an API key to use Ip2Geo.

👉 **Get your free API key here:**  
https://ip2geoapi.com/

### Free plan includes
- ✅ **100,000 requests / month**
- ✅ **No credit card required**
- ✅ Full access to **security intelligence data**
- ✅ Instant activation

---

## 🧠 Why Ip2Geo?

- Most IP data providers:
	- Charge extra for security fields
	- Require credit cards upfront
	- Hide important data behind higher tiers
	- Ip2Geo provides security intelligence by default, even on the free plan.

## ✨ Features

- 🌍 Accurate IP geolocation (country, city, timezone, ISP)
- 🛡️ **Security intelligence included**:
  - VPN detection
  - Proxy detection
  - TOR detection
  - Hosting / ASN classification
  - Trust score & risk level
- ⚡ Fast global API
- 📦 Simple, lightweight PHP SDK
- 🔓 No hidden paid-only fields (others charge extra for security data)

---

## 📦 Installation

```bash
composer require ip2geo/ip2geo-php
```

## Quick Start

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Ip2Geo\Ip2Geo;

$client = new Ip2Geo("API_KEY"); // replace with real key

$data = $client->lookup("8.8.8.8");
print_r($data);

?>

```

### Lookup your IP

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Ip2Geo\Ip2Geo;

$client = new Ip2Geo("API_KEY"); // replace with real key

$data = $client->lookup("check");
print_r($data);

?>

```


## API Response

```json
{
  "success": true,
  "ip": "8.8.8.8",
  "version": "ipv4",
  "geo": {
    "city": "Chicago",
    "country": "United States",
    "countryCode": "US",
    "region": null,
    "regionCode": null,
    "latitude": 37.751,
    "longitude": -97.822,
    "postalCode": null,
    "geonameId": 6252001,
    "accuracyRadius": 1000,
    "metroCode": null,
    "continentName": "North America",
    "continentCode": "NA",
    "isEuMember": false
  },
  "countryInfo": {
    "name": "United States of America",
    "alpha2Code": "US",
    "alpha3Code": "USA",
    "flag": "https://api.ip2geoapi.com/assets/flags/us.svg",
    "callingCodes": [
      "1"
    ],
    "currencies": [
      {
        "code": "USD",
        "name": "United States dollar",
        "symbol": "$"
      }
    ],
    "languages": [
      {
        "iso639_1": "en",
        "iso639_2": "eng",
        "name": "English",
        "nativeName": "English"
      }
    ]
  },
  "timezoneInfo": {
    "timezone": "America/Chicago",
    "utcOffsetSeconds": -21600,
    "utcOffsetText": "-06:00",
    "utcOffsetHours": -6,
    "isDst": false,
    "abbreviation": "CST",
    "localTime": "2025-12-22T21:46:07-06:00"
  },
  "network": {
    "cidr": "8.8.8.8/32",
    "prefixLen": 32,
    "asn": 15169,
    "asFormatted": "AS15169",
    "asName": "GOOGLE",
    "isp": "Google",
    "organization": "Google",
    "connectionType": "Corporate",
    "mobile": {
      "mcc": null,
      "mnc": null
    }
  },
  "asDetails": {
    "asn": 15169,
    "abuser_score": "0.001 (Low)",
    "descr": "GOOGLE, US",
    "country": "us",
    "active": true,
    "org": "Google LLC",
    "domain": "google.com",
    "abuse": "network-abuse@google.com",
    "type": "hosting",
    "created": "2000-03-30",
    "updated": "2012-02-24",
    "rir": "ARIN"
  },
  "security": {
    "isHosting": true,
    "isProxy": false,
    "proxyType": null,
    "isVpn": false,
    "vpnProvider": null,
    "vpnProviderUrl": null,
    "isTor": false,
    "isAnonymous": true,
    "trustScore": 65,
    "riskLevel": "medium"
  }
}
```

## 📄 Response Formats

### JSON (default)

```php
$data = $client->lookup("8.8.8.8");
```

### YAML

```php
$data = $client->lookup("8.8.8.8", [
    "format" => "yml"
]);
```

### XML

```php
$data = $client->lookup("8.8.8.8", [
    "format" => "xml"
]);
```

### JSONP Callbacks

```php
$data = $client->lookup("8.8.8.8", [
    "format" => "jsonp",
    "callback" => "cbFunction"
]);
```

## Parameter Reference

| Parameter  | Type  | Required | Accepted Values                         | Description                                                                  |
| ---------- | ----- | -------- | --------------------------------------- | ---------------------------------------------------------------------------- |
| `ip`       | `str` | Yes*     | IPv4 / IPv6                             | IP address to lookup. If ```check```, your **own IP** is detected automatically. |
| `format`   | `str` | Optional | `json` (default), `xml`, `yml`, `jsonp` | Response format. Defaults to JSON.                                           |
| `callback` | `str` | Optional | Alphanumeric + `_` (max 64 chars)       | JSONP callback function name. **Only valid when `format="jsonp"`**.          |

## 📘 Documentation

Full API documentation and field reference:
[https://ip2geoapi.com/documentation/](https://ip2geoapi.com/documentation/)
