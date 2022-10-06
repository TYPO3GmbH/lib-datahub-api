<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use GuzzleHttp\Psr7\Response;

$json = <<<JSON
{
    "meta": {
        "totalRecordCount": 20
    },
    "links": {
        "first": "\/order\/search\/?page[limit]=10",
        "prev": null,
        "next": "\/order\/search\/?page[limit]=10&page[offset]=10"
    },
    "data": [
        {
            "uuid": "00000000-0000-0000-0000-000000000000",
            "orderNumber": "G12345",
            "payload": {
                "items": [
                    {
                        "title": "T-Shirt",
                        "quantity": 1
                    }
                ]
            },
            "createdAt": "2020-01-10T00:00:00+00:00",
            "invoices": []
        },
        {
            "uuid": "11111111-1111-1111-1111-111111111111",
            "orderNumber": "G08154711",
            "payload": {
                "items": [
                    {
                        "title": "T-Shirt",
                        "quantity": 1
                    }
                ]
            },
            "createdAt": "2020-01-10T00:00:00+00:00",
            "invoices": []
        },
        {
            "uuid": "0c230cf1-d7ea-359b-b3db-9bf01c2c7b0d",
            "orderNumber": "G90855207",
            "payload": {
                "items": [
                    {
                        "title": "TYPO3 Certified Editor - Exam Access Voucher",
                        "quantity": 2
                    }
                ]
            },
            "createdAt": "2020-05-12T05:55:59+00:00",
            "invoices": []
        },
        {
            "uuid": "aa6d069e-4282-377e-a5c0-0b7a61ef9bbc",
            "orderNumber": "G45237607",
            "payload": {
                "items": [
                    {
                        "title": "TYPO3 Pens",
                        "quantity": 1
                    }
                ]
            },
            "createdAt": "2020-10-01T15:57:15+00:00",
            "invoices": []
        },
        {
            "uuid": "015959ff-8d6e-36b0-95ce-db5aa06eb779",
            "orderNumber": "G79310082",
            "payload": {
                "items": [
                    {
                        "title": "TYPO3 Certified Editor - Exam Access Voucher",
                        "quantity": 2
                    }
                ]
            },
            "createdAt": "2020-10-11T09:26:39+00:00",
            "invoices": []
        },
        {
            "uuid": "38b424a5-9d09-3cdc-8625-835890e835dd",
            "orderNumber": "G30018355",
            "payload": {
                "items": [
                    {
                        "title": "TYPO3 Certified Editor - Exam Access Voucher",
                        "quantity": 3
                    }
                ]
            },
            "createdAt": "2021-04-29T03:34:51+00:00",
            "invoices": []
        },
        {
            "uuid": "df6df9c3-48bd-3e68-9ad3-a4576167f87d",
            "orderNumber": "G61628458",
            "payload": {
                "items": [
                    {
                        "title": "TYPO3 Certified Editor - Exam Access Voucher",
                        "quantity": 1
                    }
                ]
            },
            "createdAt": "2021-05-16T19:59:41+00:00",
            "invoices": []
        },
        {
            "uuid": "05a8d188-6907-38a7-999f-e471ef207839",
            "orderNumber": "G40875744",
            "payload": {
                "items": [
                    {
                        "title": "TYPO3 Certified Editor - Exam Access Voucher",
                        "quantity": 3
                    }
                ]
            },
            "createdAt": "2021-05-18T03:27:27+00:00",
            "invoices": []
        },
        {
            "uuid": "38debc14-1780-3b0a-992f-a4917facf9bc",
            "orderNumber": "G46063158",
            "payload": {
                "items": [
                    {
                        "title": "Corona-Maske",
                        "quantity": 3
                    }
                ]
            },
            "createdAt": "2021-08-17T02:46:33+00:00",
            "invoices": []
        },
        {
            "uuid": "c55ab54b-6176-37df-9646-e4d4d3db490a",
            "orderNumber": "G77927820",
            "payload": {
                "items": [
                    {
                        "title": "TYPO3 Pens",
                        "quantity": 1
                    }
                ]
            },
            "createdAt": "2021-09-17T14:55:55+00:00",
            "invoices": []
        }
    ]
}
JSON;

return new Response(200, ['content-type' => 'application/json'], $json);
