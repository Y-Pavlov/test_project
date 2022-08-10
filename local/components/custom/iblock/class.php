<?php

use Bitrix\Main\Engine\Contract\Controllerable;

class Iblock extends CBitrixComponent implements Controllerable
{

    /**
     * @return array[][]
     */
    public function configureActions(): array
    {
        return [
            'sendMessage' => [
                'prefilters' => [],
            ],
        ];
    }

    /**
     * Возвращает результат выполнения вызываемой функции клиенту
     *
     * @param  array  $params
     * @return array|string
     */
    public function addElementAction(array $params): array|string
    {
        return \LogInOff\TestProject\classes\App\Iblock::addIblockElement($params);
    }

    public function executeComponent()
    {
        $this->includeComponentTemplate($this->arResult);
    }
}
