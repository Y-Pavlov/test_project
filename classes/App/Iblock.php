<?php

namespace LogInOff\TestProject\classes\App;

use CIBlockElement;
use LogInOff\TestProject\classes\Helpers;

class Iblock
{
    /**
     * Добавляет элементы в инфоблок
     *
     * @param  array  $arParams
     * @return string|array
     */
    public static function addIblockElement(array $arParams): string|array
    {
        if ($arParams['apikey'] !== 'RUN2021') {
            return [
                'ERROR' => 'Введите правильный ключ запуска скрипта'
            ];
        }

        $iCounter = 1;
        $arElements = [];

        $iOffset = $arParams['OFFSET'];

        if ($arParams['COUNT'] % $arParams['STEP'] !== 0 && ($arParams['COUNT'] - $iOffset) < $arParams['STEP']) {
            $iCounter = $arParams['STEP'] - ($arParams['COUNT'] - $iOffset);
        }

        $oElement = new CIBlockElement();

        if (isset($arParams['STEP']) && isset($arParams['COUNT'])) {
            while ($iCounter <= $arParams['STEP']) {
                $sName = 'Тест материал #'.$iOffset;
                $sCode = Helpers::makeTransliteration($sName);

                $aData = [
                    'IBLOCK_ID' => $arParams['IBLOCK'],
                    'NAME' => $sName,
                    'CODE' => $sCode,
                    'PROPERTY_VALUES' => [
                        'CITY' => [
                            'Город #'.$iOffset,
                            'Страна #'.$iOffset,
                            'Регион #'.$iOffset,
                        ]
                    ]
                ];

                if ($iProductId = $oElement->Add($aData)) {
                    $arElements[] = $iProductId;
                    $iOffset++;
                    $iCounter++;
                } else {
                    return [
                        'ERROR' => $oElement->LAST_ERROR
                    ];
                }
            }
        } else {
            return [
                'ERROR' => 'Проверьте правильность ввода параметров STEP/COUNT'
            ];
        }

        return [
            'ELEMENTS' => $arElements,
            'OFFSET' => $iOffset,
        ];
    }
}
