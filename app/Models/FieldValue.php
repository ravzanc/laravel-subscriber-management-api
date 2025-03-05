<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/* @property string $value
 * @property Model $subscriber
 * @property Model $field
 */
#[ApiResource]
class FieldValue extends Model
{
    use HasFactory;

    protected $keyType = 'integer';
    protected $fillable = [
        'subscriber_id',
        'field_id',
        'value',
    ];

    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(Subscriber::class);
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    public function getSubscriber(): Model
    {
        return $this->subscriber;
    }

    public function getField(): Model
    {
        return $this->field;
    }
}
