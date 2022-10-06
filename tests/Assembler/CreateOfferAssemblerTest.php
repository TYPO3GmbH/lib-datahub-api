<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Assembler;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Assembler\CreateOfferAssembler;

class CreateOfferAssemblerTest extends TestCase
{
    public function testCanAssembleDtoWithRawData(): void
    {
        $data = [
            'payload' => ['foo' => 'bar'],
            'offerNumber' => 'TO-1234',
            'cartIdentifier' => '7fa5c64d-518b-418f-94c8-0b68f533ff79',
        ];

        $assembler = new CreateOfferAssembler();
        $dto = $assembler->create($data)->getDto();

        self::assertSame($data['payload'], $dto->payload);
        self::assertSame($data['offerNumber'], $dto->offerNumber);
        self::assertSame($data['cartIdentifier'], $dto->cartIdentifier);
    }
}
