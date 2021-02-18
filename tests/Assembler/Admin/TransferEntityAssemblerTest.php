<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Assembler\Admin;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Assembler\Admin\TransferEntityAssembler;

class TransferEntityAssemblerTest extends TestCase
{
    public function testCanAssembleDtoWithRawData(): void
    {
        $data = [
            'source' => '180c9e1a-efe7-4c50-a0bc-1f483fbf1b86',
            'target' => '3de030dc-f044-44d6-aef7-dd8b216c41b0',
            'type' => 'elts',
            'entityDescriber' => 'all'
        ];

        $assembler = new TransferEntityAssembler();
        $dto = $assembler->create($data)->getDto();

        static::assertSame($data['source'], $dto->source);
        static::assertSame($data['target'], $dto->target);
        static::assertSame($data['type'], $dto->type);
        static::assertSame($data['entityDescriber'], $dto->entityDescriber);
    }

    public function testCanAssembleDtoWithOrganizationHelperMethods(): void
    {
        $data = [
            'type' => 'elts',
            'entityDescriber' => 'all'
        ];

        $assembler = new TransferEntityAssembler();
        $dto = $assembler
            ->create($data)
            ->setSourceOrganization('f12edb4c-fc02-494e-ac39-74f7ec5bbaaa')
            ->setTargetOrganization('f9243a32-6229-4e88-951f-4cb3f61cc4d8')
            ->getDto();

        static::assertSame('organization:f12edb4c-fc02-494e-ac39-74f7ec5bbaaa', $dto->source);
        static::assertSame('organization:f9243a32-6229-4e88-951f-4cb3f61cc4d8', $dto->target);
        static::assertSame($data['type'], $dto->type);
        static::assertSame($data['entityDescriber'], $dto->entityDescriber);
    }

    public function testCanAssembleDtoWithUserHelperMethods(): void
    {
        $data = [
            'type' => 'elts',
            'entityDescriber' => 'all'
        ];

        $assembler = new TransferEntityAssembler();
        $dto = $assembler
            ->create($data)
            ->setSourceUser('foobar')
            ->setTargetUser('barbaz')
            ->getDto();

        static::assertSame('user:foobar', $dto->source);
        static::assertSame('user:barbaz', $dto->target);
        static::assertSame($data['type'], $dto->type);
        static::assertSame($data['entityDescriber'], $dto->entityDescriber);
    }
}
