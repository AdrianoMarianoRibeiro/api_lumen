<?php

namespace App\Factories;

use App\Models\LegalPerson;

/**
 * Class LegalPersonFactory
 * @package App\Factories
 */
abstract class LegalPersonFactory implements FactoryInterface
{
    /**
     * @return LegalPerson
     */
    public static function build(): LegalPerson
    {
        return new LegalPerson();
    }
}