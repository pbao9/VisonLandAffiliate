<?php

namespace App\Enums\User;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Male()
 * @method static static Female()
 * @method static static Other()
 */
final class UserIdentifier extends Enum implements LocalizedEnum
{
    const Unidentified = 0;
    const Identified = 1;
}
