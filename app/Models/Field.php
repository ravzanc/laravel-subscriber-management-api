<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use App\Enums\FieldType;
use App\Http\Requests\FieldFormRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/* @property string $title
 * @property FieldType $type
 * @property Collection fieldValues
 */
#[ApiResource(
    order: ["id" => "DESC"],
    rules: FieldFormRequest::class,
)]
class Field extends Model
{
    use HasFactory;

    protected $keyType = 'integer';
    protected $fillable = [
        'title',
        'type',
    ];

    public function fieldValues(): HasMany
    {
        return $this->hasMany(FieldValue::class);
    }
    public function getFieldValues(): Collection
    {
        return $this->fieldValues;
    }
}
