<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use App\Enums\FieldType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ApiResource]
class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
    ];

    protected string $title;
    protected FieldType $type;
}
