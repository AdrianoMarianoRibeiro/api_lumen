<?php

namespace App\Factories;

use App\Models\PhysicalPerson;

/**
 * Class PhysicalPersonFactory
 * @package App\Factories
 */
abstract class PhysicalPersonFactory implements FactoryInterface
{
    /**
     * @return PhysicalPerson
     */
    public static function build(): PhysicalPerson
    {
      return new PhysicalPerson();
    }
}