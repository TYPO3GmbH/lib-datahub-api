<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Assembler;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Assembler\ValidateEltsCredentialsAssembler;

class ValidateEltsCredentialsAssemblerTest extends TestCase
{
    public function testCanAssembleDtoWithRawData(): void
    {
        $data = [
            'username' => 'john-doe',
            'token' => '098f6bcd4621d373cade4e832627b4f6',
        ];

        $assembler = new ValidateEltsCredentialsAssembler();
        $dto = $assembler->create($data)->getDto();

        self::assertSame($data['username'], $dto->username);
        self::assertSame($data['token'], $dto->token);
    }
}
