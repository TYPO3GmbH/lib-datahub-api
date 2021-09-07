<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Service;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Service\SecurityService;

class SecurityServiceTest extends TestCase
{
    public function sensitiveDataDataProvider(): array
    {
        return [
            'first level password' => [
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'password' => 'foo',
                ],
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'password' => '**********',
                ]
            ],
            'first level token' => [
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'token' => 'foo',
                ],
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'token' => '**********',
                ]
            ],
            'second level password' => [
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'foo' => ['password' => 'foo'],
                ],
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'foo' => ['password' => '**********'],
                ]
            ],
            'second level token' => [
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'foo' => ['token' => 'foo'],
                ],
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'foo' => ['token' => '**********'],
                ]
            ],
            'second level password has array value' => [
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'password' => ['foo' => 'foo'],
                ],
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'password' => ['foo' => 'foo'],
                ]
            ],
            'second level token has array value' => [
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'token' => ['foo' => 'foo'],
                ],
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'token' => ['foo' => 'foo'],
                ]
            ],
            'third level password' => [
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'foo' => [
                        'bar' => ['password' => 'foo']
                    ],
                ],
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'foo' => [
                        'bar' => ['password' => '**********']
                    ],
                ]
            ],
            'third level token' => [
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'foo' => [
                        'bar' => ['token' => 'foo']
                    ],
                ],
                [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'foo' => [
                        'bar' => ['token' => '**********']
                    ],
                ]
            ],
        ];
    }

    /**
     * @dataProvider sensitiveDataDataProvider
     * @param array $input
     * @param array $expectedOutput
     */
    public function testAnonymizeSensitiveData(array $input, array $expectedOutput): void
    {
        $this->assertSame($expectedOutput, SecurityService::anonymizeSensitiveData($input));
    }
}
