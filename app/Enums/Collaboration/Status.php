<?php

namespace App\Enums\Collaboration;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Status extends Enum implements LocalizedEnum
{
    const active = 0;
    const suspended = 1;

    public static function getDescription($value): string
    {
        return match ($value) {
            self::active => 'Đang tham gia',
            self::suspended => 'Tạm ngưng'
        };
    }

    public function badge(): string
    {
        return match ($this->value) {
            self::active => 'bg-success-lt',
            self::suspended => 'bg-warning',
            default => 'bg-secondary',
        };
    }
}
