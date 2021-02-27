<?php

namespace Services;

use App\Services\V1\UserService;

/**
 * Class UserServiceTest
 * @package Services
 */
class UserServiceTest extends \TestCase
{
    public function testCreateUser()
    {
        $data = [
            "id" => "85647556027",
            "name" => "Flaviane Castro",
            "birth_date" => "1999-06-21",
            "email" => "flavianecastro@gmail.com",
            "password" => "1234"
        ];

        UserService::save($data);

        $this->assertIsArray($data);
    }
}