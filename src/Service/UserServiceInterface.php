<?php
/**
 * @author Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace App\Service;


use App\Entity\User;

interface UserServiceInterface
{

    /**
     * @param int $offset
     * @param int|null $limit
     * @param array $filters
     * @return array
     */
    public function getUsers(int $offset = 0, ?int $limit = null, array $filters = []): array;

    /**
     * @param int $id
     * @return User
     */
    public function getUser(int $id): User;

}