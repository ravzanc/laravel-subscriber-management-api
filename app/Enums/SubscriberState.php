<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum SubscriberState: string
{
    use HasEnumValues;
    case ACTIVE = 'active';
    case UNSUBSCRIBED = 'unsubscribed';
    case JUNK = 'junk';
    case BOUNCED = 'bounced';
    case UNCONFIRMED = 'unconfirmed';
}
