<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Assembler;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Assembler\UpdatePaymentStatusAssembler;
use T3G\DatahubApiLibrary\Enum\PaymentStatus;

class UpdatePaymentStatusAssemblerTest extends TestCase
{
    public function testCanAssembleDtoWithRawData(): void
    {
        $data = [
            'orderNumber' => 'TO-1234',
            'paymentStatus' => PaymentStatus::PAID,
        ];

        $assembler = new UpdatePaymentStatusAssembler();
        $dto = $assembler->create($data)->getDto();

        self::assertSame($data['orderNumber'], $dto->orderNumber);
        self::assertSame($data['paymentStatus'], $dto->paymentStatus);
    }
}
