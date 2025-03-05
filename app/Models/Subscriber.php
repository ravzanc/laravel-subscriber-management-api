<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use App\Enums\SubscriberState;
use App\Http\Requests\SubscriberFormRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/* @property string $email
 * @property string $name
 * @property SubscriberState $state
 * @property Collection fieldValues
*/
#[ApiResource(
    rules: SubscriberFormRequest::class,
)]
class Subscriber extends Model
{
    use HasFactory;

    protected $keyType = 'integer';
    protected $fillable = [
        'email',
        'name',
        'state'
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
