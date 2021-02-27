<?php

namespace App\Factories;

use App\Models\User;

/**
 * Class UserFactory
 * @package App\Factories
 */
abstract class UserFactory implements FactoryInterface
{
    /**
     * @return User
     */
    public static function build(): User
    {
        return new User();
    }
}