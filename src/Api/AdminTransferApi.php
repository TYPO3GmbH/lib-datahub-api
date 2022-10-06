<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use T3G\DatahubApiLibrary\Dto\Admin\TransferEntityDto;

class AdminTransferApi extends AbstractApi
{
    public function transferRelations(TransferEntityDto $transferEntityDto): void
    {
        $this->client->request(
            'POST',
            self::uri('/admin/transfer'),
            json_encode($transferEntityDto, JSON_THROW_ON_ERROR)
        );
    }
}
