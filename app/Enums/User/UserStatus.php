<?php

namespace App\Enums\User;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static Activated()
 * @method static static NotActivated()

 */
final class UserStatus extends Enum implements LocalizedEnum
{
    const Activated = 1;
    const NotActivated= 0;

}
