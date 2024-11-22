<?php

namespace App\Enums\Article;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Published()
 * @method static static Draft()
 */
final class ArticleType extends Enum implements LocalizedEnum
{
    const Sell = 1;
    const Rent = 2;
}
