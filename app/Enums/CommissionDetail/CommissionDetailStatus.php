<?php

namespace App\Enums\CommissionDetail;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Member()
 */
final class CommissionDetailStatus extends Enum implements LocalizedEnum
{
    const Waiting = 0;
    const Approved = 1;
    const Rejected = 2;
}
