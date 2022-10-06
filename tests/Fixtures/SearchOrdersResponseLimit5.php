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
        "totalRecordCount": 5
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
        }
    ]
}
JSON;

return new Response(200, ['content-type' => 'application/json'], $json);
