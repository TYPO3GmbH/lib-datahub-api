<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\Employee;

/**
 * @extends AbstractFactory<Employee>
 */
class EmployeeFactory extends AbstractFactory
{
    public static function fromArray(array $data): Employee
    {
        $employee = (new Employee())
            ->setRole($data['role'])
            ->setJoinedAt(new \DateTime($data['joinedAt']))
            ->setLeftAt(null !== $data['leftAt'] ? new \DateTime($data['leftAt']) : null)
            ->setUuid($data['uuid']);
        if (isset($data['company'])) {
            $employee->setCompany(CompanyFactory::fromArray($data['company']));
        }
        if (isset($data['user'])) {
            $employee->setUser(UserFactory::fromArray($data['user']));
        }

        return $employee;
    }
}
