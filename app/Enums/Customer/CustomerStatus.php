<?php

namespace App\Enums\Customer;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Member()
 */
final class CustomerStatus extends Enum implements LocalizedEnum
{
    const unHandled = 0;
    const called = 1;
    const needMoreContact = 2;
}
