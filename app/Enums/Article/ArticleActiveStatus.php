<?php

namespace App\Enums\Article;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Published()
 * @method static static Draft()
 */
final class ArticleActiveStatus extends Enum implements LocalizedEnum
{
    const Published = 1;
    const Draft = 2;
    const Already = 3;

    public static function getDescription($value): string
    {
        return match ($value) {
            self::Published => 'Đã duyệt',
            self::Draft => 'Chưa duyệt',
        };
    }

    public function badge(): string
    {
        return match ($this->value) {
            self::Published => 'bg-success',
            self::Draft => 'bg-warning',
            default => 'bg-secondary',
        };
    }
}
