<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Cache;

class ActiveEmailHostDomain implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Extract the host domain from the email address
        $hostDomain = substr(strrchr($value, "@"), 1);

        // Check if the host domain is active
        // Caching check results to optimize the DNS Lookups
        $isHostDomainActive = Cache::remember(
            "host_domain_active_{$hostDomain}",
            3600,
            function () use ($hostDomain) {
                return checkdnsrr($hostDomain);
            }
        );
        if (false === $isHostDomainActive) {
            $fail("{$attribute}'s host domain must be active");
        }
    }
}
