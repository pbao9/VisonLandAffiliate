<?php

namespace App\Enums\Notification;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;
/**
 * @method static static Seen()
 * @method static static NotSeen()
 */
final class NotificationEnum extends Enum implements LocalizedEnum
{
    const NotSeen = 1;
    const Seen = 2;
}
