<?php

namespace App\Enums\CommissionDetail;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Member()
 */
final class CommissionDetailType extends Enum implements LocalizedEnum
{
    const directCommission = 0;
    const inDirectCommission = 1;
}
