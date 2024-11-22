<?php

namespace App\Enums\Article;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Published()
 * @method static static Draft()
 */
final class ArticlePriceConsent extends Enum implements LocalizedEnum
{
    const Yes = 1;
    const No = 2;
}
