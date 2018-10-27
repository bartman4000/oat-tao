<?php
/**
 * @author Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace App\Service;


use App\Entity\User;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class FileUserServiceAbstract implements UserServiceInterface
{
    /**
     * return path to file with data
     * @return string
     */
    abstract function getPath(): string;

    /**
     * appropriate format of file source
     * i.r. 'csv', 'json', 'xml' etc
     * @return string
     */
    abstract function getFormat(): string;

    /**
     * get Encoder for Serializer
     * @return EncoderInterface
     */
    abstract function getSerializerEncoder(): EncoderInterface;

    /**
     * @param int $id
     * @return User
     */
    public function getUser(int $id): User
    {
        $users = $this->getUsersData();
        $users = array_filter($users, function(User $user) use ($id) {
            return $user->getId() === $id;
        });

        return array_shift($users);
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
        $users = array_slice($users, $offset, $limit);

        if(!empty($filters)) {

            foreach ($filters as $property => $value) {
                $users = array_values(array_filter($users, function (User $user) use ($property,$value) {
                    $propertyGetter = 'get'.ucfirst(strtolower($property));
                    return $user->{$propertyGetter}() === $value;
                }));
            }
        }

        return $users;
    }

    /**
     * @return User[]
     */
    protected function getUsersData(): array
    {
        $encoders = array($this->getSerializerEncoder());
        $normalizers = array(
            new ObjectNormalizer(),
            new ArrayDenormalizer()
        );

        $serializer = new Serializer($normalizers, $encoders);
        $data = $this->getSourceContent();
        /** @var array $users */
        $users = $serializer->deserialize($data, 'App\Entity\User[]', $this->getFormat());
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
        array_walk($users, function(User $user) use (&$i) {
            $user->setId($i);
            $i++;
        });
    }
}