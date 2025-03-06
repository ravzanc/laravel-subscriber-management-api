<?php

namespace App\Rules;

use App\Contracts\EmailService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final readonly class ActiveEmailHostDomain implements ValidationRule
{
    public function __construct(private EmailService $emailService)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (false === $this->emailService->hasActiveEmailHostDomain($value)) {
            $fail("The {$attribute}'s host domain must be active");
        }
    }
}
