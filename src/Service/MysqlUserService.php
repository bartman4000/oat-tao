<?php
/**
 * @author Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace App\Service;

use App\Entity\User;
use PDO;

class MysqlUserService implements UserServiceInterface
{
    const TABLE = 'users';

    protected $PDO;

    /**
     * MysqlUserService constructor.
     */
    public function __construct(PDO $PDO)
    {
        $this->PDO = $PDO;
    }

    /**
     * @param int $offset
     * @param int|null $limit
     * @param array $filters
     * @return array
     */
    public function getUsers(int $offset = 0, ?int $limit = null, array $filters = []): array
    {
        // TODO: Implement getUsers() method.
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUser(int $id): User
    {
        // TODO: Implement getUser() method.
    }
}
