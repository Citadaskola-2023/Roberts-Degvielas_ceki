<?php

namespace App\Models\FuelReceipt\Rules;

use App\Core\Validation\Exceptions\ValidationException;
use App\Core\Validation\Rule;

readonly class IsNotDuplicate extends Rule
{

    public function __construct(
        private array $params
    )
    {
    }

    public function check(mixed $value): true
    {
        $sql[] = <<<MySQL
            SELECT id FROM fuel_receipts 
            WHERE `license_plate` = :license_plate
            AND `gmt` = :date_time
            AND `fuel_type` = :fuel_type
            AND `refueled` = :refueled
            LIMIT 1;
            MySQL;

        $params = [];
        foreach ($this->params as $param) {
            $params[$param] = match($param) {
                'date_time' => \App\Core\Helper\Time::toUTCStr($this->getParamValue($param), 'Europe/Riga', \App\Core\Helper\Time::HTML),
                default => $this->getParamValue($param),
            };
        }


        $result = \App\Core\DB::execute(implode("\n", $sql), $params);

        if ($result->rowCount() > 0) {
            throw new ValidationException('This fuel receipt is already been saved');
        }

        return true;
    }

}
