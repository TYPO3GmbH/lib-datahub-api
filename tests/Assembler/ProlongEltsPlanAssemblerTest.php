<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Assembler;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Assembler\ProlongEltsPlanAssembler;

class ProlongEltsPlanAssemblerTest extends TestCase
{
    public function testCanAssembleDtoWithRawData(): void
    {
        $data = [
            'sourcePlan' => '54b85dd2-5599-4506-adcd-8d8babfcd3aa',
            'runtime' => '3-3',
            'orderNumber' => 'G12345-<3',
        ];

        $assembler = new ProlongEltsPlanAssembler();
        $dto = $assembler->create($data)->getDto();

        self::assertSame($data['sourcePlan'], $dto->sourcePlan);
        self::assertSame($data['runtime'], $dto->runtime);
        self::assertSame($data['orderNumber'], $dto->orderNumber);
    }
}
