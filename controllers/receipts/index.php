<?php

class Filter{
    public ?string $car_number = null;
    public DateTimeImmutable $from;
    public DateTimeImmutable $to;
}

class ReceiptsQueryBuilder {

    public function getIdsFromFilter(Filter $filter): array
    {
        $sql[] = <<<MySQL
            SELECT `id` FROM `fuel_receipts`
            WHERE `gmt` BETWEEN :from AND :to
            MySQL;

        $params = [
            'from' => $filter->from->format('Y-m-d H:i:s'),
            'to' => $filter->to->format('Y-m-d H:i:s'),
        ];

        if ($filter->car_number ?? null) {
            $params['license_plate'] = $filter->car_number;

            $sql[] = <<<MySQL
                AND `license_plate` = :license_plate
                MySQL;
        }

        $result = \App\Core\DB::execute(implode("\n", $sql), $params)->fetchAll();

        return array_column($result, 'id');
    }
}

$filter = new Filter();
$filter->from = new DateTimeImmutable('-1 week');
$filter->to = new DateTimeImmutable('now');
//$filter->car_number = 'KR-1916';
$filter->car_number = 'G-01';

$ids = (new ReceiptsQueryBuilder())->getIdsFromFilter($filter);

$receipts = \App\Models\FuelReceipt::getArray($ids);

include __DIR__ . '/../../views/receipts/index.php';
