<?php

namespace App\Enums\Article;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Published()
 * @method static static Draft()
 */
final class ArticleArticleStatus extends Enum implements LocalizedEnum
{
    const Waiting = 1;
    const Pending = 2;
    const Approved = 3;
    const Cancel = 4;

    public static function getDescription($value): string
    {
        return match ($value) {
            self::Waiting => 'Chờ thanh toán',
            self::Pending => 'Đang chờ duyệt',
            self::Approved => 'Đã duyệt',
            self::Cancel => 'Không duyệt',
        };
    }

    public function badge(): string
    {
        return match ($this->value) {
            self::Waiting => 'bg-warning-lt',
            self::Pending => 'bg-warning',
            self::Approved => 'bg-primary',
            self::Cancel => 'bg-danger',
            default => 'bg-secondary',
        };
    }
}
