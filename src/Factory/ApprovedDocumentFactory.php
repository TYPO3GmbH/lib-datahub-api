<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use DateTime;
use T3G\DatahubApiLibrary\Entity\ApprovedDocument;

/**
 * @extends AbstractFactory<ApprovedDocument>
 */
class ApprovedDocumentFactory extends AbstractFactory
{
    public static function fromArray(array $data): ApprovedDocument
    {
        $approvedDocument = (new ApprovedDocument())
            ->setDocumentIdentifier($data['documentIdentifier'])
            ->setDocumentVersion($data['documentVersion'])
            ->setApproveDate(new DateTime($data['approveDate']));
        if (!empty($data['user'])) {
            $approvedDocument
                ->setUser(UserFactory::fromArray($data['user']));
        }
        return $approvedDocument;
    }
}
