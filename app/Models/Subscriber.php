<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use App\Enums\SubscriberState;
use App\Http\Requests\SubscriberFormRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ApiResource(
    rules: SubscriberFormRequest::class,
)]
class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'state'
    ];

    protected string $email;
    protected string $name;
    protected SubscriberState $state;
}
