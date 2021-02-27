<?php

namespace App\Validate;

use Bissolli\ValidadorCpfCnpj\Documento;

/**
 * Class Validate
 * @package App\Validate
 */
abstract class Validate
{
    /**
     * Não importa se já vem formatado ou não
     *
     * @param string $value
     * @return Documento
     */
    public static function cpfCnpj(string $value): Documento
    {
        return new Documento($value);
    }
}