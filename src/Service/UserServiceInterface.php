<?php
/**
 * @author Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace App\DataSource;


use App\Entity\User;

interface DataSourceInterface
{
    /**
     * @param int|null $limit
     * @param int $offset
     * @return User[]
     */
    public function getUsers(int $limit = null, int $offset = 0): array;

    /**
     * @param int $id
     * @return User
     */
    public function getUser(int $id): User;

}