<?php
/**
 * @author Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace App\Service;

use App\Entity\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

abstract class FileUserServiceAbstract implements UserServiceInterface
{
    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * FileUserServiceAbstract constructor.
     * @param Serializer $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * return path to file with data
     * @return string
     */
    abstract public function getPath(): string;

    /**
     * appropriate format of file source
     * i.r. 'csv', 'json', 'xml' etc
     * @return string
     */
    abstract public function getFormat(): string;

    /**
     * @param int $id
     * @return User
     */
    public function getUser(int $id): User
    {
        $users = $this->getUsersData();
        $users = array_filter($users, function (User $user) use ($id) {
            return $user->getId() === $id;
        });

        $user = array_shift($users);

        if (empty($user)) {
            throw new NotFoundHttpException("No user with {$id} identifier");
        }

        return $user;
    }

    /**
     * @param int $offset
     * @param int|null $limit
     * @param array $filters
     * @return User[]
     */
    public function getUsers(int $offset = 0, ?int $limit = null, array $filters = []): array
    {
        $users = $this->getUsersData();
        if (!empty($filters)) {
            foreach ($filters as $property => $value) {
                $users = array_values(array_filter($users, function (User $user) use ($property,$value) {
                    $propertyGetter = 'get'.ucfirst(strtolower($property));
                    return method_exists($user, $propertyGetter) ? $user->{$propertyGetter}() === $value : true;
                }));
            }
        }
        $users = array_slice($users, $offset, $limit);

        return $users;
    }

    /**
     * @return User[]
     */
    protected function getUsersData(): array
    {
        $data = $this->getSourceContent();
        /** @var array $users */
        $users = $this->serializer->deserialize($data, 'App\Entity\User[]', $this->getFormat());
        $this->setIds($users);
        return $users;
    }

    /**
     * @return string
     */
    protected function getSourceContent(): string
    {
        return $data = file_get_contents($this->getPath());
    }

    /**
     * @param array $users
     */
    protected function setIds(array &$users): void
    {
        $i=1;
        array_walk($users, function (User $user) use (&$i) {
            $user->setId($i);
            $i++;
        });
    }
}
