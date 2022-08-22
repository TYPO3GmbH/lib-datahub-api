<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\Invoice;

/**
 * @extends AbstractFactory<Invoice>
 */
class InvoiceFactory extends AbstractFactory
{
    public static function fromArray(array $data): Invoice
    {
        $invoice = (new Invoice())
            ->setLink($data['link'])
            ->setDate(new \DateTime($data['date']))
            ->setTitle($data['title'] ?? null);

        if (!empty($data['documentType'])) {
            $invoice->setDocumentType($data['documentType']);
        } else {
            $invoice->setDocumentType('invoice');
        }
        if (!empty($data['uuid'])) {
            $invoice->setUuid($data['uuid']);
        }
        if (!empty($data['identifier'])) {
            $invoice->setIdentifier($data['identifier']);
        }
        if (!empty($data['number'])) {
            $invoice->setNumber($data['number']);
        }

        return $invoice;
    }
}
