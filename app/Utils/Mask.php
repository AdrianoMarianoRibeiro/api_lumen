<?php

namespace App\Utils;

/**
 * Class Mask
 * @package App\Utils
 */
abstract class Mask
{
    /**
     * @param string $mask
     * @param string $value
     * @return string
     */
    public static function mask(string $mask, string $value): string
    {
        $value = str_replace(" ", "", $value);

        for ($i = 0; $i < strlen($value); $i++) {
            $mask[strpos($mask, "#")] = $value[$i];
        }

        return $mask;
    }

    /**
     * remove qualquer mascara
     *
     * @param string $value
     * @return string
     */
    public static function remove(string $value): string
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

    /**
     * @param string $value
     * @return float
     */
    public static function money(string $value): float
    {
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        return floatval(preg_replace('/[^\d\.]/', '', $value));
    }

    /**
     * @param float $valor
     * @return string
     * Passa um valor float e retorna valor da moeda brasileira
     * $valor = 3100.85;
     * number_format($valor,2,",",".");
     * saida: 3.100,85
     */
    public static function floatParaDinheiroBr(float $valor) : string
    {
        return number_format($valor,2,",",".");
    }

    /**
     * @param float $value
     * @return string
     */
    public static function moneyPtBR(float $value): string
    {
        $formatter = new \NumberFormatter('pt_BR',  \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($value, 'BRL');
    }

    /**
     * @param string $data
     * @return string|false
     */
    public static function date(string $data): string
    {
        $date = str_replace('/', '-', $data);
        return date("Y-m-d H:i:s", strtotime($date));
    }

    /**
     * @param string $cpf
     * @return string
     */
    public static function hideCPF(string $cpf): string
    {
        $dataNi = str_split($cpf);
        $char = [
            0 => "*",
            1 => "*",
            2 => "*",
            9 => "*",
            10 => "*",
        ];

        $arr = array_replace($dataNi, $char);
        return $arr[0] . $arr[1] . $arr[2] . "." . $arr[3] . $arr[4] . $arr[5] . "." . $arr[6] . $arr[7] . $arr[8] . "-" . $arr[9] . $arr[10];
    }
}