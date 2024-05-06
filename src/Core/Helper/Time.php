<?php

namespace App\Core\Helper;

use DateTimeImmutable;
use DateTimeZone;

class Time
{
    public const string DF = 'Y-m-d H:i:s';
    public const string HTML = 'Y-m-d\TH:i';

    public static function toUTC(string $dt, string $srcTz, string $format = self::DF): DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat($format, $dt, new DateTimeZone($srcTz))
            ->setTimezone(new DateTimeZone('UTC'));
    }

    public static function toUTCStr(string $dt, string $srcTz, string $format = self::DF): string
    {
        return self::toUTC($dt, $srcTz)->format($format);
    }
}
