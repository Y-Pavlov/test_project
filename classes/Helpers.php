<?php

namespace LogInOff\TestProject\classes;

use CUtil;

class Helpers
{
    /**
     * Возвращает транслитерированную строку
     *
     * @param  string  $sValue
     * @return string
     */
    public static function makeTransliteration(string $sValue): string
    {
        $arParams = [
            'replace_space' => '-',
            'replace_other' => ''
        ];

        return CUtil::translit($sValue, 'ru', $arParams);
    }
}
