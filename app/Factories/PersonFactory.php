<?php

namespace App\Factories;

use App\Models\Person;

/**
 * Class PersonFactory
 * @package App\Factories
 */
abstract class PersonFactory implements FactoryInterface
{
    /**
     * @return Person
     */
    public static function build(): Person
    {
      return new Person();
    }
}