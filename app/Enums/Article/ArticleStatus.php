<?php

namespace App\Enums\Article;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Published()
 * @method static static Draft()
 */
final class ArticleStatus extends Enum implements LocalizedEnum
{
    const Default=0;
    const Vip = 1;
    const Normal = 2;
}
