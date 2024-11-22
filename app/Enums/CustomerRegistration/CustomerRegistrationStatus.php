<?php

namespace App\Enums\CustomerRegistration;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Member()
 */
final class CustomerRegistrationStatus extends Enum implements LocalizedEnum
{
    const Waiting = 0;
    const Approved = 1;
    const Rejected = 2;
}

