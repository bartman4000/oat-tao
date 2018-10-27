<?php
/**
 * @author Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace App\Tests\unit\Service;


use App\Entity\User;
use App\Service\FileUserServiceAbstract;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class FileUserServiceAbstractTest extends TestCase
{
    /**
     * @var FileUserServiceAbstract
     */
    private $fileUserService;

    public function setUp() {
        $this->fileUserService = $this->getMockBuilder(FileUserServiceAbstract::class)
            ->setMethods(array('getPath','getFormat', 'getSerializerEncoder', 'getSourceContent'))
            ->getMock();

        $this->fileUserService->method('getFormat')->willReturn('json');
        $this->fileUserService->method('getSerializerEncoder')->willReturn(new JsonEncoder());
        $this->fileUserService->method('getPath')->willReturn("whatever");

        $this->fileUserService->method('getSourceContent')->willReturn(
            '[
  {
    "login":"fosterabigail",
    "password":"P7ghvUQJNr6myOEP",
    "title":"mrs",
    "lastname":"foster",
    "firstname":"abigail",
    "gender":"female",
    "email":"abigail.foster60@example.com",
    "picture":"https://api.randomuser.me/0.2/portraits/women/10.jpg",
    "address":"1851 saddle dr anna 69319"
  },
  {
    "login":"grahamallison",
    "password":"LT9FaWRD7J7gS9Dw",
    "title":"ms",
    "lastname":"graham",
    "firstname":"allison",
    "gender":"female",
    "email":"allison.graham70@example.com",
    "picture":"https://api.randomuser.me/0.2/portraits/women/35.jpg",
    "address":"6697 rolling green rd colorado springs 56306"
  },
  {
    "login":"clarksusan",
    "password":"ejWpJUUDQQ8BKpZm",
    "title":"miss",
    "lastname":"clark",
    "firstname":"susan",
    "gender":"female",
    "email":"susan.clark11@example.com",
    "picture":"https://api.randomuser.me/0.2/portraits/women/33.jpg",
    "address":"3627 groveland terrace ennis 70832"
  }]'
        );
    }

    public function testGetUser()
    {
        $user = $this->fileUserService->getUser(2);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('allison', $user->getFirstname());
    }

    public function testGetUsers()
    {
        $users = $this->fileUserService->getUsers();
        $this->assertCount(3, $users);
        $this->assertInstanceOf(User::class, $users[0]);
        $this->assertEquals('abigail', $users[0]->getFirstname());
        $this->assertEquals('susan', $users[2]->getFirstname());
    }

    public function testGetUsersLimitAndOffset()
    {
        $users = $this->fileUserService->getUsers(1,2);
        $this->assertCount(2, $users);
        $this->assertInstanceOf(User::class, $users[0]);
        $this->assertInstanceOf(User::class, $users[1]);
        $this->assertEquals('allison', $users[0]->getFirstname());
        $this->assertEquals('susan', $users[1]->getFirstname());
    }
}