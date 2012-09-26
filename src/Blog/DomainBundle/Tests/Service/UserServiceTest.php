<?php

namespace Blog\DomainBundle\Tests\Service;

use Blog\DomainBundle\Entity\User;
use Blog\DomainBundle\Doctrine\Queries\FindUserByLoginQuery;
use Blog\DomainBundle\Service\UserService;
use Blog\DomainBundle\Tests\BaseTestCase;

class UserServiceTest extends BaseTestCase
{
    /**
     * @var UserService
     */
    private $service;

    protected function setUp()
    {
        $this->service = $this->get('domain.service.user');
    }

    public function testRegisterNewUserShouldBeSuccess()
    {
        $user = $this->service->register('NewUser', 'NewPassword');

        $this->assertInstanceOf('Blog\DomainBundle\Entity\User', $user);
        $this->assertGreaterThan(0, $user->getId());
    }

    public function testRegisterExistsUserShouldBeFailed()
    {
        $this->setExpectedException(
            'Blog\DomainBundle\Exception\UserAlreadyExistsException',
            'User "Tester" already exists'
        );
        $this->service->register('Tester', 'Tester');
    }
}