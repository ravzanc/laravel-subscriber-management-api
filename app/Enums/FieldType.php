<?php

namespace App\Enums;

use App\Traits\HasEnumValues;

enum FieldType: string
{
    use HasEnumValues;
    case DATE = 'date';
    case NUMBER = 'number';
    case STRING = 'string';
    case BOOLEAN = 'boolean';
}
